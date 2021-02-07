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
                    <h3 class="card-label">Lihat Pengiriman
                        <div class="text-muted pt-2 font-size-sm">Lihat Pengiriman</div>
                    </h3>
                </div>
            </div>
            <div class="card-body flex-wrap border-0 pt-6 pb-0">
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Perusahaan *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="input-group">
                            <input disabled id="perusahaan_field" class="form-control" name="perusahaan" value="{{$pengiriman->kontrak->perusahaan->nama}}">
                            <span></span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Kontrak Tentang</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <textarea type="text" disabled id="tentang_field" class="form-control"
                                  placeholder="Masukkan tentang kontrak">{{$pengiriman->kontrak->tentang}}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Nomor Kontrak</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="nomor_field" class="form-control" value="{{$pengiriman->kontrak->nomor}}"
                               placeholder="Masukkan nomor kontrak" disabled/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Tanggal Tentang Surat Pesanan *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="tanggal_surat_pesanan_field" class="form-control" value="{{$pengiriman->kontrak->tanggal_surat_pesanan}}"
                               placeholder="Pilih Tanggal" disabled/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Tanggal Serah Terima Barang *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="tanggal_serah_terima_field" class="form-control"  disabled value="{{$pengiriman->kontrak->tanggal_serah_terima_barang}}"
                               placeholder="Pilih Tanggal"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Status</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" disabled id="statusField" class="form-control" value="{{$pengiriman->kontrak->status}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Keterangan</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <textarea type="file" id="keterangan_field" disabled class="form-control">{{$pengiriman->kontrak->keterangan}}</textarea>
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
                <div class="form" id="formBarang">
                    @foreach($pengiriman->detail_pengiriman as $value)
                        <div class="form-group row">
                            <input type="text" class="form-control" style="display: none" value="${id}" name="barang[${detailBarang}][id]" />
                            <div class="col-lg-3">
                                <label>Nama Barang:</label>
                                <input type="text" class="form-control" value="{{$value->barang->nama}}" disabled/>
                            </div>
                            <div class="col-lg-2">
                                <label>Jumlah Barang : </label>
                                <input type="number" class="form-control" disabled onchange="kalkulasitotal(this)" value="{{$value->barang->jumlah}}"/>
                            </div>
                            <div class="col-lg-1">
                                <label>Satuan:</label>
                                <input type="text" class="form-control" disabled placeholder="ex : kg, cm, pcs, dll" value="{{$value->barang->satuan}}"/>
                            </div>
                            <div class="col-lg-2">
                                <label>Harga Satuan:</label>
                                <input type="number" class="form-control" disabled onchange="kalkulasitotal(this)" value="{{$value->barang->harga}}"/>
                            </div>
                            <div class="col-lg-2">
                                <label>Total Harga:</label>
                                <input type="text" class="form-control" disabled value="{{$value->barang->jumlah * $value->barang->harga}}"/>
                            </div>
                            <div class="col-lg-2">
                                <label>Jumlah Kirim</label>
                                <input type="number" max="${kirim}" disabled class="form-control jumlah_kirim" onchange="setJumlah()" name="barang[${detailBarang}][kirim]" value="{{$value->jumlah_kirim}}"/>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group row">
                </div>
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Detail Pengiriman
                        <div class="text-muted pt-2 font-size-sm">Detail Pengiriman</div>
                    </h3>
                </div>
            </div>
            <div class="card-body flex-wrap border-0 pt-6 pb-0">
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Tanggal Pengiriman *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="tanggal_pengiriman_field" disabled name="tanggal_pengiriman" class="form-control" value="{{$pengiriman->tanggal_pengiriman}}"
                               placeholder="Pilih Tanggal"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Nama Penerima *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="nama_penerima_field" class="form-control" disabled name="nama_penerima" value="{{$pengiriman->nama_penerima}}"
                               placeholder="Masukkan nama penerima"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Keterangan</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <textarea type="text" id="keterangan_pengiriman_field" class="form-control" disabled
                                  placeholder="Keterangan">{{$pengiriman->keterangan}}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Jumlah di kirim</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="jumlah_field" class="form-control" name="jumlah" disabled value="{{$pengiriman->jumlah}}"
                               placeholder="Total di kirim"/>
                    </div>
                </div>

                <div class="form-group row mt-5">
                    <div class="col-lg-12 ml-lg-auto mb-3 mx-auto text-center">
                        <button type="button" id="btnSubmit" class="btn btn-warning font-weight-bold mr-2">Simpan
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>



@endsection

@section("scripts")
    <script type="text/javascript">
        const form = document.getElementById('form');
        const formData = $("#form");

        let perusahaanField = $("#perusahaan_field");
        let tanggalSuratPesananField = $("#tanggal_surat_pesanan_field");
        let tanggalSerahTerimaBarang = $("#tanggal_serah_terima_field");
        let tentangField = $("#tentang_field");
        let keteranganField = $("#keterangan_field");
        let statusField = $("#statusField");
        let nomorTeleponField = $("#modal_nomor_telepon_field");
        let nomorKontrakField = $("#nomor_field");
        let tanggalPengirimanField = $("#tanggal_pengiriman_field");
        let namaPenerimaField = $("#nama_penerima_field");
        let keteranganPengirimField = $("#keterangan_pengiriman_field");
        let jumlahField = $("#jumlah_field");

        let btnTambahBarang = $("#btnTambahBarang");
        let detailBarang = 1;

        let btnSubmit = $("#btnSubmit");

        var arrows;
        if (KTUtil.isRTL()) {
            arrows = {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            }
        } else {
            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        }

        function kalkulasitotal(elem) {
            let jumlah = $(elem).parents(".form-group").find(".jumlah_barang").val();
            let harga = $(elem).parents(".form-group").find(".harga_barang").val();

            if (jumlah != null && jumlah !== "" && harga != null && harga !== "") {
                $(elem).parents(".form-group").find(".total").val((jumlah * harga));
            }
        }

        function setJumlah(){
            let jumlah = 0;
            $('#formBarang').find('.jumlah_kirim').each(function() {
                if($(this).val()){
                    jumlah += parseInt($(this).val());
                }
            });
            jumlahField.val(jumlah);
        }

        $(document).ready(function () {
            const fv = FormValidation.formValidation(form, {
                fields: {
                    perusahaan: {
                        validators: {
                            notEmpty: {
                                message: 'Nama Perusahaan harus di isi'
                            },
                        }
                    },
                },

                plugins: { //Learn more: https://formvalidation.io/guide/plugins
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    alias: new FormValidation.plugins.Alias({
                        required: 'notEmpty',
                        checkStrength: 'callback',
                        checkUppercase: 'callback',
                        checkLowercase: 'callback',
                        checkDigit: 'callback',
                    }),
                }
            });

            function addBarang(id, nama, jumlah, satuan, harga, kirim) {
                $("#formBarang").append(`
					<div class="form-group row">
							<input type="text" class="form-control" style="display: none" value="${id}" name="barang[${detailBarang}][id]" />
						<div class="col-lg-3">
							<label>Nama Barang:</label>
							<input type="text" class="form-control" value="${nama}" disabled/>
						</div>
						<div class="col-lg-2">
							<label>Jumlah Barang : </label>
							<input type="number" class="form-control" disabled onchange="kalkulasitotal(this)" value="${jumlah}"/>
						</div>
						<div class="col-lg-1">
							<label>Satuan:</label>
							<input type="text" class="form-control" disabled placeholder="ex : kg, cm, pcs, dll" value="${satuan}"/>
						</div>
						<div class="col-lg-2">
							<label>Harga Satuan:</label>
							<input type="number" class="form-control" disabled onchange="kalkulasitotal(this)" value="${harga}"/>
						</div>
						<div class="col-lg-2">
							<label>Total Harga:</label>
							<input type="text" class="form-control" disabled value="${jumlah * harga}"/>
						</div>
						<div class="col-lg-2">
							<label>Jumlah Kirim</label>
							<input type="number" max="${kirim}" class="form-control jumlah_kirim" onchange="setJumlah()" name="barang[${detailBarang}][kirim]"/>
						</div>
					</div>`);
                detailBarang++;
            };

            function onStart() {
                // getPerusahaan();
            }

            function ajaxPost() {
                $.ajax({
                    url: '{{route("Pengiriman.store")}}',
                    type: 'POST',
                    data: new FormData(formData[0]),
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'danger',
                            message: 'Tunggu sebentar...'
                        });
                    },
                    success: function (result) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Kontrak berhasil di buat',
                            onClose: () => {
                                window.location.href = result.redirect;
                            }
                        })
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ada sesuatu yang salah'
                        })

                        let obj = JSON.parse(xhr.responseText);
                        if (typeof obj.errors !== 'undefined') {
                            setError(obj.errors);
                        }
                    },
                    complete: function () {
                        KTApp.unblockPage();
                    }
                });
            }

            function setTextError(name, selector) {
                if (typeof name !== 'undefined') {
                    $.each(name, function (key, value) {
                        selector.next(".fv-plugins-message-container").append(`
						 <div data-field="name" data-validator="notEmpty" class="fv-help-block">${value}</div>`);
                    });
                }
            }

            function setError(data) {
                setTextError(data.perusahaan, perusahaanField);
                setTextError(data.tentang, tentangField);
                setTextError(data.nomor, nomorTeleponField);
                setTextError(data.tanggal_surat_pesanan, tanggalSuratPesananField);
                setTextError(data.tanggal_serah_terima, tanggalSerahTerimaBarang);
                setTextError(data.file_dokumen_invoice, fileDokumenInvoice);
                setTextError(data.keterangan, keteranganField);
            }

            function setErrorPerusahaan(data) {
                setTextError(data.nama, namaPerusahaanField);
                setTextError(data.alamat, alamatPerusahaanField);
                setTextError(data.website, website);
                setTextError(data.provinsi, provinsiField);
                setTextError(data.kota, kotaField);
                setTextError(data.kode_pos, kodePosField);
            }

            function getPerusahaan() {
                $.ajax({
                    url: '{{route("Perusahaan.index")}}?contract=t',
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function () {
                        perusahaanField.empty().append(`<option></option>`).select2({
                            placeholder: "Loading...",
                        });
                    },
                    success: function (result) {
                        $.each(result.data, function (index, item) {
                            perusahaanField.append(`<option value="${item.id}" >${item.nama}</option>`);
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ada sesuatu yang salah'
                        })
                    },
                    complete: function () {
                        perusahaanField.select2({
                            placeholder: "Pilih Perusahaan",
                        }).trigger("change");
                    }
                });
            }

            perusahaanField.change(function () {
                if (perusahaanField.val() != null && perusahaanField.val() !== "") {
                    getDetailPerusahaan(perusahaanField.val());
                } else {
                    tentangField.val(null);
                    nomorTeleponField.val(null);
                    tanggalSerahTerimaBarang.val(null);
                    tanggalSuratPesananField.val(null);
                    statusField.val(null);
                    keteranganField.val(null);
                }
            });

            function getDetailPerusahaan(id) {
                $.ajax({
                    url: `{{route("Kontrak.show",'')}}/${id}`,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function () {
                        KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'danger',
                            message: 'Tunggu sebentar...'
                        });
                    },
                    success: function (result) {
                        let data = result.data.kontrak;
                        tentangField.val(data.tentang);
                        nomorTeleponField.val(data.nomor);
                        tanggalSerahTerimaBarang.val(data.tanggal_serah_terima_barang);
                        tanggalSuratPesananField.val(data.tanggal_surat_pesanan);
                        statusField.val(data.status);
                        keteranganField.val(data.keterangan);
                        nomorKontrakField.val(data.nomor);

                        let barang = result.data.barang;
                        $.each(barang, function (key, value) {
                            addBarang(value.id,value.nama,value.jumlah,value.satuan, value.harga, (value.jumlah - value.dikirim));
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ada sesuatu yang salah'
                        })
                    },
                    complete: function () {
                        KTApp.unblockPage();
                    }
                });
            }

            tanggalPengirimanField.datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                orientation: "bottom left",
                templates: arrows,
                autoclose: true
            });



            $('#btnSubmit').click(function () {
                fv.validate().then(function (status) {
                    if (status === "Valid") {
                        Swal.fire({
                            title: 'Apa anda yakin?',
                            text: "Anda akan membuat pengiriman baru!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                ajaxPost();
                            }
                        })
                    }
                });
            });

            onStart();
        });
    </script>
@endsection
