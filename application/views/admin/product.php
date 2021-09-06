<h1 class="h3 mb-4 text-gray-800">Product</h1>
<!-- MESSAGE -->
<div>
    <?php echo $this->session->flashdata('message');
    unset($_SESSION['message']);
    ?>
    <?= form_error("inputnamaproduk", PREFX, SUFX)  ?>
    <?= form_error("inputhargaproduk", PREFX, SUFX)  ?>
    <?= form_error("inputsatuanproduk", PREFX, SUFX)  ?>
    <?= form_error("inputstokproduk", PREFX, SUFX)  ?>
    <?= form_error("inputcategoryproduk", PREFX, SUFX)  ?>
    <?= form_error("inputgambarproduct", PREFX, SUFX)  ?>
</div>
<div class="mb-3 d-flex justify-content-end">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahProduct">
        Tambah Produk
    </button>
</div>
<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Produk</th>
            <th scope="col">Kategory</th>
            <th scope="col">Harga Jual</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Stok</th>
            <th>Handle</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $num = 1;
        foreach ($produk as $p) :  ?>
            <tr>
                <th><?= $num++  ?></th>
                <td><?= "P" . $p['product_id']  ?></td>
                <td><?= $p['product_name']  ?></td>
                <td><?= $p['category_name']  ?></td>
                <td><?= 'Rp.' . $p['product_harga_jual'] . "/" . $p['satuan_name']  ?></td>
                <td><?= 'Rp.' . $p['product_harga_beli'] ?></td>
                <td><?= $p['product_stock']  ?></td>
                <td class="text-center">
                    <a role="button" href="<?= base_url("product/deleteProduct/") . $p['product_id'];  ?>" class="btn badge badge-danger">DELETE</a>
                    <a role="button" class="btn badge badge-warning editprodukData" data-id="<?= $p['product_id'] ?>" data-toggle="modal" data-target="#editProduct">EDIT</a>
                </td>
            </tr>
        <?php endforeach;  ?>
    </tbody>
</table>
<!-- Modal TAMBAH -->
<div class="modal fade" id="tambahProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
            </div>
            <form action="<?= base_url("Product") ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputNamaProduk">Nama Produk</label>
                        <input type="text" required class="form-control" name="inputnamaproduk" id="inputNamaProduk" placeholder="Contoh : Indomie" value="<?= set_value('inputnamaproduk') ?>">
                    </div>
                    <!-- HARGA JUAL & BELI -->
                    <div class="row">
                        <div class="col form-group">
                            <label for="inputHargaProduk">Harga Jual</label>
                            <input maxlength="8" required id="inputHargaProduk" type="text" class="form-control" value="<?= set_value('inputhargaproduk') ?>" name="inputhargaproduk" placeholder="Contoh: 12000">
                        </div>
                        <div class="col form-group">
                            <label for="inputhargaBeliProduk">Harga Beli</label>
                            <input maxlength="8" required id="inputhargaBeliProduk" type="text" class="form-control" value="<?= set_value('inputhargabeliproduk') ?>" name="inputhargabeliproduk" placeholder="Contoh: 10000">
                        </div>
                    </div>
                    <!-- GAMBAR DAN CATEGORY -->
                    <div class="row">
                        <div class="col form-group">
                            <label for="inputGambarProduct">Gambar Product</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGambarProduct" accept="image/png, image/gif, image/jpeg" name="inputgambarproduct">
                                <label class="custom-file-label" for="inputGambarProduct">Upload Gambar</label>
                            </div>
                        </div>
                        <div class="col form-group">
                            <label for="inputCategoryProduk">Category</label>
                            <select name="inputcategoryproduk" required id="inputCategoryProduk" class="custom-select">
                                <option selected disabled>Pilih salah satu</option>
                                <?php foreach ($category as $c) :  ?>
                                    <option <?= (set_value('inputcategoryproduk') == $c['category_id'] ? "selected" : '');  ?> value="<?= $c['category_id'] ?>">
                                        <?= $c['category_name'] ?>
                                    </option>
                                <?php endforeach;  ?>
                            </select>
                        </div>
                    </div>
                    <!-- SATUAN DAN STOK -->
                    <div class="row">
                        <div class="col form-group">
                            <label for="inputStokProduk">Stok</label>
                            <input id="inputStokProduk" required maxlength="4" type="text" class="form-control" value="<?= set_value('inputstokproduk') ?>" name="inputstokproduk" placeholder="Contoh: 10">
                        </div>
                        <div class="col form-group">
                            <label for="inputSatuanProduk">Satuan</label>
                            <select required name="inputsatuanproduk" class="custom-select" id="inputSatuanProduk">
                                <option selected disabled>Pilih salah satu</option>
                                <?php foreach ($satuan as $s) :  ?>
                                    <option <?= (set_value('inputsatuanproduk') == $s['satuan_id'] ? "selected" : '');  ?> value=" <?= $s['satuan_id']  ?>"> <?= $s['satuan_name']  ?></option>
                                <?php endforeach;  ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" value="tambahproduk" name="submit" class="btn btn-primary">Tambah Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
            </div>
            <form action="<?= base_url("Product") ?>" method="post" enctype="multipart/form-data">
                <!-- hidden -->
                <input hidden type="text" name="idproduct" id="editIdProduk">
                <input hidden type="text" name="createproduct" id="editCreateProduk">
                <input hidden type="text" name="oldgambar" id="oldGambar">
                <!--  -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNamaProduk">Nama Produk</label>
                        <input type="text" required class="form-control" name="inputnamaproduk" id="editNamaProduk">
                    </div>

                    <div class="row">
                        <div class="col form-group">
                            <label for="editHargaProduk">Harga Jual</label>
                            <input maxlength="8" required id="editHargaProduk" type="text" class="form-control" name="inputhargaproduk">
                        </div>
                        <div class="col form-group">
                            <label for="editHargaBeliProduk">Harga Beli</label>
                            <input maxlength="8" required id="editHargaBeliProduk" type="text" class="form-control" name="inputhargabeliproduk" placeholder="Contoh: 10000">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="inputGambarProduct">Gambar Product</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"  id="editGambarProduct" accept="image/png, image/gif, image/jpeg" name="inputgambarproduct">
                                <label class="custom-file-label editFileImage" for="editGambarProduct">Upload Gambar</label>
                            </div>
                        </div>
                        <div class="col form-group">
                            <label for="editCategoryProduk">Category</label>
                            <select name="inputcategoryproduk" required id="editCategoryProduk" class="custom-select">
                                <!-- option-->
                            </select>
                        </div>
                    </div>
                    <!-- SATUAN DAN STOK -->
                    <div class="row">
                        <div class="col form-group">
                            <label for="editStokProduk">Stok</label>
                            <input id="editStokProduk" required maxlength="4" type="text" class="form-control" name="inputstokproduk">
                        </div>
                        <div class="col form-group">
                            <label for="editSatuanProduk">Satuan</label>
                            <select required name="inputsatuanproduk" class="custom-select" id="editSatuanProduk">
                                <!-- opsi -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" value="editproduk" name="submit" class="btn btn-primary">Edit Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>