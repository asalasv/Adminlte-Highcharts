<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('/img/dashboard-1.jpg')}}" class="img-thumbnail" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->username }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu ">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>Home</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-line-chart'></i> <span>Estadisticas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('lastweekreg') }}">Registros Ult Semama</a></li>
                    <li><a href="{{ url('newlastweekreg') }}">Registros Nuevos Ult Semana</a></li>
                    <li><a href="{{ url('connectlastweek') }}">Conexiones al Portal Ult Semana</a></li>
                    <li><a href="{{ url('portalhookuserreg') }}">Reg. Usuarios PortalHook</a></li>
                    <li><a href="{{ url('sexportalhookuserreg') }}">Reg. Usrs. PortalHook por Genero</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-gear'></i> <span>Configuracion</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class='fa fa-desktop'></i> <span>Portal</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#">Imagen de publicidad</a></li>
                            <li><a href="#">Imagen de logo</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class='fa fa-wifi'></i> <span>Wifi</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#">Bloq. de disp. por MAC</a></li>
                            <li><a href="#">Bloq. de categorias de internet</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
