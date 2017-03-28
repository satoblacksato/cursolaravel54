@extends('layouts.app')

@section('content')


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Book</div>
                <div class="panel-body">
					{!! Form::open(['route'=>['articles.book.update',$book->id],'enctype'=>'multipart/form-data','method'=>'PUT'])!!}

						 {!! Field::text('title',$book->title,['placeholder'=>"Ingrese un título"]) !!}
                        {!! Field::textarea('description',$book->description,['placeholder'=>"Ingrese un descripcion"]) !!}
                        {!! Field::select('category_id',$categories,$book->category_id,['empty'=>'**Seleccione**']) !!}
                        {!! Field::select('private',config('dataselect.confirmation'),$book->private,['empty'=>'**Seleccione**']) !!}
                        
                        <div class="panel panel-info">
                          <div class="panel-heading">
                              IMAGEN ACTUAL
                          </div>
                          <div class="panel-body">
                              <div class="thumbnail">
                                <img src="/books/{{$book->image}}" class="image" />
                              </div>
                          </div>
                        </div>
    

                         {!! Field::file('image',['class'=>'file','data-show-preview'=>true,'data-show-upload'=>false]) !!}

 					  {!! Form::submit('Guardar', ['class' => 'btn btn-success btn-xs']) !!}
 					   {{ link_to_route('articles.book.index', 'Regresar',[], ['class'=>'btn btn-warning btn-xs']) }}


					{!! Form::close()!!}
                </div>
            </div>
        </div>
 


@endsection
