<h1 class="h3 mb-4 text-gray-800">Pengeluaran</h1>
<!-- TABEL PENGELUARAN -->
<h5>Total Pengeluaran : <span class="text-danger"><?= "Rp.".$totalPengeluaran  ?></span></h5>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Rincian</th>
            <th scope="col">Saldo Keluar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $num = 1;
        foreach ($pengeluaran as $p) : ?>
            <tr>
                <th scope="row"><?= $num++;  ?></th>
                <td><?= date("d-m-Y", $p['pengeluaran_date'])  ?></td>
                <td><?= $p['pengeluaran_rincian']  ?></td>
                <td class="text-danger">Rp.<?= $p['product_harga_beli'] . $p['biayaumum_saldo']  ?></td>
            </tr>
        <?php endforeach;  ?>
    </tbody>
</table>