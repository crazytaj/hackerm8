<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    header('Location: '. 'https://maddsrc.org');
    die();
} else {
    header('Location: '. 'https://maddsrc.org');
    die();
}
?>