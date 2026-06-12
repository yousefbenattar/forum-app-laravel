<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Post;
use App\Models\Stat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [

            [
                "name" => "Adolf Hitler",
                "username" => "adolf_hitler",
                "bio" => "Adolf Hitler was an Austrian-born German politician who led Germany from 1933 to 1945 as head of the Nazi regime.",
                "email" => "adolfhitler@mail.com",
                "password" => "password",
            ],

            [
                "name" => "Joseph Stalin",
                "username" => "joseph_stalin",
                "bio" => "Joseph Stalin was the leader of the Soviet Union from the mid-1920s until 1953, overseeing industrialization and World War II mobilization.",
                "email" => "josephstalin@mail.com",
                "password" => "password",
            ],

            [
                "name" => "Winston Churchill",
                "username" => "winston_churchill",
                "bio" => "Winston Churchill served as Prime Minister of the United Kingdom during World War II and is known for his leadership and speeches.",
                "email" => "winstonchurchill@mail.com",
                "password" => "password",
            ],

            [
                "name" => "Franklin D. Roosevelt",
                "username" => "franklin_roosevelt",
                "bio" => "Franklin D. Roosevelt was the 32nd President of the United States and led the country through the Great Depression and most of World War II.",
                "email" => "fdr@mail.com",
                "password" => "password",
            ],

            [
                "name" => "Benito Mussolini",
                "username" => "benito_mussolini",
                "bio" => "Benito Mussolini was the leader of Fascist Italy from 1922 to 1943 and an ally of Nazi Germany during World War II.",
                "email" => "mussolini@mail.com",
                "password" => "password",
            ],

            [
                "name" => "Josip Broz Tito",
                "username" => "josip_tito",
                "bio" => "Josip Broz Tito was the president of Yugoslavia and led the country as a socialist federation after World War II.",
                "email" => "tito@mail.com",
                "password" => "password",
            ],

            [
                "name" => "Mao Zedong",
                "username" => "mao_zedong",
                "bio" => "Mao Zedong was the founding leader of the People's Republic of China and chairman of the Chinese Communist Party.",
                "email" => "mao@mail.com",
                "password" => "password",
            ],

            [
                "name" => "Chiang Kai-shek",
                "username" => "chiang_kaishek",
                "bio" => "Chiang Kai-shek was a Chinese political and military leader who headed the Republic of China government before relocating to Taiwan.",
                "email" => "chiang@mail.com",
                "password" => "password",
            ],

            [
                "name" => "Hirohito",
                "username" => "hirohito",
                "bio" => "Hirohito was the Emperor of Japan from 1926 to 1989, including during the period of World War II.",
                "email" => "hirohito@mail.com",
                "password" => "password",
            ],

            [
                "name" => "Charles de Gaulle",
                "username" => "charles_degaulle",
                "bio" => "Charles de Gaulle was a French general and statesman who led Free France during World War II and later became President of France.",
                "email" => "degaulle@mail.com",
                "password" => "password",
            ],

        ];

        
        //  $categories = [
        //      ' ماذا لو ؟','نظريات','جغرافيا','التاريخ العسكري','حروب عالمية','تحليلات','الأسئلة','إقتراحات'
        //  ];
        $categories = [
            'دول'];
         foreach ($categories as $category) {
             Category::create([
                 'name' => $category,
                 'slug' => Str::slug($category),
             ]);
         }
        //   foreach ($users as $user) {
        //       User::create([
        //           'name' => $user['name'],
        //           'username' => $user['username'],
        //           'bio' => $user['bio'],
        //           'email' => $user['email'],
        //           'password' => $user['password'],

        //       ]);
        //   }

    }
}
