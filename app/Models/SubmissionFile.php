<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionFile extends Model
{
    protected $guarded = ['id'];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
