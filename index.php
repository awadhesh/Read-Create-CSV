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
echo "Connected successfully";
if (($handle = fopen("80001_articles_temp.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
	$fin ='';
    for ($c=0; $c < $num; $c++) {
        $fin= $data[0];
		if($data[1])$fin.= '/'.$data[1];
		if($data[2])$fin.= '/'.$data[2];
		if($data[3])$fin.= '/'.$data[3];
		if($data[4])$fin.= '/'.$data[4];
		if($data[5])$fin.= '/'.$data[5];
		if($c ==5)
		{
			echo $fin. "<br />\n";
			$sql = "INSERT INTO categorypath (path) VALUES ('$fin')";

			if ($conn->query($sql) === TRUE) {
			  echo "New record created successfully";
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		
    }
  }
  fclose($handle);
}
$csv = array_map('str_getcsv', file('80001_articles_temp.csv'));
echo '<pre>';
print_r($csv);
 ?>

