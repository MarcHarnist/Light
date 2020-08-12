<?php
$dir    = '../riasec';
$files1 = scandir($dir);
$files2 = scandir($dir, 1);
?>
<pre>
<?php
print_r($files1);
?>
</pre>
<br>
<br>
<br>
<pre>
<?php
print_r($files2);

die();