<!DOCTYPE html>
<html>

<head>
    <style>
        .table_data {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table_data th {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table_data td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center">Rekap Pembayaran Bulan September</h2>
    <table style="font-size: 22px; margin-left: 20px; margin-bottom: 10px; text-align: left">
        <tr>
            <th>Pemilik Mobil</th>
            <th style="padding: 0 10px 0 10px">:</th>
            <td>{{ $pemilik_mobil }}</td>
        </tr>
        <tr>
            <th>Supir</th>
            <th style="padding: 0 10px 0 10px">:</th>
            <td>{{ $supir_mobil }}</td>
        </tr>
        <tr>
            <th>Plat Mobil</th>
            <th style="padding: 0 10px 0 10px">:</th>
            <td>{{ $plat_mobil }}</td>
        </tr>
    </table>

    <table class="table_data" style="width: 100%">
        <tr style="font-size: 22px">
            <th>No</th>
            <th>Supir</th>
            <th>Berat</th>
            <th>Tujuan</th>
            <th>Harga</th>
            <th>Uang Jalan</th>
            <th>Uang Lainnya</th>
            <th>Total</th>
            <th>Pijak Gas</th>
            <th>Total Kotor</th>
            <th>Total Bersih</th>
        </tr>

        @foreach ($setoran as $index => $item)
            <tr  style="text-align: center; font-size: 20px">
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->supir_nama }}</td>
                <td class="berat">{{ $item->berat }}</td>
                <td>{{ $item->tujuan_nama }}</td>
                <td class="rupiah">{{ $item->harga }}</td>
                <td class="rupiah">{{ $item->uang_jalan }}</td>
                <td class="rupiah">{{ $item->uang_lainnya }}</td>
                <td class="rupiah">{{ $item->total_uang_lainnya }}</td>
                <td class="rupiah">{{ $item->pg }}</td>
                <td class="rupiah">{{ $item->total_kotor }}</td>
                <td class="rupiah">{{ $item->total_bersih }}</td>
            </tr>
        @endforeach

        <tr style="text-align: center; font-weight: bold;font-size: 20px;">
            <td colspan="5">Jumlah Total</td>
            <td class="rupiah">{{ $total_uang_jalan }}</td>
            <td class="rupiah">{{ $total_uang_lainnya }}</td>
            <td class="rupiah">{{ $total }}</td>
            <td class="rupiah">{{ $total_pihak_gas }}</td>
            <td class="rupiah">{{ $total_uang_kotor }}</td>
            <td class="rupiah">{{ $total_uang_bersih }}</td>
        </tr>

    </table>
    <table style="float: right; font-size: 22px; margin-right: 20px; margin-top: 20px; text-align: left">
      <tr>
          <th>Terima Kotor</th>
          <th style="padding: 0 10px 0 10px">:</th>
          <td  class="rupiah"></td>
      </tr>
      <tr>
          <th>Total Bon</th>
          <th style="padding: 0 10px 0 10px">:</th>
          <td  class="rupiah"></td>
      </tr>
      <tr>
          <th>Terima Bersih</th>
          <th style="padding: 0 10px 0 10px">:</th>
          <td  class="rupiah"></td>
      </tr>
  </table>
</body>
<script src="{{ asset('plugins/autoNumeric.min.js') }}"></script>
<script>
    AutoNumeric.multiple('.rupiah', {
        currencySymbol: 'Rp ',
        digitGroupSeparator: '.',
        decimalPlaces: 0,
        decimalCharacter: ',',
        formatOnPageLoad: true,
        allowDecimalPadding: false,
        alwaysAllowDecimalCharacter: false
    });

    AutoNumeric.multiple('.berat', {
        // currencySymbol: 'Rp ',
        digitGroupSeparator: '.',
        decimalPlaces: 0,
        decimalCharacter: ',',
        formatOnPageLoad: true,
        allowDecimalPadding: false,
        alwaysAllowDecimalCharacter: false
    });
</script>
<script type="text/javascript">
   window.onload = function() { window.print(); }
</script>
</html>
