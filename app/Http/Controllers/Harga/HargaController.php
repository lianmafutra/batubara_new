<?php

namespace App\Http\Controllers\Harga;

use App\Http\Controllers\Controller;
use App\Models\Harga;
use App\Models\Setoran;
use App\Models\Transportir;
use App\Models\Tujuan;
use App\Services\SetoranService;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HargaController extends Controller
{
   use ApiResponse, SetoranService;
   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola Harga';
      $x['tujuan']    = Tujuan::all();
      $x['transportir']    = Transportir::all();
      $data = Harga::with('tujuan', 'transportir');


      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.harga.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.harga.index', $x);
   }

   public function store(Request $request)
   {

      try {
         DB::beginTransaction();
         Harga::updateOrCreate(
            ['id'               => $request->id],
            [
               'harga'            => $request->harga,
               'tujuan_id'        => $request->tujuan_id,
               'transportir_id'   => $request->transportir_id,
               'harga_pembayaran' => $request->harga_pembayaran,
               'harga_pencairan'  => $request->harga_pencairan,
               'transportir_id'   => $request->transportir_id,
               'tanggal'          => $request->tanggal,
            ]
         );

         if ($request->id) {
            $setoran = Setoran::where('transportir_id', '!=', NULL)->where('tujuan_id', '!=', NULL)->where('status_pembayaran', 'BELUM')->get();
            if($setoran!=[]){
               foreach ($setoran as $key => $value) {
               
                  $tujuan      = Tujuan::find($value->tujuan_id);
                  $transportir = Transportir::find($value->transportir_id);
   
                  $data_setoran = $this->getHarga($value->tgl_muat, $value->tujuan_id, $value->transportir_id);
   
                  Setoran::where('id', $value->id)->update([
                     'tujuan_nama'      => $tujuan->nama,
                     'transportir_nama' => $transportir->nama,
                     'harga'            => $data_setoran->harga,
                     'harga_pembayaran' => $data_setoran->harga_pembayaran,
                     'harga_pencairan'  => $data_setoran->harga_pencairan,
                  ]);
               }
            }
         }
         DB::commit();
         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function edit(Harga $harga)
   {
      return $this->success('Data Harga', $harga);
   }

   public function destroy(Harga $Harga)
   {
      try {
         $Harga->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }

   public function destroyMulti(Request $request)
   {
      try {
         Harga::whereIn('id', $request->id_array)->delete();
         return $this->success('Berhasil Hapus Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }
}
