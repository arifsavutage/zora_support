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
                <form name="editaccount" method="post" action="">
                    <input type="hidden" name="id" value="<?= $detail['ID']; ?>" />
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" value="<?= $detail['USERNAME'] ?>" class="form-control" id="username" name="username" placeholder="username">
                        <small class="form-text text-danger"><?= form_error('username') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" value="<?= $detail['EMAIL'] ?>" class="form-control" id="email" name="email" placeholder="email">
                        <small class="form-text text-danger"><?= form_error('email') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" class="form-control">
                            <option value="">Pilih</option>
                            <?php
                            foreach ($level as $lvl) :
                            ?>
                                <option value="<?= $lvl ?>" <?php if ($lvl == $detail['LEVEL']) echo 'selected'; ?>><?= ucfirst($lvl) ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('level') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Default Pass</label>
                        <input type="text" class="form-control" value="<?= $randpass ?>" id="password" name="password" placeholder="password" readonly="true">
                        <small class="form-text text-danger"><?= form_error('password') ?></small>
                        <small class="form-text">Catat password sebelum disimpan</small>
                    </div>

                    <a href="<?= site_url('admin/user/account/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>