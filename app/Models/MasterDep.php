<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDep extends Model
{
	use HasFactory;
	public $timestamps = false;
	protected $table = 'hrm_mst_dep';
	protected $fillable = [
		'hrm_dep_id',
		'hrm_name_dep',
		'hrm_company_id',
		'hrm_dep_createdAt',
		'hrm_dep_createdBy',
		'hrm_dep_updatedAt',
		'hrm_dep_updatedBy'
	];
}
