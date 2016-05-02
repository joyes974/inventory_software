<?php

/**
 * Description of common_helper
 *
 * @author tamal
 */
class common {

    public static function redirect() {
        $CI = & get_instance();
        $uri = $CI->session->userdata('cur_uri');
        redirect($uri);
    }

    public static function track_uri() {
        $CI = & get_instance();
        $uri = $CI->uri->uri_string();
        $CI->session->set_userdata('cur_uri', $uri);
    }
    public static function is_logged_in() {
        $CI = & get_instance();
        if ($CI->session->userdata('logged_in')) {
            return true;
        } else {
            return false;
        }
    }

    function is_admin() {
        $CI = & get_instance();
        if ($CI->session->userdata('logged_in') && $CI->session->userdata('user_name') == 'admin') {
            return true;
        } else {
            common::redirect();
        }
    }
	function purchase_permit() {
        $CI = & get_instance();
		
		
        if  (($CI->session->userdata('permission') == 1)||($CI->session->userdata('permission') == 3)){
            return true;
        } else {
             return false;
        }
    }
	function sale_permit() {
        $CI = & get_instance();
		
        if  (($CI->session->userdata('permission') == 2)||($CI->session->userdata('permission') == 3)){
            return true;
        } else {
             return false;
        }
    }

    function is_admin_logged() {
        $CI = & get_instance();
        if ($CI->session->userdata('logged_in') && $CI->session->userdata('user_name') == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public static function is_admin_user() {
        $CI = & get_instance();
        if ($CI->session->userdata('logged_in') && $CI->session->userdata('user_type') == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public static function is_logged() {
        $CI = & get_instance();
        if (!$CI->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public static function nav_menu_link($nav_array) {
        $link = "<div class='nav_menu'>";
        if (is_array($nav_array)) {
            $link.="<a href='" . site_url('home') . "'>Home</a> &raquo; ";
            foreach ($nav_array as $nav) {
                if ($nav[url] != '') {
                    $link.="<a href='" . $nav[url] . "'>$nav[title]</a> &raquo; ";
                } else {
                    $link.="<span class='b'>$nav[title]</span>";
                }
            }
        }
        $link.="</div>";
        return $link;
    }

    public static function status($status='') {
        if ($status == 1) {
            return 'Active';
        } else {
            return 'Inactive';
        }
    }

    public static function change_status($table, $con, $status) {
        $CI = & get_instance();
        $sql = "update $table set status=$status where $con";
        return $CI->db->query($sql);
    }

    public static function mail_sending($from_name, $from_email, $to_email, $subject, $msg_content) {
        $CI = & get_instance();
        $CI->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $CI->email->initialize($config);

        $CI->email->from($from_email, $from_name);
        $CI->email->to($to_email);
        $CI->email->subject($subject);
        $CI->email->message($msg_content);
        $CI->email->send();
        //echo $CI->email->print_debugger();
    }

    public static function view_permit() {
        $CI = & get_instance();
        $permit = $CI->session->userdata('permission');

        if ($permit == 1 || $permit == 3 || $permit == 5 || $permit == 7) {
            return true;
        } else {
            return false;
        }
    }

    public static function add_permit($permit='') {
        $CI = & get_instance();
        if ($permit == '') {
            $permit = $CI->session->userdata('permission');
        }
        if ($permit == 2 || $permit == 3 || $permit == 6 || $permit == 7) {
            return true;
        } else {
            return false;
        }
    }

    public static function update_permit($permit='') {
        $CI = & get_instance();
        if ($permit == '') {
            $permit = $CI->session->userdata('permission');
        }
        if ($permit == 4 || $permit == 5 || $permit == 6 || $permit == 7) {
            return true;
        } else {
            return false;
        }
    }

    function getVar($var, $default='') {
        if (isset($_REQUEST[$var]) && !empty($_REQUEST[$var]))
            return $_REQUEST[$var];
        elseif (!empty($default)) {
            return $default;
        }
        else
            return "";
    }
}
?>