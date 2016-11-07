<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_fileupload extends CI_Driver {

	/**
	* jQuery Fileupload
    *
    * File Upload widget with multiple file selection, drag&drop support, progress bars, validation and preview images, audio and video for jQuery.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function fileupload($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css')
			);
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css')
			);
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css')
			);
		}

		// JavaScript File(s)

		if ($type == 'javascript') {
			// File Upload Plugin JS files
			//$this->CI->output->append_output('<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->');
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js')
			);
			// The Templates plugin is included to render the upload/download listings
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js')
			);
			// The Load Image plugin is included for the preview images and image resizing functionality
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js')
			);
			// The Canvas to Blob plugin is included for image resizing functionality
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js')
			);
			// blueimp Gallery script
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js')
			);
			// The Iframe Transport is required for browsers without support for XHR file uploads
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js')
			);
			// The basic File Upload plugin
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js')
			);
			// The File Upload processing plugin
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js')
			);
			// The File Upload image preview & resize plugin
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js')
			);
			// The File Upload audio preview plugin
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js')
			);
			// The File Upload video preview plugin
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js')
			);
			// The File Upload validate plugin
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js')
			);


			$this->CI->output->append_output('<!--[if (gte IE 8)&(lt IE 10)]>
');
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js')
			);
			$this->CI->output->append_output('<![endif]-->
');

		}

	}



}