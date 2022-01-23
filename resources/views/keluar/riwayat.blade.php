@extends('layouts.master')
@section('menuKeluar','active')
@section('head')
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
            <a href="{{route('keluar')}}" style="align-self: flex-end" class="btn btn-primary " role="button"> 
                <i class="fa fa-backward" aria-hidden="true"></i>  Penjualan</a>
            {{-- <div class="row">
                <div class="col-6">
                    <h3> <i class="fas fa-boxes    "></i> Penjualan</h3>
                </div>
                <div class="col-6 d-flex" style="flex-direction: column;">

                </div>
            </div> --}}
    <div class=" card mt-1" style="padding: 10px 10px 10px 10px ">
        <div class="box">
            <h4> <i class="fas fa-history    "></i> Riwayat Penjualan</h4>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <form action="{{route('keluarCetak')}}" method="get" enctype="multipart/form-data">
                            <div class="form-group row mb-4">
                            {{-- <label class="col-form-label text-md-right col-12 col-md-6 col-lg-6 mt-1 mr-n3" > <span style="font-size:small">Pilih Tanggal: </span> </label> --}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </div>
                                </div>
                                <input type="text" id="reportrange" class="form-control filter @error('filter') is-invalid @enderror" name="filter" value="{{ request('filter') }}" id="filter">
                                <input type="hidden" name="start" id="mulai" value="{{$start}}">
                                <input type="hidden" name="end" id="akhir" value="{{$end}}">
                                <button type="submit" class="btn btn-warning btn-icon icon-right">
                                    <i class="fas fa-file-pdf    "></i> Print PDF
                                </button>
                            </div>
                            </form>
                            <script type="text/javascript">
                            $(function() {
                                moment.locale('id');
                                var start = moment($('#mulai').val());
                                    var end = moment($('#akhir').val());
                                function cb(start, end) {
                                    $('#reportrange span').html(start.format('D M Y') + ' - ' + end.format('DD MMMM YYYY'));
                                    $('#mulai').val(start);
                                    $('#akhir').val(end);
                                }
                                $('#reportrange').daterangepicker({
                                    startDate: start,
                                    endDate: end,
                                    ranges: {
                                        'Hari Ini': [moment(), moment()],
                                        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                        '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                                        '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                                        'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                                        'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                                    }
                                }, cb);
                                });
                            </script>
                            {{-- end filter --}}
                        {{-- <a class="btn btn-warning btn-sm" href="{{route('keluarCetak')}}" role="button"> <i class="fas fa-file-pdf    "></i> Print PDF</a> --}}
                        <br>
                    </div>
                    </div>
                    <div class="col-6">
                     {{-- filter --}}
                     <form action="#" method="get" enctype="multipart/form-data">
                        <div class="form-group row mb-4">
                        {{-- <label class="col-form-label text-md-right col-12 col-md-6 col-lg-6 mt-1 mr-n3" > <span style="font-size:small">Pilih Tanggal: </span> </label> --}}
                        <div class="input-group col-sm-12 col-md-12">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </div>
                            </div>
                            <input type="text" id="reportrange2" class="form-control filter @error('filter') is-invalid @enderror" name="filter" value="{{ request('filter') }}" id="filter">
                            <input type="hidden" name="start" id="mulai2" value="{{$start}}">
                            <input type="hidden" name="end" id="akhir2" value="{{$end}}">
                            <button type="submit" class="btn btn-primary btn-icon icon-right">
                            <i class="fas fa-filter    "></i>
                            Filter
                            </button>
                        </div>
                        </form>
                        <script type="text/javascript">
                        $(function() {
                            moment.locale('id');
                            var start = moment($('#mulai2').val());
                                var end = moment($('#akhir2').val());
                            function cb(start, end) {
                                $('#reportrange2 span').html(start.format('D M Y') + ' - ' + end.format('DD MMMM YYYY'));
                                $('#mulai2').val(start);
                                $('#akhir2').val(end);
                            }
                            $('#reportrange2').daterangepicker({
                                startDate: start,
                                endDate: end,
                                ranges: {
                                    'Hari Ini': [moment(), moment()],
                                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                    '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                                    '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                                    'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                                    'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                                }
                            }, cb);
                            });
                        </script>
                        {{-- end filter --}}
                    </div>
                </div>
            </div>
        </div>

            <div class="row table-responsive">
                <div class="col">
                <table class="table table-hover table-head-fixed table-striped table-bordered" id="table">
                    <thead>
                        <tr class="bg-light">
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Daftar Barang</th>
                        <th>Total Transaksi</th>
                        <th>Petugas</th>
                        {{-- <th>Aksi</th> --}}
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
