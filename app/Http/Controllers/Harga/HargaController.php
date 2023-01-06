<?php

namespace App\Http\Controllers\Harga;

use App\Http\Controllers\Controller;
use App\Models\Harga;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class HargaController extends Controller
{
   use ApiResponse;
   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola Harga';
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
               'nama'             => $request->nama,
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

   public function destroy(Harga  $Harga)
   {
      try {
         $Harga->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   
    }
}
