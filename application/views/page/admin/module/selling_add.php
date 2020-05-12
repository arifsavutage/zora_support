<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalagen">
                            Agen
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalagen" tabindex="-1" role="dialog" aria-labelledby="modalagenLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalagenLabel">Daftar Agen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered" id="example">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Agen</th>
                                                    <th><i class="fa fa-cog"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($agen as $agn) :
                                                ?>
                                                    <tr>
                                                        <td><?= $agn->ID ?></td>
                                                        <td><?= $agn->AGEN_NAME ?></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-danger select">Pilih</button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#subagen">
                            Sub Agen
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="subagen" tabindex="-1" role="dialog" aria-labelledby="subagenLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="subagenLabel">Daftar Subagen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered" id="example1">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Subagen</th>
                                                    <th><i class="fa fa-cog"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($subagen as $subagn) :
                                                ?>
                                                    <tr>
                                                        <td><?= $subagn->ID ?></td>
                                                        <td><?= $subagn->SUBAGEN_NAME ?></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-danger select">Pilih</button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form name="addsell" method="post" action="">

                    <div class="form-row">
                        <div class="col">
                            <label for="idpembeli">ID Pembeli</label>
                            <input type="text" class="form-control" name="idpembeli" id="idpembeli" readonly="true" />
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="namapembeli">Nama Pembeli</label>
                            <input type="text" class="form-control" name="namapembeli" id="namapembeli" readonly="true" />
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="sellertype">Status</label>
                            <input type="text" class="form-control" name="sellertype" id="sellertype" readonly="true" />
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="qty">Qty</label>
                            <input type="text" class="form-control" id="qty" name="qty" placeholder="qty">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="hargabeli">Harga Beli</label>
                            <input type="text" class="form-control" id="hargabeli" name="hargabeli" placeholder="harga beli per item">
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="tglpo">Tgl PO</label>
                            <input type="text" class="form-control date1" id="tglpo" name="tglpo" placeholder="tgl po" readonly="true">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="tglkirim">Tgl Kirim</label>
                            <input type="text" class="form-control date1" id="tglkirim" name="tglkirim" placeholder="tgl kirim" readonly="true">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="tglsampai">Tgl Sampai</label>
                            <input type="text" class="form-control date1" id="tglsampai" name="tglsampai" placeholder="tgl sampai" readonly="true">
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>

                    <a href="<?= site_url('admin/master/selling/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>