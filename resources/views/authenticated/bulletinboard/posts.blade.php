<x-sidebar>
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>

      <!-- 自分の投稿だけ編集・削除ボタン表示 -->
      @if($post->user_id === Auth::id())
      <div class="mt-2">
        <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="btn btn-sm btn-primary">編集</a>
        <form action="{{ route('post.delete', ['id' => $post->id]) }}" method="GET" style="display:inline;">
            <button type="submit" class="btn btn-sm btn-danger">削除</button>
        </form>
      </div>
      <div class="mb-2">
      <!-- 編集ボタン（投稿詳細ページへ） -->
      <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="btn btn-sm btn-outline-primary">編集</a>

      <!-- 削除ボタン（モーダルで確認） -->
      <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteModal-{{ $post->id }}">
        削除
      </button>

      <!-- 削除モーダル -->
      <div class="modal fade" id="deleteModal-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">削除の確認</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              「{{ $post->post_title }}」を本当に削除しますか？
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
              <a href="{{ route('post.delete', ['id' => $post->id]) }}" class="btn btn-danger">削除する</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class=""></span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}"></span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}"></span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25">
    <div class="border m-4">
      <div class=""><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="">
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input type="submit" value="検索" form="postSearchRequest">
      </div>
      <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest">
      <ul>
        @foreach($categories as $category)
        <li class="main_categories" category_id="{{ $category->id }}"><span>{{ $category->main_category }}<span></li>
        @endforeach
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
</x-sidebar>
