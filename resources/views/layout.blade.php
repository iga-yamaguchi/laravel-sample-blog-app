<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Sample Blog App</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script src="/js/app.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('index') }}">Laravel Sample Blog App</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">ABOUT<span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Service</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Member<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">AAA</a></li>
                            <li><a href="#">BBB</a></li>
                            <li><a href="#">CCC</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">DDD</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">EEE</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<div class="container">
    <main class="col-sm-8">
        @yield('content')
    </main>
    <aside class="col-sm-4">
        <ol class="list-group">
            @for($i = 2017; $i >= 2000; $i--)
                <li class="list-group-item">{{ $i }}</li>
            @endfor
        </ol>
        <ul class="list-inline">
            @foreach($tags as $tag)
                <li class=""><a href="{{ route('tag.show', $tag) }}"><span class="label label-default">{{ $tag->name }}</span></a></li>
            @endforeach
        </ul>
    </aside>
</div>
<footer>
    <div class="panel panel-default">
        <div class="panel-footer">copyright</div>
    </div>
</footer>
</body>
</html>
