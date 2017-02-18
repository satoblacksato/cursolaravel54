@extends('layouts.app')

@section('content')

<div class="container">



    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Listado Categor&iacute;as
                </div>

                <div class="panel-body">

<div class="row">
    <div class="col-md-8">
        <a class="btn btn-primary btn-xs" href="{{ route('admin.category.create') }}">CREAR</a>
    </div>
    <div class="col-md-4">
        {!! Form::open(['route'=>'admin.category.index','method'=>'GET'])!!}

            {!! Form::text('scope',$scope,['class'=>"form-control"]) !!}
                        {!! Form::submit('Buscar', ['class' => 'btn btn-success btn-xs']) !!}
        {!! Form::close()!!}
    </div>
</div>

		  			<table class="table">
                        <thead>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripci&oacute;n</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)

                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                      {{ link_to_route('admin.category.edit', 'EDT',[$category->id], ['class'=>'btn btn-warning btn-xs']) }}
                                       {{ link_to_route('admin.category.show', 'VER',[$category->id], ['class'=>'btn btn-primary btn-xs']) }}


{!! Form::open(['route'=>['admin.category.destroy',$category->id],'method'=>'DELETE','class'=>''])!!}
 {!! Form::submit('DEL', ['class' => 'btn btn-danger btn-xs']) !!}
{!! Form::close()!!}
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
 {!! $categories->render() !!}
                </div>
            </div>
        </div>
   </div>
</div>

@endsection