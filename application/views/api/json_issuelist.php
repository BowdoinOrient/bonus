<?
// Encode data
if(isset($issues)) {
	echo json_encode($issues);
}
else
	echo json_encode(array('error' => true));
?>