<?php

namespace App\Http\Controllers\Tujuan;

use App\Http\Controllers\Controller;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Tujuan;


class TujuanController extends Controller
{
   use ApiResponse;
   public function index()
   {
      // abort_if(Gate::denies('kelola mobil'), 403);
      $x['title']    = 'Kelola Tujuan';
      $data = Tujuan::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.tujuan.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.tujuan.index', $x, compact(['data']));
   }

   public function store(Request $request)
   {
      try {

         Tujuan::updateOrCreate(
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

   public function edit(Tujuan $Tujuan)
   {
      return $this->success('Data Tujuan', $Tujuan);
   }

   public function destroy(Tujuan  $Tujuan)
   {
      try {
         $Tujuan->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
