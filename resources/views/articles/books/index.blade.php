@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de Libros
                </div>

                <div class="panel-body">

<div class="row">
    <div class="col-md-8">
        <a class="btn btn-primary btn-xs" href="{{ route('articles.book.create') }}">CREAR</a>
    </div>
</div>

		  			<table class="table" id="tbData">
                        <thead>
                            <th>Id</th>
                            <th>Titulo</th>
                            <th>Descripci&oacute;n</th>
                            <th>Acciones</th>
                        </thead>
                     </table>
                </div>
            </div>
        </div>
   </div>
</div>
<modal-book></modal-book>




@endsection
@section('masterjs')
<script src="/componentes/modalbook.tag" type="riot/tag"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                 $.fn.dataTable.ext.errMode = 'throw';
         $('#tbData').DataTable({
                "language": {

                            "url": "/json/datatable_spanish.json"

                        },
                 "processing": true,
                "serverSide": true,
                 "deferRender":true,
                "ajax": "/articles/book-datatable",
                  "columns": [
                        {data: 'id'},
                        {data: 'title'},
                        {data: 'description',"render":function(data,type,row){
                               return   $('<div />').html(row.description).text();
                        }},
                        {data: 'actions', "bSortable": false, "searchable": false, "targets": 0,
                        "render":function(data, type, row ){
                                return   $('<div />').html(row.actions).text();
                        }
}
                    ]
         });

            });


            function viewModal(_id){
                 riot.mount('modal-book', {id:_id}); 
            }
        </script>
@endsection