@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatable/fixedColumns.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatable/datatable-custom-fixed-coloumns.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.checkboxes.css') }}">
    <script src="{{ asset('plugins/datatable/dataTables.checkboxes.min.js') }}"></script>
@endpush
@section('content')
    <style>
    </style>
    <div style="" class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pembayaran Setoran</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex ">
                                    <div class="mr-auto col-3  ">
                                        <x-select2 id="mobil_id" label="Filter Mobil" required="false"
                                            placeholder="Pilih Mobil">
                                            <option value="all">Semua Mobil</option>
                                            @foreach ($mobil as $item)
                                                <option value="{{ $item->id }}">{{ $item->plat }}</option>
                                            @endforeach
                                        </x-select2>
                                    </div>
                                    <div style="margin-top:32px" class="p-2"><button id="btn_bayar" type="button"
                                            class="btn btn-primary"><i
                                                class="mr-1 fas fa-file-invoice-dollar  nav-icon"></i> Bayar</button></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="card-body table-responsive">
                                        <table id="datatable" class="table table-bordered table_fixed">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>No</th>
                                                    <th>Supir</th>
                                                    <th>Uang Jalan</th>
                                                    <th>Uang Tambahan</th>
                                                    <th>Uang Kurangan</th>
                                                    <th>PG</th>
                                                    <th>TTU</th>
                                                    <th>Transportir</th>
                                                    <th>Tgl Muat</th>
                                                    <th>Berat</th>
                                                    <th>Tujuan</th>
                                                    <th>Harga</th>
                                                    <th>Total Kotor</th>
                                                    <th>Total Bersih</th>
                                                    <th>Created_at</th>
                                                    <th>#Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@include('app.pembayaran.modal-hasil-bayar')
