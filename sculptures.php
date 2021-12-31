<html>
<head>
Sculpture Dataset
</head>

<body>
<p>A list of sculptures that seem to be misclassified:
<ul>
<?php
    $dir = getcwd();
    $files1 = glob($dir . "/../results/*.txt") ;
    foreach($files1 as $result) {
	echo '<li><a href="http://www.robots.ox.ac.uk/~ow/annotate.php?fileName=';
	echo $result;
	echo '">';
	echo $result;
	echo '</a>';
    }
?>
</ul>
</body>
</html
