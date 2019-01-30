<?php

namespace TitIntegral;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
  protected $table = "status";
  /**
     * Get the seguimientos que correspondan al status.
     */

     public function seguimiento()
    {
        return $this->hasMany('TitIntegral\Seguimiento','status_id');
    }
}
