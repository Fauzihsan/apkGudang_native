<?php require_once "controllerUserData.php"; ?>
<?php 
// $email = $_SESSION['email'];
// if($email == false){
//   header('Location: index.php');
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Somehow I got an error, so I comment the title, just uncomment to show -->
    <!-- S<title>Create a New Password</title> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
    <style>
    .showPass{
        position: absolute;
        right: 45px;
        margin-top:-15px;
        transform: translateY(-50%);
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        user-select: none;
        display: none;
        color: #696464;
        transition : all .5s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="change-password.php" method="POST" autocomplete="off">
                    <h2 class="text-center">New Password</h2>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                    <?php $by = $_SESSION['username']; ?>
                        <div style="text-align:center;"><?php echo "$by"?><input type="hidden" name="username" id="username" value="<?=$by?>"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" onkeyup="trigger()" id="inputPassword" type="password" name="password" placeholder="Create new password" required>
                        <span class="showPass">SHOW</span>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" id="inputPassword2" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password2" value="Change">
                    </div>
                </form>
                <script>
          const inputPassword = document.querySelector("#inputPassword");
          const showPass = document.querySelector(".showPass");
          function trigger(){
            if(inputPassword.value != ""){
              showPass.style.display = "block";
              showPass.onclick = function(){
                if(inputPassword.type == "password"){
                  inputPassword.type = "text";
                  inputPassword2.type = "text";
                  showPass.textContent = "HIDE";
                  showPass.style.color = "#696464";
                }else{
                  inputPassword.type = "password";
                  inputPassword2.type = "password";
                  showPass.textContent = "SHOW";
                  showPass.style.color = "#696464";
                }
              }
            }else{
              showPass.style.display = "none";
            }
          }
            </script>
            </div>
        </div>
    </div>
</body>
</html>
