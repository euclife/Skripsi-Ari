{{-- Extends layout --}}
@extends('layout.default')

@section("styles")

@endsection

{{-- Content --}}
@section('content')
    <form class="form" id="form">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Detail Kontrak
                        <div class="text-muted pt-2 font-size-sm">Detail Kontrak</div>
                    </h3>
                </div>
            </div>
            <div class="card-body flex-wrap border-0 pt-6 pb-0">
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Perusahaan *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="input-group">
                            <select disabled id="perusahaan_field" class="form-control select2" name="perusahaan">
                                <option selected>{{$kontrak->perusahaan->nama}}</option>
                            </select>
                            <span></span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Kontrak Tentang *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <textarea type="text" id="tentang_field" class="form-control" name="tentang"
                                  placeholder="Masukkan tentang kontrak" disabled>{{$kontrak->tentang}}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Nomor Kontrak *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="nomor_field" class="form-control" name="nomor"
                               placeholder="Masukkan nomor kontrak" disabled value="{{$kontrak->nomor}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Tanggal Tentang Surat Pesanan *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="tanggal_surat_pesanan_field" class="form-control" readonly
                               name="tanggal_surat_pesanan" disabled
                               placeholder="Pilih Tanggal" value="{{ \Carbon\Carbon::parse($kontrak->tanggal_surat_pesanan)->format("d/M/Y") }}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Tanggal Serah Terima Barang *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="tanggal_serah_terima_field" class="form-control" readonly
                               name="tanggal_serah_terima" disabled value="{{ \Carbon\Carbon::parse($kontrak->tanggal_serah_terima_barang)->format("d/M/Y") }}"
                               placeholder="Pilih Tanggal"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">File Dokumen Surat Perjanjian/Kontrak
                        *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <a href="{{asset("uploads/perjanjian/". $kontrak->perjanjian->file_name)}}">{{$kontrak->perjanjian->original_name}}</a>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">File Dokumen Invoice *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <a href="{{asset("uploads/invoices/". $kontrak->invoice->file_name)}}">{{$kontrak->invoice->original_name}}</a>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Status</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" disabled id="" class="form-control" value="{{$kontrak->status}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Keterangan</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <textarea type="file" id="keterangan_field" class="form-control" name="keterangan" disabled>{{$kontrak->keterangan}}</textarea>
                    </div>
                </div>


            </div>
        </div>

        <div class="card card-custom mt-2">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title text-center">
                    <h3 class="card-label text-center">Detail Barang
                    </h3>
                </div>
            </div>

            <div class="card-body flex-wrap border-0 pt-6 pb-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Harga Barang</th>
                            <th>Satuan</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($total = 0)
                            @foreach($kontrak->barang as $key => $barang)
                                <tr>
                                    <td>{{ (1+$key) }}</td>
                                    <td>{{ $barang->nama }}</td>
                                    <td>{{ $barang->jumlah }}</td>
                                    <td>{{ $barang->harga }}</td>
                                    <td>{{ $barang->satuan }}</td>
                                    <td>Rp. {{ $barang->jumlah * $barang->harga }}</td>
                                </tr>
                                @php($total += $barang->jumlah * $barang->harga)
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-right"> Jumlah</td>
                                <td class=""> Rp. {{$total}}</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-right"> PPN 10%</td>
                                <td class=""> Rp. {{ $total != 0 ? $total * 10 / 100 : 0}}</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-right"> Jumlah Total</td>
                                <td class=""> Rp. {{ $total != 0 ? ($total * 10 / 100) + $total : 0}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection

@section("scripts")
    <script type="text/javascript">
        $(document).ready(function (){
            $("#perusahaan_field").select2();
        })
    </script>
@endsection
