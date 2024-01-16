<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Exécutez le script Makefile ici en utilisant la fonction shell_exec
    $output = shell_exec('make -f makefile');

    // Vous pouvez également afficher le résultat de l'exécution, par exemple :
    echo "<pre>$output</pre>";
}
?>
