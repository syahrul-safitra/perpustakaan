<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'adminperpus@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);

        // \App\Models\Category::create([
        //     'nama' => 'Sastra'
        // ]);

        // \App\Models\Category::create([
        //     'nama' => 'Novel'
        // ]);

        // \App\Models\Category::create([
        //     'nama' => 'Sains'
        // ]);

        // \App\Models\book::create([
        //     'judul' => 'Anak Semua Bangsa',
        //     'penulis' => 'Pramoedya Anate Toer',
        //     'tahun_terbit' => '2000-08-08',
        //     'deskripsi' => 'TESTT',
        //     'gambar' => 'test.jpg',
        //     'berkas' => 'test.pdf',
        //     'stok' => 5,
        //     'category_id' => 1
        // ]);

        // \App\Models\book::create([
        //     'judul' => 'Bumi Manusia',
        //     'penulis' => 'Pramoedya Anate Toer',
        //     'tahun_terbit' => '2000-08-08',
        //     'deskripsi' => 'TESTT',
        //     'gambar' => 'test.jpg',
        //     'berkas' => 'test.pdf',
        //     'stok' => 5,
        //     'category_id' => 1
        // ]);

        // \App\Models\book::create([
        //     'judul' => 'Rumah Kaca',
        //     'penulis' => 'Pramoedya Anate Toer',
        //     'tahun_terbit' => '2000-08-08',
        //     'deskripsi' => 'TESTT',
        //     'gambar' => 'test.jpg',
        //     'berkas' => 'test.pdf',
        //     'stok' => 5,
        //     'category_id' => 1
        // ]);

        // \App\Models\book::create([
        //     'judul' => 'Bumi',
        //     'penulis' => 'Tere Liye',
        //     'tahun_terbit' => '2000-08-08',
        //     'deskripsi' => 'TESTT',
        //     'gambar' => 'test.jpg',
        //     'berkas' => 'test.pdf',
        //     'stok' => 5,
        //     'category_id' => 2
        // ]);

        // \App\Models\book::create([
        //     'judul' => 'Matahari',
        //     'penulis' => 'Tere Liye',
        //     'tahun_terbit' => '2000-08-08',
        //     'deskripsi' => 'TESTT',
        //     'gambar' => 'test.jpg',
        //     'berkas' => 'test.pdf',
        //     'stok' => 5,
        //     'category_id' => 2
        // ]);

        // \App\Models\book::create([
        //     'judul' => 'Bulan',
        //     'penulis' => 'Tere Liye',
        //     'tahun_terbit' => '2000-08-08',
        //     'deskripsi' => 'TESTT',
        //     'gambar' => 'test.jpg',
        //     'berkas' => 'test.pdf',
        //     'stok' => 5,
        //     'category_id' => 2
        // ]);

        // \App\Models\book::create([
        //     'judul' => 'Game Theory',
        //     'penulis' => 'John F. Nash',
        //     'tahun_terbit' => '2000-08-08',
        //     'deskripsi' => 'TESTT',
        //     'gambar' => 'test.jpg',
        //     'berkas' => 'test.pdf',
        //     'stok' => 5,
        //     'category_id' => 3
        // ]);

        // \App\Models\book::create([
        //     'judul' => 'Selfish Genetics',
        //     'penulis' => 'Richard Dawkins',
        //     'tahun_terbit' => '2000-08-08',
        //     'deskripsi' => 'TESTT',
        //     'gambar' => 'test.jpg',
        //     'berkas' => 'test.pdf',
        //     'stok' => 5,
        //     'category_id' => 3
        // ]);

        // \App\Models\book::create([
        //     'judul' => 'Evolutions',
        //     'penulis' => 'Charles Darwin',
        //     'tahun_terbit' => '2000-08-08',
        //     'deskripsi' => 'TESTT',
        //     'gambar' => 'test.jpg',
        //     'berkas' => 'test.pdf',
        //     'stok' => 5,
        //     'category_id' => 3
        // ]);

    }
}
