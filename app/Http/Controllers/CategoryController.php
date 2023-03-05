<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Auction;

class CategoryController extends Controller{
    public function index(){
        return view('categories', [
            'title' => 'Categories Page',
            'active' => 'categories',
            'categories' => Category::all()
        ]);
    }

    public function categoryItems(Category $category) {
        return view('index', [
            'title' => "$category->name Page",
            'pageIn' => "Latest $category->name Auction",
            'active' => 'categories',
            'items' => $category->item,
            'auctions' => Auction::all()->where('status', 'open')->load('item')
        ]);
    }
}
