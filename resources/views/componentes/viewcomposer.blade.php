  <div class="row">
                            <div class="panel panel-danger">
                                <div class="panel-heading">Acciones</div>
                                <div class="panel-body text-center">
                                    <a class="btn btn-primary" href="{{route('welcome')}}">Inicio</a>
                                </div>
                            </div>
                    </div>
                     <div class="row">
                            <div class="panel panel-info">
                                <div class="panel-heading">Libros por Categor&iacute;as</div>

                                

                                <div class="panel-body">
                                   

                                    <div class="list-group">
                                      @foreach($allCategories as $category)

                                       <a href="{{ route('categorybook',$category->slug)}}" class="list-group-item">{{ $category->name}} &nbsp; 
                                       @if(!Auth::guest())
                                          @if($category->user_categories_filter(Auth::user()->id))
                                             <button class="btn btn-danger btn-xs" data-category="{{$category->id}}">quitar suscripci&oacute;n</button>
                                          @else
                                             <button class="btn btn-info btn-xs" data-category="{{$category->id}}">suscribirse</button>
                                          @endif
                                       
                                       @endif
                                       <span class="badge">{{$category->books()->count()}}</span></a>

                                      @endforeach
                                     
                                    </div>


                                </div>
                            </div>
                    </div>