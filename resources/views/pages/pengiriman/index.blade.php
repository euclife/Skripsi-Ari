{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Table Pengiriman
                    <div class="text-muted pt-2 font-size-sm">Table data pengiriman</div>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path
                                    d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                    fill="#000000" opacity="0.3"/>
                                <path
                                    d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                    fill="#000000"/>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Export
                    </button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                Choose an option:
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-print"></i>
                                    </span>
                                    <span class="navi-text">Print</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-copy"></i>
                                    </span>
                                    <span class="navi-text">Copy</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-excel-o"></i>
                                    </span>
                                    <span class="navi-text">Excel</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-text-o"></i>
                                    </span>
                                    <span class="navi-text">CSV</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-pdf-o"></i>
                                    </span>
                                    <span class="navi-text">PDF</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a href="{{route("Pengiriman.create")}}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                         version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" cx="9" cy="15" r="6"/>
                            <path
                                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>Tambah Pengiriman Barang</a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover" id="kt_datatable">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Progres Pengiriman</th>
                    <th>Aksi</th>
                    <th>Nama Perusahaan</th>
                    <th>Alamat Perusahaan</th>
                    <th>No Telp</th>
                    <th>Jumlah barang yang telah di kirim</th>
                    <th>Jumlah barang yang telah di pesan</th>
                    <th>Tanggal Pengiriman barang</th>
                    <th>Nama peneriman barang</th>
                    <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                        </td>
                        <td>PT. Indominco</td>
                        <td>Jl. Diponegoro</td>
                        <td>022-255214</td>
                        <td>10</td>
                        <td>15</td>
                        <td>Rp. 700.000</td>
                        <td>21/12/2020</td>
                        <td>Budi</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>

@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    {{-- page scripts --}}
    <script type="text/javascript">
        $.extend($.fn.dataTable.defaults, {
            language: {
                search: '<span>Cari :</span> _INPUT_',
                searchPlaceholder: '',
                lengthMenu: '<span>Menampilkan &nbsp; </span> _MENU_ <span> &nbsp; data</span>',
                sZeroRecords: "Tidak ditemukan data pengirman yang sesuai",
                sEmptyTable: "Tidak ada data pengiriman yang tersedia pada tabel ini",
                sInfo: "Menampilkan _START_-_END_ dari _TOTAL_ data",
                paginate: {
                    'first': 'Pertama',
                    'last': 'Terakhir',
                    'next': 'Selanjutnya',
                    'previous': 'Sebelumnya'
                }
            }
        });

        let table = $('#kt_datatable').DataTable({
            {{--ajax: '{{ route('Kontrak.index') }}',--}}
            {{--responsive: "true",--}}
            {{--processing: "true",--}}
            {{--serverSide: "true",--}}
            // columns: [
            //     {
            //         data: 'DT_RowIndex',
            //         name: 'DT_RowIndex',
            //     }, {
            //         data: 'id',
            //         className: "text-center",
            //         searchable: false,
            //         orderable: false,
            //         render: function (data, type, row) {
            //             $html = `<a href="${row.edit}" class="btn btn-icon btn-light-success btn-circle btn-sm mr-2">
			// 						<i class="flaticon2-edit"></i>
			// 					  </a>`;
            //             $html += `<a href="${row.show}" class="btn btn-icon btn-light-success btn-circle btn-sm mr-2">
			// 						<i class="fa fa-eye"></i>
			// 					  </a>`;
            //             $html += `<button type="button" data-url="${row.delete}" class="btnDelete btn btn-icon btn-light-danger btn-circle btn-sm mr-2">
			// 						<i class="flaticon2-delete"></i>
			// 					  </button>`;
            //             return $html;
            //         }
            //     },
            //     {
            //         data: 'perusahaan.nama',
            //         name: 'perusahaan.nama'
            //     },
            //     {
            //         data: 'perusahaan.alamat',
            //         name: 'perusahaan.alamat'
            //     },
            //     {
            //         data: 'perusahaan.nomor_telepon',
            //         name: 'perusahaan.nomor_telepon'
            //     },
            //     {
            //         data: 'tgl_serah_terima',
            //         name: 'tgl_serah_terima'
            //     },
            //     {
            //         data: 'status',
            //         name: 'status'
            //     },
            //     {
            //         data: 'keterangan',
            //         name: 'keterangan'
            //     }
            // ],
            initComplete: function () {
                // $("#btnExport").on("click", function () {
                //     tableData.button('.excelButton').trigger();
                // });
            }
        });

        $('#kt_datatable tbody').on('click', '.btnDelete', function () {
            let url = $(this).data("url");
            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText : "Tidak"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: "DELETE",
                        beforeSend : function(){
                            KTApp.blockPage({
                                overlayColor: '#000000',
                                state: 'danger',
                                message: 'Tunggu sebentar...'
                            });
                        },
                        success: function (resp) {
                            if (resp.status === 200) {
                                Swal.fire(
                                    'Terhapus!',
                                    `Akun dengan nama ${resp.data.name} sudah terhapus.`,
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Opps!',
                                    'Sepertinya ada masalah.',
                                    'error'
                                )
                            }
                        },
                        error : function(resp){
                            Swal.fire(
                                'Opps!',
                                'Sepertinya ada masalah.',
                                'error'
                            )
                        },
                        complete: function () {
                            table.columns.adjust().draw();
                            KTApp.unblockPage();
                        },
                    })
                }
            })
        });
    </script>
@endsection

