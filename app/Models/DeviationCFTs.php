<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviationCFTs extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'deviation_cfts';
}
