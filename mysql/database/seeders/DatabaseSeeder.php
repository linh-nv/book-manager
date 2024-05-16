<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\News;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Preview;
use App\Models\PreviewComment;
use App\Models\Publisher;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::create([
        //     'username' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('password'),
        //     'role' => 1,
        //     'phone' => '0123456789',
        //     'address' => '123 Admin St.',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // User::factory(5)->create();
        // Category::factory(5)->create();
        // ChildCategory::factory(10)->create();
        // Author::factory(10)->create();
        // Publisher::factory(10)->create();
        // Book::factory(10)->create();
        // Order::factory(10)->create();
        // OrderDetail::factory(10)->create();
        // Comment::factory(10)->create();
        // Coupon::factory(10)->create();
        // News::factory(10)->create();
        // CouponUser::factory(10)->create();
        // Preview::factory(10)->create();
        // PreviewComment::factory(10)->create();

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ChildCategorySeeder::class,
            AuthorSeeder::class,
            PublisherSeeder::class,
            BookSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            CommentSeeder::class,
            CouponSeeder::class,
            NewsSeeder::class,
            CouponUserSeeder::class,
            PreviewSeeder::class,
            PreviewCommentSeeder::class,
        ]);
    }
}
