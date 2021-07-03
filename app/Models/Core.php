<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Core extends Model
{
    protected $fillable = ['core_name','core_url','core_username','core_passhash'];
}
