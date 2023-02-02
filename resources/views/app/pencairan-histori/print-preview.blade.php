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

        .page-break {
            page-break-after: always;
        }
    </style>
</head>


<body>
    <h2 style="text-align: center">Rekap Pembayaran </h2>
    <table style="font-size: 16px; margin-left: 20px; margin-bottom: 10px; text-align: left">

      {{-- $('#transportir').text(response.data.transportir.nama)
      $('.judul_pencairan').text('Rekap Pencairan '+response.data.transportir.nama)
      $('#hasil_terima_kotor').text(response.data.total_uang_bersih)
      $('#hasil_terima_bersih').text($terima_bersih) --}}


        <tr>
            <th>Transportir</th>
            <th style="padding: 0 10px 0 10px">:</th>
            <td>{{ $data['data']['transportir']['nama'] }}</td>
        </tr>
        <tr>
            <th>Tanggal Pencairan</th>
            <th style="padding: 0 10px 0 10px">:</th>
            <td>{{ $data['data']['tgl_pencairan'] }}</td>
        </tr>
    </table>

    <table class="table_data" style="width: 100%">
        <tr>
            <th>No</th>
            <th>Tanggal Muat</th>
            <th>Tanggal Bongkar</th>
            <th>Supir</th>
            <th>Plat</th>
            <th>Berat</th>
            <th>Tujuan</th>
            <th>Harga</th>
            <th>Pijak Gas</th>
            <th>Total</th>
        </tr>
        {{-- @dd($data) --}}
        @foreach ($data['data']['data_setoran'] as $index => $item)
            <tr style="text-align: center; font-size: 16px">
                <td>{{ $index + 1 }}</td>
                <td >{{ $item['tgl_muat'] }}</td>
                <td >{{ $item['tgl_bongkar'] }}</td>
                <td >{{ $item['supir_nama'] }}</td>
                <td >{{ $item['mobil_plat'] }}</td>
                <td >{{ $item['berat'] }}</td>
                <td >{{ $item['tujuan_nama'] }}</td>
                <td class="rupiah">{{ $item['harga_cair'] }}</td>
                <td class="rupiah">{{ $item['pg'] }}</td>
                <td class="rupiah">{{ $item['total_bersih_pencairan'] }}</td>
            </tr>
        @endforeach


     
        <tr style="text-align: center; font-weight: bold;font-size: 16px;">
            <td colspan="8">Jumlah Total</td>
            <td class="rupiah">{{ $data['data']['total_pihak_gas'] }}</td>
            <td class="rupiah">{{ $data['data']['total_uang_bersih'] }}</td>
        </tr> 

    </table>




    {{-- <div class="page-break"></div> --}}
    <table style="float: right; font-size: 20px; margin-right: 20px; margin-top: 20px; text-align: left">
        {{-- <tr>
            <th>Terima Kotor</th>
            <th style="padding: 0 10px 0 10px">:</th>
            <td class="rupiah">{{ $data['data']['total_uang_bersih'] }}</td>
        </tr>
        <tr>
            <th>Total Bon</th>
            <th style="padding: 0 10px 0 10px">:</th>
            <td class="rupiah">{{ $data['data']['total_kasbon'] }}</td>
        </tr>
        <tr>
            <th>Terima Bersih</th>
            <th style="padding: 0 10px 0 10px">:</th>
            <td class="rupiah">{{ $data['data']['total_uang_bersih'] - $data['data']['total_kasbon'] }}</td>
        </tr> --}}
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
    window.onload = function() {
        window.print();
    }
</script>

</html>
