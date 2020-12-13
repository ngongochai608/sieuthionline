<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_roles extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_admin_roles', 'roles_id_roles'
    ];
    protected $primaryKey = 'id_admin_roles';
 	protected $table = 'admin_roles';
}
