@extends('layouts.app')

@section('content')


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Categor&iacute;a</div>
                <div class="panel-body">
					{!! Form::open(['route'=>'admin.category.store'])!!}

						  @component('componentes.crudbasic')
								@slot('name','')
								@slot('description','')
								@slot('parameters',['placeholder'=>'ingrese campo'])
						  @endcomponent


 					  {!! Form::submit('Guardar', ['class' => 'btn btn-success btn-xs']) !!}
 					   {{ link_to_route('admin.category.index', 'REGRESAR',[], ['class'=>'btn btn-warning btn-xs']) }}


					{!! Form::close()!!}
                </div>
            </div>
        </div>


@endsection
