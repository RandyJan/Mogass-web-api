<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class syncTableController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($table,$branchid)
    {
        if ($table == 1) {
            $tablename = "dbo.Customers";
        }
        elseif($table == 2){
            $tablename = "dbo.Cards";
        }
        else{
            $tablename = "dbo.LoyaltyPointMatrix";

        }
        $currentdate =  date('Y-m-d H:i:s');
        if($table == 3){
            $id = DB::table('dbo.SyncTable')
            ->where('ID', $branchid)
            ->where('STATUS',0)
            ->where('TABLEID', $table)
            ->get();
            if(!empty($id)){
                $datab = [];
                foreach($id as $dataid){
                    $data = DB::table($tablename)->where('LPMID',$dataid->ID)->get();
                    $datab[]=$data;
                    }
                    $updatedata = DB::table('dbo.SyncTable')
                    ->where('ID', $branchid)
                    ->where('STATUS', 0)
                    ->where('TABLEID',$table)
                    ->update([
                        'STATUS'=>1,
                        'DPOSTED'=>$currentdate
                    ]);
                    LOG::info($updatedata);
                   return response()->json([
                    "StatusCode" => 200,
                    "StatusDescription" => "OK",
                    "Data" => [
                        "RetVal" => $datab
                    ],
                    "Message" => "Response payload"
                   ]);
               }
               else{
                return response()->json([
                    "StatusCode" => 500,
                    "StatusDescription" => "Error",
                    "Data" => [
                        "RetVal"
                    ],
                    "Message" => "Response payload"
                   ]);
               }

        }

else{

    $id = DB::table('dbo.SyncTable')
    ->where('BRANCHID', $branchid)
    ->where('STATUS',0)
    ->where('TABLEID', $table)
    ->get();
    $datab = [];
    LOG::info($id);
    if(!empty($id)){
     foreach($id as $dataid){
         $data = DB::table($tablename)->where('ID',$dataid->ID)->get();
         $datab[]=$data;
         }
         $updatedata = DB::table('dbo.SyncTable')
         ->where('BRANCHID', $branchid)
         ->where('STATUS', 0)
         ->where('TABLEID',$table)
         ->update([
             'STATUS'=>1,
             'DPOSTED'=>$currentdate
         ]);
         LOG::info($updatedata);
        return response()->json([
         "StatusCode" => 200,
         "StatusDescription" => "OK",
         "Data" => [
             "RetVal" => $datab
         ],
         "Message" => "Response payload"
        ]);
    }
    else{
     return response()->json([
         "StatusCode" => 500,
         "StatusDescription" => "Error",
         "Data" => [
             "RetVal"
         ],
         "Message" => "Response payload"
        ]);
    }

}


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
