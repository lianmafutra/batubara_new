<?php

namespace App\Http\Controllers\Kendaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\MobilRequest;
use App\Models\Mobil;
use App\Models\MobilJenis;
use App\Models\Pemilik;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class MobilController extends Controller
{
   use ApiResponse;
   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola Mobil';
      $x['pemilik']    = Pemilik::get();
      $x['jenis']    = MobilJenis::get();
      $data = Mobil::with('pemilik', 'jenis');

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


   public function store(MobilRequest $request, Pemilik $pemilik)
   {
      try {

         Mobil::updateOrCreate(
            ['id' => $request->mobil_id],
            [
               'plat' => $request->plat,
               'jenis' => $request->jenis,
               'pemilik_mobil_id' => $pemilik->getId($request->pemilik_mobil_id)
            ]
         );
         return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal Menginput Data' . $th, 400);
      }
   }


   public function edit(Mobil $mobil)
   {
      //
   }


   public function update(Request $request, Mobil $mobil)
   {
      //
   }


   public function destroy($uuid)
   {
      try {
         Mobil::where('uuid', $uuid)->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200)->send();
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400)->send();
      }
   }
}
