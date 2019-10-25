<?php echo file_get_contents("html/header.html"); ?>


<div class="trasparenza">
	<fieldset id="searchs"> 
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
	<br>
	</fieldset>
</div>


<?php
$miranda= 'miranda database/example.fasta database/reduced_database.dat -out database/out.txt';
exec($miranda);
$ruby= 'ruby output_selection_on_best.rb';
exec($ruby);
$selection= 'database/selection.txt';
$testo= file_get_contents ($selection);

echo "<pre>", htmlspecialchars($testo), "</pre>";
?>

<?php echo file_get_contents("html/footer.html"); ?>