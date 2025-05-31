<x-sidebar>
<div class="board_area w-100 m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto"></p>
    @foreach($posts as $post)
    <div class="post_area border p-3" style="width: 80%; margin-left:25px">
      @foreach($post->subCategories as $category)
        <p class="sub_category_names">{{ $category->sub_category }}</p>
      @endforeach
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="">{{ $post->postComments->count() }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0">
              <i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i>
              <span class="like_counts{{ $post->id }}">{{ $post->likes->count() }}</span>
            </p>
            @else
            <p class="m-0">
              <i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i>
              <span class="like_counts{{ $post->id }}">{{ $post->likes->count() }}</span>
            </p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area w-25">
    <div class="post_like_search_box">
      <div class="Submit_button"><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="Search_box">
        <input type="text" class="Search_form" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input type="submit" class="Search_button" value="検索" form="postSearchRequest">
      </div>
      <div class="filter-buttons">
      <input type="submit" name="like_posts" class="liked-btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="my-posts-btn" value="自分の投稿" form="postSearchRequest">
      </div>
      <ul>
        <p class="categories_search">カテゴリー検索</p>
        @foreach($categories as $category)
        <li class="main_categories" category_id="{{ $category->id }}">
          <span>{{ $category->main_category }}</span>
          <ul class="ml-3">
          @foreach($category->subCategories as $sub)
          <li>
          <form action="{{ route('post.show') }}" method="get">
            <input type="hidden" name="category_word" value="{{ $sub->id }}"> {{-- ← IDに変更！ --}}
            <button type="submit" class="btn btn-link p-0">{{ $sub->sub_category }}</button>
          </form>
          </li>
          @endforeach
          </ul>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</x-sidebar>
