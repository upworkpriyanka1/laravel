<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Users Db functions
 *
 * ****************************/
class Users_mdl extends CI_Model
{
    public $m_users_table;
//	private $m_users_jobs_table;
    private $m_users_clients_table;
    private $m_clients_table;
    public $m_jobs_table;
    public $m_users_groups_table;
    public $m_groups_table;

    private $UserStatusLabelValueArray = Array('P' => 'Pending', 'A' => 'Active', 'I' => 'Inactive', 'On' => 'Online', 'Of' => 'Offline', 'L' => 'Last Login');
    private $UserGroupStatusLabelValueArray = Array('P' => 'Pending', 'A' => 'Active', 'I' => 'Inactive');
    private $PhoneTypeArray = Array('H' => 'Home', 'W' => 'Work', 'O' => 'Other');

    function __construct()
    {
        parent::__construct();
        $this->m_users_table = 'users';
//		$this->m_users_jobs_table= 'users_jobs';
        $this->m_users_clients_table = 'users_clients';
        $this->m_clients_table = 'clients';
        $this->m_jobs_table = 'jobs';
        $this->m_users_groups_table = 'users_groups';
        $this->m_groups_table = 'groups';
    }

    public function getUserGroupStatusValueArray($ret_with_subarray = true)
    {
        $ResArray = array();
        foreach ($this->UserGroupStatusLabelValueArray as $Key => $Value) {
            if ($ret_with_subarray) {
                $ResArray[] = array('key' => $Key, 'value' => $Value);
            } else {
                $ResArray[$Key] = $Value;
            }
        }
        return $ResArray;
    }

    public function getUserGroupStatusLabel($user_status)
    {
        if (!empty($this->UserGroupStatusLabelValueArray[$user_status])) {
            return $this->UserGroupStatusLabelValueArray[$user_status];
        }
        return '';
    }


    public function getUserStatusValueArray($ret_with_subarray = true)
    {
        $ResArray = array();
        foreach ($this->UserStatusLabelValueArray as $Key => $Value) {
            if ($ret_with_subarray) {
                $ResArray[] = array('key' => $Key, 'value' => $Value);
            } else {
                $ResArray[$Key] = $Value;
            }
        }
        return $ResArray;
    }

    public function getUserStatusLabel($user_status)
    {
        if (!empty($this->UserStatusLabelValueArray[$user_status])) {
            return $this->UserStatusLabelValueArray[$user_status];
        }
        return '';
    }


    public function getUserPhoneTypeArray($ret_with_subarray = true)
    {
        $ResArray = array();
        foreach ($this->PhoneTypeArray as $Key => $Value) {
            if ($ret_with_subarray) {
                $ResArray[] = array('key' => $Key, 'value' => $Value);
            } else {
                $ResArray[$Key] = $Value;
            }
        }
        return $ResArray;
    }








    ////////////// USERS BLOCK START /////////////


    /**********************
     * Get users list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of user objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for user_status, user_zip, user_type and between
     * created_at_from and created_at_till
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/

    public function getUsersList($OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {

        if (empty($sort))
            $sort = $this->m_users_table . '.created_at';
        if (empty($sort_direction)) $sort_direction = 'desc';
        $config_data = $this->config->config;
        $ci = &get_instance();
        $items_per_page = $ci->common_lib->getSettings('items_per_page');
        $limit = !empty($filters['limit']) ? $filters['limit'] : '';
        $offset = !empty($filters['offset']) ? $filters['offset'] : '';
        $is_page_positive_integer = $ci->common_lib->is_positive_integer($page);
        $is_user_job_title_joined = false;
        $are_clients_joined = false;
        $is_user_group_joined = false;
        $is_user_client_joined = false;
        if (!empty($page) and $is_page_positive_integer && !$OutputFormatCount) {
            $limit = '';
            $offset = '';
        }

        if (!empty($items_per_page) and $is_page_positive_integer && !$OutputFormatCount) {
            $per_page = (!empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page'])) ? $filters['per_page'] : $items_per_page;
            $limit = $per_page;
            $offset = ($page - 1) * $per_page;
        }

        $additive_fields_for_select = "";
        $additive_group_fields = "";
        $fields_for_select = $this->m_users_table . ".*";
//		if ( !empty($filters['show_job_title']) ) {
//			$additive_fields_for_select .= ", GROUP_CONCAT(".$this->m_jobs_table.".job_title) as job_title, GROUP_CONCAT(".$this->m_jobs_table.".job_name) as job_name ";
//			if ( !$is_user_job_title_joined ) {
//				$is_user_job_title_joined= true;
//				$this->db->join($this->m_users_jobs_table, $this->m_users_jobs_table . '.user_id = ' . $this->m_users_table . '.id', 'left');
//				$this->db->join($this->m_jobs_table, $this->m_jobs_table . '.id = ' . $this->m_users_jobs_table . '.job_id', 'left');
//			}
//		}

        if (!empty($filters['show_user_group'])) {

            /*
            $additive_fields_for_select .= ", ".$this->m_groups_table.".description as user_group_description, " . $this->m_users_groups_table.'.status as user_group_status';
            $additive_group_fields .= ", ".$this->m_groups_table.".description, user_group_status";
//			echo '<pre>$additive_fields_for_select::'.print_r($additive_fields_for_select,true).'</pre>';


            if ( !$is_user_group_joined ) {
                $is_user_group_joined= true;
                $this->db->join($this->m_users_groups_table, $this->m_users_groups_table . '.user_id = ' . $this->m_users_table . '.id', 'left');
            }
            $this->db->join($this->m_groups_table, $this->m_groups_table . '.id = ' . $this->m_users_groups_table . '.group_id', 'left');
            */

