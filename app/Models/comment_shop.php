<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment_shop extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'comment_content', 'comment_name', 'comment_date','shop_id'
    ];
    protected $primaryKey = 'comment_shop_id';
 	protected $table = 'tbl_comment_shop';
}
