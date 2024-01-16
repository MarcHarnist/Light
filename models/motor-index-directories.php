<?php

/** Author : marc Harnist
 *  2020-08-11
 */


$directories = array();
$notWishedDir = [
					".",
					"..",
					".gitignore",
					".git",
					"classes",
					"img",
					"js",
					"models",
];
$root    = '../riasec/';

//ACTION
$thisDir = $root;
$directories = explore($thisDir, $notWishedDir);

function explore($thisDir,$notWishedDir)
{
	$directories = array();
	$files = scandir($thisDir);

	foreach($files as $file)
	{
		if(is_dir($thisDir.$file))
		{
			if(in_array($file, $notWishedDir) === False)
			{
				$directories[] = $file;
			}
		}
	}
	return $directories;
}
foreach($directories as $key => $dir)
{
	$dir2 = $root.$dir."/";
	$explorateur = explore($dir2,$notWishedDir);
	if(count($explorateur)>0)
	{
		$directories["$dir2"] = $explorateur;
	}
}

?>
CONTENU DE <?=$root?>
<p>
<?php
foreach($directories as $dir)
{
	if(is_string($dir))
	{
		?>
		<a href="<?=$root.$dir?>"><?=$root.$dir?></a><br>
		<?php
		$dirName = $dir;
	}
	elseif(is_array($dir))//$dirName
	{
		foreach($dir as $subDir)
		{
			if(is_string($subDir))
			{
				?>
				<a href="<?=$root.$dirName.'/'.$subDir?>"><?=$root.$dirName?>/<?=$subDir?></a><br>
				<?php
			}
		}
	}
}
die();
