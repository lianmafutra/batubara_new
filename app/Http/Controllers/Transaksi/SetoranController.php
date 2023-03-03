<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Harga;
use App\Models\Mobil;
use App\Models\Setoran;
use App\Models\Supir;
use App\Models\Transportir;
use App\Models\Tujuan;
use App\Services\SetoranService;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class SetoranController extends Controller
{

   use ApiResponse, SetoranService;

   public function index()
   {

      $x['title']       = 'Kelola Data Setoran';
      $x['tujuan']      = Tujuan::all();
      $x['transportir'] = Transportir::all();
      $x['supir']       = Supir::all();
      $x['mobil']   = Mobil::with('pemilik', 'supir')->get();


      $data = Setoran::with('supir','mobil');

      if (request()->mobil_id && request()->mobil_id != 'all') {
         $data->whereRelation('mobil', 'mobil_id', request()->mobil_id);
      }


      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.setoran.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.setoran.index', $x, compact(['data']));
   }

   public function edit(Setoran $setoran)
   {
    
      return $this->success('Data Setoran',  $setoran);
   }

   public function getMasterHarga()
   {
    
      return $this->success('Data Master Harga Sesuai tgl muat',  $this->getHarga(request()->tgl_muat, request()->tujuan_id, 
      request()->transportir_id 
   ));
   }


   public function store(Request $request)
   {
   }

   public function show(Setoran $setoran)
   {
      //
   }

   public function update(Request $request, Setoran $setoran)
   {
      try {
         $tujuan      = Tujuan::find($request->tujuan_id);
         $transportir = Transportir::find($request->transportir_id);

         $data_setoran = $this->getHarga($request->tgl_muat,$request->tujuan_id,$request->transportir_id);
         
         $input                     = $request->except(['harga']);
         $input['tujuan_nama']      = $tujuan->nama;
         $input['transportir_nama'] = $transportir->nama;
         $input['harga']            = $data_setoran->harga;
         $input['harga_pembayaran'] = $data_setoran->harga_pembayaran;
         $input['harga_pencairan']  = $data_setoran->harga_pencairan;
         $setoran->fill($input)->save();
         return $this->success('Berhasil Merubah Data');
      } catch (\Throwable $th) {
         return $this->error('Gagal, Terjadi Kesalahan' . $th, 400);
      }
   }


   public function destroy(Setoran $setoran)
   {
      try {
         $setoran->delete();
         return redirect()->back()->with('success', 'Berhasil Hapus Data', 200);
      } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Gagal Hapus Data', 400);
      }
   }
}
