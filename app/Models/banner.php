<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
	use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'banner_status', 'banner_image', 'banner_name','banner_desc'
    ];
    protected $primaryKey = 'banner_id';
 	protected $table = 'tbl_banner';
}
