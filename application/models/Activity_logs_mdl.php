<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Users Db functions
 *
 * ****************************/
class Activity_logs_mdl extends CI_Model {
	public $m_activity_logs_table;

	function __construct() {
		parent::__construct();
		$this->m_activity_logs_table         = 'activity_logs';
	}

	public function deleteActivityLogsByUserId($user_id) {
		if (!empty($user_id)) {
			$this->db->where('user_id', $user_id);
			$Res = $this->db->delete($this->m_activity_logs_table);
			return $Res;
		}
	}

}