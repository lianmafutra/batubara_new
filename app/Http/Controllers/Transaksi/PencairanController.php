<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\HistoriPembayaran;
use App\Models\HistoriPencairan;
use App\Models\Kasbon;
use App\Models\Pencairan;
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

class PencairanController extends Controller
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
      $data             = Setoran::with('supir')->where('status_pencairan', 'BELUM');
  

      if (request()->transportir_id && request()->transportir_id != 'all') {
         $data->where('transportir_id', request()->transportir_id);
      }

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pencairan.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pencairan.index', $x, compact(['data']));
   }

   public function pencairanPreview(Request $request)
   {


      if ($request->setoran_id_array == null || $request->setoran_id_array == []) {
         return $this->error('Data setoran Belum di pilih !', 400);
      }
      $setoran = Setoran::where('id', $request->setoran_id_array[0])->first();

      $total_bersih = $this->pembayaranService->hitungTotalBersih($request->setoran_id_array);
      $transportir = Transportir::find($request->transportir_id);

      return $this->success(
         'Data Pembayaran',
         [
            'transportir'        =>   $transportir,
            // 'tgl_pencairan'          =>  Carbon::parse($setoran->tgl_bayar)->format('d-m-Y'),
            'data_setoran'       => Setoran::whereIn('id', $request->setoran_id_array)->get(),
            "total_uang_jalan"   => $this->pembayaranService->hitungTotalUangJalan($request->setoran_id_array),
            "total_uang_lainnya" => $this->pembayaranService->hitungTotalUangLainnya($request->setoran_id_array),
            "total"              => $this->pembayaranService->hitungTotal($request->setoran_id_array),
            "total_pihak_gas"    => $this->pembayaranService->hitungTotalPijakGas($request->setoran_id_array),
            "total_uang_kotor"   => $this->pembayaranService->hitungTotalKotor($request->setoran_id_array),
            "total_uang_bersih"  => $total_bersih,
         ]
      );
   }

   public function pencairanHistori(Request $request, HistoriPencairan $historiPencairan)
   {
      try {
         DB::beginTransaction();
         if ($request->setoran_id_array == null || $request->setoran_id_array == []) {
            return $this->error('Data setoran Belum di pilih !', 400);
         }
         $kode_pencairan = $historiPencairan->getLastId() . "/PCR/" . Carbon::now()->format('d-m-y');
         Setoran::whereIn('id', $request->setoran_id_array)
            ->update([
               'status_pencairan' => 'LUNAS',
               'tgl_pencairan'         => Carbon::parse($request->tgl_pencairan)->translatedFormat('Y-m-d')
            ]);


         HistoriPencairan::create([
            "kode"           => $kode_pencairan,
            "transportir_id" =>  $request->transportir_id,
            'tgl_pencairan'  => $request->tgl_pencairan,
            "setoran_id"     => json_encode($request->setoran_id_array),
         ]);

         DB::commit();
         return $this->success('Berhasil Melakukan Pencairan');
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function destroy(Pencairan $pencairan)
   {
      //
   }
}
