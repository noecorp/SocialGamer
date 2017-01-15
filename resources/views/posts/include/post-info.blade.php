<div class="pull-left">
    {{--<img src="{{ url('user-avatar/' . $post->user->id . '/62') }}" alt="" class="img-responsive pull-left">--}}
    <img src="{{ avatar($post->user->id, '64') }}" width="62" alt="" class="img-responsive pull-left">
    <div style="margin-left: 10px;" class="post-info small pull-left">
        <p style="margin-bottom: 0px;">Dodany przez: <strong><a href="{{ url('/users/' . $post->user->id) }}">{{ $post->user->name }}</a></strong></p>
        @if( ($post->created_at->diffInDays(Carbon\Carbon::now()) < 1))
            <p class="small"><span style="margin-right: 5px" class="fa fa-clock-o"></span><a href="{{ url('/posts/' . $post->id) }}">{{ $post->created_at->diffForHumans() }} </a></p>
        @else
            @if($post->created_at->format('Y') == Carbon\Carbon::now()->format('Y'))
                <p class="small"><span style="margin-right: 5px" class="fa fa-clock-o"></span><a href="{{ url('/posts/' . $post->id) }}">{{ $post->created_at->formatLocalized('%d %B') }} o {{ $post->created_at->format('H:m') }}</a></p>
            @else
                <p class="small"><span style="margin-right: 5px" class="fa fa-clock-o"></span><a href="{{ url('/posts/' . $post->id) }}">{{ $post->created_at->formatLocalized('%d %B %Y') }} o {{ $post->created_at->format('H:m') }}</a></p>
            @endif
        @endif
    </div>
</div>