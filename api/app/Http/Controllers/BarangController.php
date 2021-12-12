<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;

class BarangController extends Controller
{
    
    public function tokens_call()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }

    public function index()
    {
        BarangController::tokens_call();

        $data = Barang::all()->where('is_deleted', 0);
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        BarangController::tokens_call();

        $request->validate([
            'id_kategori' => 'required',
            'sku' => 'required|unique:barang',
            'nama' => 'required',
            'stok' => 'required'
        ]);

        $return = Barang::create([
            'id_kategori' => $request['id_kategori'],
            'sku' => $request['sku'],
            'nama' => $request['nama'],
            'stok' => $request['stok'],
        ]);

        return response()->json($return, 200);
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
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        BarangController::tokens_call();
        $tglnow = date('Y-m-d H:i:s');

        $request->validate([
            'id_kategori' => 'required',
            'sku' => 'required',
            'nama' => 'required',
            'stok' => 'required'
        ]);

        $return = DB::table('barang')->where('id', $request->id)->update([
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'sku' => $request->sku,
            'nama' => $request->nama,
            'stok' => $request->stok,
            'updated_at' => $tglnow
        ]);

        return response()->json($return, 200);
    }

    public function detail(Request $request) //, $id
    {
        BarangController::tokens_call();

        $return = DB::table('barang')->where('id', $request->id)->get();

        return response()->json($return, 200);
    }

    public function delete(Request $request) //, $id
    {
        BarangController::tokens_call();
        $tglnow = date('Y-m-d H:i:s');

        $return = DB::table('barang')->where('id', $request->id)->update([
            'is_deleted' => '1',
            'updated_at' => $tglnow,
        ]);

        return response()->json($return, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        //
    }

}
