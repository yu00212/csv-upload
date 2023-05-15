<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'representative_name',
        'representative_name_kana',
        'company_name',
        'company_name_kana',
        'business_content',
        'established_at',
    ];
}
