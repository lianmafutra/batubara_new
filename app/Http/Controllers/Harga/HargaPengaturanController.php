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

      $x['transportir']    = Transportir::all();
      $x['harga_pembayaran']    = HargaPengaturan::find(1)->hrg_pembayaran;
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
            'harga_pencairan'  => $request->harga_pencairan
         ]);
         return $this->success('Berhasil Mengubah Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function update_harga_pembayaran(Request $request)
   {

      // id default 1 karena hanya ada 1 , hanya ada method update
      try {
         $data =  HargaPengaturan::find(1);
         $data->update([
            'hrg_pembayaran'  => $request->hrg_pembayaran
         ]);
         return $this->success('Berhasil Mengubah Data', $data);
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function getHargaPerubahan($id_transportir)
   {
      $data =  HargaPengaturan::find(1);
      $data2 =  Transportir::find($id_transportir);

      return response()->json([
         "harga_pembayaran" =>   $data,
         "harga_pencairan" =>    $data2,
      ], 200);
   }
}
