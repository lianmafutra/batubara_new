@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatable/fixedColumns.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatable/datatable-custom-fixed-coloumns.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.checkboxes.css') }}">
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
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <x-select2 id="mobil_id" label="Filter Mobil" required="false"
                                                placeholder="Pilih Mobil">
                                                <option value="all">Semua Mobil</option>
                                                @foreach ($mobil as $item)
                                                    <option value="{{ $item->id }}">{{ $item->plat }}</option>
                                                @endforeach
                                            </x-select2>

                                        </div>
                                        <div class="col-md-3">
                                            <div style="margin-top:28px"><button id="btn_bayar"
                                                    type="button" class="btn btn-primary"><i
                                                        class="mr-1 fas fa-file-invoice-dollar  nav-icon"></i>
                                                    Bayar</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body table-responsive">
                                    <table id="datatable" class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No</th>
                                                <th>Supir</th>
                                                <th>Berat</th>
                                                <th>Tujuan</th>
                                                <th>Transportir</th>
                                                <th>Tgl Muat</th>
                                                <th>Harga</th>
                                                <th>Uang Jalan</th>
                                                <th>Uang Lainnya</th>
                                                <th>Total</th>
                                                <th>PG (Pijak Gas)</th>
                                                <th>Total Kotor</th>
                                                <th>Total Bersih</th>
                                                <th>Created_at</th>
                                                {{-- <th>#Aksi</th> --}}
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
        </section>
    </div>
    @include('app.pembayaran.modal-hasil-bayar')
@endsection
@push('js')
<script src="{{ asset('plugins/datatable/datatable2.min.js') }}"></script>>
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
            const tanggal_pembayaran = flatpickr("#tgl_bayar", {
                allowInput: true,
                dateFormat: "d-m-Y",
                locale: "id",
                defaultDate: @json(\Carbon\Carbon::now()->format('d-m-Y'))
            });
            $('#tgl_bayar').mask('00-00-0000');

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
            let mobil_id = '';
            let datatable = $("#datatable").DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                lengthChange: false,
                paging: false,
                info: true,
                select: true,
                ordering: true,
                scrollX: true,
                language: {
                    processing: "Memproses Data..."
                },
                //  fixedColumns: {
                //      leftColumns: 1,
                //      rightColumns: 1
                //  },
                order: [
                    [5, 'desc']
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
                        e.mobil_id = mobil_id
                    }
                },


                initComplete: function(settings, json) {

                    $('body').find('.dataTables_scrollBody').addClass("scrollbar");
                },
                columns: [{
                        data: 'id',
                        class: 'id'

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
                        data: 'berat',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return rupiahOnlyFormat(data)
                        }
                    },
                    {
                        data: 'tujuan_nama',
                    },
                    {
                        data: 'transportir_nama',
                    },
                    {
                        data: 'tgl_muat',
                        searchable: false,
                    },
                    {
                        data: 'harga_bayar',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        data: 'uang_jalan',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        data: 'uang_lainnya',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            if (data < 0) return `<span style='color:red'>${rupiah(data)}</span>`
                            else if (data == 0) return rupiah(data)
                            else return `<span style='color:green'>+ ${rupiah(data)}</span>`
                        }
                    },
                    {
                        data: 'total_uang_lainnya',
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return rupiahStyle(data)
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

                ]
            }).on('select', function(e, dt, type, indexes) {

                if (dt[0].length > 1) {
                    datatable.rows().every(function(rowIdx, tableLoop, rowLoop) {
                        let data = datatable.row(rowIdx).data().id
                        setoran_id_array.push(data)
                    });
                    setoran_id_array = [...new Set(setoran_id_array)];
                } else {
                    setoran_id_array.push(datatable.rows(indexes).data()[0].id);
                }
            }).on('deselect', function(e, dt, type, indexes) {
                if (dt[0].length > 1) {
                    setoran_id_array = []
                } else {
                    setoran_id_array.splice($.inArray(datatable.rows(indexes).data()[0].id,
                        setoran_id_array), 1);
                }
            })

            $("#btn_bayar").click(function() {
                if ($('#mobil_id').val() == 'all' || $('#mobil_id').val() == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Mobil Belum dipilih',
                    })
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: @json(route('pembayaran.bayar.preview')),
                    data: {
                        "setoran_id_array": setoran_id_array,
                        "mobil_id": $('#mobil_id').val(),
                        
                    },
                    beforeSend: function() {
                        showLoading()

                    },
                    success: (response) => {

                        $('#modal_hasil_bayar').modal('show')

                        $terima_bersih = response.data.total_uang_bersih - response.data
                            .total_kasbon

                        $('#bayar_pemilik').text(response.data.pemilik_mobil)
                        $('#bayar_supir').text(response.data.supir_mobil)
                        $('#bayar_mobil').text(response.data.plat_mobil)

                        $('#hasil_terima_kotor').text(response.data.total_uang_bersih)
                        $('#hasil_total_bon').text(response.data.total_kasbon)
                        $('#hasil_terima_bersih').text($terima_bersih)

                        if ($terima_bersih < 0) {
                            $('.kasbon_pendapatan').show()
                            $('.kasbon_pendapatan_hasil').text($terima_bersih)

                        } else {
                            $('.kasbon_pendapatan').hide()

                        }

                        hideLoading()
                        $(".to_empty").empty();
                        let row, footer, row_kasbon, footer_kasbon;
                        response.data.data_setoran.forEach(function(data, i) {
                            row += `<tr>
                                 <td>${i+1}</td>
                            
                                 <td  class="berat">${data.berat}</td>
                                 <td>${data.tujuan_nama}</td>
                              
                                 <td class="rupiah">${data.harga_bayar}</td>
                                 <td class="rupiah">${data.uang_jalan}</td>
                                 <td class="rupiah">${data.uang_lainnya}</td>
                                 <td class="rupiah">${data.total_uang_lainnya}</td>
                                 <td class="rupiah">${data.pg}</td>
                                 <td class="rupiah">${data.total_kotor}</td>
                                 <td class="rupiah">${data.total_bersih}</td>
                                 </tr>`;
                        });


                        response.data.kasbon.forEach(function(data, i) {
                            row_kasbon += `<tr>
                                 <td>${i+1}</td>
                                 <td>${data.tanggal_kasbon}</td>
                                 <td>${data.nama}</td>
                                 <td class="rupiah">${data.jumlah_uang}</td>
                                 </tr>`;
                        });

                        footer = `<tr style="text-align: center; font-weight: bold;font-size: 13px;">
                              <td colspan="4">Jumlah Total</td>
                                 <td class="rupiah">${response.data.total_uang_jalan}</td>
                                 <td class="rupiah">${response.data.total_uang_lainnya}</td>
                                 <td class="rupiah">${response.data.total}</td>
                                 <td class="rupiah">${response.data.total_pihak_gas}</td>
                                 <td class="rupiah">${response.data.total_uang_kotor}</td>
                                 <td class="rupiah">${response.data.total_uang_bersih}</td> </tr>`;

                        footer_kasbon = `<tr style="text-align: center; font-weight: bold;font-size: 13px;">
                              <td colspan="3">Jumlah Total</td>
                                 <td class="rupiah">${response.data.total_kasbon}</td></tr>`;

                        $("#datatable2 tbody").append(row);
                        $("#datatable2 tfoot").append(footer);
                        $("#datatable_kasbon tbody").append(row_kasbon);
                        $("#datatable_kasbon tfoot").append(footer_kasbon);

                        new AutoNumeric.multiple('.rupiah', {
                            currencySymbol: 'Rp ',
                            digitGroupSeparator: '.',
                            decimalPlaces: 0,
                            decimalCharacter: ',',
                            formatOnPageLoad: true,
                            allowDecimalPadding: false,
                            alwaysAllowDecimalCharacter: false
                        });

                        new AutoNumeric.multiple('.berat', {
                            digitGroupSeparator: '.',
                            decimalPlaces: 0,
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

            $("#form_pembayaran").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: @json(route('pembayaran.bayar.histori')),
                    data: {
                        "setoran_id_array": setoran_id_array,
                        "mobil_id": mobil_id,
                        'tgl_bayar': $('#tgl_bayar').val()
                    },
                    beforeSend: function() {
                        showLoading()
                    },
                    success: (response) => {
                        if (response) {
                            this.reset()
                            datatable.columns().checkboxes.deselect(true);
                            setoran_id_array = []
                            $('#modal_hasil_bayar').modal('hide')
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showCancelButton: true,
                                allowEscapeKey: false,
                                showCancelButton: false,
                                allowOutsideClick: false,
                            }).then((result) => {
                                swal.hideLoading()
                                datatable.ajax.reload()
                            })
                            swal.hideLoading()
                        }
                    },
                    error: function(response) {
                        showError(response)
                    }
                });
            });

            $('#mobil_id').on('select2:select', function(e) {
                mobil_id = $(this).val()
                datatable.column('.id').visible(false)
                datatable.columns().checkboxes.deselect(true);
                datatable.ajax.reload()
                datatable.on('draw', function() {
                    datatable.column('.id').visible(true)
                });
            });

            $('#mobil_id').on('select2:clear', function(e) {
                mobil_id = ''
                datatable.column('.id').visible(false)
                datatable.columns().checkboxes.deselect(true);
                datatable.ajax.reload()
                datatable.on('draw', function() {
                    datatable.column('.id').visible(true)
                });
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
