<?php
require_once '../../dbconnect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user'])) {

} else {
    $useid = $_SESSION['user'];
    $sql = $conn->query("SELECT * FROM users WHERE id = '".$useid."'");
    $userRow = mysqli_fetch_assoc($sql);
    
    $userData = json_decode($userRow['userdata'], true);
}
if (isset($_POST['addSetting'])) {
    $valuestomerge = array ();
    $userData = array_merge($userData, $valuestomerge);
    $datatopush = json_encode($userData);
    $useid = $_SESSION['user'];
    var_dump($valuestomerge);
    $sql = $conn->query("UPDATE users SET userdata = '".$datatopush."' WHERE id = '".$useid."'");
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $userRow['username']?>'s Settings</title>
        <link rel="stylesheet" href="https://maddsrc.org/stylesheet.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
    <?php include '../../header.php'?>
    <div class="main-body">
        <div class="side-content">
            <p><?php 
            var_dump($userData);
            var_dump($_POST);
            ?></p>
        </div>
        <div class="main-content">
            <form method="POST">
                <input type="text" name="identity" required placeholder="Identity">
                <input type="text" name="value" required placeholder="Value">
                <input type="submit" name="addSetting">
            </form>
        </div>
    </div>
    </body>
</html>