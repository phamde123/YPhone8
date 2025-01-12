<?php include '../view/admin/layout/header.php'; ?>
<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-xxl">

        <div class="row">
            <form action="index.php?act=category_edit&id=<?= $getCategory["cate_id"] ?>" method="post" enctype="multipart/form-data">
                <div class="col-xl-9 col-lg-8 ">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Thêm hình ảnh đại diện</h4>
                        </div>
                        <div class="card-body">
                            <!-- File Upload -->
                            <img src="./images/category/<?= $getCategory["image"] ?>" class="mb-3" width="90px" alt="">
                            <input type="file" name="image" class="form-control">
                            <input type="hidden" name="old_image" value="<?= $getCategory["image"] ?>">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Thêm Danh Mục</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="meta-title" class="form-label">Tên Danh Mục</label>
                                        <input type="text" id="meta-title" name="name" class="form-control" placeholder="Nhập tên danh mục ..." value="<?= $getCategory["name"] ?>">
                                        <?php if (isset($_SESSION['errors']['name'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['errors']['name'] ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="crater" class="form-label">Trạng Thái</label>
                                    <select class="form-control" id="crater" name="status" data-choices data-choices-groups data-placeholder="Chọn Trạng Thái">
                                        <option value="">Chọn trạng thái</option>
                                        <option value="Active" <?= $getCategory["status"] == 'Active' ? 'selected' : '' ?>>Active</option>
                                        <option value="Hidden" <?= $getCategory["status"] == 'Hidden' ? 'selected' : '' ?>>Hidden</option>
                                    </select>
                                    <?php if (isset($_SESSION['errors']['status'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['status'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-0">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea class="form-control bg-light-subtle" name="description" id="description" rows="4" placeholder="Nhập mô tả ..."><?= $getCategory["description"] ?></textarea>
                                        <?php if (isset($_SESSION['errors']['description'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['errors']['description'] ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">
                            <div class="col-lg-2">
                                <button type="submit" name="updateCategory" class="btn btn-outline-secondary w-100">Cập nhật </button>
                            </div>
                            <div class="col-lg-2">
                                <a href="index.php?act=category" class="btn btn-primary w-100">Quay Lại</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- End Container Fluid -->



</div>
<?php include '../view/admin/layout/footer.php'; ?>