function toggleForms(formType) {
    const signupForm = document.getElementById("signup-form");
    const loginForm = document.getElementById("login-form");
    if (formType === "login") {
      signupForm.classList.add("hidden");
      loginForm.classList.remove("hidden");
    } else {
      signupForm.classList.remove("hidden");
      loginForm.classList.add("hidden");
    }
  }