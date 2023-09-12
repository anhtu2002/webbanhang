<?php
session_start();
$title = 'Thông tin cá nhân';
require_once './database/dbhelper.php';
require_once './utils/utility.php';
include_once './layouts/header.php';
if (isLogin() == false) {
    header('Location: index.php');
    die();
}


$sql1 = "SELECT * FROM user_inf WHERE user_id = '$userId'";
$userinf = executeResult($sql1);
foreach ($userinf as $userInf)

    $sql = "SELECT * FROM users WHERE id = '$userId'";
$user_e = executeResult($sql);
foreach ($user_e as $user_E)

?>
<?php
if (!empty($_POST)) {
    $productImg = '';
    if (isset($_FILES['image'])) {
        $errors = [];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];


        if ($file_size > 2097152) {
            $errors[] = 'Kích thước file không được lớn hơn 2MB';
        }
        if (empty($errors) == true) {


            $user_Img = './images/img_user/' . $file_name;
            $user_Name = getPost('name');
            $user_Email = getPost('email');
            $user_Phone = getPost('phone');

            $user_Sex = getPost("sex");




            if ($user_Name != null && $user_Email != null) {
                $sql = "UPDATE user_inf 
                SET user_name = '$user_Name', user_phone = '$user_Phone'
                WHERE user_id = '$userId'";
                execute($sql);
                if ($user_Sex != null) {
                    $sqlll = "UPDATE user_inf 
                    SET user_sex = '$user_Sex'
                    WHERE user_id = '$userId'";
                    execute($sqlll);
                }

                if ($file_name != null) {
                    $sqlll = "UPDATE user_inf 
                    SET user_ava = '$user_Img'
                    WHERE user_id = '$userId'";
                    execute($sqlll);
                }
                $sqll = "UPDATE users 
                SET email = '$user_Email' 
                WHERE id = '$userId'";
                execute($sqll);
                if ($user_Img != $userInf['user_ava'])
                    move_uploaded_file($file_tmp, 'images/img_user/' . $file_name);

                echo "<script>window.location.href = 'user.php';
                alert('Cập nhật thành công');</script>";
            }
        } else {
            echo "<script>alert('$errors[0]')</0script>";
        }
    }
}

?>

<div class="user-inf">
    <form id="Form" method="POST" action="" enctype="multipart/form-data">
        <h2>THÔNG TIN CÁ NHÂN</h2>
        <table class="infor">

            <tr>
                <td class="name"><label>Tên</label></td>
                <td class="data">
                    <input required="true" disabled type="text" placeholder="" class="CMyrTJ" value="<?php echo $userInf["user_name"] ?> " name="name">
                </td>
            </tr>
            <tr>
                <td class="name"><label>Email</label></td>
                <td class="data">
                    <input required="true" disabled type="text" placeholder="" class="CMyrTJ" value="<?php echo $user_E["email"] ?>" name="email">
                </td>
            </tr>
            <tr>
                <td class="name"><label>Số điện thoại</label></td>
                <td class="data">
                    <input required="true" disabled type="text" placeholder="" class="CMyrTJ" value="<?php echo "0";
                                                                                                        echo $userInf["user_phone"] ?>" name="phone">
                </td>
            </tr>
            <tr>
                <td class="name"><label>Giới tính</label></td>
                <td class="data">
                    <select disabled name="sex" id="" class="CMyrTJ">
                        <option value="" disabled selected hidden><?php echo $userInf['user_sex'] ?></option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>

                    </select>

                </td>
            </tr>
            <tr>
                <td class="name"><label>Ảnh đại diện</label></td>
                <td class="data">

                    <input onchange="previewFile()" accept="image/*" disabled type="file" placeholder="" class="CMyrTJ" name="image">
                </td>
            </tr>


        </table>
        <div onclick="edit_inf()" id="thaydoi">Sửa</div>
        <button type="submit" hidden id="save">Lưu</button>
    </form>
    <div class="avt">
        <img src="<?php echo $userInf['user_ava'] ?>" id="img">
    </div>



</div>

<?php include_once './layouts/footer.php'; ?>
<style>
    .user-inf {
        border: 2px solid #ccc;
        margin-top: 50px;
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 700px;
        height: 400px;


    }

    .footer {
        margin-top: 640px;
    }

    .infor td {
        border: none;
        line-height: 40px;
        font-size: 16px;
    }

    .name {
        text-align: right;
        font-weight: bold;
        padding-right: 40px;
        width: 350px;
        margin-left: 50px;
    }

    .data {
        text-align: left;


    }

    .CMyrTJ {
        border: none;
        font-size: 18px;

    }

    #thaydoi,
    #save {
        border: none;
        background-color: aqua;
        height: 40px;
        width: 70px;
        text-align: center;
        line-height: 40px;
        margin: 30px 250px;
        border-radius: 25% 0;
    }

    #save {
        background-color: green;
        position: absolute;
        bottom: 15px;
        left: 100px;
    }

    form {
        text-align: center;
        font-family: 'Times New Roman', Times, serif;
    }

    .avt {
        position: absolute;
        width: 180px;
        height: 250px;
        padding: 5px;
        border: 2px solid #ccc;
        left: 20px;
        top: 50px;
        align-items: center;

    }

    #img {
        width: 100%;
        height: 240px;
    }
</style>

<script>
    function edit_inf() {
        document.getElementById("save").hidden = false;


        var editable = document.getElementsByClassName("CMyrTJ");
        for (let i = 0; i < 5; i++) {
            editable[i].disabled = false;
        }
    }

    function previewFile() {
        var preview = document.getElementById("img")

        var file = document.querySelector("input[type=file]").files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        };

        reader.readAsDataURL(file);
    }
</script>