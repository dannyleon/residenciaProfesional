<?php

namespace TitIntegral;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    //
    /**
    * Get the students for the carrera.
    */

    public function students()
   {
       return $this->hasMany('TitIntegral\Student', 'Carrera_id');
   }
}
