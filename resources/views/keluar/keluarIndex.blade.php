@extends('layouts.master')
@section('open','menu-open')
@section('menuBarang','active')
@section('menuKeluar','active')
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
        <form action="{{route('barangKeluarSimpan')}}" method="POST" enctype="multipart/form-data">
            <h3> <i class="fas fa-boxes    "></i> Transaksi Barang Keluar</h3>
            <hr>
            {{csrf_field()}}
              <div class="row">
                  <div class="col-6">
                      <label for="tanggal">Tanggal Keluar</label>
                      <input value="{{old('tanggal')}}" name="tanggal" type="datetime-local" class="form-control bg-light"
                          id="tanggal" required>
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
                      
                      <label for="pembeli">Nama Pembeli</label>
                      <input value="{{old('pembeli')}}" name="pembeli" type="text" class="form-control bg-light" id="pembeli"
                          required>
                  </div>
                  <div class="col-6">
                    <label for="jumlah">Jumlah</label>
                    <input value="{{old('jumlah')}}" name="jumlah" type="number" class="form-control bg-light" id="jumlah"
                        required>
                    <label for="keterangan">Keterangan</label>
                    <input value="{{old('keterangan')}}" name="keterangan" type="text" class="form-control bg-light" id="keterangan"
                        >
                  </div>
              </div>
              <hr>
              <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
              <a class="btn btn-danger btn-sm" href="/keluar" role="button"><i class="fas fa-undo"></i> BATAL</a>
            </div>
        </form>
    </div>
    <div class=" card mt-5" style="padding: 10px 10px 10px 10px ">
        <div class="box">
                <h4> <i class="fas fa-history    "></i> Riwayat Transaksi Keluar</h4>
            <div class="row table-responsive mt-3">
                <div class="col">
                <table class="table table-hover table-head-fixed table-striped table-bordered" id="table">
                    <thead>
                        <tr class="bg-light">
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Pembeli</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangKeluar as $b)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$b->tanggal}}</td>
                            <td>{{$b->barang->nama}}</td>
                            <td>{{$b->pembeli}}</td>
                            <td>{{$b->jumlah}}</td>
                            <td>{{$b->keterangan}}</td>
                            <td>
                                {{-- <a href="barang/{{$b->id}}" class="btn btn-info btn-sm"><i class="fas fa-pen"></i>Edit</a> --}}
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter"
                                    data-id="{{$b->id}}"
                                    data-nama="{{$b->pembeli}}"
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
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Transaksi?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>`
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
                        <button type="submit" class="btn btn-danger">Hapus</button>
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
                    modal.find('.modal-text').text('Yakin ingin menghapus Transaksi ' + nama + ' ?')
                    document.getElementById('formHapus').action='/keluarHapus/'+id;
                })
            });
        </script>
@endsection
