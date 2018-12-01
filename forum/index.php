<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once '../dbconnect.php';
if (isset($_GET['question'])) {
    $type = $_GET['question'];
    switch ($type) {
        case 'ask':
            $title = 'Ask a Question';
        break;

        case 'browse':
            $title = 'Browse the forum';
        break;

        case 'answer':
            $title = 'Answer questions';
        break;

        default:
            header('Location: ' . '/');
        break;
    }
} else {
    header('Location: ' . '/');
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
        include '../header.php';
        echo '<br>';
            $type = $_GET['question'];
            switch ($type) {
                case 'ask':
                    include 'ask.php';
                break;
        
                case 'browse':
                    include 'browse.php';
                break;
        
                case 'answer':
                    include 'answer.php';
                break;
            }
        ?>
    </body>
</html>