@extends('layouts.master')

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
        <form action="{{route('supplierSimpan')}}" method="POST" enctype="multipart/form-data">
            <h3> <i class="fas fa-boxes    "></i> Tambah Data Supplier</h3>
            <hr>
            {{csrf_field()}}
              <div class="row">
                  <div class="col-6">
                      <label for="nama">Nama</label>
                      <input value="{{old('nama')}}" name="nama" type="text" class="form-control bg-light"
                          id="nama">
                      <label for="alamat">Alamat</label>
                      <input value="{{old('alamat')}}" name="alamat" type="text" class="form-control bg-light"
                              id="alamat" required>
                      <label for="telepon">Telepon</label>
                      <input value="{{old('telepon')}}" name="telepon" type="text" class="form-control bg-light"
                                      id="telepon" required>
                      
                  </div>
                  <div class="col-6">
                      <label for="kota">Kota</label>
                      <input value="{{old('kota')}}" name="kota" type="text" class="form-control bg-light"
                          id="kota">
                      <label for="Keterangan">Keterangan</label>
                      <input value="{{old('keterangan')}}" name="keterangan" type="text" class="form-control bg-light"
                          id="keterangan">
                  </div>
              </div>
              <hr>
              <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
              <a class="btn btn-danger btn-sm" href="/barang" role="button"><i class="fas fa-undo"></i> BATAL</a>
            </div>
        </form>
    </div>
    </div>
</section>
@endsection
