@extends('two-column')
@section('main')
    @foreach($articles as $article)
        <div class="row">
            <div class="col-sm-12">
                <div class="thumbnail">
                    <a href="{{ route('article.show', $article) }}"><img src="{{ $article->absolute_image_path }}" alt="..."></a>
                    <div class="caption">
                        <a href="{{ route('article.show', $article) }}"><h3>{{ $article->title }}</h3></a>
                        @foreach($article->tags as $tag)
                            <a href="{{ route('tag.show', $tag) }}"><span class="label label-info">{{ $tag->name }}</span></a>
                        @endforeach
                        <p class="text-success">by <a href="{{ route('user.show', $article->user->user_id) }}">{{ $article->user->name }}</a></p>
                        <p class="text-primary">{{ $article->created_at }}</p>
                        <p class="lead">{{ $article->content }}</p>
                        <p class="text-right"><a href="{{ route('article.show', $article) }}" class="btn btn-default" role="button">More</a></p>

                        @if($article->user->is_same_auth_user)
                            <a href="{{ route('article.edit', $article) }}" type="button"
                               class="btn btn-primary">Edit</a>
                            {{ Form::model($article, ['route' => ['article.destroy', $article->id], 'method' => 'DELETE', 'class' => 'form-inline btn']) }}
                            <div class="form-group">
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            </div>
                            {{ Form::close() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
