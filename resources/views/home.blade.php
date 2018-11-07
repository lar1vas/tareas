@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Control de Actividades</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @role('Administrador') 
                        <p>Eres Administrador</p> 
                    @else 
                        <p>No eres Administrador</p> 
                    @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
