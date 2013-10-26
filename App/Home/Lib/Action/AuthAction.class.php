<?php
class AuthAction extends Action {
	public function __construct() {
		parent::__construct();
		if (! empty ( $_SESSION ["awc_uid"] ) && ACTION_NAME !== "logout") {
			$this->redirect("Index/index");
		}
	}
	public function index() {
		$this->display('login');
	}
	public function login() {
		$data = array (
				'username' => $_GET ['username'],
				'password' => $_GET ['password']
		);

		$Admin = D ( 'User' );
		$ret = $Admin->login ( $data );
		if (isset ( $ret ['error'] )) {
			$this->error ( $ret ['error'] );
		}
		$this->redirect("Index/index",array(),3,"登陆成功，正在跳转...");
	}
	public function logout()  {
		$_SESSION = array();
		$this->redirect("Auth/index");
	}
}