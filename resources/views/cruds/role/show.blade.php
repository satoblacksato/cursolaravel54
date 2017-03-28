@extends('layouts.app')

@section('content')


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Vista de Roles</div>
                <div class="panel-body">
					
                        @component('componentes.crudbasic')
                                @slot('name',$role->name)
                                @slot('description',$role->description)
                                @slot('parameters',['readonly'=>'readonly'])
                        @endcomponent

 					 {{ link_to_route('admin.role.index', 'REGRESAR',[], ['class'=>'btn btn-warning btn-xs']) }}
					
                </div>
            </div>
        </div>


@endsection