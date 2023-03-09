<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\User;
use App\Models\Item;
use App\Models\AuctionHistory;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller{
    public function index(){
        // if(!auth()->check() || auth()->user()->role == "citizen"){
        //     return redirect()->intended('/');
        // }

        return view('dashboard.index', [
            'title' => "Dashboard",
            'auctions' => Auction::all()->load('item', 'user'),
            'countAuction' => Auction::all()->load('item', 'user')->count(),
            'countItem' => Item::all()->count(),
            'countCategory' => Category::all()->count(),
            'countStaff' => User::where('role', 'admin')->orWhere('role', 'staff')->count()
        ]);
    }

    public function show(Item $item){
        return view('item_detail', [
            'title' => "Detail",
            'active' => 'home',
            // 'end' => '2023-03-02 00:00:00',
            // 'diff' => $item->auction->created_at->diff($item->auction->created_at->addDays($item->auction->ends_in))->format("%d days %h hours %i minutes"),
            'rule' => Carbon::now()->diffInDays($item->auction->created_at->addDays($item->auction->ends_in)),
            'items' => $item->load('auction'),
            // 'auctions' => Auction::all()->load('user')
            'auctions' => Auction::where('item_id', $item->id)->get(),
            'histories' => AuctionHistory::where('auction_id', $item->auction->id)->get()->load('user')
        ]);
    }

    public function addStaffView(){
        return view('dashboard.register', [
            'title' => 'add',
            'active' => 'add'
        ]);
    }

    public function addStaff(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'phone_number' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
            'role' => 'required'
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);
        return redirect('/dashboard')->with('success', 'Registration success');
          
    }
}
