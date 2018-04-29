<?php

require('model.php');

$chapter = getLastChapter();
$comment = getLastComment();

require('indexView.php');