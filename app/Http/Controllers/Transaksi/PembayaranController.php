<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Pembayaran;
use App\Models\Setoran;
use App\Models\Supir;
use App\Models\Transportir;
use App\Models\Tujuan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
   
    public function index()
    {
      $x['title']       = 'Kelola Data Pembayaran';
      $x['tujuan']      = Tujuan::all();
      $x['transportir'] = Transportir::all();
      $x['supir']       = Supir::all();
      $x['mobil']       = Mobil::all();
         $data          = Setoran::with('supir');

      if (request()->supir_id && request()->supir_id != 'all') {
         $data->where('supir_id', request()->supir_id);
      }

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pembayaran.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pembayaran.index', $x, compact(['data']));
    }

    
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        //
    }

    public function show(Pembayaran $pembayaran)
    {
        //
    }

   
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

   
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

   
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}
