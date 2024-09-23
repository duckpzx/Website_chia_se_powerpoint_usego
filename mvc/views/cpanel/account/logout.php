<?php 
require_once ("mvc/core/Controller.php");

class Logout extends Controller {
    private $MyModels;

    public function __construct()
    {
        $this->MyModels = $this->models('MyModelsCrud');
        $this->enforcement();
    }

    public function enforcement()
    {
        if (isLogin::checkLogin())
        {
            $token = Session::getSession('login_token_usego_userid');
            $this->MyModels->remove('ug_login_token', "tokenLogin = '$token'");
            Session::removeSession('login_token_usego_userid');
            // To Back Login 
            Request::Redirect('/usego');
        }
    }
}

$action = new Logout();
?>
<div class="block-top"></div>
<div class="containerLoading">
    <span>Vui lòng đợi </span>
    <img src="<?= _TEMPLATE . 'images/icons/circle-Loading.gif' ?>" width="40">
</div>