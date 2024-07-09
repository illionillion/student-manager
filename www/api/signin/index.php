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
    header("Location: /signin?error=1");
    die("Error: class-no is null or empty");
}
if (!isset($_POST["password"]) || empty($_POST["password"])) {
    header("Location: /signin?error=2");
    die("Error: password is null or empty");
}

$classNo = $_POST["class-no"];
$userPassowrd = $_POST["password"];

try {
    $pdo = connect_db();

    // 日記を挿入
    $stmt = $pdo->prepare("SELECT class_no, full_name, email, password FROM students WHERE class_no = :class_no");
    $stmt->bindParam(':class_no', $classNo, PDO::PARAM_STR);
    $stmt->execute();
    $existUser = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($existUser) == 0) {
        header("Location: /signin?error=3");
        die("Error: " . $classNo . "was not found.");
    }

    $hashedPassword = hash('sha256', $userPassowrd);

    if ($existUser[0]["password"] == $hashedPassword) {
        $_SESSION['class_no'] = $existUser[0]["class_no"];
        $_SESSION['full_name'] = $existUser[0]["full_name"];
        header("Location: /");
    } else {
        header("Location: /signin?error=4");
    }
} catch (PDOException $e) {
    header("Location: /signin?error=5");
    echo $e->getMessage();
    exit;
} finally {
    // データベース接続を閉じる
    if ($pdo !== null) {
        $pdo = null;
    }
}
