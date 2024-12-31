<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $cinemas = [
            [
                'title' => 'The lord of the rings. The fellowship of the ring',
                'description' => 'Lorem ipsum dolor sit amet',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/ru/archive/0/08/20060425181629%21The_Lord_of_the_Rings._The_Fellowship_of_the_Ring_%E2%80%94_movie.jpg'
            ],
            [
                'title' => 'Harry Potter and philosophic stone',
                'description' => 'About Harry Potter',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/ru/b/b4/Harry_Potter_and_the_Philosopher%27s_Stone_%E2%80%94_movie.jpg'
            ],
            [
                'title' => 'Harry Potter and secret room',
                'description' => 'About Harry Potter and secret room',
                'image_url' => 'https://ru-images-s.kinorium.com/movie/1080/235709.jpg?1588852564'
            ],
            [
                'title' => 'Harry Potter and the order of the Phoenix',
                'description' => 'About Harry Potter and orden of the Phoenix',
                'image_url' => 'https://lh3.googleusercontent.com/proxy/N26CMAWUiAMVmADxO1lJ1jLNIUQEGRKtjNFt9JC9RJYVyjP06lBvnvxvaVpkkM8TSgmbHd_CstnSIfIFexCgegA02TGI5-rSLG3cX56cLhgF1tZz0BEmt9z38RdzT5xL8sLIdmU8-hy18q0PLhmK1gevXz_8ew'
            ]
        ];

        foreach ($cinemas as $cinema) {
            Cinema::create($cinema);
        }
    }
}
