<?php
session_start();
$title = 'Đăng nhập';

require_once './utils/utility.php';
require_once './database/dbhelper.php';
include_once './layouts/header.php';
include_once 'layouts/modal.php';
?>
<script>
function showLoginForm() {
    const modalLogin = document.querySelector(".js-modal-login");
    modalLogin.classList.add("open");
    modalControl();
}

function modalControl() {
    const modals = document.querySelectorAll(".modal");
    for (let modal of modals) {
        modal.addEventListener("click", function(event) {
            modal.classList.remove("open");
        });
    }
    var login = document.getElementById("login");
    var signup = document.getElementById("signup");
    var login_bt = document.getElementById("dangnhap");
    var signup_bt = document.getElementById("dangky");
    login_bt.addEventListener("click", function() {
        login.classList.add("open");
        signup.classList.remove("open");
    });

    signup_bt.addEventListener("click", function() {
        login.classList.remove("open");
        signup.classList.add("open");
    });
    const modalBodys = document.querySelectorAll(".js-modal__body");
    for (let modalBody of modalBodys) {
        modalBody.addEventListener("click", function(event) {
            event.stopPropagation();
        });
    }
}
showLoginForm();
</script>