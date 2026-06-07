<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Seed Users
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@rideu.com'],
            [
                'name' => 'Admin RideU',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        \App\Models\User::updateOrCreate(
            ['email' => 'user@rideu.com'],
            [
                'name' => 'User RideU',
                'password' => bcrypt('password'),
                'role' => 'user',
            ]
        );

        // Seed Motors
        $motors = [
            [
                'name' => 'Yamaha Aerox 155',
                'brand' => 'Yamaha',
                'type' => 'Matic',
                'price' => 120000,
                'image' => 'aerox.jpg',
                'fuel' => '5.5L',
                'transmission' => 'Matic',
                'status' => 'available',
                'desc' => 'Yamaha Aerox 155cc menawarkan berkendara sporty dengan mesin bertenaga dan teknologi VVA, sangat nyaman digunakan untuk berkendara harian maupun perjalanan jauh.',
            ],
            [
                'name' => 'Honda Beat 110',
                'brand' => 'Honda',
                'type' => 'Matic',
                'price' => 75000,
                'image' => 'beat.jpg',
                'fuel' => '4.2L',
                'transmission' => 'Matic',
                'status' => 'available',
                'desc' => 'Honda Beat 110cc adalah rajanya efisiensi bahan bakar. Bodinya yang ramping membuatnya sangat lincah melintasi kemacetan jalanan di sekitar kampus.',
            ],
            [
                'name' => 'Honda Genio 110',
                'brand' => 'Honda',
                'type' => 'Matic',
                'price' => 80000,
                'image' => 'genio.jpg',
                'fuel' => '4.2L',
                'transmission' => 'Matic',
                'status' => 'available',
                'desc' => 'Honda Genio tampil dengan desain casual-retro yang modern dan fashionable. Sangat cocok bagi mahasiswa yang ingin tetap tampil trendi dan hemat.',
            ],
            [
                'name' => 'Yamaha Mio M3 125',
                'brand' => 'Yamaha',
                'type' => 'Matic',
                'price' => 70000,
                'image' => 'mio.jpg',
                'fuel' => '4.2L',
                'transmission' => 'Matic',
                'status' => 'available',
                'desc' => 'Yamaha Mio M3 hadir dengan mesin Blue Core 125cc yang bertenaga namun tetap irit. Pilihan ekonomis terbaik untuk mobilitas harian Anda.',
            ],
            [
                'name' => 'Yamaha Nmax 155',
                'brand' => 'Yamaha',
                'type' => 'Matic',
                'price' => 130000,
                'image' => 'nmax.png',
                'fuel' => '7.1L',
                'transmission' => 'Matic',
                'status' => 'available',
                'desc' => 'Yamaha Nmax 155cc memberikan kenyamanan premium berkendara ala skutik maxi. Posisi berkendara yang rileks sangat cocok untuk perjalanan jauh.',
            ],
            [
                'name' => 'Honda PCX 160',
                'brand' => 'Honda',
                'type' => 'Matic',
                'price' => 135000,
                'image' => 'pcx.jpg',
                'fuel' => '8.1L',
                'transmission' => 'Matic',
                'status' => 'available',
                'desc' => 'Honda PCX 160cc mengusung desain mewah nan elegan dengan mesin eSP+ terbaru yang lebih responsif. Memberikan performa berkendara kelas atas.',
            ],
            [
                'name' => 'Honda Scoopy 110',
                'brand' => 'Honda',
                'type' => 'Matic',
                'price' => 85000,
                'image' => 'scoopy.jpg',
                'fuel' => '4.2L',
                'transmission' => 'Matic',
                'status' => 'available',
                'desc' => 'Honda Scoopy merupakan motor matik retro terpopuler dengan fitur modern seperti charger HP dan kunci keyless. Sangat disukai oleh para mahasiswa.',
            ],
            [
                'name' => 'Honda Vario 160',
                'brand' => 'Honda',
                'type' => 'Matic',
                'price' => 95000,
                'image' => 'vario.jpg',
                'fuel' => '5.5L',
                'transmission' => 'Matic',
                'status' => 'available',
                'desc' => 'Honda Vario 160cc memiliki desain yang tajam dan agresif dengan performa mesin matik sport yang lincah dan bagasi penyimpanan helm yang cukup luas.',
            ],
        ];

        foreach ($motors as $motor) {
            \App\Models\Motor::updateOrCreate(
                ['name' => $motor['name']],
                $motor
            );
        }

        // Bikin 10 data post dummy
        \App\Models\Post::factory(10)->create();
    }
}
