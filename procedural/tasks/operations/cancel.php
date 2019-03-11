<?php

if (isset($_GET["cancel"]))
{
    header("Location: ../tasks_db.php");
    die();
}