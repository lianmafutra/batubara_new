<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Pencairan;
use App\Models\Mobil;
use App\Models\Pembayaran;
use App\Models\Setoran;
use App\Models\Supir;
use App\Models\Transportir;
use App\Models\Tujuan;
use App\Services\PembayaranService;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PencairanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $x['title']       = 'Kelola Data Pembayaran';
      $x['tujuan']      = Tujuan::all();
      $x['transportir'] = Transportir::all();
      $x['supir']       = Supir::all();
      $x['mobil']       = Mobil::all();
      $data          = Setoran::with('supir')->where('status_pembayaran', 'BELUM');

      if (request()->transportir_id && request()->transportir_id != 'all') {
         $data->where('transportir_id', request()->transportir_id);
      }

      if (request()->ajax()) {
         return  datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pencairan.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pencairan.index', $x, compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pencairan  $pencairan
     * @return \Illuminate\Http\Response
     */
    public function show(Pencairan $pencairan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pencairan  $pencairan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pencairan $pencairan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pencairan  $pencairan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pencairan $pencairan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pencairan  $pencairan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pencairan $pencairan)
    {
        //
    }
}
