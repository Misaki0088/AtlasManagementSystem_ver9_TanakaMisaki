<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use Illuminate\Validation\Validator;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Requests\CommentRequest;

use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        $posts = Post::with('user', 'postComments', 'likes')->get();
        $categories = MainCategory::get();
        $like = new Like;
        $post_comment = new Post;
        if(!empty($request->keyword)){
            // 入力キーワードと完全一致するサブカテゴリーがあるか探す
            $matchedSubCategory = SubCategory::where('sub_category', $request->keyword)->first();

        if ($matchedSubCategory) {
        // 一致したら、そのサブカテゴリーに紐づく投稿だけ取得
        $posts = $matchedSubCategory->posts()->with('user', 'postComments', 'likes')->get();}
        else {
        // なければ通常のキーワード検索（タイトル・本文）
        $posts = Post::with('user', 'postComments', 'likes')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhere('post', 'like', '%'.$request->keyword.'%')
            ->get();
        }

        }else if($request->category_word){
            $sub_category = $request->category_word;
            $matchedSubCategory = SubCategory::where('id', $request->category_word)->first();
            if ($matchedSubCategory) {
                // サブカテゴリーに紐づく投稿のみを取得
                $posts = $matchedSubCategory->posts()->with('user', 'postComments', 'likes')->get();
            } else {
                // 万が一一致しなければ全件取得（または空でもOK）
                $posts = collect();
            }
        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
        $main_categories = MainCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
    }

    public function postCreate(PostFormRequest $request){
        // dd($request->all());
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body,
            'sub_category_id' => $request->sub_category_id,
        ]);

        $post->subCategories()->attach($request->sub_category_id);

        return redirect()->route('post.show');
    }

    public function postEdit(PostFormRequest $request){
        // バリデーション成功後にpostを更新で問題なければpost_title と post_body を使ってDBのレコードを更新
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }
    public function mainCategoryCreate(MainCategoryRequest $request){
        MainCategory::create(['main_category' => $request->main_category_name]);
        // dd(MainCategory::all());
        return redirect()->route('post.input');
    }

    public function subCategoryCreate(SubCategoryRequest $request){
        // サブカテゴリー作成
        SubCategory::create([
            'main_category_id' => $request->main_category_id,
            'sub_category' => $request->sub_category_name,
        ]);

        return redirect()->route('post.input');
    }

    public function commentCreate(CommentRequest $request){
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        $categories = MainCategory::with('subCategories')->get();
        // dd($posts);
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like', 'categories'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::where('like_user_id', Auth::id())->pluck('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        $categories = MainCategory::with('subCategories')->get();
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like', 'categories'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
            ->where('like_post_id', $post_id)
            ->delete();

        return response()->json();
    }


}
