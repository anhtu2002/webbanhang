<div class="modal js-modal-signup" id="signup">
    <div class="modal__overlay">

    </div>
    <div class="modal__body js-modal__body">
        <div class="modal__inner">
            <div class="auth-form">

                <div class="auth-form__header">
                    <h2>Đăng ký</h2>
                </div>
                <form method="post" action="signup.php" id="SignUpForm" onsubmit="return validateSignUpForm();">
                    <div class="form-group">
                        <input required="true" type="text" class="form-control" id="emailS" name="name"
                            placeholder="Nhập tên của bạn">
                    </div>
                    <div class="form-group">
                        <input required="true" type="email" class="form-control" id="emailS" name="email"
                            placeholder="Nhập email">
                    </div>
                    <div class="form-group">
                        <input required="true" type="number" class="form-control" id="emailS" name="phone"
                            placeholder="Nhập số điện thoại">
                    </div>
                    <div class="form-group">
                        <input required="true" type="text" class="form-control" id="emailS" name="adress"
                            placeholder="Nhập địa chỉ">
                    </div>
                    <div class="form-group">
                        <input required="true" type="password" class="form-control" id="passwordS" name="password"
                            placeholder="Nhập mật khẩu">
                    </div>
                    <div class="form-group">
                        <input required="true" type="password" class="form-control" id="confirmation_passwordS"
                            name="confirmation_password" placeholder="Nhập lại mật khẩu">
                    </div>
                    <button type="submit" class="btn btn-success">
                        Đăng ký

                    </button>
                    <h3 id="dangnhap" onclick="showLoginForm()" style="padding: 10px; margin-bottom: 10px">Đăng nhập
                    </h3>

                </form>
            </div>

        </div>

    </div>

</div>
</div>

<!-- sign up form -->
<div class="modal js-modal-login" id="login">
    <div class="modal__overlay">

    </div>
    <div class="modal__body js-modal__body">
        <div class="modal__inner">
            <div class="auth-form">

                <div class="auth-form__header">
                    <h2>Đăng nhập</h2>
                </div>
                <form method="post" action="login_sv.php" id="login-form" onsubmit="validateLoginForm()" ;>

                    <div class="form-group">
                        <input required="true" type="email" class="form-control" id="emailL" name="email"
                            placeholder="Nhập email">
                    </div>
                    <div class="form-group">
                        <input required="true" type="password" class="form-control" id="passwordL" name="password"
                            placeholder="Nhập mật khẩu">
                    </div>
                    <button type="submit" class="btn btn-success">
                        Đăng nhập
                    </button>
                    <h3 id="dangky" onclick="showSignUpForm()" style="padding: 10px; margin-bottom: 10px">Đăng ký</h3>
                </form>
            </div>

        </div>

    </div>

</div>

<script type="text/javascript">
$("#login-form").submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var actionUrl = form.attr('action');

    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
        success: function(data) {
            if (data == "success") {
                location.reload();
                window.location.href = 'index.php';
            } else alert(data);
        }
    })
})
</script>
<style>
h3:hover {
    cursor: pointer;
}
</style>