<?php
$sql = $conn->query("SELECT * FROM questions WHERE accepted = 0");
?>
<h2 style="margin-left: 25%; margin-right:35%; margin-top: 2%;">Unanswered Questions:</h2>
<div style="margin-left: 35%; margin-right:35%; margin-top: 1%;">
<?php
foreach ($sql as $ind) {
    $title = $ind['title'];
    $url = '/q/'.$ind['id'];
    echo '
    <div class="results">
    <a href="'.$url.'">'.$title.'</a>
    </div>';
}
?>
</div>