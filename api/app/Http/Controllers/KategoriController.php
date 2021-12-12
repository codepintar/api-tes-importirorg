<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;

class KategoriController extends Controller
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
        KategoriController::tokens_call();

        $data = Kategori::all()->where('is_deleted', 0);
        return response()->json($data, 200);
    }

    public function create(Request $request)
    {
        KategoriController::tokens_call();

        $request->validate([
            'nama' => 'required',
        ]);

        $return = Kategori::create([
            'nama' => $request['nama'],
        ]);

        return response()->json($return, 200);
    }

    public function update(Request $request) //, $id
    {
        KategoriController::tokens_call();

        $this->validate($request, [
            'id' => 'required',
            'nama' => 'required',
        ]);

        $return = DB::table('ref_kategori')->where('id', $request->id)->update([
            'nama' => $request->nama,
        ]);

        return response()->json($return, 200);

    }

    public function detail(Request $request) //, $id
    {
        KategoriController::tokens_call();

        $return = DB::table('ref_kategori')->where('id', $request->id)->get();

        return response()->json($return, 200);
    }

    public function delete(Request $request) //, $id
    {
        KategoriController::tokens_call();
        $tanggal = date('Y-m-d H:i:s');

        $return = DB::table('ref_kategori')->where('id', $request->id)->update([
            'is_deleted' => '1',
            'updated_at' => $tanggal,
        ]);

        return response()->json($return, 200);
    }

}
