<?php
include "./lib/session_check.php";
session_check();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生管理システム</title>
    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/main.js"></script>
</head>

<body>
    <main class="container row m-auto">
        <h1 class="text-center py-3">学生管理システム</h1>
        <h5>氏名：<?= htmlspecialchars($_SESSION["full_name"]) ?></h5>
        <h5>学籍番号：<?= htmlspecialchars($_SESSION["class_no"]) ?></h5>
        <nav class="d-flex gap-3">
            <a href="/student-list" class="link-secondary">学生一覧</a>
            <a href="/add-student" class="link-secondary">学生登録</a>
            <a href="/api/signout" class="link-secondary">サインアウト</a>
        </nav>
    </main>
</body>

</html>