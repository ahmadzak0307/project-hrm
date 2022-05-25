<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFunction extends Model
{
	use HasFactory;
	public $timestamps = false;
	protected $table='hrm_mst_function';
	protected $fillable = [
		'hrm_func_id',
		'hrm_name_func',
		'hrm_dep_id',
		'hrm_func_createdAt',
		'hrm_func_createdBy',
		'hrm_func_updatedAt',
		'hrm_func_updatedBy'
	];
}