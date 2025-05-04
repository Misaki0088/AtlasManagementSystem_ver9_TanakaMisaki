<x-sidebar>
<form action="{{ route('post.create') }}" method="post" id="postCreate">
@csrf  <!-- CSRFトークン -->

<div class="post_create_container d-flex">
  <div class="post_create_area border w-50 m-5 p-5">
    <div class="">

      <p class="mb-0">カテゴリー</p>
      @if($errors->first('main_category_id'))
        <span class="error_message">{{ $errors->first('main_category_id') }}</span>
      @endif
      <select class="w-100" name="sub_category_id" form="postCreate">
        @foreach($main_categories as $main_category)
        <optgroup label="{{ $main_category->main_category }}">
          <!-- サブカテゴリー表示 -->
          @foreach($main_category->subCategories as $sub_category)
              <option value="{{ $sub_category->id }}">{{ $sub_category->sub_category }}</option>
          @endforeach
        </optgroup>
        @endforeach
      </select>
    </div>

    <div class="mt-3">
      @if($errors->first('post_title'))
      <span class="error_message">{{ $errors->first('post_title') }}</span>
      @endif
      <p class="mb-0">タイトル</p>
      <input type="text" class="w-100" name="post_title" value="{{ old('post_title') }}" form="postCreate">
    </div>

    <div class="mt-3">
      @if($errors->first('post_body'))
      <span class="error_message">{{ $errors->first('post_body') }}</span>
      @endif
      <p class="mb-0">投稿内容</p>
      <textarea class="w-100" name="post_body" form="postCreate">{{ old('post_body') }}</textarea>
    </div>
    <div class="mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="投稿">
    </div>
  </div>
</div>
</form>

  @can('admin')
  <div class="w-25 ml-auto mr-auto">
    <div class="category_area mt-5 p-5">
    <form action="{{ route('main.category.create') }}" method="post" id="mainCategoryRequest">
      <div class="">
        <p class="m-0">メインカテゴリー</p>
        <input type="text" class="w-100" name="main_category_name" form="mainCategoryRequest">
        @if ($errors->has('main_category_name'))
          <div class="error_message" style="color:red;">
            {{ $errors->first('main_category_name') }}
          </div>
        @endif
        <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="mainCategoryRequest">
      </div>
    </form>

        <!-- サブカテゴリー追加 -->
      <form action="{{ route('sub.category.create') }}" method="post" id="subCategoryRequest">
          {{ csrf_field() }}
        <div class="mt-4">
          <p class="m-0">サブカテゴリー</p>

          <!-- 紐づけるメインカテゴリー選択 -->
          <select class="w-100" name="main_category_id" form="subCategoryRequest">
            @foreach($main_categories as $main_category)
              <option value="{{ $main_category->id }}">{{ $main_category->main_category }}</option>
            @endforeach
          </select>

          <input type="text" class="w-100" name="sub_category_name" form="subCategoryRequest">
          @if ($errors->has('sub_category_name'))
            <div class="error_message" style="color:red;">
              {{ $errors->first('sub_category_name') }}
            </div>
          @endif
          <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="subCategoryRequest">
        </div>
      </form>
    </div>
  </div>
  @endcan
</x-sidebar>
