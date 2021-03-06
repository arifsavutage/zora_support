<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;font-family: Arial, 'Raleway';background-color:#e3e3e3;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color:#ffffff;-moz-box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5);-webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);">
                    <tr>
                        <td align="center" style="padding: 40px 0 30px 0;background-color: #812aa3;background-image: linear-gradient(to bottom right, #812aa3, #bf19b1);">
                            <img src="<?= base_url(); ?>template/img/large-white.jpeg" alt="Tabung Emas Digital" style="display: block;width:600px;" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px 40px 30px;">
                            <h3 style="color:#5f1d80;border-bottom: thin solid #cccccc;border-collapse: collapse;padding-bottom:30px;">Hallo, <?= $nama; ?></h3>

                            <p style="margin-bottom:50px;color:#6e6e6e;">
                                Kami telah menerima permintaan Anda untuk mengganti kata sandi silahkan tekan tombol di bawah untuk merubah password,
                                tetapi jika Anda tidak merasa mengirim permintaan ini silahkan abaikan email yang kami kirim.
                            </p>

                            <a href="<?= base_url(); ?>index.php/home/update_password/<?= $id; ?>" target="_blank" style="margin:auto;display:block;padding: 15px 10px;background-color:#2aa371;text-decoration:none;color:#ffffff;width:120px;text-align:center;border-radius:5px;">Konfirm</a>
                            <p style="margin-top:50px;margin-bottom: 20px;color:#6e6e6e;">
                                Jika tidak berhasil silahkan copy & paste url berikut :
                            </p>
                            <p style="display:block;padding:30px 20px;background-color:#f2f2f2;color:#877b8c;">
                                <?= base_url(); ?>index.php/home/update_password/<?= $id; ?>
                            </p>

                            <p style="margin-top:65px;color:#6e6e6e;">
                                Salam hangat,<br />
                                Admin
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px 40px 30px;background-color:#72d686;text-align:center;">
                            <a href="https://www.zlasupport.com/" target="_blank" style="color:#ffffff;text-decoration:none;">www.zlasupport.com</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>