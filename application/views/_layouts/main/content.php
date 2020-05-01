<!-- Main Content -->
<div id="content">

    <?php $this->load->view('_layouts/main/topnav'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <?php
        if (isset($page)) {
            $this->load->view($page);
        }
        ?>

    </div>
    <!-- /.container-fluid -->

    <?php $this->load->view('_layouts/main/footer_title'); ?>
</div>
<!-- End of Main Content -->