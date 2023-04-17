<h2>Gallery</h2>
<form action='index.php?page=3' method='post'>
<p>Select graphics extension to display:</p>
<select name='ext'>
<?php
  $path = 'images/';
  if($dir = opendir($path))
  {
    $ar = array();
    while (($file = readdir($dir)) !== false)
    {
	$fullname = $path . $file;
	$pos = strrpos($fullname, '.'); 
	$ext = substr($fullname, $pos+1);
	$ext= strtolower($ext);
	if( !in_array($ext, $ar) )
	{
		$ar[] = $ext;
		echo "<option>" . $ext . "</option>";
	}
    }
    closedir($dir); 
} 
?>
</select>
<input type="submit" name="submit" value="Show Pictures" class="btn btn-primary"/>
</form>
<br/>
<?php
	if(isset($_POST['submit']))
	{
		 $ext = $_POST['ext'];
		 $ar = glob($path . "*." . $ext); 
		 echo "<div class='panel panel-primary'>";
		 echo '<div class="panel-heading">';
    echo '<h3 class="panel-title">Gallery content</h3></div>';
		 foreach ($ar as $a)
		 {
		 	echo "<a href='" . $a . "' target='_blank'>
		 		<img src='" . $a . "' height='100px' border='0' alt='picture' class='img-polaroid'/>
			</a>";
		 }
		 echo "</div>";
	}
	if (!isset($_SESSION['ruser']))
	{
		echo "<h3/><span style='color:red;'>Please, sign in!</span><h3/>";
		exit();
	}
	$host='localhost';
   	$user='root';
   	$pass='1469023578';
   	$dbname='hotels';
   	$link=mysqli_connect($host,$user,$pass) or die('connection error');
	mysqli_select_db($link,$dbname) or die('DB open error');
    $sel='SELECT * FROM hotels';
	$res=mysqli_query($link,$sel);
	echo '<select name="hotel" class="select" width="100%">';
	while ($row=mysqli_fetch_array($res,MYSQLI_NUM)) {
		echo '<option>'.$row[1].'</option>';
	}
	echo '</select>';
	mysqli_free_result($res);
	echo '<input type="text" name="comment" placeholder="Your comment">';
	echo '<input type="submit" name="adddesc" value="Add your description" class="btn btn-sm btn-info">';
	if(isset($_POST['adddesc'])){
		$hotel=trim(htmlspecialchars($_POST['hotel']));
		$comment=intval(trim(htmlspecialchars($_POST['comment'])));
		if ($hotel==""||$comment=="") exit();
		$sel="SELECT HotelID FROM hotels WHERE Hotel=".$hotel;
		$res=mysqli_query($link,$sel);
		$row=mysqli_fetch_array($res,MYSQLI_NUM);
		$hotelid=$row[0];
		$sel="SELECT UserID FROM users WHERE Login=".$_POST['login'];
		$res=mysqli_query($link,$sel);
		$row=mysqli_fetch_array($res,MYSQLI_NUM);
		$userid=$row[0];
		$ins='INSERT INTO comments(UserID,HotelID,Comment) VALUES('.$userid.','.$hotelid.',"'.$comment.'")';
		mysqli_query($link,$ins);
		echo "<script>";
		echo "window.location=document.URL;";
		echo "</script>";
	}
?>
