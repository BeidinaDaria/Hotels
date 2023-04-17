<h3>Registration Form</h3>
<?php
include_once("functions.php");
$val1="";
$val2="";
if(!isset($_POST['regbtn']))
{
?>
<form action="index.php?page=3" method="post" name="register"> 
	<div class="form-group">
    <label for="login">Login:</label>
    <input type="text" class="form-control" name="login" id="login">
  </div>
  <div class="form-group">
    <label for="pass1">Password:</label>
    <input type="password" class="form-control" name="pass1" id="pass1">
  </div>
  <div class="form-group">
    <label for="pass2">Confirm Password:</label>
    <input type="password" class="form-control" name="pass2" id="pass2">
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email">
  </div>
  <button type="submit" class="btn btn-primary" name="regbtn" id="regbtn" disabled="true">Register</button>
</form>
<script>
function changeAble(){
  if ((document.getElementById("login").value!="")&&(document.getElementById("pass1").value!="")&&(document.getElementById("pass1").value==document.getElementById("pass2").value))
    document.getElementById("regbtn").disabled=false;
 else document.getElementById("regbtn").disabled=true;
}
document.getElementById('login').oninput=changeAble();
document.getElementById('pass1').oninput=changeAble();
document.getElementById('pass2').oninput=changeAble();

</script>
<?php
}
else
if(register($_POST['login'],$_POST['pass1'],$_POST['email']))
      {
        echo "<h3/><span style='color:green;'>New User Added!</span><h3/>";
      }
?>
