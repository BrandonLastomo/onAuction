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
        background-color: black;
        color: white
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

      .tableNumber{
        width: 0px;
        align-content: left
      }

    </style>
    

    <div class="container mt-3">
    onAuction
    </div>

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
          <td>{{ $items->auction->sold_price ?? 'No one has done any bid'}}</td>
        </tr>
        <tr>
          <td class="itemDataTitle">Category</td>
          <td class="itemDataColon">:</td>
          <td class="itemData">{{ $items->category->name }}</td>
        </tr>
        <tr>
          <td class="itemDataTitle">Start Price</td>
          <td class="itemDataColon">:</td>
          <td class="itemData">{{ $items->bid_price }}</td>
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
    
      <table>
          <tr>
            <th class="tableNumber">No.</th>
            <th>Name</th>
            <th>Amount of Bid</th>
          </tr>
          @foreach ($auctions->sortDesc() as $auction)
          <tr>
              <td class="tableNumber">{{ $loop->iteration }}</td>
              {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
              <td>{{ $auction->user->name ?? 'Be the first to bid!'}}</td>
              <td>{{ $auction->sold_price ?? ''}}</td>
          </tr>
          @endforeach
          @foreach ($histories->sortByDesc('bid_amount') as $history)
          <tr>
              <td>{{ $loop->iteration+1 }}</td>
              {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
              <td>{{ $history->user->name }}</td>
              <td>{{ $history->bid_amount}}</td>
          </tr>
          @endforeach
      </table>

</body>
</html>