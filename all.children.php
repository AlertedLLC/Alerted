<?php
	ini_set("display_errors",1);
	$array = array(
		"MD",
		"VA");
		echo $_GET['callback'] . "(";
?>
{
	"children":
	[
<?php
		
for($i = 0; $i < 2; $i++){

	$current = $array[$i];
    $data = simplexml_load_file('http://www.missingkids.com/missingkids/servlet/XmlServlet?act=rss&LanguageCountry=en_US&orgPrefix=NCMC&state='.$current, null, true);   
 //   var_dump($data);
	foreach ($data->channel->item as $item){
		?>
		[{
			"location":"<?php echo doubleExplode($item->description); ?>",
			"id": "<?php echo giveMeMyURL($item->link); ?>"
		}]
		<?php
		if($i != 2){
			
		echo ","; 
		}else{}
	}
 
}


	echo "]})";
function clean($m){
	
	$m = str_replace("    ", "", $m);
	$m = str_replace("&nbsp;", "", $m);
	
	return $m;
}

function doubleExplode($n){
	$a = explode("Missing From ",$n);
	$b = explode(" ANYONE", $a[1]);
	return $b[0];
}

function giveMeMyURL($u){
	$u = str_replace("http://www.missingkids.com/missingkids/servlet/PubCaseSearchServlet?act=viewChildDetail&amp;LanguageCountry=en_US&amp;searchLang=en_US&amp;caseLang=en_US&amp;orgPrefix=NCMC&amp;caseNum=", "",$u);
	$u = str_replace("http://www.missingkids.com/", "",$u);
	$u = str_replace("&seqNum=1","",$u);
	$u = str_replace("&seqNum=2","",$u);
	$u = str_replace("act=viewChildDetail&LanguageCountry=en_US&searchLang=en_US&caseLang=en_US&orgPrefix=NCMC&caseNum=","",$u);
	$u = str_replace("missingkids/servlet/PubCaseSearchServlet?","",$u);
	return $u;
}

?>

 