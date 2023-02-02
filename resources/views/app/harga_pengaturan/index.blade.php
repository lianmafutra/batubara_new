@extends('admin.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
    <style>

    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pengaturan Harga</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Harga Pencairan
                                    {{-- <a href="#" class="btn btn-sm btn-primary" id="btn_tambah"><i
                                            class="fas fa-plus"></i> Tambah harga</a>
                                    <a href="#" class="btn btn-sm btn-warning" id="btn_pengaturan_harga"><i
                                            class="fas fa-tools"></i> Pengaturan Harga</a>
                                    <a style="display: none" href="#" class="btn btn-sm btn-danger"
                                        id="btn_hapus_masal"><i class="fas fa-trash"></i> Hapus Masal</a> --}}
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="card-body table-responsive">
                                        <table id="datatable" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>

                                                    <th>No</th>
                                                    <th>Transportir</th>
                                                    <th>Harga Pencairan</th>
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
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Harga Pembayaran
                                </h3>
                            </div>
                            <div class="card-body">
                                <form id="form_update_pembayaran">
                                    @csrf
                                    <div class="tab-content">
                                        <div class="card-body">
                                            <x-input-rupiah id='hrg_pembayaran' label='Harga Pembayaran' required=true />
                                        </div>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="float-right btn_submit btn btn-primary">Update Harga</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('app.harga_pengaturan.modal-edit')
@endsection

@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/id.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2-min.js') }}"></script>
    <script src="{{ asset('plugins/autoNumeric.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>

    <script>
        $(document).ready(function() {




            let datatable = $("#datatable").DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                lengthChange: true,
                paging: true,
                info: true,
                ordering: true,
                order: [
                    [1, 'asc']
                ],
                ajax: @json(route('pengaturan_harga.index')),

                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                    {
                        data: 'nama',
                        orderable: false,
                    },
                    {
                        data: 'harga_pencairan',
                        className: 'dt-center',
                        render: function(data, type, row, meta) {
                            if (data < 0) return `<span style='color:red'>${rupiah(data)}</span>`
                            else if (data == 0) return rupiah(data)
                            else return `<span style='color:green'>+ ${rupiah(data)}</span>`

                        }

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
            })


            AutoNumeric.multiple('.rupiah', {
                //  currencySymbol: 'Rp ',
                digitGroupSeparator: '.',
                decimalPlaces: 0,
                decimalCharacter: ',',
                formatOnPageLoad: true,
                allowDecimalPadding: false,
                alwaysAllowDecimalCharacter: false
            })

            AutoNumeric.getAutoNumericElement('#hrg_pembayaran').set(@json($harga_pembayaran))

            $('#datatable').on('click', '.btn_edit', function(e) {
                clearInput()
                $('#modal_edit').modal('show')
                $('.error').hide()
                let url = $(this).attr('data-url')
                $.get(url, function(response) {
                    $('.modal-title').text('Ubah Harga Transportir ' + response.data.nama)
                    $('#modal_edit #id').val(response.data.id)
                    AutoNumeric.getAutoNumericElement('#harga_pencairan').set(response.data
                        .harga_pencairan)
                })
            })

            $("#form_edit").submit(function(e) {
                e.preventDefault()
                const formData = new FormData(this)
                $.ajax({
                    type: 'POST',
                    url: @json(route('pengaturan_harga.pencairan.update')),
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
                })
            })

            
            $("#form_update_pembayaran").submit(function(e) {
                e.preventDefault()
                const formData = new FormData(this)
                $.ajax({
                    type: 'POST',
                    url: @json(route('pengaturan_harga.pembayaran.update')),
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
                          
                           AutoNumeric.getAutoNumericElement('#hrg_pembayaran').set(response.data.hrg_pembayaran)
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showCancelButton: true,
                                allowEscapeKey: false,
                                showCancelButton: false,
                                allowOutsideClick: false,
                            }).then((result) => {
                                swal.hideLoading()
                                
                            })
                            swal.hideLoading()
                        }
                    },
                    error: function(response) {
                        showError(response)
                    }
                })
            })
        })
    </script>
@endpush
