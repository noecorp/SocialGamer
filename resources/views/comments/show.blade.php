
<div class="clearfix">
    <img src="{{ url('user-avatar/' . $comment->user->id . '/36') }}" alt="" class="img-responsive pull-left">
    <div style="margin-left: 10px;" class="post-info small pull-left">
        <p style="margin-bottom: 0px;"><strong><a href="{{ url('/users/' . $comment->user->id) }}">{{ $comment->user->name }}</a></strong> {{ $comment->body }}</p>
        <p><span style="margin-right: 5px" class="fa fa-clock-o"></span><a href="">{{ $comment->created_at->diffForHumans() }}</a></p>
    </div>
</div>
