<x-modal id="edit" title="Edit Harga" size="md">
    <input hidden id="id" name="id" />
    <x-input-rupiah id='harga_pencairan' label='Harga Pencairan' required=true />
    <x-slot:footer>
        <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
        </x-slot>
</x-modal>

