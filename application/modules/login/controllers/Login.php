<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	 public function __construct() {
         parent::__construct();
		 $this->load->model('users_mdl');
		 $this->load->model('clients_mdl','clients_mdl');
 		 $this->lang->load('ion_auth');
    	 $this->lang->load('auth');
 		 $this->lang->load('login');
	 }
 /**********************
 * View login page
 * access public
 * @params
 * return view
 *********************************/
	public function select_active_title()
    {
        if ( !$this->ion_auth->logged_in() ) {
            $this->session->set_flashdata('message', "Must be be logged to the system ");
            redirect('/login');
        }
        $user = $this->ion_auth->user()->row();
		$client_id = $this->session->userdata('logged_user_client_id');
		/*echo "client is : " . $client;
		echo "User is :";
		print_r($user);*/
        $groupsList = $this->users_mdl->getUsersGroupsList( false, 0, array('user_id'=> $user->id, 'client_id' => $client_id, 'status'=>'A', 'show_groups_description'=> 1) );
		/*echo "Group list is : ";
		print_r($groupsList);
		exit(0);*/
        if ( count($groupsList) == 0 ) {
            redirect('/msg/' . urldecode(lang("account_has_no_active_titles")) . '/sign/danger');
        }
		elseif(count($groupsList) == 1)
		{
			redirect('/'.$groupsList[0]->group_name, 'refresh');
		}
		
        $data['groupsList'] = $groupsList;
        $data['pls'] = array('login');
        $data['plugins'] = array();
        $data['javascript'] = array();
        $data['page'] = 'select_active_title';
        $views=array( 'select_active_title','design/html_footer' );
        $this->layout->view($views, $data, 'default');
    }
	
	public function select_active_client()
    {
        if ( !$this->ion_auth->logged_in() ) {
            $this->session->set_flashdata('message', "Must be be logged to the system ");
            redirect('/login');
        }
        $user = $this->ion_auth->user()->row();
		$this->load->model('clients_mdl','clients_mdl');
        //$clients = $this->clients_mdl->getUsersClientsList( false, 0, array('user_id'=> $user->id, 'status'=>'A') );
		$clientList = $this->users_mdl->getUsersClientsList( false, 0, array('user_id'=> $user->id, 'status'=>'A') );
		//echo "<pre>";
		//echo "Client list is :";
		//print_r($clientList);
		$clients = array();
		$client_ids = array();
		$i=0;
		$is_multi_client = 0;
		$is_multi_title = 0;
	
		if(count($clientList) > 1)
		{
			$is_multi_client = 1;
		}
		foreach($clientList as $c)
		{
			//echo "c is : ";
			//print_r($c);
			if(!in_array($c->uc_client_id,$client_ids))
			{
				$client_ids[] = $c->uc_client_id;
				$c_data = $this->clients_mdl->getClientDetail($c->uc_client_id,array());
				$clients[$i]['client_data'] = $c_data;
				$titles = $this->users_mdl->getUserClientGroup($user->id,$c->uc_client_id);
				if(count($titles) > 1)
				{
					$is_multi_title = 1;
				}
				$clients[$i]['titles'] = $titles;
				$i++;
			}
		}
		/*echo "clients are :";
		print_r($clients);*/
		
        if ( count($clients) == 0 ) {
            redirect('/msg/' . urldecode(lang("account_has_no_active_clients")) . '/sign/danger');
        }
		if($is_multi_client)
		{
			$data['clients'] = $clients;
			$data['pls'] = array('login');
			$data['plugins'] = array();
			$data['javascript'] = array('assets/custom/admin/custom.js');
			$data['page'] = 'select_active_client';
			$views=array( 'select_active_client','design/html_footer' );
			$this->layout->view($views, $data, 'default');
		}
		elseif(!$is_multi_client && $is_multi_title)
		{
			$data['clients'] = $clients;
			$data['pls'] = array('login');
			$data['plugins'] = array();
			$data['javascript'] = array('assets/custom/admin/custom.js');
			$data['page'] = 'select_active_client';
			$views=array( 'select_active_client','design/html_footer' );
			$this->layout->view($views, $data, 'default');
		}
		else if(!$is_multi_client && !$is_multi_title)
		{
			$client_id = $clientList[0]->uc_client_id;
			$title_id = $clients[0]['titles']->id;
		
			// Get client name
			$client_detail = $this->clients_mdl->getClientDetail($client_id);
			$client_name = $client_detail->client_name;
			//echo "client name is : " . $client_name;
			//print_r($client_detail);
			
			
			
			// Get title name and description
			$title_detail = $this->users_mdl->getGroupRowById($title_id);
			$title_name = $title_detail->name;
			$title_desc = $title_detail->description; 
			
			$user = $this->ion_auth->user()->row();
			$this->ion_auth->set_session($user, $title_name, $title_desc, $client_id, $client_name);
			$this->ion_auth_model->update_last_login($user_id);
			$this->ion_auth_model->clear_login_attempts($identity);
			if ($remember && $this->config->item('remember_users', 'ion_auth'))
			{
				$this->ion_auth_model->remember_user($user_id);
			}
			/*echo "session data are : ";
			print_r($this->session->userdata());*/    	
			redirect('/'.$title_name, 'refresh');
	
			//echo $title_name;
		}
    }

	public function switch_active_title()
    {
        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();
		/*echo "post array is : ";
		print_r($post_array);*/

        if ( !$this->ion_auth->logged_in() ) {
            $this->session->set_flashdata('message', "Must be be logged to the system ");
            redirect('/login');
        }
        $active_title_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'active_title_id' );

        /*echo '<pre>$UriArray::'.print_r($UriArray,true).'</pre>';
        echo '<pre>$active_title_id::'.print_r($active_title_id,true).'</pre>';
        exit(0);*/
		//die("-1 XXZ");  
        /*if ( empty($active_title_id) ) {
            $this->session->set_flashdata('message', "Select active title ");
            redirect('/login/select_active_title');
        }*/


        $user = $this->ion_auth->user()->row();
		$client_id = $this->session->userdata('logged_user_client_id');
        $groupsList = $this->users_mdl->getUsersGroupsList( false, 0, array('user_id'=> $user->id, 'client_id'=>$clientid, 'group_id'=>$active_title_id, 'status'=>'A', 'show_groups_description'=> 1) );
		/*echo "group list is : ";
		print_r($groupsList);
		exit(0);*/
		/*echo "last query is : " . $this->db->last_query();
		echo "session data is : ";
		print_r($this->session->userdata());
		echo "count is : " . count($groupsList);*/
		
        if ( count($groupsList) == 0 ) {
            redirect('/msg/' . urldecode(lang("account_has_no_active_titles")) . '/sign/danger');
        }
        $has_access_to_select_active_title= false;
        $logged_user_title_name = '';
        $logged_user_title_description = '';
        foreach( $groupsList as $nextGroup ) {
            if ($nextGroup->uc_group_id == $active_title_id) {
                $has_access_to_select_active_title= true;
                $logged_user_title_name = $nextGroup->group_name;
                $logged_user_title_description = $nextGroup->group_description;
                break;
            }
        }
		/*echo "has access to select active title is : " . $has_access_to_select_active_title . " and logged user title is : " . $logged_user_title_name;exit(0);*/
        if ( !$has_access_to_select_active_title or empty($logged_user_title_name) ) {
            redirect('/msg/' . urldecode(lang("have_no_access_to_this_title")) . '/sign/danger');
        }
        $this->ion_auth->set_session($user, $logged_user_title_name, $logged_user_title_description);
    	redirect('/'.$logged_user_title_name, 'refresh');
    }
	
	public function switch_active_client()
    {
        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();

        if ( !$this->ion_auth->logged_in() ) {
            $this->session->set_flashdata('message', "Must be be logged to the system ");
            redirect('/login');
        }
        //$active_client_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'active_client_id' );
		$active_client_id = $this->input->post('active_client_id');
		$user = $this->ion_auth->user()->row();
		$user_id = $user->id;

        /*echo '<pre>$UriArray::'.print_r($UriArray,true).'</pre>';
        echo '<pre>$active_client_id::'.print_r($active_client_id,true).'</pre>';
		echo "user id is : ";
		print_r($user);
		exit(0);*/
        //die("-1 XXZ");  
        /*if ( empty($active_client_id) ) {
            $this->session->set_flashdata('message', "Select active client ");
            redirect('/login/select_active_client');
        }*/


		$groupsList = $this->users_mdl->getUserClientGroup($user_id,$active_client_id);
                //echo '<pre>$groupsList::'.print_r($groupsList,true).'</pre>';exit(0);
		if ( count($groupsList) == 0 ) {
			$error_message= 'You account has no active Titles ';
			redirect('/msg/' . urldecode($error_message) . '/sign/danger');
		}
		if ( count($groupsList) == 1 ) {
			$logged_user_title_name= $groupsList[0]->name;
			$logged_user_title_description= $groupsList[0]->description;
			$this->ion_auth_model->set_session($user, $logged_user_title_name, $logged_user_title_description);

			$this->ion_auth_model->update_last_login($user_id);

			$this->ion_auth_model->clear_login_attempts($identity);

			if ($remember && $this->config->item('remember_users', 'ion_auth'))
			{
				$this->ion_auth_model->remember_user($user->id);
			}

			$this->ion_auth_model->trigger_events(array('post_login', 'post_login_successful'));
			$this->ion_auth_model->set_message('login_successful');

			redirect('/'.$logged_user_title_name, 'refresh');
			//return TRUE;
		}
		if ( count($groupsList) > 1 ) { // user has more 1 active title - user must select his title to access other pages.
			$logged_user_title_name= $groupsList[0]->name;
			$logged_user_title_description= $groupsList[0]->description;
			$this->ion_auth_model->set_session($user, $logged_user_title_name, $logged_user_title_description);

			$this->ion_auth_model->update_last_login($user_id);

			$this->ion_auth_model->clear_login_attempts($identity);

			if ($remember && $this->config->item('remember_users', 'ion_auth'))
			{
				$this->ion_auth_model->remember_user($user_id);
			}
			redirect('/login/select_active_title');
		}
				
				

        //$user = $this->ion_auth->user()->row();
        //$groupsList = $this->users_mdl->getUsersGroupsList( false, 0, array('user_id'=> $user->id, 'status'=>'A', 'show_groups_description'=> 1) );
		/*$groupsList = $this->users_mdl->getUserClientGroup($user_id,$active_client_id);
        if ( count($groupsList) == 0 ) {
            redirect('/msg/' . urldecode(lang("account_has_no_active_titles")) . '/sign/danger');
        }
        $has_access_to_select_active_title= false;
        $logged_user_title_name = '';
        $logged_user_title_description = '';
        foreach( $groupsList as $nextGroup ) {
            if ($nextGroup->group_id == $active_title_id) {
                $has_access_to_select_active_title= true;
                $logged_user_title_name = $nextGroup->group_name;
                $logged_user_title_description = $nextGroup->group_description;
                break;
            }
        }
        if ( !$has_access_to_select_active_title or empty($logged_user_title_name) ) {
            redirect('/msg/' . urldecode(lang("have_no_access_to_this_title")) . '/sign/danger');
        }
        $this->ion_auth->set_session($user, $logged_user_title_name, $logged_user_title_description);
    	redirect('/'.$logged_user_title_name, 'refresh');*/
    }
	
	// Function to set session data for selected client and title when user click on accordian menu item
	public function set_client_title_session()
	{
		if (!$this->input->is_ajax_request()) 
    		exit('No direct script access allowed'); 
		/*$client_id = $this->input->get('client_id');
		$title_id = $this->input->get('title_id');*/
		//echo "URI assoc is : ";
		$UriArray = $this->uri->uri_to_assoc(3);
		//print_r($UriArray);
		$client_id = $UriArray['client'];
		$title_id = $UriArray['title'];
		//echo "client id is : " . $client_id . " title id is : " . $title_id;
		//echo "session data are : ";
		//print_r($this->session->userdata());
		$identity = $this->session->userdata('identity');
		$user_id = $this->session->userdata('user_id');
		$email = $this->session->userdata('email');
		//echo "user identity is : " . $identity . " user id is : " . $user_id . " email is : " . $email;
		
		// Get client name
		$client_detail = $this->clients_mdl->getClientDetail($client_id);
		$client_name = $client_detail->client_name;
		//echo "client name is : " . $client_name;
		//print_r($client_detail);
		
		
		
		// Get title name and description
		$title_detail = $this->users_mdl->getGroupRowById($title_id);
		$title_name = $title_detail->name;
		$title_desc = $title_detail->description; 
		//echo "title name is : " . $title_name . " title desc is : " . $title_desc;
		//print_r($title_detail);
		
		
		
				
		//
		/*$this->ion_auth_model->set_session($user, $logged_user_title_name, $logged_user_title_description);

		$this->ion_auth_model->update_last_login($user_id);

		$this->ion_auth_model->clear_login_attempts($identity);

		if ($remember && $this->config->item('remember_users', 'ion_auth'))
		{
			$this->ion_auth_model->remember_user($user_id);
		}*/
		
		
		//
		$user = $this->ion_auth->user()->row();
		$this->ion_auth->set_session($user, $title_name, $title_desc, $client_id, $client_name);
		$this->ion_auth_model->update_last_login($user_id);
		$this->ion_auth_model->clear_login_attempts($identity);
		if ($remember && $this->config->item('remember_users', 'ion_auth'))
		{
			$this->ion_auth_model->remember_user($user_id);
		}
		/*echo "session data are : ";
		print_r($this->session->userdata());*/    	/*redirect('/'.$logged_user_title_name, 'refresh');*/

		echo $title_name;
	}

	public function index(){
		if ($this->ion_auth->logged_in()){
			//echo "in if...";
//			$module = @$this->common_mdl->get_users_jobs()->row()->job_name;
//			if (!$module)
			$module = $this->ion_auth->get_users_groups()->row()->name;
			redirect('/'.$module, 'refresh');
			return true;
		}
		//echo "after if";
		$data['pls'] = array('login');
		$data['plugins'] = array();
	  	$data['javascript'] = array();
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'required');
//		echo '<pre>$this->form_validation->run()::'.print_r($this->form_validation->run(),true).'</pre>';
//		die("-1 XXZ");
		//echo "before form validation...";
		if ($this->form_validation->run() == true){
			//echo "form validation true...";
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember)){
				//echo "in login success...";
				//if the login is successful
				//redirect them back to the home page
				//$this->session->set_flashdata('message', $this->ion_auth->messages());
				
				$this->custome_session();
//				$module = @$this->common_mdl->get_users_jobs()->row()->job_name;
				 //echo $group;
				 //die();
//				if (!$module)
//				$module = $this->ion_auth->get_users_groups()->row()->name;

				if($this->session->userdata('super_id') != 0)
				{

					$logged_user_title_name= $this->session->userdata['logged_user_title_name'];
	
					if ( !empty($logged_user_title_name) ) {
						redirect('/' . $logged_user_title_name, 'refresh');
					}
					redirect('/msg/' . urldecode(lang("account_has_no_active_titles")) . '/sign/danger');
				}
				$module = $this->ion_auth->get_users_groups()->row()->name;
				//echo "module is :" . $module;
				redirect('/'.$module, 'refresh');

			}else{
				//echo "login un-success...";
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('/login'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}else{
			$views=array('login','design/html_footer');
			$this->layout->view($views, $data, 'default');
		}
	}
	
	
