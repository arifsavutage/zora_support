<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#exampleModal">
            Tambah Marketing
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form name="addsupier" method="post" action="" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Marketing</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="col">
                                    <label for="ktpmarketing">No. KTP</label>
                                    <input type="text" class="form-control" id="ktpmarketing" name="ktpmarketing" placeholder="no. KTP">
                                </div>
                                <div class="col">
                                    <label for="marketingname">Nama Marketing</label>
                                    <input type="text" class="form-control" id="marketingname" name="marketingname" placeholder="nama Lengkap">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamatmarketing">Alamat Marketing</label>
                                <textarea class="form-control" name="alamatmarketing" placeholder="alamat marketing"></textarea>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label for="telpmarketing">No. Telp</label>
                                    <input type="text" class="form-control" id="telpmarketing" name="telpmarketing" placeholder="No. Telp / HP">
                                </div>
                                <div class="col">
                                    <label for="fotoprofile">Foto Profile</label>
                                    <input type="file" class="form-control" id="fotoprofile" name="fotoprofile">
                                </div>
                                <div class="col">
                                    <label for="fotoktp">Scan KTP</label>
                                    <input type="file" class="form-control" id="fotoktp" name="fotoktp">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Suplier</th>
                                <th>Alamat</th>
                                <th>Telp.</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama Suplier</th>
                                <th>Alamat</th>
                                <th>Telp.</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning btn-sm mb-2" data-toggle="modal" data-target="#editsuplier">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editsuplier" tabindex="-1" role="dialog" aria-labelledby="editsuplierLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <form name="addsupier" method="post" action="">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editsuplierLabel">Edit Marketing</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="ktpmarketing">No. KTP</label>
                                                                <input type="text" class="form-control" id="ktpmarketing" name="ktpmarketing" placeholder="no. KTP">
                                                            </div>
                                                            <div class="col">
                                                                <label for="marketingname">Nama Marketing</label>
                                                                <input type="text" class="form-control" id="marketingname" name="marketingname" placeholder="nama Lengkap">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamatmarketing">Alamat Marketing</label>
                                                            <textarea class="form-control" name="alamatmarketing" placeholder="alamat marketing"></textarea>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="telpmarketing">No. Telp</label>
                                                                <input type="text" class="form-control" id="telpmarketing" name="telpmarketing" placeholder="No. Telp / HP">
                                                            </div>
                                                            <div class="col">
                                                                <label for="fotoprofile">Foto Profile</label>
                                                                <input type="file" class="form-control" id="fotoprofile" name="fotoprofile">
                                                            </div>
                                                            <div class="col">
                                                                <label for="fotoktp">Scan KTP</label>
                                                                <input type="file" class="form-control" id="fotoktp" name="fotoktp">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning btn-sm mb-2" data-toggle="modal" data-target="#editsuplier">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editsuplier" tabindex="-1" role="dialog" aria-labelledby="editsuplierLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form name="addsupier" method="post" action="">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editsuplierLabel">Tambah Suplier</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="supliername">Nama Supier</label>
                                                            <input type="text" class="form-control" id="supliername" name="supliername" placeholder="nama suplier">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="supliername">Alamat Suplier</label>
                                                            <textarea class="form-control" name="suplieraddress" placeholder="alamat suplier"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="suplierphone">No. Telp</label>
                                                            <input type="text" class="form-control" id="suplierphone" name="suplierphone" placeholder="No. Telp">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning btn-sm mb-2" data-toggle="modal" data-target="#editsuplier">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editsuplier" tabindex="-1" role="dialog" aria-labelledby="editsuplierLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form name="addsupier" method="post" action="">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editsuplierLabel">Tambah Suplier</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="supliername">Nama Supier</label>
                                                            <input type="text" class="form-control" id="supliername" name="supliername" placeholder="nama suplier">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="supliername">Alamat Suplier</label>
                                                            <textarea class="form-control" name="suplieraddress" placeholder="alamat suplier"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="suplierphone">No. Telp</label>
                                                            <input type="text" class="form-control" id="suplierphone" name="suplierphone" placeholder="No. Telp">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>