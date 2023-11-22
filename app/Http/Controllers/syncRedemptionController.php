<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\syncRedemption;
use Illuminate\Support\Facades\Log;

class syncRedemptionController extends Controller
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


        $jsondata = json_encode($request->LOYALTYREDEMPTIONS);
        $jsondatab = json_decode($jsondata);


        $results=[];
        foreach ($jsondatab as $data) {
            try {

                $maxredemption = syncRedemption::max('ID');
                $nextredemptionId = $maxredemption + 1;
                LOG::info($maxredemption);
                LOG::info($nextredemptionId);
                $dataRedemption =    syncRedemption::insert([
                'BRANCHID' => $data->BRANCHID,
                'ID'=> $nextredemptionId,
                'DATE'=> $data->DATE,
                'CUSTOMERID'=> $data->CUSTOMERID,
                'CARDID'=> $data->CARDID,
                'REWARDID'=>$data->REWARDID,
                'QUANTITY'=> $data->QUANTITY,
                'UNITPTS'=> $data->UNITPTS,
                'POINTS'=> $data->POINTS,
                'CATEGORYCODE'=> $data->CATEGORYCODE,
                'STATUS'=> $data->STATUS
                ]);

                $results[] = [
                    'StatusCode' => 200,
                    'ID' =>$nextredemptionId,
                    'Message' => 'Success',
                ];
            } catch (\Illuminate\Database\QueryException $exception) {
                $results[] = [
                    'StatusCode' => 500,
                    'ID' =>$nextredemptionId,
                    'Message' => 'Failed',
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
