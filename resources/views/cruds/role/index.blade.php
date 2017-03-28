@extends('layouts.app')

@section('content')


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de Roles
                </div>

                <div class="panel-body">

<div class="row">
    <div class="col-md-8">
        <a class="btn btn-primary btn-xs" href="{{ route('admin.role.create') }}">CREAR</a>
    </div>
    <div class="col-md-4">
        {!! Form::open(['route'=>'admin.role.index','method'=>'GET'])!!}

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
                            @foreach($roles as $role)

                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                      {{ link_to_route('admin.role.edit', 'EDT',[$role->id], ['class'=>'btn btn-warning btn-xs']) }}
                                       {{ link_to_route('admin.role.show', 'VER',[$role->id], ['class'=>'btn btn-primary btn-xs']) }}


{!! Form::open(['route'=>['admin.role.destroy',$role->id],'method'=>'DELETE','class'=>''])!!}
 {!! Form::submit('DEL', ['class' => 'btn btn-danger btn-xs']) !!}
{!! Form::close()!!}
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
 {!! $roles->render() !!}
                </div>
            </div>
        </div>


@endsection