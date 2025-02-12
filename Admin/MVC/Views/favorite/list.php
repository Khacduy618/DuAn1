<div class="row">
    <div class="row frmtitle">
        <h1>Favorite Management</h1>
    </div>

    <div class="row gap-3 mb-3 justify-content-around">
        <div class="col-md-3 me-auto">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" 
                       name="search" 
                       value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
                       placeholder="Search by name or product..."
                       onchange="this.form.submit()"
                       form="searchForm">
            </div>
            <form id="searchForm" action="" method="GET">
                <input type="hidden" name="mod" value="favorite">
                <input type="hidden" name="act" value="list">
            </form>
        </div>

                <!-- Role Filter -->
        
    </div>

    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message']; ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="row frmcontent">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>IMAGE</th>
                        <th>PRODUCT</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listfavorites)): ?>
                        <?php foreach ($listfavorites as $favorite): ?>
                            <tr>
                                <td><?= $favorite['favorite_id'] ?></td>
                                <td><?= $favorite['user_name'] ?></td>
                                <td><?= $favorite['favorite_userEmail'] ?></td>
                                <td><img src="../uploaded/<?= $favorite['product_img'] ?>" alt="<?= $favorite['product_name'] ?>" style="width: 100px; height: auto;"></td>
                                <td><?= $favorite['product_name'] ?></td>
                                <td>
                                    <form action="?mod=favorite&act=delete" method="post" 
                                          onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm yêu thích này?');">
                                        <input type="hidden" name="favorite_id" value="<?= $favorite['favorite_id'] ?>">
                                        <button type="submit" class="btn btn-danger" 
                                                <?= !isset($_SESSION['privilege']['favorite']['delete']) ? 'disabled' : '' ?>>
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No favorites found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        </form>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($pagination['current_page'] > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?mod=favorite&act=list&page=<?= $pagination['current_page'] - 1 ?><?= isset($_GET['search']) ? '&search=' . htmlspecialchars($_GET['search']) : '' ?>" aria-label="Previous">&laquo;</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                    <li class="page-item <?= $i == $pagination['current_page'] ? 'active' : '' ?>">
                        <a class="page-link" href="?mod=favorite&act=list&page=<?= $i ?><?= isset($_GET['search']) ? '&search=' . htmlspecialchars($_GET['search']) : '' ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                    <li class="page-item">
                        <a class="page-link" href="?mod=favorite&act=list&page=<?= $pagination['current_page'] + 1 ?><?= isset($_GET['search']) ? '&search=' . htmlspecialchars($_GET['search']) : '' ?>" aria-label="Next">&raquo;</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>