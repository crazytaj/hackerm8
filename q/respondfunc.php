<?php 
if (isset($_POST['respond'])) {
$title = mysqli_real_escape_string($conn,$_POST['title']);
$content = mysqli_real_escape_string($conn,$_POST['content']);
$post_id = $id;
$date = time();
$spab = $conn->query("SELECT username FROM users WHERE id = '".$useid."'");
foreach($spab as $ind) $authors = $ind['username'];
$stmtss = "INSERT INTO response (title,content,author,question_id,date) VALUES('". $title ."', '". $content ."', '". $authors ."', '".$post_id."','".$date."')";
$querys = $conn->query($stmtss) or die($conn->error);
$refreshsql = $conn->query("SELECT * FROM response WHERE question_id = $post_id AND date=$date") or die($conn->error);
$refreshsqls = mysqli_fetch_array($refreshsql, MYSQLI_ASSOC);
$cid = $refreshsqls['id'];
echo '<meta http-equiv="Refresh" content="0; url=#'.$cid.'">';
}
?>
    <form method="POST" autocomplete="off"  enctype="multipart/form-data">

        <div class="col-sm-12">

            <div class="form-group">
                <div class="input-group">
                    <input type="text" name="title" class="form-control" placeholder="Title" required/>
                </div>
            </div>
            
            <div class="form-group">
                <div class="input-group">
                    <textarea name="content" class="form-control" placeholder="Answer" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="respond" href="#">Respond</button>
            </div>

        </div>

    </form>