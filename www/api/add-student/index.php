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
    header("Location: /add-student?error=1");
    die("Error: class-no is null or empty");
}
if (!isset($_POST["email"]) || empty($_POST["email"])) {
    header("Location: /add-student?error=2");
    die("Error: email is null or empty");
}
if (!isset($_POST["password"]) || empty($_POST["password"])) {
    header("Location: /add-student?error=3");
    die("Error: password is null or empty");
}
if (!isset($_POST["from-highschool"]) || empty($_POST["from-highschool"])) {
    header("Location: /add-student?error=4");
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
    $stmt = $pdo->prepare("INSERT INTO students (class_no, full_name, email, password, from_highschool) VALUES (:class_no, :full_name, :email, :password, :from_highschool)");
    $stmt->bindParam(':class_no', $classNo, PDO::PARAM_STR);
    $stmt->bindParam(':full_name', $fullName, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindParam(':email', $userEmail, PDO::PARAM_STR);
    $stmt->bindParam(':from_highschool', $fromHighschool, PDO::PARAM_STR);
    $stmt->execute();

    $userId = $pdo->lastInsertId();
    
    header("Location: /add-student?success");

} catch (PDOException $e) {
    header("Location: /add-student?error=4");
    echo $e->getMessage();
    exit;
} finally {
    // データベース接続を閉じる
    if ($pdo !== null) {
        $pdo = null;
    }
}
