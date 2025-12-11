<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductGuestReview;
use Faker\Factory as Faker;

class GuestReviewSeeder extends Seeder
{
    // 38 Provinsi Indonesia
    private array $provinces = [
        'Aceh',
        'Bali',
        'Banten',
        'Bengkulu',
        'Daerah Istimewa Yogyakarta',
        'DKI Jakarta',
        'Gorontalo',
        'Jambi',
        'Jawa Barat',
        'Jawa Tengah',
        'Jawa Timur',
        'Kalimantan Barat',
        'Kalimantan Selatan',
        'Kalimantan Tengah',
        'Kalimantan Timur',
        'Kalimantan Utara',
        'Kepulauan Bangka Belitung',
        'Kepulauan Riau',
        'Lampung',
        'Maluku',
        'Maluku Utara',
        'Nusa Tenggara Barat',
        'Nusa Tenggara Timur',
        'Papua',
        'Papua Barat',
        'Papua Barat Daya',
        'Papua Pegunungan',
        'Papua Selatan',
        'Papua Tengah',
        'Riau',
        'Sulawesi Barat',
        'Sulawesi Selatan',
        'Sulawesi Tengah',
        'Sulawesi Tenggara',
        'Sulawesi Utara',
        'Sumatera Barat',
        'Sumatera Selatan',
        'Sumatera Utara',
    ];

    // Review umum (bisa untuk semua produk) - fokus ke kualitas produk
    private array $generalReviews = [
        // Rating 5
        ['rating' => 5, 'comment' => 'Produk berkualitas tinggi! Sangat memuaskan.'],
        ['rating' => 5, 'comment' => 'Kualitasnya luar biasa, sesuai dengan harganya.'],
        ['rating' => 5, 'comment' => 'Bagus banget! Tidak menyesal pilih produk ini.'],
        ['rating' => 5, 'comment' => 'Top quality! Recommended untuk yang cari kualitas.'],
        ['rating' => 5, 'comment' => 'Produk original dan berkualitas premium.'],
        ['rating' => 5, 'comment' => 'Sangat puas dengan kualitas produk ini!'],
        ['rating' => 5, 'comment' => 'Keren banget! Worth every penny.'],
        ['rating' => 5, 'comment' => 'Perfect! Kualitasnya tidak mengecewakan.'],
        ['rating' => 5, 'comment' => 'Produk terbaik di kelasnya!'],
        ['rating' => 5, 'comment' => 'Excellent quality! Highly recommended.'],
        ['rating' => 5, 'comment' => 'Kualitas premium dengan harga yang wajar.'],
        ['rating' => 5, 'comment' => 'Bagus sekali! Sesuai ekspektasi.'],
        
        // Rating 4
        ['rating' => 4, 'comment' => 'Produk bagus, kualitas oke untuk harga segini.'],
        ['rating' => 4, 'comment' => 'Cukup memuaskan, kualitasnya di atas rata-rata.'],
        ['rating' => 4, 'comment' => 'Good product! Sedikit beda sama ekspektasi tapi masih bagus.'],
        ['rating' => 4, 'comment' => 'Kualitas oke, sesuai dengan deskripsi.'],
        ['rating' => 4, 'comment' => 'Produk berkualitas dengan harga bersaing.'],
        ['rating' => 4, 'comment' => 'Nice product! Sesuai dengan harga yang ditawarkan.'],
        ['rating' => 4, 'comment' => 'Bagus, tapi ada beberapa hal yang bisa ditingkatkan.'],
        ['rating' => 4, 'comment' => 'Overall bagus, kualitas lumayan.'],
        ['rating' => 4, 'comment' => 'Produk oke, tidak ada masalah berarti.'],
        ['rating' => 4, 'comment' => 'Cukup bagus untuk kebutuhan sehari-hari.'],
        
        // Rating 3
        ['rating' => 3, 'comment' => 'Lumayan lah untuk harga segini. Standar aja.'],
        ['rating' => 3, 'comment' => 'Produk biasa aja, tidak sesuai ekspektasi awal.'],
        ['rating' => 3, 'comment' => 'Kualitas standar, tidak ada yang istimewa.'],
        ['rating' => 3, 'comment' => 'So so, not bad but not great either.'],
        ['rating' => 3, 'comment' => 'Cukup oke lah, sesuai harga.'],
        ['rating' => 3, 'comment' => 'Average quality. Ekspektasi lebih tinggi sebenernya.'],
        ['rating' => 3, 'comment' => 'Produk lumayan, tapi bisa lebih baik.'],
        ['rating' => 3, 'comment' => 'Standar, tidak ada yang spesial.'],
        
        // Rating 2
        ['rating' => 2, 'comment' => 'Kualitas mengecewakan. Tidak sesuai foto.'],
        ['rating' => 2, 'comment' => 'Kurang puas dengan produk ini.'],
        ['rating' => 2, 'comment' => 'Tidak recommended. Kualitas jauh dari ekspektasi.'],
        ['rating' => 2, 'comment' => 'Produk kurang bagus, menyesal.'],
        
        // Rating 1
        ['rating' => 1, 'comment' => 'Sangat mengecewakan! Produk tidak sesuai deskripsi.'],
        ['rating' => 1, 'comment' => 'Kualitas buruk, tidak layak.'],
    ];

