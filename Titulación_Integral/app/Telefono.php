<?php

namespace TitIntegral;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{

  protected $fillable = ['numeroTel'];

  /**
   * Get the student that owns the telefono.
   */

   public function student()
    {
        return $this->belongsTo('TitIntegral\Student', 'idTelefono');
    }
}
