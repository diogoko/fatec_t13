<pre>
<?php
var_export($_GET);
echo "\n";
var_export($_POST);
echo "\n";
var_export($_FILES);
echo "\n";
echo "o método usado para esta requisição foi " . $_SERVER['REQUEST_METHOD'];
?>
</pre>
