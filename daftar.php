<?php
    require_once "controllerUserData.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
    <link rel="stylesheet" href="css/styleDaftar.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#username').keyup(function(){
          $.post("cekUsername.php",
          {username : $('#username').val()
          },function(response){
            $('#usernameResult').fadeOut();
            setTimeout("userResult('usernameResult','"+escape(response)+"')",350);
          });
          return false;
        });
      });

      function userResult(id,response){
        $('#usernameLoading').hide();
        $('#'+id).html(unescape(response));
        $('#'+id).fadeIn();

      }
    </script>
</head>
<body>
    <img src="img/registImg.svg" alt="" class="gambar">
    <div class="regist">
       <h1 align="center">Register</h1>
    <form action="daftar.php" method="post">
    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="errorMessage">
                            <?php
                            foreach($errors as $showerror){
                              echo "WARNING! : ";
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="errorMessage">
                            <?php
                              echo "WARNING! : ";
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
        <div class="div">
            <input type="text" name="namaDepan" autocomplete="off" required>
            <label for="namaDepan" class="label">
                <span class="text">First Name</span>
            </label>
        </div>
        <div class="div">
            <input type="text" name="namaBelakang" autocomplete="off" required>
            <label for="namaBelakang" class="label">
                <span class="text">Last Name</span>
            </label>
        </div>
        <div class="div">
          <span id="span1email">WARNING: Enter a Valid Email Address</span>
          <input type="text" name="email" autocomplete="off" required id="email">
            <label for="email" class="label">
                <span class="text">Email</span>
            </label>
          <span class="successemail"><i class="fa fa-check" aria-hidden="true" id="successemail"></i></span>
	        <span class="erroremail"><i class="fa fa-times" aria-hidden="true" id="erroremail"></i></span>
        </div>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#username').keyup(function(){
          $.post("cekUsername.php",
          {username : $('#username').val()
          },function(response){
            $('#usernameResult').fadeOut();
            setTimeout("userResult('usernameResult','"+escape(response)+"')",350);
          });
          return false;
        });
      });

      function userResult(id,response){
        $('#usernameLoading').hide();
        $('#'+id).html(unescape(response));
        $('#'+id).fadeIn();

      }
    </script>
        <div class="div">
            <script language="javascript" type="text/javascript">
                  function removeSpaces(string) {
                  return string.split(' ').join('');
                  }
                </script>
            <input type="text" maxlength="11" name="username" id="username" class="inputUsername" autocomplete="off" required onkeyup="this.value=removeSpaces(this.value);" style="text-transform: lowercase;">
            <label for="username" class="label">
                <span class="text">Username</span>
            </label>
            <span id="usernameResult" class="notif"></span>
        </div>

      <div class="containerPass" style=" height:100px;">
        <div class="div" id="pass">
            <input onkeyup="trigger()" type="password" class="inputPassword" name="password" autocomplete="off" required>
            <label for="password" class="label">
                <span class="text">Password</span>
            </label>
            <span class="showPass">SHOW</span>  
        </div>
        <div class="indicator">
          <span class="weak"></span>
          <span class="medium"></span>
          <span class="strong"></span>
        </div>
        <div class="teks"></div>
      </div>
        <div class="div" style="margin-top:-20px;">
            <input type="password" name="password2" class="inputPassword2" autocomplete="off" required>
            <label for="password2" class="label">
                <span class="text">Confirm Password</span>
            </label>
        </div>
        <div class="tombol">
            <input type="submit" name="register" class="btn" value="SUBMIT">
            <input onclick="trigger()" type="reset" name="reset" class="btn" value="CLEAR"><br>
            <a href="index.php">BACK TO HOME</a>
        </div>        
    </form>
    </div>
    <script>
        const indicator = document.querySelector(".indicator");
      const inputPassword = document.querySelector(".inputPassword");
      const inputPassword2 = document.querySelector(".inputPassword2");
      const weak = document.querySelector(".weak");
      const medium = document.querySelector(".medium");
      const strong = document.querySelector(".strong");
      const teks = document.querySelector(".teks");
      const showPass = document.querySelector(".showPass");
      let regExpWeak = /[a-z]/;
      let regExpMedium = /\d+/;
      let regExpStrong = /.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/;
      function trigger(){
        if(inputPassword.value != ""){
          indicator.style.display = "block";
          indicator.style.display = "flex";
          if(inputPassword.value.length <= 3 && (inputPassword.value.match(regExpWeak) || inputPassword.value.match(regExpMedium) || inputPassword.value.match(regExpStrong)))no=1;
          if(inputPassword.value.length >= 6 && ((inputPassword.value.match(regExpWeak) && inputPassword.value.match(regExpMedium)) || (inputPassword.value.match(regExpMedium) && inputPassword.value.match(regExpStrong)) || (inputPassword.value.match(regExpWeak) && inputPassword.value.match(regExpStrong))))no=2;
          if(inputPassword.value.length >= 6 && inputPassword.value.match(regExpWeak) && inputPassword.value.match(regExpMedium) && inputPassword.value.match(regExpStrong))no=3;
          if(no==1){
            weak.classList.add("active");
            teks.style.display = "block";
            teks.textContent = "Your password is too week";
            teks.classList.add("weak");
          }
          if(no==2){
            medium.classList.add("active");
            teks.textContent = "Your password is medium";
            teks.classList.add("medium");
          }else{
            medium.classList.remove("active");
            teks.classList.remove("medium");
          }
          if(no==3){
            weak.classList.add("active");
            medium.classList.add("active");
            strong.classList.add("active");
            teks.textContent = "Your password is strong";
            teks.classList.add("strong");
          }else{
            strong.classList.remove("active");
            teks.classList.remove("strong");
          }
          showPass.style.display = "block";
          showPass.onclick = function(){
            if(inputPassword.type == "password"){
              inputPassword.type = "text";
              inputPassword2.type = "text";
              showPass.textContent = "HIDE";
              showPass.style.color = "white";
            }else{
              inputPassword.type = "password";
              inputPassword2.type = "password";
              showPass.textContent = "SHOW";
              showPass.style.color = "white";
            }
          }
        }else{
          indicator.style.display = "none";
          showPass.style.display = "none";
          teks.style.display = "none";
        }
      }

    </script>

<script>
	  $(document).ready(function(){

	    $('#email').focusout(function(){
	      email_validate();
	    });

			function email_validate() {

			  var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var email = $('#email').val();
        var success = document.querySelector(".successemail");
        var error = document.querySelector(".erroremail");
        var span1 = document.querySelector("#span1email");
				if(email !== '') {
				  if(pattern.test(email)) {
            success.style.display = "block"; 
            error.style.display = "none"; 
            span1.style.display = "none"; 
				  }
				  else {
            success.style.display = "none"; 
            error.style.display = "block"; 
            span1.style.display = "block"; 
				  }
				}
			  else {
            success.style.display = "none"; 
            error.style.display = "none"; 
            span1.style.display = "none"; 
			  }
			}
		});
	</script>
</body>
</html>