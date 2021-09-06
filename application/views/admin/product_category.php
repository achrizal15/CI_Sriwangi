<h1 class="h3 mb-4 text-gray-800">Product Category</h1>
<!-- TABEL KATEGORI -->
<div class="row">
    <div class="col-lg-6">
        <div class="pcAlert" role="alert"> </div>
        <?php echo $this->session->flashdata('message');
        unset($_SESSION['message']);
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Category</th>
                    <th scope="col" width="25%">Handle</th>
                </tr>
            </thead>
            <tbody id='dftrCategory'>
                <?php
                $number = 1;
                foreach ($category as $cg) : ?>
                    <tr>
                        <th scope="row"><?= $number++;  ?></th>
                        <td><?= "PC" . $cg->category_id  ?></td>
                        <td><?= ucwords($cg->category_name)  ?></td>
                        <td width="25%">
                            <a role="button" class="btn badge badge-danger" onclick="pcKategoriDelete(<?=$cg->category_id  ?>)">DELETE</a>
                            <a role="button" class="btn badge badge-warning editCategory" data-toggle="modal" onclick="getCategory(<?=$cg->category_id ?>)" data-target="#editKategory">EDIT</a>
                        </td>
                    </tr>
                <?php endforeach  ?>
            </tbody>
        </table>
    </div>
    <!-- FORM -->
    <div class="col-lg-6">
        <form action="" method="post">
            <div class="form-group">
                <label for="addCategory">Tambah Category</label>
                <input name="kategory" type="text" class="form-control" id="addCategory" placeholder="Enter Category Contoh: Makanan,Minuman dll">
                <?= form_error('kategory', "<small class='pl-2 text-danger'>", "</small>") ?>
            </div>
            <button name="addcategory" type="submit" class="btn btn-primary">Tambah Kategory</button>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editKategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
            </div>
            <form action="<?= base_url("ProductCategory/editCategory") ?>" method="post">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">PC80</span>
                        </div>
                        <input value="" type="text" id="inputID" name="id" hidden>
                        <input type="text" class="form-control" placeholder="category" name="category1" id="inputCategory" aria-label="category" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updateData" class="btn btn-primary">Update changes</button>
                </div>
            </form>
        </div>
    </div>
</div>