<?php
require_once ("mvc/core/Controller.php");
require_once ("mvc/core/Request.php");

class LayoutNoInterFace extends Controller {
    public function __construct()
    {
       if( isLogin::checkLogin() )
       {
            if( $this->elseLogOut() )
            {
                Request::Redirect('/usego');
            }
       }
    }

    public function elseLogOut()
    {       
        $uri = $_SERVER ['REQUEST_URI'];
        if( $uri !== '/usego/account/logout' )
        {
            return true;
        }
    }
}
    $layout = new LayoutNoInterFace();
    // New object 
    
    // Load Header
    $layout->resources('layouts/account-header', $data ['resources']);

    // Main page
    if( file_exists("./mvc/views/cpanel/" . $data ['page'] . ".php"))
    {
        require_once "./mvc/views/cpanel/" . $data ['page'] . ".php";
    } 

    // Load Footer
    $layout->resources('layouts/account-footer', $data ['resources']);
