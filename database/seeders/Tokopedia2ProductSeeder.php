<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\User;

class Tokopedia2ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get sellers (use existing approved sellers)
        $sellers = User::where('seller_status', 'approved')
                       ->where('is_admin', false)
                       ->get();
        
        if ($sellers->count() < 2) {
            $this->command->warn('Need at least 2 approved sellers. Skipping Tokopedia2ProductSeeder.');
            return;
        }

        $seller1 = $sellers[0];
        $seller2 = $sellers[1];

        $products = [
            // 1. iPhone 17 Pro - Handphone & Aksesoris (seller1)
            [
                'user_id' => $seller1->id,
                'name' => 'iPhone 17 Pro 256GB 512GB 1TB A19 Pro Chip',
                'category' => 'handphone-aksesoris',
                'description' => 'iPhone 17 Pro RESMI dengan chip A19 Pro terbaru! Performa super cepat untuk gaming, editing, dan multitasking berat. Kamera ProMotion 48MP dengan Night mode yang luar biasa. Tersedia pilihan warna Silver, Cosmic Orange, dan Deep Blue. Pilihan storage 256GB, 512GB, dan 1TB. Garansi resmi Apple Indonesia 1 tahun. Free case dan tempered glass!',
                'shop_name' => $seller1->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'SMARTPHONE FLAGSHIP',
                'price' => 24999000,
                'stock' => 15,
                'average_rating' => 4.9,
                'reviews_count' => 156,
                'sold_count' => 89,
                'photos' => [
                    'images/tokopedia2/(RESMI) iPhone 17 Pro 256GB 512GB 1TB A19 Pro Chip Silver Cosmic Orange Deep Blue - 256 GB, Deep Blue/55dc36a530de48879debb279d61cd299~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia2/(RESMI) iPhone 17 Pro 256GB 512GB 1TB A19 Pro Chip Silver Cosmic Orange Deep Blue - 256 GB, Deep Blue/112dad443bd74b40b513064d50ca2444~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/(RESMI) iPhone 17 Pro 256GB 512GB 1TB A19 Pro Chip Silver Cosmic Orange Deep Blue - 256 GB, Deep Blue/b9091266662048f9b97f9bf80918f6b1~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/(RESMI) iPhone 17 Pro 256GB 512GB 1TB A19 Pro Chip Silver Cosmic Orange Deep Blue - 256 GB, Deep Blue/c9c40fac4c324057863bd016fab6a404~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/(RESMI) iPhone 17 Pro 256GB 512GB 1TB A19 Pro Chip Silver Cosmic Orange Deep Blue - 256 GB, Deep Blue/f6557e26912f453d985a5ced04844b10~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 2. Fabronfrags Parfum Bizael - Kecantikan & Perawatan (seller2)
            [
                'user_id' => $seller2->id,
                'name' => 'Fabronfrags Parfum Bizael EDP 50ml',
                'category' => 'kecantikan-perawatan',
                'description' => 'Parfum Fabronfrags Bizael EDP 50ml dengan aroma mewah dan tahan lama! Wangi premium dengan perpaduan woody, fresh, dan sensual yang cocok untuk segala acara. Ketahanan aroma hingga 12 jam. Packaging elegan cocok untuk hadiah. Unisex fragrance yang bisa dipakai pria maupun wanita. Original 100% dengan segel resmi.',
                'shop_name' => $seller2->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'PARFUM PREMIUM',
                'price' => 289000,
                'stock' => 50,
                'average_rating' => 4.8,
                'reviews_count' => 234,
                'sold_count' => 412,
                'photos' => [
                    'images/tokopedia2/Fabronfrags - Parfum Bizael - EDP 50ml/c340d56acdd9473e85b1c3a109ea2a43~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia2/Fabronfrags - Parfum Bizael - EDP 50ml/57ba4aa3153140098b72e28e7da0d652~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/Fabronfrags - Parfum Bizael - EDP 50ml/6fa81309f7854346aaa977d9a43f839e~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/Fabronfrags - Parfum Bizael - EDP 50ml/77c131b9ce99468b916ec0857f2442f1~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 3. Flyman Celana Dalam Pria - Fashion Pria (seller1)
            [
                'user_id' => $seller1->id,
                'name' => 'Flyman Celana Dalam Pria Brief Tencel 3 pcs FM 3066',
                'category' => 'fashion-pria',
                'description' => 'Celana dalam pria Flyman Brief FM 3066 berbahan Tencel premium yang super nyaman! Isi 3 pcs dengan warna berbeda. Bahan Tencel lebih halus dari katun biasa, adem, dan menyerap keringat dengan baik. Jahitan rapi dan tidak mudah melar. Karet pinggang elastis nyaman di kulit. Ukuran M-XXL tersedia.',
                'shop_name' => $seller1->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'UNDERWEAR PRIA',
                'price' => 89000,
                'stock' => 100,
                'average_rating' => 4.7,
                'reviews_count' => 567,
                'sold_count' => 1234,
                'photos' => [
                    'images/tokopedia2/Flyman Celana Dalam Pria Brief Tencel 3 pcs FM 3066/asdadasdasd.jpeg',
                    'images/tokopedia2/Flyman Celana Dalam Pria Brief Tencel 3 pcs FM 3066/250056c5-4af7-459a-8845-1664c5928655.jpg~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/Flyman Celana Dalam Pria Brief Tencel 3 pcs FM 3066/90df2bdc-6f96-48ff-b08b-5d1d7f348458.jpg~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/Flyman Celana Dalam Pria Brief Tencel 3 pcs FM 3066/9a828ad0-1646-4529-bf3f-4d53a32869a2.jpg~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 4. KYMM SKIN X Super Glow - Perawatan Kulit (seller2)
            [
                'user_id' => $seller2->id,
                'name' => 'KYMM SKIN X Super Glow Serum Moisturizer Jelly',
                'category' => 'perawatan-kulit',
                'description' => 'KYMM SKIN X Super Glow Serum Moisturizer Jelly untuk kulit glowing instant! Formula unik dengan tekstur jelly yang ringan dan cepat menyerap. Mengandung Niacinamide, Hyaluronic Acid, dan Vitamin C untuk mencerahkan dan melembabkan kulit. Cocok untuk semua jenis kulit termasuk kulit sensitif. BPOM certified dan dermatologically tested.',
                'shop_name' => $seller2->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'SKINCARE GLOW',
                'price' => 159000,
                'stock' => 75,
                'average_rating' => 4.6,
                'reviews_count' => 892,
                'sold_count' => 2156,
                'photos' => [
                    'images/tokopedia2/KYMM SKIN X Super glow  Glowing serum moisturizer jelly/aaea8e421735420f9e897fa83a717efc~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia2/KYMM SKIN X Super glow  Glowing serum moisturizer jelly/213c730246eb42d1886af72912f094ac~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/KYMM SKIN X Super glow  Glowing serum moisturizer jelly/71d1614ffd204b50b37c8290eeeb5439~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 5. LocknLock Metro Double Tumbler - Perlengkapan Rumah (seller1)
            [
                'user_id' => $seller1->id,
                'name' => 'LocknLock Metro Double Tumbler 710ml LHC4203 Gray',
                'category' => 'perlengkapan-rumah',
                'description' => 'LocknLock Metro Double Tumbler 710ml dengan desain modern dan elegan! Kapasitas besar 710ml cocok untuk aktivitas seharian. Double wall insulation menjaga suhu minuman lebih lama. Tutup anti bocor dengan sedotan reusable. BPA Free dan food grade material. Warna Gray yang stylish cocok untuk ke kantor atau kampus.',
                'shop_name' => $seller1->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'TUMBLER & BOTOL',
                'price' => 149000,
                'stock' => 60,
                'average_rating' => 4.8,
                'reviews_count' => 345,
                'sold_count' => 678,
                'photos' => [
                    'images/tokopedia2/LocknLock Metro Double Tumbler 710ml - LHC4203 - Gray/c8ccbb96c5d24c37ae7c9bba8b03b950~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia2/LocknLock Metro Double Tumbler 710ml - LHC4203 - Gray/3e26746aa5774c2ea00ef4e003eedfad~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/LocknLock Metro Double Tumbler 710ml - LHC4203 - Gray/aad7a88831264f6fbfdd881b50ec5e25~tplv-o3syd03w52-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/LocknLock Metro Double Tumbler 710ml - LHC4203 - Gray/e00021e2fcc543d185cc4b9c1d3d5728~tplv-o3syd03w52-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 6. MamyPoko Pants X-tra Kering - Ibu & Bayi (seller2)
            [
                'user_id' => $seller2->id,
                'name' => 'MamyPoko Pants X-tra Kering Popok Celana Ultra Jumbo All Size',
                'category' => 'ibu-bayi',
                'description' => 'MamyPoko Pants X-tra Kering dengan daya serap extra untuk menjaga kulit bayi tetap kering! Popok celana premium dengan teknologi X-tra Kering yang menyerap cairan dengan cepat. Pinggang elastis 360° untuk kenyamanan maksimal. Bahan lembut dan breathable mencegah iritasi. Tersedia ukuran S, M, L, XL, dan XXL dalam kemasan Ultra Jumbo hemat.',
                'shop_name' => $seller2->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'PERLENGKAPAN BAYI',
                'price' => 189000,
                'stock' => 40,
                'average_rating' => 4.9,
                'reviews_count' => 1234,
                'sold_count' => 3456,
                'photos' => [
                    'images/tokopedia2/MamyPoko Pants X-tra Kering - Popok Celana Ultra Jumbo Karton Pack All Size (S-XXL)/0a46b4f5e6044e6eaa71384e53c5add0~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia2/MamyPoko Pants X-tra Kering - Popok Celana Ultra Jumbo Karton Pack All Size (S-XXL)/5002483b98ec43babc8f29fe7a0bfd54~tplv-o3syd03w52-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/MamyPoko Pants X-tra Kering - Popok Celana Ultra Jumbo Karton Pack All Size (S-XXL)/c49fa87c012c4e1696fdf23224838654~tplv-o3syd03w52-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/MamyPoko Pants X-tra Kering - Popok Celana Ultra Jumbo Karton Pack All Size (S-XXL)/fa871b04dda74073a99cf061b2cb6413~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 7. Penghapus Mini Karakter - Buku & Alat Tulis (seller1)
            [
                'user_id' => $seller1->id,
                'name' => 'Penghapus Mini Karakter Lucu Murah Penghapus Pensil',
                'category' => 'buku-alat-tulis',
                'description' => 'Penghapus mini dengan karakter lucu yang menggemaskan! Cocok untuk anak-anak dan remaja yang suka koleksi alat tulis unik. Bahan karet berkualitas yang mudah menghapus tanpa meninggalkan bekas. Ukuran mini praktis untuk dibawa kemana-mana. Tersedia berbagai karakter dan warna. Harga super murah untuk stok goodie bag atau hadiah.',
                'shop_name' => $seller1->shop_name,
                'condition' => 'new',
                'min_order' => 5,
                'showcase' => 'ALAT TULIS UNIK',
                'price' => 2500,
                'stock' => 500,
                'average_rating' => 4.5,
                'reviews_count' => 789,
                'sold_count' => 5678,
                'photos' => [
                    'images/tokopedia2/Penghapus Mini Karakter lucu Murah Penghapus Pensil/2d0ecea9268a4a9ca38b568f6af399bb~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                ],
            ],

            // 8. SanDisk Extreme Portable SSD - Komputer & Komponen (seller2)
            [
                'user_id' => $seller2->id,
                'name' => 'SanDisk Extreme Portable SSD E61 V2 1TB 2TB 4TB 8TB 1050MB/s USB 3.2',
                'category' => 'komputer-komponen',
                'description' => 'SanDisk Extreme Portable SSD E61 V2 dengan kecepatan transfer hingga 1050MB/s! NVMe solid state drive untuk backup, penyimpanan, dan transfer file super cepat. USB 3.2 Gen 2 Type-C compatible. IP65 water and dust resistant untuk ketahanan maksimal. Compact dan ringan, cocok untuk content creator dan profesional. Tersedia kapasitas 1TB, 2TB, 4TB, dan 8TB.',
                'shop_name' => $seller2->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'STORAGE DEVICES',
                'price' => 1899000,
                'stock' => 25,
                'average_rating' => 4.9,
                'reviews_count' => 456,
                'sold_count' => 234,
                'photos' => [
                    'images/tokopedia2/SANDISK Extreme Portable SSD E61 V2 1TB  2TB  4TB  8TB 1050MBs USB 3.2/87eb89e07d7e4a47aaffe77c6d34e48d~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia2/SANDISK Extreme Portable SSD E61 V2 1TB  2TB  4TB  8TB 1050MBs USB 3.2/06f96338e38b4fe9852357ce6c3e23bb~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/SANDISK Extreme Portable SSD E61 V2 1TB  2TB  4TB  8TB 1050MBs USB 3.2/30bc5f65d93a4ab3b5edae8aa860112b~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/SANDISK Extreme Portable SSD E61 V2 1TB  2TB  4TB  8TB 1050MBs USB 3.2/df2caf2e08d348f7b2eabe91ca5ee6e5~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                ],
            ],

            // 9. Shell Advance Oli Motor - Otomotif Motor (seller1)
            [
                'user_id' => $seller1->id,
                'name' => 'Shell Advance City Scooter 10W-40 1L Oli Motor',
                'category' => 'otomotif-motor',
                'description' => 'Shell Advance City Scooter 10W-40 oli motor matic premium 1 Liter! Diformulasikan khusus untuk motor matic dengan teknologi Active Cleansing yang menjaga mesin tetap bersih. Perlindungan maksimal untuk komponen CVT dan kopling otomatis. Cocok untuk semua jenis motor matic Honda, Yamaha, Suzuki, dll. Kemasan asli dan bersegel resmi Shell Indonesia.',
                'shop_name' => $seller1->shop_name,
                'condition' => 'new',
                'min_order' => 1,
                'showcase' => 'OLI & PELUMAS',
                'price' => 65000,
                'stock' => 80,
                'average_rating' => 4.8,
                'reviews_count' => 1567,
                'sold_count' => 4523,
                'photos' => [
                    'images/tokopedia2/Shell Advance City Scooter 10W-40 (1L) Oli Motor/4b629c10629d440fb23d85f08097c17f~tplv-aphluv4xwc-white-pad-v1_1600_1600.jpeg',
                    'images/tokopedia2/Shell Advance City Scooter 10W-40 (1L) Oli Motor/762274b900084ca0a24db1964d38afec~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/Shell Advance City Scooter 10W-40 (1L) Oli Motor/b14e9be820404c2b889e11cb14123c08~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
                    'images/tokopedia2/Shell Advance City Scooter 10W-40 (1L) Oli Motor/bd5f1c27a665415fab6dd56785dd577c~tplv-aphluv4xwc-resize-jpeg_700_0.jpeg',
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

        $this->command->info('Tokopedia2ProductSeeder: 9 products with photos created successfully!');
    }
}
