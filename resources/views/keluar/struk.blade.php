<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/adminlte/fontawesome-free/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            margin-top: 20px;
            color: #484b51;
        }

        .text-secondary-d1 {
            color: #728299 !important;
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
            border-color: #dce9f0 !important;
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -.25rem !important;
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -.25rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .text-grey-m2 {
            color: #888a8d !important;
        }

        .text-success-m2 {
            color: #86bd68 !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-110 {
            font-size: 110% !important;
        }

        .text-blue {
            color: #478fcc !important;
        }

        .pb-25,
        .py-25 {
            padding-bottom: .75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: .75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, .92) !important;
        }

        .bgc-default-l4,
        .bgc-h-default-l4:hover {
            background-color: #f3f8fa !important;
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
            font-size: 120% !important;
        }

        .text-primary-m1 {
            color: #4087d4 !important;
        }

        .text-danger-m1 {
            color: #dd4949 !important;
        }

        .text-blue-m2 {
            color: #68a3d5 !important;
        }

        .text-150 {
            font-size: 150% !important;
        }

        .text-60 {
            font-size: 60% !important;
        }

        .text-grey-m1 {
            color: #7b7d81 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }

    </style>
</head>

<body>
    <div class="kembali2" id="kembali">
        <a href="{{ route('keluar') }}" class="btn btn-primary"> <i class="fa fa-backward" aria-hidden="true"></i>
            Kembali
            ke halaman Penjualan</a>
        <button class="btn btn-danger" onclick="cetak('struk')"> <i class="fas fa-print    "></i> Print</button>
    </div>
    <div class=" container">
        <div id="print" class="print">
            <div class="page-header text-blue-d2">
                <h1 class="page-title text-secondary-d1">
                    Invoice
                    <small class="page-info">
                        <i class="fa fa-angle-double-right text-80"></i>
                        ID: #{{ $barangKeluar->id }}
                    </small>
                </h1>
            </div>

            <div class="container px-0">
                <div class="row mt-4">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center text-150">
                                    <img src="{{ asset('/img/logo-sm.png') }}" alt="" width="200px"
                                        class="">
                                </div>
                            </div>
                        </div>
                        <!-- .row -->

                        <hr class="row brc-default-l1 mx-n1" />

                        <div class="row">
                            <div class="col d-flex" style="flex-direction: column">
                                <div class="text-95 align-self-end " style=" flex-direction:column">
                                    <hr class="" />
                                    <div class="text-grey-m2">
                                        <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                            Invoice
                                        </div>

                                        <div class="my-2"><i
                                                class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                                class="text-600 text-90">ID:</span> #{{ $barangKeluar->id }}</div>

                                        <div class="my-2"><i
                                                class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                                class="text-600 text-90">Tanggal Cetak:</span>
                                            {{ Carbon\Carbon::parse($barangKeluar->tanggal)->isoFormat('DD/MM/YYYY') }}
                                        </div>

                                        <div class="my-2"><i
                                                class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                                class="text-600 text-90">Petugas:</span> {{ auth()->user()->name }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="">
                            <div class="row text-600 text-white bgc-default-tp1 py-25">
                                <div class="col" style="width: 3%">#</div>
                                <div class="col ">Nama Barang</div>
                                <div class="col ">Jumlah</div>
                                <div class="col">Harga Barang</div>
                                <div class="col">Total</div>
                            </div>

                            <div class="text-95 text-secondary-d3">
                                @foreach ($barangKeluar->penjualan()->get() as $p)
                                    <div class="row mb-2 py-25">
                                        <div class="col">{{ $loop->iteration }}</div>
                                        <div class="col ">{{ $p->barang->nama }}</div>
                                        <div class="col">{{ $p->jumlah }} Pcs</div>
                                        <div class="col text-95">Rp. {{ number_format($p->barang->hargaJual) }}
                                        </div>
                                        <div class="col text-secondary-d2">Rp. {{ number_format($p->total) }}</div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row border-b-2 brc-default-l2"></div>

                            <div class="row mt-3">
                                <div class="col-12 text-grey-d2 text-95 mt-2 mt-lg-0">
                                    {{-- Extra note such as company or payment information... --}}
                                </div>

                                <div class="col-12  text-grey text-90 order-first">

                                    <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                        <div class="col-9 " style="text-align: end">
                                            <h5> Total Amount</h5>
                                        </div>
                                        <div class="col-3" style="text-align: center">
                                            <span class="text-150 text-success-d3 opacity-2">
                                                <h5>Rp. {{ number_format($barangKeluar->penjualan()->sum('total')) }}
                                                </h5>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div class="d-flex" style="flex-direction: column">
                                <span style=" align-self: center" class="text-secondary-d1 text-105 text-center">Terima
                                    kasih atas pembelian anda</span>
                                {{-- <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="struk" class="d-none">
            <div class="row">
                <div class="col-12" style="text-align: center">
                    <h2>VAN TROPY</h2>
                </div>
                {{-- <div class="col-6"></div> --}}
                <div class="col-6">
                    <h6> ID: #{{ $barangKeluar->id }} </h6>
                    <h6>Tanggal Cetak: {{ Carbon\Carbon::parse($barangKeluar->tanggal)->isoFormat('DD/MM/YYYY') }}
                    </h6>
                    <h6>Petugas: {{ auth()->user()->name }}</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Harga</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangKeluar->penjualan()->get() as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->barang->nama }} {{ $p->jumlah }} Pcs @ Rp.
                                        {{ number_format($p->barang->hargaJual) }}</td>
                                    <td>Rp. {{ number_format($p->total) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: right">Total Pembayaran</td>
                                <td>
                                    <h5 class="text-right">
                                        Rp.{{ number_format($barangKeluar->penjualan()->sum('total')) }}</h5>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align: center">
                    <h5>----TERIMA KASIH----</h5>
                    <p>Barang yang dibeli tidak dapat dikembalikan kembali.</p>
                    <p>Pembelian Anda Gratis jika tidak diberi struk atau apabila Anda tidak mendapatkan pelayanan yang
                        ramah dari kasir kami</p>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    function cetak(el) {
        var restorePage = document.body.innerHTML;
        var printContent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = restorePage;
    }
</script>

</html>
