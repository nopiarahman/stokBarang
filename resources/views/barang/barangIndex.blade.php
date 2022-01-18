@extends('layouts.master')
@section('menuBarang','active')
@section('menuStok','active')
@section('content')
    <section class="content card" style="padding: 10px 10px 10px 10px ">
        <div class="box">
                @if(session('sukses'))
                <div class="alert alert-success" role="alert">
                        {{session('sukses')}}
                </div>
                @endif
            <div class="row">
                <div class="col">
                <h3><i class="fas fa-boxes   m-2 "></i>Daftar Stok Barang</h3>
                <hr>
            </div>
            </div>

            {{-- Tambah Data --}}
            <div>
              <div class="col">
                <a class="btn btn-primary btn-sm " href="/barang/tambah" role="button"><i class="fas fa-plus"></i> Tambah Data</a>
                <br>
            </div>
            
          </div>
            <div class="row table-responsive mt-3">
                <div class="col">
                <table class="table table-hover table-head-fixed table-striped table-bordered" id="table">
                    <thead>
                        <tr class="bg-light">
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Stok Barang</th>
                        <th>Kategori</th>
                        <th>Lokasi Barang</th>
                        <th>Foto Barang</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang as $b)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$b->nama}}</td>
                            <td>{{$b->jumlah}}</td>
                            <td>{{$b->kategori}}</td>
                            <td>{{$b->lokasi}}</td>
                            <td><img src="" alt=""></td>
                            <td>
                                <a href="barang/{{$b->id}}" class="btn btn-info btn-sm"><i class="fas fa-pen"></i>Edit</a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter"
                                    data-id="{{$b->id}}"
                                    data-nama="{{$b->nama}}"
                                > <i class="fas fa-trash" aria-hidden="true"></i> Hapus</button>
                                {{-- href="{{route('asetBergerakDelete',['id'=>$ab->id])}}" --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">Tidak Ada Data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </section>
        <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Barang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="formHapus" action="" method="post">
                    @method('delete')
                    @csrf
                    <p class="modal-text"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </form>
            </div>
        </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#exampleModalCenter').on('show.bs.modal',function(event){
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var nama = button.data('nama')
                var modal = $(this)
                modal.find('.modal-text').text('Yakin ingin menghapus  ' + nama + ' ?')
                document.getElementById('formHapus').action='/barang/'+id;
            })
        });
    </script>
 @endsection

