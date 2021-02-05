{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Detail Barang
                    <!-- <div class="text-muted pt-2 font-size-sm">Tambah Akun</div> -->
                </h3>
            </div>
        </div>
        <div class="card-body flex-wrap border-0 pt-6 pb-0">
            <form class="form" id="form">
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Nama Barang *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="nama_barang_field" class="form-control" name="nama_barang" disabled
                               placeholder="Masukkan nama barang" value="{{$barang->nama}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Nama Satuan Barang *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="satuan_barang_field" class="form-control" name="nama_satuan" disabled
                               placeholder="Masukkan satuan barang" value="{{$barang->satuan}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Jumlah *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="number" id="jumlah_field" class="form-control" name="jumlah_barang" disabled
                               placeholder="Masukkan jumlah field" value="{{$barang->jumlah}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Harga Satuan *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="number" id="harga_satuan_field" class="form-control" name="harga_satuan" disabled
                               placeholder="Masukkan harga satuan barang" value="{{$barang->harga}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Total *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="number" id="total_field" class="form-control" name="total" disabled value="{{($barang->harga * $barang->jumlah)}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Nota Pembelian Barang *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        @if($barang->nota)
                            <a href="{{asset("uploads/nota")}}/{{$barang->nota->file_name}}" target="_blank">
                                {{$barang->nota->original_name}}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Dipesan oleh perusahaan *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="nama_perusahaan_field" class="form-control" disabled
                                name="nama_perusahaan" value="{{$barang->kontrak->perusahaan->nama}}"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section("scripts")
@endsection
