<?
// Encode data
if(isset($volumes)) {
	echo json_encode($volumes);
}
else
	echo json_encode(array('error' => true));
?>