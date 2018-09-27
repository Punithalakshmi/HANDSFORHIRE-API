<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Dashboard extends Admin_controller
{
    function __construct()
    {
      parent::__construct();
      if(!is_logged_in())
      	redirect('login/logout');
    }
    public function index()
    {
      $this->layout->view('frontend/dashboard');
    }
}
?>