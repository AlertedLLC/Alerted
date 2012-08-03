<?php
	ini_set("display_errors",1);
	include './simple_html_dom.php';
	header("Content-type: application/json");

	$html = new simple_html_dom();
	$html->load_file("http://www.missingkids.com/missingkids/servlet/PubCaseSearchServlet?act=viewPoster&caseNum=".$_GET['id']."&orgPrefix=NCMC&searchLang=en_US");  
	
$count = 0;
foreach($html->find('table') as $element) {
	$count++;
	if($count == 2){
	$m = $element->innertext;
	$m = str_replace('<tr>        <td width="32%" align="center" nowrap>          <font size="5"><b>', "", $m);	
	$m = str_replace('</b></font><br>              <img src="', "##", $m);	
	$m = str_replace('" width="280" height="350">           </td>       <td width="18%" valign="center" nowrap>              <p>                    <font size="3" color="#FF0000"><b>DOB:</b></font>             <font size="3">', "##", $m);
	$m = str_replace('</font><br>                       <font size="3" color="#FF0000"><b>Age Now:</b></font>             <font size="3">', "##", $m);	
	$m = str_replace('</font><br>                 <font size="3" color="#FF0000"><b>Missing:</b></font>          <font size="3">', "##", $m);		
	$m = str_replace('</font><br>          <font size="3" color="#FF0000"><b>Missing From:</b></font><br>          <font size="3">                          &nbsp;&nbsp;&nbsp;', "##", $m);		
	$m = str_replace('<br>                                    &nbsp;&nbsp;&nbsp;', "##", $m);				
	$m = str_replace('<br>                          &nbsp;&nbsp;&nbsp;', "##", $m);		
	$m = str_replace('</font><br>           <font size="3" color="#FF0000"><b>Sex:</b></font>          <font size="3">', "##", $m);		
	$m = str_replace('</font><br>                          <font size="3" color="#FF0000"><b>Race:</b></font>                <font size="3">', "##", $m);		
	$m = str_replace('</font><br>                    <font size="3" color="#FF0000"><b>Hair:</b></font>          <font size="3">', "##", $m);		
	$m = str_replace('</font><br>          <font size="3" color="#FF0000"><b>Eyes:</b></font>          <font size="3">', "##", $m);		
	$m = str_replace('</font><br>                           <font size="3" color="#FF0000"><b>Height:</b></font>                <font size="3">', "##", $m);		
   	$m = str_replace('</font><br>                <font size="3" color="#FF0000"><b>Weight:</b></font>                <font size="3">', "##", $m);		
	$m = str_replace('</font>                     </td>        <td width="32%" align="center" nowrap>          <font size="5"><b>Age Progressed&nbsp;##', "##", $m);		 
	$m = str_replace('" width="280" height="350">           </td>       <td width="18%" valign="center" nowrap>           </td>     </tr> ', "", $m);		    

	$b = explode("##", $m);
	
?>

{

	"name" : "<?php echo $b[0]; ?>",
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

<?php
	}
}
 
 
function clean($m){
	
	$m = str_replace("    ", "", $m);
	$m = str_replace("&nbsp;", "", $m);
	
	return $m;
}

?>

