<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\HistoriPembayaran;
use App\Models\Mobil;
use App\Models\Pembayaran;
use App\Models\Setoran;
use App\Models\Supir;
use App\Models\Transportir;
use App\Models\Tujuan;
use App\Services\PembayaranService;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
      $data          = Setoran::with('supir')->where('status_pembayaran', 'BELUM');

      if (request()->mobil_id && request()->mobil_id != 'all') {
         $data->where('mobil_id', request()->mobil_id);
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

   public function bayarPreview(Request $request)
   {


      if ($request->setoran_id_array == null || $request->setoran_id_array == []) {
         return $this->error('Data setoran Belum di pilih !', 400);
      }

      $setoran = Setoran::where('id',$request->setoran_id_array[0])->first();
      

      return $this->success(
         'Data Pembayaran',
         [
            'pemilik_mobil'      =>  $setoran->pemilik_nama,
            'supir_mobil'        =>  $setoran->supir_nama,
            'plat_mobil'         =>  $setoran->mobil_plat,
            'data_setoran'       => Setoran::whereIn('id', $request->setoran_id_array)->get(),
            "total_uang_jalan"   => $this->pembayaranService->hitungTotalUangJalan($request->setoran_id_array),
            "total_uang_lainnya" => $this->pembayaranService->hitungTotalUangLainnya($request->setoran_id_array),
            "total"              => $this->pembayaranService->hitungTotal($request->setoran_id_array),
            "total_pihak_gas"    => $this->pembayaranService->hitungTotalPijakGas($request->setoran_id_array),
            "total_uang_kotor"   => $this->pembayaranService->hitungTotalKotor($request->setoran_id_array),
            "total_uang_bersih"  => $this->pembayaranService->hitungTotalBersih($request->setoran_id_array)
         ]
      );
   }

   public function bayarHistori(Request $request, HistoriPembayaran $historiPembayaran)
   {

      try {

         DB::beginTransaction();

         if ($request->setoran_id_array == null || $request->setoran_id_array == []) {
            return $this->error('Data setoran Belum di pilih !', 400);
         }

         Setoran::whereIn('id', $request->setoran_id_array)
            ->update([
               'status_pembayaran' => 'LUNAS',
               'tgl_pembayaran'    => Carbon::now()
            ]);

            
        $mobil = Mobil::with('supir','pemilik')->where('id', $request->mobil_id);

         HistoriPembayaran::create([
            "kode"             => $historiPembayaran->getLastId()."/BYR/".Carbon::now()->format('d-m-y'),
            "tgl_bayar"        => Carbon::now(),
            "status"           => "lunas",
            "setoran_id"       => json_encode($request->setoran_id_array),
            'supir_id'         => $mobil->first()->supir->id,
            'supir_nama'       => $mobil->first()->supir->nama,
            'pemilik_mobil_id' => $mobil->first()->pemilik_mobil_id,
            'pemilik_nama'     => $mobil->first()->pemilik->nama,
            'mobil_id'         => $mobil->first()->id,
            'mobil_plat'       => $mobil->first()->plat,
            "kasbon_id"        => "",
         ]);

         DB::commit();
         return $this->success('Berhasil Melakukan Pembayaran');
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }
}
