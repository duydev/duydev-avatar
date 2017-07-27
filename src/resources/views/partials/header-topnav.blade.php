<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{ url('/') }}" class="navbar-brand"><b>{{ config('app.name') }}</b></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ Route::is('create_frame') ? 'active' : '' }}"><a href="{{ route('create_frame') }}">Thêm khung</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    @if( auth()->check() )
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ auth()->user()->avatar() }}" class="user-image" alt="Avatar của {{ auth()->user()->name }}">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Menu Footer-->
                            <li>
                                <a href="#" class="btn btn-default btn-flat">Khung đã tạo</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();" class="btn btn-default btn-flat">Đăng xuất</a>
                                {{ Form::open(['route'=>'logout','class'=>'hidden','id'=>'form-logout']) }}
                                {{ Form::close() }}
                            </li>
                        </ul>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-facebook-official"></i> Đăng Nhập</a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>