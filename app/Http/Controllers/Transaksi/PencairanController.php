<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\HistoriPencairan;
use App\Models\Pencairan;
use App\Models\Mobil;
use App\Models\Pembayaran;
use App\Models\Setoran;
use App\Models\Supir;
use App\Models\Transportir;
use App\Models\Tujuan;
use App\Services\pencairanService;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PencairanController extends Controller
{
   protected $pencairanService;
   use ApiResponse;

   public function __construct(PencairanService $pencairanService)
   {
      $this->pencairanService = $pencairanService;
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
      // $setoran = Setoran::where('id', $request->setoran_id_array[0])->first();

      $total_bersih = $this->pencairanService->hitungTotalBersih($request->setoran_id_array);
      $transportir = Transportir::find($request->transportir_id);

      if ($request->has('kode_pencairan')) {
         return json_decode(HistoriPencairan::where('id', request()->kode_pencairan)->first()->data, true);
      } 
      return $this->success(
         'Data Pembayaran',
         [
            'transportir'        =>   $transportir,
            // 'tgl_pencairan'          =>  Carbon::parse($setoran->tgl_bayar)->format('d-m-Y'),
            'data_setoran'       => Setoran::whereIn('id', $request->setoran_id_array)->get(),
            "total_uang_jalan"   => $this->pencairanService->hitungTotalUangJalan($request->setoran_id_array),
            "total_uang_lainnya" => $this->pencairanService->hitungTotalUangLainnya($request->setoran_id_array),
            "total"              => $this->pencairanService->hitungTotal($request->setoran_id_array),
            "total_pihak_gas"    => $this->pencairanService->hitungTotalPijakGas($request->setoran_id_array),
            "total_uang_kotor"   => $this->pencairanService->hitungTotalKotor($request->setoran_id_array),
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

            $transportir = Transportir::find($request->transportir_id);
            $total_bersih = $this->pencairanService->hitungTotalBersih($request->setoran_id_array);

            $data = [
               'data'=> [
                  'transportir'        =>   $transportir,
                  'tgl_pencairan'      =>  Carbon::parse($request->tgl_pencairan)->format('d-m-Y'),
                  'data_setoran'       => Setoran::whereIn('id', $request->setoran_id_array)->get(),
                  "total_uang_jalan"   => $this->pencairanService->hitungTotalUangJalan($request->setoran_id_array),
                  "total_uang_lainnya" => $this->pencairanService->hitungTotalUangLainnya($request->setoran_id_array),
                  "total"              => $this->pencairanService->hitungTotal($request->setoran_id_array),
                  "total_pihak_gas"    => $this->pencairanService->hitungTotalPijakGas($request->setoran_id_array),
                  "total_uang_kotor"   => $this->pencairanService->hitungTotalKotor($request->setoran_id_array),
                  "total_uang_bersih"  => $total_bersih,
               ]
            ];

           
         HistoriPencairan::create([
            "kode"           => $kode_pencairan,
            "transportir_id" =>  $request->transportir_id,
            'tgl_pencairan'  => $request->tgl_pencairan,
            "setoran_id"     => json_encode($request->setoran_id_array),
            "data"           => json_encode($data)
         ]);

         DB::commit();
         return $this->success('Berhasil Melakukan Pencairan');
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

  
}