            if (!$is_user_group_joined) {
                $is_user_group_joined = true;
                $additive_fields_for_select .= ", " . "user_group_subquery_table.description as user_group_description, " . 'user_group_subquery_table.status as user_group_status';
                $additive_group_fields .= ", " . "user_group_subquery_table.description, user_group_subquery_table.status";

                $this->db
                    ->select($this->m_users_groups_table . '.*, ' . $this->m_groups_table . '.group_title, ' . $this->m_groups_table . '.name, ' . $this->m_groups_table . '.description')
                    ->from($this->m_users_groups_table)
                    ->join($this->m_groups_table, $this->m_groups_table . '.id = ' . $this->m_users_groups_table . '.group_id', 'left');
                $subquery = $this->db->get_compiled_select();
                $this->db->join("($subquery)  user_group_subquery_table", "user_group_subquery_table.user_id = " . $this->m_users_table . '.id', 'left');
            } else {
                $additive_fields_for_select .= ", " . $this->m_groups_table . ".description as user_group_description, " . $this->m_users_groups_table . '.status as user_group_status';
                $additive_group_fields .= ", " . $this->m_groups_table . ".description, user_group_status";
                $this->db->join($this->m_groups_table, $this->m_groups_table . '.id = ' . $this->m_users_groups_table . '.group_id', 'left');
            }
        }

        if (!empty($filters['username'])) {
            $this->db->like($this->m_users_table . '.username', $filters['username']);
        }

        if (!empty($filters['client_id'])) {
            if (!$are_clients_joined) {
                $this->db->join($this->m_users_clients_table, $this->m_users_clients_table . '.uc_user_id = ' . $this->m_users_table . '.id' . ' AND ' .
                    $this->m_users_clients_table . '.uc_client_id = ' . "'" . $filters['client_id'] . "'", '');
            }
//            $this->db->where($this->m_users_clients_table.'.uc_client_id = ' . "'" . $filters['client_id'] . "'");
//                $additive_fields_for_select.= ', '.$this->m_users_clients_table.".uc_active_status as uc_is_active";
            $are_clients_joined = true;
        }


        if (!empty($filters['user_status'])) {
            if (strlen($filters['user_status']) > 0) {
                $this->db->where($this->m_users_table . '.user_status = ' . "'" . $filters['user_status'] . "'");
            }
        }

        if (!empty($filters['zip'])) {
            $this->db->where($this->m_users_table . '.zip = ' . "'" . $filters['zip'] . "'");
        }

        if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_users_table . '.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }

        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_users_table . '.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
        }



        if (!empty($filters['show_user_client_relation_group'])) {
            $additive_fields_for_select .= ", " . "groups_1.description as user_client_relation_description, " . $this->m_users_clients_table . '.uc_id ';
            $additive_group_fields .= ", groups_1.description, uc_id";
//			echo '<pre>$additive_fields_for_select::'.print_r($additive_fields_for_select,true).'</pre>';
            if (!$is_user_group_joined) {
                $is_user_group_joined = true;
                $this->db->join($this->m_users_clients_table, $this->m_users_clients_table . '.uc_user_id = ' . $this->m_users_table . '.id', 'left');
            }
            $this->db->join($this->m_groups_table . " as groups_1 ", 'groups_1.id = ' . $this->m_users_clients_table . '.uc_group_id', 'left');
        }


        if (!empty($filters['user_group_id'])) {
            if (!$is_user_group_joined) {
                $is_user_group_joined = true;
                $this->db->join($this->m_users_groups_table, $this->m_users_groups_table . '.user_id = ' . $this->m_users_table . '.id', 'left');
                $this->db->where($this->m_users_groups_table . '.group_id = ' . "'" . $filters['user_group_id'] . "'");
            }
        }


        if (!empty($filters['show_clients_name'])) {
            $additive_fields_for_select .= ", GROUP_CONCAT(" . $this->m_clients_table . ".client_name ) as client_name";
//			$additive_group_fields .= ", ".$this->m_clients_table.".client_name";
//			echo '<pre>$additive_fields_for_select::'.print_r($additive_fields_for_select,true).'</pre>';
            if (!$is_user_client_joined) {
                $is_user_client_joined = true;
                $this->db->join($this->m_users_clients_table, $this->m_users_clients_table . '.uc_user_id = ' . $this->m_users_table . '.id AND ' . $this->m_users_clients_table . '.uc_active_status in (\'E\',\'O\') ', 'left'); // -- E-Employee, O-Only Out Of Staff, N- Not Related
            }
            $this->db->join($this->m_clients_table, $this->m_clients_table . '.cid = ' . $this->m_users_clients_table . '.uc_client_id', 'left');
        }

        if (!empty($filters['search'])) {
            //$this->db->like($this->m_users_table . '.username', $filters['search']);
            $this->db->or_like($this->m_users_table . '.first_name', $filters['search']);
            $this->db->or_like($this->m_users_table . '.last_name', $filters['search']);
            $this->db->or_like($this->m_users_table . '.email', $filters['search']);
        }

        if ((!empty($limit) and $ci->common_lib->is_positive_integer($limit)) and (!empty($offset) and $ci->common_lib->is_positive_integer($offset))) {
            $this->db->limit($limit, $offset);
        }

        if ((!empty($limit) and $ci->common_lib->is_positive_integer($limit))) {
            $this->db->limit($limit);
        }


        if (!$OutputFormatCount) {
            $this->db->group_by($this->m_users_table . '.id ' . $additive_group_fields);
//			$this->db->group_by( $this->m_users_table . '.id, ' . $this->m_groups_table . '.id ' . ( $is_user_client_joined ? ', '.$this->m_clients_table . '.cid '  : "" ) );
        }

        $fields_for_select .= ' ' . $additive_fields_for_select;
        if (!empty($sort)) {
            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));
        }

