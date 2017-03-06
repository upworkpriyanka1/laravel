<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Cms_items Db functions
 *
 * ****************************/
class Cms_items_mdl extends CI_Model
{
	public $m_cms_items_table;
	private $Cms_ItemPage_TypeValueArray = Array('E' => 'Email Template', 'P' => 'Page', 'B' => 'Blog Article');
	private $Cms_ItemPublishedValueArray = Array('N' => 'Not Published', 'Y' => 'Published');

	function __construct()
	{
		parent::__construct();
		$this->m_cms_items_table= 'cms_items';
	}

	public function getCms_ItemPage_TypeValueArray()
	{
		$ResArray = array();
		foreach ($this->Cms_ItemPage_TypeValueArray as $Key => $Value) {
			$ResArray[] = array('key' => $Key, 'value' => $Value);
		}
		return $ResArray;
	}

	public function getCms_ItemPage_TypeLabel($Type)
	{
		if (!empty($this->Cms_ItemPage_TypeValueArray[$Type])) {
			return $this->Cms_ItemPage_TypeValueArray[$Type];
		}
		return '';
	}

	public function getCms_ItemPublishedValueArray()
	{
		$ResArray = array();
		foreach ($this->Cms_ItemPublishedValueArray as $Key => $Value) {
			$ResArray[] = array('key' => $Key, 'value' => $Value);
		}
		return $ResArray;
	}

	public function getCms_Item_PublishedLabel($Type)
	{
		if (!empty($this->Cms_ItemPublishedValueArray[$Type])) {
			return $this->Cms_ItemPublishedValueArray[$Type];
		}
		return '';
	}

	////////////// CMS ITEMS BLOCK START /////////////
	/**********************
	 * Get cms_items Types list/rows count depending of filters parameters
	 * access public
	 * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of cms_items types objects; $page - page number($OutputFormatCount must be = FALSE)
	 * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for ci_title,
	 * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
	 * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
	 * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
	 * return query array
	 *********************************/

	public function getCms_itemsList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
	{
		if (empty( $sort ))
			$sort = 'ci_title';

		$config_data = $this->config->config;
		$ci = & get_instance();
		$items_per_page= $ci->common_lib->getSettings('items_per_page');
		$limit = !empty($filters['limit']) ? $filters['limit'] : '';
		$offset = !empty($filters['offset']) ? $filters['offset'] : '';
		$is_page_positive_integer= $ci->common_lib->is_positive_integer($page);
		if ( !empty($page) and $is_page_positive_integer ) {
			$limit = '';
			$offset = '';
		}
		if (!empty($config_data) and $is_page_positive_integer) {
			$per_page= ( !empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page']) ) ? $filters['per_page'] : $items_per_page;
			$limit = $per_page;
			$offset = ($page - 1) * $per_page;
		}

		$is_cms_items_have_types_joined = false;
		if (!empty($filters['ci_title'])) {
			$this->db->like( $this->m_cms_items_table.'.ci_title', $filters['ci_title'] );
		}

		if (!empty($filters['created_at_from'])) {
			$this->db->where($this->m_cms_items_table.'.created_at >= ' . "'" . $filters['created_at_from'] . "'");
		}
		if (!empty($filters['created_at_till'])) {
			$this->db->where($this->m_cms_items_table.'.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
		}

		$additive_fields_for_select= "";
		$fields_for_select= $this->m_cms_items_table.".*";
		if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) and ( !empty($offset) and $ci->common_lib->is_positive_integer($offset) ) ) {
			$this->db->limit($limit, $offset);
		}

		if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) ) {
			$this->db->limit($limit);
		}
		$fields_for_select.= ' ' . $additive_fields_for_select;

		if (!empty($sort)) {
			$this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));
		}

		if ($OutputFormatCount) {
			return $this->db->count_all_results($this->m_cms_items_table);
		} else {
			$query = $this->db->from($this->m_cms_items_table);
			if (strlen(trim($fields_for_select)) > 0) {
				$query->select($fields_for_select);
			}
			$ci = & get_instance();
			$ret_array= $query->get()->result();
			return $ret_array;
		}
	}

	public function getCms_itemRowById( $id )
	{
		$this->db->where( $this->m_cms_items_table . '.ci_id', $id);
		$query = $this->db->from($this->m_cms_items_table);
		$ci = & get_instance();
		$resultRows = $query->get()->result();
		if ( !empty($resultRows[0]) ) {
			return $resultRows[0];
		}
		return false;
	}

	public function getSimilarCms_itemByCi_Title($ci_title, $ci_id='')
	{
		$config_data = $this->config->config;
		$this->db->where('ci_title', $ci_title);
		$this->db->from($this->m_cms_items_table);
		if (!empty($ci_id)) {
			$this->db->where('ci_id != ' . $ci_id);
		}
		$row= $this->db->get()->result();
		if (empty($row[0])) return false;
		return $row[0];
	}

	public function getSimilarCms_itemByCi_Alias($ci_alias, $ci_id='')
	{
		$config_data = $this->config->config;
		$this->db->where('ci_alias', $ci_alias);
		$this->db->from($this->m_cms_items_table);
		if (!empty($ci_id)) {
			$this->db->where('ci_id != ' . $ci_id);
		}
		$row= $this->db->get()->result();
		if (empty($row[0])) return false;
		return $row[0];
	}

	/* get Body of content by title of Content*/
	public function getBodyContentByAlias($pAlias, $ConstantsArray = array(), $is_content = true)
	{
		$query = $this->db->get_where($this->m_cms_items_table, array('ci_alias' => $pAlias), 1, 0);
		$ResultRow = $query->result();
		if (!empty($ResultRow[0]->ci_content)) {

			$Body = $is_content ? $ResultRow[0]->ci_content : $ResultRow[0]->ci_title;
			foreach ($ConstantsArray as $Key => $Value) {
				$Pattern = '/\[([\s]*' . $Key . '[\s]*)\]/xsi';
				$Body = preg_replace($Pattern, $Value, $Body);
			}
			return $Body;
			
		}
		return '';
	}

	public function getCmsItemIdByAlias($pAlias)
	{
		$query = $this->db->get_where($this->m_cms_items_table, array('ci_alias' => $pAlias), 1, 0);
		$ResultRow = $query->result();
		if (!empty($ResultRow[0]->ci_id)) {
			return $ResultRow[0]->ci_id;
		}
		return '';
	}

	public function deleteCmsItem($ci_id)
	{
		if (!empty($ci_id)) {
			$this->db->where('ci_id', $ci_id);
			$Res = $this->db->delete( $this->m_cms_items_table );
			return $Res;
		}
	}


	////////////// CMS ITEMS BLOCK END /////////////

}