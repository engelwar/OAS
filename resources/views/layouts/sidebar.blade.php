@section('mi_estilo')
<style>
    .Notiposition{
      margin-left: -22px;
    padding-right: 8px;
    margin-top: -1px;
    }
    *{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Montserrat', sans-serif;
}

body{
	background: #ececec;
}

.wrapper{
	
}

.notification_wrap{
	width: 500px;
	margin: 120px auto 0;
}

.notification_wrap .notification_icon{
	position: relative;
	width: 50px;
	height: 50px;
	font-size: 32px;
	margin: 0 auto;
	text-align: center;
	color: #605dff;
}

.notification_wrap .notification_icon .fa-bell{
	cursor: pointer;
}

.notification_wrap .dropdown{
	width: 350px;
	height: auto;
	background: #fff;
	border-radius: 5px;
	box-shadow: 2px 2px 3px rgba(0,0,0,0.125);
	margin: 15px auto 0;
	padding: 15px;
	position: relative;
	display: none;
}

.notification_wrap .dropdown .notify_item{
	display: flex;
	align-items: center;
	padding: 10px 0;
	border-bottom: 1px solid #dbdaff;
}

.notification_wrap .dropdown .notify_item:last-child{
	border-bottom: 0px;
}

.notification_wrap .dropdown .notify_item .notify_img{
	margin-right: 15px;
}

.notification_wrap .dropdown .notify_item .notify_info p{
	margin-bottom: 5px;
}

.notification_wrap .dropdown .notify_item .notify_info p span{
	color: #605dff;
	margin-left: 5px;
}

.notification_wrap .dropdown .notify_item .notify_info .notify_time{
	color: #c5c5e6;
	font-size: 12px;
}

.notification_wrap .dropdown:before{
	content: "";
	position: absolute;
	top: -30px;
	left: 50%;
	transform: translateX(-50%);
	border: 15px solid;
	border-color: transparent transparent #fff transparent;
}

