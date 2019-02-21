<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uptime extends Model
{
    protected $fillable = ['server', 'online', 'tps', 'tick_usage', 'memory'];

    protected $table = 'uptime';

    protected $connection = 'mysql3';
}
