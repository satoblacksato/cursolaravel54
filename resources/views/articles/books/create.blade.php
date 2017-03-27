@extends('layouts.app')

@section('content')


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Publicar Book</div>
                <div class="panel-body">
					{!! Form::open(['route'=>'articles.book.store','enctype'=>'multipart/form-data'])!!}

						 {!! Field::text('title',['placeholder'=>"Ingrese un título"]) !!}
                        {!! Field::textarea('description',['placeholder'=>"Ingrese un descripcion"]) !!}
                        {!! Field::select('category_id',$categories,['empty'=>'**Seleccione**']) !!}
                        {!! Field::select('private',config('dataselect.confirmation'),['empty'=>'**Seleccione**']) !!}
                         {!! Field::file('image',['class'=>'file','data-show-preview'=>true,'data-show-upload'=>false]) !!}

 					  {!! Form::submit('Guardar', ['class' => 'btn btn-success btn-xs']) !!}
 					   {{ link_to_route('admin.category.index', 'Regresar',[], ['class'=>'btn btn-warning btn-xs']) }}


					{!! Form::close()!!}
                </div>
            </div>
        </div>


@endsection
