<x-sidebar>
<div class="comment_detail_container">
<div class="vh-100 d-flex">
  <div class="w-50 mt-5">
    <div class="detail_container">
      <div class="">
        <div class="detail_inner_head">
          <div>
          </div>
          <div>
            @if($post->user_id === Auth::id())
            <button type="button" class="btn btn-primary edit-modal-open"
              post_title="{{ $post->post_title }}"
              post_body="{{ $post->post }}"
              post_id="{{ $post->id }}">
              編集
            </button>
            <!-- 削除ボタン（モーダルで確認） -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">削除</button>
            @endif
          </div>
          <!-- 削除確認モーダル -->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">削除の確認</h5>
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
        </div>

        <div class="contributor">
          @foreach($post->subCategories as $category)
        <p class="sub_category_names">{{ $category->sub_category }}</p>
          @endforeach
          <p class="post_user_name">
            <span>{{ $post->user->over_name }}</span>
            <span>{{ $post->user->under_name }}</span>
            さん
          </p>
          <span class="">{{ $post->created_at }}</span>
        </div>
        @error('post_title')
          <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="detsail_post_title">{{ $post->post_title }}</div>
        <div class="detsail_post">{{ $post->post }}</div>
          <div class="comment_group">
            <span class="comment_title">コメント</span>
            @foreach($post->postComments as $comment)
            <div class="comment_area" style="border-top:1px solid #ccc;">
              <p>
                <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
                <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
              </p>
            <p>{{ $comment->comment }}</p>
          </div>
          @endforeach
          </div>
        </div>
      </div>
    </div>
  <div class="w-50">
    <div class="comment_area_container">
      <div class="comment_area">
        <p class="m-0">コメントする</p>
        @error('comment')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <textarea class="w-100" name="comment" form="commentRequest"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
        <input type="submit" class="comment_btn  btn btn-primary" form="commentRequest" value="投稿">
        <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
      </div>
    </div>
  </div>
</div>
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('post.edit') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-100">
          <input type="text" name="post_title" placeholder="タイトル" class="w-100" style="border: 1px solid #ccc;">
        </div>
        <div class="modal-inner-body w-100">
          <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
            @error('post_body')
              <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <input type="submit" class="btn btn-primary d-block" value="編集">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</x-sidebar>
