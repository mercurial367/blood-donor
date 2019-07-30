<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodData extends Model
{
    // protected $fillable = array('email');
    protected $fillable = array('mobile_no', 'user_id', 'blood_group', 'state', 'city', 'name');

    public function user()
    {
        $this->belongsTo("App\User", "user_id");
    }
}
