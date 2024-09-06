<?
require("config.php");

$data = date("d/m/Y");

header('Content-type: text; charset=utf-8');
header('Content-Disposition: attachment; filename=newsletter_'.$data.'.csv');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');

$query = $db->get_results("SELECT * FROM ".$tables['NEWSLETTER']." ORDER BY email ASC");

$i = 0;
foreach($query as $rs) {
	$list[$i] = utf8_decode($rs->email);
	$i++;
}
print implode("\r\n",$list);
?>