//        echo '<pre>$fields_for_select::'.print_r($fields_for_select,true).'</pre>';

        if ($OutputFormatCount) {
            return $this->db->count_all_results($this->m_users_table);
        } else {
            $query = $this->db->from($this->m_users_table);
            $ci = &get_instance();
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ret_array = $query->get()->result();
            return $ret_array;
        }
    }


    public function getSimilarUserByUsername($username, $id = '')
    {
        $this->db->where('username', $username);
        $this->db->from($this->m_users_table);
        if (!empty($id)) {
            $this->db->where('id != ' . $id);
        }
        $row = $this->db->get()->result();
        if (empty($row[0])) return false;
        return $row[0];
    }

    public function getSimilarUserByEmail($email, $id = '')
    {
        $this->db->where('email', $email);
        $this->db->from($this->m_users_table);
        if (!empty($id)) {
            $this->db->where('id != ' . $id);
        }
        $row = $this->db->get()->result();
        if (empty($row[0])) return false;
        return $row[0];
    }


    public function getRowByPassword($password)

    {

        $query = $this->db->get_where($this->m_users_table, array('password' => $password), 1, 0);

        $ResultRow = $query->result();

        if (!empty($ResultRow[0])) {

            return $ResultRow[0];

        }

        return false;

    }


    public function getUserRowByActivationCode($activation_code)
    {
        //$query = $this->db->get_where($this->m_users_table, array('activation_code' => $activation_code), 1, 0);
        // Check activation code in users_clients table instead of users tale
        $query = $this->db->get_where('users_clients', array('activation_code' => $activation_code));
        $ResultRow = $query->result();
        if (!empty($ResultRow[0])) {
            return $ResultRow[0];
        }
        return false;
    }

    // Function by BBITS DEV for activation code validity
    public function checkActivationCodeValidity($activation_code)
    {
        //$query = $this->db->get_where($this->m_users_table, array('activation_code' => $activation_code,'created_at >=' => NOW() - INTERVAL 2 HOUR), 1, 0);
        $expire_hour = $this->config->item('activation_link_expiration', 'ion_auth');
        $query = $this->db->get_where('users_clients', array('activation_code' => $activation_code, 'created_at >=' => date('Y-m-d H:i:s', strtotime('-2 HOURS'))), 1, 0);
        //echo "last query is : " . $this->db->last_query();exit(0);
        $ResultRow = $query->result();

        if (!empty($ResultRow[0])) {

            return $ResultRow[0];

        }

        return false;
    }


    public function getUserRowByForgottenPasswordCode($forgotten_password_code)

    {

        $query = $this->db->get_where($this->m_users_table, array('forgotten_password_code' => $forgotten_password_code), 1, 0);

        $ResultRow = $query->result();

        if (!empty($ResultRow[0])) {

            return $ResultRow[0];

        }

        return false;

    }


    public function getUserRowById($id, $additive_params = array())

    {

        $this->db->where($this->m_users_table . '.id', $id);

        $query = $this->db->from($this->m_users_table);

        $ci = &get_instance();


        $userRow = $this->db->get()->row();

        $orig_width = !empty($additive_params['image_width']) ? $additive_params['image_width'] : 64;

        $orig_height = !empty($additive_params['image_height']) ? $additive_params['image_height'] : 64;

//	    echo '<pre>$userRow::'.print_r($userRow,true).'</pre>';

//	    echo '<pre>$additive_params::'.print_r($additive_params,true).'</pre>';

        if (!empty($additive_params['show_file_info']) and !empty($userRow->avatar)) {

            $user_avatar = $this->getUserDir($id) . $userRow->avatar;

            $userRow->file_info = '';

            if (file_exists($user_avatar)) {

                $file_info = $userRow->avatar;

                $file_info .= ', ' . $this->common_lib->getFileSizeAsString(filesize($user_avatar));

                $fileArray = @getimagesize($user_avatar);

                if (!empty($fileArray)) {

                    $file_info .= ', ' . $fileArray[0] . 'x' . $fileArray[1];

                }

                $userRow->file_info = $file_info;

                $userRow->image_url = $this->getUserImageUrl($id, $userRow->avatar);

                $userRow->image_path = $this->getUserImagePath($id, $userRow->avatar);

                $filenameInfo = $this->common_lib->GetImageShowSize($userRow->image_path, $orig_width, $orig_height);

                $userRow->image_path_width = !empty($filenameInfo['Width']) ? $filenameInfo['Width'] : 0;

                $userRow->image_path_height = !empty($filenameInfo['Height']) ? $filenameInfo['Height'] : 0;

                $userRow->image_path_original_width = !empty($filenameInfo['OriginalWidth']) ? $filenameInfo['OriginalWidth'] : 0;

                $userRow->image_path_original_height = !empty($filenameInfo['OriginalHeight']) ? $filenameInfo['OriginalHeight'] : 0;

            }

        }

        return $userRow;

    }


    public function getUsersDir()

    {

        $ci = &get_instance();

        return $ci->config->config['document_root'] . $ci->config->config['image_users_directory'];

    }


    public function getUserDir($user_id = '')

    {

        $ci = &get_instance();

        return $ci->config->config['document_root'] . $ci->config->config['image_user_directory'] . $user_id . DIRECTORY_SEPARATOR;

    }


    public function getUserImageUrl($user_id, $img)

    {

        $ci = &get_instance();

        return $ci->config->config['base_url'] . '/' . $ci->config->config['image_user_directory'] . $user_id . '/' . $img;

    }


    public function getUserImagePath($user_id, $img)

    {

        $ci = &get_instance();

        return $ci->config->config['document_root'] . $ci->config->config['image_user_directory'] . $user_id . '/' . $img;

    }


    public function deleteUser($id)

    {

        if (!empty($id)) {

            $this->db->where('id', $id);

            $Res = $this->db->delete($this->m_users_table);

            return $Res;

        }

    }



    ////////////// USERS BLOCK END /////////////


    ////////////// USERS CLIENTS BLOCK START /////////////
    public function getUsersClientsList($OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty($sort))
            $sort = 'uc_active_status';
