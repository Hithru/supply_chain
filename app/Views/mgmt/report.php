<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  </head>
<body>

<h2> <?php echo $report_name?> </h2>
<h3> <?php echo $subtitle?></h3> <br>

<?php if (isset($headers)){

echo '<table class="table table-bordered"><tr>';

foreach ($headers as $h){
    echo("<th>{$h}</th>");
}
echo "</tr>";

foreach ($data as $row){
    echo("<tr>");

    foreach ($row as $r){
        echo("<td>{$r}</td>");
    }

    echo("</tr>");
}

echo "</table>";}?>


</body>