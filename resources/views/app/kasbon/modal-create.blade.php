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
                <h6 class="modal-title">Tambah Kasbon</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_tambah">
                @csrf
                <div class="modal-body">
                  <x-input id='nama' label='Nama Kasbon' required=true />
                    <x-input-rupiah id='jumlah_uang' label='Jumlah uang' required=true />
                    <input hidden id="id" name="id" value="" />
                    <x-datepicker id='tanggal_kasbon' label='Tanggal Kasbon' required="true" />
                    <x-select2 id="mobil_id" label="Mobil" required="true" placeholder="Pilih Mobil">
                        @foreach ($mobil->get() as $item)
                            <option data-pemilik="{{ $item->pemilik->id }}" value="{{ $item->id }}">{{ $item->plat }}</option>
                        @endforeach
                    </x-select2>
                   
                    <div class="form-group">
                        <label>
                            Pemilik Mobil
                            <span style="color: red">*</span>

                        </label>
                       
                        <select disabled id="pemilik_mobil_id" name="pemilik_mobil_id" type=""
                            class="select2 select2-pemilik_mobil_id form-control select2bs4"
                            placeholder=" Pemilik Mobil" >
                            <option value=""></option>
                            @foreach ($pemilik as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text pemilik_mobil_id_err"></span>
                    </div>
                    <x-select2 id="status" label="Status" required="true" >
                         <option value="BELUM">Belum Lunas</option>
                         <option value="LUNAS">Sudah Lunas</option>
                 </x-select2>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
