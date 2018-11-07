@extends('layouts.app')
 @section('content')
 <div class="container">
    @if(Session::has('notice'))
       <div class="alert alert-success">
          {{ Session::get('notice') }}
       </div>
    @endif
    <h1> Lista de tareas </h1>
    <div class="row">
       <div class="col-lg-12">
          {!! link_to('tareas/create', 'Crear', ['class' => 'btn btn-primary']) !!}
       </div>
    </div>
    <table class="table">
       <thead>
       <tr>
             <th style="width: 35%"> Título </th>
             <th style="width: 35%"> Estado </th>
             <th style="width: 10%"> </th>
             <th style="width: 10%"> </th>
             <th style="width: 10%"> </th>
          </tr>
       </thead>
       <tbody>
          @foreach ($tareas as $tarea)
             <tr>
                <td> {{ $tarea->titulo }} </td>
                <td> {{ $tarea->estado->nombre }} </td>
                <td>
                   {!! link_to('tareas/'.$tarea->id, 'Ver', ['class' => 'btn btn-primary']) !!}
                </td>
                <td>
                   {!! link_to('tareas/'.$tarea->id.'/edit', 'Editar', ['class' => 'btn btn-primary']) !!}
                </td>
                <td>
                  @can('destroy_tareas')
                    {!! Form::open(array('url' => 'tareas/' . $tarea->id, 'method' => 'DELETE')) !!}
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                  @else
                    Usted no puede eliminar esta tarea
                  @endcan
                </td>
             </tr>
          @endforeach
       </tbody>
    </table>

    @role('Administrador')
      <!-- <p>Soy un administrador</p> -->
    @else
      <!-- <p>No soy un administrador</p> -->
    @endrole
    
    @can('destroy_tareas')
      <!-- <p>Tengo el permiso destroy_tareas</p> -->
    @else
      <!-- <p>No tengo el permiso destroy_tareas</p> -->
    @endcan
 </div>
 @endsection