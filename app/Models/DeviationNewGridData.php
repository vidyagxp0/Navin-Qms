<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviationNewGridData extends Model
{
    use HasFactory;
    protected $table = 'deviation_new_data_grid';

    protected $casts = [
        'data' => 'array'
    ];
}
