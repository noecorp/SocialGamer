<div class="panel panel-default {{ $post->trashed() ? 'trashed' : "" }} ">
    <div class="panel-body">
        <div class="clearfix">
            @include('posts.include.post-info')
            @include('posts.include.menu')
        </div>
        <p class="">{{ $post->body }}</p>

        @include('posts.include.likes')


        <div class="col-md-12" style="margin-bottom: 15px;">
            <div class="row">
                @if (Auth::check())
                    <hr style="margin-bottom: 15px;margin-top: 15px;">
                    @include('comments.create')
                @endif
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">

                @if(count($post->comments) > 0)
                    <hr style="margin-bottom: 15px;margin-top: 0px;">
                @endif

                @foreach($post->comments as $comment)
                    @include('comments.show')
                @endforeach
            </div>
        </div>

    </div>
</div>