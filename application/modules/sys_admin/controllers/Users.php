<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$group = array('sys-admin');
		if (!$this->ion_auth->in_group($group)) {
			redirect( base_url() . "login/logout" );
		}
		$this->load->library('Sys_admin_lib', NULL, 'admin_lib');
		$this->load->model('sys_admin_mdl', 'admin_mdl');
		$this->load->model('users_mdl');
		$this->load->model('cms_items_mdl');
		$this->load->model('activity_logs_mdl');
        $this->load->model('clients_mdl');
		$this->lang->load('sys_admin');
		$this->config->load('sys_admin_menu_new', true);
		$this->menu = $this->config->item('sys_admin_menu_new');

		$this->user = $this->common_mdl->get_admin_user();

		if ( $this->user->user_status != 'A' ) {  // Only active user can access admin pages
			redirect( base_url() . "login/logout" );
		}
		$this->group = $this->ion_auth->get_users_groups()->row();
	}


	////////////// USERS BLOCK START /////////////
	/**********************
	 * view users
	 * access public
	 * @params
	 * return view
	 *********************************/

	public function users_overview(){
		$UriArray = $this->uri->uri_to_assoc(3);
		if ( !empty($UriArray['users-overview']) and $this->common_lib->is_positive_integer($UriArray['users-overview'])  ) {
			$user_id= $UriArray['users-overview'];
		}
		$editable_user= $this->users_mdl->getUserRowById( $user_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );
		if ($editable_user->user_status == 'N' || $editable_user->user_status == 'P' )
            $data['user_status'] = 'Pending';
		elseif ($editable_user->user_status == 'A')
            $data['user_status'] = 'Active';
        elseif ($editable_user->user_status == 'I')
            $data['user_status'] = 'Inactive';
        else
            $data['user_status'] = $editable_user->user_status;

		$data['editable_user']		= $editable_user;
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;
		$data['page']		= 'users/user-overview-page';
		$data['javascript'] = array( 'assets/global/js/users-overview-view.js','assets/global/js/validate.js' );//page javascript
		$views				=  array('design/html_topbar_user_overview','sidebar','design/page','design/html_footer', 'common_dialogs.php');


        $us_id =  $this->uri->segment(4, 0);
        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
		$data['clients']=$this->clients_mdl->getClients($us_id);
//        echo "<pre>";
//        print_r( $data);
//        die;
//		$this->load->view('users/user-overview-page');
		$this->layout->view($views, $data);
	}

	public function users_view(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;

		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;
		$UriArray = $this->uri->uri_to_assoc(4);
		$post_array = $this->input->post();

		/* get and keep all filters/page_number for pagination and sorting parameters*/
		$sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
		$sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
		$page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
		$filter_username = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_username');
		$filter_user_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_user_status');
		$filter_zip = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_zip');
		$filter_user_group_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_user_group_id');
		$filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
		$filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
		$filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
		$filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till);

		$page_parameters_with_sort = $this->usersPreparePageParameters($UriArray, $post_array, false, true);     // keep all sorting parameters for using in sorting
		$page_parameters_without_sort = $this->usersPreparePageParameters($UriArray, $post_array, false, false); // by column header or at editor submitting to keep current filters

		$this->load->library('pagination');
		$pagination_config= $this->common_lib->getPaginationParams();
		$pagination_config['base_url'] = base_url() . 'sys-admin/users/users-view' . $page_parameters_with_sort . '/page_number';

		$rows_in_table= $this->users_mdl->getUsersList(true, '', array( 'username'=> $filter_username, 'user_status'=> $filter_user_status, 'zip'=> $filter_zip, 'user_group_id'=> $filter_user_group_id, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );  // get number of rows by given parameters
		$pagination_config['total_rows'] = $rows_in_table;
		$this->pagination->initialize($pagination_config);  // pagination system initialization by parameters in config file
		$data['users']= array();
		if ($rows_in_table > 0) { // number of rows by given parameters > 0 - get rows by given parameters for given $page_number.
			$data['users']= $this->users_mdl->getUsersList(false, $page_number, array( 'show_user_group'=>1, 'show_clients_name'=>1, 'username'=> $filter_username, 'user_status'=> $filter_user_status, 'zip'=> $filter_zip, 'user_group_id'=> $filter_user_group_id, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );
		} // IMPORTANT : all filter parameters must be similar as in calling of getUsersList above

		$data['page']		= 'users/users-view';
		$data['page_number']		= $page_number;
		$data['RowsInTable']= $rows_in_table;
		$data['editor_message']= $this->session->flashdata('editor_message');
		$data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

		$data['user_GroupsSelectionList']= $this->users_mdl->getGroupsSelectionList();
		$data['userStatusValueArray']= $this->users_mdl->getUserStatusValueArray();

		$data['filter_username']= $filter_username;
		$data['filter_zip']= $filter_zip;
		$data['filter_user_status']= $filter_user_status;
		$data['filter_user_group_id']= $filter_user_group_id;
		$data['filter_created_at_from']= $filter_created_at_from;
		$data['filter_created_at_till']= $filter_created_at_till;
		$data['filter_created_at_from_formatted']= $filter_created_at_from_formatted;
		$data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;
		$data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;
		$data['page_parameters_with_sort']= $page_parameters_with_sort;
		$data['page_parameters_without_sort']= $page_parameters_without_sort;
		$data['sort_direction']= $sort_direction;
		$data['sort']= $sort;
		$pagination_links = $this->pagination->create_links();

		// create label for current parameter so moving mouse over "Filter" button user can see current filters
		$filters_label_array= array('username'=> $filter_username, 'user_status'=> $this->common_lib->get_user_status_label($filter_user_status), 'zip'=> $filter_zip, 'filter_user_group_id'=> $filter_user_group_id, 'created at from'=> $filter_created_at_from, 'created at till'=>$filter_created_at_till);

		$filters_label= $this->common_lib->get_filters_label( $filters_label_array, '<br>' );
		$data['filters_label'] = $filters_label;
		$data['plugins'] 	= array();
		$data['pagination_links'] 	= $pagination_links;
		$data['javascript'] = array( 'assets/custom/admin/users.js', 'assets/global/plugins/picker/picker.js', 'assets/global/plugins/picker/picker.date.js', 'assets/global/plugins/picker/picker.time.js'); // add picker.date pluging for date selection in fileters form
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php');
//		echo "<pre>";
//		print_r($data['menu']);
//		die;
		$data['TotalRecords'] = count($data['users']);
		$data['sidebarMenu'] = "users";
		$this->layout->view($views, $data);
	}

    public function user_change_status(){
	    $user_id=$_POST["id"];
	    $status =$_POST["status"];
	    $arr_status=[
	        'Pending'=>'P',
	        'Active'=>'A',
	        'Inactive'=>'I'
        ];
        $this->db->update($this->users_mdl->m_users_table, array('user_status'=>$arr_status[$status]), array('id' => $user_id));
	    exit;


    }
	/**********************
	 * Edit users
	 * access public
	 * @params usr_segment->3 (users id)
	 * return view
	 *********************************/
	public function users_edit()
	{
		//echo "here we are...";exit(0);
		$UriArray = $this->uri->uri_to_assoc(3);
		$is_insert= true;
		$app_config = $this->config->config;
		$user_id= '';
		if ( !empty($UriArray['users-edit']) and $this->common_lib->is_positive_integer($UriArray['users-edit'])  ) {
			$is_insert= false;
			$user_id= $UriArray['users-edit'];
		}
		$post_array = $this->input->post();
		/*echo "post array is ";
		print_r($post_array);
		exit(0);*/

		$sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
		$sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
		$page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
		$filter_username = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_username');
		$filter_user_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_user_status');
		$filter_zip = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_zip');
		$filter_user_group_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_user_group_id');
		$filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
		$filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
		$filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
		$filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016
		$data['filter_username']= $filter_username;
		$data['filter_user_status']= $filter_user_status;
		$data['filter_zip']= $filter_zip;
		$data['filter_user_group_id']= $filter_user_group_id;
		$data['filter_created_at_from']= $filter_created_at_from;
		$data['filter_created_at_till']= $filter_created_at_till;
		$data['filter_created_at_from_formatted']= $filter_created_at_from_formatted;
		$data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;

		$page_parameters_with_sort = $this->usersPreparePageParameters($UriArray, $post_array, false, true);
		$page_parameters_without_sort = $this->usersPreparePageParameters($UriArray, $post_array, false, false);
		$redirect_url = base_url() . 'sys-admin/users/users-view' . $page_parameters_with_sort;

		$data['meta_description']='';
		$data['editor_message']= $this->session->flashdata('editor_message');
		$data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');
		$data['user_GroupsSelectionList']= $this->users_mdl->getGroupsSelectionList();
		$data['userStatusValueArray']= $this->users_mdl->getUserStatusValueArray();
		$data['userPhoneTypeArray']= $this->users_mdl->getUserPhoneTypeArray();
//		if ( $is_insert ) { // in insert mode user can be new or waiting for confirmation
//			foreach ( $data['userStatusValueArray'] as $next_key=>$next_userStatus ) {
//				if ( !in_array($next_userStatus['key'],array('N', 'P')) ) {
//					unset($data['userStatusValueArray'][$next_key]);
//				}
//			}  // Array('N' => 'New', 'P' => 'Waiting for activation', 'A' => 'Active', 'I' => 'Inactive');
//		}
		$groupsSelectionList= $this->users_mdl->getGroupsSelectionList( array(), 'id',  'asc' );

		$usersGroups = $this->users_mdl->getUsersGroupsList( false, 0, array('user_id'=> $user_id) );
		if ( !$is_insert ) {
			foreach ($groupsSelectionList as $next_key => $next_user_group_selection) {
				foreach ($usersGroups as $next_users_ob) {
					if ($next_user_group_selection['key'] == $next_users_ob->group_id) {
						$groupsSelectionList[$next_key]['checked'] = true;
					}
				}
			}
		}
		$data['groupsSelectionList']  = $groupsSelectionList;

		$data['is_insert']  = $is_insert;
		$data['user_id']      = $user_id;
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;
		$editable_user= '';
		$data['validation_errors_text'] = '';
		$this->user_edit_form_validation($is_insert, $user_id);
		if (!empty($_POST)) {

			$validation_status = $this->form_validation->run();
			//echo "validation status is : " . $validation_status ;
			if ($validation_status != FALSE) {
				//echo "in if...";
				$this->user_edit_makesave ($is_insert, $user_id, $data['select_on_update'], $redirect_url, $page_parameters_with_sort, $post_array, $app_config );
			} else {
				//echo "in else...";
				$editable_user = $this->user_edit_fill_current_data( $editable_user, $is_insert, $user_id );
				foreach ($groupsSelectionList as $next_key => $next_groups_selection) {
					$is_found= false;
					foreach ($_POST as $next_post_key=> $next_post_value) {
						$a= preg_split('/cbx_user_has_groups_/',$next_post_key );
						if (count($a)==2) {
							if ($next_groups_selection['key'] == $a[1]) {
								$groupsSelectionList[$next_key]['checked'] = true;
								$is_found= true;
							}
						}
					}
					if ( !$is_found ) {
						$groupsSelectionList[$next_key]['checked'] = false;
					}

				}
				$data['groupsSelectionList']  = $groupsSelectionList;
				$data['validation_errors_text'] = validation_errors( /*$layout_config['backend_error_icon_start'], $layout_config['backend_error_icon_end']*/ );
				$this->session->set_flashdata('validation_errors_text',$data['validation_errors_text']);
				$this->session->set_flashdata('user_edit_new_post_data',implode('^',$post_array['data']));
			}
			//echo "validation error is : " . validation_errors();
			//exit(0);
			$client_id = $this->input->post('hdn_client_id');
			redirect('/sys-admin/client/' . $client_id, 'refresh');
		}
		else {
			$editable_user= $this->users_mdl->getUserRowById( $user_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );

//			if ( !empty($editable_user) and in_array($editable_user->user_status, array('A','I') ) ) {
//				foreach ( $data['userStatusValueArray'] as $next_key=>$next_userStatus ) {
//					if ( !in_array($next_userStatus['key'],array('A', 'I')) ) {
//						unset($data['userStatusValueArray'][$next_key]);
//					}
//				}
//			}   // Array('N' => 'New', 'P' => 'Waiting for activation', 'A' => 'Active', 'I' => 'Inactive');

//			if ( !empty($editable_user) and in_array($editable_user->user_status, array('N','P') ) ) {
//				foreach ( $data['userStatusValueArray'] as $next_key=>$next_userStatus ) {
//					if ( !in_array($next_userStatus['key'],array('N', 'P')) ) {
//						unset($data['userStatusValueArray'][$next_key]);
//			/.lrtfg		}
//				}
//			}   // Array('N' => 'New', 'P' => 'Waiting for activation', 'A' => 'Active', 'I' => 'Inactive');
			$users_groups_list= $this->users_mdl->getUsersGroupsList( false, 0, array('user_id'=> $user_id));
			if ( !empty($editable_user) and !empty($users_groups_list[0]->group_id) ) {
//				$editable_user->user_group_id = $users_groups_list[0]->group_id;
			}
		}
		if($user_id){
			$image_path='assets/avatar/'.$user_id.'/';

			$images = glob($image_path."*");


			if($images){
				$image_names = scandir($image_path);
				$data['user_image']	= $images;
				$data['user_image_name']= $image_names;
			}else{
				$data['user_image']=['assets/avatar/avatar.png'];
				$data['user_image_name']=['avatar.png'];
			}

		}else{
			$data['user_image']=['assets/avatar/avatar.png'];
			$data['user_image_name']=['avatar.png'];
		}

		

		$data['editable_user']		= $editable_user;

		$data['page_parameters_with_sort']= $page_parameters_with_sort;
		$data['page_parameters_without_sort']= $page_parameters_without_sort;
//		$data['page']		= 'users/user-edit'; //page view to load
		$data['page']		= 'users/user-overview-page'; //page view to load
		$data['plugins'] 	= array('validation'); //page plugins
//		$data['javascript'] = array( 'assets/custom/admin/user-edit.js' );//page javascript
		$data['javascript'] = array( 'assets/global/js/users-overview-view.js','assets/global/js/validate.js','assets/custom/admin/user-edit.js');//page javascript
//		$views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$views				=  array('design/html_topbar_user_overview','sidebar','design/page','design/html_footer', 'common_dialogs.php');
//		echo "<pre>";
//		print_r($data);
//		die;

		$this->layout->view($views, $data);
	}

	public function users_uploadimage(){

		if ( 0 < $_FILES['file']['error'] ) {
			echo 'Error: ' . $_FILES['file']['error'] . '<br>';
		}
		else {
			$upload_path='assets/avatar/'.$_POST['user'].'/';
			if (!file_exists($upload_path)) {
				mkdir($upload_path, 0777, true);
			}
			move_uploaded_file($_FILES['file']['tmp_name'], $upload_path . $_FILES['file']['name']);
		}


	}

	public function user_check_username_is_unique()
	{
		$username = $this->input->post('data[username]', '');
		if (empty($username)) {
			$this->form_validation->set_message('user_check_username_is_unique', " The ".lang('user')." field is required ! ");
			return FALSE;
		}
		$user_id = $this->input->post('data[id]', 0);
		if ( $user_id == 'new' ) $user_id= 0;
		$similarUser= $this->users_mdl->getSimilarUserByUsername( $username, $user_id );
		if (!empty($similarUser)) {
			$this->form_validation->set_message('user_check_username_is_unique', lang('user') . " '".$username."' must be unique ! ");
			return FALSE;
		}
		return TRUE;
	}

	public function user_check_email_is_unique()
	{
		$email = $this->input->post('data[email]', '');
		if (empty($email)) {
			$this->form_validation->set_message('user_check_email_is_unique', " The ".lang('user')." field is required ! ");
			return FALSE;
		}
		$user_id = $this->input->post('data[id]', 0);
		if ( $user_id == 'new' ) $user_id= 0;
		$similarUser= $this->users_mdl->getSimilarUserByEmail( $email, $user_id );
		if (!empty($similarUser)) {
			$this->form_validation->set_message('user_check_email_is_unique', lang('user') . " '".$email."' must be unique ! ");
			return FALSE;
		}
		return TRUE;
	}

	private function user_edit_fill_current_data($editable_user, $is_insert, $user_id )
	{
		$editable_user = new stdClass;
		$editable_user->id = $user_id;
		$editable_user->username = set_value('data[username]');
		$editable_user->email = set_value('data[email]');
		$editable_user->user_status = set_value('data[user_status]');
//		$editable_user->user_group_id = set_value('data[user_group_id]');
		$editable_user->first_name = set_value('data[first_name]');
		$editable_user->last_name = set_value('data[last_name]');
		$editable_user->city = set_value('data[city]');
		$editable_user->state = set_value('data[state]');
		$editable_user->zip = set_value('data[zip]');
		$editable_user->address1 = set_value('data[address1]');
		$editable_user->address2 = set_value('data[address2]');
		$editable_user->mobile = set_value('data[mobile]');
		$editable_user->phone = set_value('data[phone]');
		return $editable_user;
	}

	private function user_edit_form_validation($is_insert, $user_id)
	{
//		$this->form_validation->set_rules( 'data[username]', lang('user'), 'callback_user_check_username_is_unique' );
		$this->form_validation->set_rules( 'data[email]', lang('email'), 'trim|required|valid_email|callback_user_check_email_is_unique' );

//		$this->form_validation->set_rules( 'data[user_status]', lang('user_status'), 'required' );
		$this->form_validation->set_rules( 'data[first_name]', lang('first_name'), 'required' );
		$this->form_validation->set_rules( 'data[last_name]', lang('last_name'), 'required' );
		//$this->form_validation->set_rules( 'data[middle_name]', lang('middle_name'), 'required' );
		//$this->form_validation->set_rules( 'data[city]', lang('city'), 'required' );
		//$this->form_validation->set_rules( 'data[state]', lang('state'), 'required' );
		//$this->form_validation->set_rules( 'data[zip]', lang('zip'), 'required' );
		//$this->form_validation->set_rules( 'data[address1]', lang('address1'), 'required' );
		//$this->form_validation->set_rules( 'data[address2]', lang('address2'), '' );
//		$this->form_validation->set_rules( 'data[mobile]', lang('mobile'), '' );
		$this->form_validation->set_rules( 'data[phone]', lang('phone'), '' );
//		$this->form_validation->set_rules( 'user_has_groups_label', lang('user_has_groups_label'), 'callback_user_has_groups_label');
	}

	public function user_has_groups_label($str)
	{
		foreach( $_POST as $next_key=>$next_value ) {
			$a= preg_split('/cbx_user_has_groups_/',$next_key );
			if (count($a)==2) {
				return TRUE;
			}
		}
		$this->form_validation->set_message('user_has_groups_label', 'Check at least 1 '.lang('user_has_groups').'!');
		return false;
	}

	private function user_edit_makesave($is_insert, $user_id, $select_on_update, $redirect_url, $page_parameters_with_sort, $post_array, $app_config ) {

		$this->db->trans_start( );
		$ip_address= !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

		$original_user_avatar= !empty($post_array['data']['avatar']) ? $post_array['data']['avatar'] : '';
		if ( $is_insert ) {
			$user_group_array= array();
			foreach( $post_array as $next_key=>$next_value ) {
				$a= preg_split('/cbx_user_has_groups_/',$next_key );
				if (count($a)==2) {
					$user_group_array[]= $a[1];
				}
			}

			$auth = isset($post_array['cbx_auth'])?1:0;
			// For default waiting status
			$post_array['data']['user_status'] = "P";

			$additional_data= array(  'ip_address'=> $ip_address, 'user_status' => $post_array['data']['user_status'], 'first_name' => $post_array['data']['first_name'], 'last_name' => $post_array['data']['last_name'], 'city' => $post_array['data']['city'], 'state' => $post_array['data']['state'], 'zip' => $post_array['data']['zip'],  'address1' => $post_array['data']['address1'], 'address2' => $post_array['data']['address2'], 'mobile' => $post_array['data']['mobile'], 'phone' => $post_array['data']['phone'], 'created_on'=> now(), 'avatar' => $post_array['data']['avatar'], 'is_multi_auth' => $auth, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'super_id' => $this->user->user_id, 'uc_client_id' => $post_array['hdn_client_id'], 'uc_active_status' => 'P' );

			if  (  !empty( $post_array['cbx_clear_image'])  )  {
				$additional_data['avatar']= '';
			}
			if ( !empty( $_FILES['data']['name']['avatar_file_upload'] ) ) {
				$additional_data['avatar']= $_FILES['data']['name']['avatar_file_upload'];
			}
			$activation_code= $this->common_lib->GenerateActivationCode();
			$additional_data['activation_code']= $activation_code;
			
			//$additional_data['uc_user_id']= $user_id;
			//$additional_data['uc_client_id']= $post_array['hdn_client_id'];
			//$additional_data['uc_active_status']= 'P';
			

			$user_id = $this->ion_auth->register( $post_array['data']['username'], '', $post_array['data']['email'], $additional_data,   array(  $user_group_array  )  );

			// add data to users_clients table
			//hdn_client_id
			/*$insertClient['uc_user_id']= $user_id;
			$insertClient['uc_client_id']= $post_array['hdn_client_id'];*/
			/*$additional_data['uc_user_id']= $user_id;
			$additional_data['uc_client_id']= $post_array['hdn_client_id'];
			//$insertClient['uc_active_status']= 'P';
			$insert_id=$this->common_mdl->db_insert('users_clients',$additional_data, TRUE);*/


			if ( $post_array['data']['user_status'] == "P" ) { // sent message with activation code
				$activation_page_url= $app_config['base_url']."activation/".$activation_code;
				$title= 'You are registered at ' . $app_config['site_name'] . ' site';
				$content = $this->cms_items_mdl->getBodyContentByAlias('user_register',
					array('username' => $post_array['data']['username'],
					      'first_name' => $post_array['data']['first_name'],
					      'last_name' => $post_array['data']['last_name'],
					      'site_name' => $app_config['site_name'],
					      'support_signature' => $app_config['support_signature'],
					      'activation_page_url' => $activation_page_url,
					      'site_url' => $app_config['base_url'],
					      'email' => $post_array['data']['email']
					), true);
				$EmailOutput = $this->common_lib->SendEmail($post_array['data']['email'], $title, $content );
//				$this->common_lib->DebToFile( 'sendEmail $content::'.print_r($content,true));
			}
		} else {
//			$update_data= array( 'username' => $post_array['data']['username'], 'ip_address'=> $ip_address, 'email' => $post_array['data']['email'], 'user_status' => $post_array['data']['user_status'], 'first_name' => $post_array['data']['first_name'], 'last_name' => $post_array['data']['last_name'], 'city' => $post_array['data']['city'], 'state' => $post_array['data']['state'], 'zip' => $post_array['data']['zip'],  'address1' => $post_array['data']['address1'], 'address2' => $post_array['data']['address2'], 'mobile' => $post_array['data']['mobile'], 'phone' => $post_array['data']['phone'], 'avatar' => $post_array['data']['avatar'] );
			$update_data= array( 'ip_address'=> $ip_address,'first_name' => $post_array['data']['first_name'], 'last_name' => $post_array['data']['last_name'],'middle_name' => $post_array['data']['middle_name'], 'user_status' => $post_array['data']['user_status'], 'city' => $post_array['data']['city'], 'state' => $post_array['data']['state'], 'zip' => $post_array['data']['zip'],  'address1' => $post_array['data']['address1'], 'address2' => $post_array['data']['address2'], 'phone' => $post_array['data']['phone'],'phone_type' => $post_array['data']['user_phone_type'] );

			if  (  !empty( $post_array['cbx_clear_image'])  )  {
				$update_data['avatar']= '';
			}
			if ( !empty( $_FILES['data']['name']['avatar_file_upload'] ) ) {
				$update_data['avatar']= $_FILES['data']['name']['avatar_file_upload'];
			}

			if ( $post_array['data']['user_status'] == "P" ) { // sent message with activation code
				$activation_code= $this->common_lib->generateActivationCode();
				$update_data['activation_code']= $activation_code;
			} 
			$this->db->update($this->users_mdl->m_users_table, $update_data, array('id' => $user_id));
			$user_groups_array= array();
			foreach( $_POST as $next_key=>$next_value ) {
				$a= preg_split('/cbx_user_has_groups_/',$next_key );
				if (count($a)==2) {
					$user_groups_array[]= $a[1];
				}
			}
			$this->users_mdl->updateUsersGroups($user_id,$user_groups_array);
		}

		$avatar_path= $this->users_mdl->getUserImagePath($user_id, $post_array['data']['avatar']);
		$user_dir= $this->users_mdl->getUserDir($user_id);
		if (  !empty( $post_array['cbx_clear_image']) or !empty($_FILES['data']['name']['avatar_file_upload'])  )   {
			$original_img_path= $this->users_mdl->getUserImagePath($user_id, $original_user_avatar);
			if ( !empty($original_img_path) and file_exists($original_img_path) and !is_dir($original_img_path)) {
				unlink($original_img_path);
			}
		}


		$userImagesDirs = array( FCPATH . 'uploads', $this->users_mdl->getUsersDir(), $this->users_mdl->getUserDir($user_id) );
		$src_filename = $_FILES['data']['tmp_name']['avatar_file_upload'];
		$img_basename = $_FILES['data']['name']['avatar_file_upload'];

		$this->common_lib->createDir($userImagesDirs);
		$ret = move_uploaded_file( $src_filename, $this->users_mdl->getUserDir($user_id) . $img_basename );

		if ($select_on_update == 'reopen_editor') {
			$redirect_url = base_url() . 'sys-admin/users/users-edit/' . $user_id . $page_parameters_with_sort;
		}
		if ($select_on_update == 'open_editor_for_new') {
			$redirect_url = base_url() . 'sys-admin/users/users-edit/new' . $page_parameters_with_sort;
		}

		if ($user_id) {
			$this->session->set_flashdata('editor_message', lang('user') . " '" . $post_array['data']['first_name'] . "' was " . ($is_insert ? "inserted" : "updated") );
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
			} else {
				$this->db->trans_commit();
			}
			redirect($redirect_url);
			return;
		}

	}

	function remove_user($id = 0) {
		$this->load->model('users_mdl', '', true);

		$UriArray = $this->uri->uri_to_assoc(4);
		$id= $UriArray['id'];
		$PageParametersWithSort = $this->usersPreparePageParameters($UriArray, null, false, true);
		$RedirectUrl = '/sys-admin/users/users-view' . $PageParametersWithSort;
		if ( $this->user->id == $id  ) {
			$this->session->set_flashdata('editor_message', "Can not delete user '" . $this->user->username . "' as you logged under it ! ");
			redirect($RedirectUrl);
		}

		$removed_user = $this->users_mdl->getUserRowById($id);
		if (empty($removed_user)) {
			$this->session->set_flashdata('editor_message', "User '" . $id . "' not found");
			redirect($RedirectUrl);
		}
		$removed_user_name = $removed_user->username;

		$this->db->trans_start();
		$ret = $this->users_mdl->deleteUsers_ClientsByUserId($id);

		$ret = $this->users_mdl->deleteUsers_GroupsByUserId($id);

		$ret = $this->activity_logs_mdl->deleteActivityLogsByUserId($id);

		$ret = $this->users_mdl->deleteUser($id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->session->set_flashdata('editor_message', "User '" . $removed_user_name . "' was deleted");
			$this->db->trans_commit();
		}
		if ($ret) {
			$this->session->set_flashdata('editor_message', "User '" . $removed_user_name . "' was deleted");
			redirect($RedirectUrl);
			return;
		}

	}


	/**********************
	 * create string with all sorting parameters for using in sorting by column header or at editor submitting to keep current filters
	 * access public
	 * @params : $UriArray - $_GET array in assoc array, $_post_array - $_POST array,
	 * $WithPage - if TRUE"page_number" is added to the url, $WithSort - if to show current sort in resulting string. With TRUEif used in links to editor, with FALSE is used in
	 * sorting columns, as sorting is set for any column.
	 * return string with filters in pairs filter_name/filter_value
	 *********************************/
	private function usersPreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort)
	{
		$ResStr = '';
		if (!empty($_post_array)) { // form was submitted
			if ($WithPage) {
				$page_number = $this->input->post('page_number');
				$ResStr .= !empty($page) ? 'page_number/' . $page_number . '/' : 'page_number/1/';
			}
			$filter_username = $this->input->post('filter_username');
			$ResStr .= !empty($filter_username) ? 'filter_username/' . $filter_username . '/' : '';
			$filter_user_status = $this->input->post('filter_user_status');
			$ResStr .= !empty($filter_user_status) ? 'filter_user_status/' . $filter_user_status . '/' : '';
			$filter_zip = $this->input->post('filter_zip');
			$ResStr .= !empty($filter_zip) ? 'filter_zip/' . $filter_zip . '/' : '';



			$filter_user_group_id = $this->input->post('filter_user_group_id');
			$ResStr .= !empty($filter_user_group_id) ? 'filter_user_group_id/' . $filter_user_group_id . '/' : '';
			$filter_created_at_from = $this->input->post('filter_created_at_from');
			$ResStr .= !empty($filter_created_at_from) ? 'filter_created_at_from/' . $filter_created_at_from . '/' : '';
			$filter_created_at_till = $this->input->post('filter_created_at_till');
			$ResStr .= !empty($filter_created_at_till) ? 'filter_created_at_till/' . $filter_created_at_till . '/' : '';
			if ($WithSort) {
				$sort_direction = $this->input->post('sort_direction');
				$ResStr .= !empty($sort_direction) ? 'sort_direction/' . $sort_direction . '/' : '';
				$sort = $this->input->post('sort');
				$ResStr .= !empty($sort) ? 'sort/' . $sort . '/' : '';
			}
		} else {
			if ($WithPage) {
				$ResStr .= !empty($UriArray['page_number']) ? 'page_number/' . $UriArray['page_number'] . '/' : 'page_number/1/';
			}
			$ResStr .= !empty($UriArray['filter_username']) ? 'filter_username/' . $UriArray['filter_username'] . '/' : '';
			$ResStr .= !empty($UriArray['filter_user_status']) ? 'filter_user_status/' . $UriArray['filter_user_status'] . '/' : '';
			$ResStr .= !empty($UriArray['filter_zip']) ? 'filter_zip/' . $UriArray['filter_zip'] . '/' : '';
			$ResStr .= !empty($UriArray['filter_user_group_id']) ? 'filter_user_group_id/' . $UriArray['filter_user_group_id'] . '/' : '';
			$ResStr .= !empty($UriArray['filter_created_at_from']) ? 'filter_created_at_from/' . $UriArray['filter_created_at_from'] . '/' : '';
			$ResStr .= !empty($UriArray['filter_created_at_till']) ? 'filter_created_at_till/' . $UriArray['filter_created_at_till'] . '/' : '';
			if ($WithSort) {
				$ResStr .= !empty($UriArray['sort_direction']) ? 'sort_direction/' . $UriArray['sort_direction'] . '/' : '';
				$ResStr .= !empty($UriArray['sort']) ? 'sort/' . $UriArray['sort'] . '/' : '';
			}
		}
		if (substr($ResStr, strlen($ResStr) - 1, 1) == '/') {
			$ResStr = substr($ResStr, 0, strlen($ResStr) - 1);
		}
		return '/' . $ResStr;
	}


	public function generate_new_password()
	{
		$app_config = $this->config->config;
		$UriArray = $this->uri->uri_to_assoc(4);

		$user_id= $this->common_lib->getParameter($this, $UriArray, array(), 'user_id');
		$modified_user= $this->users_mdl->getUserRowById($user_id);
		if ( empty($modified_user) ) {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => 'User not found !', 'ErrorCode' => 1, 'user_id' => $user_id )));
			return;
		}

		$password= $this->common_lib->generatePassword();
		$ret = $this->db->update( $this->users_mdl->m_users_table, array( 'password'=> $this->ion_auth->hash_password($password, false ) ), array( 'id' => $modified_user->id ) );

		$title= 'New password generated at ' . $app_config['site_name'] . ' site';
		$content = $this->cms_items_mdl->getBodyContentByAlias('new_password_generated',
			array('username' => $modified_user->username,
			      'password' => $password,
			      'first_name' => $modified_user->first_name,
			      'last_name' => $modified_user->last_name,
			      'site_name' => $app_config['site_name'],
			      'support_signature' => $app_config['support_signature'],
			      'site_url' => $app_config['base_url'],
			      'email' => $modified_user->email
			), true);
		$EmailOutput = $this->common_lib->SendEmail($modified_user->email, $title, $content );
		$this->common_lib->DebToFile( 'generate_new_password sendEmail $content::'.print_r($content,true));

		$this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'user_id' => $user_id )));
	}

    public function load_user_related_clients()
    {
        $UriArray = $this->uri->uri_to_assoc(4);
        $post_array = $this->input->post();
        $filter_user_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_user_id');

        $page = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page');
        $filter_related_clients_filter = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_related_clients_filter');
        $filter_related_clients_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_related_clients_type');
        $db_filter_related_clients_type= $filter_related_clients_type;
        $client_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_status');
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort', 'created_at');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction', 'asc');

        if ($filter_related_clients_type == 'A') { // SHOW ALL USERS
            $db_filter_related_clients_type= '';
        }
        if ( empty($page) ) $page= 1;


        $PageParametersWithSort = $this->usersRelatedClientsPreparePageParameters($UriArray, $post_array, false, true);     // keep all sorting parameters for using in sorting
        $PageParametersWithoutSort = $this->usersRelatedClientsPreparePageParameters($UriArray, $post_array, false, false); // by column header or at editor submitting to keep current filters

        $this->load->library('pagination');
        $pagination_config= $this->common_lib->getPaginationParams('ajax');
        $pagination_config['base_url'] = base_url() . 'sys-admin/clients_edit_load_related_users' . '/page';
        $filters= array( 'user_id'=>$filter_user_id, 'uc_active_status'=> $db_filter_related_clients_type, 'show_uc_active_status'=> 1, 'username'=> $filter_related_clients_filter, 'client_status'=> $client_status );
        $clients_count = $this->clients_mdl->getClientsList( true, 0, $filters );
        $filters['show_user_group']= 1;

        $pagination_config['total_rows'] = $clients_count;
        $this->pagination->suffix = $this->usersRelatedClientsPreparePageParameters($UriArray, $post_array, false, true);

        $this->pagination->initialize($pagination_config);
        $this->pagination->cur_page= $page;
        $pagination_links = $this->pagination->create_links();
        $related_clients_list= [];
        if ( $clients_count > 0 ) {
            $related_clients_list = $this->clients_mdl->getClientsList( false, $page, $filters, $sort, $sort_direction );
        }

        $data = array('related_clients_list' => $related_clients_list, 'user_id' => $filter_user_id, 'clients_count'=> $clients_count, 'related_users_type'=> $filter_related_clients_type, 'related_users_filter'=> $filter_related_clients_filter, 'sort_direction'=> $sort_direction, 'sort'=> $sort, 		'PageParametersWithSort'=> $PageParametersWithSort, 'PageParametersWithoutSort'=> $PageParametersWithoutSort,
            'pagination_links'=> 		$pagination_links   );
        $data['page']		= 'users/load_related_clients'; //page view to load
        $data['page_number']		= $page;
        $data['plugins'] 	= array();
        $data['javascript'] = array();
        $views				= array(  'design/page'  );

