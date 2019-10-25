<?php
echo file_get_contents("html/header.html");
include 'include/functions.php';

$filename = 'uploads/input.fasta';
    if (file_exists($filename)) {
        unlink('database/selection.txt');
		unlink('uploads/options.dat');
		unlink('database/out.txt');
		unlink('database/best.txt');
		unlink('uploads/input.fasta');
	}?>
          			
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 250 || document.documentElement.scrollTop > 250) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>


<div id="download">
	<fieldset>
	<br>
	Below is shown the selection of the best one hundred alignments.
		<section>
		<p class="top_output">
		<span class=" centra-contenuto row">
			<a href="database/selection.txt" download="alignment.txt"><input type="submit" class="btn btn-primary" value="Download this file"></a>
		</span>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class=" centra-contenuto row">	
			<a href="database/out.txt" download="alignment_total.txt"><input type="submit" class="btn btn-primary" value="Download all the alignments"></a>
		</span>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class=" centra-contenuto row">
			<form method="post" class="example" action="include/mailer.php"> 
			  <input type="email" placeholder="Enter your email address" id="email" name="email" required>
			  <button type="submit" value="Submit" class="my-tooltip">
			  	<span> Send mail </span>
			  		<i class="fa fa-envelope"></i>
			  	<span class="my-tooltiptext tool_sendmail tool_text_send">To receive file with alignments showed in this page and file with all alignments</span>
			  </button>
			</form>
		</span> 
		</p>
		</section>
	</fieldset>
</div>

<div class="trasparenza">
	<fieldset id="searchs">
		<section>
			<p>
			<form action="include/clean.php" method="get" class="clean_button">
			<button type="submit" id="Back" class="my-tooltip" value="New Search!">
				<span> New Search! </span>
	  				<i class="fa fa-search"></i>
	  			<span class="my-tooltiptext tool_back"><b>Return to Search</b></span>
			</button>
			</form>
			</p>
		</section>
	</fieldset>
</div>



<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$code = $_POST['code'];
	$fasta = $_POST['fasta'];
	$file = $_FILES["file"]["size"];
	$score = $_POST['score'];
	$energy = $_POST['energy'];
	$strict = $_POST['strict'];
	$noenergy = $_POST['noenergy'];
	$database='/database/reduced_database.dat';
	
	$a = $b = $c = FALSE;
	
	if(!empty($code)) {
		$a = TRUE;
	} 
	if(!empty($fasta)) {
		$b = TRUE;
	}
	if(!empty($file)) {
		$c = TRUE;
	}

	if(validate($a, $b, $c)) {
		$input = "";
		if($a) {
			if(preg_match('/^hsa-[a-zA-Z]{3}-[0-9a-z]{2,4}-{0,1}[0-9a-z]{0,2}/', $code)) {
				$input = $code;
				exec("grep -A 1 $input database/db_mature.txt  > uploads/input.fasta");
			} else {
				?>
  				<style type="text/css">#download{
				display: none;
				}</style>
				<?php
				echo "Invalid code";
			}
		} elseif($b) {
			if(preg_match('/^>hsa-[a-zA-Z]{3}-[0-9a-z]{2,4}-{0,1}[0-9a-z]{0,2}\sMIMAT[0-9]{7}/', (string)$fasta)) {
				if(preg_match('/[ACGU]{19,25}/', (string)$fasta)) {    
					$input = $fasta;
					file_put_contents('uploads/input.fasta', $_POST['fasta']);
				}
			} else {
				?>
  				<style type="text/css">#download{
				display: none;
				}</style>
				<?php
				echo "Invalid fasta";
				
			}
			
		} elseif($c) {
			if ($file < 5000000) {
 				if ($_FILES["file"]["error"] > 0) {
    				echo "Error Code: " . $_FILES["file"]["error"] . "<br />";
    				return;
    			} else {
    				echo "Uploaded File: " . $_FILES["file"]["name"] . "<br />";
    				echo "Type: " . $_FILES["file"]["type"] . "<br />";
    				echo "Size: " . ($file / 1024) . " Kb<br />";
    				if (file_exists("uploads/" . $_FILES["file"]["name"])) {
      					echo $_FILES["file"]["name"] . " already exists. ";
      				} else {
					$new_name = "input.fasta";
      					move_uploaded_file($_FILES["file"]["tmp_name"],
      					"uploads/" . $new_name);
					}
    			}
  			} else {
  				?>
  				<style type="text/css">#download{
				display: none;
				}</style>
				<?php
  					echo "Invalid file";
  				return;
 			}	
 			$input = $_FILES["file"]["type"];
		}
	

		$date=date("Y-m-d H:i", time());
		$last_search = "<b>$input</b>, with the following parameters:<b>Score:</b> $score,  <b>Energy:</b> $energy,  <b>Strict:</b> $strict,  <b>Noenergy:</b> $noenergy <br>Time of the last scan: $date";
		file_put_contents('uploads/last.txt', $last_search);
		

		$fp = fopen('uploads/options.dat', "w");
		fwrite($fp, $score."\t".$energy."\t".$strict."\t".$noenergy."\r\n");
		fclose($fp);
		$miranda='ruby miranda.rb';
		exec($miranda);
		$ruby= 'ruby output_selection_on_best.rb';
		exec($ruby);
		$selection= 'database/selection.txt';

		$size=filesize($selection);
	
		if($size>0){
			?>
			<style type="text/css">#download{
				display: block;
			}</style>
			<?php
		}
		else{
		?>		
			<style type="text/css">#download{
				display: none;
			}</style>
			<?php
			}

		$testo= file_get_contents ($selection);
		echo "<pre>", htmlspecialchars($testo), "</pre>";

	} else {
	?>
			<style type="text/css">#download{
			display: none;
			}</style>
			<?php
		echo "Please select one";
	}
}

?>

<?php echo file_get_contents("html/footer.html");?>