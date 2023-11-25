<?php

namespace App\Http\Controllers;

use App\Models\syncEarnings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class syncEarningsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        $bearertoken = $request->bearerToken();
        Log::info($bearertoken);
        if (empty($bearertoken)) {
            return response()->json([
                'StatusCode' => 401,
                'StatusDescription' => 'Unauthorized',
                'Data' => [],
                'Message' => 'Bearer token is missing'
            ], 401);
        }
        // $rules = [
        //     'BRANCHID'=>'required|int',
        //     'ID'=>'required|int',
        //     'REFID'=>'required|int',
        //     'CUSTOMERID'=>'required|int',
        //     'ASSOCID'=>'required|int',
        //     'CARDID'=>'required|int',
        //     'TOTALLITERS'=>'required|decimal',
        //     'TOTALAMOUNT'=>'required|decimal',
        //     'MULTIPLIER'=>'required|decimal',
        //     'POINTS'=>'required|int',
        //     'CASHIERID'=>'required|int',
        //     'TRANINVNO'=>'required|int',
        //     'TRANSID'=>'required|int',
        //     'TRANSDATE'=>'required|int',
        //     'TRANSTIME'=>'required|int',
        //     'CATEGORYCODE'=>'required|int',
        //     'STATUS'=>'required|int',
        // ];

        $jsondata = json_encode($request->LOYALTYEARNINGS);
        $jsondatab = json_decode($jsondata);
        LOG::info($jsondatab);
        $jsonbranchId=[];
        $jsonId=[];

        // try {
            $results=[];
            foreach ($jsondatab as $data) {
                try {
                    $dataEarnings = syncEarnings::insert([
                        'BRANCHID' => $data->BRANCHID,
                        'ID' => $data->ID,
                        'DATE' => $data->DATE,
                        'REFID' => $data->REFID,
                        'CUSTOMERID' => $data->CUSTOMERID,
                        'ASSOCID' => $data->ASSOCID,
                        'CARDID' => $data->CARDID,
                        'TOTALLITERS' => $data->TOTALLITERS,
                        'TOTALAMOUNT' => $data->TOTALAMOUNT,
                        'MULTIPLIER' => $data->MULTIPLIER,
                        'POINTS' => $data->POINTS,
                        'CASHIERID' => $data->CASHIERID,
                        'TRANINVNO' => $data->TRANINVNO,
                        'TRANSID' => $data->TRANSID,
                        'TRANSDATE' => $data->TRANSDATE,
                        'TRANSTIME' => $data->TRANSTIME,
                        'CATEGORYCODE' => $data->CATEGORYCODE,
                        'STATUS' => $data->STATUS,

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
            // Return the results array as the response

        // }

        // catch (\Exception $e) {
        //     Log::error('An error occurred: ' . $e->getMessage());
        //     return response()->json([
        //         'StatusCode' => 500,
        //         'StatusDescription' => 'Failed',
        //         'DATA' => $jsonbranchId,
        //         'Message' => $e->getMessage(),
        //     ], 500);
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

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
