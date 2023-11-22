<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class syncRedemption extends Model
{
    use HasFactory;

    protected $table = "dbo.LoyaltyRedemptions";

    protected $fillable =[
        'BRANCHID',
        'ID',
        'DATE',
        'CUSTOMERID',
        'REWARDID',
        'CARDID',
        'QUANTITY',
        'UNITPTS',
        'POINTS',
        'PRINTCOUNT',
        'UINS',
        'DINS',
        'TINS',
        'CATEGORYCODE',
        'STATUS'
    ];
    public $timestamps = false;
}

