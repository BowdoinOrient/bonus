<?
// Encode data

echo json_encode($issue_date);
if(isset($issue) && isset($articles)) {
	echo json_encode($issue);
	echo json_encode($articles);
}
else
	echo json_encode(array('error' => true));
?>