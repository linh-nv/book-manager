<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Book;
use App\Models\CartItem;
use App\Models\Category;
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
        $this->call([
            UserSeeder::class,
            CitiesTableSeeder::class,
            DistrictSeeder::class,
            CommuneSeeder::class,
            AddressSeeder::class,
            AdminSeeder::class,
            CategorySeeder::class,
            AuthorSeeder::class,
            PublisherSeeder::class,
            BookSeeder::class,
            CommentSeeder::class,
            CouponSeeder::class,
            CouponUserSeeder::class,
            PreviewSeeder::class,
            PreviewCommentSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            TransactionSeeder::class,
            CartSeeder::class,
            CartItemSeeder::class,
            NewsImageSeeder::class,
            BookAuthorSeeder::class,
            NewsSeeder::class,
        ]);
    }
}
