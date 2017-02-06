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

        $data['usertoedit'] = $this->CI->common_mdl->user_to_edit($user->MyID, $user->id, TRUE, $admin);

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

    function set_field_error_tag($fieldname, $attr) {
        $is_debug= 0;
        if ($is_debug) echo '<pre>set_field_error_tag $fieldname::'.print_r($fieldname,true).'</pre>';
        if ($is_debug) echo '<pre>set_field_error_tag $fieldname::'.print_r($fieldname,true).'</pre>';
        if (empty($attr)) $attr = ' class="has-error" ';
        $fieldvalue = strip_tags( form_error($fieldname) );
        if ($is_debug) echo '<pre>$fieldvalue::'.print_r($fieldvalue,true).'</pre>';
        if ($is_debug) exit;
//        die("-1 XXZ");
        if (!empty($fieldvalue)) {
            return $attr;
        }
    }

    function show_info($editor_message) {
        if ( $editor_message != '' ) { ?>
            <div class="alert alert-success display-hide" style="display: block;">
                <div class="glyphicon glyphicon-info-sign middle_icon pull-left " style = "font-size: xx-large; padding-bottom: 5px;" ></div>&nbsp;
                <button class="close" data-close="alert"></button> <?= $editor_message ?>
            </div>
        <?}
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
            $val= $Controller->input->post($ParameterName);
            $ParameterValue = !empty($val) ? $val : $DefaultValue;
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
//        echo '<pre>$StringDate::'.print_r($StringDate,true).'</pre>';
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
     * Get size of file in bytes and returns human readable size label
     * access public
     * @params $FileSize - File Size in bytes
     * return string  human readable size label
     *********************************/
    public function getFileSizeAsString($FileSize)
    {
        if ((int)$FileSize < 1024)
            return $FileSize . ' b';
        if ((int)$FileSize < 1024 * 1024)
            return floor($FileSize / 1024) . ' kb';
        return floor($FileSize / (1024 * 1024)) . ' mb';
    }

    /**********************
     * by image path and border(max width/height) get new image size withing returns array of recalculated size
     * access public
     * @params $ImageFileName - image path, $orig_width - max width for resize, $orig_height - max height for resize
     * return array of recalculated old/new size
     *********************************/
    public function GetImageShowSize($ImageFileName, $orig_width, $orig_height)
    {
        $ResArray = array('Width' => 0, 'Height' => 0, 'OriginalWidth' => 0, 'OriginalHeight' => 0);
        $FileArray = @getimagesize($ImageFileName);
        if (empty($FileArray))
            return $ResArray;

        $width = (int)$FileArray[0];
        $height = (int)$FileArray[1];

        $ResArray = array('Width' => 0, 'Height' => 0, 'OriginalWidth' => 0, 'OriginalHeight' => 0);

        $FileArray = @getimagesize($ImageFileName);
        if (empty($FileArray))
            return $ResArray;

        $width = (int)$FileArray[0];
        $height = (int)$FileArray[1];
        $ResArray['OriginalWidth'] = $width;
        $ResArray['OriginalHeight'] = $height;
        $ResArray['Width'] = $width;
        $ResArray['Height'] = $height;

        $Ratio = round($width / $height, 3);

        if ($width > $orig_width) {
            $ResArray['Width'] = (int)($orig_width);
            $ResArray['Height'] = (int)($orig_width / $Ratio);
            if ($ResArray['Width'] <= (int)$orig_width and $ResArray['Height'] <= (int)$orig_height) {
                return $ResArray;
            }
            $width = $ResArray['Width'];
            $height = $ResArray['Height'];
        }
        if ($height > $orig_height and ((int)($orig_height / $Ratio)) <= $orig_width) {
            $ResArray['Width'] = (int)($orig_height * $Ratio);
            $ResArray['Height'] = (int)($orig_height);
            return $ResArray;
        }
        if ($height > $orig_height and ((int)($orig_height / $Ratio)) > $orig_width) {
            $ResArray['Width'] = (int)($orig_height * $Ratio);
            $ResArray['Height'] = (int)($ResArray['Width'] / $Ratio);
            return $ResArray;
        }
        return $ResArray;

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
            fwrite($fd, print_r($contents,true) . chr(13));
            fclose($fd);
            return true;
        } catch (Exception $lException) {
            return false;
        }
    }


    /**********************
     * create directories by given array from the root
     * access public
     * @params $directories_list - $directories list started from the root
     * return Config Value
     *********************************/
    public static function createDir(array $directories_list = array(), $mode = 0755)
    {
        foreach ($directories_list as $dir) {
            if ( !file_exists($dir) ) {
                mkdir($dir, $mode );
            }
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
                $ret_str.= str_replace('_',' ',$next_key) . ' : ' . $next_item_value . $splitter;
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
        return $this->CI->clients_mdl->getClientActiveStatusLabel($active_status);
    }

    /**********************
     * Get readable label of client_clients_types_id field
     * access public
     * @params $clients_types_id
     * return string label
     *********************************/
    public function get_clients_types_id_label($clients_types_id) {
        $row= $this->CI->clients_mdl->getClient_TypesRowById($clients_types_id);
        return !empty($row->type_name) ? $row->type_name : "";
    }
    /**********************
     * Get readable label of client color_scheme field
     * access public
     * @params $color_scheme
     * return string label
     *********************************/
    public function get_color_scheme_label($color_scheme) {
//        $row= $this->CI->clients_mdl->getClient_TypesRowById($clients_types_id);
        $client_color_schemes = $this->CI->config->item('client_color_schemes');
        foreach( $client_color_schemes as $next_key=>$next_color_scheme ) {
            if ((int)$next_color_scheme['id'] == (int)$color_scheme) {
                return $next_color_scheme['title'];
            }
        }
        return "";
    }

    /**********************
     * Get readable label of service_active_status field
     * access public
     * @params $service_active_status
     * return string label
     *********************************/
    public function get_service_active_status_label($active_status) {
        return $this->CI->services_mdl->getServiceActiveStatusLabel($active_status);
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
     * Get readable label of user_active_status field
     * access public
     * @params $user_active_status
     * return string label
     *********************************/
    public function get_user_active_status_label($active_status) {
        return $this->CI->users_mdl->getUserActiveStatusLabel($active_status);
    }


    /**********************
     * Get readable label of cms_items_page_type field
     * access public
     * @params $cms_items_page_type
     * return string label
     *********************************/
    public function get_cms_items_page_type_label($ci_page_type) {
        return $this->CI->cms_items_mdl->getCms_ItemPage_TypeLabel($ci_page_type);
    }

    /**********************
     * Get readable label of cms_items_ci_published field
     * access public
     * @params $cms_items_ci_published
     * return string label
     *********************************/
    public function get_cms_items_ci_published_label($ci_published) {
        return $this->CI->cms_items_mdl->getCms_Item_PublishedLabel($ci_published);
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


    public function concatStr($Str, $MaxLength = 50,  $AddStr = '...', $ShowHelp = false, $StripTags = true, $additive_code= '')
    {
        if ($StripTags) $Str = strip_tags($Str);
        $ReturnHTML = self::limitChars($Str, ( !empty($MaxLength) ? $MaxLength : self::$ConcatStrMaxLength ), $AddStr);
        if ($ShowHelp and strlen($Str) > $MaxLength) {
            $Str = self::nl2br2($Str);
            $ReturnHTML .= '<i class=" a_link fa fa-object-group" style="font-size:larger;" hidden '.$additive_code.' ></i>';
        }
        return $ReturnHTML;
    }

    /**
     * Limits a phrase to a given number of characters.
     *
     * @param   string   phrase to limit characters of
     * @param   integer  number of characters to limit to
     * @param   string   end character or entity
     * @param   boolean  enable or disable the preservation of words while limiting
     * @return  string
     */
    public function limitChars($str, $limit = 100, $endChar = null, $preserveWords = false)
    {
        $endChar = ($endChar === null) ? '&#8230;' : $endChar;

        $limit = (int)$limit;

        if (trim($str) === '' OR strlen($str) <= $limit)
            return $str;

        if ($limit <= 0)
            return $endChar;

        if ($preserveWords == false) {
            return rtrim(substr($str, 0, $limit)) . $endChar;
        }
        // TO FIX AND DELETE SPACE BELOW
        preg_match('/^.{' . ($limit - 1) . '}\S* /us', $str, $matches);

        return rtrim($matches[0]) . (strlen($matches[0]) == strlen($str) ? '' : $endChar);
    }

    public static function nl2br2($string, $replace_with= "<br>")
    {
        $string = str_replace(array("\r\n", "\r", "\n"), $replace_with, $string);
        return $string;
    }


    public function tbUrlDecode($Url)
    {
        $Url = str_replace('ZZZZZ', '/', $Url);
        $Url = str_replace('XXXXX', '.', $Url);
        $Url = str_replace('YYYYY', '-', $Url);
        $Url = str_replace('WWWWW', '_', $Url);
        return $Url;
    }

    public function tbUrlEncode($Url)
    {
        $Url = str_replace('/', 'ZZZZZ', $Url);
        $Url = str_replace('.', 'XXXXX', $Url);
        $Url = str_replace('-', 'YYYYY', $Url);
        $Url = str_replace('_', 'WWWWW', $Url);
        return $Url;
    }

    public static function sendEmail($to, $subject, $message)
    {
        //AppUtils::deb( $cms_item_template_id, 'SendEmail $cms_item_template_id::');
        $ci = & get_instance();
	    $ci->common_lib->DebToFile( 'sendEmail $to::'.print_r($to,true));
	    $ci->common_lib->DebToFile( 'sendEmail $subject::'.print_r($subject,true));
	    $ci->common_lib->DebToFile( 'sendEmail $message::'.print_r($message,true));
        $config_array = $ci->config->config;
        $ci->load->library('email');
        $ci->email->from($config_array['noanswer_email'], 'No Reply');
        $ci->email->to($to);
        $ci->email->cc( array('nilov@softreactor.com') );
        $ci->email->bcc( array('nilov@softreactor.com') );
        $ci->email->subject($subject);
        $ci->email->message(strip_tags($message));
        return $ci->email->send();
    }

    public static function groupItems($s, $splitter= ',', $label= '')
    {
        $s= trim($s);
        $a= preg_split('/'.$splitter.'/', $s);
//        echo '<pre>$a::'.print_r($a,true).'</pre>';
        $a= array_unique($a);
//        echo '<pre>$a::'.print_r($a,true).'</pre>';
        if ( count($a) == 1 ) return $a[0];
//        return '<a href="#" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">'.count($a).' '.$label . '</a>';
        return count($a).' '.$label;//. '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</button>';
//        $ret= '';
//        $l= count($a);
//        for($i= 0;$i<$l;$i++) {
//            $ret.= $a.'';
//        }
//        return $ret;
//        die("-1 XXZ");
    }

    public function generateActivationCode($Length = 40)
    {
        $I = 0;
        while (true) {
            $Password = $this->preparePassword($Length);
            $User = get_instance()->users_mdl->getUserRowByActivationCode(md5($Password));
            if (empty($User))
                return $Password;
        }
        return '';
    }

    public function generatePassword($Length = 8)
    {
        $I = 0;
        while (true) {
            $Password = $this->PreparePassword($Length);
            $User = get_instance()->users_mdl->getRowByPassword(md5($Password));
            if (empty($User))
                return $Password;
        }
        return '';
    }

    /**
     * Prepare Password with given length($Length)
     *
     */
    public function preparePassword($Length)
    {
        $alphabet = "0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $Res = '';
        for ($I = 0; $I < $Length; $I++) {
            $Index = rand(0, strlen($alphabet) - 1);
            $Res .= substr($alphabet, $Index, 1);
        }
        return $Res;
    }

}