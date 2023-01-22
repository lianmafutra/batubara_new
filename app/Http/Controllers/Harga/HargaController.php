<?php

namespace App\Http\Controllers\Harga;

use App\Http\Controllers\Controller;
use App\Models\Harga;
use App\Models\Transportir;
use App\Models\Tujuan;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class HargaController extends Controller
{
   use ApiResponse;
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
      return view('app.harga.index', $x, compact(['data']));
   }

   public function store(Request $request)
   {

      try {

         Harga::updateOrCreate(
            ['id'               => $request->id],
            [
               'harga'          => $request->harga,
               'tujuan_id'      => $request->tujuan_id,
               'transportir_id' => $request->transportir_id,
               'harga_pembayaran' => $request->harga_pembayaran,
               'harga_pencairan' => $request->harga_pencairan,
               'transportir_id' => $request->transportir_id,
               'tanggal'        => $request->tanggal,
            ]
         );

         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function edit(Harga $Harga)
   {
      return $this->success('Data Harga', $Harga);
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
          Harga::whereIn('id',$request->id_array)->delete();
          return $this->success('Berhasil Hapus Data');
       } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
       }
     }
}
