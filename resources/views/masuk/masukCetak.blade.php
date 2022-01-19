<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ mix("css/app.css") }}"> --}}
  <title>STOK BARANG VAN TROPHY</title>
  <style type="text/css">
  .styled-table {
      border-collapse: collapse;
      margin: 25px 0;
      font-size: 0.9em;
      font-family: sans-serif;
      width: 100%;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  }
  .styled-table th {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
  }
  .styled-table th,
  .styled-table td {
      padding: 12px 15px;
  }.styled-table tbody tr {
      border-bottom: 1px solid #dddddd;
  }

  .styled-table tbody tr:nth-of-type(even) {
      background-color: #f3f3f3;
  }

  .styled-table tbody tr:last-of-type {
      border-bottom: 2px solid #009879;
  }.styled-table tbody tr.active-row {
      font-weight: bold;
      color: #009879;
  }
  </style>
</head>
<body>
          <h3 style="text-align: center">Riwayat Barang Masuk</h3>
        <table class="styled-table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Supplier</th>
              <th scope="col">Jumlah</th>
            </tr>
          </thead>
          <tbody>
            @foreach($barangMasuk as $p)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$p->tanggalMasuk}}</td>
              <td>{{$p->barang->nama}}</td>
              <td>{{$p->supplier->nama}}</td>
              <td>{{$p->jumlah}}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            {{-- <tr>
              <th class="text-right text-primary">Total Barang</th>
              <th class="text-primary">{{$barang->count()}}</th>
            </tr> --}}
          </tfoot>
        </table>
{{-- @endsection --}}
</body>
</html>
