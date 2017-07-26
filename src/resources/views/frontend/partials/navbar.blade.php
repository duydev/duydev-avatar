<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            @if( auth()->check() )
                <a href="">Xin chào, {{ auth()->user()->name }}</a>
                <a href="">Đăng xuất</a>
            @else
                <a href="{{ route('fblogin') }}" class="btn btn-primary">Đăng nhập FB</a>
            @endif
        </div><!--/.navbar-collapse -->
    </div>
</nav>
