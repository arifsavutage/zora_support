<!DOCTYPE html>
<html>

<head>
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        table {
            width: 100%;
            border: 0.1em solid #000000;
        }

        table tr {
            width: 100%;
            border: 0.1em solid #000000;
        }

        table tr th {
            background-color: cornflowerblue;
            color: white;
            padding: 10px 15px;
        }

        table tr td {
            padding: 10px 15px;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if (isset($page)) {
                            $this->load->view($page);
                        }
                        ?>
                    </div>
                    <div class="card-footer text-muted">
                        Created at : <?= date('d/m/Y H:i:s'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>