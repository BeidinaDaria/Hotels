<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Hotel Info</title>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/info.css">
        </head>
    <body>
    <?php
    include_once("functions.php");
    if(isset($_GET['hotel'])){
        $host='localhost';
        $user='root';
        $pass='1469023578';
        $dbname='hotels';
        $hotel=$_GET['hotel'];
        $link=mysqli_connect($host,$user,$pass) or die('connection error');
        mysqli_select_db($link,$dbname) or die('DB open error');
        $sel='SELECT * FROM hotels WHERE ID='.$hotel;
        $res=mysqli_query($link,$sel);
        $row=mysqli_fetch_array($res,MYSQL_NUM);
        $hname=$row[1];
        $hstars=$row[4];
        $hcost=$row[5];
        $hinfo=$row[6];
        mysqli_free_result($res);
        echo '<h2 class="text-uppercase textcenter">'.$hname.'</h2>';
        echo '<div class="row"><div class="col-md-6 textcenter">';
        $host='localhost';
        $user='root';
        $pass='1469023578';
        $dbname='hotels';
        $hotel=$_GET['hotel'];
        $link=mysqli_connect($host,$user,$pass) or die('connection error');
        mysqli_select_db($link,$dbname) or die('DB open error');
        $sel='SELECT imagepath FROM images WHERE hotelID='.$hotel;
        $res=mysqli_query($link,$sel);
        echo '<span class="label label-info">Watch our pictures</span>';
        echo'<ul id="gallery">';
        $i=0;
        while($row=mysqli_fetch_array($res,MYSQL_NUM)){
        echo ' <li><img src="../'.$row[0].'"></li>';
        }
        mysqli_free_result($res);
        echo ' </ul>';
        for ($i=0; $i<$hstars; $i++)
        {
            echo '<image src="../images/star.png" alt="star">';
        }
    }
$hotelid=$_GET['hotel'];
'SELECT * FROM hotels WHERE ID='. $hotelid;
'SELECT * FROM images WHERE hotelID='. $hotelid;