@push('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/fh-3.3.1/sl-1.5.0/datatables.min.js">
    </script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2-min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/id.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('plugins/autoNumeric.min.js') }}"></script>
    <script src="{{ asset('plugins/datatable/dataTables.fixedColumns.min.js') }}"></script>
    <script src="{{ asset('plugins/datatable/dataTables.checkboxes.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tujuan_id').prop('readonly', true);
            $('#transportir_id').prop('readonly', true);
            $('#harga').prop('readonly', true);
            $('#harga').val(0);
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                allowClear: true
            })
            const tgl_muat = flatpickr("#tgl_muat", {
                allowInput: true,
                dateFormat: "d-m-Y",
                locale: "id",
                onChange: function(selectedDates, dateStr, instance) {
                    getHarga()
                },
            });
            $('.tanggal').mask('00-00-0000');

            let setoran_id_array = [];

            AutoNumeric.multiple('.rupiah', {
                //  currencySymbol: 'Rp ',
                digitGroupSeparator: '.',
                decimalPlaces: 0,
                minimumValue: 0,
                decimalCharacter: ',',
                formatOnPageLoad: true,
                allowDecimalPadding: false,
                alwaysAllowDecimalCharacter: false
            });
            let supir_id = '';
            let datatable = $("#datatable").DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                lengthChange: true,
                paging: true,
                info: true,
                ordering: true,
                scrollX: true,
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                },
                order: [
                    [3, 'desc']
                ],
                columnDefs: [{
                    targets: 0,
                    checkboxes: {
                        selectRow: true,
                    }
                }],
                select: {
                    style: 'multi',
                    selector: 'td:not(:last-child)'
                },
                ajax: {
                    url: @json(route('pembayaran.index')),
                    data: function(e) {
                        e.supir_id = supir_id
                    }
                },
                initComplete: function(settings, json) {
                    $('body').find('.dataTables_scrollBody').addClass("scrollbar");
                },
                columns: [{
                        data: "id",
                    },
                    {
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                    {
                        data: 'supir_nama',
                    },
                    {
                        data: 'uang_jalan',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        data: 'uang_tambahan',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        data: 'uang_kurangan',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        data: 'pg',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        data: 'ttu',
                        orderable: false,
                        searchable: false,
                        defaultContent: "belum ada"
                    },
                    {
                        data: 'transportir_nama',
                    },
                    {
                        data: 'tgl_muat',
                        searchable: false,
                    },
                    {
                        data: 'berat',
                        searchable: false,
                    },
                    {
                        data: 'tujuan_nama',
                    },
                    {
                        data: 'harga',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        data: 'total_kotor',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        data: 'total_bersih',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        searchable: false,
                        data: 'created_at',
                    },
                    {
                        data: "action",
                        orderable: false,
                        searchable: false,
                    },
                ]
            }).on('select', function(e, dt, type, indexes) {

                let count = datatable.rows({
                    selected: true
                });
                setoran_id_array.push(datatable.rows(indexes).data()[0].id);

                if (count.count() >= 1) {
                    $('#btn_hapus_masal').show()
                }
            }).on('deselect', function(e, dt, type, indexes) {
                let count = datatable.rows({
                    selected: true
                })
                setoran_id_array.splice($.inArray(datatable.rows(indexes).data()[0].id, id_array), 1);
                if (count.count() <= 0) {
                    $('#btn_hapus_masal').hide()
                }
            })

            $("#btn_bayar").click(function() {
                $.ajax({
                    type: 'POST',
                    url: @json(route('pembayaran.bayar')),
                    data: {
                        "setoran_id_array": setoran_id_array,
                    },
                    beforeSend: function() {
                        showLoading()

                    },
                    success: (response) => {
                        $('#modal_hasil_bayar').modal('show')
                        hideLoading()
                        $("#datatable2 tbody").empty();
                        $("#datatable2 tfoot").empty();
                        let row, footer;
                        response.data.data_setoran.forEach(function(data, i) {
                            row += `<tr>
                              <td>${i+1}</td>
                              <td>${data.supir_nama}</td>
                              <td>${data.berat}</td>
                              <td>${data.tujuan_nama}</td>
                              <td class="rupiah">${data.harga}</td>
                              <td>${data.transportir_nama}</td>
                              <td>${data.tgl_muat}</td>

                              <td class="rupiah">${data.uang_jalan}</td>
                              <td class="rupiah">${data.uang_tambahan}</td>
                              <td class="rupiah">${data.pg}</td>
                              <td class="rupiah">${data.total_kotor}</td>
                              <td class="rupiah">${data.total_bersih}</td>
                              </tr>`;
                        });

                        footer = `<tr style="text-align: center; font-weight: bold;font-size: 13px;">
                             <td colspan="7">Jumlah Total</td>
                              <td class="rupiah">${response.data.total_uang_jalan}</td>
                              <td class="rupiah">${response.data.total_uang_jalan_tambahan}</td>
                              <td class="rupiah">${response.data.total_pihak_gas}</td>
                              <td class="rupiah">${response.data.total_uang_kotor}</td>
                              <td class="rupiah">${response.data.total_uang_bersih}</td> </tr>`;

                        $("#datatable2 tbody").append(row);
                        $("#datatable2 tfoot").append(footer);

                        new AutoNumeric.multiple('.rupiah', {
                            currencySymbol: 'Rp ',
                            digitGroupSeparator: '.',
                            decimalPlaces: 0,
                            minimumValue: 0,
                            decimalCharacter: ',',
                            formatOnPageLoad: true,
                            allowDecimalPadding: false,
                            alwaysAllowDecimalCharacter: false
                        });

                    },
                    error: function(response) {
                        showError(response)
                    }
                });
            });



            $('#mobil_id').on('select2:select', function(e) {
                supir_id = $(this).val()
                datatable.ajax.reload()
            });


            function getHarga() {
                $.ajax({
                    type: 'POST',
                    url: @json(route('master.harga')),
                    data: {
                        tgl_muat: $('#tgl_muat').val(),
                        tujuan_id: $('#tujuan_id').val(),
                    },
                    success: (response) => {
                        AutoNumeric.getAutoNumericElement('#harga').set(
                            response.data.harga)
                    },
                    error: function(response) {
                        showError(response)
                    }
                });
            }


        })
    </script>
@endpush
