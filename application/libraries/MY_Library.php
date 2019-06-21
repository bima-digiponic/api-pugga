<?php
/**
 * Created by PhpStorm.
 * User: - ASUS -
 * Date: 11/13/2018
 * Time: 11:12 AM
 */

//namespace Restserver\Libraries;
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Library
{
    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function sendEmail($receiver, $subject, $data)
    {
        $config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'cs.tempati@gmail.com',
            'smtp_pass' => 'tempatin.aja',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->CI->load->library('email', $config);
        $this->CI->email->set_newline("\r\n");
        $this->CI->email->from('cs.tempati@gmail.com', 'Tempati Customer Service');
        $this->CI->email->to($receiver);
        $this->CI->email->subject($subject);
        $body = $this->CI->load->view('email_confirmation', $data, TRUE);
        $this->CI->email->message($body);
        if (!$this->CI->email->send()) {
            return false;
        } else {
            return true;
        }
    }
}