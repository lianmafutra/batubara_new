<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\HistoriPembayaran;
use App\Models\Kasbon;
use App\Models\Setoran;
use App\Services\PembayaranService;
use Barryvdh\DomPDF\Facade\Pdf;

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
         $histori_pembayaran =  HistoriPembayaran::where('id', $id)->first();

         Setoran::whereIn('id', json_decode($histori_pembayaran->setoran_id))
            ->update([
               'status_pembayaran' => 'BELUM',
               'tgl_bayar'    => NULL
            ]);



         Kasbon::whereIn('id', json_decode($histori_pembayaran->kasbon_id))
            ->update([
               'status'            => 'BELUM',
               'tgl_bayar'         => NULL
            ]);


         HistoriPembayaran::destroy($id);

         DB::commit();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         DB::rollback();

         return redirect()->back()->with('error', 'Gagal Hapus Data'.$th, 400);
      }
   }

   public function print($histori_pembayaran_id)
   {

      $data = json_decode(HistoriPembayaran::where('id', $histori_pembayaran_id)->first()->data, true);
      $pdf = PDF::loadview('app.pembayaran-histori.print-preview', ['data' => $data])
      ->setPaper('a4', 'landscape');
      return $pdf->stream("rekap_pencairan_".$histori_pembayaran_id.".pdf", array("Attachment" => false));
      // return view('app.pembayaran-histori.print-preview', compact('data'));
   }
}
