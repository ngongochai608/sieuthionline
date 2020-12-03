<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment_product extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'comment_content', 'comment_name', 'comment_date','product_id'
    ];
    protected $primaryKey = 'comment_id';
 	protected $table = 'tbl_comment_product';

}
