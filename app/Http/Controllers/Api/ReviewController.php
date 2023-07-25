<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\BlogComment;

class ReviewController extends Controller
{
    public function ReviewStore(Request $request)
    {
        $data=[
            'product_id'=>$request->product_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'title'=>$request->title,
            'description'=>$request->description,
        ];
        $insert = Review::insert($data);
        if($insert)
        {
            return [
                'message' => 'Thanks For Your Review'
            ];
        }
      
    }
       public function bogCommentsSave(Request $request)
    {
        
        $request->validate([
            'comment'=>'required',
        ]);
        // if(auth()->user()){
        $input=[
            // 'user_id'=>auth()->user()->id,
            'user_id'=>$request->user_id,
           'blog_id'=>$request->blog_id,
            'parent_id'=>$request->parent_id,
            'comment'=>$request->comment,
        ];
       $create= BlogComment::create($input);
       if($create){
        $message='Comment Added Succesfully';
        return response()->json(['mesage'=>$message],200);
       }else{
        $message='Please Login First';
        return response()->json(['mesage'=>$message], 401);
       }

    // }else{
    //     alert::success('Please Login First');
    //     return redirect()->back();
    // }
    }
    function blogsave_likedislike(Request $request){
                 $LikeDislike= BlogLikeDislike::where('user_id', $request->user_id)->where('comment_id',$request->id)->first();
         if($LikeDislike){
             return response()->json([
                'Warning'=>'you have once add your reaction',
            ]);
         }else{
        $data=new BlogLikeDislike;
        $data->comment_id=$request->id;

        if($request->type=='like'){
            $data->like=1;
        }else{
            $data->dislike=1;
        }
        $data->save();
        $likes=BlogLikeDislike::select('like')->sum('like');
        $dislikes=BlogLikeDislike::select('dislike')->sum('dislike');
        return response()->json([
            'likes'=>$likes,
            'dislikes'=>$dislikes,
        ]);
         }
    }
}
