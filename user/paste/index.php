<?php
require_once '../../dbconnect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header('Location: ' . '/user/login');
} else {
    $useid = $_SESSION['user'];
    $sql = $conn->query("SELECT * FROM users WHERE id = '".$useid."'");
    $userRow = mysqli_fetch_assoc($sql);
}
if (!isset($_GET['paste'])) {
    
} else {
    $pasteid = $_GET['paste'];
    $sql = $conn->query("SELECT * FROM pastes WHERE user_id = '".$useid."' AND id = '".$pasteid."'");
    foreach($sql as $ind) {
        $title = htmlentities($ind['title']);
        $content = htmlentities($ind['content']);
    }
}

if (isset($_POST['add'])) {
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);
    $sql = $conn->query("INSERT INTO pastes (title, content, user_id) VALUES ('".$title."', '".$content."', '".$useid."')") or die($conn->error);
}

if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);
    $sql = $conn->query("UPDATE pastes SET title = '".$title."', content='".$content."' WHERE id = '".$pasteid."'") or die($conn->error);
    echo '<meta http-equiv="refresh" content="0">';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>HackerM8</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            function open_form() {
                document.getElementById('static').style.display = 'none';
                document.getElementById('data').style.display = 'block';
            }
            function copyToClipboard(element) {
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val($(element).text()).select();
                document.execCommand("copy");
                $temp.remove();
            }
        </script>
    </head>
    <body>
        <?php
        include '../../header.php';
        ?>
        <style>
        body {
            background-color: #0f0f0f0f;
        }
        .page-main {
            background-color: #0f0f0f0f;
            padding: 5px;
            padding: 25px;
            border-radius: 2px;
            margin-bottom: 3%;
            margin-top: 3%;
        }
        </style>
        <div class="container container-fluid">
        <div class="page-main">
        <button class="float-right" onclick="copyToClipboard('#paste-content')">Copy</button>
            <?php
                if (isset($_GET['paste'])) {
                    ?>
                    <div id="static" style="display:block">
                        <h2 ondblclick='open_form()'><strong><?php echo $title?></strong></h2><br>
                        <p id="paste-content" value="<?php echo $content?>" ondblclick='open_form()'><?php echo $content?></p>
                    </div>
                    <div id="data" style="display:none">
                        <form method="POST">
                            <input type="text" name="title" value="<?php echo $title?>" required placeholder="Title"><br><br>
                            <textarea name="content" required placeholder="Content"><?php echo $content?></textarea><br><br>
                            <button type="submit" name="update">Update Paste</button>
                        </form>
                    </div>
            <?php
                } else {
                    ?>

                        <div id="data">
                        <form method="POST">
                            <input type="text" name="title" required placeholder="Title"><br><br>
                            <textarea name="content" required placeholder="Content"></textarea><br><br>
                            <button type="submit" name="add">Create paste</button>
                        </form>
                    </div>

                    <?php
                }
            ?>
        </div>
        </div>
    </body>
</html>