<div class="panel panel-default">
    <div class="panel-body">

        <div class="clearfix">
            @include('posts.include.post-info')
            @include('posts.include.menu')
        </div>
        <p class="">{{ $post->body }}</p>
    </div>
</div>