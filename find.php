<?php
		session_start();
		


if($_POST['submit1']){
	
	$zex = $_POST['zex'];
	
	if(!empty($zex)) 
	{
		
		$_SESSION['zex'] = $_POST['zex'];
		header("Location: finding.php");
	}
	else {echo "<script>alert('Вы не заполнили цех-производитель');</script>";}
	}

if($_POST['submit']){

		$_SESSION['zex'] ='';
		$_SESSION['marka'] = $_POST['m0'];
		$_SESSION['diametr'] = $_POST['d0'];
		$_SESSION['stenka'] = $_POST['s0'];	
		header("Location: finding.php");

	}

if($_POST['submit2']){
		
		header("Location: index.php");
		exit;
	
}
?>

<html>
<head>
	<meta http-equiv="Content-Type"/>
	<title>Поиск</title>
	<link href="css/style1.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
</head>
<body>
<div id="wrapper">	
<form name="login-form" class="login-form" action="" method="post">
<input type="hidden" name="x" id="x" value="1">
    <div class="header">
		<h1>Поиск</h1>
	</div>
    <div class="content">
		<span>Цех-производитель</span>
		<input name="zex" type="text" class="input username">
		 <div class="footer">
	<center>	<input type="submit" name="submit1" value="Поиск" class="button" />
	</div>
	</div>		
    <div class="header">
		<h1>Целевые характеристики</h1>
	</div>
    <div class="content">	    
	<table id="tbl" cellspacing="0" cellpadding="4" width= "100%" border >	
	<tr>
	<td style="width: 33%;"><span>Марка стали</span></td>
	<td style="width: 33%;"><span>Диаметр</span></td>
	<td style="width: 33%;"><span>Стенка</span></td>
	</tr>
	<tr>
   <td><select  name="m0" size="1" class="input username">
   <?php 
   require_once 'connect.php';
   $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$query ="SELECT * FROM stall";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$rows = mysqli_num_rows($result);
for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
		if ($row[0]==0) {echo "<option selected value='$row[0]'>$row[1]</option>";}
			else {echo "<option value='$row[0]'>$row[1]</option>";} 
} 
mysqli_free_result($result);
mysqli_close($link);
   ?>
</select>
	<td><input name="d0" type="text" class="input username"></td>
	<td><input name="s0" type="text" class="input username"></td>
	</tr>
	
</table>
 
</div>			
	</body>
    <div class="footer">
	<center>	<input type="submit" name="submit" value="Поиск" class="button" />
				<input type="submit" name="submit2" value="Назад" class="button" />
	</div>
</form>
</div>
</html>