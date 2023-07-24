<?php $row = 1;
$servername = "localhost";
$username = "root";
$password = "";
$db ="categories";
// Create connection
//$conn = new mysqli($servername, $username, $password,$db);

// Check connection
//if ($conn->connect_error) {
 // die("Connection failed: " . $conn->connect_error);
//}
if (($handle = fopen("wc-product-export-130.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
    for ($c=0; $c < $num; $c++) {
        echo $data[$c] . "<br />\n";
		//$str = "Hello world. It's a beautiful day.";
		//echo $data[0];
		$dir = $data[0];
		//if ( !is_dir( $dir ) ) {
			//mkdir( $dir, 0777, true);      
		//}
		mkdir("/new/".$data[0], 0777, true);
		if($data[$c] !='' && $c ==1){
			//echo $data[1];
		$aar = explode(", ",$data[1]);
		foreach($aar as $img)
		{
			//echo $img.'<br/>';
			
			if($img != 'Images'){
			$img_aar = explode("11",$img);
			echo $img_aar[1];
			$content = file_get_contents($img);
			$fp = fopen("$data[0]/$img_aar[1]", "w+");
			fwrite($fp, $content);
			fclose($fp);
			}
		}
		//echo $fin = $aar[0];
		}
		//$sql = "INSERT INTO pro_images (images) VALUES ('$fin')";

			//if ($conn->query($sql) === TRUE) {
			 // echo "New record created successfully";
			//} else {
			 // echo "Error: " . $sql . "<br>" . $conn->error;
			//}
    }
  }
  fclose($handle);
} ?>

