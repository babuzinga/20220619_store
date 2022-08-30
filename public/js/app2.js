let xhr = new XMLHttpRequest();



// ================================================================================================================== //
let sendCodeAuthBlock = document.getElementById("sendCodeAuth");
if (sendCodeAuthBlock) {
  let sendCodeAuth = new bootstrap.Modal(sendCodeAuthBlock, {}), target, phone, token, code, response;
  let authTimerResend = document.getElementById("auth_timer_resend"), authTimerId;

  document.getElementById('sent_code_auth').onclick = function() { sentCode('SENT_CODE'); };
  document.getElementById('resend_code_auth').onclick = function() { sentCode('SENT_CODE'); };
  document.getElementById('sent_verified_code_auth').onclick = function() { sentCode('VERIFIED_CODE'); };

  function sentCode(action) {
    if (sendCodeAuth) {
      target = document.querySelector('[name="target"]');
      if (!target.value) return false;

      phone = document.querySelector('[name="phone"]');
      token = document.querySelector('[name="_token"]');
      code = document.querySelector('[name="code"]');

      let post, url;
      switch (action) {
        case 'SENT_CODE':
          post = JSON.stringify({ action: action, _token: token.value, phone: target.value });
          url = "/code/login";
          break;
        case 'VERIFIED_CODE':
          post = JSON.stringify({ action: action, _token: token.value, phone: target.value, code: code.value });
          url = "/check/login";
          break;
      }

      if (post && url) {
        xhr.open('POST', url, true)
        xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
        xhr.send(post);

        xhr.onload = function () {
          if (xhr.status === 200) {
            let json = JSON.parse(xhr.response);
            console.log(json);
            if (json.r && json.r == 'send' && json.t) {
              sendCodeAuthBlock.querySelector('.response').textContent = json.t;
              phone.value = target.value;
              if (authTimerResend) { clearInterval(authTimerId); timer(authTimerResend, 60); }
            } else if (json.r && json.r == 'error' && json.t) {
              sendCodeAuthBlock.querySelector('.response').textContent = json.t;
            } else if (json.r && json.r == 'success') {
              document.querySelector('[name="auth"]').submit();
            }

            code.value = '';
            sendCodeAuth.show();
          }
        }
      }
    }
  }

  function timer(obj, t) {
    if (obj) {
      if (!obj.classList.contains('timer')) obj.classList.add('timer');
      let s = obj.querySelector('.t span');
      if (s) s.textContent = t;
      authTimerId = setInterval(() => {
        if (t == 0) {
          clearInterval(authTimerId);
          obj.classList.remove('timer');
        } else if (s) {
          s.textContent = --t;
          console.log(t);
        }
      }, 1000);
    }
  }
}
// ================================================================================================================== //





