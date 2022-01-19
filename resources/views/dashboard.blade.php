@extends('layouts.master')
@section('menuBeranda','active')
@section('head')
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
@endsection
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <div class="row">
            <div class="col">
                <center>
                    <h3 class="font-weight-bold">SELAMAT DATANG {{auth()->user()->name}}</h3>
                    <hr />
                </center>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="card-body">
                <!-- Small boxes (Stat box) -->
                <div class="filter-container p-0 row">
                    <div class="col-lg-5 col-6">
                        <!-- small box -->
                        <h5>Rekap Data</h5>
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('barang')->count()}}</h3>
                                <p>Total Barang</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                            </div>
                            <a href="/barang" class="small-box-footer bg-success">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        @if (auth()->user()->role == 'admin')
                        
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('supplier')->count()}}</h3>
                                <p>Total Supplier</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-layer-group"></i>
                            </div>
                            <a href="/supplier" class="small-box-footer bg-success">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-7 col-12">
                        <div id="chart" style="height: 500px;"></div>
                        <script>
                            const chart = new Chartisan({
                              el: '#chart',
                              url: "@chart('chart_barang')",
                              hooks: new ChartisanHooks()
                                    .colors()
                                    .title('Stok Barang')
                                    .tooltip(),
                            });
                          </script>
                    </div>
                    <!-- ./col -->
                    {{-- <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('suratkeluar')->count()}}</h3>
                                <p>Surat Keluar</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope"></i>
                            </div>
                            <a href="/suratkeluar/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('klasifikasi')->count()}}</h3>
                                <p>Klasifikasi</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-layer-group"></i>
                            </div>
                            <a href="/klasifikasi/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        
                    </div>
                    <!-- ./col -->
                    @if (auth()->user()->role == 'admin')
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('users')->count()}}</h3>
                                <p>Pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-user"></i>
                            </div>
                            <a href="{{ route('pengguna.index') }}" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    <!-- ./col -->
                </div> --}}
            </div>
        </div>
    </div>
</section>
@endsection
