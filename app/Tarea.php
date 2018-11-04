<?php

namespace Tareas;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    //

	public function usuario()
	{
		return $this->belongsTo('Tareas\User');
	}

	public function estado()
	{
		return $this->belongsTo('Tareas\Estado');
	}
}
