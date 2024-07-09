<?php
    $error = 0;
    if (!empty($_GET['error'])) {
        $error = $_GET['error'];
    }
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生管理システム - サインイン</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/main.js"></script>
</head>

<body>
    <main class="container row m-auto">
        <h1 class="text-center py-3">サインイン</h1>
        <form action="/api/signin/index.php" method="post" class="row gap-3">
            <div class="w-100 form-label">
                <label for="class-no" class="w-100 mb-1">学籍番号</label>
                <input type="text" name="class-no" id="class-no" class="form-control w-100" required placeholder="学籍番号を入力">
            </div>
            <div class="w-100 form-label">
                <label for="password" class="w-100 mb-1">パスワード</label>
                <input type="password" name="password" id="password" class="form-control w-100" required placeholder="パスワードを入力">
            </div>
            <div class="w-100 text-center">
                <input type="submit" class="btn btn-outline-primary" value="サインイン">
            </div>
            <?php if($error != 0) :?>
                <div class="error_message">
                    <p>
                        <?php if($error == 1) :?>
                            学籍番号が入力されていません
                        <?php elseif ($error == 2) :?>
                            パスワードが入力されていません
                        <?php elseif ($error == 3) :?>
                            学生が見つかりません
                        <?php elseif ($error == 4) :?>
                            パスワードが間違っています
                        <?php else :?>
                            サーバーエラー
                        <?php endif; ?>
                    </p>
                </div>
            <?php endif; ?>
        </form>
    </main>
</body>

</html>