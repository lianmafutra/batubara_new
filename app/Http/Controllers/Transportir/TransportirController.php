<?php

namespace App\Http\Controllers\Transportir;

use App\Http\Controllers\Controller;
use App\Models\Transportir;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;


class TransportirController extends Controller
{
   use ApiResponse;
   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola transportir';
      $data = Transportir::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.transportir.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.transportir.index', $x, compact(['data']));
   }

   public function store(Request $request)
   {
      try {

         Transportir::updateOrCreate(
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

   public function edit(transportir $transportir)
   {
      return $this->success('Data transportir', $transportir);
   }

   public function destroy(transportir  $transportir)
   {
      try {
         $transportir->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
