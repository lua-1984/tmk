<?php
require_once 'connect.php'; 
$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link)); 		
$id = htmlentities(mysqli_real_escape_string($link, $_GET['id']));
// echo $id;
$query ="SELECT * FROM zagolovok WHERE id='$id'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

$rows = mysqli_num_rows($result); 
for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
	$number = $row[1];
	$zex = $row[2];
	$date_start = $row[3];
	$date_finish = $row[4];
	$status=$row[5];
	}

if($_POST['submit']){
//Данные заголовка
	$number = $_POST['Number'];
	$zex = $_POST['zex'];
	$date_start = $_POST['date_start'];
	$date_finish = $_POST['date_finish'];
	$status=$_POST['status'];
	
	$query ="UPDATE zagolovok SET number='$number',zex='$zex',date_start='$date_start',date_finish='$date_finish',status='$status' WHERE id='$id'";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
	
//данные позиций	
$query1 ="SELECT * FROM pozic WHERE id_unig = '$id'";
    $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link));
    $rows1 = mysqli_num_rows($result1);
	
	for ($i = 0 ; $i < $rows1 ; ++$i)
   {
	$id_pozic = $_POST['name'.$i];
	$number = $_POST['n'.$i];
	$marka = $_POST['m'.$i];
	$diametr = $_POST['d'.$i];
	$stenka = $_POST['s'.$i];
	$obem = $_POST['o'.$i];
	$edinica = $_POST['e'.$i];
	$status = $_POST['ms'.$i];
		
	$query ="UPDATE pozic SET number='$number',marka='$marka',diametr='$diametr',stenka='$stenka',obem='$obem',edinica='$edinica',status='$status' WHERE id='$id_pozic'";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
	}
}
if($_POST['submit1']){
header("Location: index.php");
}
?>

<html>
<head>
	<meta http-equiv="Content-Type"/>
	<title>Редактирование позиции</title>
	<link href="css/style1.css" rel="stylesheet" type="text/css" />
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
		<input name="Number" type="text" class="input username" value="<?php echo $number; ?>">
		<span>Цех-производитель</span>
		<input name="zex" type="text" class="input username" value="<?php echo $zex; ?>">
		<span>Дата начала</span>
		<input name="date_start" type="text" class="input username" value="<?php echo $date_start; ?>">		
		<span>Дата окончания</span>
		<input name="date_finish" type="text" class="input username" value="<?php echo $date_finish; ?>">	
		<span>Статус</span>
		<select size="1" name="status" class="input username">
    <option selected value="<?php echo $status; ?>"><?php echo $status; ?></option>
	<?php
	if ($status != 'Новый') 	{ echo "<option value='Новый'>Новый</option>";}
    if ($status != 'В работе')	{ echo "<option value='В работе'>В работе</option>";}
    if ($status != 'Выполнен')	{ echo "<option value='Выполнен'>Выполнен</option>";}
	?>
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
   <?php 	
    $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));  
	
	$query1 ="SELECT * FROM pozic WHERE id_unig = '$id'";
    $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link));
    $rows1 = mysqli_num_rows($result1);
	for ($i = 0 ; $i < $rows1 ; ++$i)
    {
		$row1 = mysqli_fetch_row($result1);
		echo "<input type='hidden' name='name"; echo $i; echo "' value='"; echo $row1[0]; echo"'>";
	echo "<td><input name='n"; echo $i; echo "' type='text' class='input username' value='"; echo $row1[1]; echo"' ></td>
		<td><select  name='m"; echo $i; echo "'size='1' class='input username' value='"; echo $row1[2]; echo"'>";	
$summ=0;
$query2 ="SELECT * FROM stall";
$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link)); 
$rows2 = mysqli_num_rows($result2);
for ($y = 0 ; $y < $rows2 ; ++$y)
    {++$summ;
        $row2 = mysqli_fetch_row($result2);
		if ($row1[2]==$y) {echo "<option selected value='$row2[0]'>$row2[1]</option>";}
			else {echo "<option value='$row2[0]'>$row2[1]</option>";} 
} 
	
echo "</select>
	<td><input name='d"; echo $i; echo "' type='text' class='input username' value='"; echo $row1[3]; echo"'></td>
	<td><input name='s"; echo $i; echo "' type='text' class='input username' value='"; echo $row1[4]; echo"'></td>
	<td><input name='o"; echo $i; echo "' type='text' class='input username' value='"; echo $row1[5]; echo"'></td>
	<td><input name='e"; echo $i; echo "' type='text' class='input username' value='"; echo $row1[6]; echo"'></td>
	<td><select  name='ms"; echo $i; echo "' size='1' class='input username'>
	<option selected value='";echo $row1[7]; echo "'>"; echo $row1[7]; echo"</option>";
	if ($row1[7] != 'Новый') 	{ echo "<option value='Новый'>Новый</option>";}
    if ($row1[7] != 'В работе')	{ echo "<option value='В работе'>В работе</option>";}
    if ($row1[7] != 'Выполнен')	{ echo "<option value='Выполнен'>Выполнен</option>";}
 echo  "</select>  </td>
	</tr>";
}
   ?>
	
</table>
</div>		
	
	</body>
    <div class="footer">
	<center>	<input type="submit" name="submit" value="Сохранить" class="button" />
	<input type="submit" name="submit1" value="Назад" class="button" />
	</div>

</form>
</div>

</html>