//        echo '<pre>$filters::'.print_r($filters,true).'</pre>';
        $config_data = $this->config->config;
        $ci = &get_instance();
        $items_per_page = $ci->common_lib->getSettings('items_per_page');
        $limit = !empty($filters['limit']) ? $filters['limit'] : '';
        $offset = !empty($filters['offset']) ? $filters['offset'] : '';
        $is_page_positive_integer = $ci->common_lib->is_positive_integer($page);
        if (!empty($page) and $is_page_positive_integer) {
            $limit = '';
            $offset = '';
        }
        if (!empty($config_data) and $is_page_positive_integer) {
            $per_page = (!empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page'])) ? $filters['per_page'] : $items_per_page;
            $limit = $per_page;
            $offset = ($page - 1) * $per_page;
        }

        if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_users_clients_table . '.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }
        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_users_clients_table . '.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
        }


        if (!empty($filters['user_id'])) {
            $this->db->where($this->m_users_clients_table . '.uc_user_id', $filters['user_id']);
        }

        if (!empty($filters['client_id'])) {
            $this->db->where($this->m_users_clients_table . '.uc_client_id', $filters['client_id']);
        }

        if (!empty($filters['group_id'])) {
            $this->db->where($this->m_users_clients_table . '.uc_group_id', $filters['uc_group_id']);
        }

        if (!empty($filters['active_status'])) {
            $this->db->where($this->m_users_clients_table . '.uc_active_status', $filters['active_status']);
        }

        $additive_fields_for_select = '';
        $is_user_joined = false;
        if (!empty($filters['show_user_username'])) {
            if (!$is_user_joined) {
                $this->db->join($this->m_users_table, $this->m_users_table . '.id = ' . $this->m_users_clients_table . '.uc_user_id');
            }
            $additive_fields_for_select .= ', ' . $this->m_users_table . ".username, " . $this->m_users_table . ".user_status, " . $this->m_users_table . ".email as user_email, " . $this->m_users_table . ".id as user_id ";
            $is_user_joined = true;
        }


        $is_group_joined = false;
        if (!empty($filters['show_group_name'])) {
            if (!$is_group_joined) {
                $this->db->join($this->m_groups_table, $this->m_groups_table . '.id = ' . $this->m_users_clients_table . '.uc_group_id');
            }
            $additive_fields_for_select .= ', ' . $this->m_groups_table . ".name as relation_group_name";
            $is_group_joined = true;
        }

        $fields_for_select = $this->m_users_clients_table . ".*";
        if ((!empty($limit) and $ci->common_lib->is_positive_integer($limit)) and (!empty($offset) and $ci->common_lib->is_positive_integer($offset))) {
            $this->db->limit($limit, $offset);
        }

        if ((!empty($limit) and $ci->common_lib->is_positive_integer($limit))) {
            $this->db->limit($limit);
        }
        $fields_for_select .= ' ' . $additive_fields_for_select;

        if (!empty($sort)) {
            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));
        }

        if ($OutputFormatCount) {
            return $this->db->count_all_results($this->m_users_clients_table);
        } else {
            $query = $this->db->from($this->m_users_clients_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = &get_instance();
            $ret_array = $query->get()->result();

            //echo "last query is : " . $this->db->last_query(); exit(0);

            return $ret_array;
        }
    }

    ////////////// USERS CLIENTS BLOCK END /////////////


    ////////////// GROUPS BLOCK START /////////////
    public function getGroupsSelectionList($filters = array(), $sort = 'group_title', $sort_direction = 'asc', $excludeArray = [])
    {
        $ci = &get_instance();
        $groupsList = $ci->users_mdl->getGroupsList(false, 0, $filters, $sort, $sort_direction);
        $ResArray = array();
        foreach ($groupsList as $lgroup) {
            if (in_array($lgroup->name, $excludeArray)) continue;
            $ResArray[] = array('key' => $lgroup->id, 'value' => $lgroup->description);
        }
        return $ResArray;
    }


    /**********************
     * Get Group list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of Group objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for group_title,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/

    public function getGroupsList($OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')

    {

        if (empty($sort))

            $sort = 'group_title';

        $config_data = $this->config->config;

        $ci = &get_instance();

        $items_per_page = $ci->common_lib->getSettings('items_per_page');

        $limit = !empty($filters['limit']) ? $filters['limit'] : '';

        $offset = !empty($filters['offset']) ? $filters['offset'] : '';

        $is_page_positive_integer = $ci->common_lib->is_positive_integer($page);

        if (!empty($page) and $is_page_positive_integer) {

            $limit = '';

            $offset = '';

        }

        if (!empty($config_data) and $is_page_positive_integer) {

            $per_page = (!empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page'])) ? $filters['per_page'] : $items_per_page;

            $limit = $per_page;

            $offset = ($page - 1) * $per_page;

        }


        if (!empty($filters['group_title'])) {

            $this->db->like($this->m_groups_table . '.group_title', $filters['group_title']);

        }


        if (!empty($filters['name'])) {

            $this->db->like($this->m_groups_table . '.name', $filters['name']);

        }


        $additive_fields_for_select = "";

        $fields_for_select = $this->m_groups_table . ".*";


        if ((!empty($limit) and $ci->common_lib->is_positive_integer($limit)) and (!empty($offset) and $ci->common_lib->is_positive_integer($offset))) {

            $this->db->limit($limit, $offset);

        }


        if ((!empty($limit) and $ci->common_lib->is_positive_integer($limit))) {

            $this->db->limit($limit);

        }


        $fields_for_select .= ' ' . $additive_fields_for_select;


        if (!empty($sort)) {

            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));

        }


        if ($OutputFormatCount) {

            return $this->db->count_all_results($this->m_groups_table);

        } else {

            $query = $this->db->from($this->m_groups_table);

            if (strlen(trim($fields_for_select)) > 0) {

                $query->select($fields_for_select);

            }

            $ci = &get_instance();

            $ret_array = $query->get()->result();

            return $ret_array;

        }

    }


    public function getGroupRowById($id)

    {

        $this->db->where($this->m_groups_table . '.id', $id);

        $query = $this->db->from($this->m_groups_table);

        $ci = &get_instance();

        $resultRows = $query->get()->result();

        if (!empty($resultRows[0])) {

            return $resultRows[0];

        }

        return false;

    }


    public function getSimilarGroupByGroup_Title($group_title, $id = '')

    {

        $config_data = $this->config->config;

        $this->db->where('group_title', $group_title);

        $this->db->from($this->m_groups_table);

        if (!empty($id)) {

            $this->db->where('id != ' . $id);

        }

        $row = $this->db->get()->result();

        if (empty($row[0])) return false;

        return $row[0];

    }





    ////////////// GROUPS BLOCK END /////////////


    ////////////// USER GROUPS BLOCK START /////////////

    public function getUsersGroupsSelectionList($filters = array(), $sort = 'user_id', $sort_direction = 'asc')

    {

        $ci = &get_instance();

        $groupsList = $ci->users_mdl->getUsersGroupsList(false, 0, $filters, $sort, $sort_direction);

        $ResArray = array();

        foreach ($groupsList as $lgroup) {

            $ResArray[] = array('key' => $lgroup->id, 'value' => $lgroup->description);

        }

        return $ResArray;

    }


    /**********************
     * Get UsersGroups list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of UsersGroups objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for user_id,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/

    public function getUsersGroupsList($OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty($sort)) $sort = 'uc_user_id';

        $config_data = $this->config->config;
        $ci = &get_instance();
        $items_per_page = $ci->common_lib->getSettings('items_per_page');

        $limit = !empty($filters['limit']) ? $filters['limit'] : '';
        $offset = !empty($filters['offset']) ? $filters['offset'] : '';
        $is_page_positive_integer = $ci->common_lib->is_positive_integer($page);

        if (!empty($page) and $is_page_positive_integer) {
            $limit = '';
            $offset = '';
        }

        if (!empty($config_data) and $is_page_positive_integer) {
            $per_page = (!empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page'])) ? $filters['per_page'] : $items_per_page;
            $limit = $per_page;
            $offset = ($page - 1) * $per_page;
        }

        if (!empty($filters['user_id'])) {
            $this->db->where($this->m_users_clients_table . '.uc_user_id', $filters['user_id']);
        }

        if (!empty($filters['client_id'])) {
            $this->db->where($this->m_users_clients_table . '.uc_client_id', $filters['client_id']);
        }

        if (!empty($filters['status'])) {
            $this->db->where($this->m_users_clients_table . '.uc_active_status', $filters['status']);
        }

        if (!empty($filters['group_id'])) {
            $this->db->where($this->m_users_clients_table . '.uc_group_id', $filters['group_id']);
        }

        $is_users_groups_joined = false;
        $additive_fields_for_select = "";
        $fields_for_select = $this->m_users_clients_table . ".*";
//        $fields_for_select = $this->m_clients_table . ".*";
        if (!empty($filters['show_groups_description'])) {
            $additive_fields_for_select .= ", description as group_description , name as group_name ";
            if (!$is_users_groups_joined) {
                $is_users_groups_joined = true;
                $this->db->join($this->m_groups_table, $this->m_groups_table . '.id = ' . $this->m_users_clients_table . '.uc_group_id', 'left');
            }
        }

        if ((!empty($limit) and $ci->common_lib->is_positive_integer($limit)) and (!empty($offset) and $ci->common_lib->is_positive_integer($offset))) {
            $this->db->limit($limit, $offset);
        }

        if ((!empty($limit) and $ci->common_lib->is_positive_integer($limit))) {
            $this->db->limit($limit);
        }
        $this->db->group_by('uc_group_id');
        $fields_for_select .= ' ' . $additive_fields_for_select;
        if (!empty($sort)) {
            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));
        }

        if ($OutputFormatCount) {
            return $this->db->count_all_results($this->m_users_clients_table);
        } else {
            $query = $this->db->from($this->m_users_clients_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = &get_instance();
            $ret_array = $query->get()->result();
            //echo "last query is : " . $this->db->last_query(); exit(0);
            return $ret_array;
        }
    }

    /*public function getUsersGroupsList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty( $sort )) $sort = 'user_id';

        $config_data = $this->config->config;
        $ci = & get_instance();
        $items_per_page= $ci->common_lib->getSettings('items_per_page');

        $limit = !empty($filters['limit']) ? $filters['limit'] : '';
        $offset = !empty($filters['offset']) ? $filters['offset'] : '';
        $is_page_positive_integer= $ci->common_lib->is_positive_integer($page);

        if ( !empty($page) and $is_page_positive_integer ) {
            $limit = '';
            $offset = '';
        }

        if (!empty($config_data) and $is_page_positive_integer) {
            $per_page= ( !empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page']) ) ? $filters['per_page'] : $items_per_page;
            $limit = $per_page;
            $offset = ($page - 1) * $per_page;
        }

        if (!empty($filters['user_id'])) {
            $this->db->where( $this->m_users_groups_table.'.user_id', $filters['user_id'] );
        }


        if (!empty($filters['status'])) {
            $this->db->where( $this->m_users_groups_table.'.status', $filters['status'] );
        }

        if (!empty($filters['group_id'])) {
            $this->db->where( $this->m_users_groups_table.'.group_id', $filters['group_id'] );
        }

        $is_users_groups_joined= false;
        $additive_fields_for_select= "";
        $fields_for_select= $this->m_users_groups_table.".*";
//        $fields_for_select = $this->m_clients_table . ".*";
        if ( !empty($filters['show_groups_description']) ) {
            $additive_fields_for_select .= ", description as group_description , name as group_name ";
            if ( !$is_users_groups_joined ) {
                $is_users_groups_joined= true;
                $this->db->join($this->m_groups_table, $this->m_groups_table . '.id = ' . $this->m_users_groups_table . '.group_id', 'left');
            }
        }

        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) and ( !empty($offset) and $ci->common_lib->is_positive_integer($offset) ) ) {
            $this->db->limit($limit, $offset);
        }

        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) ) {
            $this->db->limit($limit);
        }

        $fields_for_select.= ' ' . $additive_fields_for_select;
        if (!empty($sort)) {
            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));
        }

        if ($OutputFormatCount) {
            return $this->db->count_all_results($this->m_users_groups_table);
        } else {
            $query = $this->db->from($this->m_users_groups_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();
            echo "last query is : " . $this->db->last_query(); exit(0);
            return $ret_array;
        }
    }*/

    public function updateUsersGroups($user_id, $DataArray)
    {
        if (empty($user_id)) return;
        $this->db->where('user_id', $user_id);
        $this->db->delete($this->m_users_groups_table);
        foreach ($DataArray as $next_key => $next_group_id) {
            $Res = $this->db->insert($this->m_users_groups_table, array('user_id' => $user_id, 'group_id' => $next_group_id));
        }
    }


    public function deleteUsers_GroupsByUserId($user_id)
    {
        if (!empty($user_id)) {
            $this->db->where('user_id', $user_id);
            $Res = $this->db->delete($this->m_users_groups_table);
            return $Res;
        }
    }





    ////////////// USER GROUPS BLOCK END /////////////


    ////////////// JOBS BLOCK START /////////////

    /*	public function getJobsSelectionList( $filters = array(), $sort = 'job_description',  $sort_direction = 'asc')

        {

        $ci = & get_instance();

        $JobsList = $ci->users_mdl->getJobsList(false, 0, $filters, $sort, $sort_direction);

        $ResArray = array();

        foreach ($JobsList as $lJob) {

            $ResArray[] = array('key' => $lJob->id, 'value' => $lJob->job_description);

        }

        return $ResArray;

        }*/


    /**********************
     * Get Jobs Types list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of Jobs types objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for job_description,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/

    /*	public function getJobsList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')

        {

        if (empty( $sort ))

            $sort = 'job_description';

        $config_data = $this->config->config;

        $ci = & get_instance();

        $items_per_page= $ci->common_lib->getSettings('items_per_page');

        $limit = !empty($filters['limit']) ? $filters['limit'] : '';

        $offset = !empty($filters['offset']) ? $filters['offset'] : '';

        $is_page_positive_integer= $ci->common_lib->is_positive_integer($page);

        if ( !empty($page) and $is_page_positive_integer ) {

            $limit = '';

            $offset = '';

        }

        if (!empty($config_data) and $is_page_positive_integer) {

            $per_page= ( !empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page']) ) ? $filters['per_page'] : $items_per_page;

            $limit = $per_page;

            $offset = ($page - 1) * $per_page;

        }



        if (!empty($filters['job_description'])) {

            $this->db->like( $this->m_jobs_table.'.job_description', $filters['job_description'] );

        }



        if (!empty($filters['job_title'])) {

            $this->db->where( $this->m_jobs_table.'.job_title', $filters['job_title'] );

        }



        if (!empty($filters['job_name'])) {

            $this->db->where( $this->m_jobs_table.'.job_name', $filters['job_name'] );

        }



        $additive_fields_for_select= "";

        $fields_for_select= $this->m_jobs_table.".*";



        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) and ( !empty($offset) and $ci->common_lib->is_positive_integer($offset) ) ) {

            $this->db->limit($limit, $offset);

        }



        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) ) {

            $this->db->limit($limit);

        }





        $fields_for_select.= ' ' . $additive_fields_for_select;



        if (!empty($sort)) {

            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));

        }



        if ($OutputFormatCount) {

            return $this->db->count_all_results($this->m_jobs_table);

        } else {

            $query = $this->db->from($this->m_jobs_table);

            if (strlen(trim($fields_for_select)) > 0) {

            $query->select($fields_for_select);

            }

            $ci = & get_instance();

            $ret_array= $query->get()->result();

            return $ret_array;

        }

        }*/


    /*	public function getJobRowById( $id )

        {

        $this->db->where( $this->m_jobs_table . '.id', $id);

        $query = $this->db->from($this->m_jobs_table);

        $ci = & get_instance();

        $resultRows = $query->get()->result();

        if ( !empty($resultRows[0]) ) {

            return $resultRows[0];

        }

        return false;

        }



        public function getSimilarJobByJob_Description($job_description, $id='')

        {

        $config_data = $this->config->config;

        $this->db->where('job_description', $job_description);

        $this->db->from($this->m_jobs_table);

        if (!empty($id)) {

            $this->db->where('id != ' . $id);

        }

        $row= $this->db->get()->result();

        if (empty($row[0])) return false;

        return $row[0];

        }*/


    ////////////// JOBS BLOCK END /////////////


    ////////////// USERS CLIENTS BLOCK END /////////////


    public function deleteUsers_ClientsByUserId($user_id)
    {

        if (!empty($user_id)) {

            $this->db->where('uc_user_id', $user_id);

            $Res = $this->db->delete($this->m_users_clients_table);

            return $Res;

        }

    }

    public function getUserClientGroup($user_id, $client_id)
    {
        $this->db->where('uc_user_id', $user_id);
        $this->db->where('uc_client_id', $client_id);
        $this->db->where('uc_active_status', 'A');
        $this->db->from('users_clients');
        $query = $this->db->get();
        $res = $query->result();
        /*echo "last query is " . $this->db->last_query();
        echo "res is : ";
        print_r($res);
        exit(0);*/
        $groupList = array();
        foreach ($res as $r) {
            $groupDetail = $this->getGroupRowById($r->uc_group_id);
            $groupList[] = $groupDetail;
        }
        //echo "group list is : ";
        //print_r($groupList);
        return $groupList;
    }

    public function getUsersCount($clientIds = array())
    {
        $query = $this->db->query("SELECT uc_client_id, COUNT(uc_client_id) as user_count FROM users_clients WHERE uc_client_id IN (" . implode(',', $clientIds) . ") GROUP BY uc_client_id ORDER BY `uc_client_id` ASC");

        return $query->result();
    }

    public function getAutocompleteNames()
    {
        $this->db->select("id, first_name, last_name, username, email");
        //$this->db->where('id', 1);
        $this->db->from("users");
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }



    ////////////// USERS CLIENTS BLOCK START /////////////


    ////////////// USERS BLOCKS BLOCK START /////////////

    /**********************
     * Get users_jobs list/rows count depending of filters parameters
     * acces public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of users_jobs objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : asoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for vt_name,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/

    /*	public function getUsers_GroupsList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')

        {

        if (empty( $sort ))

            $sort = 'user_id';

        $config_data = $this->config->config;

        $ci = & get_instance();

        $items_per_page= $ci->common_lib->getSettings('items_per_page');

        $limit = !empty($filters['limit']) ? $filters['limit'] : '';

        $offset = !empty($filters['offset']) ? $filters['offset'] : '';

        $is_page_positive_integer= $ci->common_lib->is_positive_integer($page);

        if ( !empty($page) and $is_page_positive_integer ) {

            $limit = '';

            $offset = '';

        }

        if (!empty($config_data) and $is_page_positive_integer) {

            $per_page= ( !empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page']) ) ? $filters['per_page'] : $items_per_page;

            $limit = $per_page;

            $offset = ($page - 1) * $per_page;

        }



        if (!empty($filters['user_id'])) {

            $this->db->where( $this->m_users_groups_table.'.user_id', $filters['user_id'] );

        }

        if (!empty($filters['group_id'])) {

            $this->db->where( $this->m_users_groups_table.'.group_id', $filters['group_id'] );

        }



        $fields_for_select= $this->m_users_groups_table.".*";



        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) and ( !empty($offset) and $ci->common_lib->is_positive_integer($offset) ) ) {

            $this->db->limit($limit, $offset);

        }



        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) ) {

            $this->db->limit($limit);

        }



        if (!empty($sort)) {

            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));

        }



        if ($OutputFormatCount) {

            return $this->db->count_all_results($this->m_users_groups_table);

        } else {

            $query = $this->db->from($this->m_users_groups_table);

            if (strlen(trim($fields_for_select)) > 0) {

            $query->select($fields_for_select);

            }

            $ci = & get_instance();

            $ret_array= $query->get()->result();

            return $ret_array;

        }

        }



        public function updateUsersGroups($user_id, $DataArray)

        {

        if (empty($user_id)) return;



        $this->db->where('user_id', $user_id);

        $this->db->delete($this->m_users_groups_table);



        foreach( $DataArray as $next_key=>$next_group_id ) {

            $Res = $this->db->insert($this->m_users_groups_table, array( 'user_id'=> $user_id, 'group_id'=> $next_group_id ) );

        }



        }*/


