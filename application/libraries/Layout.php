<?php

class Layout {

    private $CI;
    private $data;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('markup_model', 'markup');
        $this->CI->load->driver('metronic');
    }


    public function view($views, $data, $layout='default') {
        $pls = (isset($data['pls']) && count($data['pls'])>0) ? $data['pls'] : '';
        if ($layout == 'ajax') {
            $this->CI->load->view($view_name, $data);
        }elseif ($layout == 'default') {
            $this->CI->markup->html_begin($data);
            $this->CI->markup->styles($data['plugins'],$pls); //load plugins css
            $this->load_views($views,$data); //load views
            $this->CI->markup->scripts($data['plugins'], $data['javascript']);//load plugins js
            $this->CI->markup->html_close();
        }elseif ($layout == 'somethingelse') {//if necessary you can add more
        }//end 
    }//end function

//Load page view
    private function load_views($views,$data){
        if (is_array($views) && count($views) >= 1) {
            foreach ($views as $key => $layout) {
                $this->CI->load->view($layout, $data);
            }
        }else{
            $this->CI->load->view($views, $data);
        }

    }
}

?>
