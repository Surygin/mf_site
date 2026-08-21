<?php

include ('db-connect.php');

$db = new queryBuilder($pdo);

$kids = $db->get_all('docs');

//var_dump($kids);

#$id_list = [];

#foreach($kids as $doc){
  //$docs = $db->get_all('docs', $doc['kids_id']);
  //var_dump($docs); echo '<br><br><br>';
  //var_dump($doc); echo '<br><br><br>';
  //echo $doc['kids_id'];
#  array_push($id_list, $doc['kids_id']);
#}

#echo json_encode($id_list, JSON_UNESCAPED_UNICODE);

echo json_encode($kids, JSON_UNESCAPED_UNICODE);

?>