<?php

namespace App\Http\Controllers;

use App\Models\Auction_history;
use App\Http\Requests\StoreAuction_historyRequest;
use App\Http\Requests\UpdateAuction_historyRequest;

class AuctionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuction_historyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuction_historyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auction_history  $auction_history
     * @return \Illuminate\Http\Response
     */
    public function show(Auction_history $auction_history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auction_history  $auction_history
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction_history $auction_history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuction_historyRequest  $request
     * @param  \App\Models\Auction_history  $auction_history
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuction_historyRequest $request, Auction_history $auction_history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auction_history  $auction_history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction_history $auction_history)
    {
        //
    }
}
