<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header('Location: ' . '/user/login');
}
$question = $_GET['query'];
if (isset($_POST['search'])) {
    $id = $_SESSION['user'];
    $sql = $conn->query("SELECT username FROM users WHERE id = '".$id."'");
    foreach ($sql as $ind) {
        $author = $ind['username'];
    }
    $title = $_POST['title'];
    $question = $_POST['content'];
    $date = time();
    $catigory = json_encode($_POST['catigory']);
    $price = $_POST['price'];
    $sql = $conn->query("INSERT INTO questions (title, author, content, price, catigories, date) VALUES ('".$title."', '".$author."', '".$question."', '".$price."', '".$catigory."', '".$date."')") or die($conn->error);
    $sql = $conn->query("SELECT id FROM questions WHERE date = '".$date."'");
    foreach ($sql as $ind) $id = $ind['id'];
    mkdir('../q/' . $id);
    $filecreate = fopen('../q/'.$id.'/index.php', 'x') or die('Unable to open file!');
    $template = file_get_contents('../q/template.php');
    $text = str_replace('$inputid', $id, $template);
    fwrite($filecreate, $text);
    echo '<meta http-equiv="refresh" content="0">';
}
?>
<form method="POST">
<input type="text" name="title" placeholder="Question" value="<?php echo $question?>" required>
<textarea name="content" placeholder="Description" required></textarea>
<input type="text" name="price" placeholder="Price (in $)" required>
<input type="text" name="catigory" placeholder="catigories" required>
<input type="submit" name="search">
</form>