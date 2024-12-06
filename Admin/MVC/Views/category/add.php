<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
    if(!empty($_SESSION['msg'])){
        echo '<span style="color:blue;font-weight:bold">'.$_SESSION['msg'].'</span>';
        unset($_SESSION['msg']);
    }
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold ">Add New Category</h2>
        </div>
        <div class="card-body">
            <form action="?mod=category&act=store" method="POST" enctype="multipart/form-data">
                <div class="row gap-5">
                    <div class="col-md-5">
                        <div class="form-group mb-3">
                            <label for="category_name">Category Name <span class="text-danger">*</span></label>
                            <input type="text" value="" name="category_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="category_img">Category Image <span class="text-danger">*</span></label>
                            <input type="file" name="category_img" class="form-control" required>
                            <!-- <div class="mt-2">
                                <img src="<?php echo BASE_URL ?>/uploaded/user.png" class="img-thumbnail" style="max-height: 150px;">
                            </div> -->
                        </div>
                        <div class="form-group mb-3">
                            <label>Status</label>
                            <input type="checkbox" class="form-check-input" value="1" name="category_status" id="status">
                            <label for="status">Active</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group mb-3">
                            <label for="parent_id">Parent Category</label>
                            <select name="parent_id" class="form-control">
                                <option selected value="">No Parent Category</option>
                                <?php foreach($parent_categories as $cate){ 
                                    extract($cate); ?>
                                    <option value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="category_desc">Description <span class="text-danger">*</span></label>
                            <textarea name="category_desc" class="form-control" rows="3" required></textarea>
                        </div>
                        
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Category
                        </button>
                        <a href="?mod=category&act=list" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>