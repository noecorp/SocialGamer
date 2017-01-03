<div class="panel panel-default">
    <div class="panel-body">
        <div class="clearfix">
            @include('posts.include.post-info')
            @include('posts.include.menu')
        </div>
        <p class="">{{ $post->body }}</p>

        <hr style="margin-bottom: 15px;margin-top: 15px;">

        <div class="col-md-12" style="margin-bottom: 20px;">
            <div class="row">
                @if (Auth::check())
                    @include('comments.create')
                @endif
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                @foreach($post->comments as $comment)
                    @include('comments.show')
                @endforeach
            </div>
        </div>

    </div>
</div>