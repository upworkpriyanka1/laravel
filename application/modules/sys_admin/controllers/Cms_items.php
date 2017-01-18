<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_items extends CI_Controller
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
		$this->load->model('cms_items_mdl');
		$this->lang->load('sys_admin');
		$this->config->load('sys_admin_menu', true);
		$this->menu = $this->config->item('sys_admin_menu');

		$this->user = $this->common_mdl->get_admin_user();
		if ( $this->user->user_active_status != 'A' ) { // Only active user can access admin pages
			redirect( base_url() . "login/logout" );
		}
		$this->group = $this->ion_auth->get_users_groups()->row();
	}


	////////////// CMS ITEMS BLOCK START /////////////
	/**********************
	 * view cms_items
	 * access public
	 * @params
	 * return view
	 *********************************/
	public function cms_items_view(){
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
		$filter_ci_title = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_ci_title');
		$filter_ci_alias = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_ci_alias');
		$filter_ci_page_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_ci_page_type');
		$filter_ci_published = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_ci_published');
		$filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
		$filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
		$filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
		$filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till);

		$page_parameters_with_sort = $this->cms_itemsPreparePageParameters($UriArray, $post_array, false, true);     // keep all sorting parameters for using in sorting
		$page_parameters_without_sort = $this->cms_itemsPreparePageParameters($UriArray, $post_array, false, false); // by column header or at editor submitting to keep current filters

		$this->load->library('pagination');
		$pagination_config= $this->common_lib->getPaginationParams();
		$pagination_config['base_url'] = base_url() . 'sys-admin/cms_items/cms_items-view' . $page_parameters_with_sort . '/page_number';

		$rows_in_table= $this->cms_items_mdl->getCms_itemsList(true, '', array( 'ci_title'=> $filter_ci_title, 'ci_alias'=> $filter_ci_alias, 'ci_page_type'=> $filter_ci_page_type, 'ci_published'=> $filter_ci_published, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );  // get number of rows by given parameters
		$pagination_config['total_rows'] = $rows_in_table;
		$this->pagination->initialize($pagination_config);  // pagination system initialization by parameters in config file
		$data['cms_items']= array();
		if ($rows_in_table > 0) { // number of rows by given parameters > 0 - get rows by given parameters for given $page_number.
			$data['cms_items']= $this->cms_items_mdl->getCms_itemsList(false, $page_number, array( 'show_client_type_description'=>1, 'ci_title'=> $filter_ci_title, 'ci_alias'=> $filter_ci_alias, 'ci_page_type'=> $filter_ci_page_type, 'ci_published'=> $filter_ci_published, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );
		} // IMPORTANT : all filter parameters must be similar as in calling of getCms_itemsList above

		$data['page']		= 'cms_items/cms_items-view';
		$data['page_number']		= $page_number;
		$data['RowsInTable']= $rows_in_table;
		$data['editor_message']= $this->session->flashdata('editor_message');
		$data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');
		$data['cms_item_PageTypeSelectionList']= $this->cms_items_mdl->getCms_ItemPage_TypeValueArray();
		$data['cms_item_PublishedSelectionList']= $this->cms_items_mdl->getCms_ItemPublishedValueArray();
		$data['filter_ci_title']= $filter_ci_title;
		$data['filter_ci_alias']= $filter_ci_alias;
		$data['filter_ci_page_type']= $filter_ci_page_type;
		$data['filter_ci_published']= $filter_ci_published;
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
		$filters_label_array= array('ci_title'=> $filter_ci_title, 'ci_alias'=> $filter_ci_alias, 'ci_page_type'=> $filter_ci_page_type, 'ci_published'=> $filter_ci_published, 'created at from'=> $filter_created_at_from, 'created at till'=>$filter_created_at_till);

		$filters_label= $this->common_lib->get_filters_label( $filters_label_array, '<br>' );
		$data['filters_label'] = $filters_label;
		$data['plugins'] 	= array();
		$data['pagination_links'] 	= $pagination_links;
		$data['javascript'] = array( 'assets/custom/admin/cms_items.js', 'assets/global/plugins/picker/classic.js', 'assets/global/plugins/picker/classic.date.js', 'assets/global/plugins/picker/picker.time.js');

		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}



	/**********************
	 * Edit cms_items
	 * access public
	 * @params usr_segment->3 (cms_items id)
	 * return view
	 *********************************/
	public function cms_items_edit()
	{
		$UriArray = $this->uri->uri_to_assoc(3);
		$is_insert= true;
		$app_config = $this->config->config;
		$ci_id= '';
		if ( !empty($UriArray['cms_items-edit']) and $this->common_lib->is_positive_integer($UriArray['cms_items-edit'])  ) {
			$is_insert= false;
			$ci_id= $UriArray['cms_items-edit'];
		}
		$post_array = $this->input->post();
		$sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
		$sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
		$page_number = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page_number', 1);
		$filter_ci_title = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_ci_title');
		$filter_ci_alias = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_ci_alias');
		$filter_ci_page_type = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_ci_page_type');
		$filter_ci_published = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_ci_published');
		$filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
		$filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
		$filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
		$filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016
		$data['filter_ci_title']= $filter_ci_title;
		$data['filter_ci_alias']= $filter_ci_alias;
		$data['filter_ci_page_type']= $filter_ci_page_type;
		$data['filter_ci_published']= $filter_ci_published;
		$data['filter_created_at_from']= $filter_created_at_from;
		$data['filter_created_at_till']= $filter_created_at_till;
		$data['filter_created_at_from_formatted']= $filter_created_at_from_formatted;
		$data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;
		$data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;

		$page_parameters_with_sort = $this->cms_itemsPreparePageParameters($UriArray, $post_array, false, true);
		$page_parameters_without_sort = $this->cms_itemsPreparePageParameters($UriArray, $post_array, false, false);
		$redirect_url = base_url() . 'sys-admin/cms_items/cms_items-view' . $page_parameters_with_sort;

		$data['meta_description']='';
		$data['editor_message']= $this->session->flashdata('editor_message');
		$data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');
		$data['cms_item_PageTypeSelectionList']= $this->cms_items_mdl->getCms_ItemPage_TypeValueArray();
		$data['cms_item_PublishedSelectionList']= $this->cms_items_mdl->getCms_ItemPublishedValueArray();

		$data['is_insert']  = $is_insert;
		$data['ci_id']      = $ci_id;
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;
		$cms_item= '';
		$data['validation_errors_text'] = '';
		$this->cms_item_edit_form_validation($is_insert, $ci_id);
		if (!empty($_POST)) {
			$validation_status = $this->form_validation->run();
			if ($validation_status != FALSE) {
				$this->cms_item_edit_makesave($is_insert, $ci_id, $data['select_on_update'], $redirect_url, $page_parameters_with_sort, $post_array, $app_config );
			} else {
				$cms_item = $this->cms_item_edit_fill_current_data( $cms_item, $is_insert, $ci_id );
				$data['validation_errors_text'] = validation_errors( /*$layout_config['backend_error_icon_start'], $layout_config['backend_error_icon_end']*/ );
			}
		}
		else {
			$cms_item= $this->cms_items_mdl->getCms_itemRowById( $ci_id );
		}


		$data['cms_item']		= $cms_item;
		$data['page_parameters_with_sort']= $page_parameters_with_sort;
		$data['page_parameters_without_sort']= $page_parameters_without_sort;
		$data['page']		= 'cms_items/cms_items-edit'; //page view to load
		$data['plugins'] 	= array('validation'); //page plugins
		$data['javascript'] = array( 'assets/custom/admin/cms_item-edit.js', 'assets/apps/scripts/ckeditor/ckeditor.js' );

		$views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

	public function cms_item_check_ci_title_is_unique()
	{
		$ci_title = $this->input->post('data[ci_title]', '');
		if (empty($ci_title)) {
			$this->form_validation->set_message('cms_item_check_ci_title_is_unique', " The ".lang('ci_title')." field is required ! ");
			return FALSE;
		}
		$ci_id = $this->input->post('data[ci_id]', 0);
		if ( $ci_id == 'new' ) $ci_id= 0;
		$similarCms_item= $this->cms_items_mdl->getSimilarCms_itemByCi_Title( $ci_title, $ci_id );
		if (!empty($similarCms_item)) {
			$this->form_validation->set_message('cms_item_check_ci_title_is_unique', lang('ci_title') . " '".$ci_title."' must be unique ! ");
			return FALSE;
		}
		return TRUE;
	}

	public function cms_item_check_ci_alias_is_unique()
	{
		$ci_alias = $this->input->post('data[ci_alias]', '');
		if (empty($ci_alias)) {
			$this->form_validation->set_message('cms_item_check_ci_alias_is_unique', " The ".lang('ci_alias')." field is required ! ");
			return FALSE;
		}
		$ci_id = $this->input->post('data[ci_id]', 0);
		if ( $ci_id == 'new' ) $ci_id= 0;
		$similarCms_item= $this->cms_items_mdl->getSimilarCms_itemByCi_Alias( $ci_alias, $ci_id );
		if (!empty($similarCms_item)) {
			$this->form_validation->set_message('cms_item_check_ci_alias_is_unique', lang('ci_alias') . " '".$ci_alias."' must be unique ! ");
			return FALSE;
		}
		return TRUE;
	}

	private function cms_item_edit_fill_current_data($cms_item, $is_insert, $ci_id)
	{
		$cms_item = new stdClass;
		$cms_item->ci_id = $ci_id;
		$cms_item->ci_title = set_value('data[ci_title]');
		$cms_item->ci_alias = set_value('data[ci_alias]');
		$cms_item->ci_short_descr = set_value('data[ci_short_descr]');
		$cms_item->ci_content = set_value('data[ci_content]');
		$cms_item->ci_page_type = set_value('data[ci_page_type]');
		$cms_item->ci_published = set_value('data[ci_published]');
		return $cms_item;
	}


	private function cms_item_edit_form_validation($is_insert, $ci_id)
	{
		$this->form_validation->set_rules( 'data[ci_title]', lang('ci_title'), 'callback_cms_item_check_ci_title_is_unique' );
		$this->form_validation->set_rules( 'data[ci_alias]', lang('ci_alias'), 'callback_cms_item_check_ci_alias_is_unique' );
		$this->form_validation->set_rules( 'data[ci_short_descr]', lang('ci_short_descr'), '' );
		$this->form_validation->set_rules( 'data[ci_content]', lang('ci_content'), 'required' );
		$this->form_validation->set_rules( 'data[ci_page_type]', lang('ci_page_type'), 'required' );
		$this->form_validation->set_rules( 'data[ci_published]', lang('ci_published'), 'required' );
	}


	private function cms_item_edit_makesave($is_insert, $ci_id, $select_on_update, $redirect_url, $page_parameters_with_sort, $post_array, $app_config ) {
		$this->db->trans_start();
		$update_data= array( 'ci_title' => $post_array['data']['ci_title'], 'ci_alias' => $post_array['data']['ci_alias'],  'ci_short_descr' => $post_array['data']['ci_short_descr'],  'ci_content' => $post_array['data']['ci_content'], 'ci_page_type' => $post_array['data']['ci_page_type'] , 'ci_published' => $post_array['data']['ci_published'], 'ci_author_id'=> $this->user->id);
		if ( $is_insert ) {
			$this->db->insert($this->cms_items_mdl->m_cms_items_table, $update_data);
			$ci_id= $this->db->insert_id();
		} else {
			$this->db->where( $this->cms_items_mdl->m_cms_items_table . '.ci_id', $ci_id);
			$this->db->update($this->cms_items_mdl->m_cms_items_table, $update_data);
		}

		if ($select_on_update == 'reopen_editor') {
			$redirect_url = base_url() . 'sys-admin/cms_items/cms_items-edit/' . $ci_id . $page_parameters_with_sort;
		}
		if ($select_on_update == 'open_editor_for_new') {
			$redirect_url = base_url() . 'sys-admin/cms_items/cms_items-edit/new' . $page_parameters_with_sort;
		}

		if ($ci_id) {
			$this->session->set_flashdata('editor_message', lang('cms_item') . " '" . $post_array['data']['ci_title'] . "' was " . ($is_insert ? "inserted" : "updated") );
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
			} else {
				$this->db->trans_commit();
			}
			redirect($redirect_url);
			return;
		}

	}


	function remove_cms_items() {
		$this->load->model('cms_items_mdl', '', true);

		$UriArray = $this->uri->uri_to_assoc(4);
		$ci_id= $UriArray['ci_id'];
		$PageParametersWithSort = $this->cms_itemsPreparePageParameters($UriArray, null, false, true);
		$RedirectUrl = '/sys-admin/cms_items/cms_items_view' . $PageParametersWithSort;

		$removed_cms_item = $this->cms_items_mdl->getCms_itemRowById($ci_id);
		if (empty($removed_cms_item)) {
			$this->session->set_flashdata('editor_message', "cms item '" . $ci_id . "' not found");
			redirect($RedirectUrl);
			return;
		}

		$removed_cms_item_name= $removed_cms_item->ci_title;
		$this->db->trans_start();

		$ret = $this->cms_items_mdl->deleteCmsItem($ci_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->session->set_flashdata('editor_message', "Cms Item '" . $removed_cms_item_name . "' was deleted");
			$this->db->trans_commit();
		}
		if ($ret) {
			$this->session->set_flashdata('editor_message', "Cms Item '" . $removed_cms_item_name . "' was deleted");
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
	private function cms_itemsPreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort)
	{
		$ResStr = '';
		if (!empty($_post_array)) { // form was submitted
			if ($WithPage) {
				$page_number = $this->input->post('page_number');
				$ResStr .= !empty($page) ? 'page_number/' . $page_number . '/' : 'page_number/1/';
			}
			$filter_ci_title = $this->input->post('filter_ci_title');
			$ResStr .= !empty($filter_ci_title) ? 'filter_ci_title/' . $filter_ci_title . '/' : '';
			$filter_ci_alias = $this->input->post('filter_ci_alias');
			$ResStr .= !empty($filter_ci_alias) ? 'filter_ci_alias/' . $filter_ci_alias . '/' : '';
			$filter_ci_page_type = $this->input->post('filter_ci_page_type');
			$ResStr .= !empty($filter_ci_page_type) ? 'filter_ci_page_type/' . $filter_ci_page_type . '/' : '';
			$filter_ci_published = $this->input->post('filter_ci_published');
			$ResStr .= !empty($filter_ci_published) ? 'filter_ci_published/' . $filter_ci_published . '/' : '';
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
			$ResStr .= !empty($UriArray['filter_ci_title']) ? 'filter_ci_title/' . $UriArray['filter_ci_title'] . '/' : '';
			$ResStr .= !empty($UriArray['filter_ci_alias']) ? 'filter_ci_alias/' . $UriArray['filter_ci_alias'] . '/' : '';
			$ResStr .= !empty($UriArray['filter_ci_page_type']) ? 'filter_ci_page_type/' . $UriArray['filter_ci_page_type'] . '/' : '';
			$ResStr .= !empty($UriArray['filter_ci_published']) ? 'filter_ci_published/' . $UriArray['filter_ci_published'] . '/' : '';
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


	////////////// CMS ITEM BLOCK END /////////////

}