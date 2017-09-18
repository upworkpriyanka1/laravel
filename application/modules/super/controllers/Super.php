<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

	public function __construct() {
		parent::__construct();
	/*check if logged in */
		if (!$this->ion_auth->logged_in()){
			redirect('./', 'refresh');
		}
		 $this->load->model('users_mdl');
	/*check if allowed to access page */
		$group = array('super'); //allowed group admin,super etc
		if (!$this->ion_auth->in_group($group)){
			echo "Not allowed";
			die();
		}
		$this->load->library('Super_lib',NULL,'super_lib');
		$this->load->model('super_mdl','super_mdl');
		$this->load->model('clients_mdl','clients_mdl');
		$this->load->model('users_mdl','users_mdl');
		$this->lang->load('super');
		$this->config->load('super_menu', true );
		$this->menu    			= $this->config->item( 'super_menu' );

		$this->user 			= $this->common_mdl->get_user();
		$this->superviser 		=  $this->ion_auth->user($this->user->super_id)->row();
		$this->superviser_name 	= $this->superviser->first_name." ".$this->superviser->last_name;
		$this->group 			= $this->ion_auth->get_users_groups()->row();
		//$this->job 				= $this->common_mdl->get_users_jobs()->row();

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
		//$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;
		$data['superviser']	=$this->superviser_name;;

		$data['page']		='dashboard'; //page view to load
		$data['pls'] 		= array(); //page level scripts
		$data['plugins'] 	= array(); //plugins
		$data['javascript'] = array(); //javascript
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view users
* access public
* @params $this->user->cid
* return view
*********************************/
	public function users_view(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;
        $post_array = $this->input->post();
        $UriArray = $this->uri->uri_to_assoc(3);

        $page_parameters_without_sort = $this->superUsersPreparePageParameters($UriArray, $post_array, false, false);
        $sort= $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort', 'users.username');
        $sort_direction = $this->common_lib->getParameter($this, $UriArray, $post_array, 'sort_direction', 'asc');

        $data['users'] = $this->super_mdl->getUsersClientsList( false, 0, array('client_id'=> $this->user->cid), $sort, $sort_direction );
	    $data['sort_direction']		= $sort_direction;
	    $data['sort']		= $sort;
	    $data['page_parameters_without_sort']		= $page_parameters_without_sort;
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
			$this->super_lib->user_edit();
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;

		$data['usertoedit'] = $this->common_mdl->user_to_edit($this->uri->segment(3),$this->user->cid,FALSE, FALSE);
		$data['clients']	= $this->common_mdl->get_records('clients', 'cid !=', '1');
		$data['groups']		= $this->common_mdl->get_records('groups', 'id !=', '1');
		//$data['jobs']		= $this->common_mdl->get_records('jobs', 'id !=', '1');

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
			$this->super_lib->user_add();
			return true;

		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;

		//$data['clients']	= $this->common_mdl->get_records('clients', 'cid !=', '1');
		$data['groups']		= $this->common_mdl->get_records('groups', 'id !=', '1');
		//$data['jobs']		=  $this->common_mdl->get_records('jobs', 'id !=', '1');
		$data['page']		= 'users/users-add';
		$data['plugins'] 	= array('validation');
		$data['javascript'] = array( 'assets/custom/admin/user-add-validation.js');
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view contacts
* access public
* @params $clkint_id
* return view
*********************************/
	public function contacts_view(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		//$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['contacts']		= $this->common_mdl->get_contacts($this->user->cid);

	    $data['page']		= 'contacts/contacts-view';
	    $data['menu']		= $this->menu;
	    $data['plugins'] 	= array('datatables');
	    $data['javascript'] = array('assets/custom/super/contacts-view.js');
	    $views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
	    $this->layout->view($views, $data);
	}

/**********************
* Edit contacts
* access public
* @params usr_segment->3 (client id)
* return view
*********************************/
	public function contacts_edit(){
		if (isset($_POST['ajaxpost'])){
			$this->common_mdl->db_update('contacts',$_POST['data'], 'contact_id', $this->uri->segment(3));
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;

		$data['contact'] = $this->common_mdl->contact_to_edit($this->uri->segment(3),$this->user->cid);
		$data['contacts_type']	= $this->common_mdl->get_records('contact_types');

		$data['page']		= 'contacts/contacts-edit'; //page view to load
		$data['plugins'] 	= array('validation');
		$data['javascript'] = array( 'assets/custom/super/contact-add-edit-validation.js');
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* Add Contact
* access public
* @params
* return view
*********************************/
	public function contacts_add(){
		if (isset($_POST['ajaxpost'])){
			$_POST['data']['contact_client_id'] = $this->user->cid;
			$this->common_mdl->db_insert('contacts',$_POST['data']);
			return true;

		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;

		$data['contacts_type']	= $this->common_mdl->get_records('contact_types');
		//$data['groups']		= $this->common_mdl->get_records('groups', 'id !=', '1');
		//$data['jobs']		=  $this->common_mdl->get_records('jobs', 'id !=', '1');
		$data['page']		= 'contacts/contacts-add';
		$data['plugins'] 	= array('validation');
		$data['javascript'] = array( 'assets/custom/super/contact-add-edit-validation.js');
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* Edit company
* access public
* @params usr_segment->3 (client id)
* return view
*********************************/
	public function profile_company()
	{
		if (isset($_POST['ajaxpost'])){
			$this->super_lib->company_edit($this->user->cid);
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;

		$data['client']		= $this->common_mdl->get_client($this->user->cid, TRUE);
		$data['page']		= 'company/my-company'; //page view to load
		$data['plugins'] 	= array('validation'); //page plugins
	  	$data['javascript'] = array( 'assets/custom/admin/client-add-validation.js');//page javascript
		$views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}


/**********************
* View Activity log
* access public
* @params
* return view
*********************************/
	public function activity_logs(){
		$this->common_lib->activity_log($this->menu,$this->user,$this->group->name);
	}


/**********************
* Edit MY PROFILE
* access public
* @params
* return view
*********************************/
	public function profile(){
		$this->common_lib->profile($this->user,$this->menu,$this->group->name);
	}

    /**********************
     * create string with all sorting parameters for using in sorting by column header or at editor submitting to keep current filters
     * access public
     * @params : $UriArray - $_GET array in assoc array, $_post_array - $_POST array,
     * $WithPage - if TRUE"page" is added to the url, $WithSort - if to show current sort in resulting string. With TRUEif used in links to editoe, with FALSEis used in
     * sorting columns, as sorting is set for any column.
     * return string with filters in pairs filter_name/filter_value
     *********************************/
    private function superUsersPreparePageParameters($UriArray, $_post_array, $WithPage, $WithSort)
    {
        $ResStr = '';
        if (!empty($_post_array)) { // form was submitted
            if ($WithPage) {
                $page = $this->input->post('page');
                $ResStr .= !empty($page) ? 'page/' . $page . '/' : 'page/1/';
            }
//            $filter_client_name = $this->input->post('filter_client_name');
//            $ResStr .= !empty($filter_client_name) ? 'filter_client_name/' . $filter_client_name . '/' : '';
//            $filter_client_status = $this->input->post('filter_client_status');
//            $ResStr .= !empty($filter_client_status) ? 'filter_client_status/' . $filter_client_status . '/' : '';
//            $filter_client_type = $this->input->post('filter_client_type');
//            $ResStr .= !empty($filter_client_type) ? 'filter_client_type/' . $filter_client_type . '/' : '';
//            $filter_client_zip = $this->input->post('filter_client_zip');
//            $ResStr .= !empty($filter_client_zip) ? 'filter_client_zip/' . $filter_client_zip . '/' : '';
//            $filter_created_at_from = $this->input->post('filter_created_at_from');
//            $ResStr .= !empty($filter_created_at_from) ? 'filter_created_at_from/' . $filter_created_at_from . '/' : '';
//            $filter_created_at_till = $this->input->post('filter_created_at_till');
//            $ResStr .= !empty($filter_created_at_till) ? 'filter_created_at_till/' . $filter_created_at_till . '/' : '';
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
//            $ResStr .= !empty($UriArray['filter_client_name']) ? 'filter_client_name/' . $UriArray['filter_client_name'] . '/' : '';
//            $ResStr .= !empty($UriArray['filter_client_status']) ? 'filter_client_status/' . $UriArray['filter_client_status'] . '/' : '';
//            $ResStr .= !empty($UriArray['filter_client_type']) ? 'filter_client_type/' . $UriArray['filter_client_type'] . '/' : '';
//            $ResStr .= !empty($UriArray['filter_client_zip']) ? 'filter_client_zip/' . $UriArray['filter_client_zip'] . '/' : '';
//            $ResStr .= !empty($UriArray['filter_created_at_from']) ? 'filter_created_at_from/' . $UriArray['filter_created_at_from'] . '/' : '';
//            $ResStr .= !empty($UriArray['filter_created_at_till']) ? 'filter_created_at_till/' . $UriArray['filter_created_at_till'] . '/' : '';
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
	
   public function client_overview_profile_form(){
	$UriArray = $this->uri->uri_to_assoc(3);
	$user_id=$UriArray['client-overview-profile-form'];
	$editable_user= $this->users_mdl->getUserRowById( $user_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );
	if ($this->input->server('REQUEST_METHOD') == 'GET'){
		$this->load->view('users/client-overview-profile-form',['user'=>$editable_user]);
	}else if ($this->input->server('REQUEST_METHOD') == 'POST'){
		if(isset($_POST['submit'])){
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');


			$this->form_validation->set_rules( 'data[username]', lang('username'), 'required' );
			$this->form_validation->set_rules( 'data[password]', lang('password'), 'required' );
			$this->form_validation->set_rules( 'data[password_confirm]', lang('password_confirm'), 'required|matches[data[password]]' );
			$this->form_validation->set_rules( 'data[first_name]', lang('first_name'), 'required' );
			$this->form_validation->set_rules( 'data[last_name]', lang('last_name'), 'required' );
			$this->form_validation->set_rules( 'data[phone]', lang('phone'), 'required' );


			$id = $this->input->post('data[id]');

			$data = array(
				'username' => $this->input->post('data[username]'),
				'password' => password_hash($this->input->post('data[password]'), PASSWORD_BCRYPT),
				'first_name' => $this->input->post('data[first_name]'),
				'middle_name' => $this->input->post('data[middle_name]'),
				'last_name' => $this->input->post('data[last_name]'),
//            'birth_date' => $this->input->post('data[birth_date]'),
				'avatar' => $this->input->post('data[avatar]'),
//            'ethnicity' => $this->input->post('data[ethnicity]'),
				'address1' => $this->input->post('data[address1]'),
				'city' => $this->input->post('data[city]'),
				'state' => $this->input->post('data[state]'),
				'zip' => $this->input->post('data[zip]'),
				'phone' => $this->input->post('data[phone]'),
				'phone_type' => $this->input->post('data[phone_type]'),
				'username' => $this->input->post('data[username]'),
				'email' => $this->input->post('data[email]'),
			);

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('users/client-overview-profile-form',['user'=>$editable_user]);
			}
			else
			{
				$this->db->where('id', $id);
				$this->db->update('users', $data);
				$this->session->set_flashdata('massege', 'Updated successfully');
				redirect('sys-admin/users/users-overview/'.$id.'/');
			}

		}
	}
//        echo "<pre>";
//		print_r($editable_user);
//		die;

    }

}
