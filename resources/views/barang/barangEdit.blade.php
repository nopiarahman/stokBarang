@extends('layouts.master')
@section('menuStok','active')
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
        <div class="container">
        <form action="{{route('barangUpdate',['id'=>$id->id])}}" method="POST" enctype="multipart/form-data">
            <h3> <i class="fas fa-boxes    "></i> Tambah Data Barang</h3>
            <hr>
            {{csrf_field()}}
            @method('patch')
              <div class="row">
                  <div class="col-6">
                      <label for="nama">Nama</label>
                      <input value="{{$id->nama}}" name="nama" type="text" class="form-control bg-light"
                          id="nama">
                      <label for="spesifikasi">Spesifikasi</label>
                      <input value="{{$id->spesifikasi}}" name="spesifikasi" type="text" class="form-control bg-light"
                              id="spesifikasi">
                      <label for="kategori">Kategori</label>
                      <input value="{{$id->kategori}}" name="kategori" type="text" class="form-control bg-light"
                                      id="kategori">
                      
                      <label for="jumlah">Jumlah</label>
                      <input value="{{$id->jumlah}}" name="jumlah" type="text" class="form-control bg-light" id="jumlah"
                          required>
                  </div>
                  <div class="col-6">
                      <label for="ukuran">Ukuran</label>
                      <input value="{{$id->ukuran}}" name="ukuran" type="text" class="form-control bg-light"
                          id="ukuran">
                      <label for="berat">Berat</label>
                      <input value="{{$id->berat}}" name="berat" type="text" class="form-control bg-light"
                          id="berat">
                      <label for="lokasi">Lokasi</label>
                      <input value="{{$id->lokasi}}" name="lokasi" type="text" class="form-control bg-light"
                          id="lokasi">
                  </div>
              </div>
              <hr>
              <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> UPDATE</button>
              <a class="btn btn-danger btn-sm" href="/barang" role="button"><i class="fas fa-undo"></i> BATAL</a>
            </div>
        </form>
    </div>
    </div>
</section>
@endsection
