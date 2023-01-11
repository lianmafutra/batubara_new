<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Setoran;
use App\Models\Supir;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class UangJalanController extends Controller
{
   use ApiResponse;

    public function index()
    {
      $x['title']    = 'Kelola Uang Jalan';
      $x['supir']    = Supir::get();
    
      $data = Setoran::with('supir');

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.uang-jalan.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.uang-jalan.index', $x, compact(['data']));
    }


   


    public function store(Request $request)
    {
      try {
         Setoran::updateOrCreate(
            ['id'               => $request->id],
            [
               'supir_id'             => $request->supir_id,
               'tgl_ambil_uang_jalan' => $request->tgl_ambil_uang_jalan,
               'uang_jalan'           => $request->uang_jalan
            ]
         );

         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
    }


    
    public function edit(Setoran $uang_jalan)
    {
      return $this->success('Data Mobil', $uang_jalan);
    }

  
    public function destroy(Setoran $uang_jalan)
    {
      try {
         $uang_jalan->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
    }
}