.notification_wrap .dropdown.active{
	display: block;
}
</style>
@endsection
  <div id="control">
    <a id="show-sidebar" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <a href="{{ url('/') }}">
      <i class="fas fa-home"></i>
    </a>
    <a href="#" class="reload_page">
      <i class="fas fa-sync-alt"></i>
    </a>
    <a href="#" class="previous_page">
      <i class="fas fa-arrow-left"></i>
    </a>
  </div>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <div class="logo">
          <a href="{{ url('/') }}">
            <img src="{{asset('imagenes/logo.png')}}" height="40" alt="">
          </a>
          <button type="button" class="btn btn-primary position-relative">
            Inbox
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              3+
              <span class="visually-hidden">unread messages</span>
            </span>
          </button>
        </div>
        <div id="close-sidebar" class="text-primary @if($hide == 1) hide @endif">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-controls">
        <a href="{{ url('/') }}">
          <i class="fas fa-home"></i>
        </a>
        <a href="#" class="reload_page">
          <i class="fas fa-sync-alt"></i>
        </a>
        <a href="#" class="previous_page">
          <i class="fas fa-arrow-left"></i>
        </a>
      </div>
      @auth
      <div class="sidebar-header">
        <div class="user-pic">
          @if(Auth::user()->perfiles->foto != NULL)
          <img alt="foto" class="img-fluid img-rounded" src="{{ asset(Auth::user()->perfiles->foto) }}" />
          @else
          <img alt="foto" class="img-fluid img-rounded" src="{{asset('imagenes/log.jpg')}}" />
          @endif
        </div>
        <div class="user-info">
          <span class="user-name">
            {{ Auth::user()->perfiles->paterno.' '. Auth::user()->perfiles->materno}}
          </span>
          <span class="user-name">{{ Auth::user()->perfiles->nombre}}
          </span>
          <span class="user-role">{{Auth::user()->perfiles->cargo}}</span>
        </div>
      </div>
      @endauth

      <!-- sidebar-header  -->
      <div class="sidebar-menu">
        <ul>
          @auth
          @foreach(App\Modulo::orderBy('nombre')->get() as $mod)
          @if(Auth::user()->tieneModulo($mod->id))
          <li class="sidebar-dropdown mod @if($mod->programs_activ($mod)) active @endif">
            <a href="#">
              @if($mod->icon)
              <i class="{{$mod->icon}}"></i>
              @else
              <i class="fab fa-ethereum"></i>
              @endif
              <span>{{$mod->nombre}}</span>
            </a>
            <div class="sidebar-submenu mod" @if($mod->programs_activ($mod))style="display:block;"@endif>
              <ul>
                @foreach($mod->submodulos as $submod)
                @if(Auth::user()->tieneSubModulo($submod->id))
                <li class="sidebar-dropdown sub @if($submod->programs_activ($submod)) active @endif">
                  <a href="#">
                    <span>{{$submod->nombre}}</span>
                  </a>
                  <div class="sidebar-submenu sub" @if($submod->programs_activ($submod)) style="display:block;" @endif>
                    <ul>
                      @foreach($submod->programs as $prog)
                      @if(Auth::user()->authorizePermisos([$prog->nombre, 'Ver']) && $prog->sub_modulo_id)
                      <li class="route @if(Route::currentRouteName() == $prog->route) texto-luz @endif">
                        <a href="{{route($prog->route)}}" style="font">{{$prog->nombre}}
                        </a>
                      </li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                </li>
                @endif
                @endforeach
                @foreach($mod->programs as $prog)

                @if(Auth::user()->authorizePermisos([$prog->nombre, 'Ver']) && !$prog->sub_modulo_id)
                <li class="route @if(Route::currentRouteName() == $prog->route) texto-luz @endif">
                  <a href="{{route($prog->route)}}">{{$prog->nombre}}
                  </a>
                </li>
                @endif
                @endforeach
              </ul>
            </div>
          </li>
          @endif
          @endforeach
          @endauth
          <!--li>
            <a href="#">
              <i class="fa fa-book"></i>
              <span>Documentation</span>
            </a>
          </li-->
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    @auth
    <div class="sidebar-footer">
      <!--NOTIFICAIONES-->
      <a id="dropdown" class="dropup" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="notification_icon">
          <i class="fas fa-bell"></i>
          <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger Notiposition">

            
            
            <span class="visually-hidden">MENSAJE NO VISTO</span>
        </div>
       </span>

      {{-- 
        @if($count=Auth::user()->unreadNotifications->count())
        <span class="badge badge-pill badge-primary parpadea" id="contant">
          {{$count}}
        </span>
        @endif
      </a>

      <div class="dropdown-menu dropdown-menu-right justify-content-right" aria-labelledby="dropdownMenuLink">
        @if($count != 0)
        <div class="d-flex row">
          <form method="POST" action="{{action('NotificationsController@deleteall')}}">
            @csrf
            <button class="btn btn-light btn-xs">
              Eliminar Todo
            </button>
          </form>
        </div>
        @endif
        <div class="scroll">
          @if($count != 0)
          @foreach($auth=Auth::user()->unreadNotifications as $unreadNotification)
          <div class="d-flex row">
            <div class="d-flex col-9">
              <a class="dropdown-item" href="{{route('notifications.redirect',[ $unreadNotification->data['url'], $unreadNotification->data['solicitud_id'] ] )}}">
                {{$unreadNotification->data['text']}}
              </a>
            </div>
            <div class="col-3">
              <form id="notificaciones" method="POST" action="{{action('NotificationsController@read',$unreadNotification->id)}}" class="float-sm-right">
                @csrf
                <input name="_method" type="hidden" value="PATCH">
                <button class="btn btn-light btn-xs" data-toggle="tooltip" data-placement="top" title="Marcar como leido">
                  <i class="fas fa-times-circle"></i>
                </button>
              </form>
            </div>
          </div>
          @endforeach
          @endif
          <div class="dropdown-menu dropdown-menu-right ">
            <div class="scroll">
              @foreach($auth=Auth::user()->readNotifications as $readNotification)
              <div class="d-flex flex-column ">
                <div class="d-flex align-items-center">
                  <a class="dropdown-item" onclick="event.preventDefault();document.getElementById('notify_view_r').submit();">
                    {{$readNotification->data['text']}}
                  </a>
                  <form id="notify_view_r" method="GET" action="{{$readNotification->data['url']}}">
                    {{csrf_field()}}
                  </form>
                </div>
                <div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        --}}
        
          
          <!--END NOTIFICACIONES-->
      
          <a href="#">
            <i class="fa fa-cog"></i>
            <span class="badge-sonar"></span>
          </a>

          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off"></i>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
        @endauth

      

        

  </nav>