    // Review spesifik per kategori produk - fokus ke karakteristik produk
    private array $categoryReviews = [
        'fashion' => [
            ['rating' => 5, 'comment' => 'Bahannya adem dan nyaman dipakai seharian. Love it!'],
            ['rating' => 5, 'comment' => 'Jahitannya rapi, ukuran pas. Kualitas premium!'],
            ['rating' => 5, 'comment' => 'Warnanya bagus, bahan tidak luntur. Keren!'],
            ['rating' => 5, 'comment' => 'Modelnya kekinian banget. Worth it!'],
            ['rating' => 5, 'comment' => 'Bahan lembut dan tidak panas. Nyaman banget!'],
            ['rating' => 5, 'comment' => 'Desainnya elegan, cocok untuk berbagai acara.'],
            ['rating' => 4, 'comment' => 'Bahan lumayan bagus, warna sedikit beda dari foto.'],
            ['rating' => 4, 'comment' => 'Size agak kekecilan, tapi kualitas oke.'],
            ['rating' => 4, 'comment' => 'Bahannya nyaman, desain stylish.'],
            ['rating' => 4, 'comment' => 'Kualitas jahitan bagus, bahan adem.'],
            ['rating' => 3, 'comment' => 'Bahan standar, tidak setipis yang dikhawatirkan.'],
            ['rating' => 3, 'comment' => 'Jahitannya ada yang kurang rapi, tapi masih oke.'],
            ['rating' => 3, 'comment' => 'Warna agak pudar, tapi masih layak pakai.'],
        ],
        'elektronik' => [
            ['rating' => 5, 'comment' => 'Performa luar biasa! Tidak lag sama sekali.'],
            ['rating' => 5, 'comment' => 'Kualitas display jernih banget. Very satisfied!'],
            ['rating' => 5, 'comment' => 'Fast charging-nya beneran cepat. Top!'],
            ['rating' => 5, 'comment' => 'Build quality premium, material kokoh!'],
            ['rating' => 5, 'comment' => 'Spesifikasi sesuai, performa mantap!'],
            ['rating' => 5, 'comment' => 'Fitur lengkap, kualitas terjamin.'],
            ['rating' => 4, 'comment' => 'Performa bagus, tapi baterai cepat habis.'],
            ['rating' => 4, 'comment' => 'Fitur lengkap, sedikit panas kalau dipake lama.'],
            ['rating' => 4, 'comment' => 'Kualitas oke untuk harga segini.'],
            ['rating' => 4, 'comment' => 'Desain bagus, performa di atas rata-rata.'],
            ['rating' => 3, 'comment' => 'Lumayan, tapi ada beberapa fitur yang kurang.'],
            ['rating' => 3, 'comment' => 'Performa standar, tidak sesuai spek yang dijanjikan.'],
            ['rating' => 3, 'comment' => 'Kualitas biasa, banyak produk serupa lebih baik.'],
        ],
        'kecantikan' => [
            ['rating' => 5, 'comment' => 'Kulit jadi lebih glowing setelah pemakaian rutin!'],
            ['rating' => 5, 'comment' => 'Wanginya enak banget, tahan lama seharian!'],
            ['rating' => 5, 'comment' => 'Cocok di kulit sensitif, tidak bikin breakout!'],
            ['rating' => 5, 'comment' => 'Hasilnya keliatan dalam 1 minggu. Amazing!'],
            ['rating' => 5, 'comment' => 'Formulanya ringan dan cepat menyerap.'],
            ['rating' => 5, 'comment' => 'Tekstur lembut, hasil maksimal. Love it!'],
            ['rating' => 4, 'comment' => 'Teksturnya enak, cepat menyerap.'],
            ['rating' => 4, 'comment' => 'Hasilnya bagus tapi butuh waktu agak lama.'],
            ['rating' => 4, 'comment' => 'Wanginya lumayan, ketahanan standar.'],
            ['rating' => 4, 'comment' => 'Cocok untuk daily use, hasil natural.'],
            ['rating' => 3, 'comment' => 'Biasa aja, tidak ada perubahan signifikan.'],
            ['rating' => 3, 'comment' => 'Tekstur agak lengket, tapi masih oke.'],
            ['rating' => 3, 'comment' => 'Wangi cepat hilang, tidak tahan lama.'],
        ],
        'rumah' => [
            ['rating' => 5, 'comment' => 'Kualitas premium! Desain aesthetic banget.'],
            ['rating' => 5, 'comment' => 'Bahan kokoh dan tahan lama. Worth it!'],
            ['rating' => 5, 'comment' => 'Desain minimalis, cocok buat rumah modern!'],
            ['rating' => 5, 'comment' => 'Multifungsi dan praktis. Sangat membantu!'],
            ['rating' => 5, 'comment' => 'Material tebal dan berkualitas tinggi.'],
            ['rating' => 5, 'comment' => 'Finishing rapi, produk premium!'],
            ['rating' => 4, 'comment' => 'Kualitas bagus, desain menarik.'],
            ['rating' => 4, 'comment' => 'Produk oke, sesuai ekspektasi.'],
            ['rating' => 4, 'comment' => 'Bahan lumayan tebal, finishing rapi.'],
            ['rating' => 4, 'comment' => 'Fungsional dan tahan lama.'],
            ['rating' => 3, 'comment' => 'Standar lah untuk harga segini.'],
            ['rating' => 3, 'comment' => 'Agak tipis dari yang dibayangkan.'],
            ['rating' => 3, 'comment' => 'Kualitas biasa, tidak ada yang spesial.'],
        ],
        'hobi' => [
            ['rating' => 5, 'comment' => 'Produk rare dan original! Koleksi makin lengkap!'],
            ['rating' => 5, 'comment' => 'Kualitas top tier! Kondisi mint!'],
            ['rating' => 5, 'comment' => 'Kondisi prima, sesuai deskripsi. Very happy!'],
            ['rating' => 5, 'comment' => 'Authentic 100%! Kualitas terjamin!'],
            ['rating' => 5, 'comment' => 'Detail bagus, finishing rapi. Worth it!'],
            ['rating' => 5, 'comment' => 'Produk langka dengan kondisi sempurna!'],
            ['rating' => 4, 'comment' => 'Koleksi bagus, ada minor defect tapi masih oke.'],
            ['rating' => 4, 'comment' => 'Kondisi baik, sesuai dengan harga.'],
            ['rating' => 4, 'comment' => 'Produk langka, senang bisa menemukan ini!'],
            ['rating' => 4, 'comment' => 'Kualitas bagus untuk kolektor.'],
            ['rating' => 3, 'comment' => 'Kondisi second tapi masih layak koleksi.'],
            ['rating' => 3, 'comment' => 'Ada sedikit cacat, tapi overall oke.'],
            ['rating' => 3, 'comment' => 'Kualitas standar, bukan yang terbaik.'],
        ],
        'makanan' => [
            ['rating' => 5, 'comment' => 'Rasanya enak banget! Ketagihan!'],
            ['rating' => 5, 'comment' => 'Fresh dan higienis. Kualitas terjaga!'],
            ['rating' => 5, 'comment' => 'Porsinya pas, rasanya mantap!'],
            ['rating' => 5, 'comment' => 'Rasa autentik dan berkualitas!'],
            ['rating' => 5, 'comment' => 'Tekstur sempurna, rasa lezat!'],
            ['rating' => 5, 'comment' => 'Bahan berkualitas, rasa premium!'],
            ['rating' => 4, 'comment' => 'Enak! Rasa sesuai ekspektasi.'],
            ['rating' => 4, 'comment' => 'Rasanya oke, porsi lumayan.'],
            ['rating' => 4, 'comment' => 'Fresh dan enak, bisa lebih baik.'],
            ['rating' => 4, 'comment' => 'Kualitas bagus, rasa memuaskan.'],
            ['rating' => 3, 'comment' => 'Rasa standar, tidak se-enak yang diharapkan.'],
            ['rating' => 3, 'comment' => 'Lumayan, tapi porsinya kurang.'],
            ['rating' => 3, 'comment' => 'Biasa aja, ada yang lebih enak.'],
        ],
        'hewan' => [
            ['rating' => 5, 'comment' => 'Anjing/kucing saya suka banget! Kualitas bagus!'],
            ['rating' => 5, 'comment' => 'Kualitas premium untuk hewan kesayangan!'],
            ['rating' => 5, 'comment' => 'Pet saya jadi lebih sehat dan aktif!'],
            ['rating' => 5, 'comment' => 'Bahan aman dan berkualitas tinggi.'],
            ['rating' => 5, 'comment' => 'Produk terbaik untuk pet! Highly recommended.'],
            ['rating' => 5, 'comment' => 'Kualitas bagus, pet saya sangat menyukai!'],
            ['rating' => 4, 'comment' => 'Pet saya suka, kualitas bagus.'],
            ['rating' => 4, 'comment' => 'Kualitas bagus, ukuran sesuai deskripsi.'],
            ['rating' => 4, 'comment' => 'Produk oke untuk hewan peliharaan.'],
            ['rating' => 4, 'comment' => 'Bahan berkualitas, aman untuk pet.'],
            ['rating' => 3, 'comment' => 'Pet saya kurang suka, mungkin tidak cocok.'],
            ['rating' => 3, 'comment' => 'Kualitas standar, ekspektasi lebih tinggi.'],
            ['rating' => 3, 'comment' => 'Biasa aja, tidak ada yang spesial.'],
        ],
        'mainan' => [
            ['rating' => 5, 'comment' => 'Anak saya senang banget! Kualitas bagus!'],
            ['rating' => 5, 'comment' => 'Edukatif dan menyenangkan. Worth it!'],
            ['rating' => 5, 'comment' => 'Bahan aman untuk anak, tidak tajam.'],
            ['rating' => 5, 'comment' => 'Kualitas bagus, warna cerah menarik!'],
            ['rating' => 5, 'comment' => 'Mainan berkualitas, anak betah main!'],
            ['rating' => 5, 'comment' => 'Detail bagus, cat tidak mudah luntur.'],
            ['rating' => 4, 'comment' => 'Anak suka, kualitas lumayan bagus.'],
            ['rating' => 4, 'comment' => 'Mainan bagus untuk usia anak saya.'],
            ['rating' => 4, 'comment' => 'Kualitas oke, warna cerah menarik.'],
            ['rating' => 4, 'comment' => 'Bahan cukup tebal dan tahan lama.'],
            ['rating' => 3, 'comment' => 'Biasa aja, anak cepat bosan.'],
            ['rating' => 3, 'comment' => 'Kualitas standar untuk harga segini.'],
            ['rating' => 3, 'comment' => 'Lumayan, tapi ada yang lebih bagus.'],
        ],
        'otomotif' => [
            ['rating' => 5, 'comment' => 'Performa mesin jadi lebih halus! Top quality!'],
            ['rating' => 5, 'comment' => 'Original product! Kualitas terjamin!'],
            ['rating' => 5, 'comment' => 'Pas banget, kualitas premium!'],
            ['rating' => 5, 'comment' => 'Kualitas premium, harga bersaing!'],
            ['rating' => 5, 'comment' => 'Material kokoh dan tahan lama!'],
            ['rating' => 5, 'comment' => 'Performa maksimal, kualitas terbaik!'],
            ['rating' => 4, 'comment' => 'Produk bagus, kualitas oke.'],
            ['rating' => 4, 'comment' => 'Kualitas oke, sesuai dengan spesifikasi.'],
            ['rating' => 4, 'comment' => 'Lumayan bagus untuk daily use.'],
            ['rating' => 4, 'comment' => 'Material cukup bagus, tahan lama.'],
            ['rating' => 3, 'comment' => 'Standar aja, tidak ada perbedaan signifikan.'],
            ['rating' => 3, 'comment' => 'Kualitas biasa, ekspektasi lebih tinggi.'],
            ['rating' => 3, 'comment' => 'Produk standar, banyak alternatif lain.'],
        ],
    ];

