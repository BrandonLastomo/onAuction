<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Auction;
use App\Models\AuctionHistory;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        User::create([
            'name' => 'Brandon',
            'username' => 'Baron',
            'email' => 'baron@gmail.com',
            'phone_number' => '0812 8888 8888',
            'password' => bcrypt('99999999'),
            'role' => "admin"
        ]);
        User::create([
            'name' => 'Niito',
            'username' => 'NiitoL',
            'email' => 'baron2@gmail.com',
            'phone_number' => '0812 8988 8888',
            'password' => bcrypt('11111111'),
            'role' => "staff"
        ]);
        User::create([
            'name' => 'Baron',
            'username' => 'Barong',
            'email' => 'baron3@gmail.com',
            'phone_number' => '0812 8898 8888',
            'password' => bcrypt('00000000')
        ]);
        User::factory(2)->create();


        Category::create([
            'name' => 'Sofa',
            'slug' => 'Sofa'
        ]);
        Category::create([
            'name' => 'Chair',
            'slug' => 'Chair'
        ]);
        Category::create([
            'name' => 'Bed',
            'slug' => 'Bed'
        ]);
        
        Item::factory(11)->create();

        Auction::factory(3)->create();
        AuctionHistory::factory(3)->create();
    }
}
