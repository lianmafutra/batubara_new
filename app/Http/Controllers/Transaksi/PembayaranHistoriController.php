<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\HistoriPembayaran;
use App\Models\Setoran;
use App\Services\PembayaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranHistoriController extends Controller
{

   public function index()
   {

      $x['title']   = 'Histori Pembayaran';

      $data = HistoriPembayaran::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pembayaran-histori.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pembayaran-histori.index', $x, compact(['data']));
   }

   public function destroy($id)
   {
      try {
         DB::beginTransaction();
         $setoran_id_array =  HistoriPembayaran::where('id', $id)->first()->setoran_id;

         Setoran::whereIn('id', json_decode($setoran_id_array))
            ->update([
               'status_pembayaran' => 'BELUM',
               'tgl_bayar'    => NULL
            ]);

         HistoriPembayaran::destroy($id);

         DB::commit();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         DB::rollback();

         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }

   public function print($histori_pembayaran_id, PembayaranService $pembayaranService)
   {

      // if ($request->setoran_id_array == null || $request->setoran_id_array == []) {
      //    return $this->error('Data setoran Belum di pilih !', 400);
      // }

      $histori = HistoriPembayaran::find($histori_pembayaran_id);
      $setoran_id_array = json_decode($histori->setoran_id);
      $x['setoran'] = Setoran::whereIn('id', json_decode($histori->setoran_id))->get();


      $x['pemilik_mobil'] = $histori->pemilik_nama;
      $x['supir_mobil'] =   $histori->supir_nama;
      $x['plat_mobil'] = $histori->mobil_plat;

      $x['total_uang_jalan']   = $pembayaranService->hitungTotalUangJalan($setoran_id_array);
      $x['total_uang_lainnya'] = $pembayaranService->hitungTotalUangLainnya($setoran_id_array);
      $x['total']              = $pembayaranService->hitungTotal($setoran_id_array);
      $x['total_pihak_gas']    = $pembayaranService->hitungTotalPijakGas($setoran_id_array);
      $x['total_uang_kotor']   = $pembayaranService->hitungTotalKotor($setoran_id_array);
      $x['total_uang_bersih']  = $pembayaranService->hitungTotalBersih($setoran_id_array);



      return view('app.pembayaran-histori.print-preview', $x);
   }
}
