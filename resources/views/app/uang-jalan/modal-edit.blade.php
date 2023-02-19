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
<div class="modal fade" id="modal_edit">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_edit">
                @csrf
                <div class="modal-body">
                    <input hidden id="id" name="id" value="" />
                    <x-datepicker id='tgl_ambil_uang_jalan' label='Tanggal Ambil Uang Jalan' required="true" />
                    <x-select2 id="mobil_id" label="Mobil" required="true" placeholder="Pilih Mobil">
                     @foreach ($mobil as $item)
                         <option value="{{ $item->id }}">{{ $item->plat }}</option>
                     @endforeach
                 </x-select2>
                    <x-input-rupiah id='uang_jalan' label='Uang Jalan' required='true' />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
