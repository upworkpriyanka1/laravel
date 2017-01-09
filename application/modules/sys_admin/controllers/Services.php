<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $group = array('sys-admin');
        if (!$this->ion_auth->in_group($group)) {
            redirect('./');
        }
        if (!$this->ion_auth->in_group($group)) {
            echo "Not allowed";
            die();
        }
        $this->load->library('Sys_admin_lib', NULL, 'admin_lib');
        $this->load->model('sys_admin_mdl', 'admin_mdl');
        $this->load->model('vendors_mdl');
        $this->load->model('services_mdl');
        $this->lang->load('sys_admin');
        $this->config->load('sys_admin_menu', true);
        $this->menu = $this->config->item('sys_admin_menu');

        $this->user = $this->common_mdl->get_admin_user();
        $this->group = $this->ion_auth->get_users_groups()->row();
        $this->job = $this->common_mdl->get_users_jobs()->row();
    }


    ////////////// SERVICES BLOCK START /////////////
    /**********************
     * view services
     * access public
     * @params
     * return view
     *********************************/
    public function services_view(){
        $data['meta_description']='';
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
        $data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;
        $UriArray = $this->uri->uri_to_assoc(4);
        $post_array = $this->input->post();

        /* get and keep all filters/page for pagination and sorting parameters*/
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
        $page = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page', 1);
        $filter_sv_title = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_sv_title');
        $filter_vendor_type_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_vendor_type_id');
        $filter_active_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_active_status');
        $filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
        $filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
        $filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
        $filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till);

        $page_parameters_with_sort = $this->servicesPreparePageParameters($UriArray, $post_array, false, true);     // keep all sorting parameters for using in sorting
        $page_parameters_without_sort = $this->servicesPreparePageParameters($UriArray, $post_array, false, false); // by column header or at editor submitting to keep current filters

        $this->load->library('pagination');
        $pagination_config= $this->common_lib->getPaginationParams();
        $pagination_config['base_url'] = base_url() . 'sys-admin/services/services-view' . /*$page_parameters_with_sort .  */ '/page';

        $rows_in_table= $this->services_mdl->getServicesList(true, '', array( 'sv_title'=> $filter_sv_title, 'service_type_id'=> $filter_vendor_type_id,'active_status'=> $filter_active_status, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );  // get number of rows by given parameters
        $pagination_config['total_rows'] = $rows_in_table;
        $this->pagination->initialize($pagination_config);  // pagination system initialization by parameters in config file
        $data['services']= array();
        if ($rows_in_table > 0) { // number of rows by given parameters > 0 - get rows by given parameters for given $page.
            $data['services']= $this->services_mdl->getServicesList(false, $page, array( 'show_vendor_type_name'=>1, 'sv_title'=> $filter_sv_title, 'service_type_id'=> $filter_vendor_type_id, 'active_status'=> $filter_active_status, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );
        } // IMPORTANT : all filter parameters must be similar as in calling of getServicesList above
//die("-1 XXZ");
        $data['page']		= 'services/services-view';
        $data['page_number']		= $page;
        $data['RowsInTable']= $rows_in_table;
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');
        $data['vendor_TypesSelectionList']= $this->vendors_mdl->getVendorTypesSelectionList();
        $data['service_ActiveStatusList']= $this->services_mdl->getServiceActiveStatusValueArray();

        $data['filter_sv_title']= $filter_sv_title;
        $data['filter_vendor_type_id']= $filter_vendor_type_id;
        $data['filter_active_status']= $filter_active_status;
        $data['filter_created_at_from']= $filter_created_at_from;
        $data['filter_created_at_till']= $filter_created_at_till;
        $data['filter_created_at_from_formatted']= $filter_created_at_from_formatted;
        $data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;
        $data['page_parameters_with_sort']= $page_parameters_with_sort;
        $data['page_parameters_without_sort']= $page_parameters_without_sort;
        $data['sort_direction']= $sort_direction;
        $data['sort']= $sort;
        $this->pagination->suffix = $this->servicesPreparePageParameters($UriArray, $post_array, false, true);
        $this->pagination->cur_page= $page;
        $pagination_links = $this->pagination->create_links();

        // create label for current parameter so moving mouse over "Filter" button user can see current filters
        $filters_label_array= array('sv_title'=> $filter_sv_title, 'service_type_id'=> $filter_vendor_type_id, 'active_status'=> $filter_active_status, 'created at from'=> $filter_created_at_from, 'created at till'=>$filter_created_at_till);    //   $this->common_lib->get_service_active_status_label($row->sv_active_status)

        $filters_label= $this->common_lib->get_filters_label( $filters_label_array, '<br>' );
        $data['filters_label'] = $filters_label;
        $data['plugins'] 	= array();
        $data['pagination_links'] 	= $pagination_links;
        $data['javascript'] = array( 'assets/custom/admin/services.js', 'assets/global/plugins/picker/picker.js', 'assets/global/plugins/picker/picker.date.js', 'assets/global/plugins/picker/picker.time.js');
        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
        $this->layout->view($views, $data);
    }


    /**********************
     * Edit services
     * access public
     * @params usr_segment->3 (services id)
     * return view
     *********************************/
    public function services_edit()
    {
        $UriArray = $this->uri->uri_to_assoc(3);
        $is_insert= true;
        $app_config = $this->config->config;
        $sv_id= '';
        if ( !empty($UriArray['services-edit']) and $this->common_lib->is_positive_integer($UriArray['services-edit'])  ) {
            $is_insert= false;
            $sv_id= $UriArray['services-edit'];
        }
        $post_array = $this->input->post();
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction');
        $page = $this->common_lib->getParameter($this, $UriArray, $post_array, 'page', 1);
        $filter_sv_title = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_sv_title');
        $filter_vendor_type_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_vendor_type_id');
        $filter_active_status = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_active_status');
        $filter_created_at_from = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_from');
        $filter_created_at_till = $this->common_lib->getParameter($this, $UriArray, $post_array, 'filter_created_at_till');
        $filter_created_at_from_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_from);
        $filter_created_at_till_formatted= $this->common_lib->convertFromMySqlToCalendarFormat($filter_created_at_till); //2016-09-05 -> 5 September, 2016
        $data['filter_sv_title']= $filter_sv_title;
        $data['filter_vendor_type_id']= $filter_vendor_type_id;
        $data['filter_active_status']= $filter_active_status;
        $data['filter_created_at_from']= $filter_created_at_from;
        $data['filter_created_at_till']= $filter_created_at_till;
        $data['filter_created_at_from_formatted']= $filter_created_at_from_formatted;
        $data['filter_created_at_till_formatted']= $filter_created_at_till_formatted;

        $page_parameters_with_sort = $this->servicesPreparePageParameters($UriArray, $post_array, false, true);
        $page_parameters_without_sort = $this->servicesPreparePageParameters($UriArray, $post_array, false, false);
        $redirect_url = base_url() . 'sys-admin/services/services-view' . $page_parameters_with_sort;

        $data['meta_description']='';
        $data['editor_message']= $this->session->flashdata('editor_message');
        $data['select_on_update']= $this->common_lib->getParameter($this, $UriArray, $post_array, 'select_on_update');
        $data['vendor_TypesSelectionList']= $this->vendors_mdl->getVendorTypesSelectionList();
        $data['service_ActiveStatusList']= $this->services_mdl->getServiceActiveStatusValueArray();

        $data['is_insert']  = $is_insert;
        $data['sv_id']      = $sv_id;
        $data['menu']		= $this->menu;
        $data['user'] 		= $this->user;
        $data['job'] 		= $this->job;
        $data['group'] 		= $this->group->name;
        $service= '';
        $data['validation_errors_text'] = '';
        $this->service_edit_form_validation($is_insert, $sv_id);
        if (!empty($_POST)) {
            $validation_status = $this->form_validation->run();
            if ($validation_status != FALSE) {
                $this->service_edit_makesave($is_insert, $sv_id, $data['select_on_update'], $redirect_url, $page_parameters_with_sort, $post_array, $app_config );
            } else {
                $service = $this->service_edit_fill_current_data( $service, $is_insert, $sv_id );
                $data['validation_errors_text'] = validation_errors( /*$layout_config['backend_error_icon_start'], $layout_config['backend_error_icon_end']*/ );
            }
        }
        else {
            $service= $this->services_mdl->getServiceRowById( $sv_id );
        }


        $data['service']		= $service;
        $data['page_parameters_with_sort']= $page_parameters_with_sort;
        $data['page_parameters_without_sort']= $page_parameters_without_sort;
        $data['page']		= 'services/services-edit'; //page view to load
        $data['plugins'] 	= array('validation'); //page plugins
        $data['javascript'] = array( 'assets/custom/admin/service-edit.js', 'assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js','assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js', 'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js',  'assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js', 'assets/global/plugins/fancybox/source/jquery.fancybox.pack.js' );//page javascript

	    $views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
        $this->layout->view($views, $data);
    }

    public function service_check_sv_title_is_unique()
    {
        $sv_title = $this->input->post('data[sv_title]', '');
        if (empty($sv_title)) {
            $this->form_validation->set_message('service_check_sv_title_is_unique', " The ".lang('service')." field is required ! ");
            return FALSE;
        }
        $sv_id = $this->input->post('data[sv_id]', 0);
        if ( $sv_id == 'new' ) $sv_id= 0;
        $similarService= $this->services_mdl->getSimilarServiceBySv_Title( $sv_title, $sv_id );
        if (!empty($similarService)) {
            $this->form_validation->set_message('service_check_sv_title_is_unique', lang('service') . " '".$sv_title."' must be unique ! ");
            return FALSE;
        }
        return TRUE;
    }

    private function service_edit_fill_current_data($service, $is_insert, $sv_id)
    {
        $service = new stdClass;
        $service->sv_id = $sv_id;
        $service->sv_title = set_value('data[sv_title]');
        $service->sv_active_status = set_value('data[sv_active_status]');
        $service->sv_vendor_type_id = set_value('data[sv_vendor_type_id]');
        $service->sv_description = set_value('data[sv_description]');
        return $service;
    }


    private function service_edit_form_validation($is_insert, $sv_id)
    {
        $this->form_validation->set_rules( 'data[sv_title]', lang('sv_title'), 'callback_service_check_sv_title_is_unique' );
        $this->form_validation->set_rules( 'data[sv_active_status]', lang('sv_active_status'), 'required' );
        $this->form_validation->set_rules( 'data[sv_vendor_type_id]', lang('vt_name'), 'required' );
        $this->form_validation->set_rules( 'data[sv_description]', lang('sv_description'), '' );
    }


    private function service_edit_makesave($is_insert, $sv_id, $select_on_update, $redirect_url, $page_parameters_with_sort, $post_array, $app_config ) {
        $this->db->trans_start();
        $update_data= array( 'sv_title' => $post_array['data']['sv_title'],  'sv_active_status' => $post_array['data']['sv_active_status'],  'sv_vendor_type_id' => $post_array['data']['sv_vendor_type_id'], 'sv_description' => $post_array['data']['sv_description'] );
        if ( $is_insert ) {
            $this->db->insert($this->services_mdl->m_services_table, $update_data);
            $sv_id= $this->db->insert_id();
        } else {
            $this->db->where( $this->services_mdl->m_services_table . '.sv_id', $sv_id);
            $this->db->update($this->services_mdl->m_services_table, $update_data);
        }

        if ($select_on_update == 'reopen_editor') {
            $redirect_url = base_url() . 'sys-admin/services/services-edit/' . $sv_id . $page_parameters_with_sort;
        }
        if ($select_on_update == 'open_editor_for_new') {
            $redirect_url = base_url() . 'sys-admin/services/services-edit/new' . $page_parameters_with_sort;
        }

        if ($sv_id) {
            $this->session->set_flashdata('editor_message', lang('service') . " '" . $post_array['data']['sv_title'] . "' was " . ($is_insert ? "inserted" : "updated") );
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

    /**********************
     * create string with all sorting parameters for using in sorting by column header or at editor submitting to keep current filters
     * access public
     * @params : $UriArray - $_GET array in assoc array, $_post_array - $_POST array,
     * $WithPage - if TRUE"page" is added to the url, $WithSort - if to show current sort in resulting string. With TRUEif used in links to editor, with FALSE is used in
     * sorting columns, as sorting is set for any column.
     * return string with filters in pairs filter_name/filter_value
     *********************************/
    private function servicesPreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort)
    {
        $ResStr = '';
        if (!empty($_post_array)) { // form was submitted
            if ($WithPage) {
                $page = $this->input->post('page');
                $ResStr .= !empty($page) ? 'page/' . $page . '/' : 'page/1/';
            }
            $filter_sv_title = $this->input->post('filter_sv_title');
            $ResStr .= !empty($filter_sv_title) ? 'filter_sv_title/' . $filter_sv_title . '/' : '';
            $filter_vendor_type_id = $this->input->post('filter_vendor_type_id');
            $ResStr .= !empty($filter_vendor_type_id) ? 'filter_vendor_type_id/' . $filter_vendor_type_id . '/' : '';
            $filter_active_status = $this->input->post('filter_active_status');
            $ResStr .= !empty($filter_active_status) ? 'filter_active_status/' . $filter_active_status . '/' : '';
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
            $ResStr .= !empty($UriArray['filter_sv_title']) ? 'filter_sv_title/' . $UriArray['filter_sv_title'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_vendor_type_id']) ? 'filter_vendor_type_id/' . $UriArray['filter_vendor_type_id'] . '/' : '';
            $ResStr .= !empty($UriArray['filter_active_status']) ? 'filter_active_status/' . $UriArray['filter_active_status'] . '/' : '';
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
     * for service load list of images
     * access public
     * @params : service_id - service id to upload images
     * return list service images
     *********************************/
    public function load_service_images()
    {
        $UriArray = $this->uri->uri_to_assoc(4);
        $post_array = $this->input->post();
        $service_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'service_id');
        $filters= array('si_service_id'=>$service_id);
        $service_images_list = $this->services_mdl->getService_ImagesList( false, 0, $filters );
        $data = array('service_images_list' => $service_images_list, 'si_service_id' => $service_id );
        $service_max_images_limit_error='';
        if ( count($service_images_list) >= (int)$this->config->item('service_max_images') ) {
            $service_max_images_limit_error = 'You can not upload more "'.$this->config->item('service_max_images').'" images for service ! ';
        }
        $data['page']		= 'services/load_service_images'; //page view to load
        $data['plugins'] 	= array();
        $data['javascript'] = array();
        $data['service_images_list'] = $service_images_list;
        $data['service_id'] = $service_id;
        $views				= array(  'design/page'  );
        ob_start();
        $this->layout->view($views, $data);
        $html = ob_get_contents();
        ob_end_clean();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'service_id' => $service_id, 'service_max_images_limit_error'=> $service_max_images_limit_error, 'html' => $html ) ) );
    }

    public function upload_image_to_tmp_service()
    {
        $UriArray = $this->uri->uri_to_assoc(4);
        $orig_width = 300;
        $orig_height = 240;
        $unique_session_id = session_id();
        $dst_tmp_directory = FCPATH . $this->config->item('image_tmp_directory') . $unique_session_id;
        $tmp_dest_dirname_url = base_url() . $this->config->item('image_tmp_directory') . $unique_session_id;
        $tmpServiceImagesDirs = array( FCPATH . 'uploads', FCPATH . $this->config->item('tmp_directory'), $dst_tmp_directory);

//        $this->common_lib->DebToFile( 'upload_image_to_tmp_service FCPATH::'.print_r(FCPATH,true));
        $src_filename = $_FILES['files']['tmp_name'][0];
        $img_basename = $_FILES['files']['name'][0];
        $tmp_dest_filename = $dst_tmp_directory . DIRECTORY_SEPARATOR . $img_basename;

        $this->common_lib->createDir($tmpServiceImagesDirs);
        $ret = move_uploaded_file($src_filename, $tmp_dest_filename);
        $filesize = filesize($tmp_dest_filename);
        $resArray = array("files" => array("short_name" => $img_basename,"name" => $tmp_dest_filename,
            "size" => $filesize,
            'FilenameInfo' =>$this->common_lib->GetImageShowSize($tmp_dest_filename, $orig_width, $orig_height),
            "sizeLabel" => $this->common_lib->getFileSizeAsString($filesize),
            "url" => $tmp_dest_dirname_url . '/' .  $img_basename . '?tm=' . time(),
        ));
//        $this->common_lib->DebToFile( 'upload_image_to_tmp_service $resArray::'.print_r($resArray,true));
        echo json_encode($resArray);
    }

    public function upload_image_to_service()
    {
        $UriArray = $this->uri->uri_to_assoc(4);
        $service_id = $UriArray['service_id'];
        $is_main_image = $UriArray['is_main_image'];
        $this->common_lib->DebToFile($UriArray, ' upload_image_to_service $UriArray::');
        $service_image = $this->common_lib->tbUrlDecode($UriArray['service_image']);
        $img_basename = basename($service_image);

        $src_filename = urldecode($service_image);//$_FILES['files']['tmp_name'][0];
        $this->common_lib->DebToFile($service_image, '$service_image::');
        if (file_exists($src_filename)) {
            $this->common_lib->DebToFile($src_filename, 'EXISTS$src_filename::');
        }

        $dest_filename = FCPATH . $this->config->item('image_service_directory') . $service_id . DIRECTORY_SEPARATOR . urldecode($img_basename);
        $this->common_lib->DebToFile($dest_filename, '$dest_filename::');

        $tmpServiceImagesDirs = array( FCPATH . 'uploads', $this->config->item('document_root') . 'uploads/services', FCPATH . $this->config->item('image_service_directory') . $service_id );

        $similarService_Image= $this->services_mdl->getSimilarService_ImageByImage( $img_basename, (int)$service_id, 0 );
        if ( $similarService_Image ) {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => "This service already has image '".$img_basename."' uploaded !", 'ErrorCode' => 1)));
            return;
        }

        $this->common_lib->createDir($tmpServiceImagesDirs);
        $uploaded_file_return = copy($src_filename, $dest_filename);
        $this->common_lib->DebToFile($uploaded_file_return, '$uploaded_file_return::');
        if ($uploaded_file_return) {
            $service_image_id = $this->services_mdl->updateService_Images(0, array('si_service_id'=>$service_id, 'si_image'=>$img_basename, 'si_is_main'=>$is_main_image) );

            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'dest_filename' => $dest_filename, 'src_filename' => $src_filename, 'service_image_id'=> $service_image_id)));
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => 'Error Uploading', 'ErrorCode' => 1)));
        }
    }


    public function delete_service_image()
    {
        $UriArray = $this->uri->uri_to_assoc(4);
        $service_image_id = $UriArray['service_image_id'];
        $service_id = $UriArray['service_id'];
        $service_image = trim($this->common_lib->tbUrlDecode($UriArray['service_image']));

        if (empty($service_id) or empty($service_image) or empty($service_image_id) ) {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => 'Invalid parameters', 'ErrorCode' => 1, 'service_image_id' => $service_image_id )) );
            return;
        }

        $res= $this->services_mdl->deleteService_Image($service_image_id);
        $dir_path = FCPATH . $this->config->item('image_service_directory') . $service_id . DIRECTORY_SEPARATOR;
        $this->common_lib->DebToFile($dir_path, '$dir_path::');
        if ( $res ) {
            if ( file_exists($dir_path . $service_image) ) {
                unlink($dir_path . $service_image);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => '', 'ErrorCode' => 0, 'service_image' => $service_image)));
            return;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array('ErrorMessage' => 'Image not found', 'ErrorCode' => 1, 'service_image' => $service_image)));
    }


    ////////////// SERVICES BLOCK END /////////////

}