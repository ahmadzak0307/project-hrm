<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterEmployees extends Model
{
	use HasFactory;
	public $timestamps = false;
	protected $table = 'hrm_mst_employees';
	protected $fillable = [
		'id',
		'nip',
		'full_name',
		'email',
		'id_company',
		'gender',
		'father_name',
		'phone',
		'date_of_birth',
		'profile_image',
		'alamat',
		'status'
	];
}
