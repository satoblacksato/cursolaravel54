@extends('layouts.app')

@section('content')



        <div class="col-md-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                    <div class="col-md-8">
                        Libros Para Categor&iacute;a: <b>{{$objCategory->name}}</b><br/>
                    </div>
                    <div class="col-md-4">
                         {!! Form::open(['route'=>['categorybook',$objCategory->slug],'method'=>'GET', 'class'=>'form-horizontal'])!!}
                                    {!! Form::text('scope',$scope,['class'=>"form-control",'placeholder'=>'Buscar por titulo  de libro']) !!}
                         {!! Form::close()!!}
                    </div>
                    </div>
                </div>
                <div class="panel-body">
                <div class="row text-center">
                    <h4 class="text-danger text-center"><b>LIBROS PUBLICOS</b></h4>
                    <hr/>
    					@forelse($publics as $book)
                             @component('componentes.thumbnail')
                             @slot('width','col-sm-6 col-md-4')
                                @slot('image',' <img src="/books/'.$book->image.'" class="image" />')
                                @slot('title', $book->title)
                                @slot('description', $book->description)
                                @slot('route',route('categorybookdetail',[$objCategory->slug,$book->slug]))
                                @slot('slot')
                                    <b>Creado: </b> {{ $book->created_at->diffForHumans() }}
                                @endslot
                             @endcomponent
                         @empty
                            <p>No hay libros p&uacute;blicos por presentar</p>
                        @endforelse
                </div>

                 <div class="row text-center" >
                    <h4 class="text-danger text-center"><b>LIBROS PRIVADOS</b></h4>
                    <hr/>
                        @forelse($privates as $book)
                             @component('componentes.thumbnail')
                             @slot('width','col-sm-6 col-md-4')
                                @slot('image',' <img src="/books/'.$book->image.'" class="image" />')
                                @slot('title', $book->title)
                                @slot('description', $book->description)
                                @slot('route','#')
                                  @slot('slot')
                                    <b>Creado: </b> {{ $book->created_at->diffForHumans() }}
                                @endslot
                             @endcomponent
                       @empty
                            @if(Auth::guest())
                                    <p>Para visualizar estos libros debes ingresar al sistema<br/><a href="/login" class="btn btn-warning">Ingresar</a></p>
                            @else
                                 <p>No hay libros privados por presentar</p> 
                            @endif
                        @endforelse
                </div>
                
               </div>
            </div>

        </div>


@endsection
