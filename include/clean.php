<?php
unlink('../database/selection.txt');
unlink('../uploads/options.dat');
unlink('../database/out.txt');
unlink('../database/best.txt');
unlink('../uploads/input.fasta');
header("location: ../search.php");
?>