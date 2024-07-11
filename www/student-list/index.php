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
            <?php if (!empty($_GET['type']) && $_GET['type'] == "delete"): ?>
                <?php if(!empty($_GET['error'])): ?>
                    <p class="text-danger">
                        <?php if($_GET['error'] == 1): ?>
                            学籍番号が空です。
                        <?php elseif($_GET['error'] == 2): ?>
                            このユーザーは削除できません。
                        <?php else: ?>
                            サーバーエラー
                        <?php endif; ?>
                    </p>
                <?php elseif(isset($_GET['success'])): ?>
                    <p class="text-success">削除に成功しました。</p>
                <?php endif; ?>
            <?php elseif (!empty($_GET['type']) && $_GET['type'] == "edit"): ?>
                <?php if(!empty($_GET['error'])): ?>
                    <p class="text-danger">
                        <?php if($_GET['error'] == 1): ?>
                            学籍番号が空です。
                        <?php elseif($_GET['error'] == 2): ?>
                            メールが空です。
                        <?php elseif($_GET['error'] == 0): ?>
                            氏名が空です。
                        <?php elseif($_GET['error'] == 3): ?>
                            パスワードが空です。
                        <?php elseif($_GET['error'] == 4): ?>
                            出身高校が空です。
                        <?php else: ?>
                            サーバーエラー
                        <?php endif; ?>
                    </p>
                <?php elseif(isset($_GET['success'])): ?>
                    <p class="text-success">削除に成功しました。</p>
                <?php endif; ?>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>学籍番号</th>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>出身高校</th>
                        <th>修正</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) : ?>
                        <tr>
                            <td><?= $student['class_no'] ?></td>
                            <td><?= $student['full_name'] ?></td>
                            <td><?= $student['email'] ?></td>
                            <td><?= $student['from_highschool'] ?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editModal<?= $student["class_no"] ?>">修正</button>
                                <!-- Modal -->
                                <div class="modal fade" id="editModal<?= $student["class_no"] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $student["class_no"] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="/api/edit-student/index.php" method="post" class="editForm">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?= $student["class_no"] ?>">修正</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="w-100 form-label">
                                                    <label for="class-no" class="w-100 mb-1">学籍番号</label>
                                                    <input type="text" name="class-no" id="class-no" class="form-control w-100" readonly required
                                                        placeholder="学籍番号を入力" value="<?= $student["class_no"] ?>"/>
                                                    </div>
                                                    <div class="w-100 form-label">
                                                        <label for="full-name" class="w-100 mb-1">氏名</label>
                                                        <input type="text" name="full-name" id="full-name" class="form-control w-100" required
                                                            placeholder="氏名を入力" value="<?= $student["full_name"] ?>">
                                                    </div>
                                                    <div class="w-100 form-label">
                                                        <label for="email" class="w-100 mb-1">メールアドレス</label>
                                                        <input type="email" name="email" id="email" class="form-control w-100" required
                                                            placeholder="メールアドレスを入力" value="<?= $student["email"] ?>">
                                                    </div>
                                                    <div class="w-100 form-label">
                                                        <label for="password" class="w-100 mb-1">新しいパスワード</label>
                                                        <input type="password" name="password" id="password" class="form-control w-100" required
                                                            placeholder="新しいパスワードを入力">
                                                    </div>
                                                    <div class="w-100 form-label">
                                                        <label for="from-highschool" class="w-100 mb-1">出身校高校</label>
                                                        <input type="text" name="from-highschool" id="from-highschool" class="form-control w-100" required
                                                            placeholder="出身校高校を入力" value="<?= $student["from_highschool"] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">保存</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <form action="/api/delete-student/index.php" method="post" id="delete-student-form">
                                    <input type="hidden" name="class-no" value="<?= $student["class_no"] ?>">
                                    <input type="hidden" name="full-name" value="<?= $student["full_name"] ?>">
                                    <button class="btn btn-danger" type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>