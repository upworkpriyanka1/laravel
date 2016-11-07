<?php
/*****************************
 * Library Class 
 *
 * ****************************/
class Master_social_work_lib {
    
    public function __construct() {
        $this->CI = & get_instance();
    }
    /**********************
    * Allways comment function
    * access public
    * @ params
    * return 
    *********************************/
    function test(){
        return "foo";
    }

}//end library