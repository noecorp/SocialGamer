<div class="panel panel-default">
    <div class="panel-body">
        <div class="clearfix">
            @include('posts.include.post-info')
            @include('posts.include.menu')
        </div>
        <p class="">{{ $post->body }}</p>

        <hr style="margin-bottom: 15px;margin-top: 15px;">

        {{--<a style="margin-top:-10px;margin-bottom:15px" href="" class="btn btn-default btn-sm">Lubię to</a>--}}
        {{--<a style="margin-top:-10px;margin-bottom:15px" href="" class="btn btn-default btn-sm">Udostępnij</a>--}}
        {{--<a style="margin-top:-10px;margin-bottom:15px" href="" class="btn btn-default btn-sm">Skomentuj</a>--}}

        @if (Auth::check())
            @include('comments.create')
        @endif
    </div>
</div>