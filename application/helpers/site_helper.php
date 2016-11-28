<?php
/*******************
 * Check if string has email work
 * @params $key
 * 
 * @return string
 * @author Naz
*****************************************************/
if (!function_exists('is_valid_email')){
    function is_valid_email($key){
        $valid_email='';
        if (strpos($key, 'email') !== false) {
            $valid_email='|valid_email';
        }
        return  $valid_email; 
    }
}

/*******************
 * Create dropdown menu
 * $array required
 * $name = '', 
 * $default = '', 
 * $class = 'form-control',
 * $select FALSE/TRUE show select option 
 * $attributes = '', eg array of title, placeholder 'id="emailto", title="mail"''
 * 
*****************************************************/
if (!function_exists('MyCustom_menu')){
    function MyCustom_menu($array, $name = '', $class = 'form-control', $default = '', $select=FALSE, $attributes = '' ){
    $menu = '<select name="'.$name.'"';
	if ($class !== ''){
	    $menu .= ' class="'.$class.'"';
	}
	$menu .= _stringify_attributes($attributes).">\n";
//	if ($select){$menu .= '<option value="">'.lang('select')."</option>\n";}
	if ($select){$menu .= '<option value="">'.$select."</option>\n";}
	//if ($default ==''){$menu .= '<option value="">'.lang('select')."</option>\n";}
	foreach ($array as $key => $val){
	    $selected = ($default == $key) ? ' selected="selected"' : '';
            $menu .= '<option value="'.$key.'"'.$selected.'>'.$val."</option>\n";
	}
    return $menu.' </select>';
    }  
}


/*****************************
 * Covert PHP Object to multi dimen array
 * Params Obj, id (new array key value eg table ID)
 * return multi array
 *
 * ****************************/

function to_multi_array($obj,$id){
	$array=array();
	foreach($obj as $row):
		$vars = get_object_vars ( $row );
			foreach($vars as $key=>$value) {
				$array[$row->$id][$key]=$value;
			}
	endforeach;
	return $array;
}

/*****************************
 * Covert PHP Object to  array
 * Params Obj, id (new array key value eg table ID)
 * return array
 *
 * ****************************/

function object_to_array($obj,$id){
	$array=array();
	foreach($obj as $row):
		$vars = get_object_vars ( $row );
			foreach($vars as $key=>$value) {
				$array[$row->$id]=$value;
			}
	endforeach;
	return $array;
}

if ( ! function_exists('script_tag'))
{
	/**
	 * script
	 *
	 * Generates script tog to load JavaScript src files
	 *
	 * @param	mixed	JavaScript src or an array
	 * @param	string	type
	 * @param	string	rel
	 * @param	string	title
	 * @param	string	media
	 * @param	bool	should index_page be added to the css path
	 * @return	string
	 */
	function script_tag($src = '', $type = 'text/javascript', $rel = '', $title = '', $media = '', $index_page = FALSE)
	{
	
		$CI =& get_instance();
		$script = '<script ';

		if (is_array($src))
		{
			foreach ($src as $k => $v)
			{
				if ($k === 'src' && ! preg_match('#^([a-z]+:)?//#i', $v))
				{
					if ($index_page === TRUE)
					{
						$script .= 'src="'.$CI->config->site_url($v).'" ';
					}
					else
					{
						$script .= 'src="'.$CI->config->slash_item('base_url').$v.'" ';
					}
				}
				else
				{
					$script .= $k.'="'.$v.'" ';
				}
			}
		}
		else
		{
			if (preg_match('#^([a-z]+:)?//#i', $src))
			{
				$script .= 'src="'.$src.'" ';
			}
			elseif ($index_page === TRUE)
			{
				$script .= 'src="'.$CI->config->site_url($src).'" ';
			}
			else
			{
				$script .= 'src="'.$CI->config->slash_item('base_url').$src.'" ';
			}

			$script .= 'type="'.$type.'" ';

			if ($media !== '')
			{
				$script .= 'media="'.$media.'" ';
			}

			if ($title !== '')
			{
				$script .= 'title="'.$title.'" ';
			}
		}

		return $script."></script>\n";
	}
}


