<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class LocationModel extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $primaryKey = 'idlocations';
    public $timestamps = false; 
    protected $fillable = [
        'locations_name',
        'is_delete'
        
    ];

    static public function getLocation()
    {
        return self:: select('idlocations', 'locations_name')->where('is_delete', 0) -> get();
    }
}
