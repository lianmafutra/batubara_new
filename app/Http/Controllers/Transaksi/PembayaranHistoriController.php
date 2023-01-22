<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\HistoriPembayaran;
use App\Models\Setoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranHistoriController extends Controller
{

   public function index()
   {

      $x['title']   = 'Histori Pembayaran';

      $data = HistoriPembayaran::all();

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pembayaran-histori.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pembayaran-histori.index', $x, compact(['data']));
   }

   public function destroy($id)
   {
      try {
         DB::beginTransaction();
         $setoran_id_array =  HistoriPembayaran::where('id', $id)->first()->setoran_id;

         Setoran::whereIn('id', json_decode($setoran_id_array))
            ->update([
               'status_pembayaran' => 'BELUM',
               'tgl_pembayaran'    => NULL
            ]);

         HistoriPembayaran::destroy($id);

         DB::commit();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         DB::rollback();

         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
