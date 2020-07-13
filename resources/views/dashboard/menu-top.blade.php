<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"> 
            <img src="/images/huem/LogoHUEM.png" alt="logo-huem" class="logo-huem" /> 
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img src="/images/huem/LogoHUEM.png" alt="logo-huem" class="logo-huem" /> 
            <b>{{ config('app.name', 'HuemApp') }}</b>
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" id="sidebar-toggle" class="sidebar-toggle fas fa-bars" data-toggle="push-menu" role="button">
        <!-- <i class="fas fa-bars"></i> -->
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fas fa-envelope"></i>
            <span class="label label-success hidden">4</span>
            </a>
            <ul class="dropdown-menu hidden">
            <li class="header">You have 4 messages</li>
            <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <li><!-- start message -->
                    <a href="#">
                    <div class="pull-left">
                        <img src="/images/admin-lte/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                        Support Team
                        <small><i class="fas fa-clock"></i> 5 mins</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                <!-- end message -->
                <li>
                    <a href="#">
                    <div class="pull-left">
                        <img src="/images/admin-lte/user3-128x128.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                        AdminLTE Design Team
                        <small><i class="fas fa-clock"></i> 2 hours</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <div class="pull-left">
                        <img src="/images/admin-lte/user4-128x128.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                        Developers
                        <small><i class="fas fa-clock"></i> Today</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <div class="pull-left">
                        <img src="/images/admin-lte/user3-128x128.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                        Sales Department
                        <small><i class="fas fa-clock"></i> Yesterday</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <div class="pull-left">
                        <img src="/images/admin-lte/user4-128x128.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                        Reviewers
                        <small><i class="fas fa-clock"></i> 2 days</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                </ul>
            </li>
            <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
        </li>
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fas fa-bell"></i>
            <span class="label label-warning hidden">10</span>
            </a>
            <ul class="dropdown-menu hidden">
            <li class="header">You have 10 notifications</li>
            <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <li>
                    <a href="#">
                    <i class="fas fa-users text-aqua"></i> 5 new members joined today
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fas fa-exclamation-triangle text-yellow"></i> Very long description here that may not fit into the
                    page and may cause design problems
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                </li>
                </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
            </ul>
        </li>
        <!-- Tasks: style can be found in dropdown.less -->
        <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fas fa-flag"></i>
            <span class="label label-danger hidden">9</span>
            </a>
            <ul class="dropdown-menu hidden">
            <li class="header">You have 9 tasks</li>
            <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <li><!-- Task item -->
                    <a href="#">
                    <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                    </h3>
                    <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">20% Complete</span>
                        </div>
                    </div>
                    </a>
                </li>
                <!-- end task item -->
                <li><!-- Task item -->
                    <a href="#">
                    <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                    </h3>
                    <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">40% Complete</span>
                        </div>
                    </div>
                    </a>
                </li>
                <!-- end task item -->
                <li><!-- Task item -->
                    <a href="#">
                    <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                    </h3>
                    <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">60% Complete</span>
                        </div>
                    </div>
                    </a>
                </li>
                <!-- end task item -->
                <li><!-- Task item -->
                    <a href="#">
                    <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                    </h3>
                    <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">80% Complete</span>
                        </div>
                    </div>
                    </a>
                </li>
                <!-- end task item -->
                </ul>
            </li>
            <li class="footer">
                <a href="#">View all tasks</a>
            </li>
            </ul>
        </li>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ Auth::user()->image_profile }}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ Auth::user()->empleado->nombreCorto() }}</span>
            </a>
            <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                <img src="/images/admin-lte/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                {{ Auth::user()->empleado->nombreCorto() }} - {{ Auth::user()->empleado->cargo }}
                <small class="hidden">Member since Nov. 2012</small>
                </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body hidden">
                <div class="row">
                <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                </div>
                </div>
                <!-- /.row -->
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-left">
                    <a href="/perfil" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat" v-on:click="logout">Salir</a>
                </div>
            </li>
            </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
            <a href="#" data-toggle="control-sidebar"><i class="fas fa-cogs"></i></a>
        </li>
        </ul>
    </div>
    </nav>
</header>