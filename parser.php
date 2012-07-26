<?php
	ini_set("display_errors",1);
	include './simple_html_dom.php';
	header("Content-type: application/json");

	$html = new simple_html_dom();
	$html->load_file("http://www.missingkids.com/missingkids/servlet/PubCaseSearchServlet?act=viewPoster&caseNum=".$_GET['id']."&orgPrefix=NCMC&searchLang=en_US");  
	
$count = 0;

echo $_GET['callback'];
echo "({";
foreach($html->find('font') as $element) {
	$count++;
	if($count == 1){?>"caseType" : "<?php echo clean($element->innertext); ?>",<?php }else{}
	if($count == 2){?>"name" : "<?php echo clean($element->innertext); ?>",<?php }else{}
	if($count == 4){?>"dob" : "<?php echo clean($element->innertext); ?>",<?php }else{}
	if($count == 6){?>"ageNow" : "<?php echo clean($element->innertext); ?>",<?php }else{}
	if($count == 8){?>"missingDate" : "<?php echo clean($element->innertext); ?>",<?php }else{}
	if($count == 10){
		
		$exp = explode("<br>", $element);
		?>"missingCity" : "<?php echo clean($exp[0]); ?>",<?php
		
		?>"missingState" : "<?php echo clean($exp[1]); ?>",<?php
		?>"missingCountry" : "<?php echo clean($exp[2]); ?>",<?php
		
		
		 }else{}
	if($count == 12){?>"sex" : "<?php echo clean($element->innertext); ?>",<?php }else{}
	if($count == 14){?>"race" : "<?php echo clean($element->innertext); ?>",<?php }else{}
	if($count == 16){?>"hairColor" : "<?php echo clean($element->innertext); ?>",<?php }else{}
	if($count == 18){?>"eyesColor" : "<?php echo clean($element->innertext); ?>",<?php }else{}
	if($count == 20){?>"height" : "<?php echo clean($element->innertext); ?>",<?php }else{}
	if($count == 22){?>"weight" : "<?php echo clean($element->innertext); ?>",<?php }else{}
	/*
?>

{

	"image" : "<?php echo $b[1]; ?>",
	"dob" : "<?php echo $b[2]; ?>",
	"age" : "<?php echo $b[3]; ?>",
	"missing_date" : "<?php echo $b[4]; ?>",
	"missing_city" : "<?php echo $b[5]; ?>",
	"missing_state" : "<?php echo $b[6]; ?>",
	"missing_country" : "<?php echo $b[7]; ?>",
	"sex" : "<?php echo $b[8]; ?>",
	"race" : "<?php echo $b[9]; ?>",
	"hair" : "<?php echo $b[10]; ?>",
	"eyes" : "<?php echo $b[11]; ?>",
	"height" : "<?php echo $b[12]; ?>",
	"weight" : "<?php echo $b[13]; ?>",
	"image_progressed" : "<?php echo $b[14]; ?>"

}

<?php*/
	
}
 
 $newcount = 0;
foreach($html->find('img') as $element) {
	$newcount++;
	if($newcount == 1){?>"profileImage" : "<?php echo clean($element->src); ?>"<?php }else{}
	
	}
 echo "})";
 
function clean($m){
	
	$m = str_replace("    ", "", $m);
	$m = str_replace("&nbsp;", "", $m);
	$m = str_replace("<b>", "", $m);
	$m = str_replace("</b>", "", $m);
	$m = str_replace('<font size="3">', "", $m);  
	$m = str_replace("</font>", "", $m);
	$m = str_replace("  ", "", $m);
	
	return $m;
}

?>

