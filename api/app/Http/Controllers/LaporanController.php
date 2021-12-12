<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Barang;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;

class LaporanController extends Controller
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
    
    public function stok_harian()
    {

        $data = DB::table('barang as a')
            ->join('barang_in_out as b', 'a.sku', '=', 'b.sku')
            ->join('barang_in_out as c', 'a.sku', '=', 'c.sku')
            ->select('a.sku','a.nama')
            ->where('a.is_deleted', '=', '0')
            ->where('b.is_deleted', '=', '0')
            ->where('c.is_deleted', '=', '0')
            ->where('b.is_flag', '=', "'IN'")
            ->where('c.is_flag', '=', "'OUT'")
            ->whereDate('b.tanggal', '=', 'CURDATE()')
            ->whereDate('c.tanggal', '=', 'CURDATE()')
            ->groupBy('a.sku')
            ->get();

        return response()->json($data, 200);
    }

}
