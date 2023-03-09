<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    
    <title>{{ $title }}</title>
</head>
<body>

    <style>
      p{
        margin-bottom: 5px;
      }

      table{
        table-layout: fixed;
        width: 99%;
      }

      th, tr, td{
        width: 10030px;
        padding: 5px
      } 

      th{
        background-color: #9E7676;
        color: white;
        text-align: left;
        border: 1px solid black
      }

      .reportTitle{
        margin-top: 0px
      }

      .itemDataTitle{
        width: 15%;
      }

      .itemDataColon{
        width: 1%
      }

      .itemData{
        width: 35%
      }

      .UserDataTitle{
        width: 10%
      }

      .leaderboardTitle{
        margin: 50px 0px 25px 0px 
      }

      .leaderboard{
        border: 1px solid black;
        border-spacing: 0px;
        width: 100%;
        margin-bottom: 30px
      }

      .tableNumber{
        width: 0px;
        align-content: left;
        border: 1px solid black
      }

      .bidder{
        border: 1px solid black
      }

      .bidAmount{
        border: 1px solid black
      }

      .signature{
        float: right
      }

      .acknowledged, .by{
        font-weight: normal
      }

      .acknowledged{
        margin-bottom: 120px
      }

    </style>
    <center>
      <h1 class="reportTitle">{{ $items->name ?? 'Unavalaible item' }}'s Report</h1>
    </center>

    <hr>
      <table>
        <tr>
          <td class="itemDataTitle">ID</td>
          <td class="itemDataColon">:</td>
          <td class="itemData">{{ $items->id }}</td>
          <td class="UserDataTitle">Winner</td>
          <td class="itemDataColon">:</td>
          <td>{{ $items->auction->user->name ?? 'No one has done any bid'}}</td>
        </tr>
        <tr>
          <td class="itemDataTitle">Name</td>
          <td class="itemDataColon">:</td>
          <td class="itemData">{{ $items->name }}</td>
          <td class="UserDataTitle">Sold at</td>
          <td class="itemDataColon">:</td>
          <td>Rp{{ number_format($items->auction->sold_price ?? '', 2, ',', '.') }}</td>
        </tr>
        <tr>
          <td class="itemDataTitle">Category</td>
          <td class="itemDataColon">:</td>
          <td class="itemData">{{ $items->category->name ?? "This item's category has been deleted or edited" }}</td>
        </tr>
        <tr>
          <td class="itemDataTitle">Start Price</td>
          <td class="itemDataColon">:</td>
          <td class="itemData">Rp{{ number_format($items->bid_price ?? '', 2, ',', '.') }}</td>
        </tr>
        <tr>
          <td class="itemDataTitle">Item Description</td>
          <td class="itemDataColon">:</td>
          <td class="itemData">{{ $items->desc }}</td>
        </tr>
        {{-- <tr>
          <td>
            <p>ID: {{ $items->id }}</p>
            <p>Name: {{ $items->name }}</p>
            <p>Category: {{ $items->category->name }}</p>
            <p>Start Price: {{ $items->bid_price }}</p>
            <p>Item Description: {{ $items->desc }}</p>
          </td>
          <td>
            <p>Winner: {{ $items->auction->user->name ?? 'No one has done any bid'}}</p>
            <p>Sold at: {{ $items->auction->sold_price ?? 'No one has done any bid'}}</p>
          </td>
        </tr> --}}
      </table>

    <center>  
      <h4 class="leaderboardTitle">Leaderboard of {{ $items->name }}'s Auction</h4>
    </center>
    
      <table class="leaderboard">
          <tr>
            <th class="tableNumber">No.</th>
            <th>Name</th>
            <th>Amount of Bid</th>
          </tr>
          @foreach ($auctions->sortDesc() as $auction)
          <tr>
              <td class="tableNumber">{{ $loop->iteration }}</td>
              {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
              <td class="bidder">{{ $auction->user->name ?? 'No one has done any bid'}}</td>
              <td class="bidAmount">Rp{{ number_format($auction->sold_price ?? '', 2, ',', '.')}}</td>
          </tr>
          @endforeach
          @foreach ($histories->sortByDesc('bid_amount') as $history)
          <tr>
              <td class="tableNumber">{{ $loop->iteration+1 }}</td>
              {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
              <td class="bidder">{{ $history->user->name }}</td>
              <td class="bidAmount">Rp{{ number_format($history->bid_amount ?? '', 2, ',', '.')}}</td>
          </tr>
          @endforeach
      </table>

      <div class="signature">
        <center>
          <h3 class="acknowledged">Acknowledged by,</h3>
          <h3 class="by">(.....................)</h3>
        </center>
      </div>
  </body>
</html>