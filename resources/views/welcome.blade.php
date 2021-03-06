<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ config('app.name')}}</title>
    <meta name="description" content="This is a free Bootstrap landing page theme created for BootstrapZero. Feature video background and one page design." />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Codeply">
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/animate.min.css" />
    <link rel="stylesheet" href="./css/ionicons.min.css" />
    <link rel="stylesheet" href="./css/styles.css" />
    
  </head>
  <body>
    <nav id="topNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#first"><i class="ion-ios-analytics-outline"></i> Librer&iacute;a Laravel</a>
            </div>
            <div class="navbar-collapse collapse" id="bs-navbar">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="page-scroll" href="#one">Geolocalizaci&oacute;n</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#two">Categor&iacute;as</a>
                    </li>
                    
                    <li>
                        <a class="page-scroll" href="#four">Caracter&iacute;sticas</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#last">Contactanos</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" data-toggle="modal" title="A free Bootstrap video landing theme" href="#aboutModal">Info</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header id="first">

        <div class="header-content">
            <div class="inner">
                <h1 class="cursive">Bienvenidos, a Book Laravel</h1>
                <h4>P&aacute;gina del curso de laravel 5.4</h4>
                <hr>
                
                @if (Route::has('login'))
                   @if (Auth::check())
                        <a href="{{ url('/home') }}"  class="btn btn-info btn-xl">Dashboard</a>
                    @else
                        <a href="{{ url('/login') }}"
                         class="btn btn-info btn-xl">Ingresar</a> &nbsp; 
                         <a href="{{ url('/register') }}" class="btn btn-danger btn-xl ">Registro</a>
                    @endif
                @endif
                <div id="map"></div>
            </div>
        </div>
     
    </header>
        @include('componentes.errors')
    <section class="bg-primary" id="one">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
                    <h2 class="margin-top-0 text-primary">MI GEOLOCALIZACI&Oacute;N</h2>
                    <br>
                    
                      <div id="mapa"></div>
                    
                   
                </div>
            </div>
        </div>
    </section>
    <section id="two">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="margin-top-0 text-primary">Categor&iacute;as Disponibles</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row text-center">
                @foreach($categories as $category)
                      @component('componentes.thumbnail')
                            @slot('image','<i class="icon-lg ion-cube  text-danger" ></i>')
                            @slot('title', $category->name)
                            @slot('description', $category->description)
                            @slot('route',route('categorybook',$category->slug))
                            @slot('width','col-sm-6 col-md-3')
                      @endcomponent
                @endforeach
            </div>
        </div>
    </section>
    
    <section class="container-fluid" id="four">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h2 class="text-center text-primary">Caracter&iacute;sticas</h2>
                <hr>
                <div class="media wow fadeInRight">
                    <h3>Simple</h3>
                    <div class="media-body media-middle">
                        <p>Utilizaci&oacute;n de laravel 5.4 acompañado de componentes actuales.</p>
                    </div>
                    <div class="media-right">
                        <i class="icon-lg ion-ios-bolt-outline"></i>
                    </div>
                </div>
                <hr>
                <div class="media wow fadeIn">
                    <h3>Free</h3>
                    <div class="media-left">
                        <a href="#alertModal" data-toggle="modal" data-target="#alertModal"><i class="icon-lg ion-ios-cloud-download-outline"></i></a>
                    </div>
                    <div class="media-body media-middle">
                        <p>Los componenetes y temas utilizados en el proyecto son totalmente gratuitos</p>
                    </div>
                </div>
                <hr>
                <div class="media wow fadeInRight">
                    <h3>Adaptable</h3>
                    <div class="media-body media-middle">
                        <p>Dise&ntilde;o adaptable a diferentes pantallas.</p>
                    </div>
                    <div class="media-right">
                        <i class="icon-lg ion-ios-snowy"></i>
                    </div>
                </div>
                <hr>
                <div class="media wow fadeIn">
                    <h3>Componentes</h3>
                    <div class="media-left">
                        <i class="icon-lg ion-ios-heart-outline"></i>
                    </div>
                    <div class="media-body media-middle">
                        <p>Componentes usados: bootsrap, CronJobs, Maps, Datatable, Jquery, SweetAlert, HighCharts, Ajax.</p>
                    </div>
                </div>
                <hr>
               
            </div>
        </div>
    </section>
    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2 class="text-primary">Herramientas</h2>
                <a href="http://www.bootstrapzero.com/bootstrap-template/landing-zero" target="ext" class="btn btn-default btn-lg wow flipInX">Herramientas y/o Componentes Utilizados de BootstrapZero</a>
            </div>
            <br>
            <hr/>
            <br>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="row">
                        <h6 class="wide-space text-center">BOOTSTRAP IS BASED ON THESE STANDARDS</h6>
                        <div class="col-sm-3 col-xs-6 text-center">
                            <i class="icon-lg ion-social-html5-outline" title="html 5"></i>
                        </div>
                        <div class="col-sm-3 col-xs-6 text-center">
                            <i class="icon-lg ion-social-sass" title="sass"></i>
                        </div>
                        <div class="col-sm-3 col-xs-6 text-center">
                            <i class="icon-lg ion-social-javascript-outline" title="javascript"></i>
                        </div>
                        <div class="col-sm-3 col-xs-6 text-center">
                            <i class="icon-lg ion-social-css3-outline" title="css 3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <section id="last">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="margin-top-0 wow fadeIn">Env&iacute;o</h2>
                    <hr class="primary">
                    <p>Env&iacute;ale un mensaje al administrador</p>
                </div>
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <form class="contact-form row" method="post" action="{{ route('emailcontact')}}">
                    {!! csrf_field() !!}
                        <div class="col-md-4">
                            <label></label>
                            <input type="text"  name="nombres" class="form-control" placeholder="Nombres" required="">
                        </div>
                        <div class="col-md-4">
                            <label></label>
                            <input type="text" name="email" class="form-control" placeholder="Email" required="">
                        </div>
                        <div class="col-md-4">
                            <label></label>
                            <input type="text" name="telefonos" class="form-control" placeholder="Tel&eacute;fono" required="">
                        </div>
                        <div class="col-md-12">
                            <label></label>
                            <textarea class="form-control" rows="9" name="mensaje" placeholder="Tu mensaje" required=""></textarea>
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <label></label>
                            <button type="submit"  class="btn btn-primary btn-block btn-lg">Enviar <i class="ion-android-arrow-forward"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer">
        <div class="container-fluid">
            
            <br/>
            <span class="pull-right text-muted small"><a href="http://www.bootstrapzero.com">Landing Zero by BootstrapZero</a> ©2015 Company</span>
        </div>
    </footer>
    <div id="galleryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" id="galleryImage" class="img-responsive" />
                <p>
                    <br/>
                    <button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">Close <i class="ion-android-close"></i></button>
                </p>
            </div>
        </div>
        </div>
    </div>
    <div id="aboutModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="text-center">Curso Laravel 5.4</h2>
                <h5 class="text-center">
                    Es un sitio realizado en laravel
                </h5>
                <p class="text-justify">
                   Este curso sirve para conocer el framework de laravel, en el cual aprenderemos varias tecnicas
                   que serviran para la construcci&oacute;n de nuestros sitios.
                </p>
                <p class="text-center"><a href="http://www.ascomsa.net">Ascomsa</a> <br/>
