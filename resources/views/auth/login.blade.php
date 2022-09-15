@extends('layouts.base')

@section('content')
  <main class="login-form">
    <div class="cotainer">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card">
            <h3 class="card-header text-center">Вход или регистрация</h3>
            <div class="card-body">
              <span class="form-group mb-3">
                <input type="text" id="phone-mask" placeholder="+7 (" name="target" class="form-control" autocomplete="off" required autofocus>
                @if ($errors->has('phone'))
                  <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif

                @if ($errors->has('code'))
                  <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif

                @if (Session::has('success'))
                  <span class="text-danger">{{ Session::get('success') }}</span>
                @endif
              </div>

              <div class="d-grid mx-auto mb-3">
                <button type="button" class="btn btn-primary" id="sent_code_auth" {{--disabled="disabled"--}}>Продолжить</button>
              </div>

              <div class="modal fade" id="sendCodeAuth" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="codeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="codeModalLabel">Подтверждение</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="post" action="{{ route('auth.signup') }}" name="auth">
                      <div class="modal-body">
                        <input type="hidden" name="phone">
                        {{--@csrf--}}
                        <p class="response"></p>
                        <div class="mt-3">
                          <input type="text" class="form-control" placeholder="Code" name="code" required autocomplete="off">
                          <div class="mt-3 text-center timer" id="auth_timer_resend">
                            <span class="t">Отправить повторно через <span></span> сек.</span>
                            <button type="button" class="btn btn-link" id="resend_code_auth">Получить новый код</button>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        {{--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
                        <button type="button" class="btn btn-primary" id="sent_verified_code_auth">Подтвердить</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection