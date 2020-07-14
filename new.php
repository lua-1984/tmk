<?php

require_once 'connect.php';
// берем уникальный номер заказа
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

$query ="SELECT id_uniq FROM id_uniq";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{	
	$row = mysqli_fetch_row($result);
	$id_uniq = $row[0];
	}
if($_POST['submit1']){
header("Location: index.php");
}

if($_POST['submit']){
//Данные заголовка
	$number = $_POST['Number'];
	$zex = $_POST['zex'];
	$date_start = $_POST['date_start'];
	$date_finish = $_POST['date_finish'];
	$status=$_POST['status'];
	
	$query ="INSERT INTO zagolovok VALUES('$id_uniq','$number','$zex','$date_start','$date_finish','$status')";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
//Максимальный id в позициях
	$query ="SELECT MAX(id) FROM pozic";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
	$row = mysqli_fetch_row($result);
	if(!empty($row[0])) 
	{$max_id = $row[0];}
	else {$max_id=0;}
	++$max_id;
	
//данные позиций	
	$x = $_POST['x'];
	for ($i = 0 ; $i < $x ; ++$i)
    {
	$number = $_POST['n'.$i];
	$marka = $_POST['m'.$i];
	$diametr = $_POST['d'.$i];
	$stenka = $_POST['s'.$i];
	$obem = $_POST['o'.$i];
	$edinica = $_POST['e'.$i];
	$status = $_POST['ms'.$i];
		
	$query ="INSERT INTO pozic VALUES('$max_id','$number','$marka','$diametr','$stenka','$obem','$edinica','$status','$id_uniq')";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
		++$max_id;
	}
	
//увеличиваем на 1 уникальный номер и записываем
++$id_uniq;
$query ="UPDATE id_uniq SET id_uniq=$id_uniq WHERE id=0";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 



}	
?>

<html>
<head>
	<meta http-equiv="Content-Type"/>
	<title>Новая позиция</title>
	<link href="css/style1.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
</head>
<body>
<div id="wrapper">	
<form name="login-form" class="login-form" action="" method="post">
<input type="hidden" name="x" id="x" value="1">
    <div class="header">
		<h1>Заголовок</h1>
	</div>

    <div class="content">
		<span>Номер заказа</span>
		<input name="Number" type="text" class="input username">
		<span>Цех-производитель</span>
		<input name="zex" type="text" class="input username">
		<span>Дата начала</span>
		<input name="date_start" type="text" class="input username">		
		<span>Дата окончания</span>
		<input name="date_finish" type="text" class="input username">	
		<span>Статус</span>
		<select size="1" name="status" class="input username">
    <option selected value="Новый">Новый</option>
    <option value="В работе">В работе</option>
    <option value="Выполнен">Выполнен</option>
   </select>
	</div>		
    <div class="header">
		<h1>Позиции</h1>
	</div>
    <div class="content">	    
	<table id="tbl" cellspacing="0" cellpadding="4" width= "100%" border >
	
	<tr>
	<td style="width: 10%;"><span>Номер позиции заказа</span></td>
	<td style="width: 30%;"><span>Марка стали</span></td>
	<td style="width: 15%;"><span>Диаметр</span></td>
	<td style="width: 10%;"><span>Стенка</span></td>
	<td style="width: 10%;"><span>Объем позиции заказа</span></td>
	<td style="width: 10%;"><span>Единица измерения</span></td>
	<td style="width: 20%;"><span>Статус</span></td>
	</tr>
	<tr>
	
   <td><input name="n0" type="text" class="input username"></td>
   <td><select  name="m0" size="1" class="input username">
   <?php 
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
	<td><input name="o0" type="text" class="input username"></td>
	<td><input name="e0" type="text" class="input username"></td>
	<td><select  name="ms0" size="1" class="input username"><option selected value="Новый">Новый</option><option value="В работе">В работе</option><option value="Выполнен">Выполнен</option></select>
   </td>
	</tr>
	
</table>
 
<p><center><input type="button"  class="button" value="Добавить позицию" onclick="addRow ()" ></center>
</div>		
	
	</body>
    <div class="footer">
	<center>	<input type="submit" name="submit" value="Сохранить" class="button" />
		<center>	<input type="submit" name="submit1" value="Назад" class="button" />
	</div>

</form>
</div>

</html>
<script>
 
function addRow ()
{
	
	var xx = document.getElementById('x').value;
	++xx;
	document.getElementById('x').value = xx;
	
var ta = document.getElementById ('tbl');
var ro = ta.rows [ta.rows.length - 1];
var num = parseInt (ro.getElementsByTagName ('input') [0].name.substr (1)) + 1;
var num1 = parseInt (ro.getElementsByTagName ('select') [0].name.substr (1)) + 1;
newro = ro.cloneNode (1);
newro.getElementsByTagName ('input') [0].name = 'n' + num;
newro.getElementsByTagName ('input') [0].value = '';
newro.getElementsByTagName ('select') [0].name = 'm' + num1;
newro.getElementsByTagName ('select') [0].value = '';
newro.getElementsByTagName ('input') [1].name = 'd' + num;
newro.getElementsByTagName ('input') [1].value = '';
newro.getElementsByTagName ('input') [2].name = 's' + num;
newro.getElementsByTagName ('input') [2].value = '';
newro.getElementsByTagName ('input') [3].name = 'o' + num;
newro.getElementsByTagName ('input') [3].value = '';
newro.getElementsByTagName ('input') [4].name = 'e' + num;
newro.getElementsByTagName ('input') [4].value = '';
newro.getElementsByTagName ('select') [1].name = 'ms' + num1;
newro.getElementsByTagName ('select') [1].value = '';
ta.appendChild (newro);
}
</script>