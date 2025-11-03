<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class StatusModel extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $primaryKey = 'idstatus';
    public $timestamps = false; 
    protected $fillable = [
        'status_type',
        'is_delete'
    ];

    static public function getStatus()
    {
        return self:: select('idstatus','status_type')->where('is_delete', 0) -> get();
    }
}
