<?php

namespace App\Http\Controllers\Kendaraan;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Pemilik;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
   use ApiResponse;
   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola Pemilik';
      $data = Pemilik::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pemilik.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pemilik.index', $x, compact(['data']));
   }

   public function store(Request $request)
   {
      try {

         Pemilik::updateOrCreate(
            ['id'               => $request->id],
            [
               'nama'             => $request->nama,
               'kontak'   => $request->kontak,
            ]
         );

         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function edit(Pemilik $pemilik)
   {
      return $this->success('Data Pemilik', $pemilik);
   }

   public function destroy(Pemilik  $pemilik)
   {
      try {
         $pemilik->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
