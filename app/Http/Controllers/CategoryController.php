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
        return view('items_in_category', [
            'title' => "$category->name Page",
            'pageIn' => "Items in $category->name",
            'active' => 'categories',
            'items' => $category->item,
            'auctions' => Auction::all()->load('item'),
            'countAuctions' => Auction::all()->count()
        ]);
    }
}
