<?php $row = 1;
$servername = "localhost";
$username = "root";
$password = "";
$db ="categories";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if (($handle = fopen("80001_articles_temp.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
    for ($c=0; $c < $num; $c++) {
		echo $data[$c] . "<br />\n";
		$pro_num = $data[$c];
		$str = floatval(str_replace(',','.',$data[$c]));
        echo $str . "<br />\n";
		//$str = "Hello world. It's a beautiful day.";
		if($str !=''){
		//$aar = explode(";",$data[$c]);
		//echo $fin = $aar[0];
		//}
		$sql = "INSERT INTO pro_ean (product_number,ean) VALUES ('$pro_num','$str')";

			if ($conn->query($sql) === TRUE) {
			  echo "New record created successfully";
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
		}
		}
    }
  }
  fclose($handle);
} ?>

