@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
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
                            </div>
                            <div class="card-body">
                                <div class="card-body table-responsive">
                                    <table id="datatable" class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Tgl Bayar</th>
                                                <th>Mobil</th>
                                                <th>Supir</th>
                                                <th>Pemilik Mobil</th>
                                                <th>created_at</th>
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
        </section>
    </div>
    @include('app.pembayaran.modal-hasil-bayar')
@endsection
@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2-min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('plugins/autoNumeric.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })

            let datatable = $("#datatable").DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                lengthChange: true,
                paging: true,
                info: true,
                ordering: true,
                order: [
                    [6, 'desc']
                ],
                ajax: @json(route('pembayaran.histori.index')),

                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                    {
                        data: 'kode',
                        orderable: false,
                    },
                    {
                        data: 'tgl_bayar',
                        orderable: false,
                    },

                    {
                        data: 'mobil_plat',
                        orderable: false,
                    },
                    {
                        data: 'supir_nama',
                        orderable: false,
                    },
                    {
                        data: 'pemilik_nama',
                        orderable: false,
                    },
                    {
                        data: 'created_at',
                    },

                    {
                        data: "action",
                        orderable: false,
                        searchable: false,
                    },
                ]
            });

            $('#datatable').on('click', '.btn_preview', function(e) {

                $('.modal-footer').hide()
                let histori = JSON.parse($(this).attr('data-setoran'))
                $.ajax({
                    type: 'POST',
                    url: @json(route('pembayaran.bayar.preview')),
                    data: {
                        "setoran_id_array": JSON.parse(histori.setoran_id),
                        "mobil_id": histori.mobil_id,
                        "kode_pembayaran":JSON.parse(histori.id),
                    },
                    beforeSend: function() {
                        showLoading()
                    },
                    success: (response) => {
                        $('#modal_hasil_bayar').modal('show')

                        $('#bayar_pemilik').text(response.data.pemilik_mobil)
                        $('#bayar_supir').text(response.data.supir_mobil)
                        $('#bayar_mobil').text(response.data.plat_mobil)
                        $('#tgl_pembayaran').text(response.data.tgl_bayar)

                        $('#hasil_terima_kotor').text(response.data.total_uang_bersih)
                        $('#hasil_total_bon').text(response.data.total_kasbon)
                        $('#hasil_terima_bersih').text(response.data.total_uang_bersih - response.data.total_kasbon)
                  
                        hideLoading()
                        $(".to_empty").empty();
                        let row, footer, row_kasbon, footer_kasbon;
                        response.data.data_setoran.forEach(function(data, i) {
                            row += `<tr>
                                 <td>${i+1}</td>
                               
                                 <td class="berat">${data.berat}</td>
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

            $("#form_tambah").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('method', 'PUT');
                $.ajax({
                    type: 'POST',
                    url: @json(route('mobil.store')),
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
                    $('#mobil_id').val(response.data.id)
                    $('#plat').val(response.data.plat)
                    $('#mobil_jenis_id').val(response.data.mobil_jenis_id).trigger('change');
                    $('#pemilik_mobil_id').val(response.data.pemilik_mobil_id).trigger('change');
                })
            });

            $('#datatable').on('click', '.btn_hapus', function(e) {
                let data = JSON.parse($(this).attr('data-histori'));
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data Histori Pembayaran ?',
                    text: "Semua Status Setoran pada histori ( " + data.kode +
                        " ) ini akan dikembalikan menjadi BELUM LUNAS",
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
