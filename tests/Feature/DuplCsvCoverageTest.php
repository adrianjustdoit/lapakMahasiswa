<?php

namespace Tests\Feature;

use App\Mail\NewReviewNotificationMail;
use App\Mail\PasswordResetCodeMail;
use App\Mail\SellerApprovedMail;
use App\Mail\SellerRegisteredMail;
use App\Mail\SellerRejectedMail;
use App\Models\PasswordResetCode;
use App\Models\Product;
use App\Models\ProductGuestReview;
use App\Models\ProductPhoto;
use App\Models\SellerProfileUpdate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DuplCsvCoverageTest extends TestCase
{
    use RefreshDatabase;

    private function makeAdmin(array $overrides = []): User
    {
        return User::factory()->create(array_merge([
            'is_admin' => true,
            'seller_status' => null,
            'email_verified_at' => now(),
        ], $overrides));
    }

    private function makeUser(array $overrides = []): User
    {
        return User::factory()->create(array_merge([
            'is_admin' => false,
            'seller_status' => null,
            'email_verified_at' => now(),
        ], $overrides));
    }

    private function makeSeller(array $overrides = []): User
    {
        return User::factory()->create(array_merge([
            'is_admin' => false,
            'seller_status' => 'approved',
            'shop_name' => 'Toko Uji',
            'shop_description' => 'Toko untuk pengujian',
            'pic_name' => 'Penjual Uji',
            'pic_phone' => '081234567890',
            'pic_email' => 'seller-uji@example.test',
            'pic_address' => 'Jalan Pengujian',
            'pic_id_number' => '1234567890123456',
            'provinsi' => 'Jawa Barat',
            'kota' => 'Bandung',
            'email_verified_at' => now(),
        ], $overrides));
    }

    private function makeProduct(?User $seller = null, array $overrides = []): Product
    {
        $seller ??= $this->makeSeller();

        $product = Product::create(array_merge([
            'user_id' => $seller->id,
            'name' => 'Produk Pengujian',
            'category' => 'fashion-pria',
            'description' => 'Deskripsi produk pengujian',
            'shop_name' => $seller->shop_name,
            'condition' => 'baru',
            'min_order' => 1,
            'showcase' => 'Etalase Utama',
            'price' => 25000,
            'average_rating' => 0,
            'reviews_count' => 0,
            'sold_count' => 0,
            'stock' => 10,
        ], $overrides));

        ProductPhoto::create([
            'product_id' => $product->id,
            'path' => 'products/test.jpg',
            'is_cover' => true,
        ]);

        return $product;
    }

    private function validSellerRegistrationPayload(array $overrides = []): array
    {
        return array_merge([
            'shop_name' => 'Toko Registrasi',
            'shop_description' => 'Deskripsi toko registrasi',
            'pic_name' => 'PIC Registrasi',
            'pic_phone' => '081234567891',
            'pic_email' => 'registrasi@example.test',
            'pic_address' => 'Jalan Registrasi',
            'rt' => '01',
            'rw' => '02',
            'kelurahan' => 'Sukamaju',
            'kecamatan' => 'Coblong',
            'kota' => 'Bandung',
            'provinsi' => 'Jawa Barat',
            'pic_id_number' => '1234567890123456',
            'pic_id_photo' => UploadedFile::fake()->image('ktp.jpg')->size(256),
            'pic_photo' => UploadedFile::fake()->image('pic.jpg')->size(256),
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
        ], $overrides);
    }

    private function validProductPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Produk Baru',
            'category' => 'fashion-pria',
            'description' => 'Deskripsi produk baru',
            'shop_name' => 'Toko Produk',
            'condition' => 'baru',
            'min_order' => 1,
            'showcase' => 'Etalase',
            'price' => 10000,
            'stock' => 5,
            'photos' => [UploadedFile::fake()->image('produk.jpg')->size(256)],
        ], $overrides);
    }

    public function test_public_home_search_category_product_detail_shop_and_guest_review_flow(): void
    {
        Mail::fake();
        $seller = $this->makeSeller(['shop_name' => 'Toko Bandung', 'provinsi' => 'Jawa Barat', 'kota' => 'Bandung']);
        $product = $this->makeProduct($seller, ['name' => 'Kemeja Kampus', 'category' => 'fashion-pria']);
        ProductGuestReview::create([
            'product_id' => $product->id,
            'name' => 'Reviewer Awal',
            'email' => 'awal@example.test',
            'rating' => 5,
            'comment' => 'Produk bagus',
            'provinsi' => 'Jawa Barat',
        ]);

        $this->get('/')->assertOk()->assertSee('Kemeja Kampus');
        $this->get('/?search=Kemeja')->assertOk()->assertSee('Kemeja Kampus');
        $this->get('/?search=Toko%20Bandung')->assertOk()->assertSee('Kemeja Kampus');
        $this->get('/?search=Bandung&category=fashion')->assertOk()->assertSee('Kemeja Kampus');
        $this->get('/?category=tidak-valid')->assertOk();

        $this->get(route('products.show', $product))
            ->assertOk()
            ->assertSee('Kemeja Kampus')
            ->assertSee('Produk bagus')
            ->assertSee('Toko Bandung');

        $this->post(route('products.reviews.store', $product), [
            'name' => 'Pengunjung',
            'email' => 'pengunjung@example.test',
            'rating' => 4,
            'comment' => '<script>alert(1)</script> Aman',
            'provinsi' => 'Jawa Tengah',
        ])->assertRedirect(route('products.show', $product));

        $product->refresh();
        $this->assertSame(2, $product->reviews_count);
        $this->assertSame(4.5, round($product->average_rating, 1));
        Mail::assertSent(NewReviewNotificationMail::class);

        $this->post(route('products.reviews.store', $product), [
            'name' => 'Pengunjung',
            'email' => 'pengunjung@example.test',
            'rating' => 5,
            'comment' => 'Review kedua',
        ])->assertSessionHasErrors('email');

        $this->get(route('shops.show', $seller))->assertOk()->assertSee('Toko Bandung')->assertSee('Kemeja Kampus');
        $this->get(route('shops.show', $this->makeUser()))->assertNotFound();
        $this->get('/products/999999')->assertNotFound();
    }

    public function test_general_auth_profile_logout_and_password_reset_code_flow(): void
    {
        Mail::fake();
        $user = $this->makeUser(['email' => 'umum@example.test', 'password' => Hash::make('Password1!')]);

        $this->get('/register')->assertOk()->assertSee('Buat Akun Baru');
        $this->post('/register', [
            'name' => 'Pengguna Baru',
            'email' => 'baru@example.test',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
        ])->assertRedirect('/dashboard');
        $this->assertAuthenticated();
        auth()->logout();

        $this->get('/login')->assertOk();
        $this->post('/login', ['email' => 'umum@example.test', 'password' => 'salah'])->assertSessionHasErrors('email');
        $this->post('/login', ['email' => 'umum@example.test', 'password' => 'Password1!'])->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);

        $this->get('/profile')->assertOk();
        $this->patch('/profile', ['name' => 'Nama Update', 'email' => 'update@example.test'])
            ->assertRedirect('/profile')
            ->assertSessionHasNoErrors();
        $user->refresh();
        $this->assertSame('Nama Update', $user->name);
        $this->assertNull($user->email_verified_at);

        $this->post('/logout')->assertRedirect('/');
        $this->assertGuest();
        $this->get('/dashboard')->assertRedirect('/login');

        $this->post('/forgot-password', ['email' => 'update@example.test'])->assertRedirect();
        Mail::assertSent(PasswordResetCodeMail::class);
        $code = PasswordResetCode::where('email', 'update@example.test')->firstOrFail()->code;
        $this->post(route('password.verify-code.submit'), ['email' => 'update@example.test', 'code' => $code])->assertRedirect();
        $this->post(route('password.store'), [
            'email' => 'update@example.test',
            'code' => $code,
            'password' => 'Password2!',
            'password_confirmation' => 'Password2!',
        ])->assertRedirect(route('login'));
        $this->post('/login', ['email' => 'update@example.test', 'password' => 'Password2!'])->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    public function test_seller_registration_validation_admin_verification_activation_and_profile_update(): void
    {
        Mail::fake();
        Storage::fake('public');

        $this->get(route('seller.register'))->assertOk();
        $this->post(route('seller.register.store'), $this->validSellerRegistrationPayload([
            'pic_id_photo' => null,
            'pic_photo' => null,
        ]))->assertSessionHasErrors(['pic_id_photo', 'pic_photo']);

        $this->post(route('seller.register.store'), $this->validSellerRegistrationPayload())
            ->assertRedirect(route('seller.register'))
            ->assertSessionHas('status');
        $seller = User::where('email', 'registrasi@example.test')->firstOrFail();
        $this->assertSame('pending', $seller->seller_status);
        Mail::assertSent(SellerRegisteredMail::class);

        $admin = $this->makeAdmin();
        $this->actingAs($admin)->get(route('admin.sellers.index'))->assertOk()->assertSee('Toko Registrasi');
        $this->actingAs($admin)->post(route('admin.sellers.approve', $seller))->assertRedirect(route('admin.sellers.index'));
        $seller->refresh();
        $this->assertSame('approved', $seller->seller_status);
        $this->assertNotNull($seller->activation_token);
        Mail::assertSent(SellerApprovedMail::class);
        $token = $seller->activation_token;
        auth()->logout();
        $this->get(route('seller.activate', $token))->assertRedirect('/');
        $seller->refresh();
        $this->assertNull($seller->activation_token);
        $this->get(route('seller.activate', $token))->assertRedirect('/');

        $pendingSeller = $this->makeSeller(['seller_status' => 'pending', 'shop_name' => 'Toko Tolak', 'email' => 'tolak@example.test']);
        $this->actingAs($admin)->post(route('admin.sellers.reject', $pendingSeller), ['reason' => 'Data tidak sesuai'])
            ->assertRedirect(route('admin.sellers.index'));
        $pendingSeller->refresh();
        $this->assertSame('rejected', $pendingSeller->seller_status);
        $this->assertSame('Data tidak sesuai', $pendingSeller->rejection_reason);
        Mail::assertSent(SellerRejectedMail::class);

        $update = SellerProfileUpdate::create([
            'user_id' => $seller->id,
            'shop_name' => 'Toko Disetujui',
            'shop_description' => 'Deskripsi disetujui',
            'status' => 'pending',
        ]);
        $this->actingAs($admin)->post(route('admin.profile-updates.approve', $update))->assertRedirect(route('admin.sellers.index'));
        $seller->refresh();
        $update->refresh();
        $this->assertSame('Toko Disetujui', $seller->shop_name);
        $this->assertSame('approved', $update->status);
    }

    public function test_seller_products_dashboard_reports_settings_and_access_control(): void
    {
        Storage::fake('public');
        $seller = $this->makeSeller(['email' => 'seller-access@example.test', 'shop_name' => 'Toko Akses']);
        $otherSeller = $this->makeSeller(['email' => 'seller-lain@example.test', 'shop_name' => 'Toko Lain']);
        $product = $this->makeProduct($seller, ['name' => 'Produk Seller', 'stock' => 1]);
        $otherProduct = $this->makeProduct($otherSeller, ['name' => 'Produk Orang Lain']);
        ProductGuestReview::create([
            'product_id' => $product->id,
            'name' => 'Reviewer',
            'email' => 'rating@example.test',
            'rating' => 5,
            'comment' => 'Bagus',
        ]);

        $this->get(route('seller.products.index'))->assertRedirect('/login');
        $this->actingAs($this->makeUser())->get(route('seller.dashboard'))->assertForbidden();

        $this->actingAs($seller)->get(route('seller.dashboard'))->assertOk();
        $this->actingAs($seller)->get(route('seller.chart-data'))->assertOk()->assertJsonStructure(['stockDistribution', 'ratingDistribution', 'reviewersByProvince']);
        $this->actingAs($seller)->get(route('seller.products.index'))->assertOk()->assertSee('Produk Seller')->assertDontSee('Produk Orang Lain');
        $this->actingAs($seller)->get(route('seller.products.index', ['search' => 'Seller']))->assertOk()->assertSee('Produk Seller');
        $this->actingAs($seller)->get(route('seller.products.index', ['category' => 'fashion-pria']))->assertOk()->assertSee('Produk Seller');
        $this->actingAs($seller)->get(route('seller.products.create'))->assertOk();

        $this->actingAs($seller)->post(route('seller.products.store'), $this->validProductPayload())
            ->assertRedirect();
        $created = Product::where('name', 'Produk Baru')->firstOrFail();
        $this->assertTrue($created->photos()->where('is_cover', true)->exists());
        $this->actingAs($seller)->post(route('seller.products.store'), $this->validProductPayload(['category' => 'kategori-salah']))
            ->assertSessionHasErrors('category');

        $this->actingAs($seller)->get(route('seller.products.edit', $otherProduct))->assertForbidden();
        $this->actingAs($seller)->put(route('seller.products.update', $product), $this->validProductPayload([
            'name' => 'Produk Seller Update',
            'photos' => null,
            'delete_photos' => [$product->photos()->where('is_cover', true)->first()->id],
        ]))->assertRedirect(route('seller.products.index'));
        $product->refresh();
        $this->assertSame('Produk Seller Update', $product->name);
        $this->assertTrue($product->photos()->where('is_cover', true)->exists() || $product->photos()->count() === 0);
        $this->actingAs($seller)->delete(route('seller.products.destroy', $otherProduct))->assertForbidden();

        $this->actingAs($seller)->get(route('seller.reports.index'))->assertOk();
        $validToken = now()->format('YmdHis') . '-abcdef12';
        $this->actingAs($seller)->get(route('seller.reports.stock-by-quantity', $validToken))->assertOk();
        $this->actingAs($seller)->get(route('seller.reports.stock-by-rating', $validToken))->assertOk();
        $this->actingAs($seller)->get(route('seller.reports.low-stock', $validToken))->assertOk();
        $this->actingAs($seller)->get(route('seller.reports.low-stock', 'invalid-token'))->assertForbidden();

        $this->actingAs($seller)->get(route('seller.settings'))->assertOk();
        $this->actingAs($seller)->put(route('seller.settings.update-shop'), [
            'shop_name' => 'Toko Akses Baru',
            'shop_description' => 'Deskripsi baru',
        ])->assertRedirect();
        $this->assertDatabaseHas('seller_profile_updates', ['user_id' => $seller->id, 'status' => 'pending']);
        $this->actingAs($seller)->delete(route('seller.settings.cancel-update'))->assertRedirect();
        $this->actingAs($seller)->put(route('seller.settings.update-contact'), [
            'pic_email' => 'kontakbaru@example.test',
            'pic_phone' => '081234567899',
            'current_password_contact' => 'password',
        ])->assertRedirect();
        $this->actingAs($seller)->put(route('seller.settings.update-password'), [
            'current_password' => 'password',
            'password' => 'Password3!',
            'password_confirmation' => 'Password3!',
        ])->assertRedirect();
    }

    public function test_admin_dashboard_reports_security_region_api_and_error_handling(): void
    {
        Http::fake([
            'wilayah.id/api/provinces.json' => Http::response(['data' => [['code' => '32', 'name' => 'JAWA BARAT']]], 200),
            'wilayah.id/api/regencies/32.json' => Http::response(['data' => [['code' => '32.73', 'name' => 'KOTA BANDUNG']]], 200),
            'wilayah.id/api/districts/32.73.json' => Http::response(['data' => [['code' => '32.73.01', 'name' => 'COBLONG']]], 200),
            'wilayah.id/api/villages/32.73.01.json' => Http::response(['data' => [['code' => '32.73.01.1001', 'name' => 'DAGO']]], 200),
            'wilayah.id/api/regencies/invalid.json' => Http::response(['data' => []], 404),
        ]);
        $admin = $this->makeAdmin();
        $seller = $this->makeSeller(['shop_name' => 'Toko Report', 'provinsi' => 'Jawa Barat']);
        $product = $this->makeProduct($seller, ['name' => 'Produk Report']);
        ProductGuestReview::create([
            'product_id' => $product->id,
            'name' => 'Reviewer',
            'email' => 'report@example.test',
            'rating' => 5,
            'comment' => 'Mantap',
            'provinsi' => 'Jawa Barat',
        ]);

        $this->get('/dashboard')->assertRedirect('/login');
        $this->actingAs($this->makeUser())->get(route('admin.dashboard'))->assertForbidden();
        $this->actingAs($seller)->get(route('admin.sellers.index'))->assertForbidden();
        $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk();
        $this->actingAs($admin)->get(route('admin.chart-data', ['type' => 'products-category']))->assertOk();
        $this->actingAs($admin)->get(route('admin.reports.index'))->assertOk();

        $validToken = now()->format('YmdHis') . '-abcdef12';
        $this->actingAs($admin)->get(route('admin.reports.seller-status', $validToken))->assertOk();
        $this->actingAs($admin)->get(route('admin.reports.sellers-by-province', $validToken))->assertOk();
        $this->actingAs($admin)->get(route('admin.reports.product-ratings', $validToken))->assertOk();
        $this->actingAs($admin)->get(route('admin.reports.seller-status', 'invalid-token'))->assertForbidden();

        $this->get('/api/region/provinces')->assertOk()->assertJsonPath('data.0.code', '32');
        $this->get('/api/region/regencies/32')->assertOk()->assertJsonPath('data.0.name', 'KOTA BANDUNG');
        $this->get('/api/region/districts/32.73')->assertOk()->assertJsonPath('data.0.name', 'COBLONG');
        $this->get('/api/region/villages/32.73.01')->assertOk()->assertJsonPath('data.0.name', 'DAGO');
        $this->get('/api/region/regencies/invalid')->assertOk()->assertJson(['data' => []]);

        $this->get('/?search=%27%20OR%201%3D1%20--')->assertOk();
    }
}
