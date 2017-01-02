<div class="pull-left">
    <img src="{{ url('user-avatar/' . $post->user->id . '/36') }}" alt="" class="img-responsive pull-left">
    <div style="margin-left: 10px;" class="post-info small pull-left">
        <p style="margin-bottom: 0px;">Dodany przez: <strong><a href="{{ url('/users/' . $post->user->id) }}">{{ $post->user->name }}</a></strong></p>
        <p><span style="margin-right: 5px" class="fa fa-clock-o"></span><a href="{{ url('/posts/' . $post->id) }}">{{ $post->updated_at->diffForHumans() }}</a></p>
    </div>
</div>