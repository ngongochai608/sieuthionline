<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'shop_id', 'rating', 'customer_name','rating_date'
    ];
    protected $primaryKey = 'rating_id';
    protected $table = 'tbl_rating';
}
