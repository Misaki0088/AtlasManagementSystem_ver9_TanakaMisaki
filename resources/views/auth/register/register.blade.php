<x-guest-layout>
  <div style="min-height: 100vh; background-color: #ECF1F6;">
  <form action="{{ route('registerPost') }}" method="POST">
    @csrf
    <div class="w-100 d-flex" style="padding: 40px 0; align-items:center; justify-content:center;">
      <div class="w-25 border"style="background:#fff; padding: 8px 16px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

      {{-- 姓・名 --}}
        <div class="register_form">
          <div class="d-flex justify-content-between" style="justify-content:space-between">
            <div class="w-50 pr-2">
              @error('over_name')
              <div class="text-danger" style="font-size:12px;">{{ $message }}</div>
              @enderror
              <label class="d-block m-0" style="font-size:13px">姓</label>
              <div class="border-bottom border-primary">
                <input type="text" class="over_name w-100 border-0" name="over_name">
              </div>
            </div>
            <div class="w-50 pl-2">
              @error('under_name')
              <div class="text-danger" style="font-size:12px;">{{ $message }}</div>
              @enderror
              <label class=" d-block m-0" style="font-size:13px">名</label>
              <div class="border-bottom border-primary">
                <input type="text" class="under_name w-100 border-0" name="under_name">
              </div>
            </div>
          </div>

          {{-- カナ --}}
          <div class="d-flex mt-2" style="justify-content:space-between pt-2">
            <div class="w-50 pr-2">
              @error('over_name_kana')
              <div class="text-danger" style="font-size:12px;">{{ $message }}</div>
              @enderror
              <label class="d-block m-0" style="font-size:13px">セイ</label>
              <div class="border-bottom border-primary">
                <input type="text" class="over_name_kana w-100 border-0" name="over_name_kana">
              </div>
            </div>
            <div class="w-50 pl-2">
              @error('under_name_kana')
              <div class="text-danger" style="font-size:12px;">{{ $message }}</div>
              @enderror
              <label class="d-block m-0" style="font-size:13px">メイ</label>
              <div class="border-bottom border-primary">
                <input type="text" class="under_name_kana w-100 border-0" name="under_name_kana">
              </div>
            </div>
          </div>

          {{-- メールアドレス --}}
          <div style="margin-top: 12px;">
            @error('mail_address')
            <div class="text-danger" style="font-size: 12px;">{{ $message }}</div>
            @enderror
            <label class="m-0 d-block" style="font-size:13px">メールアドレス</label>
            <div class="border-bottom border-primary">
              <input type="e-mail" class="mail_address w-100 border-0" name="mail_address">
            </div>
          </div>

          {{-- 性別 --}}
          <div class="pt-2">
            @error('sex')
            <div class="text-danger" style="font-size:12px;">{{ $message }}</div>
            @enderror
            <label class="d-block m-0" style="font-size:13px;">性別</label>
            </div>
              <input type="radio" class="sex" name="sex" value="1"> 男性
              <input type="radio" class="sex" name="sex" value="2"> 女性
              <input type="radio" class="sex" name="sex" value="3"> その他
          </div>

          {{-- 生年月日 --}}
          <div class="pt-2">
          @error('birthdate')
          <div class="text-danger" style="font-size:12px;">{{ $message }}</div>
          @enderror
          <label class="d-block m-0 aa" style="font-size:13px">生年月日</label>
          <select class="old_year" name="old_year">
            <option value="none">-----</option>
            <option value="1985">1985</option>
            <option value="1986">1986</option>
            <option value="1987">1987</option>
            <option value="1988">1988</option>
            <option value="1989">1989</option>
            <option value="1990">1990</option>
            <option value="1991">1991</option>
            <option value="1992">1992</option>
            <option value="1993">1993</option>
            <option value="1994">1994</option>
            <option value="1995">1995</option>
            <option value="1996">1996</option>
            <option value="1997">1997</option>
            <option value="1998">1998</option>
            <option value="1999">1999</option>
            <option value="2000">2000</option>
            <option value="2001">2001</option>
            <option value="2002">2002</option>
            <option value="2003">2003</option>
            <option value="2004">2004</option>
            <option value="2005">2005</option>
            <option value="2006">2006</option>
            <option value="2007">2007</option>
            <option value="2008">2008</option>
            <option value="2009">2009</option>
            <option value="2010">2010</option>
          </select>
          <label style="font-size:13px">年</label>
          <select class="old_month" name="old_month">
            <option value="none">-----</option>
            <option value="01">1</option>
            <option value="02">2</option>
            <option value="03">3</option>
            <option value="04">4</option>
            <option value="05">5</option>
            <option value="06">6</option>
            <option value="07">7</option>
            <option value="08">8</option>
            <option value="09">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
          </select>
          <label style="font-size:13px">月</label>
          <select class="old_day" name="old_day">
            <option value="none">-----</option>
            <option value="01">1</option>
            <option value="02">2</option>
            <option value="03">3</option>
            <option value="04">4</option>
            <option value="05">5</option>
            <option value="06">6</option>
            <option value="07">7</option>
            <option value="08">8</option>
            <option value="09">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
          </select>
          <label style="font-size:13px">日</label>
        </div>

        {{-- 役職 --}}
        <div class="pt-2">
          @error('role')
          <div class="text-danger" style="font-size:12px;">{{ $message }}</div>
            @enderror
            <label class="d-block m-0" style="font-size:13px">役職</label>
            <div>
              <input type="radio" class="role admin_role" name="role" value="1" id="role1">
              <label for="role1" style="font-size:11px;">教師(国語)</label>

              <input type="radio" class="role admin_role" name="role" value="2" id="role2">
              <label for="role2" style="font-size:11px;">教師(数学)</label>

              <input type="radio" class="role admin_role" name="role" value="3" id="role3">
              <label for="role3" style="font-size:11px;">教師(英語)</label>

              <input type="radio" class="role other_role" name="role" value="4" id="role4">
              <label for="role4" style="font-size:11px;">生徒</label>
            </div>
          </div>

        {{-- 選択科目 --}}
        <div class="select_teacher d-none pt-2">
          @error('subject')
          <div class="text-danger" style="font-size:12px;">{{ $message }}</div>
          @enderror
          <label class="d-block m-0" style="font-size:13px">選択科目</label>
          @foreach($subjects as $subject)
          <div class="" >
            <input type="checkbox" name="subject[]" value="{{ $subject->id }}">
            <label>{{ $subject->subject }}</label>
          </div>
          @endforeach
        </div>

        {{-- パスワード --}}
        <div class="pt-1">
          @error('password')
          <div class="text-danger" style="font-size:12px;">{{ $message }}</div>
          @enderror
          <label class="d-block m-0" style="font-size:13px">パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="password w-100 border-0" name="password">
          </div>
        </div>

        {{-- 確認用パスワード --}}
        <div class="pt-1">
          @error('password_confirmation')
          <div class="text-danger" style="font-size:12px;">{{ $message }}</div>
          @enderror
          <label class="d-block m-0" style="font-size:13px">確認用パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="password_confirmation w-100 border-0" name="password_confirmation">
          </div>
        </div>

        {{-- 登録ボタン --}}
        <div class="text-right mt-2">
          <input type="submit" class="btn btn-primary register_btn" disabled value="新規登録" onclick="return confirm('登録してよろしいですか？')">
        </div>
        <div class="text-center mt-2">
          <a href="{{ route('loginView') }}">ログイン</a>
        </div>
      </div>
    </div>
  </form>
  </div>
  <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error}}</li>
            @endforeach
        </ul>
    </div>
  @endif -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}"></script>
</x-guest-layout>
