<?php 
namespace App\Modules\Role\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $fillable = ['name', 'display_name', 'description'];
}