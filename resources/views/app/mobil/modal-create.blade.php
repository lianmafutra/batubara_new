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
                <h6 class="modal-title">Tambah Mobil Baru</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_tambah">
                @csrf
                <div class="modal-body">
                    <x-input id='plat' label='Plat/Nopol Mobil' required=true />
                    <input hidden  id="mobil_id" name="mobil_id" value="" />
                    <x-select2 id="mobil_jenis_id" label="Jenis Mobil" required="true" placeholder="Pilih Jenis Mobil">
                     @foreach ($jenis as $item)
                         <option value="{{ $item->id }}">{{ $item->nama }}</option>
                     @endforeach
                 </x-select2>
                    <x-select2 id="pemilik_mobil_id" label="Pemilik Mobil" required="true" placeholder="Pilih Pemilik Mobil">
                        @foreach ($pemilik as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </x-select2>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