//	/**********************

//	 * update/insert users_clients table with new_status

//	 * depending if there is such row

//	 * access public

//	 * @ params

//	 * return users_clients.uc_id

//	 *********************************/

//	public function update_users_clients( $client_id, $related_user_id, $new_status ) {

//		$date_time_mysql_format= $this->common_lib->getSettings('date_time_mysql_format', '%Y-%m-%d %H:%M:%S');

//		$this->db->where( $this->m_users_clients_table . '.uc_client_id', $client_id);

//		$this->db->where( $this->m_users_clients_table . '.uc_user_id', $related_user_id);

//		$query = $this->db->from($this->m_users_clients_table);

//		$row = $query->get()->result();

//		if ( !empty($row) and !empty($row[0]->uc_id) ) {

//			$this->db->where( $this->m_users_clients_table . '.uc_id', $row[0]->uc_id);

//			$data = array(

//				'uc_client_id' => $client_id ,

//				'uc_user_id' => $related_user_id,

//				'uc_active_status'=> $new_status,

//				'updated_at'=> strftime($date_time_mysql_format)

//			);

//			$this->db->update($this->m_users_clients_table, $data);

//			return $row[0]->uc_id;

//		} else {

//			$data = array(

//				'uc_client_id' => $client_id ,

//				'uc_user_id' => $related_user_id,

//				'uc_active_status'=> $new_status,

//				'updated_at'=> strftime($date_time_mysql_format)

//			);

//			$this->db->insert($this->m_users_clients_table, $data);

//			return $this->db->insert_id();

//		}

//	}


    /*	public function deleteUsers_GroupsByUserId($user_id) {

        if (!empty($user_id)) {

            $this->db->where('user_id', $user_id);

            $Res = $this->db->delete($this->m_users_groups_table);

            return $Res;

        }

        }*/


    ////////////// USERS GROUPS BLOCK END /////////////


}

