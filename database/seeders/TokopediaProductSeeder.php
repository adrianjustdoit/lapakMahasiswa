<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\User;
use Illuminate\Database\Seeder;

class TokopediaProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil seller yang sudah ada (6 seller dari SellerSeeder)
        $sellers = User::where('seller_status', 'approved')
            ->where('is_admin', false)
            ->get()
            ->keyBy('email');

        // Data produk dari folder tokopedia
        $products = [
            // 1. Baju Kerja Batik Blouse Wanita - Fashion Wanita (seller1)
            [
                'seller_email' => 'seller1@lapak.test',
                'name' => 'Baju Kerja Batik Blouse Wanita Modern',
                'description' => 'Blouse batik wanita modern cocok untuk kerja kantor maupun acara formal. Bahan katun premium yang nyaman dipakai seharian. Motif batik elegan dengan sentuhan kontemporer, tersedia berbagai ukuran dari S hingga XXL. Jahitan rapi dan berkualitas tinggi.',
                'price' => 175000,
                'stock' => 50,
                'category' => 'fashion-wanita',
                'folder' => 'Baju kerja batik blouse wanita',
                'photos' => [
                    '3de4f2a1c4114b20b23ca4181b82e1bf~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    '4016eef8aa224c57bd431e5258071fed~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    '50bb7766e3a2406faaaf7351e18fba65~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    '57abf824cedb4aadbf3ce18ac9c247b4~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                ],
            ],

            // 2. Celana Pendek - Fashion Pria (seller1)
            [
                'seller_email' => 'seller1@lapak.test',
                'name' => 'Celana Pendek Pria Casual Premium',
                'description' => 'Celana pendek pria casual dengan bahan katun stretch yang nyaman dan breathable. Cocok untuk santai di rumah, olahraga ringan, atau jalan-jalan. Dilengkapi kantong samping dan belakang yang fungsional. Tali pinggang elastis dengan drawstring untuk kenyamanan maksimal.',
                'price' => 89000,
                'stock' => 75,
                'category' => 'fashion-pria',
                'folder' => 'Celana Pendek',
                'photos' => [
                    '215301f2e1504e298b1e9c1fdce529a1~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    '49ac192414924f9f8bc0092a03c646a0~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    '58f7b4f24c054ea69e8bc208fcb764a6~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'b91860ad0a9a4311b2c474bebd150999~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 3. Gamis Jubah Pria Muslim - Fashion Muslim (seller1)
            [
                'seller_email' => 'seller1@lapak.test',
                'name' => 'Gamis Jubah Pria Muslim Premium',
                'description' => 'Gamis jubah pria muslim premium dengan desain modern dan elegan. Bahan toyobo berkualitas tinggi yang adem dan tidak mudah kusut. Cocok untuk sholat, pengajian, atau acara formal keagamaan. Tersedia berbagai warna netral dan ukuran lengkap. Jahitan rapi dengan finishing terbaik.',
                'price' => 245000,
                'stock' => 30,
                'category' => 'fashion-muslim',
                'folder' => 'Gamis Jubah Pria Muslim',
                'photos' => [
                    '3f8b15ebd35844febdc7fa56038066cc~.jpeg',
                    '65da482aff36402ebfb4b93a433ae013~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'bc566c9d95384c63a0744d8f8328c347~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'ef4a5a6d7e904ad7867b271f9996b389~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 4. ROG Xbox Ally X (2025) - Gaming Console (seller4 - Elektronik)
            [
                'seller_email' => 'seller4@lapak.test',
                'name' => 'ASUS ROG Ally X (2025) Handheld Gaming Console',
                'description' => 'ASUS ROG Ally X (2025) - Konsol gaming handheld terbaru dengan performa luar biasa! Ditenagai AMD Ryzen Z1 Extreme, layar 7" FHD 120Hz, RAM 24GB LPDDR5X, storage 1TB SSD. Mendukung semua game PC AAA dengan performa maksimal. Baterai 80Wh untuk gaming marathon. Windows 11 terintegrasi dengan ROG Gaming Library.',
                'price' => 12500000,
                'stock' => 10,
                'category' => 'gaming-console',
                'folder' => 'ROG Xbox Ally X (2025)',
                'photos' => [
                    '4878e07f67744e46b97300b3132b716e~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    '96bdab8c24294830b9970cbd4f298bf7~tplv-aphluv4xwc-resize-jpeg_700_0 (1).jpeg',
                    '96bdab8c24294830b9970cbd4f298bf7~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'e6a06b7f6b5b4528ab0ac72c9235ec06~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 5. Sarung Tangan Touring Racing - Otomotif Motor (seller5 - Hobi)
            [
                'seller_email' => 'seller5@lapak.test',
                'name' => 'Sarung Tangan Touring Racing Motor Full Finger',
                'description' => 'Sarung tangan touring racing motor full finger dengan proteksi maksimal! Bahan kulit sintetis premium kombinasi mesh breathable. Dilengkapi knuckle protector dan palm slider untuk keamanan berkendara. Touchscreen compatible di jari telunjuk dan ibu jari. Velcro strap untuk fit sempurna. Cocok untuk touring jarak jauh maupun daily riding.',
                'price' => 165000,
                'stock' => 45,
                'category' => 'otomotif-motor',
                'folder' => 'Sarung Tangan Touring Racing',
                'photos' => [
                    '2985b0fd47114c929a35ee63eb19425a~tplv-o3syd03w52-resize-jpeg_700_0.jpeg',
                    '3b0869d8a6fc43e2af03b867a49aa98f~tplv-o3syd03w52-resize-jpeg_1600_1600.jpeg',
                    '4233cef0e1314746a61cfdb551495753~tplv-o3syd03w52-resize-jpeg_700_0.jpeg',
                    'ca1d33f697f94eabbee1df2225030495~tplv-o3syd03w52-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 6. Sepatu Formal Pria Modena - Sepatu Pria (seller1)
            [
                'seller_email' => 'seller1@lapak.test',
                'name' => 'Sepatu Formal Pria Modena Kulit Asli',
                'description' => 'Sepatu formal pria Modena dengan bahan kulit asli berkualitas tinggi. Desain klasik elegan cocok untuk kerja kantoran, meeting, atau acara formal. Sol karet anti slip yang nyaman untuk dipakai seharian. Jahitan tangan yang rapi dan tahan lama. Tersedia warna hitam dan coklat, ukuran 39-44.',
                'price' => 425000,
                'stock' => 25,
                'category' => 'sepatu-pria',
                'folder' => 'Sepatu Formal Pria Modena',
                'photos' => [
                    '216de26296f54925819653494c8be2f1~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    '3ebd02f1e5f845b3af39a9c640b187cb~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    '71d56d51b77e489d90978b7d7817ffc2~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'f84885f0491c4aa9b8618570839c2e8d~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 7. Sepatu Sneakers Casual Sport Pria - Sepatu Pria (seller1)
            [
                'seller_email' => 'seller1@lapak.test',
                'name' => 'Sepatu Sneakers Casual Sport Pria Trendy',
                'description' => 'Sepatu sneakers casual sport pria dengan desain trendy dan kekinian! Bahan upper mesh breathable yang ringan dan nyaman. Sol EVA foam empuk untuk kenyamanan maksimal saat berjalan atau berolahraga ringan. Cocok untuk kuliah, hangout, atau aktivitas sehari-hari. Tersedia berbagai warna kombinasi menarik, ukuran 39-44.',
                'price' => 285000,
                'stock' => 60,
                'category' => 'sepatu-pria',
                'folder' => 'Sepatu Sneakers Casual Sport Pria',
                'photos' => [
                    '2b5af516f5f04d20a1fd639434dc3507~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    '73652b7c0b6249008ad7c039c866cea1~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'c77d19a697a24de0ab5ed270095672c7~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'e2d45c5040a74539b681c89497ec8e01~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                ],
            ],

            // 8. Slingbag - Tas Wanita (seller1)
            [
                'seller_email' => 'seller1@lapak.test',
                'name' => 'Slingbag Wanita Minimalis Korean Style',
                'description' => 'Slingbag wanita minimalis dengan Korean style yang elegan dan fashionable! Bahan PU leather premium yang tahan lama dan mudah dibersihkan. Ukuran compact tapi muat banyak barang penting. Dilengkapi tali panjang adjustable untuk crossbody atau shoulder. Cocok untuk hangout, kuliah, atau traveling. Tersedia berbagai warna cantik.',
                'price' => 125000,
                'stock' => 80,
                'category' => 'tas-wanita',
                'folder' => 'Slingbag',
                'photos' => [
                    '0dacb953b8dc4928b245a92d3684e898~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    '93166f8662dc4e08887fbe7c47d33962~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'c35e589d79cb4b1ba4fba032e08154f0~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'd7d3c34b82ba4a04b1e89b6da42f86ee~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],
        ];

        foreach ($products as $productData) {
            $seller = $sellers->get($productData['seller_email']);
            
            if (!$seller) {
                $this->command->warn("Seller {$productData['seller_email']} tidak ditemukan, skip produk {$productData['name']}");
                continue;
            }

            // Buat produk
            $product = Product::updateOrCreate(
                [
                    'user_id' => $seller->id,
                    'name' => $productData['name'],
                ],
                [
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'category' => $productData['category'],
                    'shop_name' => $seller->shop_name,
                ]
            );

            // Hapus foto lama jika ada
            $product->photos()->delete();

            // Tambahkan foto-foto produk
            foreach ($productData['photos'] as $index => $photoFileName) {
                $photoPath = 'images/tokopedia/' . $productData['folder'] . '/' . $photoFileName;
                
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'path' => $photoPath,
                    'is_cover' => $index === 0, // Foto pertama sebagai cover
                ]);
            }

            $this->command->info("Produk '{$productData['name']}' berhasil dibuat dengan " . count($productData['photos']) . " foto");
        }
    }
}
