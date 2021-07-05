<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Core extends Model
{
    use SoftDeletes;
    protected $fillable = ['core_name','core_url','core_username','core_passhash'];
}
