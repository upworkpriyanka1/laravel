<?php
class validateData {
    private $m_validation_errors= array();
    private $m_validation_method= 'post';
    private $m_parentControl;

    private $m_photo_preg_pattern= '/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/';    // http://stackoverflow.com/questions/123559/a-comprehensive-regex-for-phone-number-validation/
    private $m_date_format= 'Y-m-d';
    private $m_url_preg_pattern= "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
    private $m_name_preg_pattern= '/^[a-zA-Z ]*$/';

    private $m_validation_not_negative_fields= array();
    private $m_validation_required_fields= array();
    private $m_validation_email_fields= array();
    private $m_validation_integer_fields= array();
    private $m_validation_float_fields= array();
    private $m_validation_name_fields= array();
    private $m_validation_url_fields= array();
    private $m_validation_date_fields= array();
    private $m_validation_phone_fields= array();
    private $m_validation_enum_fields= array();
    private $m_validation_reference_links= array();
    private $m_validation_uploads_images_allowed_types= array('gif','jpeg','jpg','png','bmp');
    private $m_validation_uploaded_files= array();
    private $m_validation_uploads_images_max_size= 1048576;
    private $m_validation_uploads_images_max_width= 1024;
    private $m_validation_uploads_images_max_height= 1024;

    public function __construct($parentControl) {
        $this->m_parentControl= $parentControl;
    }

    public function set_validation_method($validation_method) {
        $this->m_validation_method= $validation_method;
    }

    public function set_date_format($date_format) {
        $this->m_date_format= $date_format;
    }

    public function set_url_preg_pattern($url_preg_pattern) {
        $this->m_url_preg_pattern= $url_preg_pattern;
    }

    public function set_name_preg_pattern($name_preg_pattern) {
        $this->m_name_preg_pattern= $name_preg_pattern;
    }

    public function set_photo_preg_pattern($photo_preg_pattern) {
        $this->m_photo_preg_pattern= $photo_preg_pattern;
    }

    public function set_validation_not_negative_fields($validation_not_negative_fields) {
        $this->m_validation_not_negative_fields= $validation_not_negative_fields;
    }

    public function set_validation_required_fields($validation_required_fields) {
        $this->m_validation_required_fields= $validation_required_fields;
    }

    public function set_validation_email_fields($validation_email_fields) {
        $this->m_validation_email_fields= $validation_email_fields;
    }

    public function set_validation_integer_fields($validation_integer_fields) {
        $this->m_validation_integer_fields= $validation_integer_fields;
    }

    public function set_validation_float_fields($validation_float_fields) {
        $this->m_validation_float_fields= $validation_float_fields;
    }

    public function set_validation_name_fields($validation_name_fields) {
        $this->m_validation_name_fields= $validation_name_fields;
    }

    public function set_validation_url_fields($validation_url_fields) {
        $this->m_validation_url_fields= $validation_url_fields;
    }

    public function set_validation_date_fields($validation_date_fields) {
        $this->m_validation_date_fields= $validation_date_fields;
    }

    public function set_validation_phone_fields($validation_phone_fields) {
        $this->m_validation_phone_fields= $validation_phone_fields;
    }

    public function set_validation_enum_fields($validation_enum_fields) {
        $this->m_validation_enum_fields= $validation_enum_fields;
    }

    public function set_validation_reference_links($validation_reference_links) {
        $this->m_validation_reference_links= $validation_reference_links;
    }

    public function set_validation_uploaded_files($validation_uploaded_files) {
        $this->m_validation_uploaded_files= $validation_uploaded_files;
    }





    public function set_validation_uploads_images_allowed_types($validation_uploads_images_allowed_types) {
        $this->m_validation_uploads_images_allowed_types= $validation_uploads_images_allowed_types;
    }
    public function get_validation_uploads_images_allowed_types() {
        return $this->m_validation_uploads_images_allowed_types;
    }

    public function set_validation_uploads_images_max_size($validation_uploads_images_max_size) {
        $this->m_validation_uploads_images_max_size= $validation_uploads_images_max_size;
    }
    public function get_validation_uploads_images_max_size() {
        return $this->m_validation_uploads_images_max_size;
    }

