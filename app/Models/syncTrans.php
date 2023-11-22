<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class syncTrans extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "dbo.LoyaltyTrans";
    protected $fillable = [
        'BRANCHID',
        'ID',
        'TRANSID',
        'ITEMNO',
        'PRODUCTID',
        'LITERS',
        'AMOUNT',
        'UNITPOINT',
        'TOTALPOINTS',
        'UPLOADED',
        'DATE_TRANS'
    ];
    public $timestamps = false;
}
