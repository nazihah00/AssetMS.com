<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class VendorModel extends Model
{
    use HasFactory;
    protected $table = 'vendors';
    protected $primaryKey = 'idvendors';
    protected $fillable = [
        'vendors_name',
        'created_at',
        'updated_at',
        'is_delete' 
    ];
    static public function getVendor()
    {
        return self::select('idvendors','vendors_name') -> where('is_delete', 0) -> get();
    }
}
