
const submitRegisterFormAction = document.querySelector('#submit-register-form');
const agreeTermsAndConditions = document.querySelector('input[name="accept_terms"]');
agreeTermsAndConditions.addEventListener('change', () => {
  if (agreeTermsAndConditions.checked === true) {
    submitRegisterFormAction.disabled = false;
  } else {
    submitRegisterFormAction.disabled = true;
  }
});

/* global grecaptcha */
const registerForm = document.querySelector('#register-form');
registerForm.addEventListener('submit', (e) => {
  e.preventDefault();
  const { gtoken } = e.target.dataset;
  grecaptcha.ready(() => {
    grecaptcha.execute(gtoken, { action: 'register' }).then((token) => {
      const gTokenElement = document.querySelector('input[name="g-recaptcha-response"]');
      gTokenElement.value = token;
      registerForm.submit();
    });
  });
});
