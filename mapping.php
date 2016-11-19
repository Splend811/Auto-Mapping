<!DOCTYPE html>
<html>
<head>
	<title>Read list</title>
</head>
<body>
<div id = "frm">
<?php
// define variables
//$addresses = "";
if(empty($_POST['addresses'])){
	$addresses = "";
}
else{
	$addresses = htmlspecialchars($_POST['addresses']);
}

function DbMapping($data){

$singelArray = explode("\t", $data); //Splite source address, destination address and signal type
preg_match('/([a-zA-Z][a-zA-Z][0-9]{1,})\.(.+)/', $singelArray[0], $sourceAddressGroup);
preg_match('/([a-zA-Z][a-zA-Z][0-9]{1,})\.(.+)/', $singelArray[1], $destinationAddressGroup);

switch (strtolower($singelArray[2])) {
	case "int":
		$sourceAddressGroup[2] = preg_replace("[^0{1,3}]", "DBW", $sourceAddressGroup[2]);
		$destinationAddressGroup[2] = preg_replace("[^0{1,3}]", "DBW", $destinationAddressGroup[2]);
		echo "L ".$sourceAddressGroup[1].".".$sourceAddressGroup[2]."<br>";
		echo "T ".$destinationAddressGroup[1].".".$destinationAddressGroup[2]."<br>";
		break;
	case "real":
		$sourceAddressGroup[2] = preg_replace("[^0{1,3}]", "DBD", $sourceAddressGroup[2]);
		$destinationAddressGroup[2] = preg_replace("[^0{1,3}]", "DBD", $destinationAddressGroup[2]);
		echo "L ".$sourceAddressGroup[1].".".$sourceAddressGroup[2]."<br>";
		echo "T ".$destinationAddressGroup[1].".".$destinationAddressGroup[2]."<br>";
		break;
	case "byte":
		$sourceAddressGroup[2] = preg_replace("[^0{1,3}]", "DBB", $sourceAddressGroup[2]);
		$destinationAddressGroup[2] = preg_replace("[^0{1,3}]", "DBB", $destinationAddressGroup[2]);
		echo "L ".$sourceAddressGroup[1].".".$sourceAddressGroup[2]."<br>";
		echo "T ".$destinationAddressGroup[1].".".$destinationAddressGroup[2]."<br>";
		break;
	default:
		$sourceAddressGroup[2] = preg_replace("[^0{1,3}]", "DBX", $sourceAddressGroup[2]);
		$destinationAddressGroup[2] = preg_replace("[^0{1,3}]", "DBX", $destinationAddressGroup[2]);
		echo "A ".$sourceAddressGroup[1].".".$sourceAddressGroup[2]."<br>";
		echo "= ".$destinationAddressGroup[1].".".$destinationAddressGroup[2]."<br>";
		break;
	}
	return;
}

?>


<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
<textarea name = "addresses" rows="5" cols="40"><?php echo $addresses;?></textarea>
	<br></br>
<input type="submit" name="submit" value="Submit"> 

</form>
<input type="reset" value="Reset"></br>

<?php


if (!empty($_POST['addresses'])) {

$arrayRow = explode("\r\n", $addresses);
//var_dump($arrayRow);

$i = 0;
while (!empty($arrayRow[$i])) {
//echo $arrayRow[$i]."<br>";

DbMapping($arrayRow[$i]);
$i++;

}



//$singelArray = array();


// $singelArray = explode("\t", $arrayRow[1]);
// var_dump ($singelArray);

// preg_match('/([a-zA-Z][a-zA-Z][0-9]{1,})\.(.+)/', $singelArray[0], $dbAddressArray);
// switch ($singelArray[2]) {
// 	case "Int" or "int":
// 		$dbAddressArray[2] = preg_replace("[^0{1,3}]", "DBW", $dbAddressArray[2]);
// 		break;
	
// 	default:
// 		$dbAddressArray[2] = preg_replace("[^0{1,3}]", "DBD", $dbAddressArray[2]);
// 		break;
// }

// echo "L ".$dbAddressArray[1].".".$dbAddressArray[2];


// $str = "DB361.0002 DB361.0101 Int" ;
// $strArray = explode(" ", $str);
// var_dump($strArray);

}
?>
	


</div>


</body>
</html>