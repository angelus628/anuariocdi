<?php
define('MAIN', true);
require_once "lib.inc.php";
?>
<?php
for ($i=0;$i<=37;$i++){
$val = explode(".", $q);
$q = $i;
//$y = $val[1];
$o = new FichasPorOrganismo($q);
$organismo = $o->getOrganismo(); 
$conn = new DBConnection();
if ($conn->getLink()){
echo "<font color='red'>Id $i</font>" .$organismo;
	$conn->setKeyword($organismo);
	$conn->processOrganismoQuery($y);
	$conn->processOrganismoResult();
}
}
?>