    // Nama-nama Indonesia untuk reviewer
    private array $firstNames = [
        'Andi', 'Budi', 'Citra', 'Dewi', 'Eko', 'Fitri', 'Galih', 'Hendra', 'Indah', 'Joko',
        'Kartika', 'Lina', 'Made', 'Nadia', 'Oscar', 'Putri', 'Qori', 'Rina', 'Sari', 'Tono',
        'Udin', 'Vina', 'Wati', 'Xena', 'Yudi', 'Zahra', 'Agus', 'Bambang', 'Cindy', 'Dian',
        'Endang', 'Fajar', 'Gita', 'Hani', 'Irfan', 'Jihan', 'Kevin', 'Laras', 'Maya', 'Niko',
        'Oktavia', 'Prasetyo', 'Ratna', 'Surya', 'Tika', 'Utami', 'Vera', 'Wahyu', 'Yanti', 'Zaki',
        'Adit', 'Bella', 'Chandra', 'Dimas', 'Erni', 'Farel', 'Gunawan', 'Hilda', 'Ivan', 'Jasmine',
        'Kiki', 'Lia', 'Mira', 'Nanda', 'Oki', 'Puspita', 'Raka', 'Sinta', 'Tara', 'Umar',
        'Vivi', 'Wulan', 'Yoga', 'Zara', 'Arif', 'Bunga', 'Caca', 'Doni', 'Elsa', 'Ferdi',
    ];

