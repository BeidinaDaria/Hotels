<?php 
include_once('functions.php');
$host='localhost';
$user='root';
$pass='1469023578';
$dbname='hotels';
$link=mysqli_connect($host,$user,$pass) or die('connection error');
mysqli_select_db($link,$dbname) or die('DB open error');
$ct1='CREATE TABLE countries(
ID int not null auto_increment primary key, 
Country varchar(64) unique
)default charset="utf8"';

$ct2='CREATE TABLE cities(
ID int not null auto_increment primary key, 
City varchar(64), 
CountryID int, 
foreign key(CountryID) references countries(ID) 
on delete cascade,
ucity varchar(128),
unique index ucity(City, CountryID))default charset="utf8"';

$ct3='CREATE TABLE hotels(
ID int not null auto_increment primary key, 
Hotel varchar(64), 
CityID int, 
foreign key(CityID) references cities(ID) on delete cascade, 
CountryID int, 
foreign key(CountryID) references countries(ID) on delete cascade, 
stars int, 
cost int,
info varchar(1024))default charset="utf8"';

$ct4='CREATE TABLE images(
	ID int not null auto_increment primary key,
	ImagePath varchar(255),
	HotelID int, 
	foreign key(HotelID) references hotels(ID) on delete cascade)
	default charset="utf8"';

$ct5='CREATE TABLE roles(
	ID int not null auto_increment primary key,
	Role varchar(32))default charset="utf8"';

$ct6='CREATE TABLE users(
	ID int not null auto_increment primary key,
	Login varchar(32) unique,
	Pass varchar(128),
	Email varchar(128),
	Discount int,
	RoleID int, 
	foreign key(RoleID) references roles(ID) on delete cascade,
	Avatar mediumblob
	)default charset="utf8"';

mysqli_query($link,$ct1);
$err=mysqli_errno($link);
if ($err){
	echo 'Error code 1:'.$err.'<br>';
	exit();
}
mysqli_query($link,$ct2);
$err=mysqli_errno($link);
if ($err){
	echo 'Error code 2:'.$err.'<br>';
	exit();
}
mysqli_query($link,$ct3);
$err=mysqli_errno($link);
if ($err){
	echo 'Error code 3:'.$err.'<br>';
	exit();
}
mysqli_query($link,$ct4);
$err=mysqli_errno($link);
if ($err){
	echo 'Error code 4:'.$err.'<br>';
	exit();
}
mysqli_query($link,$ct5);
$err=mysqli_errno($link);
if ($err){
	echo 'Error code 5:'.$err.'<br>';
	exit();
}
mysqli_query($link,$ct6);
$err=mysqli_errno($link);
if ($err){
	echo 'Error code 6:'.$err.'<br>';
	exit();
}