<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>About Us</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
        include '../header.php';
        ?>
        <br>
        <div class="container container-fluid">
            <div class="jumbotron text-center">
                <h1>So who is HackerM8?</h1>
                <h3>And what do we stand for?</h3>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <h2>"We" is just me</h2>
                    <p>I am the only person who is working on HackerM8 at the moment, I am in 9th grade at Saint Louis Priory School and I am fluent in PHP, HTML, CSS and JavaScript</p>
                </div>
                <div class="col-sm-4">
                    <h2>"Our" goal is for world wide collaberation</h2>
                    <p>The goal of this project is to provide a forum that anyone can go to in order to get help with their problems without having to browse hundreds of different forums.</p>
                </div>
                <div class="col-sm-4">
                    <h2>Incentives Help</h2>
                    <p>We know that time is one of the most valuable things that we posses, so we want to honor that by providing monetary incentives for members who help out others and answer their questions, this is why we charge for asking a question</p>
                </div>
            </div>
        </div>
    </body>
</html>