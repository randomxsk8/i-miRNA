<?php

function validate($a, $b, $c) {
	if(($a && !$b && !$c) || (!$a && $b && !$c) || (!$a && !$b && $c)) {
		return true;
	}

	return false;
}

?>