<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ingin keluar dari sistem?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tekan tombol "Ya" jika ingin benr - benar keluar dari sistem.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url() ?>index.php/home/logout">Ya</a>
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

<!-- DateRangePicker JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
    //fungsi untuk filtering data berdasarkan tanggal 
    var start_date;
    var end_date;
    var DateFilterFunction = (function(oSettings, aData, iDataIndex) {
        var dateStart = parseDateValue(start_date);
        var dateEnd = parseDateValue(end_date);
        //Kolom tanggal yang akan kita gunakan berada dalam urutan 2, karena dihitung mulai dari 0
        //nama depan = 0
        //nama belakang = 1
        //tanggal terdaftar =2
        var evalDate = parseDateValue(aData[1]);
        if ((isNaN(dateStart) && isNaN(dateEnd)) ||
            (isNaN(dateStart) && evalDate <= dateEnd) ||
            (dateStart <= evalDate && isNaN(dateEnd)) ||
            (dateStart <= evalDate && evalDate <= dateEnd)) {
            return true;
        }
        return false;
    });

    // fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona aktubrowser
    function parseDateValue(rawDate) {
        var dateArray = rawDate.split("/");
        var parsedDate = new Date(dateArray[2], parseInt(dateArray[1]) - 1, dateArray[0]); // -1 because months are from 0 to 11   
        return parsedDate;
    }

    $(document).ready(function() {
        //konfigurasi DataTable pada tabel dengan id daterange dan menambahkan  div class dateseacrhbox dengan dom untuk meletakkan inputan daterangepicker
        var $dTable = $('#daterange').DataTable({
            /*"dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datesearchbox'>><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>"*/
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5'
                },
                {
                    extend: 'pdfHtml5'
                }
            ]
        });

        //menambahkan daterangepicker di dalam datatables
        $("div.datesearchbox").html('<div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><i class="fas fa-calendar"></i></div> </div><input type="text" class="form-control" id="datesearch" placeholder="Search by date range.."> </div>');

        document.getElementsByClassName("datesearchbox")[0].style.textAlign = "right";

        //konfigurasi daterangepicker pada input dengan id datesearch
        $('#datesearch').daterangepicker({
            autoUpdateInput: false
        });

        //menangani proses saat apply date range
        $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            start_date = picker.startDate.format('DD/MM/YYYY');
            end_date = picker.endDate.format('DD/MM/YYYY');
            $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
            $dTable.draw();
        });

        $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            start_date = '';
            end_date = '';
            $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
            $dTable.draw();
        });
    });
</script>

<!-- penghasilan chart-->
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart Example
    var cData = JSON.parse('<?php echo $chart_data; ?>');
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            //labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            labels: cData.label,
            datasets: [{
                label: "Pendapatan",
                //lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 3,
                pointBorderWidth: 2,
                //data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                data: cData.value,
            }, {
                label: "Pengeluaran",
                lineTension: 0.3,
                backgroundColor: "rgba(248, 108, 108, 0.05)",
                borderColor: "rgba(248, 108, 108, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(248, 108, 108, 1)",
                pointBorderColor: "rgba(248, 108, 108, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(248, 108, 108, 1)",
                pointHoverBorderColor: "rgba(248, 108, 108, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                //data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                data: cData.spending,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return 'Rp.' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: true
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': Rp.' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>

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
        $('#first-name').each(function() {
            var str = $(this).text();
            var matches = str.match(/\b(\w)/g);
            var acronym = matches.join('');
            $(this).prepend('<span style="background-color:<?= $this->session->userdata('color') ?>;">' + acronym + '</span>')
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

        //apotik
        $('#examplessss').on('click', '.select', function() {
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
        $('#examplessss').DataTable();

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

        // Marketing Detail
        $('#marketingDetail').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var modal = $(this)
            $.ajax({
                type: "GET",
                url: "<?= site_url('admin/master/marketing/detail/') ?>" + id,
                dataType: "json",
                success: function(response) {
                    var photo = (response.PHOTO == '') ? '0.png' : response.PHOTO;
                    var ktp = (response.SCAN_ID == '') ? '0.png' : response.SCAN_ID;
                    modal.find('.fotoprofile').attr('src', '<?= base_url('uploads/') ?>' + photo);
                    modal.find('.nama').text(response.MARKETING_NAME);
                    modal.find('.noktp').text(response.ID_CARD);
                    modal.find('.alamat').text(response.MARKETING_ADDRESS);
                    modal.find('.notelp').text(response.MARKETING_PHONE);
                    modal.find('.join').text(response.JOIN_DATE);
                    modal.find('.ktp').attr('src', '<?= base_url('uploads/') ?>' + ktp);
                }
            });
        });

        // Agen Detail
        $('#agenDetail').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var modal = $(this)
            $.ajax({
                type: "GET",
                url: "<?= site_url('admin/master/agen/detail/') ?>" + id,
                dataType: "json",
                success: function(response) {
                    var photo = (response.PHOTO == '') ? '0.png' : response.PHOTO;
                    var ktp = (response.SCAN_ID_CARD == '') ? '0.png' : response.SCAN_ID_CARD;
                    modal.find('.fotoprofile').attr('src', '<?= base_url('uploads/') ?>' + photo);
                    modal.find('.nama').text(response.AGEN_NAME);
                    modal.find('.noktp').text(response.ID_CARD);
                    modal.find('.alamat').text(response.AGEN_ADDRESS);
                    modal.find('.notelp').text(response.AGEN_PHONE);
                    modal.find('.join').text(response.JOIN_DATE);
                    modal.find('.ktp').attr('src', '<?= base_url('uploads/') ?>' + ktp);
                    modal.find('.area').text(response.AREA);
                    modal.find('.marketing').text(response.MARKETING_ID);
                }
            });
        });

        // Sub Agen Detail
        $('#subagenDetail').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var modal = $(this)
            $.ajax({
                type: "GET",
                url: "<?= site_url('admin/master/subagen/detail/') ?>" + id,
                dataType: "json",
                success: function(response) {
                    var photo = (response.PHOTO == '') ? '0.png' : response.PHOTO;
                    var ktp = (response.SCAN_ID_CARD == '') ? '0.png' : response.SCAN_ID_CARD;
                    modal.find('.fotoprofile').attr('src', '<?= base_url('uploads/') ?>' + photo);
                    modal.find('.nama').text(response.SUBAGEN_NAME);
                    modal.find('.noktp').text(response.ID_CARD);
                    modal.find('.alamat').text(response.SUBAGEN_ADDRESS);
                    modal.find('.notelp').text(response.SUBAGEN_PHONE);
                    modal.find('.join').text(response.JOIN_DATE);
                    modal.find('.ktp').attr('src', '<?= base_url('uploads/') ?>' + ktp);
                    modal.find('.area').text(response.AREA);
                    modal.find('.agen').text(response.AGEN_ID);
                }
            });
        });
    });
</script>
</body>

</html>