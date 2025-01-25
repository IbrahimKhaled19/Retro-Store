let email_input = document.getElementById("email");
let submit_btn = document.getElementById("submit");
let span = document.querySelectorAll("span");

const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;

submit_btn.addEventListener("click", (e) => {
  if (!emailPattern.test(email_input.value)) {
    e.preventDefault();
    span[0].classList.add("error");
  } else {
    span[0].classList.remove("error");
    e.defaultPrevented();
  }
});