    private array $lastNames = [
        'Wijaya', 'Susanto', 'Pratama', 'Saputra', 'Hidayat', 'Santoso', 'Permana', 'Nugroho', 'Kurniawan', 'Putra',
        'Wibowo', 'Setiawan', 'Hartono', 'Suryadi', 'Lestari', 'Kusuma', 'Ramadhan', 'Firmansyah', 'Pradipta', 'Mahendra',
        'Utomo', 'Handoko', 'Sugiarto', 'Budiman', 'Wicaksono', 'Gunawan', 'Hermawan', 'Suharto', 'Pranoto', 'Sutrisno',
    ];

    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $products = Product::all();
        $totalReviews = 0;

        foreach ($products as $product) {
            // Random 30-60 reviews per product
            $reviewCount = rand(30, 60);
            
            // Determine category type for specific reviews
            $categoryType = $this->getCategoryType($product->category);
            
            // Weight distribution to achieve average 3-5 stars
            // More 4-5 stars, fewer 1-2 stars
            $ratingWeights = [
                5 => 35, // 35% chance
                4 => 35, // 35% chance  
                3 => 20, // 20% chance
                2 => 7,  // 7% chance
                1 => 3,  // 3% chance
            ];

            $reviews = [];
            
            for ($i = 0; $i < $reviewCount; $i++) {
                // Generate weighted random rating
                $rating = $this->getWeightedRating($ratingWeights);
                
                // 60% chance to use specific review, 40% general
                $useSpecific = rand(1, 100) <= 60 && isset($this->categoryReviews[$categoryType]);
                
                if ($useSpecific) {
                    $comment = $this->getReviewByRating($this->categoryReviews[$categoryType], $rating);
                } else {
                    $comment = $this->getReviewByRating($this->generalReviews, $rating);
                }
                
                // If no matching review found, use general
                if (!$comment) {
                    $comment = $this->getReviewByRating($this->generalReviews, $rating);
                }
                
                // Fallback comment
                if (!$comment) {
                    $comment = $this->generateFallbackComment($rating);
                }

                $reviews[] = [
                    'product_id' => $product->id,
                    'name' => $this->generateName(),
                    'email' => $faker->unique()->safeEmail(),
                    'provinsi' => $this->provinces[array_rand($this->provinces)],
                    'rating' => $rating,
                    'comment' => $comment,
                    'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                    'updated_at' => now(),
                ];
            }

            // Batch insert for performance
            ProductGuestReview::insert($reviews);
            $totalReviews += $reviewCount;

            // Update product average rating and review count
            $avgRating = collect($reviews)->avg('rating');
            $product->update([
                'average_rating' => round($avgRating, 1),
                'reviews_count' => $reviewCount,
            ]);

            // Reset faker unique
            $faker->unique(true);
        }

