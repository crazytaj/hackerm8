<?php
    if (isset($_POST['question'])) {
        header('Location: ' . '/forum?question=ask&query='. $_POST['question']);
    }
    function strposa($haystack, $needles=array()) {
        $chr = 0;
        foreach($needles as $needle) {
                $res = strpos($haystack, $needle);
                if ($res !== false) $chr += 1;
        }
        if($chr == 0) return false;
        return $chr;
}
?>
<style>
    body {
        background-color: lightblue;
    }

    .results {

    }

    .question {
        border-radius: 7px;
        height: 1fr;
        width: 100%;
        padding-left: 0.25em;
        font-size: 4em;
        border: 2px solid #0f0f0f0f;
        color: grey;
        background-color: azure;
    }
</style>
<?php
if (!isset($_GET['query'])) {
    ?>
    <div style="margin-left:35%; margin-right:35%; margin-top:15%;">
        <form method="POST">
            <input type="text" class="question" name="question" placeholder="Ask a question" required>
        </form>
    </div>
    <?php
} else {
    $query = $_GET['query'];
    ?>
    <div style="margin-left:35%; margin-right:35%; margin-top:5%;">
        <form method="POST">
            <input type="text" class="question" name="question" placeholder="Ask a question" value="<?php echo $query?>">
        </form>
        <br>
        <div class="results">
            <?php
                $searches = explode(' ', $query);
                $sql = $conn->query("SELECT * FROM questions") or die($conn->error);
                $results = array();
                foreach ($sql as $ind) {
                    $content = strtolower($ind['content']);
                    $title = strtolower($ind['title']);
                    $numofres = strposa($content, $searches);
                    if ($numofres !== FALSE) {
                        $arraytopush = array(
                            $numofres   =>  $ind['id']
                        );
                        $results = array_merge($results, $arraytopush);
                    }
                    $numofres = strposa($title, $searches);
                    if ($numofres !== FALSE) {
                        $arraytopush = array(
                            $numofres   =>  $ind['id']
                        );
                        $results = array_merge($results, $arraytopush);
                    }
                }
                if (!empty($results)) {
                    rsort($results);
                    foreach ($results as $result) {
                        $id = $result;
                        $sql = $conn->query("SELECT * FROM questions WHERE id = '".$id."'");
                        foreach ($sql as $ind) {
                            echo '
                            <div class="results">
                                <a href="/q/'.$id.'">'.$title.'</a>
                            </div>
                            ';
                        }
                    }
                } else {
                    include 'addsearch.php';
                }
                
            ?>
        </div>
    </div>

    <?php
}
?>