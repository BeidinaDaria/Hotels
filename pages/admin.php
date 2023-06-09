<div class="row">
	<div class="col-sm-6 col-md-6 col-lg-6 left">
		<!--   section A: Countries form  -->
	<?php
	if (!isset($_SESSION['radmin']))
	{
		echo "<h3/><span style='color:red;'>For Administrators Only!
		</span><h3/>";
		exit();
	}
   $host='localhost';
   $user='root';
   $pass='1469023578';
   $dbname='hotels';
	$link=mysqli_connect($host,$user,$pass) or die('connection error');
	mysqli_select_db($link,$dbname) or die('DB open error');
	$sel='SELECT * FROM countries';
	$res=mysqli_query($link,$sel);
	
	echo '<form action="index.php?page=4" method="POST" class="input-group" id="formcountry">';
	echo '<table class="table table-striped">';
	while($row=mysqli_fetch_array($res,MYSQLI_NUM)){
	echo '<tr>';
	echo '<td>'.$row[0].'</td>';
	echo '<td>'.$row[1].'</td>';
	echo '<td><input type="checkbox" name="cb'.$row[0].'"></td>';
	echo '</tr>';
	}
	echo '</table>';
	mysqli_free_result($res);
	echo '<input type="text" name="country" placeholder="Country">';
	echo '<input type="submit" name="addcountry" value="Add" class="btn btn-sm btn-info">';
	echo '<input type="submit" name="delcountry" value="Delete" class="btn btn-sm btn-warning">';
	echo '</form>';
	if (isset($_POST['addcountry'])){
		$country=trim(htmlspecialchars($_POST['country']));
		if($country=="") exit();
		$ins='INSERT INTO countries(Country) VALUES("'.$country.'")';
		mysqli_query($link,$ins);
		echo "<script>";
		echo "window.location=document.URL;";
		echo "</script>";
	}
	if(isset($_POST['delcountry'])){
		foreach ($_POST as $k => $v) {
			if (substr($k,0,2)=="cb"){
				$idc=substr($k,2);
				$del='DELETE FROM countries WHERE ID='.$idc;
				mysqli_query($link,$del);
			}
		}
		echo "<script>";
		echo "window.location=document.URL;";
		echo "</script>";
	}
	?>
	</div>
	<div class="col-sm-6 col-md-6 col-lg-6 right">
		<!--   section B: Cities form  -->
	<?php
	echo '<form action="index.php?page=4" method="post" class="input-group" id="formcity">';
	$sel='SELECT ci.ID, ci.city, co.country 
	FROM countries co, cities ci
	WHERE ci.countryID=co.ID';
	$res=mysqli_query($link,$sel);
	echo '<table class="table table-striped">';
	while ($row=mysqli_fetch_array($res,MYSQLI_NUM)) {
		echo '<tr>';
		echo '<td>'.$row[0].'</td>';
		echo '<td>'.$row[1].'</td>';
		echo '<td>'.$row[2].'</td>';
		echo '<td><input type="checkbox" name="ci'.$row[0].'"></td>';
		echo '</tr>';
	}
	echo '</table>';
	mysqli_free_result($res);
	$res=mysqli_query($link,'SELECT * FROM countries');
	echo '<select name="countryname" class="form-control">';
	while ($row=mysqli_fetch_array($res,MYSQL_NUM)){
		echo '<option value="'.$row[0].'">'.$row[1].'</option>';
	}
	echo '</select>';
	echo '<input type="text" name="city"  placeholder="City">';
	echo '<input type="submit" name="addcity" value="Add" class="btn btn-sm btn-info">';
	echo '<input type="submit" name="delcity" value="Delete" class="btn btn-sm btn-warning">';
	echo '</form>';
	if(isset($_POST['addcity'])){
		$city=trim(htmlspecialchars($_POST['city']));
		if ($city=="") exit();
		$countryid=$_POST['countryname'];
		$ins='INSERT INTO cities (city,countryID) VALUES("'.$city.'",'.$countryid.')';
		mysqli_query($link,$ins);
		$err=mysqli_errno($link);
		if ($err){
			echo 'Error code:'.$err.'<br>';
			exit();
		}
		echo "<script>";
		echo "window.location=document.URL;";
		echo "</script>";
	}
	if(isset($_POST['delcity'])){
		foreach ($_POST as $k => $v) {
			if (substr($k,0,2)=="ci"){
				$idc=substr($k,2);
				$del='DELETE FROM cities WHERE ID='.$idc;
				mysqli_query($link,$del);
			}
		}
		echo "<script>";
		echo "window.location=document.URL;";
		echo "</script>";
	}
	?>
	</div>
	</div>
	<hr/>
	<div class="row">
	<div class=" col-sm-6 col-md-6 col-lg-6 left ">
		<!--   section C: Hotels form  -->
		<?php

	echo '<form action="index.php?page=4" method="post"  class="input-group" id="formhotel">';
	$sel='SELECT ci.ID, ci.city, 
	ho.ID, ho.hotel, ho.cityID, ho.countryID, ho.stars, ho.info, 
	co.ID, co.country
	FROM cities ci, hotels ho, countries co
	WHERE ho.cityID=ci.ID and ho.countryID=co.ID';
	$res=mysqli_query($link,$sel);
	$err=mysqli_errno($link);
	echo '<table class="table" width="100%">';
	while ($row=mysqli_fetch_array($res,MYSQLI_NUM)) {
		echo '<tr>';
		echo '<td>'.$row[2].'</td>';
		echo '<td>'.$row[1]."-".$row[9].'</td>';
		echo '<td>'.$row[3].'</td>';
		echo '<td>'.$row[6].'</td>';
		echo '<td><input type="checkbox" name="hb'.$row[2].'"></td>';
		echo '</tr>';
	}
	echo '</table>';
	mysqli_free_result($res);
	$sel='SELECT ci.ID, ci.city, co.country, co.ID
	FROM countries co, cities ci
	WHERE ci.countryID=co.ID';
	$res=mysqli_query($link,$sel);
	$csel=array();
	echo '<select name="hcity" class="">';
	while ($row=mysqli_fetch_array($res,MYSQL_NUM)){
		echo '<option value="'.$row[0].'">'.$row[1]." : ".$row[2].'</option>';
		$csel[$row[0]]=$row[3];
	}
	echo '</select>';
	echo '<input type="text" name="hotel" placeholder="Hotel">';
	echo '<input type="text" name="cost" placeholder="Cost">';
	echo '&nbsp;&nbsp;Stars: <input type="number" name="stars" min="1" max="5">';	
	echo '<br><textarea name="info" placeholder="Description">';
	echo '</textarea><br>';
	echo '<input type="submit" name="addcity" value="Add" class="btn btn-sm btn-info">';
	echo '<input type="submit" name="delcity" value="Delete" class="btn btn-sm btn-warning">';
	echo '</form>';
	mysqli_free_result($res);
	if(isset($_POST['addhotel'])){
		$hotel=trim(htmlspecialchars($_POST['hotel']));
		$cost=intval(trim(htmlspecialchars($_POST['cost'])));
		$stars=intval($_POST['stars']);
		$info=trim(htmlspecialchars($_POST['info']));
		if ($hotel==""||$cost==""||$stars=="") exit();
		$cityid=$_POST['hcity'];
		$countryid=$csel[$cityid];
		$ins='INSERT INTO hotels (hotel,cityID,countryID,stars,cost,info) VALUES("'.$hotel.'",'.$cityID;
		$ins.=",".$countryID.','.$stars.','.$cost.',"'.$info;
		$ins.='")';
		mysqli_query($link,$ins);
		echo "<script>";
		echo "window.location=document.URL;";
		echo "</script>";
	}
	if(isset($_POST['delhotel'])){
		foreach ($_POST as $k => $v) {
			if (substr($k,0,2)=="hb"){
				$idc=substr($k,2);
				$del='delete from hotels where id='.$idc;
				mysqli_query($link,$del);
				if ($err){
				echo 'Error code:'.$err.'<br>';
				exit();
				}
			}
		}
		echo "<script>";
		echo "window.location=document.URL;";
		echo "</script>";
	}
	?>
	</div>
	<div class=" col-sm-6 col-md-6 col-lg-6 right ">
		<!--   section D: Images form  -->
	<?php
	echo '<form action="index.php?page=4" method="post" enctype="multipart/form-data" class="input-group">';
	echo '<select name="hotelid">';
	$sel='SELECT ho.ID, co.country,ci.city,ho.hotel
	FROM countries co,cities ci, hotels ho
	WHERE co.ID=ho.countryID and ci.ID=ho.cityID
	ORDER BY co.country';
	$res=mysqli_query($link,$sel);
	while($row=mysqli_fetch_array($res,MYSQL_NUM)){
		echo '<option value="'.$row[0].'">';
		echo $row[1].'&nbsp;&nbsp;'.$row[2].'&nbsp;&nbsp;'.$row[3].'</option>';
	}
	mysqli_free_result($res);
	echo '<input type="file" name="file[]" multiple accept="image/*">';
	echo '<input type="submit" name="addimage" value="Add" class="btn btn-sm btn-info">';
	echo '</select>';
	echo '</form>';
	if(isset($_REQUEST['addimage'])){
		foreach($_FILES['file']['name'] as $k => $v) {
			if($_FILES['file']['error'][$k] !=0){
				echo '<script>alert("Upload file error:'.$v.'")</script>';
				continue;
			}
			if(move_uploaded_file($_FILES['file']['tmp_name'][$k],'images/'.$v)){
				$ins='INSERT INTO images(hotelID,imagepath) VALUES('.$_REQUEST['hotelid'].',"images/'.$v.'")';
				mysqli_query($link,$ins);
			}
		}
	}
	echo '</div>';
	?>
</div>
</div>
