<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class syncEarnings extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = "dbo.LoyaltyEarnings";
    protected $fillable = [
        'BRANCHID',
        'ID',
        'DATE',
        'REFID',
        'CUSTOMERID',
        'ASSOCID',
        'CARDID',
        'TOTALLITERS',
        'TOTALAMOUNT',
        'MULTIPLIER',
        'POINTS',
        'CASHIERID',
        'TRANINVNO',
        'TRANSID',
        'TRANSDATE',
        'TRANSTIME',
        'CATEGORYCODE',
        'STATUS',
        'UPLOADED'


    ];
    public $timestamps = false;
}
