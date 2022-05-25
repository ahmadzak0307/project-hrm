<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAward extends Model
{
    use HasFactory;
    protected $table = 'hrm_mst_awards';
    // public $timestamps = false;
    protected $fillable = [
        'hrm_company_id',
        'nip',
        'award_name',
        'gift',
        'case_price',
        'month',
        'year',
        'created_at',
        'updated_at'
    ];
}
