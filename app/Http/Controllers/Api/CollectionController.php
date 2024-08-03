<?php

namespace App\Http\Controllers\Api;

use App\Models\Village;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class CollectionController extends Controller
{
    public function kecamatan(){
        try {
            $respons = District::all();
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Retrived district data',
                'data' => $respons
            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function kelurahan($id){
        try {
            $respons = Village::where('district_code', $id)->get();
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Retrived village data by id: '.$id,
                'data' => $respons
            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
