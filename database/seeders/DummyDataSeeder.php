<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Advertisement;
use App\Models\Contact;
use App\Models\Subscription;
use App\Models\Category;
use App\Models\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();
        Post::truncate();
        Advertisement::truncate();
        DB::table('advertisement_position')->truncate();
        Contact::truncate();
        Subscription::truncate();
        Category::truncate();
        Position::truncate();

        Schema::enableForeignKeyConstraints();

        // Seed positions
        $positions = [
            ['name' => 'Top Banner', 'slug' => 'top-banner'],
            ['name' => 'Sidebar Square', 'slug' => 'sidebar-square'],
            ['name' => 'Content Middle', 'slug' => 'content-middle'],
            ['name' => 'Middle Left', 'slug' => 'middle-left'],
        ];
        DB::table('positions')->insert($positions);


        // Create default admin
        User::create(
            [
                'name' => 'SAJ',
                'email' => 'sajnushhossain.cse@gmail.com',
                'password' => Hash::make('sajnush'),
                'role' => 'admin',
            ]
        );

        // Create some users
        $user1 = User::create(
            [
                'name' => 'Bangla User',
                'email' => 'bangla.user@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        $user2 = User::create(
            [
                'name' => 'English User',
                'email' => 'english.user@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        // Create some categories if they don't exist
        $categories = [
            'National' => 'national',
            'International' => 'international',
            'Sports' => 'sports',
            'Entertainment' => 'entertainment',
            'Science & Technology' => 'science-technology',
            'Lifestyle' => 'lifestyle',
            'Education' => 'education',
            'Opinion' => 'opinion',
        ];

        foreach ($categories as $name => $slug) {
            Category::firstOrCreate(['slug' => $slug], ['name' => $name]);
        }

        $categoryIds = Category::pluck('id')->toArray();

        // Create some dummy posts with Bangladeshi content
        $posts = [
            [
                'title' => 'New Horizon in Economy after Padma Bridge Inauguration',
                'body' => 'The Padma Bridge has opened a new horizon in Bangladesh\'s economy. With direct connectivity established with the southwestern region of the country, trade and investment have gained momentum.',
                'image' => 'https://images.prothomalo.com/prothomalo-bangla%2F2023-09%2F31dd3e93-519f-4448-95d1-cf378037e96e%2Fpadda_shethu.webp?rect=0%2C0%2C1200%2C800&auto=format%2Ccompress&fmt=webp&w=640',
                'user_id' => $user1->id,
            ],
            [
                'title' => 'Arrival of New Coach for Bangladesh Cricket Team',
                'body' => 'A new coach has been appointed for the Bangladesh cricket team. His arrival has brought new enthusiasm among the team.',
                 'image' => 'https://images.prothomalo.com/prothomalo-bangla%2F2024-03%2F73549f6b-1934-4589-9486-1d16f8b1e4f4%2FICH_6426.webp?auto=format%2Ccompress&fmt=webp&w=640',
                 'user_id' => $user2->id,
            ],
            [
                'title' => 'Discovery of New Planet in Space',
                'body' => 'Astronomers have recently discovered a new planet in space. It is believed that this planet might be similar to Earth.',
                 'image' => 'https://images.prothomalo.com/prothomalo-bangla%2F2024-03%2F96b738b0-819a-471f-a5f1-3057b54ab69e%2Fhandout_photo_of_super_earth.webp?auto=format%2Ccompress&fmt=webp&w=640',
                 'user_id' => $user1->id,
            ],
            [
                'title' => 'Bangladeshi Students Shine in International Olympiad',
                'body' => 'Students from Bangladesh have achieved remarkable success in the International Mathematical Olympiad, winning several gold and silver medals.',
                'image' => 'https://images.prothomalo.com/prothomalo-bangla%2F2023-07%2Fda43cce1-84f3-4299-a868-24c1e4c9258a%2FIMG_20230723_153128.jpg?auto=format%2Ccompress&fmt=webp&w=640',
                'user_id' => $user2->id,
            ],
            [
                'title' => 'New Metro Rail Line Opens in Dhaka',
                'body' => 'A new line of the Dhaka Metro Rail has been inaugurated, which is expected to ease traffic congestion in the city significantly.',
                'image' => 'https://images.prothomalo.com/prothomalo-bangla%2F2023-10%2F6d7f6b5a-3f0e-4a6f-8d2a-7c9e1f5a9b3f%2Fmetro_rail.jpg?auto=format%2Ccompress&fmt=webp&w=640',
                'user_id' => $user1->id,
            ],
        ];

        foreach ($posts as $postData) {
            Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'body' => $postData['body'],
                'image' => $postData['image'],
                'user_id' => $postData['user_id'],
                'category_id' => $categoryIds[array_rand($categoryIds)],
            ]);
        }

        // Create some dummy advertisements
        $ad1 = Advertisement::create(
            [
                'title' => 'Dummy Ad 1',
                'image_path' => 'https://via.placeholder.com/728x90.png?text=Advertisement+1',
                'target_url' => '#',
                'is_active' => true,
            ]
        );
        $ad1->positions()->attach(1);

        $ad2 = Advertisement::create(
            [
                'title' => 'Dummy Ad 2',
                'image_path' => 'https://via.placeholder.com/300x250.png?text=Advertisement+2',
                'target_url' => '#',
                'is_active' => true,
            ]
        );
        $ad2->positions()->attach(2);

        $ad3 = Advertisement::create(
            [
                'title' => 'Dummy Ad 3',
                'image_path' => 'https://via.placeholder.com/300x600.png?text=Advertisement+3',
                'target_url' => '#',
                'is_active' => true,
            ]
        );
        $ad3->positions()->attach(3);


        // Create some dummy contact info
        Contact::create(
            [
                'email' => 'dummy.contact1@example.com',
                'name' => 'Dummy Contact 1',
                'message' => 'This is the first dummy contact message.',
            ]
        );

        Contact::create(
            [
                'email' => 'dummy.contact2@example.com',
                'name' => 'Dummy Contact 2',
                'message' => 'This is the second dummy contact message.',
            ]
        );

        // Create some dummy newsletter subscriptions
        Subscription::create(['email' => 'dummy.subscriber1@example.com']);
        Subscription::create(['email' => 'dummy.subscriber2@example.com']);
        Subscription::create(['email' => 'dummy.subscriber3@example.com']);
    }
}
