<?php

namespace App\Http\Controllers\Kendaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\MobilRequest;
use App\Models\Pemilik;
use App\Models\Mobil;
use App\Models\MobilJenis;
use App\Utils\ApiResponse;

class MobilController extends Controller
{
   use ApiResponse;
   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola Mobil';
      $x['pemilik']    = Pemilik::get();
      $x['jenis']    = MobilJenis::get();
      $data = Mobil::with('pemilik', 'mobil_jenis');

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.mobil.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.mobil.index', $x, compact(['data']));
   }

   public function store(MobilRequest $request)
   {
      try {

         Mobil::updateOrCreate(
            ['id'               => $request->mobil_id],
            [
               'plat'             => $request->plat,
               'mobil_jenis_id'   => $request->mobil_jenis_id,
               'pemilik_mobil_id' => $request->pemilik_mobil_id
            ]
         );

         if ($request->mobil_id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function edit(Mobil $mobil)
   {
      return $this->success('Data Mobil', $mobil);
   }

   public function destroy(Mobil  $mobil)
   {
      try {
         $mobil->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
