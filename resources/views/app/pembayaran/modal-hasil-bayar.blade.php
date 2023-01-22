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
            <form id="form_update" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="card-body table-responsive">
                        <table id="datatable2" class="table table-bordered " style="font-size: 12px; width: 100%">
                            <thead>
                                <tr>
                                   
                                    <th>No</th>
                                    <th>Supir</th>
                                    <th>Berat</th>
                                    <th>Tujuan</th>
                                    <th>Harga</th>
                                    
                                    <th>Uang Jalan</th>
                                    <th>Uang Lainnya</th>
                                    <th>Total</th>
                                    <th>PG (Pijak Gas)</th>
                                    <th>Total Kotor</th>
                                    <th>Total Bersih</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                            </tbody>
                            <tfoot >
                                             
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn_submit btn btn-primary">Lanjutkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
