<div class="input-group-append">
     <span class="input-group-text">
        <button class="btn btn-icon text-warning" style="width: 10px;height: 10px" type="button" data-toggle="modal"
                data-target="#perusahaanModal">
            <i class="fa fa-plus text-warning"></i>
        </button>
     </span>

    <div wire:ignore.self class="modal fade" id="perusahaanModal" tabindex="-1" role="dialog"
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
                                    <input type="text" class="form-control" id="modal_nama_perusahaan_field"
                                           placeholder="Masukkan nama perusahaan" wire:model="nama">
                                    @error('nama') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-lg-12 pt-3">
                                    <label for="exampleFormControlInput2">Alamat *</label>
                                    <textarea type="email" class="form-control" id="modal_alamat_perusahaan_field"
                                              wire:model="alamat" placeholder="Masukkan alamat perusahaan"></textarea>
                                    @error('alamat') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-lg-12 pt-3">
                                    <label>Nomor Telepon *</label>
                                    <input type="text" class="form-control" id="modal_nomor_telepon_field"
                                           placeholder="Masukkan nomor telepon" wire:model="nomor_telepon">
                                    @error('nomor_telepon') <span
                                        class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-lg-12 pt-3">
                                    <label>Nomor Fax </label>
                                    <input type="text" class="form-control" id="modal_nomor_fax_field"
                                           placeholder="Masukkan nomor fax" wire:model="nomor_fax">
                                    @error('nomor_telepon') <span
                                        class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-lg-12 pt-3">
                                    <label>Website</label>
                                    <input type="text" class="form-control" id="modal_website_field"
                                           placeholder="Masukkan alamat website" wire:model="website">
                                    @error('website') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Provinsi *</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <select type="text" class="form-control select2" id="modal_provinsi_field"
                                                    wire:model="provinsi"></select>
                                            @error('provinsi') <span
                                                class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Kota *</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <select type="text" class="form-control select2" id="modal_kota_field"
                                                    wire:model="kota"></select>
                                            @error('kota') <span
                                                class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12">Kode Pos *</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12" wire:ignore>
                                            <select data-livewire="@this" type="text" class="form-control select2" id="modal_kode_pos_field"
                                                    wire:model="kode_pos"></select>
                                            @error('kode_pos') <span
                                                class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" id="btnStorePerusahaan" class="btn btn-primary close-modal">Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            let namaPerusahaanField = $("#modal_nama_perusahaan_field");
            let alamatPerusahaanField = $("#modal_alamat_perusahaan_field");
            let nomorTeleponField = $("#modal_nomor_telepon_field");
            let nomorFaxField = $("#modal_nomor_fax_field");
            let website = $("#modal_website_field");
            let provinsiField = $("#modal_provinsi_field");
            let kotaField = $("#modal_kota_field");
            let kodePosField = $("#modal_kode_pos_field");

            let perusahaanModal = $("#perusahaanModal");
            let formPerusahaan = $("#formPerusahaaan");

            let urlProvinsi = 'https://kodepos-2d475.firebaseio.com/list_propinsi.json';
            let urlKota = 'https://kodepos-2d475.firebaseio.com/list_kotakab/';
            let urlKodePos = 'https://kodepos-2d475.firebaseio.com/kota_kab/';

            $.fn.modal.Constructor.prototype.enforceFocus = function() {};

            function onStart() {
                getProvinsi();
            }

            perusahaanModal.on('hidden.bs.modal', function () {
                formPerusahaaan.trigger("reset");
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
                }else{
                    kotaField.select2({
                        placeholder: "Pilih dulu provinsi",
                    });
                }
            });

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
                            kodePosField.append(`<option value="${item.kelurahan + " - " + item.kodepos}">${item.kelurahan + " - " + item.kodepos}</option>`);
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

            function StorePerusahaan(){

            }

            kotaField.select2({
                placeholder: "Pilih dulu provinsi",
            });

            kodePosField.select2({
                placeholder: "Pilih dulu kota",
            });

            onStart();
        });

        window.livewire.on('perusahaanStore', () => {
            $('#perusahaanModal').modal('hide');
        });
    </script>
@endpush
