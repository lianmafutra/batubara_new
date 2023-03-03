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
                        <h1 class="m-0">{{ $title }}</h1>
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
                                    {{-- <a href="#" class="btn btn-sm btn-warning" id="btn_pengaturan_harga"><i
                                            class="fas fa-tools"></i> Pengaturan Harga</a> --}}
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
                                                    <th>Harga Pembayaran</th>
                                                    <th>Harga Pencairan</th>
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
    @include('app.harga.modal-create')
@endsection

@push('js')
    <script src="{{ asset('plugins/datatable/datatable2.min.js') }}"></script>>
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
            let id_array = []
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
            $('#harga').prop('readonly', true)
            $('#harga_pembayaran').prop('readonly', true)
            $('#harga_pencairan').prop('readonly', true)

            const flatpicker = flatpickr("#tanggal", {
                allowInput: true,
                dateFormat: "d-m-Y",
                locale: "id",
            })

            $('.tanggal').mask('00-00-0000')

            AutoNumeric.multiple('.rupiah', {
                //  currencySymbol: 'Rp ',
                digitGroupSeparator: '.',
                decimalPlaces: 0,
                decimalCharacter: ',',
                formatOnPageLoad: true,
                allowDecimalPadding: false,
                alwaysAllowDecimalCharacter: false
            })

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
                    [7, 'desc']
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
                        data: 'harga_pembayaran',
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    }, {
                        data: 'harga_pencairan',
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
                })
                id_array.push(datatable.rows(indexes).data()[0].id)

                if (count.count() >= 1) {
                    $('#btn_hapus_masal').show()
                }
            }).on('deselect', function(e, dt, type, indexes) {
                let count = datatable.rows({
                    selected: true
                })
                id_array.splice($.inArray(datatable.rows(indexes).data()[0].id, id_array), 1)
                if (count.count() <= 0) {
                    $('#btn_hapus_masal').hide()
                }
            })

            $('#transportir_id').on('change', function(e) {
                $('#harga').prop('readonly', false)
                $('#harga_pembayaran').prop('readonly', false)
                $('#harga_pencairan').prop('readonly', false)
                let url = '{{ route('pengaturan_harga.get_harga_perubahan', ':id') }}'
                url = url.replace(':id', $('#transportir_id').val())
                $('#harga_pembayaran-info').show()
                $('#harga_pencairan-info').show()
                $.get(url,
                    function(response) {

                        if (response.transportir.harga_pembayaran > 0) {
                            $('#harga_pembayaran-info').html(
                                "<span style='color:green; font-size:11px'> ( Harga +" + response
                                .transportir.harga_pembayaran + " )</span>")
                        } else {
                            $('#harga_pembayaran-info').html(
                                "<span style='color:red; font-size:11px'> ( Harga " + response
                                .transportir.harga_pembayaran + " )</span>")
                        }

                        if (response.transportir.harga_pencairan > 0) {
                            $('#harga_pencairan-info').html(
                                "<span style='color:green; font-size:11px'> ( Harga +" + response
                                .transportir.harga_pencairan + " )</span>")
                        } else {
                            $('#harga_pencairan-info').html(
                                "<span style='color:red; font-size:11px'> ( Harga " + response
                                .transportir.harga_pencairan + " )</span>")
                        }

                        AutoNumeric.getAutoNumericElement('#harga_pembayaran').set(0)
                        AutoNumeric.getAutoNumericElement('#harga_pencairan').set(0)

                        harga_pembayaran = parseInt($('input[id$=harga]').val().replace(
                            /[^\d,-]/g, ''))
                        harga_pencairan = parseInt($('input[id$=harga]').val().replace(
                            /[^\d,-]/g, ''))
                        AutoNumeric.getAutoNumericElement('#harga_pembayaran').set(harga_pembayaran + response.transportir.harga_pembayaran)
                        AutoNumeric.getAutoNumericElement('#harga_pencairan').set(
                            harga_pencairan + response.transportir.harga_pencairan)

                        $('#harga').keyup(function() {
                            harga_pembayaran = parseInt($('input[id$=harga]').val().replace(
                                /[^\d,-]/g, ''))
                            harga_pencairan = parseInt($('input[id$=harga]').val().replace(
                                /[^\d,-]/g, ''))
                            AutoNumeric.getAutoNumericElement('#harga_pembayaran').set(
                                harga_pembayaran + response.transportir.harga_pembayaran)
                            AutoNumeric.getAutoNumericElement('#harga_pencairan').set(
                                harga_pencairan + response.transportir.harga_pencairan)
                        })
                    })
            })

            $("#btn_tambah").click(function() {
                flatpicker.setDate('')
                clearInput()
                $('#modal_create').modal('show')
                $('.modal-title').text('Tambah Data')
                $('#harga').prop('readonly', true)
                $('#harga_pembayaran').prop('readonly', true)
                $('#harga_pencairan').prop('readonly', true)
                $('#harga_pembayaran-info').hide()
                $('#harga_pencairan-info').hide()
            })

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
                                    id_array = []
                                }
                            },
                            error: function(response) {
                                showError(response)
                            }
                        })
                    }
                })
            })

            $("#form_create").submit(function(e) {
                e.preventDefault()
                const formData = new FormData(this)
                formData.append('method', 'PUT')
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
                })
            })
            $('#datatable').on('click', '.btn_edit', function(e) {
                clearInput()
                $('#harga').prop('readonly', false)
                $('#harga_pembayaran').prop('readonly', false)
                $('#harga_pencairan').prop('readonly', false)
                $('#modal_create').modal('show')
                $('.modal-title').text('Ubah Data')
                $('.error').hide()
                $('#harga_pembayaran-info').hide()
                $('#harga_pencairan-info').hide()

                let url = $(this).attr('data-url')
                $.get(url, function(response) {
                    $('#harga_pembayaran-info').show()
                    $('#harga_pencairan-info').show()

                    $('#id').val(response.data.id)
                    AutoNumeric.getAutoNumericElement('#harga').set(response.data.harga)
                    AutoNumeric.getAutoNumericElement('#harga_pembayaran').set(response.data
                        .harga_pembayaran)
                    AutoNumeric.getAutoNumericElement('#harga_pencairan').set(response.data
                        .harga_pencairan)

                    flatpicker.setDate(response.data.tanggal)

                    $('#tujuan_id').val(response.data.tujuan_id).trigger('change')
                    $('#transportir_id').val(response.data.transportir_id).trigger('change')
                    $('#harga_pembayaran-info').html("")
                    $('#harga_pencairan-info').html("")


                })
            })

            $('#datatable').on('click', '.btn_hapus', function(e) {
                let data = $(this).attr('data-hapus')
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
                        $(this).find('#form-delete').submit()
                    }
                })
            })
        })
    </script>
@endpush
