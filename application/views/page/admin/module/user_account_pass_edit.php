<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo "<br/>";
                    echo $this->session->flashdata('info');
                }
                #echo $this->db->last_query();
                ?>
                <form name="editpass" method="post" action="">
                    <input type="hidden" name="id" value="<?= $detail['ID']; ?>" />
                    <div class="form-group">
                        <label for="oldpass">Password Lama</label>
                        <input type="password" value="" class="form-control" id="oldpass" name="oldpass" placeholder="oldpass">
                        <small class="form-text text-danger"><?= form_error('oldpass') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="newpass">Password Baru</label>
                        <input type="password" value="" class="form-control" id="newpass" name="newpass" placeholder="newpass">
                        <small class="form-text text-danger"><?= form_error('newpass') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="newpass2">Re-Type Password</label>
                        <input type="password" value="" class="form-control" id="newpass2" name="newpass2" placeholder="newpass2">
                        <small class="form-text text-danger"><?= form_error('newpass2') ?></small>
                    </div>

                    <button type="submit" class="btn btn-danger float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>