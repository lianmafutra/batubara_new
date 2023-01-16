@extends('admin.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.checkboxes.css') }}">
@endpush
@section('content')
    <style>

    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data harga</h1>
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
                                <h3 class="card-title">
                                    <a href="#" class="btn btn-sm btn-primary" id="btn_tambah"><i
                                            class="fas fa-plus"></i> Tambah harga</a>
                                    <a style="display: none" href="#" class="btn btn-sm btn-danger"
                                        id="btn_hapus_masal"><i class="fas fa-trash"></i> Hapus Masal</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="card-body table-responsive">
                                        <table id="datatable" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>No</th>
                                                    <th>Harga</th>
                                                    <th>PG</th>
                                                    <th>Tujuan</th>
                                                    <th>Transportir</th>
                                                    <th>Tanggal</th>
                                                    <th>created_at</th>
                                                    <th>updated_at</th>
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
@include('app.harga.modal-create')
@push('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/fh-3.3.1/sl-1.5.0/datatables.min.js">
    </script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/id.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2-min.js') }}"></script>
    <script src="{{ asset('plugins/autoNumeric.min.js') }}"></script>
    <script src="{{ asset('plugins/datatable/dataTables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            let id_array = [];
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
             
            const flatpicker = flatpickr("#tanggal", {
                allowInput: true,
                dateFormat: "d-m-Y",
                locale: "id",
            });
            
            $('.tanggal').mask('00-00-0000');

            
            const format = AutoNumeric.multiple('.rupiah', {
                //  currencySymbol: 'Rp ',
                digitGroupSeparator: '.',
                decimalPlaces: 0,
                minimumValue: 0,
                decimalCharacter: ',',
                formatOnPageLoad: true,
                allowDecimalPadding: false,
                alwaysAllowDecimalCharacter: false
            });

            let datatable = $("#datatable").DataTable({
                serverSide: true,
                language: {
                    processing: "Memproses Data..."
                },
                processing: true,
                searching: true,
                lengthChange: true,
                paging: true,
                select: true,
                info: true,
                ordering: true,

                order: [
                    [7, 'asc']
                ],
                columnDefs: [{
                    targets: 0,
                    checkboxes: {
                        selectRow: true,
                    }
                }],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                ajax: @json(route('harga.index')),
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
                        data: 'harga',
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        data: 'pg',
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        data: 'tujuan.nama',
                    },
                    {
                        data: 'transportir.nama',
                    },
                    {
                        data: 'tanggal',
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'updated_at',
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
                id_array.push(datatable.rows(indexes).data()[0].id);

                if (count.count() >= 1) {
                    $('#btn_hapus_masal').show()
                }
            }).on('deselect', function(e, dt, type, indexes) {
                let count = datatable.rows({
                    selected: true
                })
                id_array.splice($.inArray(datatable.rows(indexes).data()[0].id, id_array), 1);
                if (count.count() <= 0) {
                    $('#btn_hapus_masal').hide()
                }
            })

           
            $("#btn_tambah").click(function() {
                flatpicker.setDate('')
                clearInput()
                $('#modal_create').modal('show')
                $('.modal-title').text('Tambah Data')
            });

            $("#btn_hapus_masal").click(function() {

                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data yang terpilih ?',
                    text: '',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: @json(route('destroy.multi')),
                            data: {
                                "id_array": id_array,
                            },
                            beforeSend: function() {
                                showLoading()
                            },
                            success: (response) => {
                                if (response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        showCancelButton: true,
                                        allowEscapeKey: false,
                                        showCancelButton: false,
                                        allowOutsideClick: false,
                                    }).then((result) => {
                                        swal.hideLoading()
                                        location.reload()
                                    })
                                    swal.hideLoading()
                                    id_array = [];
                                }
                            },
                            error: function(response) {
                                showError(response)
                            }
                        });
                    }
                })
            })

            $("#form_create").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('method', 'PUT');
                $.ajax({
                    type: 'POST',
                    url: @json(route('harga.store')),
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
                            $('#modal_create').modal('hide')
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
            $('#datatable').on('click', '.btn_edit', function(e) {
                $('#modal_create').modal('show')
                $('.modal-title').text('Ubah Data')
                $('.error').hide();
                let url = $(this).attr('data-url');
                $.get(url, function(response) {
                    $('#id').val(response.data.id)
                    AutoNumeric.getAutoNumericElement('#harga').set(response.data.harga)
                    AutoNumeric.getAutoNumericElement('#pg').set(response.data.pg)
                    flatpicker.setDate(response.data.tanggal)
                
                    $('#tujuan_id').val(response.data.tujuan_id).trigger('change');
                    $('#transportir_id').val(response.data.transportir_id).trigger('change');
                })
            });
            $('#datatable').on('click', '.btn_hapus', function(e) {
                let data = $(this).attr('data-hapus');
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data harga?',
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
