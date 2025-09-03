<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    
    public function loginable()
    {
        return $this->morphTo();
    }
    


}
