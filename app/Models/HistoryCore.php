<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryCore extends Model
{
    use HasFactory;
    protected $tables = 'history_cores';
    protected $fillable = ['core_id','prtg-version','totalsens','upsens','downsens','warnsens','downacksens','partialdownsens','unusualsens','pausedsens','undefinedsens'];
}
