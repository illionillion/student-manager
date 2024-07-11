<?php
include "../lib/session_check.php";
session_check();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生管理システム-学生登録</title>
    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/main.js"></script>
</head>

<body>
    <main class="container row m-auto">
        <h1 class="text-center py-3">学生登録</h1>
        <nav class="d-flex gap-3">
            <a href="/" class="link-secondary">トップへ戻る</a>
        </nav>
        <?php if (!empty($_GET['error'])) : ?>
            <p class="text-danger">
                <?php if ($_GET['error'] == 1) : ?>
                    学籍番号が空です。
                <?php elseif ($_GET['error'] == 2) : ?>
                    メールが空です。
                <?php elseif ($_GET['error'] == 0) : ?>
                    氏名が空です。
                <?php elseif ($_GET['error'] == 3) : ?>
                    パスワードが空です。
                <?php elseif ($_GET['error'] == 4) : ?>
                    出身高校が空です。
                <?php else : ?>
                    サーバーエラー
                <?php endif; ?>
            </p>
        <?php elseif (isset($_GET['success'])) : ?>
            <p class="text-success">登録に成功しました。</p>
        <?php endif; ?>
        <form action="/api/add-student/index.php" method="post" class="row gap-3" id="add-student-form">
            <div class="w-100 form-label">
                <label for="class-no" class="w-100 mb-1">学籍番号</label>
                <input type="text" name="class-no" id="class-no" class="form-control w-100" required placeholder="学籍番号を入力">
            </div>
            <div class="w-100 form-label">
                <label for="full-name" class="w-100 mb-1">氏名</label>
                <input type="text" name="full-name" id="full-name" class="form-control w-100" required placeholder="氏名を入力">
            </div>
            <div class="w-100 form-label">
                <label for="email" class="w-100 mb-1">メールアドレス</label>
                <input type="email" name="email" id="email" class="form-control w-100" required placeholder="メールアドレスを入力">
            </div>
            <div class="w-100 form-label">
                <label for="password" class="w-100 mb-1">パスワード</label>
                <input type="password" name="password" id="password" class="form-control w-100" required placeholder="パスワードを入力">
            </div>
            <div class="w-100 form-label">
                <label for="from-highschool" class="w-100 mb-1">出身校高校</label>
                <input type="text" name="from-highschool" id="from-highschool" class="form-control w-100" required placeholder="出身校高校を入力">
            </div>
            <div class="w-100 text-center">
                <input type="submit" class="btn btn-outline-primary" value="登録">
            </div>
        </form>
    </main>
</body>

</html>