<?php 
require('D:/xampp/htdocs/admin/vendor/autoload.php');

class Errors extends CI_controller
{
    public function index()
    {

    }


    /************ Error 404 error Function ********/
    public function error_404()
    {
        $this->load->view('errors/html/error_404'); /***** Load error_404 File *********/
    }
}

?>