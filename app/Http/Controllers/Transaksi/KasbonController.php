<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Kasbon;
use App\Models\Mobil;
use App\Models\Pemilik;
use App\Models\Supir;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class KasbonController extends Controller
{

   use ApiResponse;
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {

      $x['title']   = 'Kelola Kasbon';
      $x['pemilik'] = Pemilik::get();
      $x['mobil']   = Mobil::with('pemilik', 'supir')->get();
      $x['supir']   = Supir::get();

      $data = Kasbon::with('pemilik', 'mobil');

      
      if (request()->mobil_id && request()->mobil_id != 'all') {
         $data->whereRelation('mobil','mobil_id', request()->mobil_id);
      }



      if (request()->ajax()) {
         return  datatables()->eloquent($data)
          
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.kasbon.action', compact('data'));
            })
            ->addColumn('status', function ($data) {
               if ($data->status == 'BELUM') {
                  return '<span class="right badge badge-danger">Belum Lunas</span>';
               }
               else if ($data->status == 'LUNAS') {
                  return '<span class="right badge badge-success">Sudah Lunas</span>';
               }
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
      }
      return view('app.kasbon.index', $x, compact(['data']));
   }


   public function store(Request $request)
   {
      try {

         Kasbon::updateOrCreate(
            ['id'               => $request->id],
            [
               'nama'             => $request->nama,
               'jumlah_uang'      => $request->jumlah_uang,
               'tanggal_kasbon'   => $request->tanggal_kasbon,
               'mobil_id'         => $request->mobil_id,
               'pemilik_mobil_id' => $request->pemilik_mobil_id,
               'status'           => $request->status,
            ]
         );

         if ($request->id)  return $this->success('Berhasil Mengubah Data');
         else return $this->success('Berhasil Menginput Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }

   public function edit(Kasbon $kasbon)
   {
      return $this->success('Data kasbon', $kasbon);
   }

   public function destroy(Kasbon $kasbon)
   {
      try {
         $kasbon->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
