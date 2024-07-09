<?php
include "../lib/connect_db.php";
include "../lib/session_check.php";
//include "../components/carousel/index.php";

session_check();

try {
    // データベースに接続
    $pdo = connect_db();

    // 日記を取得するクエリを準備
    $studentsQuery = $pdo->prepare("SELECT class_no, full_name, email, from_highschool FROM students");

    // クエリを実行
    $studentsQuery->execute();

    // 日記の結果セットを取得
    $students = $studentsQuery->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // エラーハンドリング
    echo "Error: " . $e->getMessage();
} finally {
    // データベース接続を閉じる
    if ($pdo !== null) {
        $pdo = null;
    }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生一覧</title>
    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/main.js"></script>

</head>

<body>
    <main class="container row m-auto">
        <h1 class="text-center py-3">学生一覧</h1>
        <h5>氏名：<?= htmlspecialchars($_SESSION["full_name"]) ?></h5>
        <h5>学籍番号：<?= htmlspecialchars($_SESSION["class_no"]) ?></h5>
        <div class="d-flex gap-3">
            <a href="/" class="link-secondary">トップへ</a>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>学籍番号</th>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>出身高校</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) : ?>
                        <tr>
                            <td><?= $student['class_no'] ?></td>
                            <td><?= $student['full_name'] ?></td>
                            <td><?= $student['email'] ?></td>
                            <td><?= $student['from_highschool'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>