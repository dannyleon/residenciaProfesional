<?php

namespace TitIntegral;

use Illuminate\Database\Eloquent\Model;

class Metodo extends Model
{
  /**
     * Get the seguimientos que pertenecen a este metodo.
     */

     public function seguimiento()
    {
        return $this->hasMany('TitIntegral\Seguimiento','metodo_id');
    }
}
