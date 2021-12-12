<?php

namespace App\Http\Controllers;

use App\Models\BarangInout;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;

class BarangInoutController extends Controller
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

    public function in_data()
    {
        BarangInoutController::tokens_call();

        $data = DB::table('barang_in_out')
            ->where('is_deleted', '=', '0')
            ->where('is_flag', '=', 'IN')
            ->get();
        return response()->json($data, 200);
    }

    public function out_data()
    {
        BarangInoutController::tokens_call();

        $data = DB::table('barang_in_out')
            ->where('is_deleted', '=', '0')
            ->where('is_flag', '=', 'OUT')
            ->get();
        return response()->json($data, 200);
    }

    
    public function in_create(Request $request)
    {
        BarangInoutController::tokens_call();

        $request->validate([
            'sku' => 'required',
            'tanggal' => 'required',
            'qty' => 'required'
        ]);

        $return = BarangInout::create([
            'sku' => $request['sku'],
            'tanggal' => $request['tanggal'],
            'qty' => $request['qty'],
            'is_flag' => 'IN',
            'created_by' => '2',
            'updated_by' => '0', // ini id_user gudang, kalo di sistem nanti sesuai session_username
        ]);

        return response()->json($return, 200);
    }

    public function out_create(Request $request)
    {
        BarangInoutController::tokens_call();

        $request->validate([
            'sku' => 'required',
            'tanggal' => 'required',
            'qty' => 'required'
        ]);

        $return = BarangInout::create([
            'sku' => $request['sku'],
            'tanggal' => $request['tanggal'],
            'qty' => $request['qty'],
            'is_flag' => 'OUT',
            'created_by' => '2',
            'updated_by' => '0', // ini id_user gudang, kalo di sistem nanti sesuai session_username
        ]);

        return response()->json($return, 200);
    }

    public function inout_update(Request $request)
    {
        BarangInoutController::tokens_call();
        $tglnow = date('Y-m-d H:i:s');

        $request->validate([
            'id' => 'required',
            'tanggal' => 'required',
            'qty' => 'required'
        ]);

        $return = DB::table('barang_in_out')->where('id', $request->id)->update([
            'tanggal' => $request->tanggal,
            'qty' => $request->qty,
            'updated_at' => $tglnow,
            'updated_by' => '2',
        ]);

        return response()->json($return, 200);
    }

    public function inout_delete(Request $request) //, $id
    {
        BarangController::tokens_call();
        $tglnow = date('Y-m-d H:i:s');

        $return = DB::table('barang_in_out')->where('id', $request->id)->update([
            'is_deleted' => '1',
            'updated_at' => $tglnow,
        ]);

        return response()->json($return, 200);
    }


}
