@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
@endpush
@section('content')
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-3">
                                        <x-select2 id="mobil_id_filter" label="Filter Mobil" required="false"
                                            placeholder="Pilih Mobil">
                                            <option value="all">Semua Mobil</option>
                                            @foreach ($mobil as $item)
                                                <option value="{{ $item->id }}">{{ $item->plat }} | Pemilik :
                                                    {{ $item->pemilik->nama }} | Supir : {{ $item->supir->nama }}</option>
                                            @endforeach
                                        </x-select2>

                                    </div>
                                    <div class="col-md-3">
                                        <h3 style="margin-top:30px" class="card-title">
                                            <a href="#" class="btn btn-sm btn-primary" id="btn_tambah"><i
                                                    class="fas fa-plus"></i> Tambah Kasbon</a>
                                        </h3>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="card-body table-responsive">
                                        <table id="datatable" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Jumla Uang</th>
                                                    <th>Mobil Plat</th>
                                                    <th>Pemilik</th>
                                                    <th>Status</th>
                                                    <th>Tanggal Kasbon</th>

                                                  
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
    @include('app.kasbon.modal-create')
@endsection

@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2-min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/id.min.js') }}"></script>
    <script src="{{ asset('plugins/autoNumeric.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('.select2bs4').select2({
                theme: 'bootstrap4',
                allowClear: true
            })

            $('.tanggal').mask('00-00-0000');

            $("#pemilik_mobil_id").val(1).trigger('change');

            $('#mobil_id').on('select2:select', function(e) {
                $("#pemilik_mobil_id").val($(this).find(":selected").data("pemilik")).trigger('change');
            })

            let tanggal_kasbon = flatpickr("#tanggal_kasbon", {
                allowInput: true,
                dateFormat: "d-m-Y",
                locale: "id",
            });


            let datatable = $("#datatable").DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                lengthChange: true,
                paging: true,
                info: true,
                stateSave: false,
                ordering: true,
                order : [6, 'desc'],
                ajax: {
                    url: @json(route('kasbon.index')),
                    data: function(e) {
                        e.mobil_id = $('#mobil_id_filter').val()
                    }
                },
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
                        data: 'jumlah_uang',
                        render: function(data, type, row, meta) {
                            return rupiah(data)
                        }
                    },
                    {
                        data: 'mobil.plat',
                        name: 'mobil.plat',

                    },
                    {
                        data: 'pemilik.nama',
                        name: 'pemilik.nama',
                        orderable: false,
                    },
                    {
                        data: 'status',
                        searchable: false,
                        orderable: true,
                    },
                    {
                        data: 'tanggal_kasbon',
                        name: 'tanggal_kasbon',
                        searchable: false,
                    },
                   
                    {
                        data: "action",
                        orderable: false,
                        searchable: false,
                    },
                ]
            })
          
            $('#mobil_id_filter').on('select2:select', function(e) {
                mobil_id = $(this).val()
                datatable.ajax.reload()
            });

            $('#mobil_id_filter').on('select2:clear', function(e) {
                mobil_id = ''
                datatable.ajax.reload()

            });

            $("#btn_tambah").click(function() {
                clearInput()
                $('#modal_create').modal('show')
                $('.modal-title').text('Tambah Data')
                $('#status').val('BELUM').trigger('change');
            });

            AutoNumeric.multiple('.rupiah', {
                //  currencySymbol: 'Rp ',
                digitGroupSeparator: '.',
                decimalPlaces: 0,
                decimalCharacter: ',',
                formatOnPageLoad: true,
                allowDecimalPadding: false,
                alwaysAllowDecimalCharacter: false
            });

            $("#form_tambah").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('pemilik_mobil_id', $("#pemilik_mobil_id").val());
                $.ajax({
                    type: 'POST',
                    url: @json(route('kasbon.store')),
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
                                datatable.ajax.reload(null, false)
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
                clearInput()
                $('#modal_create').modal('show')
                $('.modal-title').text('Ubah Data')
                $('.error').hide();
                $.get($(this).attr('data-url'), function(response) {

                    $('#id').val(response.data.id)
                    tanggal_kasbon.setDate(response.data.tanggal_kasbon)
                    AutoNumeric.getAutoNumericElement('#jumlah_uang').set(response.data.jumlah_uang)
                    $('#nama').val(response.data.nama)
                    $('#jumlah_uang').val(response.data.jumlah_uang)
                    $('#mobil_id').val(response.data.mobil_id).trigger('change');
                    $('#pemilik_mobil_id').val(response.data.pemilik_mobil_id).trigger('change');
                    $('#status').val(response.data.status).trigger('change');

                })
            });

            $('#datatable').on('click', '.btn_hapus', function(e) {
                let data = $(this).attr('data-hapus');
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data Mobil?',
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
