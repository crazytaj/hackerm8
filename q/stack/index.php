<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../../forum/stackoverflow.php';
if (!isset($_GET['id'])) {
    header('Location: ' . '/');
} else {
    $id = $_GET['id'];
    $url = 'https://stackoverflow.com/questions/'.$id;
    $page = fetch_answer($url);
    $question = $page['question'];
    $answers = array();
    foreach ($page as $ind) {
        $key = array_search($ind, $page);
        if (strpos($key, 'answer') !== FALSE) {
            array_push($answers, $ind);
        }
    }
    if (isset($page['bestanswer'])) {
        foreach ($answers as $answer) {
            if ($ind == $page['bestanswer']) {
                $key = array_search($answer, $answers);
                unset($answers[$key]);
            }
        }
    }
}
if (!isset($_GET['title'])) {
    header('Location: '. '/');
} else {
    $title = str_replace('%20', ' ', $_GET['title']);
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
        ?><br>
        <div class="container container-fluid">
        <h2><strong><?php echo $title?></strong></h2><hr>
        <p><?php echo $question?></p>
        <h2>Answers:</h2>
        <?php
            if (empty($answers)) {
                echo '<h3 style="color:red"><strong>No answers yet</strong></h3>';
            } elseif (!isset($page['bestanswer'])) {
            foreach($answers as $answer) {
                echo '<strong><hr></strong>'.$answer;
            }
            } else {
                echo '<hr>' . '<h3><strong>Best Answer:</strong></h3>' .$page['bestanswer'] . '<h3><strong>Other Answers:</strong></h3>';
            foreach($answers as $answer) {
                echo '<strong><hr></strong>'.$answer;
            }
            }
        ?>
        </div>
    </body>
</html>