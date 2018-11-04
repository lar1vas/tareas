<?php

namespace Tareas;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //
    
    public function tareas()
    {
    	return $this->hasMany('Tareas\Tarea');
    }
}
