<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class category_product extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'category_name', 'category_slug_product', 'category_desc','category_image'
    ];
    protected $primaryKey = 'category_id';
 	protected $table = 'tbl_category_product';
}
