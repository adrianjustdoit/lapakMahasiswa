<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        // 6 penjual contoh yang sudah terverifikasi sesuai kategori utama
        $sellers = [
            [
                // Kategori: Fashion
                'name'            => 'Ahmad Fashion',
                'email'           => 'seller1@lapak.test',
                'password'        => 'password',
                'shop_name'       => 'Toko Fashion Terkeren',
                'shop_description'=> 'Pusat fashion mahasiswa dengan koleksi terlengkap! Tersedia baju, celana, jaket, sepatu, tas, dan aksesoris trendy dengan harga ramah kantong mahasiswa.',
                'pic_name'        => 'Ahmad Wijaya',
                'pic_phone'       => '081234567801',
                'pic_email'       => 'ahmad.fashion@gmail.com',
                'pic_address'     => 'Jl. Fashion Street No. 10',
                'rt'              => '01',
                'rw'              => '02',
                'kelurahan'       => 'Sukajadi',
                'kecamatan'       => 'Sukajadi',
                'kota'            => 'Bandung',
                'provinsi'        => 'Jawa Barat',
                'pic_id_number'   => '3273010101900001',
            ],
            [
                // Kategori: Kecantikan
                'name'            => 'Bella Kecantikan',
                'email'           => 'seller2@lapak.test',
                'password'        => 'password',
                'shop_name'       => 'Toko Kecantikan Terlengkap',
                'shop_description'=> 'Solusi kecantikan mahasiswa! Tersedia skincare, makeup, parfum, perawatan rambut, dan produk kecantikan lainnya dengan harga terjangkau dan kualitas terjamin.',
                'pic_name'        => 'Bella Permata',
                'pic_phone'       => '081234567802',
                'pic_email'       => 'bella.kecantikan@gmail.com',
                'pic_address'     => 'Jl. Kecantikan No. 25',
                'rt'              => '03',
                'rw'              => '04',
                'kelurahan'       => 'Coblong',
                'kecamatan'       => 'Coblong',
                'kota'            => 'Bandung',
                'provinsi'        => 'Jawa Barat',
                'pic_id_number'   => '3273010201950002',
            ],
            [
                // Kategori: Rumah
                'name'            => 'Citra Rumah',
                'email'           => 'seller3@lapak.test',
                'password'        => 'password',
                'shop_name'       => 'Toko Rumah Termurah',
                'shop_description'=> 'Lengkapi kebutuhan kos dan rumah tangga Anda! Tersedia peralatan dapur, dekorasi kamar, furniture mini, organizer, dan perlengkapan rumah lainnya.',
                'pic_name'        => 'Citra Dewi',
                'pic_phone'       => '081234567803',
                'pic_email'       => 'citra.rumah@gmail.com',
                'pic_address'     => 'Jl. Rumah Asri No. 15',
                'rt'              => '05',
                'rw'              => '06',
                'kelurahan'       => 'Cibeunying Kaler',
                'kecamatan'       => 'Cibeunying Kaler',
                'kota'            => 'Bandung',
                'provinsi'        => 'Jawa Barat',
                'pic_id_number'   => '3273010302980003',
            ],
            [
                // Kategori: Elektronik
                'name'            => 'Dimas Elektronik',
                'email'           => 'seller4@lapak.test',
                'password'        => 'password',
                'shop_name'       => 'Toko Elektronik Terlengkap',
                'shop_description'=> 'Menyediakan berbagai perangkat elektronik berkualitas untuk kebutuhan mahasiswa. Mulai dari laptop, smartphone, headset, charger, dan aksesoris elektronik lainnya dengan harga terjangkau.',
                'pic_name'        => 'Dimas Prasetyo',
                'pic_phone'       => '081234567804',
                'pic_email'       => 'dimas.elektronik@gmail.com',
                'pic_address'     => 'Jl. Elektronik No. 5',
                'rt'              => '07',
                'rw'              => '08',
                'kelurahan'       => 'Dago',
                'kecamatan'       => 'Coblong',
                'kota'            => 'Bandung',
                'provinsi'        => 'Jawa Barat',
                'pic_id_number'   => '3273010403970004',
            ],
            [
                // Kategori: Hobi
                'name'            => 'Eka Hobi',
                'email'           => 'seller5@lapak.test',
                'password'        => 'password',
                'shop_name'       => 'Toko Hobi Terfavorit',
                'shop_description'=> 'Surganya pecinta hobi! Tersedia alat musik, perlengkapan olahraga, game, action figure, dan berbagai kebutuhan hobi lainnya untuk mahasiswa.',
                'pic_name'        => 'Eka Putra',
                'pic_phone'       => '081234567805',
                'pic_email'       => 'eka.hobi@gmail.com',
                'pic_address'     => 'Jl. Hobi Kreatif No. 20',
                'rt'              => '09',
                'rw'              => '10',
                'kelurahan'       => 'Sekeloa',
                'kecamatan'       => 'Coblong',
                'kota'            => 'Bandung',
                'provinsi'        => 'Jawa Barat',
                'pic_id_number'   => '3273010504960005',
            ],
            [
                // Kategori: Lainnya
                'name'            => 'Fajar Lainnya',
                'email'           => 'seller6@lapak.test',
                'password'        => 'password',
                'shop_name'       => 'Toko Serba Ada',
                'shop_description'=> 'Toko serba ada untuk mahasiswa! Tersedia berbagai produk unik, jasa, makanan, alat tulis, dan kebutuhan lainnya yang tidak termasuk kategori utama.',
                'pic_name'        => 'Fajar Hidayat',
                'pic_phone'       => '081234567806',
                'pic_email'       => 'fajar.lainnya@gmail.com',
                'pic_address'     => 'Jl. Serba Ada No. 30',
                'rt'              => '11',
                'rw'              => '12',
                'kelurahan'       => 'Lebak Gede',
                'kecamatan'       => 'Coblong',
                'kota'            => 'Bandung',
                'provinsi'        => 'Jawa Barat',
                'pic_id_number'   => '3273010605990006',
            ],
        ];

        foreach ($sellers as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'              => $data['name'],
                    'password'          => Hash::make($data['password']),
                    'shop_name'         => $data['shop_name'],
                    'shop_description'  => $data['shop_description'],
                    'pic_name'          => $data['pic_name'],
                    'pic_phone'         => $data['pic_phone'],
                    'pic_email'         => $data['pic_email'],
                    'pic_address'       => $data['pic_address'],
                    'rt'                => $data['rt'],
                    'rw'                => $data['rw'],
                    'kelurahan'         => $data['kelurahan'],
                    'kecamatan'         => $data['kecamatan'],
                    'kota'              => $data['kota'],
                    'provinsi'          => $data['provinsi'],
                    'pic_id_number'     => $data['pic_id_number'],
                    'email_verified_at' => now(),
                    'seller_status'     => 'approved',
                    'is_admin'          => false,
                ]
            );
        }
    }
}
