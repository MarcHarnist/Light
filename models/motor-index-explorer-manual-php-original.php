<?php
//Find in manual php online
function find_all_files($dir)
{
	$result=array();
    $root = scandir($dir);
    foreach($root as $value)
    {
        if($value === '.' || $value === '..') {continue;}
        if(is_file("$dir/$value")) {
			$result[]="$dir/$value";
			continue;
			}
        foreach(find_all_files("$dir/$value") as $value)
        {
            $result[]=$value;
        }
    }
    return $result;
} 
$result = find_all_files($root);

?>
<pre>
<?=print_r($result);?>
</pre>
CONTENU DE <?=$root?>
<p>