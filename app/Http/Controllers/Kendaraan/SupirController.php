<?php

namespace App\Http\Controllers\Kendaraan;

use App\Http\Controllers\Controller;
use App\Models\supir;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class SupirController extends Controller
{
   use ApiResponse;
   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola Supir';
      $data = Supir::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.supir.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.supir.index', $x, compact(['data']));
   }

   public function store(Request $request)
   {
      try {

         supir::updateOrCreate(
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

   public function edit(supir $supir)
   {
      return $this->success('Data supir', $supir);
   }

   public function destroy(supir  $supir)
   {
      try {
         $supir->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
