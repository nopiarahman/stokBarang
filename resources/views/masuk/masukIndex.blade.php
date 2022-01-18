@extends('layouts.master')
@section('menuBarang','active')
@section('menuMasuk','active')
@section('head')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
                {{session('sukses')}}
        </div>
        @endif
        <div class="container">
        <form action="{{route('barangMasukSimpan')}}" method="POST" enctype="multipart/form-data">
            <h3> <i class="fas fa-boxes    "></i> Stok Barang Masuk</h3>
            <hr>
            {{csrf_field()}}
              <div class="row">
                  <div class="col-6">
                      <label for="tanggalMasuk">Tanggal Masuk</label>
                      <input value="{{old('tanggalMasuk')}}" name="tanggalMasuk" type="datetime-local" class="form-control bg-light"
                          id="tanggalMasuk" required>
                      <label for="barang_id">Nama Barang</label>
                      <select class="cari form-control bg-light" name="barang_id"></select>
                        {{-- <input type="text" class="form-control @error('objek') is-invalid @enderror" name="objek" value="{{old('objek')}}"> --}}
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
                        <script type="text/javascript">
                            $('.cari').select2({
                                                placeholder: 'Cari Barang...',
                                                ajax: {
                                                url: '/cariBarang',
                                                dataType: 'json',
                                                delay: 250,
                                                processResults: function (data) {
                                                    return {
                                                    results:  $.map(data, function (item) {
                                                        return {
                                                        text: item.nama, /* memasukkan text di option => <option>namaSurah</option> */
                                                        id: item.id /* memasukkan value di option => <option value=id> */
                                                        }
                                                    })
                                                    };
                                                },
                                                cache: true
                                                }
                                            });
                            </script>
                      
                  </div>
                  <div class="col-6">
                    <label for="supplier_id">Nama Supplier</label>
                    <select class="cariSupplier form-control bg-light" name="supplier_id"></select>
                        {{-- <input type="text" class="form-control @error('objek') is-invalid @enderror" name="objek" value="{{old('objek')}}"> --}}
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
                        <script type="text/javascript">
                            $('.cariSupplier').select2({
                                                placeholder: 'Cari Supplier...',
                                                ajax: {
                                                url: '/cariSupplier',
                                                dataType: 'json',
                                                delay: 250,
                                                processResults: function (data) {
                                                    return {
                                                    results:  $.map(data, function (item) {
                                                        return {
                                                        text: item.nama, /* memasukkan text di option => <option>namaSurah</option> */
                                                        id: item.id /* memasukkan value di option => <option value=id> */
                                                        }
                                                    })
                                                    };
                                                },
                                                cache: true
                                                }
                                            });
                            </script>
                    
                    <label for="jumlah">Jumlah</label>
                    <input value="{{old('jumlah')}}" name="jumlah" type="number" class="form-control bg-light" id="jumlah"
                        required>
                  </div>
              </div>
              <hr>
              <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
              <a class="btn btn-danger btn-sm" href="/barang" role="button"><i class="fas fa-undo"></i> BATAL</a>
            </div>
        </form>
    </div>
    <div class=" card mt-5" style="padding: 10px 10px 10px 10px ">
        <div class="box">
                <h4> <i class="fas fa-history    "></i> Riwayat Barang Masuk</h4>
            <div class="row table-responsive mt-3">
                <div class="col">
                <table class="table table-hover table-head-fixed table-striped table-bordered" id="table">
                    <thead>
                        <tr class="bg-light">
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Supplier</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangMasuk as $b)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$b->tanggalMasuk}}</td>
                            <td>{{$b->barang->nama}}</td>
                            <td>{{$b->supplier->nama}}</td>
                            <td>{{$b->jumlah}}</td>
                            <td>
                                <a href="barang/{{$b->id}}" class="btn btn-info btn-sm"><i class="fas fa-pen"></i>Edit</a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter"
                                    data-id="{{$b->id}}"
                                    data-nama="{{$b->nama}}"
                                > <i class="fas fa-trash" aria-hidden="true"></i> Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

@endsection
