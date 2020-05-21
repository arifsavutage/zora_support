<?php
function kirim_email($to, $subject, $message)
{
    $ci = &get_instance();

    //konfigurasi
    $config        = array(

        'mailtype'   => 'html',
        'charset'    => 'iso-8859-1',
        'wordwrap'   => true
    );

    $ci->load->library('email');
    $ci->email->initialize($config);

    $ci->email->set_newline("\r\n");
    $ci->email->from('noreply@zlasupport.com', 'no-reply');
    $ci->email->to($to);
    $ci->email->subject($subject);
    $ci->email->message($message);

    if ($ci->email->send()) {
        $ci->session->set_flashdata('sendmail', '
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>info :</h4> cek inbox email atau folder spam
            </div>');
        redirect(base_url() . "index.php/home/forgot_password");
    } else {
        $ci->session->set_flashdata('sendmail', '
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>warning :</h4> ' . show_error($ci->email->print_debugger()) . '
            </div>');

        redirect(base_url() . "index.php/home/forgot_password");
    }
}
