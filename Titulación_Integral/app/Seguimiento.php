<?php

namespace TitIntegral;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
  /**
   * Get the student that owns the seguimiento.
   */

   public function student()
    {
        return $this->belongsTo('TitIntegral\Student','id');
    }

    /**
     * Get the Metodo que pertenece al seguimiento
     */

     public function metodo()
    {
        return $this->belongsTo('TitIntegral\Metodo', 'metodo_id');
    }

    /**
     * Get the Status that owns the seguimiento.
     */

     public function status()
    {
        return $this->belongsTo('TitIntegral\Estado','id');
    }

}
