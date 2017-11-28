<?php
define('MAIN', true);
require_once "lib.inc.php";
?>
<?php
$val = explode(".", $_GET['q']);
$q = $val[0];
$y = $val[1];
$o = new FichasPorOrganismo($q);
$organismo = $o->getOrganismo(); 
$conn = new DBConnection();
if ($conn->getLink()){
	$conn->setKeyword($organismo);
	$conn->processOrganismoQuery($y);
	$conn->processOrganismoResult();
}

?>
