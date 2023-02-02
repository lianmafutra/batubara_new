<style>
    .dropdown-menu>li>a:hover {
        background-color: rgba(127, 75, 223, 0.189);
    }
</style>
<div class="btn-group-vertical">
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
        </button>
        <ul class="dropdown-menu">
            <li><a href="{{ route('pembayaran.histori.print', $data->id) }}" target="_blank" class="btn_edit dropdown-item">Print</a>
            </li>
            <li><a data-setoran='{{ $data }}' href="#" class="btn_preview dropdown-item">Preview</a>
            </li>
            <div class="dropdown-divider"></div>
            <li><a data-histori="{{ $data }}" data-url="{{ route('pencairan.histori.destroy', $data->id) }}"
                    class="btn_hapus dropdown-item" href="#">Hapus
                    <form hidden id="form-delete" action="{{ route('pencairan.histori.destroy', $data->id) }}" method="POST"> @csrf
                        @method('DELETE')
                    </form>
                </a> </li>
        </ul>
    </div>
</div>
</td>
</tr>