    public function set_validation_uploads_images_max_width($validation_uploads_images_max_width) {
        $this->m_validation_uploads_images_max_width= $validation_uploads_images_max_width;
    }
    public function get_validation_uploads_images_max_width() {
        return $this->m_validation_uploads_images_max_width;
    }

    public function set_validation_uploads_images_max_height($validation_uploads_images_max_height) {
        $this->m_validation_uploads_images_max_height= $validation_uploads_images_max_height;
    }
    public function get_validation_uploads_images_max_height() {
        return $this->m_validation_uploads_images_max_height;
    }

    public function get_validation_rules_text( $line_breaker= '<br>' ) {
        $pieces= $this->get_validation_uploads_images_allowed_types();
        return "<small>Permitted types:<b>"  .implode (', ', $pieces)."</b>," . $line_breaker .
            "Max size of uploaded image:<b>".AppUtils::getFileSizeAsString( $this->get_validation_uploads_images_max_size() )."</b>," . $line_breaker .
            "Max width(in px) of uploaded image:<b>". $this->get_validation_uploads_images_max_width() .
            "</b>," . $line_breaker .
            "Max height(in px) of uploaded image:<b>".$this->get_validation_uploads_images_max_height() ."</b> " .
            "</small>";
    }





    public function runValidation() {
        $this->m_validation_errors= array();

        foreach( $this->m_validation_required_fields as $next_required_field ) {
            $next_value = trim($this->get_data_value($next_required_field));
            if ( strlen(trim($next_value))==0 ) {
                $this->m_validation_errors[$next_required_field]= array('field_name'=> $next_required_field, 'error_type'=>'validation_required');
            }
        }

        foreach( $this->m_validation_email_fields as $next_key => $next_email_field ) {
            $next_email_value = trim($this->get_data_value($next_email_field));
            $res= filter_var($next_email_value, FILTER_VALIDATE_EMAIL);
            if ( !$res and !empty($next_email_value) and empty($this->m_validation_errors[$next_email_field] ) ) {
                $this->m_validation_errors[$next_email_field]= array('field_name'=> $next_email_field, 'error_type'=>'validation_invalid_email');
            }
        }

        foreach( $this->m_validation_integer_fields as $next_key => $next_integer_field ) {
            $next_integer_value = trim($this->get_data_value($next_integer_field));
            $res= filter_var($next_integer_value, FILTER_VALIDATE_INT);
            if ( !$res and !empty($next_integer_value) and empty($this->m_validation_errors[$next_integer_field] ) ) {
                $this->m_validation_errors[$next_integer_field]= array('field_name'=> $next_integer_field, 'error_type'=>'validation_invalid_integer');
            }
        }

        foreach( $this->m_validation_float_fields as $next_key => $next_float_field ) {
            $next_float_value = trim($this->get_data_value($next_float_field));
            $res= filter_var($next_float_value, FILTER_VALIDATE_FLOAT); // '/^[+\-]?(?:\d+(?:\.\d*)?|\.\d+)$/'
            if ( !$res and !empty($next_float_value) and empty($this->m_validation_errors[$next_float_field] ) ) {
                $this->m_validation_errors[$next_float_field]= array('field_name'=> $next_float_field, 'error_type'=>'validation_invalid_float');
            }
        }

        foreach( $this->m_validation_not_negative_fields as $next_key => $next_not_negative_field ) {
            $next_not_negative_value = trim($this->get_data_value($next_not_negative_field));
            $res= filter_var($next_not_negative_value, FILTER_VALIDATE_FLOAT); // '/^[+\-]?(?:\d+(?:\.\d*)?|\.\d+)$/'
            if ( !$res and !empty($next_not_negative_value) and empty($this->m_validation_errors[$next_not_negative_field] ) ) {
                $this->m_validation_errors[$next_not_negative_field]= array('field_name'=> $next_not_negative_field, 'error_type'=>'validation_can_not_be_negative ');
            } else {
                if (substr($next_not_negative_value, 0, 1) == '-') {
                    $this->m_validation_errors[$next_not_negative_field] = array('field_name' => $next_not_negative_field, 'error_type' => 'validation_can_not_be_negative'  );
                }
            }
        }

        foreach( $this->m_validation_name_fields as $next_key => $next_name_field ) {
            $next_name_value = trim($this->get_data_value($next_name_field));
            $res= preg_match($this->m_name_preg_pattern,$next_name_value );
            if ( !$res and !empty($next_name_value) and empty($this->m_validation_errors[$next_name_field] ) ) {
                $this->m_validation_errors[$next_name_field]= array('field_name'=> $next_name_field, 'error_type'=>'validation_invalid_name');
            }
        }

        foreach( $this->m_validation_url_fields as $next_key => $next_url_field ) {
            $next_url_value = trim($this->get_data_value($next_url_field));
            $res= preg_match($this->m_url_preg_pattern,$next_url_value );
            if ( !$res and !empty($next_url_value) and empty($this->m_validation_errors[$next_url_field] ) ) {
                $this->m_validation_errors[$next_url_field]= array('field_name'=> $next_url_field, 'error_type'=>'validation_invalid_url');
            }
        }

        foreach( $this->m_validation_date_fields as $next_key => $next_date_field ) {
            $next_date_value = trim($this->get_data_value($next_date_field));
            $res= $this->validateDate($next_date_value, $this->m_date_format);
            if ( !$res and !empty($next_date_value) and empty($this->m_validation_errors[$next_date_field] ) ) {
                $this->m_validation_errors[$next_date_field]= array('field_name'=> $next_date_field, 'error_type'=>'validation_invalid_date');
            }
        }


        foreach( $this->m_validation_phone_fields as $next_key => $next_phone_field ) {
            $next_phone_value = trim($this->get_data_value($next_phone_field));
            $res= preg_match( $this->m_photo_preg_pattern, $next_phone_value );
            if ( !$res and !empty($next_phone_value) and empty($this->m_validation_errors[$next_phone_field] ) ) {
                $this->m_validation_errors[$next_phone_field]= array('field_phone'=> $next_phone_field, 'error_type'=>'validation_invalid_phone');
            }
        }

        foreach( $this->m_validation_enum_fields as $next_key => $next_enum_field ) {
            $next_enum_value = trim($this->get_data_value($next_enum_field['field_name']));
            if ( empty($next_enum_field['values']) or !is_array($next_enum_field['values'])) continue;
              if ( !in_array($next_enum_value, $next_enum_field['values']) and !empty($next_enum_value) and empty($this->m_validation_errors[$next_enum_field['field_name']] ) ) {
                $this->m_validation_errors[$next_enum_field['field_name']]= array('field_enum'=> $next_enum_field['field_name'], 'error_type'=>'validation_invalid_enumerable_value');
            }
        }



        foreach( $this->m_validation_uploaded_files as $next_key=>$next_validation_uploaded_file ) { //  array( 'avatar'=> array('file_url'=>$avatar, 'file_path'=>$avatar_path ) )  );
            if (!AppUtils::checkIfUrlExists($next_validation_uploaded_file['file_url'])) {
                $error_text= 'validation_invalid_file_url';
                $this->m_validation_errors[$next_key]= array( 'field_enum'=> $next_key, 'error_type'=> $error_text );
                continue;
            }

            $filename_ext= AppUtils::GetFileNameExt($next_validation_uploaded_file['file_url']);
            if ( !in_array($filename_ext, $this->m_validation_uploads_images_allowed_types, false ) ) {
                $error_text= 'validation_invalid_file_extension '. $filename_ext;
                if (empty($this->m_validation_errors[$next_key])) {
                    $this->m_validation_errors[$next_key] = array('field_enum' => $next_key, 'error_type' => $error_text);
                } else {
                    $this->m_validation_errors[$next_key]['error_type'].= '<br>'.$error_text;
                }
            }

            if ( !empty($next_validation_uploaded_file['file_path']) ) {
                $filesize = filesize($next_validation_uploaded_file['file_path']);
                if ($filesize > (int)$this->m_validation_uploads_images_max_size) {
                    $error_text = 'validation_image_is_too_big_in_size_"' . $filesize . '"_bytes_(_' . AppUtils::getFileSizeAsString($filesize) . '_)_._Permitted_Maximum_is_' . AppUtils::getFileSizeAsString($this->m_validation_uploads_images_max_size) . ". ";
                    if (empty($this->m_validation_errors[$next_key])) {
                        $this->m_validation_errors[$next_key] = array('field_enum' => $next_key, 'error_type' => $error_text);
                    } else {
                        $this->m_validation_errors[$next_key]['error_type'] .= '<br>' . $error_text;
                    }
                }
            }

            if ( !empty($next_validation_uploaded_file['file_path']) ) {
                $file_props = getimagesize($next_validation_uploaded_file['file_path']);
                if (!empty($file_props[0]) and (int)$file_props[0] > $this->m_validation_uploads_images_max_width) {
                    $error_text = 'validation_image_is_too_big_in_width_"' . $file_props[0] . 'px"._Permitted_Maximum_is_' . $this->m_validation_uploads_images_max_width . "px. ";
                    if (empty($this->m_validation_errors[$next_key])) {
                        $this->m_validation_errors[$next_key] = array('field_enum' => $next_key, 'error_type' => $error_text);
                    } else {
                        $this->m_validation_errors[$next_key]['error_type'] .= '<br>' . $error_text;
                    }
                }

                if (!empty($file_props[1]) and (int)$file_props[1] > $this->m_validation_uploads_images_max_height) {
                    $error_text = 'validation_image_is_too_big_in_height_"' . $file_props[1] . 'px"._Permitted_Maximum_is_' . $this->m_validation_uploads_images_max_height . "px. ";
                    if (empty($this->m_validation_errors[$next_key])) {
                        $this->m_validation_errors[$next_key] = array('field_enum' => $next_key, 'error_type' => $error_text);
                    } else {
                        $this->m_validation_errors[$next_key]['error_type'] .= '<br>' . $error_text;
                    }
                }
            }

        }

        foreach( $this->m_validation_reference_links as $next_key => $next_reference_link_field ) {
            $next_reference_link_value = trim($this->get_data_value($next_reference_link_field['field_name']));
            if ( !empty($next_reference_link_value) ) {
                $sql = " select " . $next_reference_link_field['ref_column'] . " from " . $next_reference_link_field['ref_table'] . " where " . $next_reference_link_field['ref_column'] . ' = ' . $next_reference_link_value;
                $rel_value = $this->getSqlValue($sql);
                if (empty($rel_value)) {
                    $error_text = 'validation_invalid_value ' . $next_reference_link_value . ' for ' . $next_reference_link_field['field_name'] . " field ";
                    if (empty($this->m_validation_errors[$next_reference_link_field['field_name']])) {
                        $this->m_validation_errors[$next_reference_link_field['field_name']] = array('field_enum' => $next_reference_link_field['field_name'], 'error_type' => $error_text);
                    } else {
                        $this->m_validation_errors[$next_reference_link_field['field_name']]['error_type'] .= '<br>' . $error_text;
                    }
                }
            }
        }

    }

    public function has_validation_errors() {
        return count($this->m_validation_errors) > 0;
    }

    public function get_validation_errors()
    {
        return $this->m_validation_errors;
    }

    private function get_data_value($field_name) {
        if ($this->m_validation_method == 'post') {
            return $this->m_parentControl->post($field_name);
        }
        if ($this->m_validation_method == 'put') {
            return $this->m_parentControl->put($field_name);
        }
    }

    private function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function getSqlValue($sql)
    {
        $ci = & get_instance();
        $query= $ci->db->query($sql);
        $ret_value= $query->result_array();
        if ( is_array($ret_value) and count($ret_value)== 0 ) return false;
        if ( is_array($ret_value) and count($ret_value)> 0 ) return $ret_value[0];
        return;
    }




}