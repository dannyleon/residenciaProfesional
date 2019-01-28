<?php

namespace TitIntegral;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //

    /**
     * Get the seguimientos que correspondan al status.
     */

     public function seguimientos()
    {
        return $this->hasMany('TitIntegral\Seguimiento','status_id');
    }
}
