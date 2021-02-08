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
                {{ method_field('PUT') }}
                <input name="id" value="{{$barang->id}}" readonly style="display:none">
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Nama Barang *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="nama_barang_field" class="form-control" name="nama_barang"
                               placeholder="Masukkan nama barang" value="{{$barang->nama}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Nama Satuan Barang *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="satuan_barang_field" class="form-control" name="nama_satuan"
                               placeholder="Masukkan satuan barang" value="{{$barang->satuan}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Jumlah *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="number" id="jumlah_field" class="form-control" name="jumlah_barang"
                               placeholder="Masukkan jumlah field" value="{{$barang->jumlah}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Harga Satuan *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="number" id="harga_satuan_field" class="form-control" name="harga_satuan"
                               placeholder="Masukkan harga satuan barang" value="{{$barang->harga}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Total *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="number" id="total_field" class="form-control" name="total" readonly value="{{($barang->harga * $barang->jumlah)}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Nota Pembelian Barang *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="file" id="nota_pembelian_field" class="form-control" name="nota_pembelian"
                               readonly/>
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
                        <select type="text" id="nama_perusahaan_field" class="form-control select2"
                                name="nama_perusahaan" data-value="{{$barang->id_kontrak}}"></select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9 ml-lg-auto mb-3">
                        <button type="button" id="btnSubmit" class="btn btn-primary font-weight-bold mr-2">Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section("scripts")
    <script type="text/javascript">
        const form = document.getElementById('form');
        const formData = $("#form");

        $(document).ready(function () {
            let namaBarangField = $("#nama_barang_field");
            let namaPerusahaanField = $("#nama_perusahaan_field");
            let satuanBarangField = $("#satuan_barang_field");
            let hargaSatuanField = $("#harga_satuan_field");
            let totalField = $("#total_field");
            let notaPembelianBarang = $("#nota_pembelian_field");
            let jumlahBarangField = $("#jumlah_field");
            getPerusahaan();
            const fv = FormValidation.formValidation(form, {
                fields: {
                    nama_barang: {
                        validators: {
                            notEmpty: {
                                message: 'Nama barang harus di isi'
                            },
                        }
                    },

                    satuan_barang: {
                        validators: {
                            notEmpty: {
                                message: 'Satuan barang harus di isi'
                            },
                        }
                    },

                    jumlah_barang: {
                        validators: {
                            notEmpty: {
                                message: 'Jumlah barang harus di isi'
                            },
                        }
                    },

                    harga_satuan: {
                        validators: {
                            notEmpty: {
                                message: 'Jumlah barang harus di isi'
                            },
                        }
                    },

                    nota_pembelian: {
                        validators: {
                            file: {
                                extension: 'pdf',
                                maxSize: 2097152,   // 2048 * 1024
                                message: 'File harus berupa pdf dan tidak boleh lebh dari 2mb'
                            },
                        }
                    },

                    nama_perusahaan: {
                        validators: {
                            notEmpty: {
                                message: 'Perusahaan pemesan barang harus di isi'
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

            function getPerusahaan() {
                $.ajax({
                    url: '{{route("Perusahaan.index")}}?contract=t',
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function () {
                        namaPerusahaanField.empty().append(`<option></option>`).select2({
                            placeholder: "Loading...",
                        });
                    },
                    success: function (result) {
                        $.each(result.data, function (index, item) {
                            namaPerusahaanField.append(`<option value="${item.id}" >${item.nama}</option>`);
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ada sesuatu yang salah'
                        })

                    },
                    complete: function () {
                        namaPerusahaanField.select2({
                            placeholder: "Pilih Perusahaan",
                        });
                        namaPerusahaanField.val(namaPerusahaanField.data("value")).trigger("change");
                    }
                });
            }

            hargaSatuanField.change(function (){
                setTotal();
            });

            jumlahBarangField.change(function (){
                setTotal();
            });

            $('#btnSubmit').click(function () {
                fv.validate().then(function (status) {
                    if (status === "Valid") {
                        Swal.fire({
                            title: 'Apa anda yakin?',
                            text: "Anda akan memperbarui data barang!",
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

            function setTotal(){
                if(jumlahBarangField.val() != null && jumlahBarangField.val() !== "" && hargaSatuanField.val() != null && hargaSatuanField.val() !== "" )
                    totalField.val((jumlahBarangField.val() * hargaSatuanField.val()));
                else totalField.val(0);
            }

            function ajaxPost() {
                $.ajax({
                    url: '{{route("Barang.update",$barang->id)}}',
                    type: 'POST',
                    data: new FormData(formData[0]),
                    cache: false,
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
                            title: 'Data barang berhasil di perbaharui',
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

            function setTextError(name, selector , type="notEmpty") {
                if (typeof name !== 'undefined') {
                    $.each(name, function (key, value) {
                        selector.next(".fv-plugins-message-container").append(`
						 <div data-field="name" data-validator="${type}" class="fv-help-block">${value}</div>`);
                    });
                }
            }

            function setError(data) {
                setTextError(data.nama_barang,namaBarangField);
                setTextError(data.nama_satuan,satuanBarangField);
                setTextError(data.jumlah_barang,jumlahBarangField);
                setTextError(data.harga_satuan,hargaSatuanField);
                setTextError(data.nota_pembelian,notaPembelianBarang, "file");
            }
        });
    </script>
@endsection
