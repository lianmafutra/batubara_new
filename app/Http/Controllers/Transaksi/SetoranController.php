<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Harga;
use App\Models\Setoran;
use App\Services\SetoranService;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SetoranController extends Controller
{


   
    use ApiResponse, SetoranService;



    
    public function index()
    {
      $x['title']    = 'Kelola Data Setoran';
      $data = Setoran::all();
   
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

    

    public function getMasterHarga($tgl_muat){
      return $this->success('Data Master Harga Sesuai tgl muat',  $this->getMasterHargaByTglMuat($tgl_muat));
 }


    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Setoran $setoran)
    {
        //
    }

   
 

   
    public function update(Request $request, Setoran $setoran)
    {
        //
    }

   
    public function destroy(Setoran $setoran)
    {
        //
    }
}
