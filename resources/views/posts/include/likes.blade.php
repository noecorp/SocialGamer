@if(Auth::check())

    @if(isLiked('post_id', $post->id))
        <form method="POST" action="{{ url('/likes') }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-thumbs-up"></i> Odlajkuj {{ $post->likes()->count() }}</button>
        </form>
    @else
        <form method="POST" action="{{ url('/likes') }}">
            {{ csrf_field() }}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-thumbs-up"></i> Zalajkuj {{ $post->likes()->count() }}</button>
        </form>
    @endif

{{--@foreach($post->likes as $like)--}}
    {{--{{ $like->user->name }}--}}
{{--@endforeach--}}

@else

    <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-up"></i> Zalajkuj {{ $post->likes()->count() }}</button>

@endif