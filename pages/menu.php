<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
  <div class="navbar-nav">
    <a class="nav-link active" aria-current="page" href="index.php?page=1">Туры</a>
    <a class="nav-link" href="index.php?page=2">Комментарии</a>
    <a class="nav-link" href="index.php?page=3">Регистрация</a>
    <a class="nav-link" href="index.php?page=4">Консоль администратора</a>
    <a class="nav-link" href="index.php?page=8">Информация</a>
    <a class="nav-link" href="index.php?page=7"><button value="AddSector">Добавить страну</button></a>
    <?php 
    $host='localhost';
    $user='root';
    $pass='1469023578';
    $dbname='hotels';
   $link=mysqli_connect($host,$user,$pass) or die('connection error');
   mysqli_select_db($link,$dbname) or die('DB open error');
   $sel='SELECT * FROM cities';
   $res=mysqli_query($link,$sel);
   if (mysqli_num_rows($res)!=0)
    echo '<a class="nav-link" href="index.php?page=7"><button value="AddCategory">Добавить город</button></a>';
  else echo '<a class="nav-link" href="index.php?page=1"><button value="AddCategory" disabled>Добавить город</button></a>';
  $sel='SELECT * FROM hotels';
   $res=mysqli_query($link,$sel);
   if (mysqli_num_rows($res)!=0)
    echo '<a class="nav-link" href="index.php?page=7"><button value="AddProduct">Добавить отель</button></a>';
  else echo '<a class="nav-link" href="index.php?page=1"><button value="AddProduct" disabled>Добавить отель</button></a>';
      if(isset($_SESSION['radmin']))
      {
        if($page==6)
          $c='active';
        else
          $c='';
        echo '<li class="'.$c.'"><a href="index.php?page=6">Private</a></li>';
      }
    ?>
