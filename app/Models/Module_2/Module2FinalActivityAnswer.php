<?php

namespace App\Models\Module_2;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Module2FinalActivityAnswer extends Model
{
    protected $table = 'module2_final_activity_answers_table';

    protected $fillable = [
        'module2_final_activity_id',
        'scenario_number',
        'choice_text',
        'selected',
        'is_correct'
    ];

    public function activity()
    {
        return $this->belongsTo(Module2FinalActivity::class, 'module2_final_activity_id');
    }
}
