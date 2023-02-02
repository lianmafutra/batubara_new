<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\HistoriPencairan;
use Illuminate\Http\Request;
use App\Models\HistoriPembayaran;
use App\Models\Kasbon;
use App\Models\Setoran;
use App\Services\PembayaranService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PencairanHistoriController extends Controller
{
   public function index()
   {

      $x['title']   = 'Histori Pencairan';

      $data = HistoriPencairan::with('transportir');

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pencairan-histori.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pencairan-histori.index', $x, compact(['data']));
   }

   public function destroy($id)
   {
      try {
         DB::beginTransaction();
         $histori_pencairan =  HistoriPencairan::where('id', $id)->first();

         Setoran::whereIn('id', json_decode($histori_pencairan->setoran_id))
            ->update([
               'status_pencairan' => 'BELUM',
               'tgl_bayar'    => NULL
            ]);

         HistoriPencairan::destroy($id);

         DB::commit();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         DB::rollback();

         return redirect()->back()->with('error', 'Gagal Hapus Data' . $th, 400);
      }
   }

   public function print($histori_pembayaran_id)
   {
      $data = json_decode(HistoriPencairan::where('id', $histori_pembayaran_id)->first()->data, true);
      $pdf = PDF::loadview('app.pencairan-histori.print-preview', ['data' => $data])
      ->setPaper('a4', 'landscape');
      return $pdf->stream("rekap_pencairan_".$histori_pembayaran_id.".pdf", array("Attachment" => false));
  
   }
}
