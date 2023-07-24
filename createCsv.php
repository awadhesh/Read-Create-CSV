<?php require_once'db.php';
// get Users
$query = "SELECT * FROM foam_product";
if (!$result = mysqli_query($db, $query)) {
    exit(mysqli_error($db));
}

$users = array();
$dummyArr = array();
$i=0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
		$dummyArr[] = $row;
		$fid = $row['sku'];
		if(empty($row['sku'])) $fid = 'FMA0'.''.$row['id'].''.$row['thickness'].''.$row['length'].''.$row['width'].''.$row['pack'];
        $users[$i]['id'] = $fid;
		$name = $row['thickness'] .'" Thickness x '.$row['width'] .'" Width x '.$row['length'].'" Length '.$row['title'];
		$users[$i]['title'] = $name;
		$users[$i]['description'] = $row['description'];
		$users[$i]['link'] = 'https://www.foamma.com/product_in_details.php?prod='.base64_encode($row['id']);
		$users[$i]['price'] = $row['price'];
		$users[$i]['photo'] = str_replace('../', 'https://www.foamma.com/', $row['photo']);
		$i++;
		
    }
}
//echo '<pre>';
//print_r($dummyArr);
//print_r($users);
//die;
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Users.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('id', 'title', 'description', 'link', 'price', 'image link'));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
?>