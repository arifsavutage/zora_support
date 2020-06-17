<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<!-- Content Row -->
<div class="row">
    <?php
    $bulanku = 0;
    $bln_barang = 0;
    foreach ($permonths as $bulanan) {
        $m_decode   = json_decode($bulanan['PRODUCT_DETAIL'], true);

        $total_monthly = 0;
        $total_barang  = 0;
        foreach ($m_decode as $month) {
            $total_monthly += $month['subtotal'];
            $total_barang  += $month['qty'];
        }

        $bulanku += $total_monthly;
        $bln_barang += $total_barang;
    }
    ?>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan Bulanan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp. <?= number_format($bulanku, 0, ',', '.') ?>
                            <br /> <small style="font-size:12px;" class="text-muted"><?= date('M Y') ?></small>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <?php
    $tahunku = 0;
    foreach ($peryears as $tahunan) {
        $y_decode   = json_decode($tahunan['PRODUCT_DETAIL'], true);

        $total_year = 0;
        foreach ($y_decode as $year) {
            $total_year += $year['subtotal'];
        }
        $tahunku += $total_year;
    }
    ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pendapatan Tahunan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp. <?= number_format($tahunku, 0, ',', '.') ?>
                            <br /> <small style="font-size:12px;" class="text-muted"><?= date('Y') ?></small>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Produk Terjual Bulanan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= stock($bln_barang); ?>
                            <br /> <small style="font-size:12px;" class="text-muted"><?= date('M Y') ?></small>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tunggakan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= count($tunggakan) ?> Transaksi
                            <br /> <small style="font-size:12px;" class="text-muted"><?= date('M Y') ?></small>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Produk Terlaris</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            3 Produk
                            <br /> <small style="font-size:12px;" class="text-muted"><?= date('M Y') ?></small>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-gift fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Marketing Teratas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            5 Orang
                            <br /> <small style="font-size:12px;" class="text-muted"><?= date('M Y') ?></small>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Agen Teratas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            10 Orang
                            <br /> <small style="font-size:12px;" class="text-muted"><?= date('M Y') ?></small>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Sub Agen Teratas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            20 Orang
                            <br /> <small style="font-size:12px;" class="text-muted"><?= date('M Y') ?></small>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-md-12 col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart 
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Referral
                    </span>
                </div>
            </div>
        </div>
    </div>-->
</div>