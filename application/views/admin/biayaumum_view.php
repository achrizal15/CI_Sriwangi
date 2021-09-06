<h1 class="h3 mb-4 text-gray-800">Biaya Umum</h1>
<!-- ERROR MESSAGE -->
<div>
    <?php echo $this->session->flashdata('message');
    unset($_SESSION['message']);
    ?>
    <?= form_error('namebiayaumum', PREFX, SUFX)  ?>
    <?= form_error('saldobiayaumum', PREFX, SUFX)  ?>
    <?= form_error('rincianbiayaumum', PREFX, SUFX)  ?>
</div>
<!-- Button trigger modal -->
<div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahBiayaUmum">
        Tambah Data
    </button>
</div>
<!-- Table -->
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Nama Biaya Umum</th>
            <th scope="col">Saldo Digunakan</th>
            <th scope="col">Rincian</th>
            <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $num = 1;
        foreach ($biayaumum as $b) :  ?>
            <tr>
                <th scope="row"><?= $num++;  ?></th>
                <td><?= date("d-m-Y", $b->biayaumum_date)  ?></td>
                <td><?= $b->biayaumum_name ?></td>
                <td><?= "Rp." . $b->biayaumum_saldo ?></td>
                <td><?= $b->biayaumum_rincian ?></td>
                <td>
                    <a href="<?= base_url('BiayaUmum/deleteData/' . $b->biayaumum_id) ?>" class="badge badge-danger">DELETE</a>
                    <a class="badge badge-warning editModalbiayaumum" data-id="<?= $b->biayaumum_id ?>" data-toggle="modal" data-target="#editBiayaUmum" role="button">EDIT</a>
                </td>
            </tr>
        <?php endforeach;  ?>
    </tbody>
</table>
<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="tambahBiayaUmum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Biaya Umum</h5>
            </div>
            <form action="<?= base_url("BiayaUmum")  ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputNamaBiayaUmum">Biaya Umum</label>
                        <input type="text" name="namebiayaumum" class="form-control" id="inputNamaBiayaUmum" value="<?= set_value('namebiayaumum')  ?>" placeholder="Contoh : Uang transport">
                    </div>
                    <div class="form-group">
                        <label for="inputSaldoBiayaUmum">Saldo Digunakan</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputSaldoBiayaUmum">Rp.</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Contoh : 20000" name="saldobiayaumum" required value="<?= set_value('saldobiayaumum')  ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRincianBiayaUmum">Rincian</label>
                        <textarea class="form-control" name="rincianbiayaumum" id="inputRincianBiayaUmum" rows="3" required><?= set_value('rincianbiayaumum')  ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="tambahbiayaumum" class="btn btn-primary">Tambah Biaya Umum</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editBiayaUmum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Biaya Umum</h5>
            </div>
            <form action="<?= base_url("BiayaUmum")  ?>" method="post">
                <div class="modal-body">
                    <!-- hidden -->
                    <input type="text" name="editID" id="editID" readonly hidden>
                    <input type="text" name="editDate" id="editDate" readonly hidden>
                    <div class="form-group">
                        <label for="editNamaBiayaUmum">Biaya Umum</label>
                        <input type="text" name="namebiayaumum" class="form-control" id="editNamaBiayaUmum" placeholder="Contoh : Uang transport">
                    </div>
                    <div class="form-group">
                        <label for="editSaldoBiayaUmum">Saldo Digunakan</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" class="form-control" id="editSaldoBiayaUmum" placeholder="Contoh : 20000" name="saldobiayaumum" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editRincianBiayaUmum">Rincian</label>
                        <textarea class="form-control" name="rincianbiayaumum" id="editRincianBiayaUmum" rows="3" required><?= set_value('rincianbiayaumum')  ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="editbiayaumum" class="btn btn-primary">Tambah Biaya Umum</button>
                </div>
            </form>
        </div>
    </div>
</div>