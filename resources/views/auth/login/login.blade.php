<x-guest-layout>
  <div style="min-height: 100vh; background-color: #ECF1F6;">
  <!-- ロゴ -->
  <div class="text-center pt-5">
    <img src="{{ asset('image/atlas-black.png') }}" alt="Atlasロゴ" style="width: 150px;">
  </div>

  <form action="{{ route('loginPost') }}" method="POST">
    <div class="w-100 d-flex py-5 align-items-center justify-content-center" style="background:#ECF1F6;">
      <div class="border w-25 p-4" style="background:#fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        <div class="w-75 m-auto pt-5" style="background:#fff; ">
          <label class="d-block m-0" style="font-size:13px;">メールアドレス</label>
          <div class="border-bottom border-primary w-100">
            <input type="text" class="w-100 border-0" name="mail_address">
          </div>
        </div>
        <div class="w-75 m-auto pt-5">
          <label class="d-block m-0" style="font-size:13px;">パスワード</label>
          <div class="border-bottom border-primary w-100">
            <input type="password" class="w-100 border-0" name="password">
          </div>
        </div>
        <div class="text-right m-3">
          <input type="submit" class="btn btn-primary" value="ログイン">
        </div>
        <div class="text-center">
          <a href="{{ route('registerView') }}">新規登録</a>
        </div>
      </div>
      {{ csrf_field() }}
    </div>
  </form>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
</x-guest-layout>
