<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class CompanyModel extends Model
{
    use HasFactory;
    protected $table = 'company';
    protected $primaryKey = 'idcompany';
    protected $fillable = [
        'company_name',
        'created_at',
        'updated_at',
        'is_delete' 
    ];

    static public function getCompany()
    {
        return self::select('idcompany','company_name') -> where('is_delete', 0) -> get();
    }
}
