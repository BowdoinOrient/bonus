<?
// Encode data

if($issue_date && isset($issue) && isset($articles)) {
	echo json_encode(array('issue_date' => $issue_date, 'issue_details' => $issue, 'articles' => $articles));
}
else
	echo json_encode(array('error' => true));
?>