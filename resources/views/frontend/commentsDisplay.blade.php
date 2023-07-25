<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
@isset($comments)
@foreach($comments as $comment)

    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->comment }}</p>
 
        <a href="" id="reply"></a>
        <small class="float-right">
    <button title="Likes" id="saveLikeDislike" value="{{$comment->id}}"  data-type="like" data-id="{{$comment->id}}" data-like_sum="{{$comment->likes() }}" class=" lik mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold">
                   Like 
                   <span class="like-count" value="{{$comment->likes()}}" id="likes">{{ $comment->likes() }}</span>
               </button>
               <span title="Dislikes" id="saveLikeDislike" value="{{$comment->id}}"  data-type="dislike" data-id="{{ $comment->id}}" data-dislike_sum="{{$comment->dislikes() }}" class="dis mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold">
                   Dislike
                   <span class="dislike-count" id="dislikes">{{ $comment->dislikes() }}</span>
               </span>
             </small>
            
        <form method="post" action="{{route('comments.store')}}">
            @csrf
            <div class="form-group col-sm-4">
                <input type="text" name="comment" class="form-control col-sm-10" />
                @error('comment')<span class="text-red-700">{{$message}}  </span>@enderror
                <input type="hidden" name="product_id" value="{{$pro_id}}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group col-sm-6">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
     
        @include('frontend.commentsDisplay', ['comments' => $comment->replies])
      
    </div>
         
@endforeach
@endisset
