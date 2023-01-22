<x-modal id="pengaturan_harga" title="Pengaturan Harga" size="md">
   @method('PUT')
   
    <x-input-rupiah id='hrg_pembayaran' label='Harga Pembayaran' required=true />
    <x-input-rupiah id='hrg_pencairan' label='Harga Pencairan' required=true />
    <x-slot:footer>
        <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
        </x-slot>
</x-modal>
