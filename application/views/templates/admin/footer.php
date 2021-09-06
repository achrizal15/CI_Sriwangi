</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tekan
                "Logout", jika ingin melanjutkan.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/')  ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/')  ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/')  ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/')  ?>js/sb-admin-2.min.js"></script>
<script>
    // UNTUK MENJALANKAN FILE INPUT
    $('#inputGambarProduct').on('change', function() {
        //get the file name
        var fileName = $(this).val().split('\\').pop();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
    $('#editGambarProduct').on('change', function() {
        //get the file name
        var fileName = $(this).val().split('\\').pop();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })

    function getCategory(id) {
        $.ajax({
            url: "<?= base_url("ProductCategory/getCategoryJson") ?>",
            method: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $("#inputID").val(data.category_id);
                $("#basic-addon1").html("PC" + data.category_id);
                $("#inputCategory").val(data.category_name);
            }
        })
    }

    function pcKategoriDelete(id) {
        let hapus = confirm("Apakah anda yakin ?")
        if (!hapus) {
            $('.pcAlert').addClass('alert alert-secondary');
            $('.pcAlert').html('Data batal dihapus!');
        } else {
            $.ajax({
                url: "<?= base_url("ProductCategory/hapusCategory")  ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: 'json',
                success: function(data) {
                    $('.pcAlert').addClass('alert alert-secondary ');
                    let tabel = '';
                    let i = 1;
                    if (data['error']) {
                        $('.pcAlert').html(data['message']);
                    } else {
                        data['data'].forEach(e => {
                            tabel += `<tr>
                    <th>${i++}</th>
                    <td>PC${e.category_id}</td>
                    <td>${e.category_name}</td>
                    <td>
                    <a role="button" class="btn badge badge-danger" onclick="pcKategoriDelete(${e.category_id})">DELETE</a>
                    <a role="button" class="btn badge badge-warning editCategory" data-toggle="modal" onclick="getCategory(${e.category_id})" data-target="#editKategory">EDIT</a>
                    </td>
                    </tr>`
                        });
                        $('#dftrCategory').html(tabel);
                        $('.pcAlert').html("Kategori sudah dihapus");
                    }

                }
            })
        }

    }
    // GETEDITCATEGORY
    $(function() {
        $(".editprodukData").on("click", function() {
            let id = $(this).data("id");
            $.ajax({
                url: "<?= base_url('product/get_edit_product')  ?>",
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    let id_p = data['product']['category_id'];
                    let s_p = data['product']['satuan_id'];
                    $("#editIdProduk").val(data['product']['product_id']);
                    $("#editCreateProduk").val(data['product']['product_date']);
                    $("#oldGambar").val(data['product']['product_image']);
                    $("#editNamaProduk").val(data['product']['product_name']);
                    $("#editHargaProduk").val(data['product']['product_harga_jual']);
                    $("#editHargaBeliProduk").val(data['product']['product_harga_beli']);
                    $(".editFileImage").html(data['product']['product_image'])
                    $("#editStokProduk").val(data['product']['product_stock']);
                    // CATEGORY INPUT
                    data['category'].forEach(e => {
                        if (id_p == e.category_id) {
                            $("#editCategoryProduk").append(`<option selected value="${e.category_id}">${e.category_name}</option>`);
                        } else {
                            $("#editCategoryProduk").append(`<option value="${e.category_id}">${e.category_name}</option>`);
                        }
                    });
                    // SATUAN INPUT
                    data['satuan'].forEach(s => {
                        if (s_p == s.satuan_id) {
                            $("#editSatuanProduk").append(`<option selected 
                        value="${s.satuan_id}">${s['satuan_name']}</option>`)
                        } else {
                            $("#editSatuanProduk").append(`<option 
                        value="${s.satuan_id}">${s['satuan_name']}</option>`)
                        }
                    });

                }
            })
        })
    })
    // GETEDITBIAYAUMUM
    $(function() {
        $(".editModalbiayaumum").click(function() {
            let id = $(this).data('id');
            $.ajax({
                url: '<?= base_url('BiayaUmum/getEdit') ?>',
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $("#editID").val(data['biayaumum_id']);
                    $("#editDate").val(data['biayaumum_date']);
                    $("#editNamaBiayaUmum").val(data['biayaumum_name']);
                    $("#editSaldoBiayaUmum").val(data['biayaumum_saldo']);
                    $("#editRincianBiayaUmum").html(data['biayaumum_rincian'])
                }
            })
        })
    })
</script>
</body>

</html>