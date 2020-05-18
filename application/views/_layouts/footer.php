<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

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
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>template/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>template/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>template/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url(); ?>template/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>template/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url(); ?>template/js/demo/chart-pie-demo.js"></script>


<!-- Page level plugins -->
<script src="<?= base_url(); ?>template/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<!-- DatePicker JS -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
        $('.add_cart').click(function() {
            var product_id = $('#idproduk').val();
            var product_name = $('#item').val();
            var product_price = $('#harga').val();
            var quantity = $('#qty').val();

            $.ajax({
                url: "<?php echo site_url('sell/add_to_cart'); ?>",
                method: "POST",
                data: {
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    quantity: quantity
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });

        $('#detail_cart').load("<?php echo site_url('sell/load_cart'); ?>");


        $(document).on('click', '.romove_cart', function() {
            var row_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('sell/delete_cart'); ?>",
                method: "POST",
                data: {
                    row_id: row_id
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#metode').change(function() {
            var metode = $(this).val();

            if (metode == 'tunai') {
                $('#jmlcicilan').attr("readonly", true);
                $('#jmlcicilan').val(0);
            } else {
                $('#jmlcicilan').attr("readonly", false);
                $('#jmlcicilan').val('');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#examples').on('click', '.select', function() {
            var currentRow = $(this).closest('tr');

            var col1 = currentRow.find("td:eq(0)").text();
            var col2 = currentRow.find("td:eq(1)").text();
            var col3 = currentRow.find("td:eq(2)").text();

            //var data = col1 + "\n" + col2;
            $('#idpembeli').val(col1);
            $('#namapembeli').val(col2);
            $('#sellertype').val(col3);

            alert("Pembeli sudah dipilih");
        });

        //subagen
        $('#exampless').on('click', '.select', function() {
            var currentRow = $(this).closest('tr');

            var col1 = currentRow.find("td:eq(0)").text();
            var col2 = currentRow.find("td:eq(1)").text();
            var col3 = currentRow.find("td:eq(2)").text();

            //var data = col1 + "\n" + col2;
            $('#idpembeli').val(col1);
            $('#namapembeli').val(col2);
            $('#sellertype').val(col3);

            alert("Pembeli sudah dipilih");
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#examplesss').on('click', '.select-item', function() {
            var currentRow = $(this).closest('tr');

            var col1 = currentRow.find("td:eq(0)").text();
            var col2 = currentRow.find("td:eq(1)").text();
            var col3 = currentRow.find("td:eq(2)").text();

            //var data = col1 + "\n" + col2;
            $('#idproduk').val(col1);
            $('#item').val(col2);
            $('#harga').val(col3);

            alert("Item produk sudah dipilih");
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.date1').datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>
<script>
    $(document).ready(function() {
        var judul = $('#judul-berkas').val();
        $('#export').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    title: judul
                },
                {
                    extend: 'pdfHtml5',
                    title: judul
                }
            ]
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $('#examples').DataTable();
        $('#exampless').DataTable();
        $('#examplesss').DataTable();

        $('#provinsi').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('admin/getKabkota'); ?>",
                method: "POST",
                data: {
                    provinsi: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].city_name + ' - ' + data[i].type + '</option>';
                    }
                    $('#kabkota').html(html);
                }
            });
            return false;
        });

        $('#kabkota').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('admin/getKec'); ?>",
                method: "POST",
                data: {
                    kabkota: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].subdistrict_name + '</option>';
                    }
                    $('#areasubagen').html(html);
                }
            });
            return false;
        });

        $('#agenid').change(function() {
            var agenid = $(this).val();
            $.ajax({
                url: "<?php echo site_url('admin/getCityProvinceByAgenId'); ?>",
                method: "POST",
                data: {
                    agenid: agenid
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#provinsi').val(data.province_id);
                    $('#provinsi').prop('disabled', 'disabled');
                    $('#kabkota').html('<option value=' + data.AREA + '>' + data.city_name + ' - ' + data.type + '</option>');
                    $('#kabkota').prop('disabled', 'disabled');
                    var html = '';
                    var i;
                    for (i = 0; i < data.areasubagen.length; i++) {
                        html += '<option value=' + data.areasubagen[i].id + '>' + data.areasubagen[i].subdistrict_name + '</option>';
                    }
                    $('#areasubagen').html(html);
                }
            });
            return false;
        });
    });
</script>
</body>

</html>