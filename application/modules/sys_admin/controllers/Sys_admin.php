<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys_admin extends CI_Controller {

	 public function __construct() {
        parent::__construct();
		$group = array('sys-admin');
		if (!$this->ion_auth->in_group($group)){
			redirect( base_url() . "login/logout" );
		}
		$this->load->library('Sys_admin_lib',NULL,'admin_lib');
		$this->load->model('sys_admin_mdl','admin_mdl');
		$this->load->model('clients_mdl','clients_mdl');
		$this->lang->load('sys_admin');
		$this->config->load('sys_admin_menu', true );
        $this->menu    			= $this->config->item( 'sys_admin_menu' );

		$this->user 			= $this->common_mdl->get_admin_user();
		if ( $this->user->user_active_status != 'A' ) {    // Only active user can access admin pages
			redirect( base_url() . "login/logout" );
		}
		$this->group 			= $this->ion_auth->get_users_groups()->row();
//		$this->job 				= $this->common_mdl->get_users_jobs()->row();
	 }

 /**********************
 * View Dashboard Home
 * access public
 * @params
 * return view
 *********************************/
	public function index(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;

		$data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['page']		='dashboard'; //page view to load
		$data['pls'] 		= array(); //page level scripts optional
		$data['plugins'] 	= array(); //page plugins
		$data['javascript'] = array(); //page javascript
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view clients
* access public
* @params
* return view
*********************************/
	public function clients_view(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();

        /* get and keep all filters/page for pagination and sorting parameters*/
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
        $page = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page', 1);
        $filter_client_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_name');
        $filter_client_active_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_active_status');
        $filter_client_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_type');
        $filter_client_zip = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_zip');
        $filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
        $filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
        $filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
        $filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016

		$page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);     // keep all sorting parameters for using in sorting
		$page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false); // by column header or at editor submitting to keep current filters

        $this->load->library('pagination');
        $pagination_config= $this->common_lib->getPaginationParams();
        $pagination_config['base_url'] = base_url() . 'sys-admin/clients-view' . '/page';

        $RowsInTable= $this->clients_mdl->getClientsList(true, '', array( 'show_client_type_description'=>'', 'client_name'=> $filter_client_name, 'client_active_status'=> $filter_client_active_status, 'client_type'=> $filter_client_type, 'client_zip'=> $filter_client_zip, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );  // get number of rows by given parameters
        $pagination_config['total_rows'] = $RowsInTable;
        $this->pagination->initialize($pagination_config);  // pagination system initialization by parameters in config file
        $data['clients']= array();
        if ($RowsInTable > 0) { // number of rows by given parameters > 0 - get rows by given parameters for given $page.
            $data['clients']= $this->clients_mdl->getClientsList(false, $page, array( 'show_client_type_description'=>1, 'client_name'=> $filter_client_name, 'client_active_status'=> $filter_client_active_status, 'client_type'=> $filter_client_type, 'client_zip'=> $filter_client_zip, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );
        } // IMPORTANT : all filter parameters must be similar as in calling of getClientsList above

        $data['client_TypesSelectionList']= $this->clients_mdl->getClient_TypesSelectionList();
        $data['client_ActiveStatusList']= $this->clients_mdl->getClientActiveStatusValueArray();
        $data['page']		= 'clients/clients-view';
        $data['page_number']		= $page;
        $data['RowsInTable']= $RowsInTable;
		$data['editor_message']= $this->session->flashdata('editor_message');

        $data['filter_client_name']= $filter_client_name;
        $data['filter_client_active_status']= $filter_client_active_status;
        $data['filter_client_type']= $filter_client_type;
        $data['filter_client_zip']= $filter_client_zip;
        $data['filter_created_at_from']= $filter_created_at_from;
        $data['filter_created_at_till']= $filter_created_at_till;
        $data['filter_created_at_from_formatted']= $filter_created_at_from_formatted;
        $data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;
        $data['sort_direction']= $sort_direction;
        $data['sort']= $sort;
		$data['page_parameters_with_sort']= $page_parameters_with_sort;
		$data['page_parameters_without_sort']= $page_parameters_without_sort;

        $this->pagination->suffix = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $this->pagination->cur_page= $page;
        $pagination_links = $this->pagination->create_links();
        $clients_count_in_db= $this->admin_mdl->clients_count_in_db();

        // create label for current parameter so moving mouse over "Filter" button user can see current filters
        $filters_label_array= array('name'=> $filter_client_name, 'is active'=> $this->common_lib->get_client_active_status_label($filter_client_active_status), 'client type'=>
            $this->common_lib->get_client_type_label($filter_client_type), 'zip'=> $filter_client_zip, 'created at from'=> $filter_created_at_from, 'created at till'=>$filter_created_at_till);

        $filters_label= $this->common_lib->get_filters_label( $filters_label_array, '<br>' );
        $data['clients_count_in_db']= !empty($clients_count_in_db[0]->clients_count) ? $clients_count_in_db[0]->clients_count : 0;
		$data['filters_label'] = $filters_label;
		$data['plugins'] 	= array();
		$data['pagination_links'] 	= $pagination_links;
		$data['javascript'] = array( 'assets/custom/admin/clients-view.js', 'assets/global/plugins/picker/picker.js', 'assets/global/plugins/picker/picker.date.js', 'assets/global/plugins/picker/picker.time.js');

		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}




	/**********************
	 * Edit clients
	 * access public
	 * @params usr_segment->3 (clients id)
	 * return view
	 *********************************/
	public function clients_edit()
	{
		$UriArray = $this->uri->uri_to_assoc(2);
		$is_insert= true;
		$app_config = $this->config->config;
		$cid= '';
		if ( !empty($UriArray['clients-edit']) and $this->common_lib->is_positive_integer($UriArray['clients-edit'])  ) {
			$is_insert= false;
			$cid= $UriArray['clients-edit'];
		}
		$post_array = $this->input->post();
		$sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
		$sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
		$page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
		$filter_client_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_name');
		$filter_client_active_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_active_status');
		$filter_client_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_type');
		$filter_client_zip = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_zip');
		$filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
		$filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
		$filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
		$filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016
		$data['filter_client_name']= $filter_client_name;
		$data['filter_client_active_status']= $filter_client_active_status;
		$data['filter_client_type']= $filter_client_type;
		$data['filter_client_zip']= $filter_client_zip;
		$data['filter_created_at_from']= $filter_created_at_from;
		$data['filter_created_at_till']= $filter_created_at_till;
		$data['filter_created_at_from_formatted']= $filter_created_at_from_formatted;
		$data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;
		$data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;

		$page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
		$page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
		$redirect_url = base_url() . 'sys-admin/clients-view' . $page_parameters_with_sort;

		$data['meta_description']='';
		$data['editor_message']= $this->session->flashdata('editor_message');
		$data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

		$data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        $data['client_active_status_array']= $this->clients_mdl->getClientActiveStatusValueArray(false);
        $data['user_active_status_array']= $this->clients_mdl->getUserActiveStatusValueArray(true);
        $data['client_phone_type_array']= $this->clients_mdl->getClientPhoneTypeArray();
		$data['client_color_schemes'] = $this->config->item('client_color_schemes');


		$data['is_insert']  = $is_insert;
		$data['cid']      = $cid;
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;
		$client= '';
		$data['validation_errors_text'] = '';
		$this->client_edit_form_validation($is_insert, $cid);
		if (!empty($_POST)) {
			$validation_status = $this->form_validation->run();
			if ($validation_status != FALSE) {
				$this->client_edit_makesave($is_insert, $cid, $data['select_on_update'], $redirect_url, $page_parameters_with_sort, $post_array, $app_config, $data['client_color_schemes'] );
			} else {
				$client = $this->client_edit_fill_current_data( $client, $is_insert, $cid );
				$data['validation_errors_text'] = validation_errors( /*$layout_config['backend_error_icon_start'], $layout_config['backend_error_icon_end']*/ );
			}
		}
		else {
			$client		= $this->clients_mdl->getRowById( $this->uri->segment(3), array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );

		}

		$data['client']		= $client;
		$data['page_parameters_with_sort']= $page_parameters_with_sort;
		$data['page_parameters_without_sort']= $page_parameters_without_sort;
		$data['page']		= 'clients/client-edit'; //page view to load
		$data['plugins'] 	= array('validation'); //page plugins
		$data['javascript'] = array( 'assets/custom/admin/client-edit.js' );//page javascript
		$views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

	private function client_edit_makesave($is_insert, $cid, $select_on_update, $redirect_url, $page_parameters_with_sort, $post_array, $app_config, $client_color_schemes_array ) {
		$this->db->trans_start();
		if ( !$is_insert ) {
			$color_scheme = $post_array['data']['color_scheme'];
		} else {
			foreach ( $client_color_schemes_array as $next_key => $next_color_scheme ) {
				if ( !empty($next_color_scheme['default']) and $next_color_scheme['default'] ) {
					$color_scheme = $next_color_scheme['id'];
					break;
				}
			}
		}

//		$client_phone= !empty($post_array['data']['client_phone']) ? $post_array['data']['client_phone'] : '';
//		$client_phone_2= !empty($post_array['data']['client_phone_2']) ? $post_array['data']['client_phone_2'] : '';
//		$client_phone_3= !empty($post_array['data']['client_phone_3']) ? $post_array['data']['client_phone_3'] : '';
//		$client_phone_4= !empty($post_array['data']['client_phone_4']) ? $post_array['data']['client_phone_4'] : '';
//		if ( empty($client_phone) ) {
//
//		}

		$update_data= array( 'client_name' => $post_array['data']['client_name'],  'client_img' => $post_array['data']['client_img'],  'clients_types_id' => $post_array['data']['clients_types_id'], 'client_owner' => $post_array['data']['client_owner'] , 'client_address1' => $post_array['data']['client_address1'] , 'client_address2' => $post_array['data']['client_address2'] , 'client_city' => $post_array['data']['client_city'] , 'client_state' => $post_array['data']['client_state'] , 'client_zip' => $post_array['data']['client_zip'], 'client_phone' => $post_array['data']['client_phone'],  'client_phone_2' => $post_array['data']['client_phone_2'],  'client_phone_3' => $post_array['data']['client_phone_3'],  'client_phone_4' => $post_array['data']['client_phone_4'],  'client_phone_type' => $post_array['data']['client_phone_type'],   'client_fax' => $post_array['data']['client_fax'] , 'client_email' => $post_array['data']['client_email'] , 'client_website' => $post_array['data']['client_website']  , 'color_scheme' => $color_scheme, 'client_active_status' => $post_array['data']['client_active_status'] );

		$original_client_img= !empty($post_array['data']['client_img']) ? $post_array['data']['client_img'] : '';

		if  (  !empty( $post_array['cbx_clear_image'])  )  {
			$update_data['client_img']= '';
		}

		if ( !empty( $_FILES['data']['name']['client_img_file_upload'] ) ) {
			$update_data['client_img']= $_FILES['data']['name']['client_img_file_upload'];
		}


		if ( $is_insert ) {
			$this->db->insert($this->clients_mdl->m_clients_table, $update_data);
			$cid= $this->db->insert_id();
		} else {
			$this->db->where( $this->clients_mdl->m_clients_table . '.cid', $cid);
			$this->db->update($this->clients_mdl->m_clients_table, $update_data);
		}

		$client_img_path= $this->clients_mdl->getClientImagePath($cid, $post_array['data']['client_img']);
		$client_dir= $this->clients_mdl->getClientDir($cid);
		if (  !empty( $post_array['cbx_clear_image']) or !empty($_FILES['data']['name']['client_img_file_upload'])  )   {
			$original_img_path= $this->clients_mdl->getClientImagePath($cid, $original_client_img);
			if ( !empty($original_img_path) and file_exists($original_img_path) and !is_dir($original_img_path)) {
				unlink($original_img_path);
			}
		}


		$clientImagesDirs = array( FCPATH . 'uploads', $this->clients_mdl->getClientsDir(), $this->clients_mdl->getClientDir($cid) );
		$src_filename = $_FILES['data']['tmp_name']['client_img_file_upload'];
		$img_basename = $_FILES['data']['name']['client_img_file_upload'];

		$this->common_lib->createDir($clientImagesDirs);
		$ret = move_uploaded_file( $src_filename, $this->clients_mdl->getClientDir($cid) . $img_basename );

		if ($select_on_update == 'reopen_editor') {
			$redirect_url = base_url() . 'sys-admin/clients-edit/' . $cid . $page_parameters_with_sort;
		}
		if ($select_on_update == 'open_editor_for_new') {
			$redirect_url = base_url() . 'sys-admin/clients-edit/new' . $page_parameters_with_sort;
		}

		if ($cid) {
			$this->session->set_flashdata('editor_message', lang('client') . " '" . $post_array['data']['client_name'] . "' was " . ($is_insert ? "inserted" : "updated") );
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
			} else {
				$this->db->trans_commit();
			}
//		die("-1 XXZ");
			redirect($redirect_url);
			return;
		}

	}


	public function client_check_client_email_is_unique()
	{
		$client_email = $this->input->post('data[client_email]', '');
		if (empty($client_email)) {
			return;
		}
		$cid = $this->input->post('data[cid]', 0);
		if ( $cid == 'new' ) $cid= 0;
		$similarClient= $this->clients_mdl->getSimilarClientByClient_Email( $client_email, $cid );
		if (!empty($similarClient)) {
			$this->form_validation->set_message('client_check_client_email_is_unique', lang('email') . " '".$client_email."' must be unique ! ");
			return FALSE;
		}
		return TRUE;
	}

	private function client_edit_fill_current_data($client, $is_insert, $cid)
	{
		$client = new stdClass;
		$client->cid = $cid;
		$client->client_name = set_value('data[client_name]');
		$client->clients_types_id = set_value('data[clients_types_id]');
		$client->client_address1 = set_value('data[client_address1]');
		$client->client_address2 = set_value('data[client_address2]');
		$client->client_owner = set_value('data[client_owner]');
		$client->client_email = set_value('data[client_email]');
		$client->client_website = set_value('data[client_website]');
		$client->client_city = set_value('data[client_city]');
		$client->client_state = set_value('data[client_state]');
		$client->client_zip = set_value('data[client_zip]');
		$client->client_phone = set_value('data[client_phone]');
		$client->client_phone_2 = set_value('data[client_phone_2]');
		$client->client_phone_3 = set_value('data[client_phone_3]');
		$client->client_phone_4 = set_value('data[client_phone_4]');
		$client->client_phone_type = set_value('data[client_phone_type]');
		$client->client_fax = set_value('data[client_fax]');
		$client->client_active_status = set_value('data[client_active_status]');
		$client->color_scheme = set_value('data[color_scheme]');
		return $client;
	}


	private function client_edit_form_validation($is_insert, $cid)
	{
		$this->form_validation->set_rules( 'data[client_name]', lang('client_name'), 'required' );
		$this->form_validation->set_rules( 'data[clients_types_id]', lang('clients-type'), 'required' );
		$this->form_validation->set_rules( 'data[client_address1]', lang('client_address1'), 'required' );
		$this->form_validation->set_rules( 'data[client_address2]', lang('client_address2'), '' );
		$this->form_validation->set_rules( 'data[client_owner]', lang('client_owner'), '' );
		$this->form_validation->set_rules( 'data[client_email]', lang('client_email'), 'valid_email|callback_client_check_client_email_is_unique' );
		$this->form_validation->set_rules( 'data[client_website]', lang('client_website'), '' );
		$this->form_validation->set_rules( 'data[client_city]', lang('client_city'), 'required' );
		$this->form_validation->set_rules( 'data[client_state]', lang('client_state'), 'required' );
		$this->form_validation->set_rules( 'data[client_zip]', lang('client_zip'), 'required' );
		$this->form_validation->set_rules( 'data[client_phone]', lang('phone'), 'required' );
		$this->form_validation->set_rules( 'data[client_phone_2]', lang('phone_2'), '' );
		$this->form_validation->set_rules( 'data[client_phone_3]', lang('phone_3'), '' );
		$this->form_validation->set_rules( 'data[client_phone_4]', lang('phone_4'), '' );
		$this->form_validation->set_rules( 'data[client_phone_type]', lang('phone_type'), '' );
		$this->form_validation->set_rules( 'data[client_fax]', lang('client_fax'), 'required' );
		$this->form_validation->set_rules( 'data[client_active_status]', lang('client_active_status'), 'required' );
		$this->form_validation->set_rules( 'data[color_scheme]', lang('color_scheme'), ( $is_insert ? '' : 'required' ) );
	}



    /**********************
     * for client load list of related_users, with filters, sorting
     * access public
     * @params : filter_client_id - client_id, filter_related_users_filter - filter string by username, filter_related_users_type - users type of relation,
     * user_active_status - filter by user active_status, sort/sort_direction - order and direction of resulting listing
     * return list related users
     *********************************/
    public function clients_edit_load_related_users()
    {
        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();
        $filter_client_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_id');
        $page = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page');
        $filter_related_users_filter = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_related_users_filter');
        $filter_related_users_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_related_users_type');
        $db_filter_related_users_type= $filter_related_users_type;
        $user_active_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'user_active_status');
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort', 'username');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction', 'desc');
        if ($filter_related_users_type == 'A') { // SHOW ALL USERS
            $db_filter_related_users_type= '';
        }
        if ( empty($page) ) $page= 1;


        $PageParametersWithSort = $this->clientsRelatedUsersPreparePageParameters($UriArray, $post_array, false, true);     // keep all sorting parameters for using in sorting
        $PageParametersWithoutSort = $this->clientsRelatedUsersPreparePageParameters($UriArray, $post_array, false, false); // by column header or at editor submitting to keep current filters

        $this->load->library('pagination');
        $pagination_config= $this->common_lib->getPaginationParams('ajax');
        $pagination_config['base_url'] = base_url() . 'sys-admin/clients_edit_load_related_users' . '/page';
        $filters= array('client_id'=>$filter_client_id, 'uc_active_status'=> $db_filter_related_users_type, 'show_uc_active_status'=> 1, 'username'=> $filter_related_users_filter, 'user_active_status'=> $user_active_status);
        $users_count = $this->admin_mdl->getUsersList( true, 0, $filters );

        $pagination_config['total_rows'] = $users_count;
        $this->pagination->suffix = $this->clientsRelatedUsersPreparePageParameters($UriArray, $post_array, false, true);

        $this->pagination->initialize($pagination_config);
        $this->pagination->cur_page= $page;
        $pagination_links = $this->pagination->create_links();
        $related_users_list= [];
        if ( $users_count > 0 ) {
            $related_users_list = $this->admin_mdl->getUsersList( false, $page, $filters, $sort, $sort_direction );
        }
        $data = array('related_users_list' => $related_users_list, 'client_id' => $filter_client_id, 'users_count'=> $users_count, 'related_users_type'=> $filter_related_users_type, 'related_users_filter'=> $filter_related_users_filter, 'sort_direction'=> $sort_direction, 'sort'=> $sort, 		'PageParametersWithSort'=> $PageParametersWithSort, 'PageParametersWithoutSort'=> $PageParametersWithoutSort,
 'pagination_links'=> 		$pagination_links   );
        $data['page']		= 'clients/load_related_users'; //page view to load
        $data['page_number']		= $page;
        $data['plugins'] 	= array();
        $data['javascript'] = array();
        $views				= array(  'design/page'  );
        ob_start();
        $this->layout->view($views, $data);
        $html = ob_get_contents();
        ob_end_clean();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'client_id' => $filter_client_id, 'users_count'=> $users_count, 'html' => $html )));

    }

    /**********************
     * for client update/insert related_user_status
     * access public
     * @params : client_id - id of client, related_user_id - id of user to change status, new_status - new status('E' => 'Employee', 'O' => 'Out Of Staff', 'N' => 'Not Related'),
     * return if operation was succcessful
     *********************************/
    function clients_set_related_user_status() {
        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();

        $client_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_id');
        $related_user_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'related_user_id');
        $new_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'new_status');

        if ( empty($client_id) or empty($related_user_id) or empty($new_status) ) {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => 'Invalid parameters !', 'ErrorCode' => 1, 'ret' => 0 )));
            return;
        }


        $ret = $this->admin_mdl->update_users_clients( $client_id, $related_user_id, $new_status );
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'ret' => $ret )));
    }



    /**********************
     * for client load list of provides_vendors, with filters, sorting
     * access public
     * @params : filter_client_id - client_id, filter_provides_vendors_filter - filter string by username, filter_provides_vendors_type - users type of relation,
     * user_active_status - filter by user active_status, sort/sort_direction - order and direction of resulting listing
     * return list Provides Vendors
     *********************************/
    public function clients_edit_load_provides_vendors()
    {
        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();
        $filter_client_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_id');
        $page = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page');
        $filter_provides_vendors_filter = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_provides_vendors_filter');
        $filter_provides_vendors_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_provides_vendors_type');
        $db_filter_provides_vendors_type= $filter_provides_vendors_type;
        $user_active_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'user_active_status');
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort', 'vn_name');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction', 'desc');
        if ($filter_provides_vendors_type == 'A') { // SHOW ALL USERS
            $db_filter_provides_vendors_type= '';
        }
        if ( empty($page) ) $page= 1;

        $PageParametersWithSort = $this->clientsProvidesVendorsPreparePageParameters($UriArray, $post_array, false, true);     // keep all sorting parameters for using in sorting
        $PageParametersWithoutSort = $this->clientsProvidesVendorsPreparePageParameters($UriArray, $post_array, false, false); // by column header or at editor submitting to keep current filters

        $this->load->library('pagination');
        $pagination_config= $this->common_lib->getPaginationParams('ajax');
        $pagination_config['base_url'] = base_url() . 'sys-admin/clients_edit_load_provides_vendors' . '/page';
        $filters= array('client_id'=>$filter_client_id, 'cv_active_status'=> $db_filter_provides_vendors_type, 'show_cv_active_status'=> 1, 'show_vendor_name'=> 1 , 'join_vendors_right'=> ($filter_provides_vendors_type!= 'P') );
        $client_vendors_count = $this->clients_mdl->getClients_VendorsList( true, 0, $filters );
        $pagination_config['total_rows'] = $client_vendors_count;
        $this->pagination->suffix = $this->clientsProvidesVendorsPreparePageParameters($UriArray, $post_array, false, true);
	    $this->pagination->initialize($pagination_config);
        $this->pagination->cur_page= $page;
        $this->pagination->cur_page= $page;
        $pagination_links = $this->pagination->create_links();
        $provides_vendors_list= [];
        if ( $client_vendors_count > 0 ) {
            $provides_vendors_list = $this->clients_mdl->getClients_VendorsList( false, $page, $filters, $sort, $sort_direction );
        }
        $data = array('provides_vendors_list' => $provides_vendors_list, 'client_id' => $filter_client_id, 'client_vendors_count'=> $client_vendors_count, 'provides_vendors_type'=> $filter_provides_vendors_type, 'provides_vendors_filter'=> $filter_provides_vendors_filter, 'sort_direction'=> $sort_direction, 'sort'=> $sort, 		'PageParametersWithSort'=> $PageParametersWithSort, 'PageParametersWithoutSort'=> $PageParametersWithoutSort,
            'pagination_links'=> 		$pagination_links   );
        $data['page']		= 'clients/load_provides_vendors'; //page view to load
        $data['page_number']		= $page;
        $data['plugins'] 	= array();
        $data['javascript'] = array();
        $views				= array(  'design/page'  );
        ob_start();
        $this->layout->view($views, $data);
        $html = ob_get_contents();
        ob_end_clean();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'client_id' => $filter_client_id, 'client_vendors_count'=> $client_vendors_count, 'html' => $html )));

    }

    /**********************
     * for client update/insert related_user_status
     * access public
     * @params : client_id - id of client, provides_vendor_id - id of user to change status, new_status - new status('E' => 'Employee', 'O' => 'Out Of Staff', 'N' => 'Not Related'),
     * return if operation was succcessful
     *********************************/
    function clients_set_vendors_status_status() {
        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();
        $client_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_id');
        $provides_vendor_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'provides_vendor_id');
        $new_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'new_status');

        if ( empty($client_id) or empty($provides_vendor_id) or empty($new_status) ) {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => 'Invalid parameters !', 'ErrorCode' => 1, 'ret' => 0 )));
            return;
        }
        $ret = $this->clients_mdl->update_clients_vendors( $client_id, $provides_vendor_id, $new_status );
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'ret' => $ret )));
    }


    /**********************
     * create string with all sorting parameters for using in sorting by column header or at editor submitting to keep current filters
     * access public
     * @params : $UriArray - $_GET array in assoc array, $_post_array - $_POST array,
     * $WithPage - if TRUE"page" is added to the url, $WithSort - if to show current sort in resulting string. With TRUEif used in links to editoe, with FALSEis used in
     * sorting columns, as sorting is set for any column.
     * return string with filters in pairs filter_name/filter_value
     *********************************/
    private function clientsProvidesVendorsPreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort)
    {
        $ResStr = '';
        if (!empty($_post_array)) { // form was submitted
            if ($WithPage) {
                $page = $this->input->post('page');
                $ResStr .= !empty($page) ? 'page/' . $page . '/' : 'page/1/';
            }
            $filter_client_id = $this->input->post('filter_client_id');
            $ResStr .= !empty($filter_client_id) ? 'filter_client_id/' . $filter_client_id . '/' : '';
            $filter_related_users_filter = $this->input->post('filter_related_users_filter');
            $ResStr .= !empty($filter_related_users_filter) ? 'filter_related_users_filter/' . $filter_related_users_filter . '/' : '';
            $filter_related_users_type = $this->input->post('filter_related_users_type');
            $ResStr .= !empty($filter_related_users_type) ? 'filter_related_users_type/' . $filter_related_users_type . '/' : '';
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
            $ResStr .= !empty($UriArray['filter_client_id']) ? 'filter_client_id/' . $UriArray['filter_client_id'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_related_users_filter']) ? 'filter_related_users_filter/' . $UriArray['filter_related_users_filter'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_related_users_type']) ? 'filter_related_users_type/' . $UriArray['filter_related_users_type'] . '/' : '';
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

    /**********************
     * create string with all sorting parameters for using in sorting by column header or at editor submitting to keep current filters
     * access public
     * @params : $UriArray - $_GET array in assoc array, $_post_array - $_POST array,
     * $WithPage - if TRUE"page" is added to the url, $WithSort - if to show current sort in resulting string. With TRUEif used in links to editoe, with FALSEis used in
     * sorting columns, as sorting is set for any column.
     * return string with filters in pairs filter_name/filter_value
     *********************************/
    private function clientsPreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort)
    {
        $ResStr = '';
        if (!empty($_post_array)) { // form was submitted
            if ($WithPage) {
                $page = $this->input->post('page');
                $ResStr .= !empty($page) ? 'page/' . $page . '/' : 'page/1/';
            }
            $filter_client_name = $this->input->post('filter_client_name');
            $ResStr .= !empty($filter_client_name) ? 'filter_client_name/' . $filter_client_name . '/' : '';
            $filter_client_active_status = $this->input->post('filter_client_active_status');
            $ResStr .= !empty($filter_client_active_status) ? 'filter_client_active_status/' . $filter_client_active_status . '/' : '';
            $filter_client_type = $this->input->post('filter_client_type');
            $ResStr .= !empty($filter_client_type) ? 'filter_client_type/' . $filter_client_type . '/' : '';
            $filter_client_zip = $this->input->post('filter_client_zip');
            $ResStr .= !empty($filter_client_zip) ? 'filter_client_zip/' . $filter_client_zip . '/' : '';
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
                $ResStr .= !empty($UriArray['page']) ? 'page/' . $UriArray['page'] . '/' : 'page/1/';
            }
            $ResStr .= !empty($UriArray['filter_client_name']) ? 'filter_client_name/' . $UriArray['filter_client_name'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_client_active_status']) ? 'filter_client_active_status/' . $UriArray['filter_client_active_status'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_client_type']) ? 'filter_client_type/' . $UriArray['filter_client_type'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_client_zip']) ? 'filter_client_zip/' . $UriArray['filter_client_zip'] . '/' : '';
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
    /**********************
     * create string with all sorting parameters for using in sorting by column header or at editor submitting to keep current filters
     * access public
     * @params : $UriArray - $_GET array in assoc array, $_post_array - $_POST array,
     * $WithPage - if TRUE"page" is added to the url, $WithSort - if to show current sort in resulting string. With TRUEif used in links to editoe, with FALSEis used in
     * sorting columns, as sorting is set for any column.
     * return string with filters in pairs filter_name/filter_value
     *********************************/
    private function clientsRelatedUsersPreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort)
    {
        $ResStr = '';
        if (!empty($_post_array)) { // form was submitted
            if ($WithPage) {
                $page = $this->input->post('page');
                $ResStr .= !empty($page) ? 'page/' . $page . '/' : 'page/1/';
            }
            $filter_client_id = $this->input->post('filter_client_id');
            $ResStr .= !empty($filter_client_id) ? 'filter_client_id/' . $filter_client_id . '/' : '';
            $filter_related_users_filter = $this->input->post('filter_related_users_filter');
            $ResStr .= !empty($filter_related_users_filter) ? 'filter_related_users_filter/' . $filter_related_users_filter . '/' : '';
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
            $ResStr .= !empty($UriArray['filter_client_id']) ? 'filter_client_id/' . $UriArray['filter_client_id'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_related_users_filter']) ? 'filter_related_users_filter/' . $UriArray['filter_related_users_filter'] . '/' : '';
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
//		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['users']		= $this->admin_mdl->get_users();

	    $data['page']		= 'common/users-view';
	    $data['menu']		= $this->menu;
	    $data['plugins'] 	= array();
	    $data['javascript'] = array();
	    $views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
	    $this->layout->view($views, $data);
	}

/**********************
* Edit User
* access public
* @params usr_segment->3 (client id)
* return view
*********************************/
	public function users_edit(){
		$this->lang->load('ion_auth');
		$this->lang->load('auth');
		if (isset($_POST['ajaxpost'])){
			$this->admin_lib->user_edit();
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['usertoedit'] = $this->common_mdl->user_to_edit($this->uri->segment(3),FALSE,FALSE, TRUE);
		$data['clients']	= $this->common_mdl->get_records('clients');
		$data['groups']		= $this->common_mdl->get_records('groups');
		$data['jobs']		= $this->common_mdl->get_records('jobs');

		$data['page']		= 'users/users-edit'; //page view to load
		$data['plugins'] 	= array('validation');
		$data['javascript'] = array( 'assets/custom/admin/user-edit-validation.js');
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* Add User
* access public
* @params
* return view
*********************************/
	public function users_add(){
		$this->lang->load('ion_auth');
		$this->lang->load('auth');
		if (isset($_POST['ajaxpost'])){
			$this->admin_lib->user_add();
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['clients']= $this->common_mdl->get_records('clients');
		$data['groups']= $this->common_mdl->get_records('groups');
		$data['jobs']=  $this->common_mdl->get_records('jobs');
		$data['page']		= 'users/users-add';
		$data['plugins'] 	= array('validation');
		$data['javascript'] = array( 'assets/custom/admin/user-add-validation.js');
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view  user job (title)
* access public
* @params
* return view
*********************************/
	public function users_jobs(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['jobs']= $this->admin_mdl->get_jobs();


		$data['page']		='users/users-jobs';
		$data['plugins'] 	= array(); //page plugins
		$data['javascript'] = array(); //page javascript
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}


/**********************
* view  user role(group)
* access public
* @params
* return view
*********************************/
	public function users_role(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['groups']		= $this->admin_mdl->get_groups();

		$data['page']		='users/users-role';
		$data['plugins'] 	= array(); //page plugins
		$data['javascript'] = array(); //page javascript
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view and add Client Types
* access public
* @params
* return view
*********************************/
		public function clients_type(){
			if (isset($_POST['ajaxpost'])){
				$this->admin_lib->client_type_add();
				return true;
			}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['client_types']= $this->admin_mdl->get_client_types();


        $data['page']		='clients/clients-types';
		$data['plugins'] 	= array('validation');
	  	$data['javascript'] = array( 'assets/custom/admin/client-type-add-validation.js');
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view and add Contact Types
* access public
* @params
* return view
*********************************/
		public function contact_type(){
			if (isset($_POST['ajaxpost'])){
				$this->admin_lib->contact_type_add();
				return true;
			}
			if (isset($_POST['pk'])){ //edit inline
				$data['con_type_name'] = $_POST['value'];
				$this->common_mdl->db_update('contact_types',$data, 'con_type_id', $_POST['pk']);
				return true;
			}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;
		$data['contact_types']= $this->admin_mdl->get_contact_types();

		$data['page']		='contacts/contacts-types';
		$data['plugins'] 	= array('validation','xeditable');
	  	$data['javascript'] = array( 'assets/custom/admin/contacts-type-add-validation.js');
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* Edit MY PROFILE
* access public
* @params
* return view
*********************************/
	public function profile(){
		$this->common_lib->profile($this->user,$this->menu,$this->group->name,TRUE);
	}

/**********************
* View Activity log
* access public
* @params
* return view
*********************************/
	public function activity_logs(){
		$this->common_lib->activity_log($this->menu,$this->user, $this->group->name,TRUE);
	}
}