<?php
session_start();
$title = 'Đổi mật khẩu';

require_once './utils/utility.php';
require_once './database/dbhelper.php';
include_once './layouts/header.php';
if (isLogin() == false) {
    header('Location: main.php');
    die();
}
$userID = $_SESSION['user']['id'];
if (!empty($_POST)) {
    $old_pass = getPost('old_pass');
    $new_pass = getPost('new_pass');

    $sql = "SELECT * FROM users WHERE id = '$userID'";
    $data = executeResult($sql);
    foreach ($data as $dt);
    if ($dt['password'] == $old_pass) {
        $sql = "UPDATE users SET password = '$new_pass' WHERE id = '$userId' ";
        execute($sql);
        echo '<script>
        alert("Đổi mật khẩu thành công");
        window.location.href = "main.php";</script>';
    } else {
        echo '<script>alert("Mật khẩu không chính xác!");
        window.location.href = "change_pass.php";
        </script>';
    }
}

?>


<div class="modal_change">
    <div class="modal__body js-modal__body">
        <div class="auth-form">

            <div class="auth-form__header">
                <h2>Đổi mật khẩu</h2>
            </div>
            <form method="post" action="" id="login-form">

                <div class="form-group">
                    <input required="true" type="password" class="form-control" id="emailL" name="old_pass" placeholder="Mật khẩu cũ">
                </div>
                <div class="form-group">
                    <input required="true" type="password" class="form-control" id="password" name="new_pass" placeholder="Mật khẩu mới">
                </div>
                <div class="form-group">
                    <input required="true" type="password" class="form-control" id="passwordL" name="" placeholder="Nhập lại mật khẩu">
                </div>
                <div id="message"></div>
                <button disabled id="bt" type="submit" class="btn btn-success">
                    Thay đổi
                </button>

            </form>
        </div>

    </div>
</div>



<?php include_once 'layouts/footer.php'; ?>
<style>
    .modal_change {
        margin-top: 200px;
        margin-left: 500px;
        width: 436px;
        height: 310px;
        border: 2px solid #ccc;
        margin-bottom: 180px;
    }

    #message {
        margin-left: 15px;
        color: red;
    }
</style>
<script>
    const input1 = document.getElementById("password");
    const input2 = document.getElementById("passwordL");
    const message = document.getElementById("message");
    const bt = document.getElementById("bt");

    // Function to check if the values are equal
    function checkValues() {
        const value1 = input1.value;
        const value2 = input2.value;

        if (value1 != value2) {
            message.textContent = "Mật khẩu xác nhận không trùng khớp";

        } else {
            message.textContent = "";
            bt.disabled = false;
        }
    }

    // Attach the checkValues function to the input event of both inputs
    input2.addEventListener("input", checkValues);
</script>