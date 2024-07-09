<?php

function session_check() {
    // セッションの開始
    if(!isset($_SESSION)){ session_start(); }
    // セッションにclass_noが存在するかチェック
    if (!isset($_SESSION['class_no'])) {
        // セッションがない場合はsignin.phpへリダイレクト
        header("Location: /signin");
        exit;
    }
    // セッションがある場合は何も処理しない
};
