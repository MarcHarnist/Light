<?php
$root    = '../riasec';
$directories = array();
$denyedDirs = [   
					".git",
					"classes",
					"img",
					"js",
					"models",
					".gitattributes",
					".htaccess",
					"README.md",
					"sql",
					"config",
					"css",
					"inc",
				];

//ACTION
//Function find_all_files found in https://www.php.net/manual/fr/
function find_all_files($dir, $denyedDirs)
{
	$result = array();
    $root = scandir($dir);
    foreach($root as $value)
    {
        if($value === '.' || $value === '..' || in_array($value,$denyedDirs))
		{
			continue;
		}
        if(is_file("$dir/$value"))
		{
			$result[]="$dir/$value";
			continue;
		}
        foreach(find_all_files("$dir/$value", $denyedDirs) as $value)
        {
            $result[]=$value;
        }
    }
    return $result;
}
function getOnlyDirname($array)
{
	for($i=0; $i<count($array); $i++)
	{
		$array[$i] = dirname($array[$i]);
	}
	return array_unique($array);
}
$listOfDirs = getOnlyDirname(find_all_files($root, $denyedDirs));

var_dump($listOfDirs);
echo "<hr>";
foreach($listOfDirs as $dir)
{
	// var_dump($dir);
	echo '<br><a href="'.$dir.'">'.$dir.'</a><br>';
}