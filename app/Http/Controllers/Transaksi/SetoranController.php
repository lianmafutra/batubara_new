<?php

namespace App\Http\Controllers\Transaksi\Setoran;

use App\Http\Controllers\Controller;
use App\Models\Setoran;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
   
   use ApiResponse;
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

   
    public function edit(Setoran $setoran)
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
