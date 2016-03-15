<?php 
namespace App\Modules\Role\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = ['name', 'display_name', 'description'];
}