/**********************
* Custom session
* access private
* @params
* return session
*********************************/	
	private function custome_session() {
		$user = $this->ion_auth->user()->row();
		$data=array();
		$data['username']= $user->username;
		$data['super_id']= $user->super_id;
		foreach ($data as $key => $value) {
			$this->session->set_userdata($key, $value);
		}
	}
	
/**********************
* Reset password
* access public
* @params
* return view
*********************************/	 	
	public function reset(){
		$data['pls'] = array('login');
		$data['plugins'] = array();
	  	$data['javascript'] = array();
		$app_config = $this->config->config;
		$this->form_validation->set_rules( 'email', lang('email'), 'trim|required|valid_email|callback_user_check_email_is_valid' );
		if ( !empty($_POST) ) {
			if ( $this->form_validation->run() == false ) {
				$this->data['type'] = $this->config->item( 'identity', 'ion_auth' );
			} else {
				$forgotten_password_code= $this->common_lib->generateActivationCode();

				$similarUser= $this->users_mdl->getSimilarUserByEmail( $_POST['email'] );
				$update_data['forgotten_password_code']= $forgotten_password_code;
				$this->db->update( $this->users_mdl->m_users_table, $update_data, array('id' => $similarUser->id ) );

				$forgotten_password_page_url= $app_config['base_url']."/forgotten_password/".$forgotten_password_code;
				$title= 'You reset your password at ' . $app_config['base_url'] . ' site';
				$content= '  Dear '.$similarUser->username. ', You reset your password at <a href="'.$app_config['base_url'].'">' . $app_config['base_url'] . ' </a> site, with email '. $similarUser->email . '.  To confirm resetting of your password open at <a href="' . $forgotten_password_page_url .'">Forgotten Password page '.$forgotten_password_page_url.' </a> and you will receive your new password. ';
				$EmailOutput = $this->common_lib->SendEmail( $similarUser->email, $title, $content );
				$this->session->set_flashdata( 'message', 'Forgotten password code was sent at entered emal !' );
				redirect( "login/reset", 'refresh' );
			}
		}

		$data['message'] = ( validation_errors() ) ? validation_errors() : $this->session->flashdata( 'message' );
		$this->layout->view( 'login/reset', $data, 'default' );
	}

	public function user_check_email_is_valid()
	{
		$email = $this->input->post('email', '');
		if (empty($email)) {
			$this->form_validation->set_message('user_check_email_is_valid', " The ".lang('user')." field is required ! ");
			return FALSE;
		}
		$similarUser= $this->users_mdl->getSimilarUserByEmail( $email );
		if (empty($similarUser)) {
			$this->form_validation->set_message('user_check_email_is_valid', lang('user') . " with email '".$email."' not found ! ");
			return FALSE;
		}
		if ( $similarUser->user_status != 'A' ) {
			$this->form_validation->set_message('user_check_email_is_valid', " Password can be reset only to active user ! ");
			return FALSE;

		}
		return TRUE;
	}


/**********************
* Logout
* access public
* @params
* return view
*********************************/	 
	public function logout(){
	// log the user out
		$logout = $this->ion_auth->logout();
		redirect('./', 'refresh');
	}

	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);
		return array($key => $value);
	}
	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// function to view the create account page

    function create_account()
    {
    	$data['pls'] = array('login');
		$data['plugins'] = array();
	  	$data['javascript'] = array();
    	$this->layout->view( 'login/create_account', $data, 'default');
    } 
}
