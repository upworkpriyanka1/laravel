<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends CI_Controller
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
        $this->load->model('vendors_mdl');
        $this->lang->load('sys_admin');
        $this->config->load('sys_admin_menu', true);
        $this->menu = $this->config->item('sys_admin_menu');

        $this->user = $this->common_mdl->get_admin_user();
	    if ( $this->user->user_active_status != 'A' ) { // Only active user can access admin pages
		    redirect( base_url() . "login/logout" );
	    }
        $this->group = $this->ion_auth->get_users_groups()->row();
//        $this->job = $this->common_mdl->get_users_jobs()->row();
    }

    ////////////// VENDORS-TYPES BLOCK START /////////////

    /**********************
     * view vendor_types
     * access public
     * @params
     * return view
     *********************************/
    public function vendor_types_view(){
        $data['meta_description']='';
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
//        $data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;

        $UriArray = $this->uri->uri_to_assoc(4);
        $post_array = $this->input->post();

        /* get and keep all filters/page_number for pagination and sorting parameters*/
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
        $page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
        $filter_vt_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_vt_name');
        $filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
        $filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
        $filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
        $filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till);

        $page_parameters_with_sort = $this->vendorTypesPreparePageParameters($UriArray, $post_array, false, true);     // keep all sorting parameters for using in sorting
        $page_parameters_without_sort = $this->vendorTypesPreparePageParameters($UriArray, $post_array, false, false); // by column header or at editor submitting to keep current filters

        $this->load->library('pagination');
        $pagination_config= $this->common_lib->getPaginationParams();
        $pagination_config['base_url'] = base_url() . 'sys-admin/vendors/vendor-types-view' . $page_parameters_with_sort . '/page_number';

        $rows_in_table= $this->vendors_mdl->getVendor_TypesList(true, '', array( 'vt_name'=> $filter_vt_name, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );  // get number of rows by given parameters
        $pagination_config['total_rows'] = $rows_in_table;
        $this->pagination->initialize($pagination_config);  // pagination system initialization by parameters in config file
        $data['vendor_types']= array();
        if ($rows_in_table > 0) { // number of rows by given parameters > 0 - get rows by given parameters for given $page_number.
            $data['vendor_types']= $this->vendors_mdl->getVendor_TypesList(false, $page_number, array( 'show_client_type_description'=>1, 'show_vendors_count'=> 1, 'vt_name'=> $filter_vt_name, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );
        } // IMPORTANT : all filter parameters must be similar as in calling of getVendor_TypesList above

//	    echo '<pre>$data[\'vendor_types\']::'.print_r($data['vendor_types'],true).'</pre>';
//	    die("-1 XXZ");
        $data['page']		= 'vendor-types/vendor-types-view';
        $data['page_number']		= $page_number;
        $data['RowsInTable']= $rows_in_table;
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['filter_vt_name']= $filter_vt_name;
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
        $filters_label_array= array('vt_name'=> $filter_vt_name, 'created at from'=> $filter_created_at_from, 'created at till'=>$filter_created_at_till);

        $filters_label= $this->common_lib->get_filters_label( $filters_label_array, '<br>' );
        $data['filters_label'] = $filters_label;
        $data['plugins'] 	= array();
        $data['pagination_links'] 	= $pagination_links;
//        $data['javascript'] = array( 'assets/custom/admin/vendor-types.js', 'assets/global/plugins/picker/picker.js', 'assets/global/plugins/picker/picker.date.js', 'assets/global/plugins/picker/picker.time.js');
	    $data['javascript'] = array( 'assets/custom/admin/vendor-types.js', 'assets/global/plugins/picker/classic.js', 'assets/global/plugins/picker/classic.date.js', 'assets/global/plugins/picker/picker.time.js');

	    $views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
        $this->layout->view($views, $data);
    }



    /**********************
     * Edit vendor_types
     * access public
     * @params usr_segment->3 (vendor_types id)
     * return view
     *********************************/
    public function vendor_types_edit()
    {
        $UriArray = $this->uri->uri_to_assoc(3);
        $is_insert= true;
        $app_config = $this->config->config;
        $vt_id= '';
        if ( !empty($UriArray['vendor-types-edit']) and $this->common_lib->is_positive_integer($UriArray['vendor-types-edit'])  ) {
            $is_insert= false;
            $vt_id= $UriArray['vendor-types-edit'];
        }
        $post_array = $this->input->post();
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
        $page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
        $filter_vt_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_vt_name');
        $filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
        $filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
        $filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
        $filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016
        $data['filter_vt_name']= $filter_vt_name;
        $data['filter_created_at_from']= $filter_created_at_from;
        $data['filter_created_at_till']= $filter_created_at_till;
        $data['filter_created_at_from_formatted']= $filter_created_at_from_formatted;
        $data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;
        $data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;

        $page_parameters_with_sort = $this->vendorTypesPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->vendorTypesPreparePageParameters($UriArray, $post_array, false, false);
//        echo '<pre>$page_parameters_with_sort::'.print_r($page_parameters_with_sort,true).'</pre>';
        $redirect_url = base_url() . 'sys-admin/vendors/vendor-types-view' . $page_parameters_with_sort;


        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');

        $data['is_insert']  = $is_insert;
        $data['vt_id']      = $vt_id;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
//        $data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;
        $vendor_types= '';
        $data['validation_errors_text'] = '';
        $this->vendor_types_edit_form_validation($is_insert, $vt_id);
        if (!empty($_POST)) {
            $validation_status = $this->form_validation->run();
            if ($validation_status != FALSE) {
                $this->vendor_types_edit_makesave($is_insert, $vt_id, $data['select_on_update'], $redirect_url, $page_parameters_with_sort, $post_array, $app_config );
            } else {
                $vendor_types = $this->vendor_type_edit_fill_current_data($vendor_types, $is_insert, $vt_id );
                $data['validation_errors_text'] = validation_errors( /*$layout_config['backend_error_icon_start'], $layout_config['backend_error_icon_end']*/ );
            }
        }
        else {
            $vendor_types= $this->vendors_mdl->getVendor_TypeRowById( $vt_id );
        }

        $data['vendor_types']		= $vendor_types;
        $data['page_parameters_with_sort']= $page_parameters_with_sort;
        $data['page_parameters_without_sort']= $page_parameters_without_sort;
        $data['page']		= 'vendor-types/vendor-types-edit'; //page view to load
        $data['plugins'] 	= array('validation'); //page plugins
        $data['javascript'] = array( 'assets/custom/admin/vendor-types-edit.js' );//page javascript
        $views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
        $this->layout->view($views, $data);
    }

    public function vendor_types_check_vt_name_is_unique()
    {
        $vt_name = $this->input->post('data[vt_name]', '');
        if (empty($vt_name)) {
            $this->form_validation->set_message('vendor_types_check_vt_name_is_unique', " The ".lang('vendor-types')." field is required ! ");
            return FALSE;
        }
        $vt_id = $this->input->post('data[vt_id]', 0);
        if ( $vt_id == 'new' ) $vt_id= 0;
        $similarVendor_Type= $this->vendors_mdl->getSimilarVendor_TypeByVt_Name( $vt_name, $vt_id );
        if (!empty($similarVendor_Type)) {
            $this->form_validation->set_message('vendor_types_check_vt_name_is_unique', lang('vendor-types') . " '".$vt_name."' must be unique ! ");
            return FALSE;
        }
        return TRUE;
    }

    private function vendor_type_edit_fill_current_data($vendor_types, $is_insert, $vt_id)
    {
        $vendor_types = new stdClass;
        $vendor_types->vt_id = $vt_id;
        $vendor_types->vt_name = set_value('data[vt_name]');
        $vendor_types->vt_description = set_value('data[vt_description]');
        return $vendor_types;
    }


    private function vendor_types_edit_form_validation($is_insert, $vt_id)
    {
        $this->form_validation->set_rules( 'data[vt_name]', lang('vendor-types'), 'callback_vendor_types_check_vt_name_is_unique' );
        $this->form_validation->set_rules( 'data[vt_description]', lang('vt_description'), '' );
    }

    private function vendor_types_edit_makesave($is_insert, $vt_id, $select_on_update, $redirect_url, $page_parameters_with_sort, $post_array, $app_config ) {


        $this->db->trans_start();
        $update_data= array( 'vt_name' => $post_array['data']['vt_name'], 'vt_description' => $post_array['data']['vt_description'] );
        if ( $is_insert ) {
            $this->db->insert($this->vendors_mdl->m_vendor_types_table, $update_data);
            $vt_id= $this->db->insert_id();
        } else {
            $this->db->where( $this->vendors_mdl->m_vendor_types_table . '.vt_id', $vt_id);
            $this->db->update($this->vendors_mdl->m_vendor_types_table, $update_data);
        }
        if ($select_on_update == 'reopen_editor') {
            $redirect_url = base_url() . 'sys-admin/vendors/vendor-types-edit/' . $vt_id . $page_parameters_with_sort;
        }
        if ($select_on_update == 'open_editor_for_new') {
            $redirect_url = base_url() . 'sys-admin/vendors/vendor-types-edit/new' . $page_parameters_with_sort;
        }

        if ($vt_id) {
            $this->session->set_flashdata('editor_message', lang('vendor-types') . " '" . $post_array['data']['vt_name'] . "' was " . ($is_insert ? "inserted" : "updated") );
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            redirect($redirect_url);
            return;
        }

    }

	function remove_vendor_types($id = 0) {
		$this->load->model('vendors_mdl', '', true);

		$UriArray = $this->uri->uri_to_assoc(4);
		$id= $UriArray['id'];
		$PageParametersWithSort = $this->vendorTypesPreparePageParameters($UriArray, null, false, true);
		$RedirectUrl = '/sys-admin/vendors/vendor_types_view' . $PageParametersWithSort;

		$removed_vendor_types = $this->vendors_mdl->getVendor_TypeRowById($id);
		if (empty($removed_vendor_types)) {
			$this->session->set_flashdata('editor_message', "Vendor '" . $id . "' not found");
			redirect($RedirectUrl);
			return;
		}
		$removed_vendor_types_name = $removed_vendor_types->vt_name;

		$vendors_count = $this->vendors_mdl->getVendorsList(true, '', array('vendor_type_id' => $id), '', '');
		if ($vendors_count > 0) {
			$this->session->set_flashdata('editor_message', "Vendor type '" . $removed_vendor_types_name . "' can not be deleted, as " . $vendors_count . ' vendor' . ($vendors_count > 1 ? 's' : '') . ' use this vendor type.');
			redirect($RedirectUrl);
			return;
		}

		$this->db->trans_start();

		$ret = $this->vendors_mdl->deleteVendor_Type($id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->session->set_flashdata('editor_message', "Vendor Type '" . $removed_vendor_types_name . "' was deleted");
			$this->db->trans_commit();
		}
		if ($ret) {
			$this->session->set_flashdata('editor_message', "Vendor Type '" . $removed_vendor_types_name . "' was deleted");
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
    private function vendorTypesPreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort)
    {
        $ResStr = '';
        if (!empty($_post_array)) { // form was submitted
            if ($WithPage) {
                $page_number = $this->input->post('page_number');
                $ResStr .= !empty($page) ? 'page_number/' . $page_number . '/' : 'page_number/1/';
            }
            $filter_vt_name = $this->input->post('filter_vt_name');
            $ResStr .= !empty($filter_vt_name) ? 'filter_vt_name/' . $filter_vt_name . '/' : '';
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
            $ResStr .= !empty($UriArray['filter_vt_name']) ? 'filter_vt_name/' . $UriArray['filter_vt_name'] . '/' : '';
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

    ////////////// VENDORS-TYPES BLOCK END /////////////


    ////////////// VENDORS BLOCK START /////////////
    /**********************
     * view vendors
     * access public
     * @params
     * return view
     *********************************/
    public function vendors_view(){
        $data['meta_description']='';
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
//        $data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;
        $UriArray = $this->uri->uri_to_assoc(4);
        $post_array = $this->input->post();

        /* get and keep all filters/page_number for pagination and sorting parameters*/
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
        $page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
        $filter_vn_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_vn_name');
        $filter_vendor_type_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_vendor_type_id');
        $filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
        $filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
        $filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
        $filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till);

        $page_parameters_with_sort = $this->vendorsPreparePageParameters($UriArray, $post_array, false, true);     // keep all sorting parameters for using in sorting
        $page_parameters_without_sort = $this->vendorsPreparePageParameters($UriArray, $post_array, false, false); // by column header or at editor submitting to keep current filters

        $this->load->library('pagination');
        $pagination_config= $this->common_lib->getPaginationParams();
        $pagination_config['base_url'] = base_url() . 'sys-admin/vendors/vendors-view' . $page_parameters_with_sort . '/page_number';

        $rows_in_table= $this->vendors_mdl->getVendorsList(true, '', array( 'vn_name'=> $filter_vn_name, 'vendor_type_id'=> $filter_vendor_type_id, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );  // get number of rows by given parameters
        $pagination_config['total_rows'] = $rows_in_table;
        $this->pagination->initialize($pagination_config);  // pagination system initialization by parameters in config file
        $data['vendors']= array();
        if ($rows_in_table > 0) { // number of rows by given parameters > 0 - get rows by given parameters for given $page_number.
            $data['vendors']= $this->vendors_mdl->getVendorsList(false, $page_number, array( 'show_client_type_description'=>1, 'vn_name'=> $filter_vn_name, 'vendor_type_id'=> $filter_vendor_type_id, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );
        } // IMPORTANT : all filter parameters must be similar as in calling of getVendorsList above

//	    echo '<pre>$data[\'vendors\']::'.print_r($data['vendors'],true).'</pre>';
//	    die("-1 XXZ");
        $data['page']		= 'vendors/vendors-view';
        $data['page_number']		= $page_number;
        $data['RowsInTable']= $rows_in_table;
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');
        $data['vendor_TypesSelectionList']= $this->vendors_mdl->getVendorTypesSelectionList();

        $data['filter_vn_name']= $filter_vn_name;
        $data['filter_vendor_type_id']= $filter_vendor_type_id;
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
        $filters_label_array= array('vn_name'=> $filter_vn_name, 'vendor_type_id'=> $filter_vendor_type_id, 'created at from'=> $filter_created_at_from, 'created at till'=>$filter_created_at_till);

        $filters_label= $this->common_lib->get_filters_label( $filters_label_array, '<br>' );
        $data['filters_label'] = $filters_label;
        $data['plugins'] 	= array();
        $data['pagination_links'] 	= $pagination_links;
//        $data['javascript'] = array( 'assets/custom/admin/vendors.js', 'assets/global/plugins/picker/picker.js', 'assets/global/plugins/picker/picker.date.js', 'assets/global/plugins/picker/picker.time.js'); // add picker.date pluging for date selection in fileters form
	    $data['javascript'] = array( 'assets/custom/admin/vendor-types.js', 'assets/global/plugins/picker/classic.js', 'assets/global/plugins/picker/classic.date.js', 'assets/global/plugins/picker/picker.time.js');

	    $views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
        $this->layout->view($views, $data);
    }



    /**********************
     * Edit vendors
     * access public
     * @params usr_segment->3 (vendors id)
     * return view
     *********************************/
    public function vendors_edit()
    {
        $UriArray = $this->uri->uri_to_assoc(3);
        $is_insert= true;
        $app_config = $this->config->config;
        $vn_id= '';
        if ( !empty($UriArray['vendors-edit']) and $this->common_lib->is_positive_integer($UriArray['vendors-edit'])  ) {
            $is_insert= false;
            $vn_id= $UriArray['vendors-edit'];
        }
        $post_array = $this->input->post();
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
        $page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
        $filter_vn_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_vn_name');
        $filter_vendor_type_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_vendor_type_id');
        $filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
        $filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
        $filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
        $filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016
        $data['filter_vn_name']= $filter_vn_name;
        $data['filter_vendor_type_id']= $filter_vendor_type_id;
        $data['filter_created_at_from']= $filter_created_at_from;
        $data['filter_created_at_till']= $filter_created_at_till;
        $data['filter_created_at_from_formatted']= $filter_created_at_from_formatted;
        $data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;
        $data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;

        $page_parameters_with_sort = $this->vendorsPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->vendorsPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/vendors/vendors-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');
        $vendor_TypesSelectionList= $this->vendors_mdl->getVendorTypesSelectionList();

        $vendorHaveTypes = $this->vendors_mdl->getVendors_Have_TypesList( false, 0, array('vh_vendor_id'=> $vn_id) );
        if ( !$is_insert ) {
            foreach ($vendor_TypesSelectionList as $next_key => $next_vendor_types_selection) {
                foreach ($vendorHaveTypes as $next_vendor_have_type) {
                    if ($next_vendor_types_selection['key'] == $next_vendor_have_type->vh_vendor_type_id) {
                        $vendor_TypesSelectionList[$next_key]['checked'] = true;
                    }
                }
            }
        }
        $data['vendor_TypesSelectionList']  = $vendor_TypesSelectionList;
        $data['is_insert']  = $is_insert;
        $data['vn_id']      = $vn_id;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
//        $data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;
        $vendor= '';
        $data['validation_errors_text'] = '';
        $this->vendor_edit_form_validation($is_insert, $vn_id);
        if (!empty($_POST)) {
            $validation_status = $this->form_validation->run();
            if ($validation_status != FALSE) {
                $this->vendor_edit_makesave($is_insert, $vn_id, $data['select_on_update'], $redirect_url, $page_parameters_with_sort, $post_array, $app_config );
            } else {
                $vendor = $this->vendor_edit_fill_current_data( $vendor, $is_insert, $vn_id, $vendor_TypesSelectionList );
                foreach ($vendor_TypesSelectionList as $next_key => $next_vendor_types_selection) {
	                $is_found= false;

	                foreach ($_POST as $next_post_key=> $next_post_value) {
                        $a= preg_split('/cbx_vendor_type_/',$next_post_key );
                        if (count($a)==2) {
                            if ($next_vendor_types_selection['key'] == $a[1]) {
                                $vendor_TypesSelectionList[$next_key]['checked'] = true;
	                            $is_found= true;
                            }
                        }
                    }
	                if ( !$is_found ) {
		                $vendor_TypesSelectionList[$next_key]['checked'] = false;
	                }
                }
                $data['vendor_TypesSelectionList']  = $vendor_TypesSelectionList;
                $data['validation_errors_text'] = validation_errors( /*$layout_config['backend_error_icon_start'], $layout_config['backend_error_icon_end']*/ );
            }
        }
        else {
            $vendor= $this->vendors_mdl->getVendorRowById( $vn_id );
        }


        $data['vendor']		= $vendor;
        $data['page_parameters_with_sort']= $page_parameters_with_sort;
        $data['page_parameters_without_sort']= $page_parameters_without_sort;
        $data['page']		= 'vendors/vendors-edit'; //page view to load
        $data['plugins'] 	= array('validation'); //page plugins
        $data['javascript'] = array( 'assets/custom/admin/vendor-edit.js' );//page javascript
        $views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
        $this->layout->view($views, $data);
    }

    public function vendor_check_vn_name_is_unique()
    {
        $vn_name = $this->input->post('data[vn_name]', '');
        if (empty($vn_name)) {
            $this->form_validation->set_message('vendor_check_vn_name_is_unique', " The ".lang('vendor')." field is required ! ");
            return FALSE;
        }
        $vn_id = $this->input->post('data[vn_id]', 0);
        if ( $vn_id == 'new' ) $vn_id= 0;
        $similarVendor= $this->vendors_mdl->getSimilarVendorByVn_Name( $vn_name, $vn_id );
        if (!empty($similarVendor)) {
            $this->form_validation->set_message('vendor_check_vn_name_is_unique', lang('vendor') . " '".$vn_name."' must be unique ! ");
            return FALSE;
        }
        return TRUE;
    }

    public function vendor_check_vn_email_is_unique()
    {
        $vn_email = $this->input->post('data[vn_email]', '');
        if (empty($vn_email)) {
            $this->form_validation->set_message('vendor_check_vn_email_is_unique', " The ".lang('vendor')." field is required ! ");
            return FALSE;
        }
        $vn_id = $this->input->post('data[vn_id]', 0);
        if ( $vn_id == 'new' ) $vn_id= 0;
        $similarVendor= $this->vendors_mdl->getSimilarVendorByVn_Email( $vn_email, $vn_id );
        if (!empty($similarVendor)) {
            $this->form_validation->set_message('vendor_check_vn_email_is_unique', lang('vendor') . " '".$vn_email."' must be unique ! ");
            return FALSE;
        }
        return TRUE;
    }

    private function vendor_edit_fill_current_data($vendor, $is_insert, $vn_id, $vendor_TypesSelectionList)
    {
        $vendor = new stdClass;
        $vendor->vn_id = $vn_id;
        $vendor->vn_name = set_value('data[vn_name]');
        $vendor->vn_email = set_value('data[vn_email]');
        $vendor->vn_website = set_value('data[vn_website]');
        $vendor->vn_description = set_value('data[vn_description]');
        return $vendor;
    }


    private function vendor_edit_form_validation($is_insert, $vn_id)
    {
        $this->form_validation->set_rules( 'data[vn_name]', lang('vendor'), 'callback_vendor_check_vn_name_is_unique' );
        $this->form_validation->set_rules( 'data[vn_email]', lang('vn_email'), 'required|valid_email|callback_vendor_check_vn_email_is_unique' );
        $this->form_validation->set_rules( 'data[vn_website]', lang('vn_website'), 'required' );
        $this->form_validation->set_rules( 'data[vn_description]', lang('vn_description'), '' );
        $this->form_validation->set_rules( 'vendor_has_types_label', lang('vendor_has_types_label'), 'callback_vendors_have_types_label');
    }

    public function vendors_have_types_label($str)
    {
        foreach( $_POST as $next_key=>$next_value ) {
            $a= preg_split('/cbx_vendor_type_/',$next_key );
            if (count($a)==2) {
                return TRUE;
            }
        }
        $this->form_validation->set_message('vendors_have_types_label', 'Check at least 1 '.lang('vt_name').'!');
        return false;
    }


    private function vendor_edit_makesave($is_insert, $vn_id, $select_on_update, $redirect_url, $page_parameters_with_sort, $post_array, $app_config ) {
        $this->db->trans_start();
        $update_data= array( 'vn_name' => $post_array['data']['vn_name'],  'vn_email' => $post_array['data']['vn_email'],  'vn_website' => $post_array['data']['vn_website'], 'vn_description' => $post_array['data']['vn_description'] );
        if ( $is_insert ) {
            $this->db->insert($this->vendors_mdl->m_vendors_table, $update_data);
            $vn_id= $this->db->insert_id();
        } else {
            $this->db->where( $this->vendors_mdl->m_vendors_table . '.vn_id', $vn_id);
            $this->db->update($this->vendors_mdl->m_vendors_table, $update_data);
        }

        $vendor_have_types_array= array();
        foreach( $_POST as $next_key=>$next_value ) {
            $a= preg_split('/cbx_vendor_type_/',$next_key );
            if (count($a)==2) {
                $vendor_have_types_array[]= $a[1];
            }
        }
        $this->vendors_mdl->updateVendorHave_Types( $vn_id, $vendor_have_types_array );
        if ($select_on_update == 'reopen_editor') {
            $redirect_url = base_url() . 'sys-admin/vendors/vendors-edit/' . $vn_id . $page_parameters_with_sort;
        }
        if ($select_on_update == 'open_editor_for_new') {
            $redirect_url = base_url() . 'sys-admin/vendors/vendors-edit/new' . $page_parameters_with_sort;
        }

        if ($vn_id) {
            $this->session->set_flashdata('editor_message', lang('vendor') . " '" . $post_array['data']['vn_name'] . "' was " . ($is_insert ? "inserted" : "updated") );
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            redirect($redirect_url);
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
    private function vendorsPreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort)
    {
        $ResStr = '';
        if (!empty($_post_array)) { // form was submitted
            if ($WithPage) {
                $page_number = $this->input->post('page_number');
                $ResStr .= !empty($page) ? 'page_number/' . $page_number . '/' : 'page_number/1/';
            }
            $filter_vn_name = $this->input->post('filter_vn_name');
            $ResStr .= !empty($filter_vn_name) ? 'filter_vn_name/' . $filter_vn_name . '/' : '';
            $filter_vendor_type_id = $this->input->post('filter_vendor_type_id');
            $ResStr .= !empty($filter_vendor_type_id) ? 'filter_vendor_type_id/' . $filter_vendor_type_id . '/' : '';
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
            $ResStr .= !empty($UriArray['filter_vn_name']) ? 'filter_vn_name/' . $UriArray['filter_vn_name'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_vendor_type_id']) ? 'filter_vendor_type_id/' . $UriArray['filter_vendor_type_id'] . '/' : '';
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
     * for vendor load list of contacts
     * access public
     * @params : vendor_id - vendor id to upload contacts
     * return list vendor contacts
     *********************************/
    public function load_vendor_contacts()
    {
        $UriArray = $this->uri->uri_to_assoc(4);
        $post_array = $this->input->post();
        $vendor_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'vendor_id');

        $filters= array('vc_vendor_id'=>$vendor_id);
        $related_vendor_contacts_list = $this->vendors_mdl->getVendor_ContactsList( false, 0, $filters );
        $data = array('related_vendor_contacts_list' => $related_vendor_contacts_list, 'vc_vendor_id' => $vendor_id );
        $data['page']		= 'vendors/load_vendor_contacts'; //page view to load
        $data['plugins'] 	= array();
        $data['javascript'] = array();
        $data['related_vendor_contacts_list'] = $related_vendor_contacts_list;
        $views				= array(  'design/page'  );
        ob_start();
        $this->layout->view($views, $data);
        $html = ob_get_contents();
        ob_end_clean();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'vendor_id' => $vendor_id, 'html' => $html )));
    }


    public function save_related_vendor_contact()
    {
        $UriArray = $this->uri->uri_to_assoc(4);
        $post_array = $this->input->post();
        $vc_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'vc_id' );
        $vc_vendor_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'vc_vendor_id' );
        $vc_person_name = $this->common_lib->getParameter($this, $UriArray, $post_array, 'vc_person_name' );
        $vc_person_description = $this->common_lib->getParameter($this, $UriArray, $post_array, 'vc_person_description' );
        $vc_phone = $this->common_lib->getParameter($this, $UriArray, $post_array, 'vc_phone' );
        $vc_phone_description = $this->common_lib->getParameter($this, $UriArray, $post_array, 'vc_phone_description' );
        $vc_person_email = $this->common_lib->getParameter($this, $UriArray, $post_array, 'vc_person_email' );
        $vc_id = $this->vendors_mdl->updateVendorContact( $vc_id, array( 'vc_vendor_id'=> $vc_vendor_id, 'vc_person_name'=> $vc_person_name, 'vc_person_description'=> $vc_person_description, 'vc_phone'=> $vc_phone, 'vc_phone_description'=> $vc_phone_description, 'vc_person_email'=> $vc_person_email ) );
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'vc_id' => $vc_id )));
    }

    ////////////// VENDORS BLOCK END /////////////

}