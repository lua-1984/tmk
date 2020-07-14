<?php
session_start();

$zex = $_SESSION['zex'];
$marka = $_SESSION['marka'];
$diametr = $_SESSION['diametr'];
$stenka = $_SESSION['stenka'];

require_once 'connect.php';
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
	
if (!empty($_SESSION['zex'])) 
{
//---------------------------------------------------------------------------------------------------------------------------------------------------------
$query ="SELECT * FROM zagolovok WHERE zex='$zex'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

if($result)
{
    $rows = mysqli_num_rows($result); 

    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
		echo "<table>";
		echo "<tr><td>Номер заказа</td><td>Цех-производитель</td><td>Дата начала</td><td>Дача окончания</td><td>Статус</td><td>Действия</td></tr>";
		echo "<tr>";
			echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td>";
			echo "<td>$row[3]</td>";
			echo "<td>$row[4]</td>";
			echo "<td>$row[5]</td>";
		echo "<td><form action='edit.php'><input type='hidden' name='id'value='$row[0]'/><button type='submit'>Редактировать</button></form><br>
		<form method='post'><input type='hidden' name='del_zag'value='$row[0]'/><button type='submit'>Удалить</button></form></td>";
        echo "</tr>";
//-------------------------Позиции-------------------------------------------		
		$query1 ="SELECT * FROM pozic WHERE id_unig='$row[0]'";
		$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
		$rows1 = mysqli_num_rows($result1);
		
		for ($y = 0 ; $y < $rows1 ; ++$y)
    {
        $row1 = mysqli_fetch_row($result1);
		echo "<tr><td>Номер позиции заказа</td><td>Марка стали </td><td>Диаметр</td><td>Стенка</td><td>Объем позиции заказа</td><td>Единица измерения</td><td>Статус</td><td>Действия</td></tr>";
		echo "<tr>";
			echo "<td>$row1[1]</td>";			
			$query2 ="SELECT name FROM stall WHERE id='$row1[2]'";
			$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
			$row2 = mysqli_fetch_row($result2);			
            echo "<td>$row2[0]</td>";
			echo "<td>$row1[3]</td>";
			echo "<td>$row1[4]</td>";
			echo "<td>$row1[5]</td>";
			echo "<td>$row1[6]</td>";
			echo "<td>$row1[7]</td>";
		echo "<td><form method='post'><input type='hidden' name='del_poz' value='$row1[0]'/><button type='submit'>Удалить</button></form></td>";
        echo "</tr>";
		
	}	    echo "</table><br>";
	
    }
	
echo "<p><center><form action='index.php'><input type='hidden'/><button type='submit'>Назад</button></form></center>";
     

	mysqli_close($link);

}	

//---------------------------------------------------------------------------------------------------------------------------------------------------------	
}
else {
	if (empty($diametr) AND empty($stenka)) {$query ="SELECT * FROM pozic WHERE marka='$marka'";}
	elseif (!empty($diametr) AND empty($stenka)) {$query ="SELECT * FROM pozic WHERE (marka='$marka') AND (diametr='$diametr')";}
	elseif (empty($diametr) AND !empty($stenka)) {$query ="SELECT * FROM pozic WHERE (marka='$marka') AND (stenka='$stenka')";}
	else {$query ="SELECT * FROM pozic WHERE (marka='$marka') AND (stenka='$stenka') AND (diametr='$diametr')";}
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

if($result)
{
    $rows = mysqli_num_rows($result); 

    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
		
		$query1 ="SELECT * FROM zagolovok WHERE id='$row[8]'";
		$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
		$row1 = mysqli_fetch_row($result1);
		
		echo "<table>";
		echo "<tr><td>Номер заказа</td><td>Цех-производитель</td><td>Дата начала</td><td>Дача окончания</td><td>Статус</td><td>Действия</td></tr>";
		echo "<tr>";
			echo "<td>$row1[1]</td>";
            echo "<td>$row1[2]</td>";
			echo "<td>$row1[3]</td>";
			echo "<td>$row1[4]</td>";
			echo "<td>$row1[5]</td>";
		echo "<td><form action='edit.php'><input type='hidden' name='id'value='$row1[0]'/><button type='submit'>Редактировать</button></form><br>
		<form method='post'><input type='hidden' name='del_zag'value='$row1[0]'/><button type='submit'>Удалить</button></form></td>";
        echo "</tr>";
//-------------------------Позиции-------------------------------------------		

		echo "<tr><td>Номер позиции заказа</td><td>Марка стали </td><td>Диаметр</td><td>Стенка</td><td>Объем позиции заказа</td><td>Единица измерения</td><td>Статус</td><td>Действия</td></tr>";
		echo "<tr>";
			echo "<td>$row[1]</td>";			
			$query2 ="SELECT name FROM stall WHERE id='$row[2]'";
			$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
			$row2 = mysqli_fetch_row($result2);			
            echo "<td>$row2[0]</td>";
			echo "<td>$row[3]</td>";
			echo "<td>$row[4]</td>";
			echo "<td>$row[5]</td>";
			echo "<td>$row[6]</td>";
			echo "<td>$row[7]</td>";
		echo "<td><form method='post'><input type='hidden' name='del_poz' value='$row[0]'/><button type='submit'>Удалить</button></form></td>";
        echo "</tr>";
		
	}	    echo "</table><br>";
echo "<p><center><form action='index.php'><input type='hidden'/><button type='submit'>Назад</button></form></center>";	
    }
}
     	

if($_POST['del_poz']){
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
	
$id = $_POST['del_poz'];

$query ="DELETE FROM pozic WHERE id = '$id'";  
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 


mysqli_close($link);
echo '<meta http-equiv="refresh" content="0">';


}

if($_POST['del_zag']){
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
	
$id = $_POST['del_zag'];
$query ="DELETE FROM zagolovok WHERE id = '$id'";  
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

$query ="DELETE FROM pozic WHERE id_unig = '$id'";  
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 


mysqli_close($link);
echo '<meta http-equiv="refresh" content="0">';
}
?>
<style type="text/css">
   TABLE {
    border-collapse: collapse; /* Убираем двойные линии между ячейками */
    width: 90%; /* Ширина таблицы */
   }
   TH { 
    background: #fc0; /* Цвет фона ячейки */
    text-align: left; /* Выравнивание по левому краю */
   }
   TD {
    background: #fff; /* Цвет фона ячеек */
    text-align: center; /* Выравнивание по центру */
   }
   TH, TD {
    border: 2px solid black; /* Параметры рамки */
    padding: 4px; /* Поля вокруг текста */
   }
   h1 {
   text-align: center;
   }
  </style>      