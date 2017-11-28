<?php
define('MAIN', true);
require_once "lib.inc.php";
?>
<?php
$conn = new DBConnection();
$link = $conn->getLink();
echo "<ul>";
$sql = "SELECT * FROM cavelier_consultas WHERE criterios LIKE '" . $_POST['q'] . "%' order by criterios asc";
$rs = mysql_query($sql, $link);
while($data = mysql_fetch_assoc($rs)) {
echo "<li id=\"" . $data['id'] . "\">" . $data['criterios'] . "</li>";
}
echo "</ul>";
?>