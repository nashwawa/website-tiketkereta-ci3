<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template {
    private $data = [];
    public function set($name, $value) {
        $this->data[$name] = $value;
    }
    public function load($template, $view, $view_data = [], $return = false) {
        $CI = &get_instance();
        $this->data['contents'] = $CI->load->view($view, $view_data, true);
        return $CI->load->view($template, $this->data, $return);
    }
}
