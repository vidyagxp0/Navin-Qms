<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaunchExtension extends Model
{
    use HasFactory;
    protected $fillable = [
        'dev_proposed_due_date',
        'dev_extension_justification',
        'dev_extension_completed_by',
        'dev_completed_on',

        'capa_proposed_due_date',
        'capa_extension_justification',
        'capa_extension_completed_by',
        'capa_completed_on',
    ];
}
