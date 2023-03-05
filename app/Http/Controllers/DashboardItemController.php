<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Auction;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateItemRequest;

class DashboardItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('dashboard.items.index', [
            'title' => 'items',
            'active' => 'items',
            'items' => Item::all(),
            'auctions' => Auction::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard.items.create', [
            'title' => 'add',
            'active' => 'add',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request){
        
        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'bid_price' => 'required',
            'desc' => 'required'
            // nama key diambil dari nama tag
        ]);
        $validatedData['slug'] = Str::slug($request->name);
        $validatedData['image'] = $request->file('image')->store('item-images');

        Item::create($validatedData);
        return redirect('/dashboard/items')->with('success', 'A new item has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item){
        return view('dashboard.items.show',[
            'title' => 'detail',
            'active' => 'detail',
            'item' => $item->load('auction')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item){
        return view('dashboard.items.item_edit', [
            'title' => 'edit',
            'active' => 'edit',
            'item' => $item,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item){
        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'bid_price' => 'required',
            'desc' => 'required'
        ]);

        $validatedData['slug'] = Str::slug($request->name);
        if ($item->image != null) {
            Storage::delete($item->image);
        }
        $validatedData['image'] = $request->file('image')->store('item-images');
        
        Item::where('id', $item->id)->update($validatedData);
        return redirect('/dashboard/items')->with('success', 'An item has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item){
        
        Item::destroy($item->id);
        // tangkap slug yang dikirim, lalu cari idnya dan hapus
        return redirect('/dashboard/items')->with('success', 'An item has been deleted');
    }
}
