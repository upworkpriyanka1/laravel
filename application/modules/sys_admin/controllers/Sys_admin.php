<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys_admin extends CI_Controller {

	 public function __construct() {
        parent::__construct();
		$group = array('sys-admin');
		if (!$this->ion_auth->in_group($group)){
			redirect('./');
		}
		if (!$this->ion_auth->in_group($group)){
			echo "Not allowed";
			die();
		}
		$this->load->library('Sys_admin_lib',NULL,'admin_lib');
		$this->load->model('sys_admin_mdl','admin_mdl');
		$this->lang->load('sys_admin');
		$this->config->load('sys_admin_menu', true );
        $this->menu    			= $this->config->item( 'sys_admin_menu' );

		$this->user 			= $this->common_mdl->get_admin_user();
		$this->group 			= $this->ion_auth->get_users_groups()->row();
		$this->job 				= $this->common_mdl->get_users_jobs()->row();
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
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['page']		='dashboard'; //page view to load
		$data['pls'] 		= array(); //page level scripts optional
		$data['plugins'] 	= array(); //page plugins
		$data['javascript'] = array(); //page javascript
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* action : MUST BE DELETED LATER
* add_dummy 1000 clients
* @params
* returned to clients view page
*********************************/
	public function delete_dummy_clients()
    {
        $start_client_id= 16;
//        echo '<pre>add_dummy_clients $start_client_id::'.print_r($start_client_id,true).'</pre>';
        $this->db->trans_start();
        $query = $this->db->query(" delete FROM clients_groups WHERE client_id >= " . $start_client_id);
        $query = $this->db->query(" delete FROM clients WHERE cid >= " . $start_client_id);
        $this->db->trans_complete();
        redirect('./sys-admin/clients-view');
    }

	public function add_dummy_clients()
    {
        $rows_count= 1000;
        $this->db->trans_start();
        for( $i= 1; $i< $rows_count+1; $i++ ) {
            $insert_data= array(   'client_name'=> 'client_name_'.$i, 'client_owner'=> 'client_owner_'.$i, 'client_address1'=>'client_address_'.$i,
                'client_address2'=>'client_address2_'.$i, 'client_city'=>'client_city_'.$i,	'client_state'=> 'client_state_'.$i, 'client_zip'=> 'client_zip_'.$i,
	            'client_phone'=> 'client_phone_'.$i, 'client_fax'=> 'client_fax_'.$i, 'client_email'=> 'client_email_'.$i, 'client_website'=> 'client_website_'.$i,
	            'color_scheme'=> 'color_scheme_'.$i, 'client_notes'=> 'client_notes_'.$i, 'client_is_active'=> 1   );
            if ( $this->db->insert('clients',$insert_data) ) {
                $new_client_id= $this->db->insert_id();
                $new_clients_groups_ret = $this->db->insert('clients_groups', array('client_group_id' => rand(1, 6), 'client_id' => $new_client_id));
//                echo '<pre>$new_clients_groups_ret::' . print_r($new_clients_groups_ret, true) . '</pre>';
            }
        }
        $this->db->trans_complete();
        redirect('./sys-admin/clients-view');
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
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();

        /* get and keep all filters/page_number for pagination and sorting parameters*/
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
        $page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
        $filter_client_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_name');
        $filter_client_is_active = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_is_active');
        $filter_client_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_type');
        $filter_client_zip = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_zip');
        $filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
        $filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
        $filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
        $filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016

        $PageParametersWithSort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);     // keep all sorting parameters for using in sorting
        $PageParametersWithoutSort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false); // by column header or at editor submitting to keep current filters

        $this->load->library('pagination');
        $pagination_config= $this->common_lib->getPaginationParams();
        $pagination_config['base_url'] = base_url() . 'sys-admin/clients-view';

        $RowsInTable= $this->admin_mdl->getClientsList(true, '', array( 'show_client_type_description'=>'', 'client_name'=> $filter_client_name, 'client_is_active'=> $filter_client_is_active, 'client_type'=> $filter_client_type, 'client_zip'=> $filter_client_zip, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );  // get number of rows by given parameters
        $pagination_config['total_rows'] = $RowsInTable;
        $this->pagination->initialize($pagination_config);  // pagination system initialization by parameters in config file
        $data['clients']= array();
        if ($RowsInTable > 0) { // number of rows by given parameters > 0 - get rows by given parameters for given $page_number.
            $data['clients']= $this->admin_mdl->getClientsList(false, $page_number, array( 'show_client_type_description'=>1, 'client_name'=> $filter_client_name, 'client_is_active'=> $filter_client_is_active, 'client_type'=> $filter_client_type, 'client_zip'=> $filter_client_zip, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );
        } // IMPORTANT : all filter parameters must be similar as in calling of getClientsList above

        $data['client_TypesSelectionList']= $this->admin_mdl->getClient_TypesSelectionList();
        $data['page']		= 'clients/clients-view';
        $data['page_number']		= $page_number;
        $data['RowsInTable']= $RowsInTable;

        $data['filter_client_name']= $filter_client_name;
        $data['filter_client_is_active']= $filter_client_is_active;
        $data['filter_client_type']= $filter_client_type;
        $data['filter_client_zip']= $filter_client_zip;
        $data['filter_created_at_from']= $filter_created_at_from;
        $data['filter_created_at_till']= $filter_created_at_till;
        $data['filter_created_at_from_formatted']= $filter_created_at_from_formatted;
        $data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;
        $data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;
        $data['PageParametersWithSort']= $PageParametersWithSort;
        $data['PageParametersWithoutSort']= $PageParametersWithoutSort;
        $data['sort_direction']= $sort_direction;
        $data['sort']= $sort;

        $pagination_links = $this->pagination->create_links();
        $clients_count_in_db= $this->admin_mdl->clients_count_in_db();

        // create label for current parameter so moving mouse over "Filter" button user can see current filters
        $filters_label_array= array('name'=> $filter_client_name, 'is active'=> $this->common_lib->get_client_is_active_label($filter_client_is_active), 'client type'=> $this->common_lib->get_client_type_label($filter_client_type), 'zip'=> $filter_client_zip, 'created at from'=> $filter_created_at_from, 'created at till'=>$filter_created_at_till);

        $filters_label= $this->common_lib->get_filters_label( $filters_label_array, '<br>' );
        $data['clients_count_in_db']= !empty($clients_count_in_db[0]->clients_count) ? $clients_count_in_db[0]->clients_count : 0;
		$data['filters_label'] = $filters_label;
		$data['plugins'] 	= array();
		$data['pagination_links'] 	= $pagination_links;
		$data['javascript'] = array( 'assets/custom/admin/clients-view.js', 'assets/global/plugins/picker/picker.js', 'assets/global/plugins/picker/picker.date.js', 'assets/global/plugins/picker/picker.time.js'); // add picker.date pluging for date selection in fileters form
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* Add client
* access public
* @params
* return view
*********************************/
	public function clients_add()
	{
		if (isset($_POST['ajaxpost'])){
			$this->admin_lib->client_add();
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['client_types']=   object_to_array($this->common_mdl->get_records('clients_types'),'type_id', 'activity_time', 'DESC');
		$data['page']		= 'clients/clients-add'; //page view to load
		$data['plugins'] 	= array('validation'); //page plugins
	  	$data['javascript'] = array( 'assets/custom/admin/client-add-validation.js');//page javascript
		$views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}



/**********************
* Edit client
* access public
* @params usr_segment->3 (client id)
* return view
*********************************/
	public function clients_edit()
	{
		if (isset($_POST['ajaxpost'])){
			$this->admin_lib->client_edit();
			return true;
		}
        $UriArray = $this->uri->uri_to_assoc(4);
        $post_array = $this->input->post();
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['client']		= $this->common_mdl->get_client($this->uri->segment(3), TRUE);
		$data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');

        $PageParametersWithSort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $PageParametersWithoutSort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
        $data['PageParametersWithSort']= $PageParametersWithSort;
        $data['PageParametersWithoutSort']= $PageParametersWithoutSort;
		$data['page']		= 'clients/client-edit'; //page view to load
		$data['plugins'] 	= array('validation'); //page plugins
	  	$data['javascript'] = array( 'assets/custom/admin/client-add-validation.js');//page javascript
		$views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}


    /**********************
     * create string with all sorting parameters for using in sorting by column header or at editor submitting to keep current filters
     * access public
     * @params : $UriArray - $_GET array in assoc array, $_post_array - $_POST array,
     * $WithPage - if TRUE"page_number" is added to the url, $WithSort - if to show current sort in resulting string. With TRUEif used in links to editoe, with FALSEis used in
     * sorting columns, as sorting is set for any column.
     * return string with filters in pairs filter_name/filter_value
     *********************************/
    private function clientsPreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort)
    {
        $ResStr = '';
        if (!empty($_post_array)) { // form was submitted
            if ($WithPage) {
                $page_number = $this->input->post('page_number');
                $ResStr .= !empty($page) ? 'page_number/' . $page_number . '/' : 'page_number/1/';
            }
            $filter_client_name = $this->input->post('filter_client_name');
            $ResStr .= !empty($filter_client_name) ? 'filter_client_name/' . $filter_client_name . '/' : '';
            $filter_client_is_active = $this->input->post('filter_client_is_active');
            $ResStr .= !empty($filter_client_is_active) ? 'filter_client_is_active/' . $filter_client_is_active . '/' : '';
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
                $ResStr .= !empty($UriArray['page_number']) ? 'page_number/' . $UriArray['page_number'] . '/' : 'page_number/1/';
            }
            $ResStr .= !empty($UriArray['filter_client_name']) ? 'filter_client_name/' . $UriArray['filter_client_name'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_client_is_active']) ? 'filter_client_is_active/' . $UriArray['filter_client_is_active'] . '/' : '';
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
		$data['job'] 		= $this->job;
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
		$data['job'] 		= $this->job;
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
		$data['job'] 		= $this->job;
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
		$data['job'] 		= $this->job;
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
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['client_types']= $this->admin_mdl->get_client_types();


            $data['page']		='clients/clients-types';
		$data['plugins'] 	= array('validation');
	  	$data['javascript'] = array( 'assets/custom/admin/client-type-add-validation.js');
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
//            echo '<pre>$data:'.print_r($data,true).'</pre>';
//            die("-1 XXZ");
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
		$data['job'] 		= $this->job;
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
