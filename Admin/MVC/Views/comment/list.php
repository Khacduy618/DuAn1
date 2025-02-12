<a class="btn btn-primary <?=!isset($_SESSION['privilege']['comment']['recycle']) ? 'disabled' : ''?>" href="?mod=comment&act=recycle"><i class="bi bi-trash"></i></a>
<a class="btn btn-primary" href="?mod=blog&act=list">Back</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Author</th>
            <th scope="col">Comment</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($comments as $comment){ ?>
        <tr>
            <td><?=$comment['comment_userEmail']?></td>
            <td><?=$comment['comment_content']?></td>
            <td><?= $comment['comment_dateTime']?></td>
            <td>
                <button type="button" class="btn btn-primary delete-button <?=!isset($_SESSION['privilege']['comment']['soft_delete']) ? 'disabled' : ''?>" data-bs-toggle="modal"
                    data-bs-target="#deleteCourseModal" data-id="<?= htmlspecialchars($comment['comment_id']) ?>">
                    Xóa
                </button>
            </td>
        </tr>
        <?php  }?>
    </tbody>
</table>
<div id="deleteCourseModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xóa bài viết?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn chắc chắn muốn xóa bài viết này?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger" id="confirmDelete">Delete</a>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-button');
    const confirmDeleteLink = document.getElementById('confirmDelete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const commentId = button.getAttribute('data-id');
            confirmDeleteLink.href = `?mod=comment&act=soft_delete&id=${commentId}`;
        });
    });
});
</script>