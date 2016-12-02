<?php

class Common_lib
{

    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }


    /************************
     * Common function for users to edit their profile
     * Params, user_id, client_id (cid for security)
     * access public
     * return row array
     ******************************************/
    public function profile($user, $menu, $group, $admin = FALSE)
    {
        $this->CI->lang->load('auth');
        $this->CI->lang->load('ion_auth');
        if (isset($_POST['ajaxpost'])) { //save
            $username = strtolower($this->CI->input->post('data[first_name]')) . '.' . strtolower($this->CI->input->post('data[last_name]'));
            $email = trim(strtolower($this->CI->input->post('data[email]')));
            $password = trim($this->CI->input->post('data[password]'));
            $avatar = ($this->CI->input->post('data[avatar]') != '') ? $this->CI->input->post('data[avatar]') : 'avatar.png';
            $avatar_original = ($this->CI->input->post('data[avatar_original]') != '') ? $this->CI->input->post('data[avatar_original]') : 'avatar.png';
            $additional_data = array(
                'email' => $this->CI->input->post('data[email]'),
                'first_name' => $this->CI->input->post('data[first_name]'),
                'last_name' => $this->CI->input->post('data[last_name]'),
                'address1' => $this->CI->input->post('data[address1]'),
                'address2' => $this->CI->input->post('data[address2]'),
                'city' => $this->CI->input->post('data[city]'),
                'state' => $this->CI->input->post('data[state]'),
                'zip' => $this->CI->input->post('data[zip]'),
                'phone' => $this->CI->input->post('data[phone]'),
                'mobile' => $this->CI->input->post('data[mobile]'),
                'avatar' => $this->CI->input->post('data[avatar]'),
                'avatar_original' => $this->CI->input->post('data[avatar_original]')
            );
            if ($user->email != $email) { //make sure email is unique
                if ($this->CI->ion_auth->identity_check($email)) {
                    echo lang("account_creation_duplicate_email");
                    return false;
                }
            }
            $this->CI->db->trans_start();
            $this->CI->ion_auth->update($user->id, $additional_data);
            $this->CI->db->trans_complete();
            return true;
        }
        //show form
        $data['meta_description'] = '';
        $data['menu'] = $menu;
        $data['user'] = $user;
        $data['group'] = $group;

        $data['usertoedit'] = $this->CI->common_mdl->user_to_edit($user->MyID, $user->cid, TRUE, $admin);

        $data['page'] = 'common/profile'; //page view to load
        $data['plugins'] = array('validation');
        $data['javascript'] = array('assets/custom/admin/user-edit-validation.js', 'assets/custom/common/upload.js');
        $views = array('design/html_topbar', 'sidebar', 'design/page', 'design/html_footer');
        $this->CI->layout->view($views, $data);
    }

    /**********************
     * View Activity log
     * access public
     * @params $menu,$user,$admin=FALSE)
     * return view
     *********************************/
    function activity_log($menu, $user, $group, $admin = FALSE)
    {
        $data['meta_description'] = '';
        $data['menu'] = $menu;
        $data['user'] = $user;
        $data['group'] = $group;
        if ($admin) {
            $data['activity'] = $this->CI->common_mdl->get_records('activity_logs', '', '', 'activity_time');
        } else {
            $data['activity'] = $this->CI->common_mdl->get_records('activity_logs', 'super_id', $user->MyID, 'activity_time');

        }

        $data['page'] = 'common/activity-log';
        //$data['plugins'] 	= array();
        //$data['javascript'] = array();
        $data['plugins'] = array('datatables');
        $data['javascript'] = array('assets/custom/common/activity-view.js');
        $views = array('design/html_topbar', 'sidebar', 'design/page', 'design/html_footer');
        $this->CI->layout->view($views, $data);
    }

    /**********************
     * Get Parameter by name from POST/GET request
     * access public
     * @params $Controller ci controller, $UriArray - array of get requests, $PostArray - POST array, Parameter Name, DefaultValue = '', $parameter_splitter - if formatted array
     * in parameter value
     * return Parameter Value
     *********************************/
    public function getParameter($Controller, $UriArray, $PostArray, $ParameterName, $DefaultValue = '', $parameter_splitter = '')
    {
        if (!empty($PostArray)) { // form was submitted
            $ParameterValue = $Controller->input->post($ParameterName);
        } else {
            $ParameterValue = !empty($UriArray[$ParameterName]) ? $UriArray[$ParameterName] : $DefaultValue;
        }
        if (is_array($ParameterValue)) return $ParameterValue;
        if (!empty($parameter_splitter)) {
            $A = preg_split('/' . $parameter_splitter . '/', (is_string($ParameterValue) ? urldecode($ParameterValue) : $ParameterValue));
            $ResArray = array();
            foreach ($A as $val) {
                if (!empty($val)) $ResArray[] = urldecode($val);
            }
            return $ResArray;
        }
        return urldecode($ParameterValue);
    }

    public function is_positive_integer($str)
    {
        if (empty($str)) return false;
        return (is_numeric($str) && $str > 0 && $str == round($str));
    }

    public function convertFromMySqlToCalendarFormat($StringDate)
    { // 	2012-12-28      2016-09-05 -> 5 September, 2016
        if (empty($StringDate))
            return '';
        $A = preg_split("/-/", $StringDate);
        if (count($A) != 3) return false;
        $year = $A[0];
        $month = $A[1];
        $day = $A[2];
        $tmp_date = mktime(null, null, null, $month, $day, $year);
        return strftime('%d %B, %Y', $tmp_date);
    }

    /**********************
     * Get Paginations Parameters from config
     * access public
     * @params
     * return Array of Configs
     *********************************/
    public function getPaginationParams($request_type= '')
    {
        $ci = &get_instance();
        $config_data = $ci->config->config;
        $items_per_page = $this->getSettings('items_per_page');
        $resArray = array();
        $resArray['per_page'] = $items_per_page;
        $resArray['uri_segment'] = $config_data['uri_segment'];
        $resArray['num_links'] = $config_data['num_links'];
        $resArray['use_page_numbers'] = $config_data['use_page_numbers'];
//        $resArray['page_query_string'] = $config_data['page_query_string'];
        $resArray['page_query_string'] = 'page_number';
        $resArray['query_string_segment'] = 'page_number';

        if ( $request_type == 'ajax' ) {
            $resArray['cur_tag_open'] = '  <a href="#" class="active"  >';//class="ajax_link_page"
            $resArray['cur_tag_close'] = ' </a> ';
        }
//        $resArray['full_tag_open'] = '<ul class="pagination" > ';
//        $resArray['full_tag_close'] = '</ul>';
//        $resArray['first_link'] = 'First';
//        $resArray['first_tag_open'] = '<li>';
//        $resArray['first_tag_close'] = '</li>';
//        $resArray['next_tag_open'] = '<li class="next">';
//        $resArray['next_tag_close'] = '</li>';
//        $resArray['prev_tag_open'] = '<li class="prev">';
//        $resArray['prev_tag_close'] = '</li>';
//        $resArray['last_link'] = 'Last';
//        $resArray['last_tag_open'] = '<li >';
//        $resArray['last_tag_close'] = '</li>';
//        $resArray['cur_tag_open'] = ' <li class="active" > <a href="#"  >';//class="ajax_link_page"
//        $resArray['cur_tag_close'] = ' </a></li> ';
//        $resArray['next_link'] = '&gt;';
//        $resArray['prev_link'] = '&lt;';
//        $resArray['num_tag_open'] = '<li >';
//        $resArray['num_tag_close'] = '</li>';
//
        return $resArray;

    }

    /**********************
     * Get Config parameter by name
     * access public
     * @params $name, $default_value = '')
     * return Config Value
     *********************************/
    public function getSettings($name, $default_value= '')
    {
        $ci = &get_instance();
        $config_data = $ci->config->config;
//        echo '<pre>$config_data::'.print_r($config_data,true).'</pre>';
        if (!empty($config_data[$name])) return $config_data[$name];

        die(" UNKNOWN SETTINGS PARAMETER : " . $name);
        return $default_value;
//        ('items_per_page', $config_data['default_per_page']);
    }

    public static function DebToFile($contents, $IsClearText = true, $FileName = '')
    {
        //return;
        try {
            if (empty($FileName))
                $FileName = './log/logging_deb.txt';
            $fd = fopen($FileName, ($IsClearText ? "w+" : "a+"));
            fwrite($fd, $contents . chr(13));
            fclose($fd);
            return true;
        } catch (Exception $lException) {
            return false;
        }
    }

    /**********************
     * Get Key/Values Parameters by and return concatenated string
     * access public
     * @params $items_array, $splitter, $count_return= false
     * in parameter value
     * return concatenated string/or number of elements(last parameter)
     *********************************/
    public function get_filters_label($items_array, $splitter, $count_return= false)
    {
        $ret_str= '';
        $count= 0;
        foreach( $items_array as $next_key=>$next_item_value ) {
            if ( !empty($next_item_value) ) {
                $ret_str.= $next_key . ' : ' . $next_item_value . $splitter;
                $count++;
            }
        }
        return ( $count_return ? $count : $ret_str );
    }


    /**********************
     * Get readable label of users_clients.uc_active_status field
     * access public
     * @params uc_active_status
     * return string label
     *********************************/
    public function get_users_clients_uc_active_status_label($uc_active_status) {
        return $this->CI->admin_mdl->getUsersClientsUc_ActiveStatusLabel($uc_active_status);
    }
    // alter TABLE `users_clients`
