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
		$this->load->model('activity_logs_mdl');
		$this->lang->load('sys_admin');
		$this->config->load('sys_admin_menu', true);
		$this->menu = $this->config->item('sys_admin_menu');

		$this->user = $this->common_mdl->get_admin_user();
		if ( $this->user->user_active_status != 'A' ) {  // Only active user can access admin pages
			redirect( base_url() . "login/logout" );
		}
		$this->group = $this->ion_auth->get_users_groups()->row();
		$this->job = $this->common_mdl->get_users_jobs()->row();
	}


	////////////// USERS BLOCK START /////////////
	/**********************
	 * view users
	 * access public
	 * @params
	 * return view
	 *********************************/
	public function users_view(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;
		$UriArray = $this->uri->uri_to_assoc(4);
		$post_array = $this->input->post();

		/* get and keep all filters/page_number for pagination and sorting parameters*/
		$sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
		$sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
		$page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
		$filter_username = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_username');
		$filter_user_active_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_user_active_status');
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

		$rows_in_table= $this->users_mdl->getUsersList(true, '', array( 'username'=> $filter_username, 'user_active_status'=> $filter_user_active_status, 'zip'=> $filter_zip, 'user_group_id'=> $filter_user_group_id, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );  // get number of rows by given parameters
		$pagination_config['total_rows'] = $rows_in_table;
		$this->pagination->initialize($pagination_config);  // pagination system initialization by parameters in config file
		$data['users']= array();
		if ($rows_in_table > 0) { // number of rows by given parameters > 0 - get rows by given parameters for given $page_number.
			$data['users']= $this->users_mdl->getUsersList(false, $page_number, array( 'show_job_title'=>1, 'show_user_group'=>1, 'show_clients_name'=>1, 'username'=> $filter_username, 'user_active_status'=> $filter_user_active_status, 'zip'=> $filter_zip, 'user_group_id'=> $filter_user_group_id, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );
		} // IMPORTANT : all filter parameters must be similar as in calling of getUsersList above

//		echo '<pre>$data[\'users\']::'.print_r($data['users'],true).'</pre>';
//		die("-1 XXZ");

//		$data['page_title']		= 'ZZZZZZZ';
		$data['page']		= 'users/users-view';
		$data['page_number']		= $page_number;
		$data['RowsInTable']= $rows_in_table;
		$data['editor_message']= $this->session->flashdata('editor_message');
		$data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');
//		$data['user_TypesSelectionList']= $this->users_mdl->getUserTypesSelectionList();

		$data['user_GroupsSelectionList']= $this->users_mdl->getGroupsSelectionList();
//		echo '<pre>$data[\'user_GroupsSelectionList\']::'.print_r($data['user_GroupsSelectionList'],true).'</pre>';
		$data['userActiveStatusValueArray']= $this->users_mdl->getUserActiveStatusValueArray();
//		echo '<pre>$data[\'userActiveStatusValueArray\']::'.print_r($data['userActiveStatusValueArray'],true).'</pre>';
//		die("-1 XXZ");
		$data['filter_username']= $filter_username;
		$data['filter_zip']= $filter_zip;
		$data['filter_user_active_status']= $filter_user_active_status;
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
		$filters_label_array= array('username'=> $filter_username, 'user_active_status'=> $this->common_lib->get_user_active_status_label($filter_user_active_status), 'zip'=> $filter_zip, 'filter_user_group_id'=> $filter_user_group_id, 'created at from'=> $filter_created_at_from, 'created at till'=>$filter_created_at_till);

		$filters_label= $this->common_lib->get_filters_label( $filters_label_array, '<br>' );
		$data['filters_label'] = $filters_label;
		$data['plugins'] 	= array();
		$data['pagination_links'] 	= $pagination_links;
		$data['javascript'] = array( 'assets/custom/admin/users.js', 'assets/global/plugins/picker/picker.js', 'assets/global/plugins/picker/picker.date.js', 'assets/global/plugins/picker/picker.time.js'); // add picker.date pluging for date selection in fileters form
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}



	/**********************
	 * Edit users
	 * access public
	 * @params usr_segment->3 (users id)
	 * return view
	 *********************************/
	public function users_edit()
	{
		$UriArray = $this->uri->uri_to_assoc(3);
		$is_insert= true;
		$app_config = $this->config->config;
		$user_id= '';
		if ( !empty($UriArray['users-edit']) and $this->common_lib->is_positive_integer($UriArray['users-edit'])  ) {
			$is_insert= false;
			$user_id= $UriArray['users-edit'];
		}
		$post_array = $this->input->post();
		$sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
		$sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
		$page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
		$filter_username = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_username');
		$filter_user_active_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_user_active_status');
		$filter_zip = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_zip');
		$filter_user_group_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_user_group_id');
		$filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
		$filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
		$filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
		$filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016
		$data['filter_username']= $filter_username;
		$data['filter_user_active_status']= $filter_user_active_status;
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
		$data['userActiveStatusValueArray']= $this->users_mdl->getUserActiveStatusValueArray();
//		echo '<pre>$is_insert::'.print_r($is_insert,true).'</pre>';
//		echo '<pre>$data[\'userActiveStatusValueArray\']::'.print_r($data['userActiveStatusValueArray'],true).'</pre>';
		if ( $is_insert ) { // in insert mode user can be new or waiting for confirmation
			foreach ( $data['userActiveStatusValueArray'] as $next_key=>$next_userActiveStatus ) {
				if ( !in_array($next_userActiveStatus['key'],array('N', 'W')) ) {
					unset($data['userActiveStatusValueArray'][$next_key]);
				}
			}  // Array('N' => 'New', 'W' => 'Waiting for activation', 'A' => 'Active', 'I' => 'Inactive');
		}
//		echo '<pre>$data[\'userActiveStatusValueArray\']::'.print_r($data['userActiveStatusValueArray'],true).'</pre>';
//		die("-1 XXZ");
		$jobsSelectionList= $this->users_mdl->getJobsSelectionList();

		$usersJobs = $this->users_mdl->getUsers_JobsList( false, 0, array('user_id'=> $user_id) );
		if ( !$is_insert ) {
			foreach ($jobsSelectionList as $next_key => $next_user_job_selection) {
				foreach ($usersJobs as $next_users_ob) {
					if ($next_user_job_selection['key'] == $next_users_ob->job_id) {
						$jobsSelectionList[$next_key]['checked'] = true;
					}
				}
			}
		}
//		echo '<pre>$usersJobs::'.print_r($usersJobs,true).'</pre>';
//		echo '<pre>$jobsSelectionList::'.print_r($jobsSelectionList,true).'</pre>';
//		die("-1 XXZ");
		$data['jobsSelectionList']  = $jobsSelectionList;

		$data['is_insert']  = $is_insert;
		$data['user_id']      = $user_id;
		$data['menu']		= $this->menu;
//		echo '<pre>$this->user::'.print_r($this->user,true).'</pre>';
//		die("-1 XXZ");
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;
		$editable_user= '';
		$data['validation_errors_text'] = '';
		$this->user_edit_form_validation($is_insert, $user_id);
		if (!empty($_POST)) {
			$validation_status = $this->form_validation->run();
			if ($validation_status != FALSE) {
				$this->user_edit_makesave ($is_insert, $user_id, $data['select_on_update'], $redirect_url, $page_parameters_with_sort, $post_array, $app_config );
			} else {
				$editable_user = $this->user_edit_fill_current_data( $editable_user, $is_insert, $user_id );
				foreach ($jobsSelectionList as $next_key => $next_jobs_selection) {
					$is_found= false;
					foreach ($_POST as $next_post_key=> $next_post_value) {
						$a= preg_split('/cbx_user_has_jobs_/',$next_post_key );
						if (count($a)==2) {
							if ($next_jobs_selection['key'] == $a[1]) {
								$jobsSelectionList[$next_key]['checked'] = true;
								$is_found= true;
							}
						}
					}
					if ( !$is_found ) {
						$jobsSelectionList[$next_key]['checked'] = false;
					}

				}
//				echo '<pre>$jobsSelectionList::'.print_r($jobsSelectionList,true).'</pre>';
				$data['jobsSelectionList']  = $jobsSelectionList;

//				echo '<pre>$editable_user::'.print_r($editable_user,true).'</pre>';
//				die("-++==1 XXZ");
				$data['validation_errors_text'] = validation_errors( /*$layout_config['backend_error_icon_start'], $layout_config['backend_error_icon_end']*/ );
			}
		}
		else {
			$editable_user= $this->users_mdl->getUserRowById( $user_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );

			if ( !empty($editable_user) and in_array($editable_user->user_active_status, array('A','I') ) ) {
				foreach ( $data['userActiveStatusValueArray'] as $next_key=>$next_userActiveStatus ) {
					if ( !in_array($next_userActiveStatus['key'],array('A', 'I')) ) {
						unset($data['userActiveStatusValueArray'][$next_key]);
					}
				}
			}   // Array('N' => 'New', 'W' => 'Waiting for activation', 'A' => 'Active', 'I' => 'Inactive');

			if ( !empty($editable_user) and in_array($editable_user->user_active_status, array('N','W') ) ) {
				foreach ( $data['userActiveStatusValueArray'] as $next_key=>$next_userActiveStatus ) {
					if ( !in_array($next_userActiveStatus['key'],array('N', 'W')) ) {
						unset($data['userActiveStatusValueArray'][$next_key]);
					}
				}
			}   // Array('N' => 'New', 'W' => 'Waiting for activation', 'A' => 'Active', 'I' => 'Inactive');
			$users_groups_list= $this->users_mdl->getUsersGroupsList( false, 0, array('user_id'=> $user_id));
//			echo '<pre>$users_groups_list::'.print_r($users_groups_list,true).'</pre>';
			if ( !empty($editable_user) and !empty($users_groups_list[0]->group_id) ) {
				$editable_user->user_group_id = $users_groups_list[0]->group_id;
			}
		}

		$data['editable_user']		= $editable_user;
		$data['page_parameters_with_sort']= $page_parameters_with_sort;
		$data['page_parameters_without_sort']= $page_parameters_without_sort;
		$data['page']		= 'users/user-edit'; //page view to load
		$data['plugins'] 	= array('validation'); //page plugins
		$data['javascript'] = array( 'assets/custom/admin/user-edit.js' );//page javascript
		$views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
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
		$editable_user->user_active_status = set_value('data[user_active_status]');
		$editable_user->user_group_id = set_value('data[user_group_id]');
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
		$this->form_validation->set_rules( 'data[username]', lang('user'), 'callback_user_check_username_is_unique' );
		$this->form_validation->set_rules( 'data[email]', lang('email'), 'trim|required|valid_email|callback_user_check_email_is_unique' );

		if ( $is_insert ) {
			$this->form_validation->set_rules( 'data[password]', lang( 'password' ), 'trim|required|min_length[5]' );
			$this->form_validation->set_rules( 'data[password_confirm]', lang( 'password_confirm' ), 'trim|required|min_length[5]|matches[data[password]]' );
		}

		$this->form_validation->set_rules( 'data[user_active_status]', lang('user_active_status'), 'required' );
		$this->form_validation->set_rules( 'data[first_name]', lang('first_name'), 'required' );
		$this->form_validation->set_rules( 'data[last_name]', lang('last_name'), 'required' );
		$this->form_validation->set_rules( 'data[city]', lang('city'), 'required' );
		$this->form_validation->set_rules( 'data[state]', lang('state'), 'required' );
		$this->form_validation->set_rules( 'data[zip]', lang('zip'), 'required' );
		$this->form_validation->set_rules( 'data[address1]', lang('address1'), 'required' );
		$this->form_validation->set_rules( 'data[address2]', lang('address2'), '' );
		$this->form_validation->set_rules( 'data[mobile]', lang('mobile'), 'required' );
		$this->form_validation->set_rules( 'data[phone]', lang('phone'), 'required' );
		$this->form_validation->set_rules( 'user_has_jobs_label', lang('user_has_jobs_label'), 'callback_user_has_jobs_label');
	}

	public function user_has_jobs_label($str)
	{
		foreach( $_POST as $next_key=>$next_value ) {
			$a= preg_split('/cbx_user_has_jobs_/',$next_key );
			if (count($a)==2) {
				return TRUE;
			}
		}
		$this->form_validation->set_message('user_has_jobs_label', 'Check at least 1 '.lang('user_has_jobs').'!');
		return false;
	}

	private function user_edit_makesave($is_insert, $user_id, $select_on_update, $redirect_url, $page_parameters_with_sort, $post_array, $app_config ) {
		$this->db->trans_start( );
		$ip_address= !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

		$original_user_avatar= !empty($post_array['data']['avatar']) ? $post_array['data']['avatar'] : '';
//		echo '<pre>$post_array::'.print_r($post_array,true).'</pre>';
		$activation_code= '';
		$password= '';
		if ( $is_insert ) {
			$user_group_array= array( $post_array['data']['user_group_id'] );
			$additional_data= array(  'ip_address'=> $ip_address, 'user_active_status' => $post_array['data']['user_active_status'], 'first_name' => $post_array['data']['first_name'], 'last_name' => $post_array['data']['last_name'], 'city' => $post_array['data']['city'], 'state' => $post_array['data']['state'], 'zip' => $post_array['data']['zip'],  'address1' => $post_array['data']['address1'], 'address2' => $post_array['data']['address2'], 'mobile' => $post_array['data']['mobile'], 'phone' => $post_array['data']['phone'], 'created_on'=> now(), 'avatar' => $post_array['data']['avatar'] );

			if  (  !empty( $post_array['cbx_clear_image'])  )  {
				$additional_data['avatar']= '';
			}
			if ( !empty( $_FILES['data']['name']['avatar_file_upload'] ) ) {
				$additional_data['avatar']= $_FILES['data']['name']['avatar_file_upload'];
			}
			$activation_code= $this->common_lib->GenerateActivationCode();
			$additional_data['activation_code']= $activation_code;

//			echo '<pre>$additional_data::'.print_r($additional_data,true).'</pre>';
//			echo '<pre>$user_group_array::'.print_r($user_group_array,true).'</pre>';
			$user_id = $this->ion_auth->register( $post_array['data']['username'], $post_array['data']['password'], $post_array['data']['email'], $additional_data,   array(  $user_group_array  )  );
			$password= $post_array['data']['password'];
//			echo '<pre>INSERT $password::'.print_r($password,true).'</pre>';

		} else {
//			$this->db->where( $this->users_mdl->m_users_table . '.id', $user_id);
			$update_data= array( 'username' => $post_array['data']['username'], 'ip_address'=> $ip_address, 'email' => $post_array['data']['email'], 'user_active_status' => $post_array['data']['user_active_status'], 'first_name' => $post_array['data']['first_name'], 'last_name' => $post_array['data']['last_name'], 'city' => $post_array['data']['city'], 'state' => $post_array['data']['state'], 'zip' => $post_array['data']['zip'],  'address1' => $post_array['data']['address1'], 'address2' => $post_array['data']['address2'], 'mobile' => $post_array['data']['mobile'], 'phone' => $post_array['data']['phone'], 'avatar' => $post_array['data']['avatar'] );

			if  (  !empty( $post_array['cbx_clear_image'])  )  {
				$update_data['avatar']= '';
			}
			if ( !empty( $_FILES['data']['name']['avatar_file_upload'] ) ) {
				$update_data['avatar']= $_FILES['data']['name']['avatar_file_upload'];
			}

			if ( $post_array['data']['user_active_status'] == "W" ) { // sent message with activation code
				$activation_code= $this->common_lib->generateActivationCode();
				$update_data['activation_code']= $activation_code;
			} // if ( $post_array['data']['user_active_status'] == "W" ) { // sent message with activation code
//			echo '<pre>++$update_data::'.print_r($update_data,true).'</pre>';
			$this->db->update($this->users_mdl->m_users_table, $update_data, array('id' => $user_id));
			// 			$this->db->update($this->tables['users'], $data, array('id' => $id));

		}

		if ( $post_array['data']['user_active_status'] == "W" ) { // sent message with activation code
			$activation_page_url= $app_config['base_url']."/activation/".$activation_code;
			$title= 'You are registered at ' . $app_config['base_url'] . ' site';
//			echo '<pre>???? $password::'.print_r($password,true).'</pre>';
			$content= '  Dear '.$post_array['data']['username']. ', you are registered at <a href="'.$app_config['base_url'].'">' . $app_config['base_url'] . ' </a> site, with email '. $post_array['data']['email'] .
			( !empty($password)? ( ' and password '.$password ) : ' and password sent to you before' )	.
			'.  You need to activate your account at <a href="' . $activation_page_url .'">Activation page '.$activation_page_url.' </a>';
			$EmailOutput = $this->common_lib->SendEmail($post_array['data']['email'], $title, $content );
			$this->common_lib->DebToFile( 'sendEmail $content::'.print_r($content,true));
//			echo '<pre>$EmailOutput::'.print_r($EmailOutput,true).'</pre>';

		} // if ( $post_array['data']['user_active_status'] == "W" ) { // sent message with activation code

		$this->users_mdl->updateUsersGroups($user_id,array($post_array['data']['user_group_id']));

		$user_jobs_array= array();
		foreach( $_POST as $next_key=>$next_value ) {
			$a= preg_split('/cbx_user_has_jobs_/',$next_key );
			if (count($a)==2) {
				$user_jobs_array[]= $a[1];
			}
		}
		$this->users_mdl->updateUsersJobs( $user_id, $user_jobs_array );

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
			$this->session->set_flashdata('editor_message', lang('user') . " '" . $post_array['data']['username'] . "' was " . ($is_insert ? "inserted" : "updated") );
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
			} else {
				$this->db->trans_commit();
			}
//			die("-++++1 XXZ");
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

		$ret = $this->users_mdl->deleteUsers_JobsByUserId($id);

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
			$filter_user_active_status = $this->input->post('filter_user_active_status');
			$ResStr .= !empty($filter_user_active_status) ? 'filter_user_active_status/' . $filter_user_active_status . '/' : '';
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
			$ResStr .= !empty($UriArray['filter_user_active_status']) ? 'filter_user_active_status/' . $UriArray['filter_user_active_status'] . '/' : '';
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


	////////////// USERS BLOCK END /////////////

}