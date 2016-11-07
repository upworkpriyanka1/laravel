<?php
/*****************************
 * Library Class 
 *
 * ****************************/
class Admin_lib {
    
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