<?php
$row = 1;

if (($handle = fopen("http://localhost:8983/solr/collection1/select?q=mepal&sort=last_modified+desc&start=0&rows=15&wt=csv&indent=true", "r")) !== FALSE) {

  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
    for ($c=0; $c < $num; $c++) {
        echo $data[$c] . "<br />\n";
    }
  }

  fclose($handle);
}
if ($row==2)
{
echo "NO Content Found";
}

echo $row
?>
