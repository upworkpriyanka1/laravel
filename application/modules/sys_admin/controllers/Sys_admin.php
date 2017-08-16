<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('Sys_admin_lib',NULL,'admin_lib');
        $this->load->model('sys_admin_mdl','admin_mdl');
        $this->load->model('clients_mdl','clients_mdl');
        $this->load->model('users_mdl');
        $this->load->model('cms_items_mdl');
        $this->lang->load('sys_admin');
		$this->lang->load('sys_admin_pt');
		//$this->config->load('sys_admin_menu', true );
		//$this->menu = $this->config->item( 'sys_admin_menu' );

        $this->config->load('sys_admin_menu_new', true );
        $this->menu    			= $this->config->item( 'sys_admin_menu_new' );

        $eh_url = base_url() . 'sys-admin/eh';
        $manage_client_type = base_url() . 'sys-admin/manage-client-type';
        if(current_url()!=$eh_url && current_url()!=$manage_client_type){
            $group = array('sys-admin');
            if (!$this->ion_auth->in_group($group)){
                redirect( base_url() . "login/logout" );
            }
            $this->user 			= $this->common_mdl->get_admin_user();
            if ( $this->user->user_status != 'A' ) {    // Only active user can access admin pages
                redirect( base_url() . "login/logout" );
            }
            $logged_user_title_name= $this->session->userdata['logged_user_title_name'];
//            echo '<pre>$logged_user_title_name::'.print_r($logged_user_title_name,true).'</pre>';
//            if ( $logged_user_title_name != 'sys-admin' ) {
//                redirect('/msg/' . urldecode(lang("title_has_no_access_page")) . '/sign/danger');
//            }
            $this->group 			= $this->ion_auth->get_users_groups()->row();
        }




//		$this->job = $this->common_mdl->get_users_jobs()->row();
    }

    /**********************
     * View Dashboard Home
     * access public
     * @params
     * return view
     *
     **************************GRID Html**************

	 





     * ****************************************
     *	 *********************************/
    public function grid(){
        $data['meta_description']='';
        $data['menu']		= $this->menu;

        $data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;

        $data['page']		= 'main/grid';
        $data['pls'] 		= array(); //page level scripts optional
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array(); //page javascript
        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );

        $this->layout->view($views,$data);
    }
	
	 public function grid_without_shortcuts(){
        $data['meta_description']='';
        $data['menu']		= $this->menu;

        $data['user'] 		= $this->user;
        $data['group'] 		= $this->group->name;

        $data['page']		= 'main/grid-without-shortcuts';
        $data['pls'] 		= array(); //page level scripts optional
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array(); //page javascript
        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );

        $this->layout->view($views,$data);
    }
    public function col3(){
        $data['meta_description']='';
        $data['menu']		= $this->menu;

        $data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;

        $data['page']		= 'main/col3';
        $data['pls'] 		= array(); //page level scripts optional
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array(); //page javascript
        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );

        $this->layout->view($views,$data);
    }
    public function newuserform(){
        $data['meta_description']='';
        $data['menu']		= $this->menu;

        $data['user'] 		= $this->user;
        $data['group'] 		= $this->group->name;

        $data['page']		= 'clients/client-verification-email';
        $data['pls'] 		= array(); //page level scripts optional
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array(); //page javascript
        $views				= array('design/html_topbar','design/page','design/html_footer', 'common_dialogs.php' );

        $this->layout->view($views,$data);
    }
    public function eh(){
        $this->load->view('main/eh');
    }
	public function pt(){
        $this->load->view('main/pt');
    }
	
	public function sign_up(){
       $data['meta_description']='';
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
        $data['group'] 		= $this->group->name;
        $data['page']		='mockup/sign_up'; //page view to load
        $data['pls'] 		= array(); //page level scripts optional
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array(); //page javascript
        $views=  array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view($views, $data);
    }
	
	public function sign_dashboard()
    {		
       /* $UriArray = $this->uri->uri_to_assoc(2);		
        $is_insert= true;
        $app_config = $this->config->config;
        $cid= '';
        if ( !empty($UriArray['client']) and $this->common_lib->is_positive_integer($UriArray['client'])  ) {
            $is_insert= false;
            $cid= $UriArray['client'];
        }
        if($this->session->flashdata( 'validation_errors_text' ) != ''){
            $validation_text = trim(preg_replace('/\s+/', ' ', addslashes($this->session->flashdata( 'validation_errors_text'))));;
            $this->session->set_flashdata('validation_errors_text1',$validation_text);
            $this->session->set_flashdata('user_edit_new_post_data1',$this->session->flashdata( 'user_edit_new_post_data'));       
        }
		
        $post_array = $this->input->post();
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
        $page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
        $filter_client_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_name');
        $filter_client_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_status');
        $filter_client_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_type');
        $filter_client_zip = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_zip');
        $filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
        $filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
        $filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
        $filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016
        $data['filter_client_name']= $filter_client_name;
        $data['filter_client_status']= $filter_client_status;
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

        // Get list of client types
        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        // Get client status array
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        // Get user status array
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
        // Get client phone type like home,work
        $data['client_phone_type_array']= $this->clients_mdl->getClientPhoneTypeArray();
        // Get list of color scheme options
        $data['client_color_schemes'] = $this->config->item('client_color_schemes');


        $data['is_insert']  = $is_insert;
        $data['cid']      = $cid;        
//		$data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;

        $client_id= $this->uri->segment(3);
//        echo '<pre>$client_id::'.print_r($client_id,true).'</pre>';
        $client		= $this->clients_mdl->getRowById( $client_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );

        $groupsSelectionList= $this->users_mdl->getGroupsSelectionList( array(), 'id',  'asc', ['sys-admin'] );
        usort($groupsSelectionList,'cmpGroups');
        $data['groupsSelectionList']  = $groupsSelectionList;

        $data['userStatusValueArray']= $this->users_mdl->getUserStatusValueArray();
        foreach ( $data['userStatusValueArray'] as $next_key=>$next_userStatus ) {
            if ( !in_array($next_userStatus['key'],array('N', 'P')) ) {
                unset($data['userStatusValueArray'][$next_key]);
            }
        }
        $data['client_id'] = $client->cid;
        // END BBITS DEV

        $data['client']		= $client;
        $data['page_parameters_with_sort']= $page_parameters_with_sort;
        $data['page_parameters_without_sort']= $page_parameters_without_sort;*/
		$data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
        $data['page']		= 'mockup/sign_dashboard'; //page view to load
        $data['plugins'] 	= array('validation'); //page plugins
        $data['javascript'] = array( '/assets/global/js/client-overview-view.js','assets/custom/admin/client_overview_methods.js', 'assets/custom/common/funcs.js' );
        $views				=  array( 'clients/html_topbar_client', 'sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view($views, $data);

    }
	
    public function client_overview(){
        $this->load->view('main/client_overview');
    }

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
        $views=  array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view($views, $data);
    }

    /**********************
     * view clients
     * access public
     * @params
     * return view
     *********************************/
    public function clients_view(){
//die;
//		************************************************************* ____START____ **********************************************************************************

        $UriArray = $this->uri->uri_to_assoc(2);
        $is_insert= true;
        $app_config = $this->config->config;
        $cid= '';
        if ( !empty($UriArray['clients-view']) and $this->common_lib->is_positive_integer($UriArray['clients-view'])  ) {
            $is_insert= false;
            $cid= $UriArray['clients-view'];
        }
        $post_array = $this->input->post();
//		$sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
//		$sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
//		$page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
//		$filter_client_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_name');
//		$filter_client_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_status');
//		$filter_client_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_type');
//		$filter_client_zip = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_zip');
//		$filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
//		$filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
//		$filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
//		$filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016
//		$data['filter_client_name']= $filter_client_name;
//		$data['filter_client_status']= $filter_client_status;
//		$data['filter_client_type']= $filter_client_type;
//		$data['filter_client_zip']= $filter_client_zip;
//		$data['filter_created_at_from']= $filter_created_at_from;
//		$data['filter_created_at_till']= $filter_created_at_till;
//		$data['filter_created_at_from_formatted']= $filter_created_at_from_formatted;
//		$data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;
//		$data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;

        $page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/clients-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
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
//				echo '<pre>$data[\'validation_errors_text\']::'.print_r($data['validation_errors_text'],true).'</pre>';
            }
        }
        else {
            $client		= $this->clients_mdl->getRowById( $this->uri->segment(3), array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );

        }

        $data['client']		= $client;
        $data['page_parameters_with_sort']= $page_parameters_with_sort;
        $data['page_parameters_without_sort']= $page_parameters_without_sort;
        $data['plugins'] 	= array('validation'); //page plugins

