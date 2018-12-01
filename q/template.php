<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once '../../dbconnect.php';
$id = $inputid;
$sql = $conn->query("SELECT * FROM questions WHERE id = '".$id."'") or die($conn->error);
foreach($sql as $ind) {
    $title = $ind['title'];
    $body = $ind['content'];
    $date = $ind['date'];
    $price = $ind['price'];
    $author = $ind['author'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php 
        include '../../header.php';
        ?>
        <br>
        <div class="container-fluid container">
        <h3 class="ml-auto"><?php echo $date?></h3>
        <h2><?php echo $title?></h2>
        <small>asked by <?php echo $author?></small>
        <br>
        <br>
        <p><?php echo $body?></p>
        <hr>
        <h2>Answers:</h2>
        <?php
            $sql = $conn->query("SELECT * FROM response WHERE question_id = '".$id."'");
            if ($sql !== FALSE) {
                foreach ($sql as $ind) {
                    $title = $ind['title'];
                    $author = $ind['author'];
                    $content = $ind['content'];
                    $ids = $ind['id'];
                    $date = $ind['date'];
                    echo '
                    <div id="'.$ids.'" class="card"><h3>'.$title.' by '.$author.'</h3><br><p>'.$content.'</p></div>
                    ';
                }
            }
            include '../respondfunc.php';
        ?>
        </div>
    </body>
</html>