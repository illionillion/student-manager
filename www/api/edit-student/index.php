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
if (!isset($_POST["full-name"]) || empty($_POST["full-name"])) {
    header("Location: /student-list?error=1&type=edit");
    die("Error: full-name is null or empty");
}
if (!isset($_POST["class-no"]) || empty($_POST["class-no"])) {
    header("Location: /student-list?error=1&type=edit");
    die("Error: class-no is null or empty");
}
if (!isset($_POST["email"]) || empty($_POST["email"])) {
    header("Location: /student-list?error=2&type=edit");
    die("Error: email is null or empty");
}
if (!isset($_POST["password"]) || empty($_POST["password"])) {
    header("Location: /student-list?error=3&type=edit");
    die("Error: password is null or empty");
}
if (!isset($_POST["from-highschool"]) || empty($_POST["from-highschool"])) {
    header("Location: /student-list?error=4&type=edit");
    die("Error: from-highschool is null or empty");
}

$classNo = $_POST["class-no"];
$fullName = $_POST["full-name"];
$userPassowrd = $_POST["password"];
$hashedPassword = hash('sha256', $userPassowrd);
$userEmail = $_POST["email"];
$fromHighschool = $_POST['from-highschool'];

try {
    $pdo = connect_db();

    // 日記を挿入
    $stmt = $pdo->prepare("UPDATE students SET full_name = :full_name, email = :email, password = :password, from_highschool = :from_highschool WHERE class_no = :class_no");
    $stmt->bindParam(':class_no', $classNo, PDO::PARAM_STR);
    $stmt->bindParam(':full_name', $fullName, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindParam(':email', $userEmail, PDO::PARAM_STR);
    $stmt->bindParam(':from_highschool', $fromHighschool, PDO::PARAM_STR);
    $stmt->execute();

    header("Location: /student-list?success&type=edit");

} catch (PDOException $e) {
    header("Location: /student-list?error=5&type=edit");
    echo $e->getMessage();
    exit;
} finally {
    // データベース接続を閉じる
    if ($pdo !== null) {
        $pdo = null;
    }
}
