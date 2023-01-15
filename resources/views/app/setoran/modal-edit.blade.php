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
<div class="modal fade" id="modal_create">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_tambah">
                @csrf
                <div class="modal-body">
                    <x-input-rupiah id='uang_tambahan' label='Uang Tambahan' required=true />
                    <x-input-rupiah id='uang_kurangan' label='Uang Kurangan' required=true />
                    <x-datepicker id='tgl_muat' label='Tanggal Muat' required=true />
                    <x-input id='berat' label='Berat Muatan' required=true />
                    <x-input id='tujuan_id' label='Tujuan' required=true />
                    <x-input id='transportir_id' label='Transportir' required=true />
                    <x-input-rupiah id='harga' label='Harga' required=true />
                    <input hidden  id="id" name="id" value="" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
