<x-sidebar>
<p>ユーザー検索</p>
<div class="search_content">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person">
      <div>
        <span>ID : </span><span>{{ $user->id }}</span>
      </div>
      <div><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span>男</span>
        @elseif($user->sex == 2)
        <span>性別 : </span><span>女</span>
        @else
        <span>性別 : </span><span>その他</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span>権限 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span>権限 : </span><span>講師(英語)</span>
        @else
        <span>権限 : </span><span>生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
          <span>選択科目 :</span>
          @if($user->subjects->isNotEmpty())
            @foreach($user->subjects as $subject)
              <span style="font-size: 12px;">{{ $subject->subject }}</span>@if(!$loop->last)、@endif
            @endforeach
            @else
            <span>未選択</span>
          @endif
        @endif
      </div>
    </div>
    @endforeach
  </div>
  <div class="search_area" style="width:20%">
  <form action="{{ route('user.show') }}" method="get" id="userSearchRequest">
    <div class="">
      <div>
        <label>検索</label>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索">
      </div>
      <div class="category_area">
        <label>カテゴリ</label>
        <select name="category" class="narrow_select">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>

        <label>並び替え</label>
        <select name="updown" class="narrow_select">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="search_conditions_box">
        <p class="toggle_conditions">
          <span>検索条件の追加</span>
          <span class="arrow"></span>
        </p>
        <div class="toggle_conditions_inner">

            <label>性別</label>
            <div class="select_sex">
            <span>男</span><input type="radio" name="sex" value="1" >
            <span>女</span><input type="radio" name="sex" value="2" >
            <span>その他</span><input type="radio" name="sex" value="3" >
          </div>

          <div>
            <label>権限</label>
            <select name="role" class="engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer">
            <label>選択科目</label>
            <div class="subject_category">
            <br>
            @foreach($subjects as $subject)
              <label>
                {{ $subject->subject }}
                <input type="checkbox" name="subject_id[]" value="{{ $subject->id }}"
                  {{ is_array(request('subject_id')) && in_array($subject->id, request('subject_id')) ? 'checked' : '' }}>
              </label><br>
            @endforeach
            </div>
          </div>
        </div>
      </div>
      <div>
        <input type="submit" name="search_btn" value="検索">
      </div>
      <div>
        <input type="reset" value="リセット">
      </div>
    </div>
    </form>
  </div>
</div>

<script>
  document.querySelectorAll('.toggle_conditions').forEach(toggle => {
  toggle.addEventListener('click', function() {
    const parentBox = this.closest('.search_conditions_box');
    const arrow = this.querySelector('.arrow');
    if (parentBox) {
      parentBox.classList.toggle('open');
      if (arrow) arrow.classList.toggle('open');
    }
  });
});
</script>
</x-sidebar>
