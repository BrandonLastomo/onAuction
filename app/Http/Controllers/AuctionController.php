<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\AuctionHistory;
use App\Models\Item;
use Carbon\Carbon;

class AuctionController extends Controller{
    public function openAuction(Request $request, Auction $auction){
            $validatedStatus = $request->validate([
                'item_id' => 'required',
                'user_id' => 'required',
                'sold_price' => 'required',
                'ends_in' => 'required',
                'status' => 'required'
            ]);
            
            if ($validatedStatus['item_id'] == $auction->item?->id) {
                Auction::where('item_id', $auction->item->id)->update([
                    'status' => 'Open',
                    'ends_in' => $validatedStatus['ends_in']
                ]);
            }
            else {
                Auction::create($validatedStatus);
            }
            return redirect('/dashboard')->with('success', 'Open success');
    }

    
    public function closeAuction(Request $request){
        Auction::where('item_id', $request->item_id)->update(['status' => $request->status]);
        return redirect('/dashboard')->with('success', 'An auction has been closed');
    }

    public function autoCloseAuction(Item $item){
        $endDate = [            
            // 'ends' => $item->auction->created_at->addDays($item->auction->ends_in)->diff(date('md'))->format('%m %d'),
            'rule' => Carbon::now()->diffInDays($item->auction->created_at->addDays($item->auction->ends_in)),
        ];
            // if (date('m d', strtotime('2023 03 08')) == $endDate['ends']) {
            if ($endDate['rule'] == 0) {
                Auction::where('id', $item->auction->id)->update(['status' => 'Closed']);
            }
            return redirect()->route('item_detail', ['item' => $item])->with('success', 'Open success');
            
        
    }

    public function bidStore(Request $request, Item $item){
            $newBid = $request->validate([
                'auction_id' => 'required',
                'user_id' => 'required',
                'bid_amount' => 'required',
                'item_id' => 'required'
            ]);

            $oldBid = $request->validate([
                'auction_id' => 'required',
                'user_id' => 'required'
            ]);
            $oldBid['bid_amount'] = $request['sold_price_old'];

            if ($newBid['bid_amount'] < $request['sold_price_old']) {
                AuctionHistory::create($newBid);
            } else {
                $newBid = $request->validate([
                    'item_id' => 'required',
                    // 'auction_id' => 'required',
                    'user_id' => 'required'
                ]);
                $newBid['sold_price'] = $request['bid_amount'];

                AuctionHistory::create($oldBid);
                Auction::where('item_id', $item->id)->update($newBid);
            }
            
            return redirect()->route('item_detail', ['item' => $item])->with('success', 'Open success');
    }

    public function deleteAuction(Auction $auction, Item $item){
        Auction::destroy($item->auction->id);
        return redirect('/dashboard')->with('success', 'An auction has been deleted');
    }
}