        $this->command->info("GuestReviewSeeder: {$totalReviews} reviews created for " . $products->count() . " products!");
    }

    private function getCategoryType(string $category): string
    {
        $categoryMap = [
            // Fashion
            'fashion-wanita' => 'fashion',
            'fashion-pria' => 'fashion',
            'fashion-muslim' => 'fashion',
            'busana-anak-bayi' => 'fashion',
            'sepatu-pria' => 'fashion',
            'sepatu-wanita' => 'fashion',
            'sandal-slipper' => 'fashion',
            'tas-wanita' => 'fashion',
            'tas-pria' => 'fashion',
            'jam-tangan' => 'fashion',
            'aksesoris-fashion' => 'fashion',
            'emas-perhiasan' => 'fashion',
            'fashion-lokal-umkm' => 'fashion',
            
            // Kecantikan
            'kecantikan-perawatan' => 'kecantikan',
            'perawatan-kulit' => 'kecantikan',
            'kesehatan' => 'kecantikan',
            'kesehatan-herbal' => 'kecantikan',
            'ibu-bayi' => 'hewan', // parenting related
            
            // Rumah
            'perlengkapan-rumah' => 'rumah',
            'dapur-masak' => 'rumah',
            'furnitur' => 'rumah',
            'dekorasi-rumah' => 'rumah',
            'elektronik-rumah' => 'rumah',
            'peralatan-taman' => 'rumah',
            'pertukangan' => 'rumah',
            
            // Elektronik
            'handphone-aksesoris' => 'elektronik',
            'laptop-aksesoris' => 'elektronik',
            'komputer-komponen' => 'elektronik',
            'kamera-aksesoris' => 'elektronik',
            'gaming-console' => 'elektronik',
            'fotografi-videografi' => 'elektronik',
            
            // Hobi
            'hobi-koleksi' => 'hobi',
            'olahraga-outdoor' => 'hobi',
            'camping-hiking' => 'hobi',
            'alat-musik' => 'hobi',
            'buku-alat-tulis' => 'hobi',
            
            // Otomotif
            'otomotif-mobil' => 'otomotif',
            'otomotif-motor' => 'otomotif',
            
            // Makanan
            'makanan-minuman' => 'makanan',
            'bahan-kue-sembako' => 'makanan',
            
            // Hewan
            'hewan-peliharaan' => 'hewan',
            
            // Mainan
            'mainan-edukasi' => 'mainan',
            'perlengkapan-sekolah' => 'mainan',
        ];

        return $categoryMap[$category] ?? 'hobi';
    }

    private function getWeightedRating(array $weights): int
    {
        $rand = rand(1, 100);
        $cumulative = 0;
        
        foreach ($weights as $rating => $weight) {
            $cumulative += $weight;
            if ($rand <= $cumulative) {
                return $rating;
            }
        }
        
        return 4; // Default
    }

    private function getReviewByRating(array $reviews, int $rating): ?string
    {
        $filtered = array_filter($reviews, fn($r) => $r['rating'] === $rating);
        
        if (empty($filtered)) {
            // Try adjacent ratings
            $filtered = array_filter($reviews, fn($r) => abs($r['rating'] - $rating) <= 1);
        }
        
        if (empty($filtered)) {
            return null;
        }
        
        $selected = $filtered[array_rand($filtered)];
        return $selected['comment'];
    }

    private function generateFallbackComment(int $rating): string
    {
        $comments = [
            5 => ['Sangat bagus!', 'Excellent!', 'Highly recommended!', 'Perfect!', 'Kualitas top!'],
            4 => ['Bagus!', 'Good quality!', 'Recommended!', 'Nice product!', 'Worth it!'],
            3 => ['Lumayan', 'Cukup oke', 'Standar', 'Biasa aja', 'So so'],
            2 => ['Kurang bagus', 'Mengecewakan', 'Not recommended', 'Kurang puas'],
            1 => ['Sangat mengecewakan', 'Kualitas buruk', 'Tidak layak'],
        ];

        $pool = $comments[$rating] ?? $comments[3];
        return $pool[array_rand($pool)];
    }

    private function generateName(): string
    {
        $firstName = $this->firstNames[array_rand($this->firstNames)];
        $lastName = $this->lastNames[array_rand($this->lastNames)];
        
        // 70% chance to use full name, 30% just first name
        return rand(1, 100) <= 70 ? "{$firstName} {$lastName}" : $firstName;
    }
}
