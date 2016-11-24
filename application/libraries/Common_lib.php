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

    public function getParameter($Controller, $UriArray, $PostArray, $ParameterName, $DefaultValue = '', $parameter_splitter = '')
    {
        if (!empty($PostArray)) { // form was submitted
            $ParameterValue = $Controller->input->post($ParameterName);
        } else {
            $ParameterValue = !empty($UriArray[$ParameterName]) ? $UriArray[$ParameterName] : $DefaultValue;
        }
        //AppUtils::deb($ParameterValue, '$ParameterValue::');
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

    public function getPaginationParams()
    {
        $ci = &get_instance();
        $config_data = $ci->config->config;
        $items_per_page = $this->getSettings('items_per_page');
        $resArray = array();
        $resArray['per_page'] = $items_per_page;
        $resArray['uri_segment'] = $config_data['uri_segment'];
        $resArray['num_links'] = $config_data['num_links'];
        $resArray['use_page_numbers'] = $config_data['use_page_numbers'];
        $resArray['page_query_string'] = $config_data['page_query_string'];
        $resArray['query_string_segment'] = 'page';
        return $resArray;

    }

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


    public function get_client_is_active_label($client_is_active) {
        if ( $client_is_active ) return "active";
        return "inactive";
    }

    public function get_client_type_label($client_type_id) {
        if ( $client_type_id ) {
            $client_type= $this->CI->common_mdl->get_client_type($client_type_id);
            if (!empty($client_type->type_description)) return $client_type->type_description;
        }
        return "";
    }

//<th>{{ showListHeaderItem ( url='/admin/user/index', filters_str=PageParametersWithoutSort, field_title="Username", fieldname="username", sort_direction=sort_direction, sort=sort )|raw }}</th>
//<th>{{ showListHeaderItem ( url='/admin/user/index', filters_str=PageParametersWithoutSort, field_title="Username", fieldname="username", sort_direction=sort_direction, sort=sort )|raw }}</th>
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

    public function tplListSortingImage($fieldname, $sort, $sort_direction)
    {
//        $ci = & get_instance();
//        $config_object = $ci->config;
//        $config_array = $config_object->config;
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


}