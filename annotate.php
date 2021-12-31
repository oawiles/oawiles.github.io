<?php
	// Configurations
	$imagesPerPage = 60;
	
	$fileName = $_GET['fileName'];
	$lines = file($fileName);
	$imtot = count($lines)-2;
	$last = count($lines)-1;	
	$subname = $lines[0];
	if(array_key_exists('pNo',$_GET)){
		$pNo = $_GET['pNo'];
	}else{
		$pNo = 1;
	}

	if($pNo<1){
		$pNo = 1;
	}

	if($pNo>1+(count($lines)/($imagesPerPage))){
		$pNo = ceil((count($lines)-2)/$imagesPerPage);

	}

	$start = (($pNo-1)*$imagesPerPage+1);
	$end = $pNo*$imagesPerPage;

	if($end >= count($lines)){
		$end = count($lines)-2;
	}

	$prevPage = $pNo-1;
	$nextPage = $pNo+1;

	
	
	echo "
		<html>
        		<head>                 		<title>
                       			Annotation
                		</title>

				

                		<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
				<script type=\"text/javascript\">
				function changeAnno(id)
{

	p = document.getElementById('p'+id.toString()).checked;
	n = document.getElementById('n'+id.toString()).checked;
	s = document.getElementById('s'+id.toString()).checked;
	if(p == true){

		document.getElementById('i'+id.toString()).style.border = '5px solid red';
		document.getElementById('s'+id.toString()).checked = true;
	} else if (s == true){
		document.getElementById('i'+id.toString()).style.border = '5px solid yellow';
		document.getElementById('n'+id.toString()).checked = true;
	} else if (n == true){
		document.getElementById('i'+id.toString()).style.border = '5px solid green';
		document.getElementById('p'+id.toString()).checked = true;
	}else{
	}



}
				</script>
        		</head>
        		<body>
<div id=\"page\"><div id=\"header\"><table width=\"100%\" cellpadding=\"0\" cellspacing=\"10\" border=\"0\"><tr><td align=\"left\"><td width=\"100%\" align=\"center\"><h3>Annotation<br></h3></td> <td align=\"right\"> 
           </td>             </tr>             </table>        </div><div id=\"content\">
				<center>


					


				
					Page Number $pNo of ".ceil($imtot/$imagesPerPage)." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Showing images $start to $end";    			



	echo "			<form action=\"annotate.php\" method=\"get\">

				<input type='hidden' value='$fileName' name='fileName'>";

 	if(array_key_exists('Update',$_GET)){
		$update=$_GET['Update'];

	}else{
		$update = '';
	}



		$dict_gt = array();
		
		

		foreach($lines as $line){
			$line = trim($line);
			$ele = split(" ",$line);
			$img = $ele[0];
			$score = $ele[1];
			$gt = $ele[2];		
			$dict_gt[$img] = $gt;
			$timg = str_replace('.','_',$img);
			if(array_key_exists($timg,$_GET)){
				$dict_gt[$img] = $_GET[$timg];
			}	
		}	
	
		$fp = fopen($fileName,"w+");
		
		
		$lines[$last] =  trim($_GET["categ_name"]);
	
		
		
		//foreach($lines as $line){
		fwrite($fp, trim($subname)."\n");

		for ($ii = 1; $ii < $last; ++$ii ){
			$line = $lines[$ii];
			$line = trim($line);
			$ele = split(" ",$line);
			$img = $ele[0];
			$score = $ele[1];
			$gt = $dict_gt[$img];
			fwrite($fp,$img." ".$score." ".$gt."\n");
		}
		fwrite($fp, trim($_GET["categ_name"])."\n");
		fclose($fp);
		
		$lines = file($fileName);
	

	if($update == "green"){
		$dict_gt = array();
		
		

		foreach($lines as $line){
			$line = trim($line);
			$ele = split(" ",$line);
			$img = $ele[0];
			$score = $ele[1];
			$gt = $ele[2];		
			$dict_gt[$img] = $gt;
			$timg = str_replace('.','_',$img);
			if(array_key_exists($timg,$_GET)){
				$dict_gt[$img] = 1;
			}	
		}	
	
		$fp = fopen($fileName,"w+");
		
		
		$lines[$last] =  trim($_GET["categ_name"]);
	
		
		
		//foreach($lines as $line){
		fwrite($fp, trim($subname)."\n");

		for ($ii = 1; $ii < $last; ++$ii ){
			$line = $lines[$ii];
			$line = trim($line);
			$ele = split(" ",$line);
			$img = $ele[0];
			$score = $ele[1];
			$gt = $dict_gt[$img];
			fwrite($fp,$img." ".$score." ".$gt."\n");
		}
		fwrite($fp, trim($_GET["categ_name"])."\n");
		fclose($fp);
		
		$lines = file($fileName);
	}

	if($update == "red"){
		$dict_gt = array();
		
		

		foreach($lines as $line){
			$line = trim($line);
			$ele = split(" ",$line);
			$img = $ele[0];
			$score = $ele[1];
			$gt = $ele[2];		
			$dict_gt[$img] = $gt;
			$timg = str_replace('.','_',$img);
			if(array_key_exists($timg,$_GET)){
				$dict_gt[$img] = 0;
			}	
		}	
	
		$fp = fopen($fileName,"w+");
		
		
		$lines[$last] =  trim($_GET["categ_name"]);
	
		
		
		//foreach($lines as $line){
		fwrite($fp, trim($subname)."\n");

		for ($ii = 1; $ii < $last; ++$ii ){
			$line = $lines[$ii];
			$line = trim($line);
			$ele = split(" ",$line);
			$img = $ele[0];
			$score = $ele[1];
			$gt = $dict_gt[$img];
			fwrite($fp,$img." ".$score." ".$gt."\n");
		}
		fwrite($fp, trim($_GET["categ_name"])."\n");
		fclose($fp);
		
		$lines = file($fileName);
	}


	

       
	 


	echo"	<div class='content'></center>
