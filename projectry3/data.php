<?php
@include 'conf.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <?php
  $i=2;
  $rows=mysqli_query($conn,"SELECT photo FROM posts WHERE pid=3");
  ?>
  <?php foreach($rows as $row):?>
    <?php echo $i;?>
    <img src="img/<?php echo $row['photo'];?>" width=200 title="<?php echo $row['photo'];?>">  
    <?php endforeach;?>
</body>
</html>