<?
// Encode data
if(isset($articles)) {
	foreach ($articles as $art) {
		$art->body = strip_tags($art->body);
	}
	echo json_encode($articles);
}
else
	echo json_encode(array('error' => true));
?>