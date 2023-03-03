<?php

namespace App\Http\Controllers\Harga;

use App\Http\Controllers\Controller;
use App\Models\Harga;
use App\Models\HargaPengaturan;
use App\Models\Transportir;
use Illuminate\Http\Request;

class HargaPengaturanController extends Controller
{

   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola Pengaturan Harga';

      // $x['transportir']    = Transportir::all();
    
      $data = Transportir::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.harga_pengaturan.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.harga_pengaturan.index', $x, compact(['data']));
   }



   public function edit_harga_pencairan($id)
   {
      return $this->success('Pengaturan Data Harga', Transportir::find($id));
   }


   public function update_harga_pencairan(Request $request)
   {

      try {
         Transportir::where('id', $request->id)->update([
            'harga_pencairan'  => $request->harga_pencairan,
            'harga_pembayaran'  => $request->harga_pembayaran,
         ]);
         return $this->success('Berhasil Mengubah Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

  

   public function getHargaPerubahan($id_transportir)
   {
 
      $data =  Transportir::find($id_transportir);

      return response()->json([
         "transportir" =>   $data,
      ], 200);
   }
}
