<div class="row">
	<div class="col-sm-6 col-md-6 col-lg-6 left">
	<?php
   $host='localhost';
   $user='root';
   $pass='1469023578';
   $dbname='hotels';
    $link=mysqli_connect($host,$user,$pass) or die('connection error');
	mysqli_select_db($link,$dbname) or die('DB open error');
	$sel='SELECT * FROM countries';
	$res=mysqli_query($link,$sel);
	$sel='SELECT * FROM cities';
	$res1=mysqli_query($link,$sel);
    $sel='SELECT * FROM hotels';
	$res2=mysqli_query($link,$sel);
	echo '<table class="table table-striped">';
	echo '<tr>';
	echo '<td>Страны:</td>';
	echo '<td>'.mysqli_num_rows($res).'</td>';
	echo '</tr>';
    echo '<tr>';
	echo '<td>Города:</td>';
	echo '<td>'.mysqli_num_rows($res1).'</td>';
	echo '</tr>';
    echo '<tr>';
	echo '<td>Отели:</td>';
	echo '<td>'.mysqli_num_rows($res2).'</td>';
	echo '</tr>';
	echo '</table>';
	mysqli_free_result($res);
    mysqli_free_result($res1);
    mysqli_free_result($res2);
	echo '<input type="text" name="country" placeholder="Country">';
	echo '<input type="submit" name="addcountry" value="Add" class="btn btn-sm btn-info">';
	echo '</form>';
    if (isset($_POST['addcountry'])){
		$country=trim(htmlspecialchars($_POST['country']));
		if($country=="") exit();
		$ins='INSERT INTO countries(Country) VALUES("'.$country.'")';
		mysqli_query($link,$ins);
        $err=mysqli_errno($link);
		echo "<script>";
		echo "window.location=document.URL;";
		echo "</script>";
	}
	?>
	</div>
