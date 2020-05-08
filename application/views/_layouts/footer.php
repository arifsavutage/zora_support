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
<script>
    $(document).ready(function() {
        $('#example').DataTable();

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

        $('#agenid').change(function(){
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