<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ mix("css/app.css") }}"> --}}
  <title>PENJUALAN BARANG VAN TROPHY</title>
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
          <h3 style="text-align: center">Riwayat Penjualan</h3>
        <table class="styled-table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Daftar Barang</th>
              <th scope="col">Total Transaksi</th>
              <th scope="col">Petugas</th>
            </tr>
          </thead>
          <tbody>
            @php
                $n=1;
            @endphp
            @foreach($barangKeluar as $b)
            @if($b->penjualan()->sum('total') != 0)
            <tr>
                <td>{{$n, $n++}}</td>
                <td>{{Carbon\Carbon::parse($b->tanggal)->isoFormat('DD/MM/YYYY')}}</td>
                <td>
                    @foreach($b->penjualan()->get() as $p)
                    {{$loop->iteration}}. {{$p->barang->nama}} ({{$p->jumlah}} pcs)<br>
                    @endforeach
                </td>
                <td>Rp. {{number_format($b->penjualan()->sum('total'))}}</td>
                <td>{{$b->user->name}}</td>

                {{-- <td>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter"
                        data-id="{{$b->id}}"
                        data-nama="{{$b->pembeli}}"
                    > <i class="fas fa-trash" aria-hidden="true"></i> Hapus</button>
                </td> --}}
            </tr>
            @endif
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
