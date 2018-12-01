<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once '../../dbconnect.php';
$id = 1;
$sql = $conn->query("SELECT * FROM questions WHERE id = '".$id."'") or die($conn->error);
foreach($sql as $ind) {
    $title = $ind['title'];
    $body = $ind['content'];
    $date = $ind['date'];
    $price = $ind['price'];
    $author = $ind['author'];
    $accepted = $ind['accepted'];
}
if (isset($_POST['accept'])) {
    $acceptedid = $_POST['accept'];
    $hello = $conn->query("UPDATE response SET accepted = 1 WHERE id = '".$acceptedid."'") or die($conn->error);
    $hello = $conn->query("UPDATE questions SET accepted = 1 WHERE id = '".$id."'") or die($conn->error);
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
            if (isset($_SESSION['user'])) {
                $uid = $_SESSION['user'];
                $smts = $conn->query("SELECT id FROM users WHERE username = '".$author."'");
                foreach($smts as $ind) $idf = $ind['id'];
                if ($uid == $idf && $accepted == 0) {
                    if ($sql !== FALSE) {
                        foreach ($sql as $ind) {
                            $title = $ind['title'];
                            $author = $ind['author'];
                            $content = $ind['content'];
                            $ids = $ind['id'];
                            $date = $ind['date'];
                            echo '
                            <div id="'.$ids.'" class="card"><form method="POST"><button type="submit" name="accept" value="'.$ids.'">Accept Answer</button></form><h3>'.$title.' by '.$author.'</h3><br><p>'.$content.'</p></div>
                            ';
                        }
                    }
                } else {
                    if ($sql !== FALSE) {
                        foreach ($sql as $ind) {
                            if ($ind['accepted'] == 1) {
                                $title = $ind['title'];
                                $author = $ind['author'];
                                $content = $ind['content'];
                                $ids = $ind['id'];
                                $date = $ind['date'];
                                echo '
                                <div id="'.$ids.'" class="card"><h3>'.$title.' by '.$author.'</h3><br><p>'.$content.'</p><small style="color:green"><strong>Accepted</strong></small></div>
                                ';
                            } else {
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
                    }
                }
                include '../respondfunc.php';
            } else {
                if ($sql !== FALSE) {
                    foreach ($sql as $ind) {
                        if ($ind['accepted'] == 1) {
                            $title = $ind['title'];
                            $author = $ind['author'];
                            $content = $ind['content'];
                            $ids = $ind['id'];
                            $date = $ind['date'];
                            echo '
                            <div id="'.$ids.'" class="card"><h3>'.$title.' by '.$author.'</h3><br><p>'.$content.'</p><small style="color:green"><strong>Accepted</strong></small></div>
                            ';
                        } else {
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
                }
                echo '<h2 style="color:red"><strong>Login to Respond</strong></h2>';
            }
            
        ?>
        </div>
    </body>
</html>