<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRole extends Model
{
	use HasFactory;

	public $timestamps = false;
	protected $table = 'hrm_mst_role';

	protected $fillable = [
		'hrm_role_id',
		'hrm_role_name',
		'hrm_role_stat',
		'hrm_role_createdAt',
		'hrm_role_createdBy',
		'hrm_role_updatedAt',
		'hrm_role_updatedBy'
	];
}
