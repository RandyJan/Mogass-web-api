<?php

namespace App\Http\Controllers;

use App\Models\syncTrans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class syncTransController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $jsondata = json_encode($request->LOYALTYTRANS);
        $jsondatab = json_decode($jsondata);
        $results=[];
        foreach ($jsondatab as $data) {
            try {
                $dataEarnings = syncTrans::insert([
                    'BRANCHID' => $data->BRANCHID,
                    'ID'=> $data->ID,
                    'TRANSID'=> $data->TRANSID,
                    'PRODUCTID'=> $data->PRODUCTID,
                    'LITERS'=> $data->LITERS,
                    'AMOUNT'=> $data->AMOUNT,
                    'UNITPOINT'=> $data->UNITPOINT,
                    'TOTALPOINTS'=> $data->TOTALPOINTS,
                    'ITEMNO'=>$data->ITEMNO,
                    'DATE_TRANS'=>$data->DATETRANS,


                ]);

                $results[] = [
                    'StatusCode' => 200,
                    'BRANCHID' => $data->BRANCHID,
                    'ID' => $data->ID,
                    'Message' => 'Success',
                ];
            } catch (\Illuminate\Database\QueryException $exception) {
                $results[] = [
                    'StatusCode' => 500,
                    'BRANCHID' => $data->BRANCHID,
                    'ID' => $data->ID,
                    'Message' => 'Failed',
                    'error'=>$exception->getMessage()
                ];
            }
        }

        return response()->json([
            "StatusCode" => 200,
            "StatusDescription" => "OK",
            "Data" => [
                "RetVal" => $results
            ],
            "Message" => "Response payload"
        ]);

  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
