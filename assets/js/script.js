function validateSignUpForm() {
  let pwd = document.getElementById("passwordS").value;
  let cpwd = document.getElementById("confirmation_passwordS").value;
  if (pwd != cpwd) {
    alert("Mật khẩu xác nhận không trùng khớp");

    $("#SignUpForm").on("submit", function (e) {
      e.preventDefault();
    });
    document.getElementById("passwordS").value = "";
    document.getElementById("confirmation_passwordS").value = "";
    return false;
  } else {
    return true;
  }
}

function showSignUpForm() {
  const modalSignup = document.querySelector(".js-modal-signup");
  modalSignup.classList.add("open");
  modalControl();
}
function showLoginForm() {
  const modalLogin = document.querySelector(".js-modal-login");
  modalLogin.classList.add("open");
  modalControl();
}
function modalControl() {
  const modals = document.querySelectorAll(".modal");
  for (let modal of modals) {
    modal.addEventListener("click", function (event) {
      modal.classList.remove("open");
    });
  }
  const modalBodys = document.querySelectorAll(".js-modal__body");
  for (let modalBody of modalBodys) {
    modalBody.addEventListener("click", function (event) {
      event.stopPropagation();
    });
  }
}
function sellPage() {
  const sell = document.querySelector(".js-sell");
  let canSell = document.querySelector("a[href='banhang.php']");
  if (canSell == null) {
    sell.addEventListener("click", function (event) {
      alert("Cần đăng nhập trước");
    });
  }
}

function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function formatCurrency(input) {
  var input_val = input.val();

  if (input_val === "") {
    return;
  }

  var original_len = input_val.length;

  var caret_pos = input.prop("selectionStart");

  if (input_val.indexOf(".") >= 0) {
    var decimal_pos = input_val.indexOf(".");

    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    left_side = formatNumber(left_side);

    right_side = formatNumber(right_side);

    input_val = left_side;
  } else {
    input_val = formatNumber(input_val);
    input_val = input_val;
  }

  input.val(input_val);

  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

function showUser() {
  const user = document.querySelector(".js-user-info");
  user.classList.remove("hide");

  const modals = document.querySelectorAll(".shopi");
  for (let modal of modals) {
    modal.addEventListener("click", function (event) {
      user.classList.add("hide");
    });
  }
  const modalBodys = document.querySelectorAll(".js-user-icon");
  for (let modalBody of modalBodys) {
    modalBody.addEventListener("click", function (event) {
      event.stopPropagation();
    });
  }
}
