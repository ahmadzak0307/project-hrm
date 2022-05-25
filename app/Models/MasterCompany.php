<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCompany extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'hrm_mst_company';
    protected $fillable = [
        'hrm_company_id',
        'hrm_company_code',
        'hrm_company_name',
        'hrm_company_shift',
        'hrm_company_status',
        'hrm_company_logo',
        'hrm_company_createdAt',
        'hrm_company_createdBy',
        'hrm_company_updatedAt',
        'hrm_company_updatedBy'
    ];
}
