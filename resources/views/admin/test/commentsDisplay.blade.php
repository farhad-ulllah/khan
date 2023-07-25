@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->comment }}</p>
        <a href="" id="reply"></a>
        <form method="post" action="{{route('comments.store')}}">
            @csrf
            <div class="form-group">
                <input type="text" name="comment" class="form-control" />
                @error('comment')<span class="text-red-700">{{$message}}  </span>@enderror
                <input type="hidden" name="product_id" value="{{$pro_id}}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
        @include('admin.test.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach