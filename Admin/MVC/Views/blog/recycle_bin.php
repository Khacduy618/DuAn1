 <br>
<a class="btn btn-primary" href="?mod=blog&act=list">Back</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Content</th>
            <th scope="col">View</th>
            <th scope="col">Comments</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($blogsDeleted as $blog) { ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($blog['blog_title']) ?></th>
            <td><img src="../uploaded/<?= htmlspecialchars($blog['blog_image']) ?>"
                    alt="Image of <?= htmlspecialchars($blog['blog_title']) ?>" width="60px" height="60px"></td>
            <td>
                <?= htmlspecialchars(substr($blog['blog_content'], 0, 100)) ?>
                <a href="blog_detail.php?id=<?= htmlspecialchars($blog['blog_id']) ?>">Read more</a>
            </td>
            <td><?= htmlspecialchars($blog['blog_view']) ?></td>
            <td><a href="?mod=comment&act=list&id=<?= htmlspecialchars($blog['blog_id']) ?>">View Detail</a></td>
            <td>

                <a href="?mod=blog&act=back_up&id=<?= htmlspecialchars($blog['blog_id']) ?>"
                    class="btn btn-primary">back
                    up</a>
                <button type="button" class="btn btn-primary delete-button" data-bs-toggle="modal"
                    data-bs-target="#deleteCourseModal" data-id="<?= htmlspecialchars($blog['blog_id']) ?>">
                    delete
                </button>
            </td>
        </tr>
        <?php } ?>
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
            const blogId = button.getAttribute('data-id');
            confirmDeleteLink.href = `?mod=blog&act=force_delete&id=${blogId}`;
        });
    });
});
</script>