<?php 
function connect($host='localhost',$user='root',$pass='1469023578',$dbname='hotels'){
	$link=mysqli_connect($host,$user,$pass) or die('connection error');
	mysqli_select_db($link,$dbname) or die('DB open error');
	mysqli_query($link,"set names 'utf-8'");
	return $link;
}
function register($name,$pass,$email){
	$name=trim(htmlspecialchars($name));
	$pass=trim(htmlspecialchars($pass));
	$email=trim(htmlspecialchars($email));
	if ($name=="" || $pass=="" || $email=="") {
		echo "<h3/><span style='color:red;'>Fill All Required Fields!</span><h3/>";
		return false;		
	}
	if ((strlen($_POST['login'])<3)||(strlen($_POST['login'])>20)){
		echo '<h3 style="color:red;">Username is too short / long</h3>';
		return false;
	}
  	else 
  	if (strlen($_POST['pass1'])<6){
    	echo '<h3 style="color:red;">Password is too short</h3>';
		return false;
	}
	$ins='INSERT INTO users (login,pass,email,roleID) values("'.$name.'","'.md5($pass).'","'.$email.'",2)';
	$host='localhost';
	$user='root';
	$pass='1469023578';
	$dbname='hotels';
	$link=mysqli_connect($host,$user,$pass) or die('connection error');
	mysqli_select_db($link,$dbname) or die('DB open error');
	mysqli_query($link,$ins);
	$err=mysqli_errno($link);
	if ($err){
		if($err==1062)
			echo "<h3/><span style='color:red;'>This Login Is Already Taken!</span><h3/>";
		else
			echo "<h3/><span style='color:red;'>Error code:".$err."!</span><h3/>";
		return false;
	}
	return true;
}
function login($name,$pass)
{
	$name=trim(htmlspecialchars($name));
	$pass=trim(htmlspecialchars($pass));
	if ($name=="" || $pass=="")
	{
		echo "<h3/><span style='color:red;'>Fill All Required Fields!</span><h3/>";
		return false;
	}
	if (strlen($name)<3 || strlen($name)>30 ||strlen($pass)<3 || strlen($pass)>30) {
		echo "<h3/><span style='color:red;'>Value Length Must Be Between 3 And 30!</span><h3/>";
		return false;
	}
	$link =connect();
	$sel='SELECT * FROM users WHERE login="'.$name.'"AND pass="'.md5($pass).'"';
	$res=mysqli_query($link,$sel);
	if($row=mysqli_fetch_array($res,MYSQLI_NUM)){
		$_SESSION['ruser']=$name;
		if($row[5]==1){
			$_SESSION['radmin']=$name;
		}
		return true;
	}
	else
	{
		if ($row=mysqli_fetch_array($res,MYSQLI_NUM)[0]==$name){
			echo "<h3/><span style='color:red;'>Incorrect password</span><h3/>";
			return false;
		}
		echo "<h3/><span style='color:red;'>No Such User!</span><h3/>";
		return false;
	}
}
?>