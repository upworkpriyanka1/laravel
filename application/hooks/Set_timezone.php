<?php
/***************
 * WebNaz CMS
 * 
 * A free and open source CMS
 *
 * @package		Hooks(WebNazCMS)
 * @author		Naz (www.webnaz.net)
 * @copyright	Copyright (c) 2012 - 2015 webnaz.net
 * @license		https://www.webnaz.net/license.txt
 * @link		https://www.webnaz.net
 * 
 ****************/

/* Set default timezone if not set
 * @params, UTC
 */
class  Set_timezone
{
    public function Set_DefaulT_Timezone()
    {
        if (!ini_get('date.timezone')) {
            date_default_timezone_set('UTC');
        }
    }
}