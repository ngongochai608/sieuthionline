<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statistical extends Model
{
    use HasFactory;
    protected $fillable = [
    	'order_date', 'sales', 'profit','quantity','total_order'
    ];
    protected $primaryKey = 'statistical_id';
 	protected $table = 'tbl_statistical';
}
