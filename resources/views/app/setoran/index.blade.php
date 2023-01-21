@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatable/fixedColumns.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatable/datatable-custom-fixed-coloumns.css') }}">
@endpush
@section('content')
    <style>
    </style>
    <div style="" class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data setoran</h1>
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
                                <div class="col-md-3">
                                    <x-select2 id="supir_id" label="Filter Supir" required="false"
                                        placeholder="Pilih Supir">
                                        <option value="all">Semua Supir</option>
                                        @foreach ($supir as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </x-select2>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="card-body table-responsive">
                                        <table id="datatable" class="table table-bordered table_fixed">
                                            <thead>
                                                <tr>
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
@include('app.setoran.modal-edit')
@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2-min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/id.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('plugins/autoNumeric.min.js') }}"></script>
    <script src="{{ asset('plugins/datatable/dataTables.fixedColumns.min.js') }}"></script>
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
                ajax: {
                    url: @json(route('setoran.index')),
                    data: function(e) {
                        e.supir_id = supir_id
                    }
                },
                initComplete: function(settings, json) {
                    $('body').find('.dataTables_scrollBody').addClass("scrollbar");
                },
                columns: [{
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
                        data: 'harga',
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
                    {
                        data: "action",
                        orderable: false,
                        searchable: false,
                    },
                ]
            });
            $("#btn_tambah").click(function() {
                clearInput()
                $('#modal_create').modal('show')
            });
            $('#supir_id').on('select2:select', function(e) {
                supir_id = $(this).val()
                datatable.ajax.reload()
            });
            $("#form_update").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: $('#url_update').val(),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        showLoading()
                    },
                    success: (response) => {
                        if (response) {
                            this.reset()
                            $('#modal_edit').modal('hide')
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
            $('body').on('click', '.btn_edit', function(e) {
                clearInput()
                $('#modal_edit').modal('show')
                $('.error').hide();
                let url = $(this).attr('data-url');
                let url_update = $(this).attr('data-url-update');
                $.get(url, function(response) {
                    $('#berat').val(response.data.berat)
                    $('#url_update').val(url_update)
                    AutoNumeric.getAutoNumericElement('#uang_tambahan').set(response.data
                        .uang_tambahan)
                    AutoNumeric.getAutoNumericElement('#uang_kurangan').set(response.data
                        .uang_kurangan)
                    tgl_muat.setDate(response.data.tgl_muat)
                    $('#tujuan_id').val(response.data.tujuan_id).trigger('change');
                    $('#transportir_id').val(response.data.transportir_id).trigger('change');
                    AutoNumeric.getAutoNumericElement('#harga').set(response.data.harga)
                    AutoNumeric.getAutoNumericElement('#pg').set(response.data.pg)
                    $('#tujuan_id').change(function() {
                        getHarga()
                    })
                })
            })

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
            $('body').on('click', '.btn_hapus', function(e) {
                let data = $(this).attr('data-hapus');
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data setoran?',
                    text: data,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).find('#form-delete').submit();
                    }
                })
            });
        })
    </script>
@endpush
