<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\HistoriPencairan;
use Illuminate\Http\Request;
use App\Models\HistoriPembayaran;
use App\Models\Kasbon;
use App\Models\Setoran;
use App\Services\PembayaranService;
use Illuminate\Support\Facades\DB;

class PencairanHistoriController extends Controller
{
   public function index()
   {

      $x['title']   = 'Histori Pencairan';

      $data = HistoriPencairan::with('transportir');

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pencairan-histori.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pencairan-histori.index', $x, compact(['data']));
   }

   public function destroy($id)
   {
      try {
         DB::beginTransaction();
         $histori_pencairan =  HistoriPencairan::where('id', $id)->first();

         Setoran::whereIn('id', json_decode($histori_pencairan->setoran_id))
            ->update([
               'status_pencairan' => 'BELUM',
               'tgl_bayar'    => NULL
            ]);

         HistoriPencairan::destroy($id);

         DB::commit();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         DB::rollback();

         return redirect()->back()->with('error', 'Gagal Hapus Data'.$th, 400);
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



      return view('app.pencairan-histori.print-preview', $x);
   }
}
