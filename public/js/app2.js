const xhr = new XMLHttpRequest();



// ================================================================================================================== //
const sendCodeAuthBlock = document.getElementById("sendCodeAuth");
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
        }
      }, 1000);
    }
  }
}
// ================================================================================================================== //
const inputImageProduct = document.getElementById('inputImageProduct');
if (inputImageProduct) {
  let uploadImageProduct = document.getElementById('upload_images_products'), preview, container1, container2;
  inputImageproduct.createEventListener('change', function (e) {
    uploadImageProduct.innerText = '';
    if (e.target.files.length > 0) {
      for (let i = 0; i < e.target.files.length; i++) {
        preview = document.createElement('img');
        container1 = document.createElement('div');
        container2 = document.createElement('div');
        preview.setAttribute('src', URL.createObjectURL(e.target.files[i]));
        container1.setAttribute('class', 'img-thumbnail image2');
        container2.appendChild(preview);
        container1.appendChild(container2);
        uploadImageProduct.appendChild(container1);
      }
    }
  })
}
// ================================================================================================================== //





