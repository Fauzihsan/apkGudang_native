<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleIndex.css">
    <script src="js/jquery.min.js"></script>
    <title>LOGIN</title>
</head>
<body>
    <section class="login-page">
        <form action="index.php" method="POST">
        
            <div class="box">
                <div class="header-form">
                    <h1>Welcome</h1>
                </div>
                <div class="body-form">
                <script language="javascript" type="text/javascript">
                  function removeSpaces(string) {
                  return string.split(' ').join('');
                  }
                </script>
                    <input type="text" placeholder="username" name="username" autocomplete="off" maxlength="11" required onkeyup="this.value=removeSpaces(this.value);" style="text-transform: lowercase;">
                    <input type="password" onkeyup="trigger()" class="inputPassword" placeholder="password" name="password" autocomplete="off" required>
                    <span class="showPass">SHOW</span>  
                    <a href="forgot-password.php" style="text-decoration: none; font-weight: bold; color: white; font-size: 16px; margin-left: 23em;">Forgot Password?</a>
                </div>
                <div class="footer-form">
                    <input type="submit" name="login" value="LOGIN" class="log">
                </div>
                <div class="signup">
                    <a href="daftar.php" style="text-decoration: none; font-weight: bold; color: wheat;">Sign Up</a>
                    
                </div>
                <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="errorMessage">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
            </div>
        </form>
        <script>
          const inputPassword = document.querySelector(".inputPassword");
          const showPass = document.querySelector(".showPass");
          function trigger(){
            if(inputPassword.value != ""){
              showPass.style.display = "block";
              showPass.onclick = function(){
                if(inputPassword.type == "password"){
                  inputPassword.type = "text";
                  showPass.textContent = "HIDE";
                  showPass.style.color = "white";
                }else{
                  inputPassword.type = "password";
                  showPass.textContent = "SHOW";
                  showPass.style.color = "white";
                }
              }
            }else{
              showPass.style.display = "none";
            }
          }
            </script>
    </section>
</body>
</html>