//change uc_is_active uc_active_status enum('E','O','N') NOT NULL default 'N' ; -- E-Employee, O-Only Out Of Staff, N- Not Related


    /**********************
     * Get readable label of client_active_status field
     * access public
     * @params $client_active_status
     * return string label
     *********************************/
    public function get_client_active_status_label($active_status) {
        return $this->CI->admin_mdl->getClientActiveStatusLabel($active_status);
    }

    /**********************
     * Get readable label of client_type field
     * access public
     * @params $client_type
     * return string label
     *********************************/
    public function get_client_type_label($client_type_id) {
        if ( $client_type_id ) {
            $client_type= $this->CI->common_mdl->get_client_type($client_type_id);
            if (!empty($client_type->type_description)) return $client_type->type_description;
        }
        return "";
    }

    /**********************
     * Prepare html of url for header in view listing JS based click
     * access public
     * @params $url - url of page, $filters_str - string(key/value) with current filters, $field_title - title shown in TH tag, name of sorting field,
     * $sort_direction - current sort direction(asc/desc), $sort - current sort
     * return html of a tag
     *********************************/
    public function showListHeaderItemJS ($js_funcname, /*$filters_str, */ $field_title, $fieldname , $sort_direction, $sort ) {
        if (empty($field_title)) {
            $field_title = ucwords($fieldname);
        }
        $field_title = str_replace('', '&nbsp;', $field_title);
        $imgHtlm = $this->tplListSortingImage($fieldname, $sort, $sort_direction);
        $res_js = '<a onclick="javascript:' . $js_funcname ."( '". addslashes($field_title)."', '"  .  $fieldname."' "  .  '); "><span>' . $field_title . $imgHtlm . '</span></a>';
        return $res_js; //CHtml::link($field_title . "&nbsp;" . $imgHtlm, $url);
    }

    /**********************
     * Prepare html of url for header in view listing
     * access public
     * @params $url - url of page, $filters_str - string(key/value) with current filters, $field_title - title shown in TH tag, name of sorting field,
     * $sort_direction - current sort direction(asc/desc), $sort - current sort
     * return html of a tag
     *********************************/
    public function showListHeaderItem ($url, $filters_str, $field_title, $fieldname, $sort_direction, $sort ) {
        if (empty($field_title)) {
            $field_title = ucwords($fieldname);
        }
        $field_title = str_replace('', '&nbsp;', $field_title);
        $R = $this->tplSortDirection( $fieldname, $sort_direction, $sort );
        $isFirstLetter = true;
        $filters_str .= ($isFirstLetter ? '/' : '/') . 'sort_direction/' . $R; //  $sort_direction;
        $filters_str .= '/sort/' . urlencode($fieldname);
        $filters_str .= '/fieldname/' . urlencode($fieldname);
        $imgHtlm = $this->tplListSortingImage($fieldname, $sort, $sort_direction);
        $res_url = '<a href="' . $url . $filters_str . '"><span>' . $field_title . $imgHtlm . '</span></a>';
        return $res_url; //CHtml::link($field_title . "&nbsp;" . $imgHtlm, $url);
    }

    /**********************
     * In header of view listing shows image for currently sorted field.
     * access public
     * @params $fieldname - field name, * $sort_direction - current sort direction(asc/desc), $sort - current sort
     * return html of an image
     *********************************/
    public function tplListSortingImage($fieldname, $sort, $sort_direction)
    {
        if ($sort == $fieldname and strtolower($sort_direction) == 'asc') {
            return '<i class="glyphicon glyphicon-arrow-down" style="display: inline-block;" ></i>';
        }
        if ($sort == $fieldname and strtolower($sort_direction) == 'desc') {
            return '<i class="glyphicon glyphicon-arrow-up" style="display: inline-block;" ></i>';
        }
    }

    public function tplSortDirection($fieldname, $sort_direction, $sort)
    {
        return (($sort == $fieldname and $sort_direction == 'asc') ? "desc" : "asc");
    }


    /**********************
     * return formatted string of given datetime
     * access public
     * @params : $time - can be mysql format or unix stamp, $format - output format, if empty would be used date_time_as_text_format format from config
     * return html of an image
     *********************************/
    public function format_datetime( $time, $format = '', $default = '' )
    {
//        echo '<pre>$time::'.print_r($time,true).'</pre>';
        if ( $time == '0000-00-00 00:00:00' or empty($time)) return $default;
        if (!is_numeric($time)) {
            $time = strtotime($time);
        }

        if (empty($format)) {
            $format= $this->CI->common_lib->getSettings( 'date_time_as_text_format' );
        }
        return strftime( $format, $time );
    }

    /**********************
     * check is ajax request
     * access public
     * @params
     * return booelan
     *********************************/
    public function is_ajax_request()
    {
        return ( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    }


}