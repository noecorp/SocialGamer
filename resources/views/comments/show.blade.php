
<div class="clearfix small" style="margin-top: 15px;">
    <img src="{{ url('user-avatar/' . $comment->user->id . '/36') }}" alt="" class="img-responsive pull-left">
    <div class="col-xs-10 col-sm-11">
        <div class="post-info pull-left" style="margin-top: -7px;">
            <p class="small" style="margin-bottom: 0px;"><strong><a href="{{ url('/users/' . $comment->user->id) }}">{{ $comment->user->name }}</a></strong> {{ $comment->body }}</p>
            <p class="small" style="margin-bottom: 0px;margin-top: -5px;"><span style="margin-right: 5px" class="fa fa-clock-o"></span><a href="">{{ $comment->created_at->diffForHumans() }}</a></p>
        </div>
    </div>

</div>
