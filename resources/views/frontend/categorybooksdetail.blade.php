@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                    <div class="col-md-8">
                        Libros Para Categor&iacute;a: <b>{{$objBook->title}}</b><br/>
                    </div>
                   
                    </div>
                </div>
                <div class="panel-body">
                <div class="row text-center">
                    <h4 class="text-danger text-center"><b>Detalle Libro</b></h4>
                    <hr/>

                  <div class="col-lg-12 text-left">
                    <div class="media">
                        <a href="#" class="pull-left"><img  src="/books/{{$objBook->image}}" class="media-object" /></a>
                        <div class="media-body">
                            <h4 class="media-heading">
                                   <b>T&iacute;tulo: </b> {{ $objBook->title}}
                            </h4> <b>Descripci&oacute;n</b>: {!! $objBook->description!!}<br/>

                            <b>Creado por: </b> {{ $objBook->user->email}}, {{ $objBook->created_at->diffForHumans() }}
                        </div>
                    </div>
                  </div>
                       
                </div>

                 
<div id="disqus_thread"></div>
<script id="dsq-count-scr" src="//larabook.disqus.com/count.js" async></script>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://larabook.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                



                
               </div>
            </div>

        </div>
        <div class="col-md-4 ">
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
                        <div class="panel-heading">Lista Categor&iacute;as</div>
                        <div class="panel-body">
                            
                        </div>
                    </div>
            </div>
        </div>
   </div>
</div>


@endsection
