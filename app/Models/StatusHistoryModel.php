<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusHistoryModel extends Model
{
    protected $table = 'status_history';
    protected $primaryKey = 'idstatushistory';
    public $timestamps = false;

    protected $fillable = [
        'assets_id',
        'status_id',
        'assigned_to_id',
        'changed_by',
        'remarks',
        'created_at',
        'is_delete',
    ];

    public function status()
    {
        return $this->belongsTo(StatusModel::class, 'status_id', 'idstatus');
    }

    public function assignedUser()
    {
        return $this->belongsTo(UserAssetModel::class, 'assigned_to_id', 'id');
    }

    public function changedByUser()
    {
        return $this->belongsTo(User::class, 'changed_by', 'id');
    }
}
