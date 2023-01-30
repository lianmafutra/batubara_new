<style>
    .modal-dialog {
        min-height: calc(100vh - 60px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: auto;
    }

    @media(max-width: 768px) {
        .modal-dialog {
            min-height: calc(100vh - 20px);
        }
    }
</style>

<div class="modal fade modal-ajax" id="modal_hasil_bayar">
    <div class="modal-dialog modal-xl" style="max-width: 85% !important;">
        <div class="modal-content">
            <div class="overlay modal-loading">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
            <div class="modal-header">
                <h6 class="modal-title">Pembayaran</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_pembayaran" method="POST">
                <div class="modal-body">
                    <h4 class="judul_pencairan" style="text-align: center"></h4>


                    <table style="margin-left: 20px">
                        <tr>
                            <th>Transportir</th>
                            <th style="padding: 0 10px 0 10px">:</th>
                            <td id="transportir"></td>
                        </tr>
                       
                       
                        <tr>
                            <th>Tanggal Pembayaran</th>
                            <th style="padding: 0 10px 0 10px">:</th>
                            <td id="tgl_pembayaran"></td>
                        </tr>
                    </table>
                    <div class="card-body table-responsive">
                        <table id="datatable2" class="table table-bordered " style="font-size: 12px; width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Muat</th>
                                    <th>Tanggal Bongkar</th>
                                    <th>Supir</th>
                                    <th>Plat</th>
                                    <th>Berat</th>
                                    <th>Tujuan</th>
                                    <th>Harga</th>
                                    <th>Pijak Gas</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="to_empty" style="text-align: center;">
                            </tbody>
                            <tfoot class="to_empty">

                            </tfoot>
                        </table>
                    </div>

                    {{-- <table style="float: right; margin-right: 37px; margin-top: 20px; text-align: left">
                        <tr>
                            <th>Terima Kotor</th>
                            <th style="padding: 0 10px 0 10px">:</th>
                            <td class="rupiah" id="hasil_terima_kotor"></td>
                        </tr>
                        <tr>
                            <th>Total Bon</th>
                            <th style="padding: 0 10px 0 10px">:</th>
                            <td class="rupiah" id="hasil_total_bon"></td>
                        </tr>
                        <tr>
                            <th>Terima Bersih</th>
                            <th style="padding: 0 10px 0 10px">:</th>
                            <td class="rupiah" id="hasil_terima_bersih"></td>
                        </tr>
                        <tr style="display: none" class="kasbon_pendapatan">
                           <th style="color: red">Kasbon Melebihi Pendapatan, maka sisa akan ditambahkan ke kasbon sebesar : </th>
                           <th style="padding: 0 10px 0 10px">:</th>
                           <th style="color: red" class="kasbon_pendapatan_hasil rupiah"></th>
                       </tr>
                      
                    </table> --}}

                  
                 


                </div>
                <div class="modal-footer">
                    <div style="float:right; margin-right: 30px;" class="form-group col-3">
                        <div class="tgl">
                            <div class="form-group">
                                <div class="bd-highlight">
                                    <label>Tanggal Pencairan <span style="color: red">*</span>
                                    </label>
                                    <div style="padding: 0 !important; " class="input-group ">
                                        <input id="tgl_bayar" required autocomplete="off" name="tgl_bayar"
                                            class="form-control tanggal" type="text"
                                            placeholder="Tanggal-Bulan-Tahun" data-input>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-danger error-text tanggal_bayar_err"></span>
                            </div>
                        </div>
                        <button style="float: right" type="submit"
                            class="btn_lanjutkan btn_submit btn btn-primary">Lanjutkan</button>
                    </div>
            </form>
        </div>


    </div>
</div>
</div>
