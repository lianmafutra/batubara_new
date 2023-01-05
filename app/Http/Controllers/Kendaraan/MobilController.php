<?php

namespace App\Http\Controllers\Kendaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\MobilRequest;
use App\Models\Mobil;
use App\Models\MobilJenis;
use App\Models\Pemilik;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class MobilController extends Controller
{
   use ApiResponse;
   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola Mobil';
      $x['pemilik']    = Pemilik::get();
      $x['jenis']    = MobilJenis::get();
      $data = Mobil::with('pemilik2', 'mobil_jenis2');
   //   dd($data->get());
   


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
         [  'id'               => Hashids::decode($request->mobil_id)[0] ],
            [
               'plat'             => $request->plat,
               'jenis'            => Hashids::decode($request->jenis)[0],
               'pemilik_mobil_id' => Hashids::decode($request->pemilik_mobil_id)[0]
            ]
         );
         return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal Menginput Data' . $th, 400);
      }
   }


   public function edit(Mobil $mobil)
   {
      return $this->success('Data Mobil',     $mobil);
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
