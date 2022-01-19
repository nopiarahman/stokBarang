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
        <form action="{{route('userSimpan')}}" method="POST" enctype="multipart/form-data">
            <h3> <i class="fas fa-user    "></i> Tambah Data User</h3>
            <hr>
            {{csrf_field()}}
              <div class="row">
                  <div class="col-6">
                      <label for="name">Nama</label>
                      <input value="{{old('name')}}" name="name" type="text" class="form-control bg-light"
                          id="name">
                      <label for="email">Email</label>
                      <input value="{{old('email')}}" name="email" type="text" class="form-control bg-light"
                              id="email">
                      <label for="password">Password</label>
                      <input value="{{old('password')}}" name="password" type="text" class="form-control bg-light"
                                      id="password">
                      
                      <label for="role">Hak Akses</label>
                      <select class="form-control bg-light" name="role" id="">
                        <option value="admin">Admin</option>
                        <option value="karyawan">Karyawan</option>

                      </select>
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
