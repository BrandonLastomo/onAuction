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
        Auction::where('id', $request->auction_id)->update(['status' => $request->status]);
        if ($request->status == 'Open') {
            return redirect('/dashboard')->with('success', 'An auction has been opened');
        } else {
            return redirect('/dashboard')->with('success', 'An auction has been closed');
        }
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
                'auction_id' => 'required'
            ]);
            $oldBid['bid_amount'] = $request['sold_price_old'];
            
            if($request['bid_amount'] > $request['sold_price_old']){
                $oldBid['user_id'] = $request['old_winner'];
            }
            elseif($request['user_id'] != $request['old_bidder_id']){
                $oldBid['user_id'] = $request['old_bidder_id'];
            } else{
                $oldBid['user_id'] = $request['user_id'];
            }

            if ($newBid['bid_amount'] > $item['bid_price']) {

                if ($newBid['bid_amount'] == $request['other_bid'] || $newBid['bid_amount'] == $request['sold_price_old']){
                    return redirect()->route('item_detail', ['item' => $item])->with('failed', 'Bid failed, your bid must not be the same as other bid.');
                
                } elseif($newBid['bid_amount'] < $request['sold_price_old']) {
                    AuctionHistory::create($newBid);

                } elseif($request['sold_price_old'] == 0){
                    $newBid = $request->validate([
                        'item_id' => 'required',
                        'user_id' => 'required'
                    ]);
                    $newBid['sold_price'] = $request['bid_amount'];
                    Auction::where('item_id', $item->id)->update($newBid);
                    return redirect()->route('item_detail', ['item' => $item])->with('success', 'Bid success! Your bid is now on the top.');

                } else {
                    $newBid = $request->validate([
                        'item_id' => 'required',
                        'user_id' => 'required'
                    ]);
                    $newBid['sold_price'] = $request['bid_amount'];
                    AuctionHistory::create($oldBid);
                    Auction::where('item_id', $item->id)->update($newBid);
                    return redirect()->route('item_detail', ['item' => $item])->with('success', 'Bid success! Your bid is now on the top.');

                }
            } else{
                return redirect()->route('item_detail', ['item' => $item])->with('tooLow', 'Bid failed, your bid must be greater than the bid price.');
            }
            
    }

    public function deleteAuction(Auction $auction){
        Auction::destroy($auction->id);
        return redirect('/dashboard')->with('success', 'An auction has been deleted');
    }
}
