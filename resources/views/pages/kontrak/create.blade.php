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
                    <h3 class="card-label">Tambah Kontrak
                        <div class="text-muted pt-2 font-size-sm">Tambah Kontrak</div>
                    </h3>
                </div>
            </div>
            <div class="card-body flex-wrap border-0 pt-6 pb-0">
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Perusahaan *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="input-group">
                            <select id="perusahaan_field" class="form-control select2" name="perusahaan">
                                <option></option>
                            </select>
                            <span></span>
                            <div class="input-group-append">
								 <span class="input-group-text">
									<button class="btn btn-icon text-warning" style="width: 10px;height: 10px"
                                            type="button" data-toggle="modal"
                                            data-target="#perusahaanModal">
										<i class="fa fa-plus text-warning"></i>
									</button>
								 </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Kontrak Tentang *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <textarea type="text" id="tentang_field" class="form-control" name="tentang"
                                  placeholder="Masukkan tentang kontrak"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Nomor Kontrak *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="nomor_field" class="form-control" name="nomor"
                               placeholder="Masukkan nomor kontrak"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Tanggal Tentang Surat Pesanan *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="tanggal_surat_pesanan_field" class="form-control" readonly
                               name="tanggal_surat_pesanan"
                               placeholder="Pilih Tanggal"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Tanggal Serah Terima Barang *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="tanggal_serah_terima_field" class="form-control" readonly
                               name="tanggal_serah_terima"
                               placeholder="Pilih Tanggal"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">File Dokumen Surat Perjanjian/Kontrak
                        *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="file" id="file_dokumen_surat_perjanjian" class="form-control"
                               name="file_dokumen_perjanjian">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">File Dokumen Invoice *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="file" id="file_dokumen_invoice" class="form-control" name="file_dokumen_invoice">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Status</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" disabled id="" class="form-control" value="Dalam Pengerjaan">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Keterangan</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <textarea type="file" id="keterangan_field" class="form-control" name="keterangan"></textarea>
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Total *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="total" readonly class="form-control" name="total"
                               placeholder="0"/>
                    </div>
                </div> -->

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
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>Nama Barang:</label>
                            <input type="text" class="form-control" name="barang[0][nama_barang]" placeholder=""/>
                        </div>
                        <div class="col-lg-2">
                            <label>Jumlah Barang : </label>
                            <input type="number" class="form-control jumlah_barang" onchange="kalkulasitotal(this)" id="jumlah_barang"
                                   name="barang[0][jumlah_barang]"/>
                        </div>
                        <div class="col-lg-2">
                            <label>Satuan:</label>
                            <input type="text" class="form-control" id="satuan" placeholder="ex : kg, cm, pcs, dll"
                                   name="barang[0][satuan]"/>
                        </div>
                        <div class="col-lg-2">
                            <label>Harga Satuan:</label>
                            <input type="number" class="form-control harga_barang" onchange="kalkulasitotal(this)" name="barang[0][harga_satuan]"/>
                        </div>
                        <div class="col-lg-2">
                            <label>Total Harga:</label>
                            <input type="text" class="form-control total" readonly id="" name="barang[0][total_harga]"/>
                        </div>
                        <div class="col-lg-1">
                            <label></label>
                            <button type="button" class="btn btn-danger mt-2 btnHapusBarang" onclick="hapusBarang(this)"
                                    data-id="0">Hapus
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 ml-lg-auto mb-3 mx-auto">
                        <button type="button" id="btnTambahBarang" class="btn btn-primary font-weight-bold mr-2">Tambah
                            Barang
                        </button>
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


    <div class="modal fade" id="perusahaanModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Perusahaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body pb-1">
                    <form id="formPerusahaaan">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <label>Nama Perusahaan *</label>
                                    <input type="text" class="form-control" id="modal_nama_perusahaan_field" name="nama"
                                           placeholder="Masukkan nama perusahaan">
                                    <span></span>
                                </div>
                                <div class="col-lg-12 pt-3">
                                    <label for="exampleFormControlInput2">Alamat *</label>
                                    <textarea type="email" class="form-control" id="modal_alamat_perusahaan_field"
                                              placeholder="Masukkan alamat perusahaan" name="alamat"></textarea>
                                    <span></span>
                                </div>
                                <div class="col-lg-12 pt-3">
                                    <label>Nomor Telepon *</label>
                                    <input type="text" class="form-control" id="modal_nomor_telepon_field"
                                           placeholder="Masukkan nomor telepon" name="nomor_telepon">
                                    <span></span>
                                </div>

                                <div class="col-lg-12 pt-3">
                                    <label>Nomor Fax </label>
                                    <input type="text" class="form-control" id="modal_nomor_fax_field"
                                           placeholder="Masukkan nomor fax" name="nomor_fax">
                                    <span></span>
                                </div>

                                <div class="col-lg-12 pt-3">
                                    <label>Website</label>
                                    <input type="text" class="form-control" id="modal_website_field"
                                           placeholder="Masukkan alamat website" name="website">
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Provinsi *</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <select type="text" class="form-control select2" name="provinsi"
                                                    id="modal_provinsi_field"></select>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Kota *</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <select type="text" class="form-control select2" id="modal_kota_field"
                                                    name="kota"></select>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Kode Pos *</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <select name="kode_pos" type="text" class="form-control select2"
                                                    id="modal_kode_pos_field"></select>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" id="btnCloseModal"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" id="btnStorePerusahaan" class="btn btn-primary close-modal">Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
    <script type="text/javascript">
        const form = document.getElementById('form');
        const formData = $("#form");
        const formPerusahaanValidation = document.getElementById('formPerusahaaan');
        let namaPerusahaanField = $("#modal_nama_perusahaan_field");
        let alamatPerusahaanField = $("#modal_alamat_perusahaan_field");
        let nomorTeleponField = $("#modal_nomor_telepon_field");
        let nomorFaxField = $("#modal_nomor_fax_field");
        let websiteField = $("#modal_website_field");
        let provinsiField = $("#modal_provinsi_field");
        let kotaField = $("#modal_kota_field");
        let kodePosField = $("#modal_kode_pos_field");
        let btnPerusahaanStore = $("#btnStorePerusahaan");

        let perusahaanModal = $("#perusahaanModal");
        let formPerusahaan = $("#formPerusahaaan");

        let urlProvinsi = 'https://kodepos-2d475.firebaseio.com/list_propinsi.json';
        let urlKota = 'https://kodepos-2d475.firebaseio.com/list_kotakab/';
        let urlKodePos = 'https://kodepos-2d475.firebaseio.com/kota_kab/';

        let perusahaanField = $("#perusahaan_field");
        let tanggalSuratPesananField = $("#tanggal_surat_pesanan_field");
        let tanggalSerahTerimaBarang = $("#tanggal_serah_terima_field");
        let tentangField = $("#tentang_field");
        let fileDokumenPerjanjianField = $("#file_dokumen_surat_perjanjian");
        let fileDokumenInvoice = $("#file_dokumen_invoice");
        let keteranganField = $("#keterangan_field");

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

        function hapusBarang(elem) {
            $(elem).parents(".form-group").remove();
        }

        function kalkulasitotal(elem) {
            let jumlah = $(elem).parents(".form-group").find(".jumlah_barang").val();
            let harga = $(elem).parents(".form-group").find(".harga_barang").val();

            if(jumlah != null && jumlah !==""&&harga != null && harga !==""){
                $(elem).parents(".form-group").find(".total").val((jumlah * harga));
            }
        }

        $(document).ready(function () {
            $.fn.modal.Constructor.prototype.enforceFocus = function () {
            };
            const fv = FormValidation.formValidation(form, {
                fields: {
                    perusahaan: {
                        validators: {
                            notEmpty: {
                                message: 'Nama Perusahaan harus di isi'
                            },
                        }
                    },

                    tentang: {
                        validators: {
                            notEmpty: {
                                message: 'Tentang harus di isi'
                            },
                        }
                    },

                    nomor: {
                        validators: {
                            notEmpty: {
                                message: 'Nomor Kontrak harus di isi'
                            },
                        }
                    },

                    tanggal_surat_pesanan: {
                        validators: {
                            notEmpty: {
                                message: 'Tanggal Surat Pesanan harus di isi'
                            },
                        }
                    },

                    file_dokumen_invoice: {
                        validators: {
                            notEmpty: {
                                message: 'Dokumen Invoice harus di isi'
                            },
                            file: {
                                extension: 'pdf,jpg,png',
                                type: 'image/jpeg,image/png,pdf',
                                maxSize: 2097152,   // 2048 * 1024
                                message: 'File harus berupa pdf/gambar dan tidak boleh lebh dari 2mb'
                            },
                        }
                    },

                    file_dokumen_perjanjian: {
                        validators: {
                            notEmpty: {
                                message: 'File Perjanjian harus di isi'
                            },
                            file: {
                                extension: 'pdf,jpg,png',
                                type: 'image/jpeg,image/png,pdf',
                                maxSize: 2097152,   // 2048 * 1024
                                message: 'File harus berupa pdf/gambar dan tidak boleh lebh dari 2mb'
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
            const fvPerusahaan = FormValidation.formValidation(formPerusahaanValidation, {
                fields: {
                    nama: {
                        validators: {
                            notEmpty: {
                                message: 'Nama harus di isi'
                            },
                        }
                    },

                    alamat: {
                        validators: {
                            notEmpty: {
                                message: 'Alamat harus di isi'
                            },
                        }
                    },

                    nomor_telepon: {
                        validators: {
                            notEmpty: {
                                message: 'No telepon harus di isi'
                            },
                            phone: {
                                country: 'ID',
                                message: 'Nomor Telepon tidak sesuai'
                            }
                        }
                    },

                    nomor_fax: {
                        validators: {
                            digits: {
                                message: 'The velue is not a valid digits'
                            }
                        }
                    },

                    website: {
                        validators: {
                            uri: {
                                message: 'Url tidak sesuai'
                            }
                        }
                    },

                    provinsi: {
                        validators: {
                            notEmpty: {
                                message: 'Harap pilih salah satu'
                            }
                        }
                    },

                    kota: {
                        validators: {
                            notEmpty: {
                                message: 'Harap pilih salah satu'
                            }
                        }
                    },

                    kode_pos: {
                        validators: {
                            notEmpty: {
                                message: 'Harap pilih salah satu'
                            }
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

            btnTambahBarang.click(function () {
                $("#formBarang").append(`
					<div class="form-group row">
						<div class="col-lg-3">
							<label>Nama Barang:</label>
							<input type="text" class="form-control" name="barang[${detailBarang}][nama_barang]" placeholder="" />
						</div>
						<div class="col-lg-2">
							<label>Jumlah Barang : </label>
							<input type="number" class="form-control jumlah_barang" onchange="kalkulasitotal(this)" id="jumlah_barang" name="barang[${detailBarang}][jumlah_barang]"/>
						</div>
						<div class="col-lg-2">
							<label>Satuan:</label>
							<input type="text" class="form-control" id="satuan" placeholder="ex : kg, cm, pcs, dll" name="barang[${detailBarang}][satuan]"/>
						</div>
						<div class="col-lg-2">
							<label>Harga Satuan:</label>
							<input type="number" class="form-control harga_barang" onchange="kalkulasitotal(this)" name="barang[${detailBarang}][harga_satuan]"/>
						</div>
						<div class="col-lg-2">
							<label>Total Harga:</label>
							<input type="text" class="form-control total" readonly id="satuan" name="barang[${detailBarang}][total_harga]"/>
						</div>
						<div class="col-lg-1">
							<label></label>
							<button type="button" onclick="hapusBarang(this)" class="btn btn-danger mt-2 btnHapusBarang" data-id="0" >Hapus</button>
						</div>
					</div>`);
                detailBarang++;
            });
            btnPerusahaanStore.click(function () {
                fvPerusahaan.validate().then(function (status) {
                    if (status === "Valid") {
                        Swal.fire({
                            title: 'Apa anda yakin?',
                            text: "Anda akan membuat perusahaan baru!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                storePerusahaan();
                            }
                        })
                    }
                });
            });

            function onStart() {
                getProvinsi();
                getPerusahaan();
            }

            function ajaxPost() {
                $.ajax({
                    url: '{{route("Kontrak.store")}}',
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
                setTextError(data.file_dokumen_perjanjian, fileDokumenPerjanjianField);
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
                    url: '{{route("Perusahaan.index")}}',
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

            function getProvinsi() {
                $.ajax({
                    url: urlProvinsi,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function () {
                        provinsiField.empty().append(`<option></option>`).select2({
                            placeholder: "Loading...",
                        });
                    },
                    success: function (result) {
                        $.each(result, function (index, item) {
                            provinsiField.append(`<option value="${item}" data-id="${index}">${item}</option>`);
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ada sesuatu yang salah'
                        })

                    },
                    complete: function () {
                        provinsiField.select2({
                            placeholder: "Pilih provinsi",
                        }).trigger("change");
                    }
                });
            }

            function getKota($id) {
                $.ajax({
                    url: urlKota + $id + '.json',
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function () {
                        kotaField.empty().append(`<option></option>`).select2({
                            placeholder: "Loading...",
                        });
                    },
                    success: function (result) {
                        $.each(result, function (index, item) {
                            kotaField.append(`<option value="${item}" data-id="${index}">${item}</option>`);
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ada sesuatu yang salah'
                        })
                    },
                    complete: function () {
                        kotaField.select2({
                            placeholder: "Pilih kota",
                        }).trigger("change");
                    }
                });
            }

            function getKodePos($id) {
                $.ajax({
                    url: urlKodePos + $id + '.json',
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function () {
                        kodePosField.empty().append(`<option></option>`).select2({
                            placeholder: "Loading..."
                        }).trigger("change");
                    },
                    success: function (result) {
                        $.each(result, function (index, item) {
                            kodePosField.append(`<option value="${item.kodepos}">${item.kelurahan + " - " + item.kodepos}</option>`);
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ada sesuatu yang salah'
                        })

                    },
                    complete: function () {
                        kodePosField.select2({
                            placeholder: "Pilih kode pos",
                        }).trigger("change");
                    }
                });
            }

            function storePerusahaan() {
                $.ajax({
                    url: '{{route("Perusahaan.store")}}',
                    type: 'POST',
                    data: $("#formPerusahaaan").serialize(),
                    dataType: 'JSON',
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
                            title: 'Perusahaan berhasil di buat',
                            onClose: () => {
                                getPerusahaan();
                                $("#btnCloseModal").trigger("click");
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
                            setErrorPerusahaan(obj.errors);
                        }
                    },
                    complete: function () {
                        KTApp.unblockPage();
                    }
                });
            }

            perusahaanModal.on('hidden.bs.modal', function () {
                formPerusahaan.trigger("reset");
                kodePosField.val(null).trigger("change");
                kotaField.val(null).trigger("change");
                provinsiField.val(null).trigger("change");
            })

            provinsiField.change(function () {
                if (provinsiField.val() != null && provinsiField.val() !== "") {
                    getKota(provinsiField.find(":selected").data("id"));
                } else {
                    kotaField.select2({
                        placeholder: "Pilih dulu provinsi",
                    });
                }
            });
            kotaField.change(function () {
                if (kotaField.val() != null && kotaField.val() !== "") {
                    getKodePos(kotaField.find(":selected").data("id"));
                } else {
                    kodePosField.select2({
                        placeholder: "Pilih dulu provinsi",
                    });
                }
            });

            kotaField.select2({
                placeholder: "Pilih dulu provinsi",
            });
            kodePosField.select2({
                placeholder: "Pilih dulu kota",
            });
            perusahaanField.select2({
                placeholder: "Pilih perusahaan",
            });

            tanggalSuratPesananField.datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                orientation: "bottom left",
                templates: arrows,
                autoclose: true
            });
            tanggalSerahTerimaBarang.datepicker({
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
                            text: "Anda akan membuat kontrak baru!",
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