//		************************************************************* ____END____ **********************************************************************************

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
        $filter_client_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_status');
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

        $RowsInTable= $this->clients_mdl->getClientsList(true, '', array( 'show_client_type_description'=>'', 'client_name'=> $filter_client_name, 'client_status'=> $filter_client_status, 'client_type'=> $filter_client_type, 'client_zip'=> $filter_client_zip, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );  // get number of rows by given parameters
        $pagination_config['total_rows'] = $RowsInTable;
        $this->pagination->initialize($pagination_config);  // pagination system initialization by parameters in config file
        $data['clients']= array();
        if ($RowsInTable > 0) { // number of rows by given parameters > 0 - get rows by given parameters for given $page.
            $data['clients']= $this->clients_mdl->getClientsList(false, $page, array( 'show_client_type_description'=>1, 'client_name'=> $filter_client_name, 'client_status'=> $filter_client_status, 'client_type'=> $filter_client_type, 'client_zip'=> $filter_client_zip, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );
        } // IMPORTANT : all filter parameters must be similar as in calling of getClientsList above

        $data['client_TypesSelectionList']= $this->clients_mdl->getClient_TypesSelectionList();
        $data['client_ActiveStatusList']= $this->clients_mdl->getClientStatusValueArray();
        $data['page']		= 'clients/clients-view';
        $data['page_number']		= $page;
        $data['RowsInTable']= $RowsInTable;
        $data['editor_message']= $this->session->flashdata('editor_message');

        $data['filter_client_name']= $filter_client_name;
        $data['filter_client_status']= $filter_client_status;
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
        $filters_label_array= array('name'=> $filter_client_name, 'is active'=> $this->common_lib->get_client_status_label($filter_client_status), 'client type'=>
            $this->common_lib->get_client_type_label($filter_client_type), 'zip'=> $filter_client_zip, 'created at from'=> $filter_created_at_from, 'created at till'=>$filter_created_at_till);

        $filters_label= $this->common_lib->get_filters_label( $filters_label_array, '<br>' );
        $data['clients_count_in_db']= !empty($clients_count_in_db[0]->clients_count) ? $clients_count_in_db[0]->clients_count : 0;
        $data['filters_label'] = $filters_label;
        $data['plugins'] 	= array();
        $data['pagination_links'] 	= $pagination_links;
        $data['javascript'] = array( 'assets/custom/admin/clients-view.js',  'assets/custom/admin/client-edit.js', 'assets/global/plugins/picker/picker.js', 'assets/global/plugins/picker/picker.date.js', 'assets/global/plugins/picker/picker.time.js');

        $views				= array( 'design/html_topbar', 'sidebar','design/page','design/html_footer', 'common_dialogs.php' );
		$i=0;
		
		$clientIds = array();
		foreach($data['clients'] as $row){
			array_push($clientIds, $row->cid);
		}
		$userCount = $this->users_mdl->getUsersCount($clientIds);

		foreach($data['clients'] as $row){
			$flag = 0;
			$count = 0;
			foreach($userCount as $userrow){
				if($userrow->uc_client_id == $row->cid ){
					$flag = 1;
					$count = $userrow->user_count;
					break;
				}else{
					$flag = 0;
				}
			}
			if($flag == 1){
				$row->user_count = $count;
			}else{
				$row->user_count = 0;
			}
			$i++;
		}
		//echo "<br><pre>";print_r($data['clients']);echo "</pre>";exit;
		$data['TotalRecords'] = count($data['clients']);
		$data['sidebarMenu'] = "clients";
		
        $this->layout->view($views, $data);
    }


    public function clients_view_new(){

//		************************************************************* ____START____ **********************************************************************************




        $UriArray = $this->uri->uri_to_assoc(2);
        $is_insert= true;
        $app_config = $this->config->config;
        $cid= '';
        if ( !empty($UriArray['clients-view']) and $this->common_lib->is_positive_integer($UriArray['clients-view'])  ) {
            $is_insert= false;
            $cid= $UriArray['clients-view'];
        }
        $post_array = $this->input->post();


        $page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/clients-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
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
//				echo '<pre>$data[\'validation_errors_text\']::'.print_r($data['validation_errors_text'],true).'</pre>';
            }
        }
        else {
            $client		= $this->clients_mdl->getRowById( $this->uri->segment(3), array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );

        }

        $data['client']		= $client;
        $data['page_parameters_with_sort']= $page_parameters_with_sort;
        $data['page_parameters_without_sort']= $page_parameters_without_sort;
        $data['plugins'] 	= array('validation'); //page plugins

