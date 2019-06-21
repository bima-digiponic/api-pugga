<?php

class MY_Form_validation extends CI_Form_validation
{
    function __construct()
    {
        parent::__construct();
        $this->set_message('required', 'Field with asterix (*) must not empty.');
        $this->set_message('integer', '{field} harus bilangan bulat.');
        $this->set_message('required', '{field} must not empty.');
        $this->set_message('numeric', '{field} must be numeric value.');
        $this->set_message('less_than', 'Input {field} harus kurang dari {param}.');
        $this->set_message('greater_than', 'Input {field} harus lebih besar dari {param}.');
        $this->set_message('min_length', '{field} is {param} character minimum.');
        $this->set_message('max_length', '{field} is {param} character maximum.');
        $this->set_message('matches', 'Input {field} tidak sesuai dengan {param}.');
    }

    function validation_errors_remaster($lang = 'en')
    {
        $err = validation_errors();
        $allErrMsgArr = explode("\n", $err);
        if (!is_array($allErrMsgArr))
            return;
        $errMsgArr = array();
        $output = '';
        foreach ($allErrMsgArr as $v) {
            if ($v) {
                if (!in_array($v, $errMsgArr))
                    $errMsgArr[] = strip_tags($v);
            }
        }
        foreach ($errMsgArr as $v) {
            $output .= "$v\n";
        }
        return $output;
    }

}
