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
            <form id="form_update" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <x-input-rupiah id='uang_tambahan' label='Uang Tambahan' required=true />
                    <x-input-rupiah id='uang_kurangan' label='Uang Kurangan' required=true />
                    <x-input-rupiah id='pg' label='PG' required=true />
                    <x-datepicker id='tgl_muat' label='Tanggal Muat' required=true />
                    <x-input id='berat' label='Berat Muatan' required=true />
                    <x-select2 id="tujuan_id" label="Tujuan" required="true" placeholder="Pilih Tujuan">
                        @foreach ($tujuan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </x-select2>
                    <x-select2 id="transportir_id" label="Transportir" required="true" placeholder="Pilih Transportir">
                        @foreach ($transportir as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </x-select2>
                   
                    <x-input-rupiah id='harga' label='Harga' required=true />
                    <input hidden id="id" value="" />
                    <input hidden id="url_update" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
