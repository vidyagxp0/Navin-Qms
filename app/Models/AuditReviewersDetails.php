<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditReviewersDetails extends Model
{
    use HasFactory;
    protected $table = 'audit_reviewers_details';
    protected $fillable = [
        // Add other fillable fields here
        'user_id',
        'deviation_id',
        'reviewer_comment_by',
        'reviewer_comment_on'
    ];
}
