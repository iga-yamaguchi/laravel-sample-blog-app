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
                <a class="navbar-brand" href="#">Laravel Sample Blog App</a>
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
        @foreach($articles as $article)
            <div class="row">
                <div class="col-sm-12">
                    <div class="thumbnail">
                        <img src="{{ $article->image_path }}" alt="...">
                        <div class="caption">
                            <h3>{{ $article->title }}</h3>
                            @foreach($article->tags as $tag)
                                <a href="#"><span class="label label-info">{{ $tag->name }}</span></a>
                            @endforeach
                            <p>{{ $article->content }}</p>
                            <p class="text-right"><a href="#" class="btn btn-default" role="button">More</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
    <aside class="col-sm-4">
        <ol class="list-group">
            @for($i = 2017; $i >= 2000; $i--)
                <li class="list-group-item">{{ $i }}</li>
            @endfor
        </ol>
        <ul class="list-inline">
            <li class=""><a href="#"><span class="label label-default">Aaaaaaa</span></a></li>
            <li class=""><a href="#"><span class="label label-default">Aaaaaaa</span></a></li>
            <li class=""><a href="#"><span class="label label-default">Aaaaaaa</span></a></li>
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