<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

    function __construct()
    {
        parent::__construct();        
    }

    public function error_404()
    {   
        show_404();    
    }

}

/* End of file error.php */
/* Location: ./application/controllers/error.php */
