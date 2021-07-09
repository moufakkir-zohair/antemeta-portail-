<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryProbe extends Model
{   
    protected $tables = 'history_probes';
    use HasFactory;
    protected $fillable = ['core_id','objid','name','status'];
}
