<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\AuctionHistory;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\pdf as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller{
    public function index(){
    $categories = Category::all()->take(3);
    $countAuctions = Auction::count();

        return view('index', [
            'title' => "home",
            'pageIn' => "Latest Auction",
            'active' => 'home',
            'auctions' => Auction::all()->load('item'),
            'categories' => $categories,
            'countAuctions' => $countAuctions,
        ])->with('congrats', 'you won a bid!');
    }

    public function show(Item $item, Request $request){
        $endDate = [            
            // 'ends' => $item->auction->created_at->addDays($item->auction->ends_in)->diff(date('md'))->format('%m %d'),
            'rule' => Carbon::now()->diffInDays($item->auction->created_at->addDays($item->auction->ends_in)),
        ];
            // if (date('m d', strtotime('2023 03 08')) == $endDate['ends']) {
            if ($endDate['rule'] == 0) {
                Auction::where('item_id', $request->item_id)->update(['status' => 'Closed']);
                return view('item_detail', [
                    'title' => "Detail",
                    'active' => 'home',
                    // 'end' => '2023-03-02 00:00:00',
                    // 'ends' => $item->auction->created_at->addDays($item->auction->ends_in)->diffInDays(date('d ')),
                    'rule' => Carbon::now()->diffInDays($item->auction->created_at->addDays($item->auction->ends_in)),

                    // 'ends_at' => $item->auction->created_at->addDays($item->auction->ends_in),
                    // 'diff' => $item->auction->created_at->diff($item->auction->created_at->addDays($item->auction->ends_in))->format("%d days %h hours %i minutes"),
                    'items' => $item->load('auction'),
                    'moreItems' => Auction::all()->take(4),
                    // 'auctions' => Auction::all()->load('user')
                    'auctions' => Auction::where('item_id', $item->id)->get()->load('history'),
                        // 'histories' => AuctionHistory::where('auction_id', $item->auction->id)
                        //                 ->whereNotIn('bid_amount', [0.0])->get()->load('user')
                        // 'histories' => AuctionHistory::where('bid_amount', '>', 0.0)->where('auction_id', $item->auction->id)
                        // ->get()
                        // ->load('user', 'history')
                    'histories' => AuctionHistory::where('auction_id', $item->auction->id)->get()->load('user')
                        
                ]);
            }

            else{
                return view('item_detail', [
                    'title' => "Detail",
                    'active' => 'home',
                    // 'end' => '2023-03-02 00:00:00',
                    // 'ends' => $item->auction->created_at->addDays($item->auction->ends_in)->diffInDays(date('d ')),
                    'rule' => Carbon::now()->diffInDays($item->auction->created_at->addDays($item->auction->ends_in)),

                    // 'ends_at' => $item->auction->created_at->addDays($item->auction->ends_in),
                    // 'diff' => $item->auction->created_at->diff($item->auction->created_at->addDays($item->auction->ends_in))->format("%d days %h hours %i minutes"),
                    'items' => $item->load('auction'),
                    'moreItems' => Auction::all()->load('item')->take(4),
                    'moreItemsCount' => Auction::where('status', 'Open')->take(4)->count(),
                    // 'auctions' => Auction::all()->load('user')
                    'auctions' => Auction::where('item_id', $item->id)->get()->load('history'),
                    'histories' => AuctionHistory::where('auction_id', $item->auction->id)->get()->load('user')->sortDesc(),
                    'user_id' => AuctionHistory::where('auction_id', $item->auction->id)->get()->load('user')->sortDesc()->skip(1)
                ]);
            }
    }
    
    public function edit(Item $item){
        return view('item_edit', [
            "title" => "Item Edit",
            "active" => 'Home',
            'items' => $item
        ]);
    }

    public function mybid(Auction $auction){
        return view('mybid', [
            'title' => "Your Bid",
            'active' => 'mybid',
            'auctionsOpen' => Auction::where('user_id', Auth::user()->id)->where('status', 'Open')->get()->load('user'),
            'auctionHistoriesOpen' => collect(AuctionHistory::where('user_id', Auth::user()->id)->whereHas(
                                        'auction', function($query){
                                        $query->where('status', '=', 'Open');
                                        })->get()->load('user', 'auction'))->sortByDesc('created_at')->unique('item_id'),
            'countAuctionsOpen' => Auction::where('user_id', Auth::user()->id)->where('status', 'Open')->get()->count(),
            'countAuctionHistoriesOpen' => collect(AuctionHistory::where('user_id', Auth::user()->id)->whereHas(
                                        'auction', function($query){
                                        $query->where('status', '=', 'Open');
                                        })->get()->load('user', 'auction'))->unique('item_id')->count(),

            'auctionsClosed' => Auction::where('user_id', Auth::user()->id)->where('status', 'Closed')->get()->load('user'),
            'auctionHistoriesClosed' => collect(AuctionHistory::where('user_id', Auth::user()->id)->whereHas(
                                            'auction', function($query){
                                                $query->where('status', '=', 'Closed')->where('user_id', '!=', Auth::user()->id);
                                            })->get()->load('user', 'auction'))->sortByDesc('bid_amount')->unique('auction_id'),
            'countAuctionsClosed' => Auction::where('user_id', Auth::user()->id)->where('status', 'Closed')->get()->count(),
            'countAuctionHistoriesClosed' => collect(AuctionHistory::where('user_id', Auth::user()->id)->whereHas(
                                            'auction', function($query){
                                                $query->where('status', '=', 'Closed')->where('user_id', '!=', Auth::user()->id);
                                            })->get()->load('user', 'auction'))->sortByDesc('bid_amount')->unique('auction_id')->count(),
            
            //                                 'countAuctions' => Auction::where('user_id', Auth::user()->id)->count(),
            // 'countAuctionHistories' => AuctionHistory::where('user_id', Auth::user()->id)->count()
        ]);
    }

    public function reportView(Item $item){
        return view('report', [
            'title' => "Report",
            'active' => 'home',
            'items' => $item->load('auction', 'category'),
            // 'auctions' => Auction::all()->load('user')
            'auctions' => Auction::where('item_id', $item->id)->get()->load('user'),
            'histories' => AuctionHistory::where('auction_id', $item->auction->id)->get()->load('user')
        ]);
    }

    public function generateReport(Item $item){
        $pdf = PDF::loadView('report', [
            'title' => "Report",
            'active' => 'home',
            'items' => $item->load('auction', 'category'),
            // 'auctions' => Auction::all()->load('user')
            'auctions' => Auction::where('item_id', $item->id)->get()->load('user'),
            'histories' => AuctionHistory::where('auction_id', $item->auction->id)->get()->load('user')
        ])->setOption([
            // 'chroot'  => public_path('storage/e-signatures'),
            'chroot'  => asset('storage/')
        ])->setPaper('a4', 'landscape');
        return $pdf->download($item->name . ' Report.pdf');
    }

    public function search(Request $request) {
        if ($request->has('search')) {
            $auctions = Auction::whereHas('item', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'. $request->input('search') .'%');
            })
            ->latest()
            ->paginate(8); // or any other number of results per page
        
        
            // $items = Item::where('name', 'LIKE', '%'. $request->input('search') .'%')->get();
            // $items_id = $items->pluck('id')->toArray();
            // $auctions = Auction::latest()->whereIn('item_id', $items_id);
        }
        else {
            // $auctions = Auction::latest();
            $auctions = Auction::with('item')->latest()->paginate(7);
        }

        return view('index',[
            'auctionAsCondition' => Auction::all()->sortDesc()->first(),
            'auctions' => $auctions,
            'title' => "home",
            'success' => 'you won a bid!',
            'pageIn' => "Latest Auction",
            'active' => 'home',
            'categories' => Category::all()->take(3),
            'countAuctions' => Auction::all()->count()
        ])->with('success', 'you won a bid!');
    }
    
}
