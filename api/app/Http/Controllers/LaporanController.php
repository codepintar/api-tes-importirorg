<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Barang;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;
use Illuminate\Support\Carbon;

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

        LaporanController::tokens_call();

        $data = DB::table('barang as a')
            ->join('barang_in_out as b', 'a.sku', '=', 'b.sku')
            ->join('barang_in_out as c', 'a.sku', '=', 'c.sku')
            ->select('a.sku','a.nama','a.stok AS stok_awal',DB::raw('IFNULL(SUM(b.qty), 0) AS barang_masuk'),DB::raw('IFNULL(SUM(c.qty), 0) AS barang_keluar'),DB::raw('(a.stok + IFNULL(SUM(b.qty), 0) - IFNULL(SUM(c.qty), 0)) AS stok_akhir'))
            ->where('a.is_deleted', '=', '0')
            ->where('b.is_deleted', '=', '0')
            ->where('c.is_deleted', '=', '0')
            ->where('b.is_flag', '=', 'IN')
            ->where('c.is_flag', '=', 'OUT')
            ->whereDate('b.tanggal', '=', Carbon::now())
            ->whereDate('c.tanggal', '=', Carbon::now())
            ->groupBy('a.sku')
            ->get();

        return response()->json($data, 200);
    }


    public function stok_bulanan()
    {
        LaporanController::tokens_call();
        $now = Carbon::now();


        $data = DB::table('barang as a')
            ->join('barang_in_out as b', 'a.sku', '=', 'b.sku')
            ->join('barang_in_out as c', 'a.sku', '=', 'c.sku')
            ->select('a.sku','a.nama','a.stok AS stok_awal',DB::raw('IFNULL(SUM(b.qty), 0) AS barang_masuk'),DB::raw('IFNULL(SUM(c.qty), 0) AS barang_keluar'),DB::raw('(a.stok + IFNULL(SUM(b.qty), 0) - IFNULL(SUM(c.qty), 0)) AS stok_akhir'))
            ->where('a.is_deleted', '=', '0')
            ->where('b.is_deleted', '=', '0')
            ->where('c.is_deleted', '=', '0')
            ->where('b.is_flag', '=', 'IN')
            ->where('c.is_flag', '=', 'OUT')
            ->whereMonth('b.tanggal', '=', $now->month)
            ->whereMonth('c.tanggal', '=', $now->month)
            ->groupBy('a.sku')
            ->get();

        return response()->json($data, 200);
    }


    public function stok_tahunan()
    {

        LaporanController::tokens_call();
        $now = Carbon::now();

        $data = DB::table('barang as a')
            ->join('barang_in_out as b', 'a.sku', '=', 'b.sku')
            ->join('barang_in_out as c', 'a.sku', '=', 'c.sku')
            ->select('a.sku','a.nama','a.stok AS stok_awal',DB::raw('IFNULL(SUM(b.qty), 0) AS barang_masuk'),DB::raw('IFNULL(SUM(c.qty), 0) AS barang_keluar'),DB::raw('(a.stok + IFNULL(SUM(b.qty), 0) - IFNULL(SUM(c.qty), 0)) AS stok_akhir'))
            ->where('a.is_deleted', '=', '0')
            ->where('b.is_deleted', '=', '0')
            ->where('c.is_deleted', '=', '0')
            ->where('b.is_flag', '=', 'IN')
            ->where('c.is_flag', '=', 'OUT')
            ->whereYear('b.tanggal', '=', $now->year)
            ->whereYear('c.tanggal', '=', $now->year)
            ->groupBy('a.sku')
            ->get();

        return response()->json($data, 200);
    }


    public function barang_masuk(Request $request)
    {

        LaporanController::tokens_call();
        $now = Carbon::now();

        if($request['filter'] == 'HARIAN'){

            $data = DB::table('barang_in_out as a')
            ->join('barang as b', 'a.sku', '=', 'b.sku')
            ->select('a.sku','b.nama',DB::raw('IFNULL(SUM(a.qty), 0) AS jumlah_barang_masuk'))
            ->where('a.is_deleted', '=', '0')
            ->where('b.is_deleted', '=', '0')
            ->where('a.is_flag', '=', 'IN')
            ->whereDate('a.tanggal', '=', Carbon::now())
            ->groupBy('a.sku')
            ->get();

            return response()->json($data, 200);

        }else if($request['filter'] == 'BULANAN'){

            $data = DB::table('barang_in_out as a')
            ->join('barang as b', 'a.sku', '=', 'b.sku')
            ->select('a.sku','b.nama',DB::raw('IFNULL(SUM(a.qty), 0) AS jumlah_barang_masuk'))
            ->where('a.is_deleted', '=', '0')
            ->where('b.is_deleted', '=', '0')
            ->where('a.is_flag', '=', 'IN')
            ->whereMonth('a.tanggal', '=', $now->month)
            ->groupBy('a.sku')
            ->get();

            return response()->json($data, 200);

        }else if($request['filter'] == 'TAHUNAN'){

            $data = DB::table('barang_in_out as a')
            ->join('barang as b', 'a.sku', '=', 'b.sku')
            ->select('a.sku','b.nama',DB::raw('IFNULL(SUM(a.qty), 0) AS jumlah_barang_masuk'))
            ->where('a.is_deleted', '=', '0')
            ->where('b.is_deleted', '=', '0')
            ->where('a.is_flag', '=', 'IN')
            ->whereYear('a.tanggal', '=', $now->year)
            ->groupBy('a.sku')
            ->get();

            return response()->json($data, 200);
        }

    }


    public function barang_keluar(Request $request)
    {

        LaporanController::tokens_call();
        $now = Carbon::now();

        if($request['filter'] == 'HARIAN'){

            $data = DB::table('barang_in_out as a')
            ->join('barang as b', 'a.sku', '=', 'b.sku')
            ->select('a.sku','b.nama',DB::raw('IFNULL(SUM(a.qty), 0) AS jumlah_barang_masuk'))
            ->where('a.is_deleted', '=', '0')
            ->where('b.is_deleted', '=', '0')
            ->where('a.is_flag', '=', 'OUT')
            ->whereDate('a.tanggal', '=', Carbon::now())
            ->groupBy('a.sku')
            ->get();

            return response()->json($data, 200);

        }else if($request['filter'] == 'BULANAN'){

            $data = DB::table('barang_in_out as a')
            ->join('barang as b', 'a.sku', '=', 'b.sku')
            ->select('a.sku','b.nama',DB::raw('IFNULL(SUM(a.qty), 0) AS jumlah_barang_masuk'))
            ->where('a.is_deleted', '=', '0')
            ->where('b.is_deleted', '=', '0')
            ->where('a.is_flag', '=', 'OUT')
            ->whereMonth('a.tanggal', '=', $now->month)
            ->groupBy('a.sku')
            ->get();

            return response()->json($data, 200);

        }else if($request['filter'] == 'TAHUNAN'){

            $data = DB::table('barang_in_out as a')
            ->join('barang as b', 'a.sku', '=', 'b.sku')
            ->select('a.sku','b.nama',DB::raw('IFNULL(SUM(a.qty), 0) AS jumlah_barang_masuk'))
            ->where('a.is_deleted', '=', '0')
            ->where('b.is_deleted', '=', '0')
            ->where('a.is_flag', '=', 'OUT')
            ->whereYear('a.tanggal', '=', $now->year)
            ->groupBy('a.sku')
            ->get();

            return response()->json($data, 200);
        }

    }




}
