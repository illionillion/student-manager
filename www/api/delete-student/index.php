<?php

include "../../lib/connect_db.php";
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GETリクエストの場合の処理（直接アクセスされた場合）

    // 別のページにリダイレクト
    header("Location: /");
    exit;
}

// NULLチェック
if (!isset($_POST["class-no"]) || empty($_POST["class-no"])) {
    header("Location: /student-list?error=1&type=delete");
    die("Error: class-no is null or empty");
}

$classNo = $_POST["class-no"];

try {
    $pdo = connect_db();

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM students");
    $stmt->execute();
    $total = $stmt->fetchColumn();

    if ($total == 1) {
        header("Location: /student-list?error=2&type=delete");
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM students WHERE class_no = :class_no");
    $stmt->bindParam(':class_no', $classNo, PDO::PARAM_STR);
    $stmt->execute();

    header("Location: /student-list?success&type=delete");

} catch (PDOException $e) {
    header("Location: /student-list?error=3&type=delete");
    echo $e->getMessage();
    exit;
} finally {
    // データベース接続を閉じる
    if ($pdo !== null) {
        $pdo = null;
    }
}