//        echo "<pre>";
//        print_r($data);
//        die;
        ob_start();
        $this->layout->view($views, $data);
        $html = ob_get_contents();
        ob_end_clean();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'user_id' => $filter_user_id, 'clients_count'=> $clients_count, 'html' => $html )));

    }


    public function load_user_related_clients_new()
    {
        $UriArray = $this->uri->uri_to_assoc(4);
        $post_array = $this->input->post();
        $filter_user_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_user_id');

        $filters= array( 'user_id'=>$filter_user_id, 'uc_active_status'=> $db_filter_related_clients_type, 'show_uc_active_status'=> 1, 'username'=> $filter_related_clients_filter, 'client_status'=> $client_status );
        $clients_count = $this->clients_mdl->getClientsList( true, 0, $filters );

        $related_clients_list= [];
        if ( $clients_count > 0 ) {
            $related_clients_list = $this->clients_mdl->getClientsList( false, 0, $filters );
        }
        echo "<pre>";
        print_r($filters);
        die;
        $data = array('related_clients_list' => $related_clients_list, 'user_id' => $filter_user_id, 'clients_count'=> $clients_count, 'related_clients_type'=> $filter_related_clients_type, 'related_users_filter'=> $filter_related_clients_filter);
        $data['page']		= 'users/load_related_clients'; //page view to load
        $data['page_number']		= $page;
        $data['plugins'] 	= array();
        $data['javascript'] = array();
        $views				= array(  'design/page'  );

//        echo "<pre>";
//        print_r($data);
//        die;
        ob_start();
        $this->layout->view($views, $data);
        $html = ob_get_contents();
        ob_end_clean();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'user_id' => $filter_user_id, 'clients_count'=> $clients_count, 'html' => $html )));

    }
	////////////// USERS BLOCK END /////////////



    private function usersRelatedClientsPreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort)
    {
        $ResStr = '';
        if (!empty($_post_array)) { // form was submitted
            if ($WithPage) {
                $page = $this->input->post('page');
                $ResStr .= !empty($page) ? 'page/' . $page . '/' : 'page/1/';
            }
            $filter_client_id = $this->input->post('filter_user_id');
            $ResStr .= !empty($filter_client_id) ? 'filter_user_id/' . $filter_client_id . '/' : '';
            $filter_related_users_filter = $this->input->post('filter_related_clients_filter');
            $ResStr .= !empty($filter_related_users_filter) ? 'filter_related_clients_filter/' . $filter_related_users_filter . '/' : '';
            $filter_provides_vendors_type = $this->input->post('filter_provides_vendors_type');
            $ResStr .= !empty($filter_provides_vendors_type) ? 'filter_provides_vendors_type/' . $filter_provides_vendors_type . '/' : '';
            if ($WithSort) {
                $sort_direction = $this->input->post('sort_direction');
                $ResStr .= !empty($sort_direction) ? 'sort_direction/' . $sort_direction . '/' : '';
                $sort = $this->input->post('sort');
                $ResStr .= !empty($sort) ? 'sort/' . $sort . '/' : '';
            }
        } else {
            if ($WithPage) {
                $ResStr .= !empty($UriArray['page']) ? 'page/' . $UriArray['page'] . '/' : 'page/1/';
            }
            $ResStr .= !empty($UriArray['filter_user_id']) ? 'filter_user_id/' . $UriArray['filter_user_id'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_related_clients_filter']) ? 'filter_related_clients_filter/' . $UriArray['filter_related_clients_filter'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_provides_vendors_type']) ? 'filter_provides_vendors_type/' . $UriArray['filter_provides_vendors_type'] . '/' : '';
            if ($WithSort) {
                $ResStr .= !empty($UriArray['sort_direction']) ? 'sort_direction/' . $UriArray['sort_direction'] . '/' : '';
                $ResStr .= !empty($UriArray['sort']) ? 'sort/' . $UriArray['sort'] . '/' : '';
            }
        }
        if (substr($ResStr, strlen($ResStr) - 1, 1) == '/') {
            $ResStr = substr($ResStr, 0, strlen($ResStr) - 1);
        }
        return '/' . $ResStr;
    }
}