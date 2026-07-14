<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Database\Seeders\RolesAndPermissionsSeeder;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        $users = [

            [
        "name" => "ميكي ماوس",
        "username" => "mickey_mouse",
        "bio" => "ميكي ماوس هو أشهر شخصيات ديزني ويُعرف بروحه المرحة ومغامراته الممتعة مع أصدقائه.",
        "email" => "mickey@mail.com",
        "password" => "password",
    ],

    [
        "name" => "ميني ماوس",
        "username" => "minnie_mouse",
        "bio" => "ميني ماوس هي صديقة ميكي وتتميز بأناقتها ولطفها وحبها لمساعدة الآخرين.",
        "email" => "minnie@mail.com",
        "password" => "password",
    ],

    [
        "name" => "دونالد داك",
        "username" => "donald_duck",
        "bio" => "دونالد داك بطة مشهورة من ديزني معروفة بطباعها الغاضبة ولكنها طيبة القلب.",
        "email" => "donald@mail.com",
        "password" => "password",
    ],

    [
        "name" => "جوفي",
        "username" => "goofy",
        "bio" => "جوفي شخصية مرحة وعفوية، يشتهر بمواقفه الكوميدية وإخلاصه لأصدقائه.",
        "email" => "goofy@mail.com",
        "password" => "password",
    ],

    [
        "name" => "بلوتو",
        "username" => "pluto",
        "bio" => "بلوتو هو الكلب الوفي لميكي ماوس ويشارك في العديد من المغامرات الممتعة.",
        "email" => "pluto@mail.com",
        "password" => "password",
    ],

    [
        "name" => "سيمبا",
        "username" => "simba",
        "bio" => "سيمبا هو بطل فيلم الأسد الملك، ويتعلم معنى المسؤولية والشجاعة خلال رحلته.",
        "email" => "simba@mail.com",
        "password" => "password",
    ],

    [
        "name" => "إلسا",
        "username" => "elsa",
        "bio" => "إلسا هي ملكة أريندل وتملك قدرة سحرية على التحكم بالجليد والثلج.",
        "email" => "elsa@mail.com",
        "password" => "password",
    ],

    [
        "name" => "آنا",
        "username" => "anna",
        "bio" => "آنا هي أخت إلسا، وتتميز بشجاعتها وتفاؤلها وإخلاصها لعائلتها.",
        "email" => "anna@mail.com",
        "password" => "password",
    ],

    [
        "name" => "علاء الدين",
        "username" => "aladdin",
        "bio" => "علاء الدين شاب مغامر يعثر على مصباح سحري يغيّر حياته ويقوده إلى تحقيق أحلامه.",
        "email" => "aladdin@mail.com",
        "password" => "password",
    ],

    [
        "name" => "باز يطير",
        "username" => "buzz_lightyear",
        "bio" => "باز يطير هو حارس فضاء شجاع من سلسلة توي ستوري، يؤمن بحماية أصدقائه وخوض المغامرات.",
        "email" => "buzz@mail.com",
        "password" => "password",
    ],

        ];


        $categories = [
            ' ماذا لو ؟',
            'نظريات',
            'جغرافيا',
            'التاريخ العسكري',
            'حروب عالمية',
            'تحليلات',
            'الأسئلة',
            'إقتراحات',
            'دول'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'bio' => $user['bio'],
                'email' => $user['email'],
                'password' => $user['password'],

            ]);
        }

        Post::factory(50)->create();
    }

}


