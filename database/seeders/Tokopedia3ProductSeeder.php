<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\User;

class Tokopedia3ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get sellers (use existing approved sellers)
        $sellers = User::where('seller_status', 'approved')
                       ->where('is_admin', false)
                       ->get();
        
        if ($sellers->count() < 3) {
            $this->command->warn('Need at least 3 approved sellers. Skipping Tokopedia3ProductSeeder.');
            return;
        }

        $seller1 = $sellers[0];
        $seller2 = $sellers[1];
        $seller3 = $sellers[2];

        $products = [
            // 1. Pisau Dapur 2pcs - Dapur & Masak (seller1)
            [
                'user_id' => $seller1->id,
                'name' => 'Pisau Dapur 2pcs Serba Guna Tajam dan Anti Lengket',
                'category' => 'dapur-masak',
                'description' => 'Set pisau dapur 2pcs serba guna dengan ketajaman maksimal! Bahan stainless steel premium anti karat dan tahan lama. Lapisan anti lengket memudahkan pemotongan bahan makanan. Ergonomis dan nyaman digenggam. Cocok untuk memotong daging, sayuran, buah, dan berbagai bahan masakan lainnya. Termasuk pisau chef dan pisau utility.',
                'shop_name' => $seller1->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'PERALATAN DAPUR',
                'price' => 79000,
                'stock' => 60,
                'average_rating' => 4.7,
                'reviews_count' => 423,
                'sold_count' => 892,
                'photos' => [
                    'images/tokopedia3/isau Dapur 2pcs Serba Guna Tajam dan Anti Lengket/2375a3b78fd742789dbaad0862ec72d2~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia3/isau Dapur 2pcs Serba Guna Tajam dan Anti Lengket/153c250f25314595972d5620466d8d65~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/isau Dapur 2pcs Serba Guna Tajam dan Anti Lengket/697f62d22e774470b1a5b21dc9b4edcc~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/isau Dapur 2pcs Serba Guna Tajam dan Anti Lengket/69e963f5f10c4b758cbe7d8f7c0c7f0a~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 2. Jumping Pirates Roulette Game - Mainan & Edukasi (seller2)
            [
                'user_id' => $seller2->id,
                'name' => 'Jumping Pirates Roulette Family Game',
                'category' => 'mainan-edukasi',
                'description' => 'Permainan keluarga seru Jumping Pirates Roulette! Game klasik yang mendebarkan untuk dimainkan bersama keluarga dan teman. Tusukkan pedang ke dalam tong dan lihat siapa yang membuat bajak laut melompat! Melatih kesabaran dan ketegangan. Cocok untuk anak usia 4 tahun ke atas. Bahan plastik aman dan berkualitas.',
                'shop_name' => $seller2->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'BOARD GAME',
                'price' => 45000,
                'stock' => 80,
                'average_rating' => 4.6,
                'reviews_count' => 567,
                'sold_count' => 1234,
                'photos' => [
                    'images/tokopedia3/Jumping Pirates Roulette Family Game/a687c599-5669-4fd8-912c-d6429977f456.jpg~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia3/Jumping Pirates Roulette Family Game/adf87fc0-f9fc-4ea2-9eaf-cb6140620830.jpg~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 3. Mainan Anak Mobil Baterai POLISI - Mainan & Edukasi (seller3)
            [
                'user_id' => $seller3->id,
                'name' => 'Mainan Anak Mobil Baterai POLISI Tiping',
                'category' => 'mainan-edukasi',
                'description' => 'Mainan mobil polisi dengan fitur tiping dan lampu LED yang menarik! Menggunakan baterai AA untuk gerakan otomatis. Dilengkapi suara sirene polisi yang realistis. Mobil bisa berputar dan berjalan sendiri. Material plastik ABS berkualitas tinggi yang aman untuk anak-anak. Cocok untuk anak usia 3 tahun ke atas.',
                'shop_name' => $seller3->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'MAINAN ANAK',
                'price' => 35000,
                'stock' => 100,
                'average_rating' => 4.5,
                'reviews_count' => 234,
                'sold_count' => 567,
                'photos' => [
                    'images/tokopedia3/Mainan Anak Mobil Baterai POLISI Tiping/5834525_afb7d889-7c93-497d-99ad-606fdd1fd70e_2048_2048~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia3/Mainan Anak Mobil Baterai POLISI Tiping/5834525_3fc8e31a-b3c4-4931-a5c8-85109ddc03cd_2048_2048~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/Mainan Anak Mobil Baterai POLISI Tiping/5834525_6ae87bd1-4c35-4d5c-860b-c7380711f99a_2048_2048~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/Mainan Anak Mobil Baterai POLISI Tiping/5834525_b5e2d770-296d-4c5d-b0af-c09eda138422_2048_2048~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 4. Pedigree Can Puppy Makanan Anjing - Hewan Peliharaan (seller1)
            [
                'user_id' => $seller1->id,
                'name' => 'Pedigree Can Puppy 400gr Makanan Anjing Basah',
                'category' => 'hewan-peliharaan',
                'description' => 'Pedigree Can Puppy 400gr makanan basah premium untuk anak anjing! Diformulasikan khusus untuk memenuhi kebutuhan nutrisi puppy dengan protein tinggi dan kalsium untuk pertumbuhan tulang yang kuat. Tekstur lembut mudah dicerna. Mengandung vitamin dan mineral penting. Rasa lezat yang disukai anjing. Cocok untuk puppy usia 1-12 bulan.',
                'shop_name' => $seller1->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'MAKANAN ANJING',
                'price' => 32000,
                'stock' => 120,
                'average_rating' => 4.8,
                'reviews_count' => 789,
                'sold_count' => 2345,
                'photos' => [
                    'images/tokopedia3/Pedigree Can Puppy 400gr Makanan Anjing Basah/72de9d09-6be2-47a1-838f-6b77d3b69fa3.jpg~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia3/Pedigree Can Puppy 400gr Makanan Anjing Basah/41d9bcf7-a9db-4921-b216-3d80db8f4a62.jpg~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/Pedigree Can Puppy 400gr Makanan Anjing Basah/54b22c83-dcad-4e96-bdd4-f7edca4bcfd2.jpg~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/Pedigree Can Puppy 400gr Makanan Anjing Basah/772c8635-d422-4321-995b-e5d2a58f051d.jpg~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 5. PETKIT Deep Sleep Pet Bed - Hewan Peliharaan (seller2)
            [
                'user_id' => $seller2->id,
                'name' => 'PETKIT Deep Sleep All Season Pet Bed',
                'category' => 'hewan-peliharaan',
                'description' => 'PETKIT Deep Sleep Pet Bed tempat tidur premium untuk anjing dan kucing! Desain deep sleep dengan bantalan empuk yang nyaman untuk tidur lelap. Bahan breathable cocok untuk semua musim. Anti-slip di bagian bawah. Mudah dibersihkan dan dicuci. Tersedia berbagai ukuran untuk berbagai jenis hewan peliharaan. Warna elegan yang cocok untuk interior rumah.',
                'shop_name' => $seller2->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'AKSESORIS PET',
                'price' => 289000,
                'stock' => 35,
                'average_rating' => 4.9,
                'reviews_count' => 156,
                'sold_count' => 423,
                'photos' => [
                    'images/tokopedia3/PETKIT Deep Sleep All Season Pet Bed/487bac37-67fd-46ed-a223-c5d85c6bf365.jpg~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia3/PETKIT Deep Sleep All Season Pet Bed/59d0b480-f06d-4393-b0d1-7404e5f4bf94.jpg~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/PETKIT Deep Sleep All Season Pet Bed/691524fc-efd8-48b9-98ec-f780ed362970.jpg~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/PETKIT Deep Sleep All Season Pet Bed/bcc372ff-62df-49e0-b16b-ead69baaecdd.jpg~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 6. Pokemon TCG Indonesia Booster Box - Hobi & Koleksi (seller3)
            [
                'user_id' => $seller3->id,
                'name' => 'Pokemon TCG Indonesia Kobaran Biru Booster Box MA2',
                'category' => 'hobi-koleksi',
                'description' => 'Pokemon TCG Indonesia seri Kobaran Biru (MA2) Booster Box! Isi 20 booster pack dengan masing-masing 5 kartu. Kesempatan mendapatkan kartu rare, holo, dan ultra rare! Kartu resmi berbahasa Indonesia. Cocok untuk kolektor dan pemain TCG. Expansion terbaru dengan artwork keren. Sealed box original dari distributor resmi.',
                'shop_name' => $seller3->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'TRADING CARD',
                'price' => 450000,
                'stock' => 20,
                'average_rating' => 4.9,
                'reviews_count' => 234,
                'sold_count' => 156,
                'photos' => [
                    'images/tokopedia3/Pokemon TCG Indonesia Kobaran Biru Booster Box MA2/40458815fd604c5f8ee84d4d0a500fa3~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia3/Pokemon TCG Indonesia Kobaran Biru Booster Box MA2/24946355a3094c1f8bcdef69f78d5f5d~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/Pokemon TCG Indonesia Kobaran Biru Booster Box MA2/6506e2df8fdb40aaa12a3bed3e529502~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/Pokemon TCG Indonesia Kobaran Biru Booster Box MA2/e5b9c8a30cf2499f98622226956fb365~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 7. Taiko Krezz Keripik Gurita - Makanan & Minuman (seller1)
            [
                'user_id' => $seller1->id,
                'name' => 'Taiko Krezz 500g/1000g Keripik Gurita Octopus Roasted Snack',
                'category' => 'makanan-minuman',
                'description' => 'Taiko Krezz keripik gurita panggang premium dari Jepang! Snack renyah dengan rasa seafood autentik yang gurih dan nikmat. Dipanggang sempurna untuk tekstur crispy maksimal. Cocok untuk camilan sehari-hari atau teman nonton. Kemasan praktis dengan pilihan 500g dan 1000g. Tanpa pengawet dan MSG. Import langsung dari Jepang.',
                'shop_name' => $seller1->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'SNACK IMPORT',
                'price' => 125000,
                'stock' => 45,
                'average_rating' => 4.7,
                'reviews_count' => 345,
                'sold_count' => 678,
                'photos' => [
                    'images/tokopedia3/Taiko Krezz 500g1000g Keripik Gurita Octopus Roasted Snack/98bb9ab2be8940f080f29e05eabba80e~.jpeg',
                    'images/tokopedia3/Taiko Krezz 500g1000g Keripik Gurita Octopus Roasted Snack/3c1a5e0b077e44c7a9bd191e4504ebf5~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/Taiko Krezz 500g1000g Keripik Gurita Octopus Roasted Snack/5ed866a140424dedbf2258dca5a14b9d~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/Taiko Krezz 500g1000g Keripik Gurita Octopus Roasted Snack/d335caecf2a04ecd90135c581a2acb4d~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 8. Wajan Tanpa Minyak Rosegold - Dapur & Masak (seller2)
            [
                'user_id' => $seller2->id,
                'name' => 'Wajan Tanpa Minyak - Rosegold',
                'category' => 'dapur-masak',
                'description' => 'Wajan anti lengket premium dengan teknologi tanpa minyak! Warna rosegold elegan yang cantik di dapur modern. Lapisan ceramic coating yang aman dan tahan lama. Masak lebih sehat tanpa perlu banyak minyak. Handle tahan panas dengan desain ergonomis. Cocok untuk semua jenis kompor termasuk induksi. Mudah dibersihkan dan anti gores.',
                'shop_name' => $seller2->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'COOKWARE',
                'price' => 189000,
                'stock' => 40,
                'average_rating' => 4.8,
                'reviews_count' => 456,
                'sold_count' => 789,
                'photos' => [
                    'images/tokopedia3/Wajan Tanpa Minyak - Rosegold/0ca357dbef1a42259d72625ce3e5fe25~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia3/Wajan Tanpa Minyak - Rosegold/0496411ccc9545e6974cc9f10b345af0~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/Wajan Tanpa Minyak - Rosegold/65a79311918143a0a22508a5dabd50cf~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia3/Wajan Tanpa Minyak - Rosegold/7091d392a7784157b1b5e470281ea15a~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 9. WOOFER Gimmie Meat Dog Treats - Hewan Peliharaan (seller3)
            [
                'user_id' => $seller3->id,
                'name' => 'WOOFER GIMMIE MEAT DOG TREATS 250 gram',
                'category' => 'hewan-peliharaan',
                'description' => 'WOOFER Gimmie Meat Dog Treats 250gr cemilan sehat untuk anjing kesayangan! Terbuat dari daging asli berkualitas tinggi tanpa bahan pengawet. Protein tinggi untuk kesehatan otot. Tekstur chewy yang disukai anjing. Cocok untuk training dan reward. Tidak mengandung grain dan gluten. Kemasan 250gr untuk kesegaran terjaga.',
                'shop_name' => $seller3->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'SNACK ANJING',
                'price' => 85000,
                'stock' => 55,
                'average_rating' => 4.8,
                'reviews_count' => 189,
                'sold_count' => 456,
                'photos' => [
                    'images/tokopedia3/WOOFER GIMMIE MEAT DOG TREATS 250 gram/bd8f93751075434c90ec754f5e0efe6b~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                ],
            ],
        ];

        foreach ($products as $productData) {
            $photos = $productData['photos'];
            unset($productData['photos']);

            $product = Product::create($productData);

            // Create photos
            foreach ($photos as $index => $photoPath) {
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'path' => $photoPath,
                    'is_cover' => $index === 0, // First photo is cover
                ]);
            }
        }

        $this->command->info('Tokopedia3ProductSeeder: 9 products with photos created successfully!');
    }
}
