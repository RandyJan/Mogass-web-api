<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  Illuminate\Http\Response;
class syncPointsinquiryController extends Controller
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
    public function show($id)
    {

       $points = DB::select('SELECT ViewCustomerLoyaltyPoints.FullName,ViewCustomerLoyaltyPoints.Earnings,ViewCustomerLoyaltyPoints.Adjustments,ViewCustomerLoyaltyPoints.Redemptions,dbo.Cards.DVALIDFROM,dbo.Cards.DVALIDUNTIL,
       dbo.Cards.STATUS, ViewCustomerLoyaltyPoints.CustomerID,dbo.Customers.STATUS,dbo.Cards.ID,ViewCustomerLoyaltyPoints.Balance, ViewCustomerLoyaltyPoints.CardTypeID FROM ViewCustomerLoyaltyPoints INNER JOIN  dbo.Customers ON dbo.Customers.ID = ViewCustomerLoyaltyPoints.CustomerID
       INNER JOIN dbo.Cards ON dbo.Cards.ID = ViewCustomerLoyaltyPoints.CardID WHERE ViewCustomerLoyaltyPoints.CardNo =?',[$id]);
      if(!empty($points)){
        foreach($points as $pointinq){

      return response()->json([
            "Retval"=>[

                'Fullname'=>$pointinq->FullName,
                'Earnings'=>$pointinq->Earnings,
                'Adjusments'=>$pointinq->Adjustments,
                'Redemptions'=>$pointinq->Redemptions,
                'DVALIDFROM'=>$pointinq->DVALIDFROM,
                'DVALIDUNTIL'=>$pointinq->DVALIDUNTIL,
                'CardStatus'=>$pointinq->STATUS,
                'CustomerId'=>$pointinq->CustomerID,
                'CustomerStatus'=>$pointinq->STATUS,
                'CardID'=>$pointinq->ID,
                'Balance'=>$pointinq->Balance,
                'CardTypeID'=>$pointinq->CardTypeID
                ]
        ]);

    }
    }

       else{
        return response([
            "StatusCode"=>404,
            "StatusDescription"=>"Error",
            "Data"=>[$id],
            "Message"=>"ID not found"
        ],404);
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