//		************************************************************* ____END____ **********************************************************************************

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
        $filter_client_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_status');
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

        $RowsInTable= $this->clients_mdl->getClientsList(true, '', array( 'show_client_type_description'=>'', 'client_name'=> $filter_client_name, 'client_status'=> $filter_client_status, 'client_type'=> $filter_client_type, 'client_zip'=> $filter_client_zip, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );  // get number of rows by given parameters
        $pagination_config['total_rows'] = $RowsInTable;
        $this->pagination->initialize($pagination_config);  // pagination system initialization by parameters in config file
        $data['clients']= array();
        if ($RowsInTable > 0) { // number of rows by given parameters > 0 - get rows by given parameters for given $page.
            $data['clients']= $this->clients_mdl->getClientsList(false, $page, array( 'show_client_type_description'=>1, 'client_name'=> $filter_client_name, 'client_status'=> $filter_client_status, 'client_type'=> $filter_client_type, 'client_zip'=> $filter_client_zip, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );
        } // IMPORTANT : all filter parameters must be similar as in calling of getClientsList above

        $data['client_TypesSelectionList']= $this->clients_mdl->getClient_TypesSelectionList();
        $data['client_ActiveStatusList']= $this->clients_mdl->getClientStatusValueArray();
        $data['page']		= 'clients/clients-view-modal';
//		$data['page']		= 'main/grid';
        $data['page_number']		= $page;
        $data['RowsInTable']= $RowsInTable;
        $data['editor_message']= $this->session->flashdata('editor_message');

        $data['filter_client_name']= $filter_client_name;
        $data['filter_client_status']= $filter_client_status;
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
        $data['cl_type'] = $this->clients_mdl->get_clients_type();
        $this->pagination->suffix = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $this->pagination->cur_page= $page;
        $pagination_links = $this->pagination->create_links();
        $clients_count_in_db= $this->admin_mdl->clients_count_in_db();

        // create label for current parameter so moving mouse over "Filter" button user can see current filters
        $filters_label_array= array('name'=> $filter_client_name, 'is active'=> $this->common_lib->get_client_status_label($filter_client_status), 'client type'=>
            $this->common_lib->get_client_type_label($filter_client_type), 'zip'=> $filter_client_zip, 'created at from'=> $filter_created_at_from, 'created at till'=>$filter_created_at_till);

        $filters_label= $this->common_lib->get_filters_label( $filters_label_array, '<br>' );
        $data['clients_count_in_db']= !empty($clients_count_in_db[0]->clients_count) ? $clients_count_in_db[0]->clients_count : 0;
        $data['filters_label'] = $filters_label;
        $data['plugins'] 	= array();
        $data['pagination_links'] 	= $pagination_links;
        $data['javascript'] = array( 'assets/custom/admin/clients-view.js',  'assets/custom/admin/client-edit.js', 'assets/global/plugins/picker/picker.js', 'assets/global/plugins/picker/picker.date.js', 'assets/global/plugins/picker/picker.time.js');

        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer');

        $html = $this->load->view('clients/clients-view-modal', $data, true);
//		echo $html;

        echo json_encode(["html"=>$html]);
        exit();
    }



    /**********************
     * get client info
     * access public
     * @params : client_id - id of client     \
     * return client info if operation was successful, otherwise error
     *********************************/
    function get_client_info() {
        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();
        $client_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_id');
        if ( empty($client_id) ) {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => 'Invalid parameters !', 'ErrorCode' => 1, 'ret' => 0 )));
            return;
        }
        $client	= $this->clients_mdl->getRowById( $client_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );
        $client->formatted_client_logo_first= substr($client->client_name,0,1);

        $clients_types= $this->clients_mdl->getClient_TypesRowById($client->clients_types_id);

        $client->formatted_client_type_label= !empty($clients_types->type_description) ? $clients_types->type_description : '';
        $client->formatted_client_address= $this->common_lib->concatArray(array($client->client_address1, $client->client_address2 ), ', ');
        $client->formatted_client_phone= $this->common_lib->concatArray(array($client->client_phone, $client->client_phone_2, $client->client_phone_3, $client->client_phone_4 ), ', ');
        $client->formatted_client_city= $this->common_lib->concatArray(array($client->client_zip, $client->client_state, $client->client_city ), ', ');
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'client' => $client )));
    }

    /**********************
     * get client info
     * access public
     * @params : client_id - id of client     \
     * return client info if operation was successful, otherwise error
     *********************************/
    function save_client_info() {
        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();

        $client_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_id');
        if ( empty($client_id) ) {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => 'Invalid parameters !', 'ErrorCode' => 1, 'ret' => 0 )));
            return;
        }

        $update_data= array(
            'client_name' => $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_name'),
            'client_address1' => $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_address1') ,
            'client_address2' => $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_address2'),
            'client_city' => $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_city'),
            'client_state' => $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_state'),
            'client_zip' => $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_zip'),
            'client_phone' => $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_phone'),
            'client_phone_2' => $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_phone_2'),
            'client_phone_3' => $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_phone_3'),
        );
        $this->db->where( $this->clients_mdl->m_clients_table . '.cid', $client_id);
        $ret= $this->db->update($this->clients_mdl->m_clients_table, $update_data);
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0  )));
    }


    public function client_edit(){
        $is_insert= false;
        $UriArray = $this->uri->uri_to_assoc(2);
        $client_id=$UriArray['client-edit'];

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post_array = $this->input->post();
            $client_id = $post_array['data']['client_id'];
            $this->client_edit_form_validation();
            $validation_status = $this->form_validation->run();
            if ($validation_status == FALSE) {
                $client = $this->client_edit_fill_current_data( null, $is_insert, $client_id );
                $this->session->set_flashdata('errors', validation_errors());
            } else {
                $data = array(
                    'client_name' => $post_array['data']['client_name'],
                    'client_address1' => $post_array['data']['client_address1'],
                    'client_address2' => $post_array['data']['client_address2'],
                    'client_city' => $post_array['data']['client_city'],
                    'client_state' => $post_array['data']['client_state'],
                    'client_zip' => $post_array['data']['client_zip'],
                    'client_phone' => $post_array['data']['client_phone'],
                    'client_phone_2' => $post_array['data']['client_phone2'],
                    'client_phone_3' => $post_array['data']['client_phone3'],
                    'client_phone_4' => $post_array['data']['client_phone4'],
                    'client_phone_type' => $post_array['data']['client_phone_type'],
                    'client_email' => $post_array['data']['client_email'],
                    'client_website' => $post_array['data']['client_website'],
                );

                $original_client_img= !empty($post_array['data']['client_img']) ? $post_array['data']['client_img'] : '';
                if  (  !empty( $post_array['cbx_clear_image'])  )  {
                    $data['client_img']= '';
                }
                if ( !empty( $_FILES['data']['name']['client_img'] ) ) {
                    $data['client_img']= $_FILES['data']['name']['client_img'];
                }

                $this->db->where( $this->clients_mdl->m_clients_table . '.cid', $client_id);
                $ret= $this->db->update($this->clients_mdl->m_clients_table, $data);
                if (  !empty( $post_array['cbx_clear_image']) or !empty($_FILES['data']['name']['client_img'])  )   {
                    $original_img_path= $this->clients_mdl->getClientImagePath($client_id, $original_client_img);
                    if ( !empty($original_img_path) and file_exists($original_img_path) and !is_dir($original_img_path)) {
                        unlink($original_img_path);
                    }
                }

                $clientImagesDirs = array( FCPATH . 'uploads', $this->clients_mdl->getClientsDir(), $this->clients_mdl->getClientDir($client_id) );
                $src_filename = $_FILES['data']['tmp_name']['client_img'];
                $img_basename = $_FILES['data']['name']['client_img'];

                $this->common_lib->createDir($clientImagesDirs);
                $ret = move_uploaded_file( $src_filename, $this->clients_mdl->getClientDir($client_id) . $img_basename );

                $this->session->set_flashdata('massege', 'Updated successfully');
                redirect('sys-admin/client/'.$client_id.'/');
            }
        } // if ($this->input->server('REQUEST_METHOD') == 'POST') {
        else { // That is GET REQUEST
            $client	= $this->clients_mdl->getRowById( $client_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );
        }
        $data['meta_description']='';
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
        $data['group'] 		= $this->group->name;
        $data['client']		= $client;
        $data['page']		='clients/client-edit';
        $views=  array('clients/html_topbar_client_edit','sidebar','design/page','design/html_footer');
        $this->layout->view($views, $data);

    } // public function client_edit(){

    /**********************
     * Edit clients
     * access public
     * @params usr_segment->3 (clients id)
     * return view
     *********************************/
    public function client()
    {
		
        $UriArray = $this->uri->uri_to_assoc(2);
		
        $is_insert= true;
        $app_config = $this->config->config;

        $cid= '';
        if ( !empty($UriArray['client']) and $this->common_lib->is_positive_integer($UriArray['client'])  ) {
            $is_insert= false;
            $cid= $UriArray['client'];
        }
        if($this->session->flashdata( 'validation_errors_text' ) != '')
        {
            $validation_text = trim(preg_replace('/\s+/', ' ', addslashes($this->session->flashdata( 'validation_errors_text'))));;
            $this->session->set_flashdata('validation_errors_text1',$validation_text);
            $this->session->set_flashdata('user_edit_new_post_data1',$this->session->flashdata( 'user_edit_new_post_data'));
            //echo "explode data is : " . explode('^',$this->session->flashdata( 'user_edit_new_post_data'));
            //exit(0);
            //header('Location: '.base_url().'sys-admin/client/' . $cid);
            //exit(0);
        }
		
        $post_array = $this->input->post();
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
        $page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
        $filter_client_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_name');
        $filter_client_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_status');
        $filter_client_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_type');
        $filter_client_zip = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_zip');
        $filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
        $filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
        $filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
        $filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016
        $data['filter_client_name']= $filter_client_name;
        $data['filter_client_status']= $filter_client_status;
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

        // Get list of client types
        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        // Get client status array
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        // Get user status array
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
        // Get client phone type like home,work
        $data['client_phone_type_array']= $this->clients_mdl->getClientPhoneTypeArray();
        // Get list of color scheme options
        $data['client_color_schemes'] = $this->config->item('client_color_schemes');


        $data['is_insert']  = $is_insert;
        $data['cid']      = $cid;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;

        $client_id= $this->uri->segment(3);
//        echo '<pre>$client_id::'.print_r($client_id,true).'</pre>';
        $client		= $this->clients_mdl->getRowById( $client_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );

        $groupsSelectionList= $this->users_mdl->getGroupsSelectionList( array(), 'id',  'asc', ['sys-admin'] );
        usort($groupsSelectionList,'cmpGroups');
        $data['groupsSelectionList']  = $groupsSelectionList;

        $data['userStatusValueArray']= $this->users_mdl->getUserStatusValueArray();
        foreach ( $data['userStatusValueArray'] as $next_key=>$next_userStatus ) {
            if ( !in_array($next_userStatus['key'],array('N', 'P')) ) {
                unset($data['userStatusValueArray'][$next_key]);
            }
        }
        $data['client_id'] = $client->cid;
        // END BBITS DEV

        $data['client']		= $client;
        $data['page_parameters_with_sort']= $page_parameters_with_sort;
        $data['page_parameters_without_sort']= $page_parameters_without_sort;
        $data['page']		= 'clients/client'; //page view to load
        $data['plugins'] 	= array('validation'); //page plugins
        $data['javascript'] = array( '/assets/global/js/client-overview-view.js','assets/custom/admin/client_overview_methods.js', 'assets/custom/common/funcs.js' );
        $views				=  array( 'clients/html_topbar_client', 'sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view($views, $data);

    }



    /**********************
     * get user info
     * access public
     * @params : email - email of user     \
     * return user info if operation was successful, otherwise error
     *********************************/
    function get_user_info_by_email() {
        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();
        $email = $this->common_lib->getParameter($this, $UriArray, $post_array, 'email');
        $client_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_id');
        if ( empty($email) ) {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => 'Invalid parameters !', 'ErrorCode' => 1, 'ret' => 0 )));
            return;
        }
        $user    = $this->users_mdl->getSimilarUserByEmail( $email );
        $groupsList = $this->users_mdl->getGroupsSelectionList(array(), 'id', 'asc', ['sys-admin']);
        if ( !empty($user) ) {
            $userGroupsList = $this->users_mdl->getUsersClientsList( false, 0, array('user_id'=>$user->id, 'client_id'=>$client_id) );
            foreach( $groupsList as $next_key=>$nextGroup) {
                foreach( $userGroupsList as $nextUserGroup) {
                    if ( $nextGroup['key']  == $nextUserGroup->uc_group_id ) {
                        unset($groupsList[$next_key]);
                        break;
                    }
                }
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => (empty($user) ? 1 : 0), 'user' => $user, 'groupsList'=> $groupsList , 'groups_length'=> count($groupsList) )));
    }

    public function add_client_user_relation ()
    {
        $post_array = $this->input->post();
        $app_config = $this->config->config;

        $client_id = $this->common_lib->getParameter($this, array(), $post_array, 'client_id' );
        $group_id = $this->common_lib->getParameter($this, array(), $post_array, 'group_id' );
        $user_id = $this->common_lib->getParameter($this, array(), $post_array, 'user_id' );

        $this->db->trans_start();

        $userGroupsList = $this->users_mdl->getUsersGroupsList(false, 0, array('user_id'=> $user_id, 'group_id'=> $group_id));
        if( count($userGroupsList) == 0 ) {
            $ret = $this->db->insert($this->users_mdl->m_users_groups_table, array('user_id' => $user_id, 'group_id' => $group_id, 'status' => 'P'));
        }
		
		// Update users_clients
		$activation_code= $this->common_lib->GenerateActivationCode();
		$update_data = array(
							'uc_client_id' => $client_id,
							'uc_user_id' => $user_id,
							'uc_active_status' => 'P',
							'uc_group_id' => $group_id,
							'username' => '',
							'activation_code' => $activation_code,
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s')
						);
		
        //$ret = $this->admin_mdl->update_users_clients($update_data);
		$ret = $this->db->insert('users_clients',$update_data);
		
		// Get user data
		$this->db->where('id',$user_id);
		$this->db->from('users');
        $user_data = $this->db->get()->result();
		$user_email = $user_data[0]->email;
		$user_name = $user_data[0]->username;

            $activation_page_url= $app_config['base_url']."activation/".$activation_code;
            $title= 'You are registered at ' . $app_config['site_name'] . ' site';
            $content = $this->cms_items_mdl->getBodyContentByAlias('existing_account_activated',
                array(
					'username' => $user_name,
                    'site_name' => $app_config['site_name'],
                    'support_signature' => $app_config['support_signature'],
                    'activation_page_url' => $activation_page_url,
                    'site_url' => $app_config['base_url'],
                    'email' => $user_email
                ), true);
                $EmailOutput = $this->common_lib->SendEmail($user_email, $title, $content );

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => 'Error creating user', 'ErrorCode' => 1, 'client_id' => $client_id, 'user_id' => $user_id, 'group_id' => $group_id )));
        } else {
            $this->db->trans_commit();
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'client_id' => $client_id, 'user_id' => $user_id, 'group_id' => $group_id )));

    } // public function add_client_user_relation ()




    public function save_client_related_user ()
    {
        $UriArray = [];
        $is_insert= false;
        $post_array = $this->input->post();
        $app_config = $this->config->config;

        $id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'id' );
        $client_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'client_id' );
        $username = $this->common_lib->getParameter($this, $UriArray, $post_array, 'username' );
        $first_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'first_name' );
        $last_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'last_name' );
        $phone = $this->common_lib->getParameter($this, $UriArray, $post_array, 'phone' );
        $email = $this->common_lib->getParameter($this, $UriArray, $post_array, 'email' );
        $user_group_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'user_group_id' );

        $user_status= 'P';
        $city= '';
        $state= '';
        $auth= 0;

        $this->db->trans_start();
        $ip_address= !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        $activation_code= $this->common_lib->GenerateActivationCode();

        $additional_data= array(  'ip_address'=> $ip_address, 'user_status' => $user_status, 'first_name' => $first_name, 'last_name' => $last_name, 'city' => $city, 'state' => $state, 'phone' => $phone, 'created_on'=> now(), 'avatar' => '', 'is_multi_auth' => $auth, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'super_id' => $this->user->user_id, 'activation_code'=> $activation_code , 'client_id' => $client_id, 'super_id' => $this->user->user_id, 'uc_client_id' => $client_id, 'uc_active_status' => 'P' );
        $user_group_array= array($user_group_id);
        $new_user_id = $this->ion_auth->register( $username, '', $email, $additional_data,   array(  $user_group_array  )  );

        if ($new_user_id) {
            //$ret = $this->admin_mdl->update_users_clients( $client_id, $new_user_id, 'N', $user_group_id );

            $activation_page_url= $app_config['base_url']."activation/".$activation_code;
            $title= 'You are registered at ' . $app_config['site_name'] . ' site';
            $content = $this->cms_items_mdl->getBodyContentByAlias('user_register',
                array('username' => $username,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'site_name' => $app_config['site_name'],
                    'support_signature' => $app_config['support_signature'],
                    'activation_page_url' => $activation_page_url,
                    'site_url' => $app_config['base_url'],
                    'email' => $email
                ), true);
                $EmailOutput = $this->common_lib->SendEmail($email, $title, $content );				
				

            $this->session->set_flashdata('editor_message', lang('user') . " '" . $first_name . "' was " . ($is_insert ? "inserted" : "updated") );
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => 'Error creating user', 'ErrorCode' => 1, 'id' => $id )));
            } else {
                $this->db->trans_commit();
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'id' => $new_user_id )));
        }
		

    } // public function save_client_related_user ()


    /**********************
     * for client load list of related_users, with filters, sorting
     * access public
     * @params : filter_client_id - client_id, filter_related_users_filter - filter string by username, filter_related_users_type - users type of relation,
     * user_status - filter by user active_status, sort/sort_direction - order and direction of resulting listing
     * return list related users
     *********************************/
    public function load_client_related_users()
    {
        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();
        $filter_client_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_client_id');
        $page = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page');
        $filter_related_users_filter = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_related_users_filter');
        $filter_related_users_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_related_users_type');
        $db_filter_related_users_type= $filter_related_users_type;
        $user_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'user_status');
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort', 'created_at');
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
        $filters= array( 'client_id'=>$filter_client_id );
        $users_count = $this->users_mdl->getUsersClientsList( true, 0, $filters );
        $filters['show_user_username']= 1;
        $filters['show_group_name']= 1;

        $pagination_config['total_rows'] = $users_count;
        $this->pagination->suffix = $this->clientsRelatedUsersPreparePageParameters($UriArray, $post_array, false, true);

        $this->pagination->initialize($pagination_config);
        $this->pagination->cur_page= $page;
        $pagination_links = $this->pagination->create_links();
        $related_users_list= [];
        if ( $users_count > 0 ) {
            $related_users_list = $this->users_mdl->getUsersClientsList( false, '', $filters, $sort, $sort_direction );
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


    public function client_edit_post(){

        $this->client_edit_form_validation();
        $validation_status = $this->form_validation->run();
        if ($validation_status == FALSE) {
            $this->client_edit();
        } else {
            $client_id = $this->input->post('data[client_id]');

            $data = array(
                'client_name' => $this->input->post('data[client_name]'),
                'client_address1' => $this->input->post('data[client_address1]'),
                'client_address2' => $this->input->post('data[client_address2]'),
                'client_city' => $this->input->post('data[client_city]'),
                'client_state' => $this->input->post('data[client_state]'),
                'client_zip' => $this->input->post('data[client_zip]'),
                'client_phone' => $this->input->post('data[client_phone]'),
                'client_phone2' => $this->input->post('data[client_phone2]'),
                'client_phone3' => $this->input->post('data[client_phone3]'),
                'client_phone4' => $this->input->post('data[client_phone4]'),
                'client_phone_type' => $this->input->post('data[client_phone_type]'),
                'client_email' => $this->input->post('data[client_email]'),
                'client_website' => $this->input->post('data[client_website]'),
            );

        }
    }


    public function client_check_client_email_is_unique()
    {
        $client_email = $this->input->post('data[client_email]', '');
        if (empty($client_email)) {
            return;
        }
        $client_id = $this->input->post('data[client_id]', 0);
        if ( $client_id == 'new' ) $client_id= 0;
        $similarClient= $this->clients_mdl->getSimilarClientByClient_Email( $client_email, $client_id );
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
//		$client->client_status = set_value('data[client_status]');
        $client->color_scheme = set_value('data[color_scheme]');
        return $client;
    }


    private function client_edit_form_validation()
    {
        $this->form_validation->set_rules( 'data[client_name]', lang('client_name'), 'required' );
        $this->form_validation->set_rules( 'data[client_address1]', lang('client_address1'), 'required' );
        $this->form_validation->set_rules( 'data[client_address2]', lang('client_address2'), '' );
        $this->form_validation->set_rules( 'data[client_email]', lang('client_email'), 'valid_email|callback_client_check_client_email_is_unique'  );
        $this->form_validation->set_rules( 'data[client_website]', lang('client_website'), '' );
        $this->form_validation->set_rules( 'data[client_city]', lang('client_city'), 'required' );
        $this->form_validation->set_rules( 'data[client_state]', lang('client_state'), 'required' );
        $this->form_validation->set_rules( 'data[client_zip]', lang('client_zip'), 'required' );
        $this->form_validation->set_rules( 'data[client_phone]', lang('phone'), 'required' );
        $this->form_validation->set_rules( 'data[client_phone_2]', lang('phone_2'), '' );
        $this->form_validation->set_rules( 'data[client_phone_3]', lang('phone_3'), '' );
        $this->form_validation->set_rules( 'data[client_phone_4]', lang('phone-4'), '' );
        $this->form_validation->set_rules( 'data[client_phone_5]', lang('phone-5'), '' );
        $this->form_validation->set_rules( 'data[client_phone_type]', lang('phone_type'), '' );
        $this->form_validation->set_rules( 'data[client_img]', lang('client_img'),'' );

//		$this->form_validation->set_rules( 'data[client_fax]', lang('client_fax'), 'required' );
//		$this->form_validation->set_rules( 'data[client_status]', lang('client_status'), 'required' );
//		$this->form_validation->set_rules( 'data[color_scheme]', lang('color_scheme'), ( $is_insert ? '' : 'required' ) );
    }

    //H// Added by BBITS Dev to add form validation of add client type.
    private function client_type_add_form_validation($is_insert, $cid)
    {
        $this->form_validation->set_rules( 'data[name]', 'Name', 'required|callback_client_type_name_validation' );
        $this->form_validation->set_rules( 'data[description]', 'Description', 'required' );
    }


    //H// Added by BBITS Dev to add callback function to set rule for client name which allows space and alphabets only
    public function client_type_name_validation($str)
    {
        if(!preg_match('/^[a-zA-Z\s]+$/',$str))
        {
            return false;
        }
    }




    /**********************
     * for client update/insert related_user_status
     * access public
     * @params : client_id - id of client, related_user_id - id of user to change status, new_status - new status('E' => 'Employee', 'O' => 'Out Of Staff', 'N' => 'Not Related'),
     * return if operation was successful
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
     * user_status - filter by user active_status, sort/sort_direction - order and direction of resulting listing
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
        $user_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'user_status');
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
     * return if operation was successful
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
            $filter_client_status = $this->input->post('filter_client_status');
            $ResStr .= !empty($filter_client_status) ? 'filter_client_status/' . $filter_client_status . '/' : '';
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
            $ResStr .= !empty($UriArray['filter_client_status']) ? 'filter_client_status/' . $UriArray['filter_client_status'] . '/' : '';
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
        //		************************************************************* ____START____ **********************************************************************************
        $UriArray = $this->uri->uri_to_assoc(2);
        $is_insert= true;
        $app_config = $this->config->config;
        $cid= '';
        if ( !empty($UriArray['clients-view']) and $this->common_lib->is_positive_integer($UriArray['clients-view'])  ) {
            $is_insert= false;
            $cid= $UriArray['clients-view'];
        }
        $post_array = $this->input->post();

        $page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/clients-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
        $data['client_phone_type_array']= $this->clients_mdl->getClientPhoneTypeArray();
        $data['client_color_schemes'] = $this->config->item('client_color_schemes');


        $data['is_insert']  = $is_insert;
        $data['cid']      = $cid;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
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
        $data['plugins'] 	= array('validation'); //page plugins

//		************************************************************* ____END____ *********************************************************************************

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
        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view($views, $data);
    }

    /**********************
     * Edit User
     * access public
     * @params usr_segment->3 (client id)
     * return view
     *********************************/
    public function users_edit(){
        //		************************************************************* ____START____ **********************************************************************************

        $UriArray = $this->uri->uri_to_assoc(2);
        $is_insert= true;
        $app_config = $this->config->config;
        $cid= '';
        if ( !empty($UriArray['clients-view']) and $this->common_lib->is_positive_integer($UriArray['clients-view'])  ) {
            $is_insert= false;
            $cid= $UriArray['clients-view'];
        }
        $post_array = $this->input->post();

        $page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/clients-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
        $data['client_phone_type_array']= $this->clients_mdl->getClientPhoneTypeArray();
        $data['client_color_schemes'] = $this->config->item('client_color_schemes');


        $data['is_insert']  = $is_insert;
        $data['cid']      = $cid;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
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
        $data['plugins'] 	= array('validation'); //page plugins

//		************************************************************* ____END____ *********************************************************************************
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
        $views=  array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view($views, $data);
    }



    /**********************
     * Add User
     * access public
     * @params
     * return view
     *********************************/
    public function users_add(){
        //		************************************************************* ____START____ **********************************************************************************

        $UriArray = $this->uri->uri_to_assoc(2);
        $is_insert= true;
        $app_config = $this->config->config;
        $cid= '';
        if ( !empty($UriArray['clients-view']) and $this->common_lib->is_positive_integer($UriArray['clients-view'])  ) {
            $is_insert= false;
            $cid= $UriArray['clients-view'];
        }
        $post_array = $this->input->post();

        $page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/clients-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
        $data['client_phone_type_array']= $this->clients_mdl->getClientPhoneTypeArray();
        $data['client_color_schemes'] = $this->config->item('client_color_schemes');


        $data['is_insert']  = $is_insert;
        $data['cid']      = $cid;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
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
        $data['plugins'] 	= array('validation'); //page plugins

//		************************************************************* ____END____ *********************************************************************************
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
        $views=  array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view($views, $data);
    }

    /**********************
     * view  user job (title)
     * access public
     * @params
     * return view
     *********************************/
    public function users_jobs(){
        //		************************************************************* ____START____ **********************************************************************************

        $UriArray = $this->uri->uri_to_assoc(2);
        $is_insert= true;
        $app_config = $this->config->config;
        $cid= '';
        if ( !empty($UriArray['clients-view']) and $this->common_lib->is_positive_integer($UriArray['clients-view'])  ) {
            $is_insert= false;
            $cid= $UriArray['clients-view'];
        }
        $post_array = $this->input->post();

        $page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/clients-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
        $data['client_phone_type_array']= $this->clients_mdl->getClientPhoneTypeArray();
        $data['client_color_schemes'] = $this->config->item('client_color_schemes');


        $data['is_insert']  = $is_insert;
        $data['cid']      = $cid;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
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
        $data['plugins'] 	= array('validation'); //page plugins

//		************************************************************* ____END____ *********************************************************************************
        $data['meta_description']='';
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;

        $data['jobs']= $this->admin_mdl->get_jobs();


        $data['page']		='users/users-jobs';
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array(); //page javascript
        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view($views, $data);
    }


    /**********************
     * view  user role(group)
     * access public
     * @params
     * return view
     *********************************/
    public function users_role(){
        //		************************************************************* ____START____ **********************************************************************************

        $UriArray = $this->uri->uri_to_assoc(2);
        $is_insert= true;
        $app_config = $this->config->config;
        $cid= '';
        if ( !empty($UriArray['clients-view']) and $this->common_lib->is_positive_integer($UriArray['clients-view'])  ) {
            $is_insert= false;
            $cid= $UriArray['clients-view'];
        }
        $post_array = $this->input->post();

        $page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/clients-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
        $data['client_phone_type_array']= $this->clients_mdl->getClientPhoneTypeArray();
        $data['client_color_schemes'] = $this->config->item('client_color_schemes');


        $data['is_insert']  = $is_insert;
        $data['cid']      = $cid;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
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
        $data['plugins'] 	= array('validation'); //page plugins

//		************************************************************* ____END____ *********************************************************************************
        $data['meta_description']='';
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;

        $data['groups']		= $this->admin_mdl->get_groups();

        $data['page']		='users/users-role';
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array(); //page javascript
        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view($views, $data);
    }

    /**********************
     * view and add Client Types
     * access public
     * @params
     * return view
     *********************************/
    public function clients_type(){
        //		************************************************************* ____START____ **********************************************************************************

        $UriArray = $this->uri->uri_to_assoc(2);
        $is_insert= true;
        $app_config = $this->config->config;
        $cid= '';
        if ( !empty($UriArray['clients-view']) and $this->common_lib->is_positive_integer($UriArray['clients-view'])  ) {
            $is_insert= false;
            $cid= $UriArray['clients-view'];
        }
        $post_array = $this->input->post();

        $page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/clients-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
        $data['client_phone_type_array']= $this->clients_mdl->getClientPhoneTypeArray();
        $data['client_color_schemes'] = $this->config->item('client_color_schemes');


        $data['is_insert']  = $is_insert;
        $data['cid']      = $cid;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
        $data['group'] 		= $this->group->name;
        $client= '';
        $data['validation_errors_text'] = '';
        // Commented by BBITS Dev to add client type. It is setting validation rule for another fields.
        //H//$this->client_edit_form_validation($is_insert, $cid);
        $this->client_type_add_form_validation($is_insert, $cid);
        if (!empty($_POST)) {
            $validation_status = $this->form_validation->run();
            if ($validation_status != FALSE) {
                //echo "here we are... in validation if";
                //$this->client_edit_makesave($is_insert, $cid, $data['select_on_update'], $redirect_url, $page_parameters_with_sort, $post_array, $app_config, $data['client_color_schemes'] );
                if (isset($_POST['ajaxpost'])){
                    $this->admin_lib->client_type_add();
                    return true;
                }
            } else {
                //echo "here we are... in validation else";
                if (isset($_POST['data'])): //SHOW ERRORS ON POST
                    foreach($_POST['data'] as $key=>$value){
                        echo  form_error('data['.$key.']');
                        //$data['validation_errors_text'] = form_error('data['.$key.']');
                    }
                endif;
                $client = $this->client_edit_fill_current_data( $client, $is_insert, $cid );
                //$data['validation_errors_text'] = validation_errors( /*$layout_config['backend_error_icon_start'], $layout_config['backend_error_icon_end']*/ );
            }
        }
        else {
            $client		= $this->clients_mdl->getRowById( $this->uri->segment(3), array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );
        }
        $data['client']		= $client;
        $data['page_parameters_with_sort']= $page_parameters_with_sort;
        $data['page_parameters_without_sort']= $page_parameters_without_sort;
        $data['plugins'] 	= array('validation'); //page plugins

//		************************************************************* ____END____ *********************************************************************************

        $data['meta_description']='';
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
//		$data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;

        $data['client_types']= $this->admin_mdl->get_client_types();


        $data['page']		='clients/clients-types';
        $data['plugins'] 	= array('validation');
        $data['javascript'] = array( 'assets/custom/admin/client-type-add-validation.js');
        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view($views, $data);
    }

    /**********************
     * view and add Contact Types
     * access public
     * @params
     * return view
     *********************************/
    public function manage_client_type(){

        //		************************************************************* ____START____ **********************************************************************************
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
        $data['page']		='clients/manage_client_type';
        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view( $views,$data);
    }

    /**********************
     * view and add Contact Types
     * access public
     * @params
     * return view
     *********************************/
    public function contact_type(){
        //		************************************************************* ____START____ **********************************************************************************

        $UriArray = $this->uri->uri_to_assoc(2);
        $is_insert= true;
        $app_config = $this->config->config;
        $cid= '';
        if ( !empty($UriArray['clients-view']) and $this->common_lib->is_positive_integer($UriArray['clients-view'])  ) {
            $is_insert= false;
            $cid= $UriArray['clients-view'];
        }
        $post_array = $this->input->post();

        $page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/clients-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
        $data['client_phone_type_array']= $this->clients_mdl->getClientPhoneTypeArray();
        $data['client_color_schemes'] = $this->config->item('client_color_schemes');


        $data['is_insert']  = $is_insert;
        $data['cid']      = $cid;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
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
        $data['plugins'] 	= array('validation'); //page plugins

//		************************************************************* ____END____ *********************************************************************************

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
        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php' );
        $this->layout->view($views, $data);
    }  
	/**********************
     * view and add Contact Types
     * access public
     * @params
     * return view
     *********************************/
    public function signup(){
        //		************************************************************* ____START____ **********************************************************************************/

        $data['page']		='signup/signup';
        $views				= array('','','design/page','', '' );
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
        //		************************************************************* ____START____ **********************************************************************************

        $UriArray = $this->uri->uri_to_assoc(2);
        $is_insert= true;
        $app_config = $this->config->config;
        $cid= '';
        if ( !empty($UriArray['clients-view']) and $this->common_lib->is_positive_integer($UriArray['clients-view'])  ) {
            $is_insert= false;
            $cid= $UriArray['clients-view'];
        }
        $post_array = $this->input->post();

        $page_parameters_with_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->clientsPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/clients-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');
        $data['client_status_array']= $this->clients_mdl->getClientStatusValueArray(false);
        $data['user_status_array']= $this->clients_mdl->getUserStatusValueArray(true);
        $data['client_phone_type_array']= $this->clients_mdl->getClientPhoneTypeArray();
        $data['client_color_schemes'] = $this->config->item('client_color_schemes');


        $data['is_insert']  = $is_insert;
        $data['cid']      = $cid;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
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
        $data['plugins'] 	= array('validation'); //page plugins

//		************************************************************* ____END____ *********************************************************************************

        $this->common_lib->activity_log($this->menu,$this->user, $this->group->name,TRUE);
    }

    public function client_change_status(){
        $client_id=$_POST["id"];
        $status =$_POST["status"];
        $arr_status=[
            'Pending'=>'P',
            'Active'=>'A',
            'Inactive'=>'I'
        ];
        $this->db->update($this->clients_mdl->m_clients_table, array('client_status'=>$arr_status[$status]), array('cid' => $client_id));
        exit;


    }


}

function cmpGroups($a, $b)
{
    if ( $a['value'] == 'Super User' ) return -1;
    if ($a['value'] == $b['value']) {
        return 0;
    }
    return ($a['value'] < $b['value']) ? -1 : 1;
}