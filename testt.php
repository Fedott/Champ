<?php

$page = file_get_contents('text.php');

$reg = '%<tr class=\'newRow\'.+<div class="name">.+<a href="/id[0-9]+">(.+)</a>.+</div>.+<div class="date">(.+)</div>.+class="new messageSubject"><span 0>(.+)</span></a>.+class="new messageBody">(.+)</div>.+</tr>%s';
if(preg_match_all('%<tr class=\'newRow\'.+<div class="name">.+<a href="/id[0-9]+">(.+)</a>.+</div>.+<div class="date">(.+)</div>.+class="new messageSubject"><span 0>(.+)</span></a>.+class="new messageBody">(.+)</div>.+</tr>%sU', $page, $matches, PREG_SET_ORDER))
{
	echo "норм";
}
else
{
	echo "лажа";
}

echo "<code><pre>".print_r($matches, 1)."</pre></code>";

?>
