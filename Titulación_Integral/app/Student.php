<?php

namespace TitIntegral;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $fillable = ['NoControl','Nombre','Apellidos','Correo','Carrera_id','AñoIngreso','PeriodoIngreso','AñoTitulación'.'PeriodoTitulación','Sexo','observaciones'];

  /**
   * Get the carrera that owns the student.
   */
    public function carrera()
   {
       return $this->belongsTo('TitIntegral\Carrera','Carrera_id');
   }

   /**
     * Get the seguimiento record associated with the student.
     */

     public function seguimiento()
    {
        return $this->hasOne('TitIntegral\Seguimiento','student_id');
    }

    /**
     * Get the telefonos for the student.
     */

     public function telefonos()
    {
        return $this->hasMany('TitIntegral\Telefono','student_id');
    }


}
