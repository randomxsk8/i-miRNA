<!DOCTYPE html>
<html lang="en">
<?php echo file_get_contents("html/header.html"); ?>

<div id="dna">

<div id="welcome">
	Welcome on the <i class="fa fa-info-circle" id="i_circle"></i>MiRNA website!
</div>

<div>
	<h3>We are glad you came to visit us.</h3>
</div>


<div id="div-dna">

Here you can perform alignment between your miRNA and default reduced-database (without redundance) 3'UTR database. 
You can insert a miRNA ID, either a fasta sequence or uploading file. 
In output you can see the first best hundred alignments.
Certainly, you are wondering "ok, but what is the difference between other sites that make the same work?", right observation!
The difference is that you can change default parameters used by Miranda.
So, if you have discovered a new miRNA or simply, you want an alignment with particular conditions, in this site you can!!

</div>

<br>

<div>
	<h5>We hope that our tool will be useful for you.</h5>
	<h4>Good luck and thank you!</h4>
</div>

</div>

<?php echo file_get_contents("html/footer.html"); ?>