<a href="https://twitter.com/laravelecuador">Laravel Ecuador</a> 
                </p>
                <br/>
                <button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true"> OK </button>
            </div>
        </div>
        </div>
    </div>
    <div id="alertModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="text-center">Nice Job!</h2>
                <p class="text-center">You clicked the button, but it doesn't actually go anywhere because this is only a demo.</p>
                <p class="text-center"><a href="http://www.bootstrapzero.com">Learn more at BootstrapZero</a></p>
                <br/>
                <button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">OK <i class="ion-android-close"></i></button>
            </div>
        </div>
        </div>
    </div>
    <!--scripts loaded here -->
    <script src="js/app.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/scripts.js"></script>

 <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
 <style type="text/css">
   #mapa{
    width: 600px;
    height: 300px;
   }
 </style>
    <script type="text/javascript">
      $(function(){
          navigator.geolocation.getCurrentPosition(success, error);


            function success(position){

                var lat= position.coords.latitude;
                var long=position.coords.longitude;

                var latlng=new google.maps.LatLng(lat,long);

                //Create the map
                var mapOptions={
                    zoom:14,//0-18
                    center:latlng,
                    mapTypeId:google.maps.MapTypeId.ROADMAP
                };

                var map=new google.maps.Map(document.getElementById("mapa"), mapOptions);

                var marker=new google.maps.Marker({
                    position:latlng,
                    map:map,
                    title:"AQUI ME ENCUENTRO",
                    draggable:false,
                    animation:google.maps.Animation.DROP
                });

          }

          function error(){
            //  alert("no pudo establecer geolocalizacion");
              console.log("no pudo establecer geolocalizacion");
          }

      });
    </script>
  
  </body>
</html>
