<?php if (isset($student) && !empty($student)) : ?>
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
                            <input type="text" name="class-no" id="class-no" class="form-control w-100" readonly required placeholder="学籍番号を入力" value="<?= $student["class_no"] ?>" />
                        </div>
                        <div class="w-100 form-label">
                            <label for="full-name" class="w-100 mb-1">氏名</label>
                            <input type="text" name="full-name" id="full-name" class="form-control w-100" required placeholder="氏名を入力" value="<?= $student["full_name"] ?>">
                        </div>
                        <div class="w-100 form-label">
                            <label for="email" class="w-100 mb-1">メールアドレス</label>
                            <input type="email" name="email" id="email" class="form-control w-100" required placeholder="メールアドレスを入力" value="<?= $student["email"] ?>">
                        </div>
                        <div class="w-100 form-label">
                            <label for="password" class="w-100 mb-1">新しいパスワード</label>
                            <input type="password" name="password" id="password" class="form-control w-100" required placeholder="新しいパスワードを入力">
                        </div>
                        <div class="w-100 form-label">
                            <label for="from-highschool" class="w-100 mb-1">出身校高校</label>
                            <input type="text" name="from-highschool" id="from-highschool" class="form-control w-100" required placeholder="出身校高校を入力" value="<?= $student["from_highschool"] ?>">
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
<?php endif; ?>