@extends('layouts.app')


@include('layouts.navbarinf')


@section('content') 
 
@section('estilo')

<style>
/*uso de apis google*/
@import url(https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,200);
@import url(https://fonts.googleapis.com/css?family=Lato:300,400,700);


/*movimiento de iconos */



/*estilos para el menu*/
body {
	background: #04000c7a; 
	color: #fff; /* color de la fuente */
  margin: 0;
  padding: 0;
	padding-bottom:40px;
}
.fuente{
  font-weight: 300;
  font-size: 1.5em;
  font-family: 'Lato',Arial,sans-serif;
} 
.descripcion{
  line-height: 40px;
}
.link{
  color: #b5a4fb;
	text-decoration: none;
}

*, *:after, *:before { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }

link, button {
	outline: none;
}
.clearfix:before,
.clearfix:after {
	content: " ";
	display: table;
}


.clearfix:before,
.clearfix:after {
	content: " ";
	display: table;
}
 
.clearfix:after {
	clear: both;
}


.header{
  background: #6c7476;
  color: #fff;

  text-align: center;
}

/* To Navigation Style */
.cctop {
	
	width: 100%;
	text-transform: uppercase;
	font-weight: 700;
	font-size: 0.75em;
	line-height: 3.2;
}

.cctop a {
	display: inline-block;
	padding: 0 1.5em;
	text-decoration: none;
	letter-spacing: 1px;
}

.cctop span.right {
	float: right;
}

.cctop span.right a {
	display: block;
	float: left;
}

/* estilos de cabecera*/





/* Demo estilos*/
.codeconvey-demo {
	padding-top: 1em;
	font-size: 0.8em;
}

.codeconvey-demo a {
	display: inline-block;
	margin: 0.5em;
	padding: 0.7em 1.1em;
	outline: none;
	border: 2px solid #fff;
	color: #fff;
	text-decoration: none;
	text-transform: uppercase;
	letter-spacing: 1px;
	font-weight: 700;
}

.codeconvey-demo a:hover,
.codeconvey-demo a.current-demo,
.codeconvey-demo a.current-demo:hover {
	border-color: #333;
	color: #333;
}

/* Wrapper Style */

.envoltura{
  display: flex;
  flex-direction: column;
  min-height: 110vh;

}
.wrapper > * {
  padding: 20px;
}
 
.page-main {
  flex-grow: 1;
}
.heading{
  font-size: 4em;
  font-weight: 300;
  margin-bottom: .5em;
}

.envolver{

width: auto;
height: auto;
margin: 70px 90px;
float: right;
}
.fa{
color:#FFFFFF;
}
div[class^="btn"]{
float: left;
margin: 0 10px 10px 0;
height: 100px;
width: 240px;
position: relative;
cursor: pointer;
transition: all .4s ease;

border: solid 2px transparent;
padding-top: 32px;
text-align:center;
line-height:100px;
}
div[class^="btn"]:hover{
	opacity: 0.7;
}
div[class^="btn"]:active{
	transform: scale(.98,.98);
}
.btn-big{width: 200px;}
.btn-small{width: 95px;}
.last{margin-right: 0 !important;}
.inicio{
color: white;
font: normal 50px 'Yanone Kaffeesatz', sans-serif;
margin-bottom: 20px;
cursor: pointer;
user-select: none;
transition: all .3s ease;
}
.inicio:hover{
  text-shadow: 0 0 4px white;
}
.space{
	margin-bottom: 110px;
}
.label{
	position: absolute;
	color: white;
	font: 500 12px sans-serif;
	left: 10px;
  user-select: none;
}
.bottom{bottom: 5px;}
.top{top: 5px;}
/*paleta de colores de iconos*/
.red{background: #df0024;}
.blue{ background: #00a9ec;}
.orange{background: #ff9000;}
.green{background: #0e5d30;}
.purple{background: #8b0189;}
.blue2{background: #253fd0;}
.stima{background: #30899d;}
.rojo2{background: rgb(178, 66, 62)}
.esmeralda{background: #08353d7a}
.green-bright{background: #78d204;}
.blue-nav{background: #25478e;}
.redish{background: #fe0000;}
.yellow{background: #d0d204;}
/* falta hacer pruebas 
.photo{
  background: url('http://example.com');
  background-position: -2px -2px;
}
*/
/* animacion de giros */
.gray{
  background: #5f5f5f;
  animation: flip 10s linear infinite;
  transform: rotateX(0deg);
}

/*animacion */
.animacion1{
  animation: flip 10s linear infinite;
  transform:rotate(0deg);
  
}
.animacion2{
  animation: flip 15s linear infinite;
  transform:rotate(0deg);
}
.animacion3{
  animation: flip 20s linear infinite;
  transform:rotate(0deg);
}



div[class^="icon"]{
	width: 45px;
	height: 45px;
	margin: 20px auto;
	background-size: 45px 45px;
}
#iconX{
  
    
    text-shadow: 1px 1px 1px #ccc;
    font-size: 1.5em;

}
/* causa errores el manejo de scrow*
::-webkit-scrollbar{
  width: 10px;
	height: 10px;
	cursor: pointer;	
}
*/

::selection{
    background: mintcream; 
}
/*animacion de griro*/
@keyframes flip{
  0%{
    transform: rotateX(0deg);
  }
  15%{
    transform: rotateX(360deg);  
  }
  100%{
    transform: rotateX(360deg); 
  }
}
/*necesita mas pruebas 
.photo img{
  top: -4px;
  left: -4px;
  position: absolute;
  opacity: 0;
  animation: fade 8s ease-in-out infinite 8s;
  z-index: 0;
  border: solid 2px transparent;
  transition: all .3s ease;
}
*/


.photo img:hover{
  border: solid 2px mintcream;
}

@keyframes fade{
  0%{
    opacity: 0; 
  }
  10%{
    opacity: 1;
  }
  50%{
    opacity: 1;
  }
  60%{
    opacity: 0;
  }
}








/*estilos para alerta msn*/


/*alineador de elementos*/
.contenedorX{
  height: 150vh;
  justify-content: center;
  align-items: center;
 
}
.hija{
  width: 150px;
  height: 150px;
  background-color: aqua;
}




</style>
@endsection
@section('content') 

  <!-- nuevo menu  -->

  
  <div class="contenedorX">

    <section class="header">
      <!--<h1 class="cabezah1">OAS 2.0 MENU</h1>-->
    </section>

    <div class="envoltura">
      <div class="envolver">
        <!--|
        <p class="descripcion">
         Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam repellendus veniam, pariatur delectus ratione expedita quas possimus, labore error laboriosam placeat. Natus iste, velit expedita ea dicta quam iure quos.
        </p>--->
        <h1 class="inicio">Inicio</h1>

      <!--partes de menu  iconos y mas-->
      @foreach(App\Modulo::get() as $mod)
        @if (Auth::user()->tieneModulo($mod->id))


             @foreach($mod->programs as $prog)
             @if(Auth::user()->authorizePermisos([$prog->nombre, 'Ver']) && !$prog->sub_modulo_id)
              @if ($mod->nombre=="Configuracion")
                      <a href="{{route($prog->route)}}">
                      <div class="btn-big red"> <i class="{{$prog->icon}} fa-2x" style="color: #ccc"></i><span class="label bottom"> {{$prog->nombre}} </span> </div>
                     </a>
              @endif
               @if ($mod->nombre=="Contabilidad")
                       <a href="{{route($prog->route)}}">
                      <div class="btn-big blue"> <i class="{{$prog->icon}} fa-2x" style="color: #ccc"></i><span class="label bottom"> {{$prog->nombre}} </span> </div>
                     </a>
              @endif
              @if ($mod->nombre=="RRHH")
              <a href="{{route($prog->route)}}">
             <div class="btn-big orange"> <i class="{{$prog->icon}} fa-2x" style="color: #ccc"></i><span class="label bottom"> {{$prog->nombre}} </span> </div>
            </a>
              @endif
              @if ($mod->nombre=="Sistemas")
              <a href="{{route($prog->route)}}">
             <div class="btn-big green animacion3"> <i class="{{$prog->icon}} fa-2x" style="color: #ccc"></i><span class="label bottom"> {{$prog->nombre}} </span> </div>
            </a>
              @endif
              @if ($mod->nombre=="Reportes Dualbiz")
              <a href="{{route($prog->route)}}">
              <div class="btn-big purple"> <i class="{{$prog->icon}} fa-2x" style="color: #ccc"></i><span class="label bottom"> {{$prog->nombre}} </span> </div>
              </a>
              @endif
              @if ($mod->nombre=="Inventarios")
              <a href="{{route($prog->route)}}">
              <div class="btn-big blue2"> <i class="{{$prog->icon}} fa-2x" style="color: #ccc"></i><span class="label bottom"> {{$prog->nombre}} </span> </div>
              </a>
              @endif
              @if ($mod->nombre=="Compras")
              <a href="{{route($prog->route)}}">
              <div class="btn-big stima"> <i class="{{$prog->icon}} fa-2x" style="color: #ccc"></i><span class="label bottom"> {{$prog->nombre}} </span> </div>
              </a>
              @endif

              
            @endif         
              
             @endforeach 
        @endif
      @endforeach
   
          <div class="btn-big red"> <i class="fab fa-ethereum fa-2x"></i> <span class="label bottom">item1</span> </div>
          <div class="btn-big blue"> <i class="fab fa-ethereum fa-2x"></i> <span class="label bottom">item2</span> </div>
          <div class="btn-big red"> <i class="fab fa-ethereum fa-2x"></i> <span class="label bottom">item1</span> </div>
          <div class="btn-big blue"> <i class="fab fa-ethereum fa-2x"></i> <span class="label bottom">item2</span> </div>
          <div class="btn-big red"> <i class="fab fa-ethereum fa-2x"></i> <span class="label bottom">item1</span> </div>
          <div class="btn-big blue"> <i class="fab fa-ethereum fa-2x"></i> <span class="label bottom">item2</span> </div>
          <div class="btn-big red"> <i class="fab fa-ethereum fa-2x"></i> <span class="label bottom">item1</span> </div>
          <div class="btn-big blue"> <i class="fab fa-ethereum fa-2x"></i> <span class="label bottom">item2</span> </div>
          
 
          
          
          
          <div class="btn-big gray"> <i class="fab fa-ethereum fa-2x"></i> <span class="label bottom">item3</span> </div>


      
  
      </div>
    </div>

  <!------para la parte superior------>
  
</div>
  



  <div class="container-fluid px-5"> 
    @foreach(App\Modulo::get() as $mod)
    <div class="my-4">
      @if(Auth::user()->tieneModulo($mod->id))
          <h4>
            @if($mod->icon)
           
            <i class="{{$mod->icon}}"></i>
            @else
            <i class="fab fa-ethereum"></i>
            @endif
            <span>{{$mod->nombre}}</span>
          </h4>
          <div class="row">
          @foreach($mod->programs as $prog)
            @if(Auth::user()->authorizePermisos([$prog->nombre, 'Ver']) && !$prog->sub_modulo_id)
            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 p-3">
              <a href="{{route($prog->route)}}">
                <div class="card">
                  <div class="card-body text-center">
  
                    <h5 class="card-title"><i class="{{$prog->icon}}" id="iconX"></i></h5>           
                    {{$prog->nombre}} 
                    
  
                  </div>
                </div> 
               
              </a>         
            </div>
            @endif
          @endforeach 
          </div>
          @foreach($mod->submodulos as $submod)
          @if(Auth::user()->tieneSubModulo($submod->id))
            <div class="row col my-2">
              <h5>
                <span>{{$submod->nombre}}</span>
              </h5>
            </div>
            <div class="row ">
              @foreach($submod->programs as $prog)
                @if(Auth::user()->authorizePermisos([$prog->nombre, 'Ver']) && $prog->sub_modulo_id)
                  <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 p-3">
                    <a href="{{route($prog->route)}}">
                      <div class="card" style="height:100%;">
                        <div class="card-body text-center">
                          <h5 class="card-title"><i class="{{$prog->icon}}"></i></h5>   
                          {{$prog->nombre}}        
                        </div>                        
                      </div>
                    </a>         
                  </div>
                @endif
              @endforeach 
            </div>
          @endif
          @endforeach                                                
      @endif
    </div>
    @endforeach
    </div>
  
  

  


  

 

@endsection


@section('mis_scripts')

@if (!Auth::user()->tienePermiso(31,17))
   @disabled(true) 
@else
@include('layouts.msnNoti')
@endif
@endsection
