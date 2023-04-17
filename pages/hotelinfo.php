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
    $host='localhost';
        $user='root';
        $pass='1469023578';
        $dbname='hotels';
        $link=mysqli_connect($host,$user,$pass) or die('connection error');
        mysqli_select_db($link,$dbname) or die('DB open error');
        $sel='SELECT * FROM hotels';
        $res=mysqli_query($link,$sel);
        $row=mysqli_fetch_array($res,MYSQLI_NUM);
        echo '<select name="hotel" class="select" width="100%">';
        while ($row=mysqli_fetch_array($res,MYSQLI_NUM)) {
            echo '<option>'.$row[1].'</option>';
        }
        echo '</select>';
        mysqli_free_result($res);
    if(isset($_GET['hotel'])){
        $sel='SELECT * FROM hotels WHERE Hotel='. $_GET['hotel'];
        $res=mysqli_query($link,$sel);
        $row=mysqli_fetch_array($res,MYSQLI_NUM);
        echo '<table><tr>';
        for ($i=0;$i<mysqli_num_rows($res);$i++) {
            echo '<td>'.$row[$i].'</td>';
        }
        echo '</tr></table>';
        $hid=$row[0];
        mysqli_free_result($res);
        $sel='SELECT UserID,Comment FROM comments WHERE HotelID='. $hid;
        $res=mysqli_query($link,$sel);
        $row=mysqli_fetch_array($res,MYSQLI_NUM);
        for ($i=0;$i<mysqli_num_rows($res);$i++) {
            echo '<h1>'.$row[$i][0].'</h1>';
            echo '<p>'.$row[$i][1].'</p>';
        }
    }
?>
