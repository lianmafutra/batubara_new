<x-modal id="create" title="Tambah Harga" size="md">
    <input  id="id" name="id" />
    <x-select2 id="transportir_id" label="Transportir" required="true" placeholder="Pilih Transportir">
      @foreach ($transportir as $item)
          <option value="{{ $item->id }}">{{ $item->nama }}</option>
      @endforeach
  </x-select2>
    <x-input-rupiah id='harga' label='Harga' required=true />
    <x-input-rupiah id='harga_pembayaran' label='Harga Pembayaran' required=true />
    <x-input-rupiah id='harga_pencairan' label='Harga Pencairan' required=true />
  
    <x-datepicker id='tanggal' label='Tanggal' required=true />
    <x-select2 id="tujuan_id" label="Tujuan" required="true" placeholder="Pilih Tujuan">
        @foreach ($tujuan as $item)
            <option value="{{ $item->id }}">{{ $item->nama }}</option>
        @endforeach
    </x-select2>
   
    <x-slot:footer>
        <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
        </x-slot>
</x-modal>

