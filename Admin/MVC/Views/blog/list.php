<div class="d-flex justify-content-between mb-4">
    <?php if (isset($_SESSION['privilege']['blog']) && isset($_SESSION['privilege']['blog']['add'])) { ?>
    <a class="btn btn-success" href="?mod=blog&act=add">
        <i class="bi bi-plus-circle"></i> Create New Blog Post
    </a>
    <?php } ?>
    <?php if (isset($_SESSION['privilege']['blog']) && isset($_SESSION['privilege']['blog']['soft_delete'])) { ?>
    <a class="btn btn-warning" href="?mod=blog&act=recycle">
        <i class="bi bi-trash"></i> Recycle Bin
    </a>
    <?php } ?>

</div>



<table class="table table-hover table-striped">
    <thead class="table-white">
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Content</th>
            <th scope="col">Author</th>
            <th scope="col">Comments</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($blogs as $blog) { ?>
        <tr>
            <td class="align-middle"><?= htmlspecialchars($blog['blog_title']) ?></td>
            <td class="align-middle">
                <img src="../uploaded/<?= htmlspecialchars($blog['blog_image']) ?>"
                    alt="Image of <?= htmlspecialchars($blog['blog_title']) ?>" class="img-thumbnail" width="60px"
                    height="60px">
            </td>
            <td class="align-middle">
                <?= htmlspecialchars(substr($blog['blog_content'], 0, 90))?>...
            </td>
            <td class="align-middle"><?= htmlspecialchars($blog['author_email']) ?></td>
            <td class="align-middle">
                <?php $commentCount = $this->Blog->countCommentofBlog($blog['blog_id']); ?>
                <span class="badge bg-secondary"><?= $commentCount ?> comments</span>
                <?php if($commentCount > 0) { ?>
                <br>
                <a href="?mod=comment&act=list&id=<?= htmlspecialchars($blog['blog_id']) ?>"
                    class="btn btn-sm btn-info mt-1">
                    <i class="bi bi-eye"></i> View
                </a>
                <?php } ?>
            </td>
            <td class="align-middle">
                <div class="btn-group" role="group">
                    <?php if (isset($_SESSION['privilege']['blog']) && isset($_SESSION['privilege']['blog']['edit'])) { ?>
                    <a href="?mod=blog&act=edit&id=<?= htmlspecialchars($blog['blog_id']) ?>"
                        class="btn btn-sm btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <?php } ?>
                    <?php if (isset($_SESSION['privilege']['blog']) && isset($_SESSION['privilege']['blog']['soft_delete'])) { ?>
                    <button type="button" class="btn btn-sm btn-danger delete-button" data-bs-toggle="modal"
                        data-bs-target="#deleteCourseModal" data-id="<?= htmlspecialchars($blog['blog_id']) ?>">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                    <?php } ?>


                </div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<div id="deleteCourseModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Blog Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this blog post?</p>
                <p class="text-muted small">This action can be undone from the recycle bin.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger" id="confirmDelete">
                    <i class="bi bi-trash"></i> Delete
                </a>
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
            confirmDeleteLink.href = `?mod=blog&act=soft_delete&id=${blogId}`;
        });
    });
});
</script>