<font size=\"5\">subject: $subname</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<table>
			<tr></b>";
        
	for($i=$start;$i<=$end;$i++){
        	if ($i%3==1){
                	echo "</tr>";
                	echo "<tr>";
		}
		$line = trim($lines[$i]);
		$ele = split(" ",$line);	
		$gt = $ele[2];
        	$score=$ele[1];
        	$img=$ele[0];
		$img = str_replace('_','_',$img);

		echo "<td>
        		<table><tr><td>";
        	if ($gt=='0'){
                	$color='red';
		}       
 		if($gt=='-1'){
                	$color='yellow';
        	}
		if($gt=='1'){
                	$color='green';
      		}
		echo "<img style=\"border:5px solid $color\" width=460 src='$img' onclick='changeAnno($i);' id='i$i'/>";
		echo "<tr><td><font size=\"1\">$score </font></td></tr></table><font size=1></font>";
		echo "<font color=green size=1></font><input TYPE=radio id=\"p$i\" name=\"$img\" style=display:none; value='1'";
        	if($gt=='1'){
                	echo "checked>";
        	}else{
                	print ">";
		}
        	echo "<font color=red size=1></font><input TYPE=radio id=\"n$i\" name=\"$img\" style=display:none; value='-1'";
        	if($gt=="-1"){
                	echo "checked>";
        	}else{
                	echo ">";
		}
        	echo "<font color=black size=1></font><input TYPE=radio id=\"s$i\" name=\"$img\" style=display:none; value='0'";
        	if($gt=='0'){
                	echo "checked>";
        	} else {
                	echo ">";

		}
		echo "</td>\n";
	}

		
	echo "<select name=\"pNo\">";

	for($i=1;$i<1+ceil($imtot/$imagesPerPage);$i++){ 
        	if($i==$pNo){
                	echo "<option value=\"$i\" selected=\"selected\">$i</option>";
        	}else{
                	echo "<option value=\"$i\">$i</option>";
		}
	}		
	echo "</select>
		<Button type='submit' value='Display'>Go to page</button>&nbsp;&nbsp;&nbsp;&nbsp;";

		if($pNo > '1'){

       	echo "<Button type='submit' name='pNo' value='$prevPage'>Previous Page</button>&nbsp;&nbsp;&nbsp;&nbsp;";
}
echo"
		<Button type='submit' name='pNo' value='$pNo'>Save Page</button>&nbsp;&nbsp;&nbsp;&nbsp;
		<button type='submit' name='Update' value='green'>Make Page Green</button>&nbsp;&nbsp;&nbsp;&nbsp;
		<Button type='submit' name='Update' value='red'>Make Page Red</button>&nbsp;&nbsp;&nbsp;&nbsp;
";
	



		if($pNo < ceil($imtot/$imagesPerPage)){
        	echo"<Button type='submit' name='pNo' value='$nextPage'>Next Page</button>";


}


echo"</table><center>


";


		if($pNo > '1'){

       	echo "<Button type='submit' name='pNo' value='$prevPage'>Previous Page;</button>&nbsp;&nbsp;&nbsp;&nbsp;";
}

echo"
		<Button type='submit' name='pNo' value='$pNo'>Save Page</button>&nbsp;&nbsp;&nbsp;&nbsp;
		<button type='submit' name='Update' value='green'>Make Page Green</button>&nbsp;&nbsp;&nbsp;&nbsp;
		<Button type='submit' name='Update' value='red'>Make Page Red</button>&nbsp;&nbsp;&nbsp;&nbsp;
";



		if($pNo < ceil($imtot/$imagesPerPage)){
        	echo"<Button type='submit' name='pNo' value='$nextPage'>Next Page</button>";


}
	echo "
        	</form>
       
        	</div>";
   echo"     </body>
        </html>";


?>	
