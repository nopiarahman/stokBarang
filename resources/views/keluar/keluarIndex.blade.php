@extends('layouts.master')
@section('menuKeluar','active')
@section('head')
<style>
        body{
    margin-top:20px;
    color: #484b51;
}
.text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
.bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
}
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #68a3d5!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}
</style>
<link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
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
        @if(session('gagal'))
        <div class="alert alert-danger" role="alert">
                {{session('gagal')}}
        </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3> <i class="fas fa-boxes    "></i> Penjualan</h3>
                </div>
                <div class="col-6 d-flex" style="flex-direction: column;">
                    <a href="{{route('riwayatPenjualan')}}" style="align-self: flex-end" class="btn btn-primary " role="button"> 
                        <i class="fas fa-history    "></i> Riwayat Penjualan</a>

                </div>
            </div>
        <form action="{{route('barangKeluarSimpan')}}" method="POST" enctype="multipart/form-data">
            <hr>
            {{csrf_field()}}
              <div class="row">
                  <div class="col-6">
                      <label for="tanggal">Tanggal Pembelian</label>
                      <input value="{{Carbon\Carbon::now()->isoFormat('YYYY-MM-DD')}}" disabled name="tanggal" type="date" class="form-control bg-light"
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
                      
                  </div>
                  <div class="col-6">
                    <label for="jumlah">Jumlah</label>
                    <input value="{{old('jumlah')}}" name="jumlah" type="number" class="form-control bg-light" id="jumlah"
                        required>
                    {{-- <label for="keterangan">Keterangan</label>
                    <input value="{{old('keterangan')}}" name="keterangan" type="text" class="form-control bg-light" id="keterangan"
                        > --}}
                  </div>
              </div>
              <hr>
              <button type="submit" class="btn btn-success btn-sm"> <i class="fas fa-plus    "></i> TAMBAH</button>
              {{-- <a class="btn btn-danger btn-sm" href="/keluar" role="button"><i class="fas fa-undo"></i> BATAL</a> --}}
            </div>
        </form>
    </div>
    <div class=" card mt-5" style="padding: 10px 10px 10px 10px ">
        <div class="box">
            <h4> <i class="fas fa-coins    "></i> Detail Penjualan</h4>
        </div>

            <div class="row table-responsive">
                <div class="col">
                <table class="table table-hover table-head-fixed table-striped table-bordered" id="">
                    <thead>
                        <tr class="bg-light">
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualan as $b)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$b->barang->nama}}</td>
                            <td>{{$b->jumlah}}</td>
                            <td>Rp. {{number_format($b->total)}}</td>
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
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right">Total Pembayaran</td>
                            <td colspan="2"> <span class="badge badge-primary "><h4  style="font-weight: bold">Rp. {{number_format($penjualan->sum('total'))}}</h4></span> </td>
                        </tr>
                    </tfoot>
                </table>
                @if($penjualan->count()>0)
                <button href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalSelesai"> 
                    <i class="fas fa-check    "></i> Selesai Transaksi 
                </button>  
                @endif

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
        <div class="modal fade " id="modalSelesai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Selesaikan Transaksi?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>`
                </button>
                </div>
                <div class="modal-body">
                    <form id="formHapus" action="{{route('selesaiTransaksi')}}" method="post">
                        @csrf
                        <p class="modal-text">Yakin ingin menyelesaikan Transaksi ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" onclick="cetak('struk')">Ya, Cetak Struk Pembelian</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
