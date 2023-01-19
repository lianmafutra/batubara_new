<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Pembayaran;
use App\Models\Setoran;
use App\Models\Supir;
use App\Models\Transportir;
use App\Models\Tujuan;
use App\Services\PembayaranService;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
   protected $pembayaranService;
   use ApiResponse;

   public function __construct(PembayaranService $pembayaranService)
   {
      $this->pembayaranService = $pembayaranService;
   }

   public function index()
   {
      $x['title']       = 'Kelola Data Pembayaran';
      $x['tujuan']      = Tujuan::all();
      $x['transportir'] = Transportir::all();
      $x['supir']       = Supir::all();
      $x['mobil']       = Mobil::all();
      $data          = Setoran::with('supir')
         ->where('status_pembayaran', 'BELUM');

      if (request()->supir_id && request()->supir_id != 'all') {
         $data->where('supir_id', request()->supir_id);
      }

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pembayaran.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pembayaran.index', $x, compact(['data']));
   }

   public function bayar(Request $request)
   {

     
      if ($request->setoran_id_array == null || $request->setoran_id_array == []) {
         return $this->error('Data setoran Belum di pilih !', 400);
      }

      return $this->success(
         'Data Pembayaran',
         [
            'data_setoran'             => Setoran::whereIn('id',$request->setoran_id_array)->get(),
            "total_uang_jalan"          => $this->pembayaranService->hitungTotalUangJalan($request->setoran_id_array),
            "total_uang_jalan_tambahan" => $this->pembayaranService->hitungTotalUangJalanTambahan($request->setoran_id_array),
            "total_pihak_gas"           => $this->pembayaranService->hitungTotalPijakGas($request->setoran_id_array),
            "total_uang_kotor"          => $this->pembayaranService->hitungTotalKotor($request->setoran_id_array),
            "total_uang_bersih"         => $this->pembayaranService->hitungTotalBersih($request->setoran_id_array)
         ]
      );
   }
}
