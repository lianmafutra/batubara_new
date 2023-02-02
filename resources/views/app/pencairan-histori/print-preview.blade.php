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
          padding: 5px;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <title>Rekap Pencairan</title>
</head>

<body>
    <h2 style="text-align: center">Rekap Pencairan </h2>
    <table style="font-size: 16px;margin-bottom: 10px; text-align: left">
        <tr>
            <th style="text-align: left">Transportir</th>
            <th style="padding: 0 10px 0 10px">:</th>
            <td>{{ $data['data']['transportir']['nama'] }}</td>
        </tr>
        <tr>
         <th style="text-align: left">Tanggal Pencairan</th>
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
                <td class="rupiah">@rupiah( $item['harga_cair'])</td>
                <td class="rupiah">@rupiah( $item['pg'])</td>
                <td class="rupiah">@rupiah($item['total_bersih_pencairan'])</td>
            </tr>
        @endforeach
        <tr style="text-align: center; font-weight: bold;font-size: 16px;">
            <td colspan="8">Jumlah Total</td>
            <td class="rupiah">@rupiah($data['data']['total_pihak_gas'])</td>
            <td class="rupiah">@rupiah($data['data']['total_uang_bersih'])</td>
        </tr> 
    </table>
</body>
</html>
