<?php
class ProjmgrAction extends CommonAction {
	public function __construct() {
		parent::__construct();
		parent::authAdmin();
	}

	public function editassn() {
		$ClubsInfo = D('Club');
		$res = $ClubsInfo->select();
		$this->assign('list',$res);
		$this->display("Proj/editassn");
	}
	public function editmarks() {
		$ProjsInfo = D('Project');
		$res = $ProjsInfo->select();
		$this->assign('list',$res);
		$this->display("Proj/editmarks");
	}
	public function showresult(){
		$this->display("Proj/showret");
	}
	public function editsch(){
		$ProjsInfo = D('Schedule');
		$res = $ProjsInfo->relation(true)->Select();
		$this->assign('list',$res);
		$this->display("Proj/editsch");
	}
	public function edituser(){
		$UsersInfo = D('User');
		$res = $UsersInfo->select();
		$this->assign('list',$res);
		$this->display("Proj/edituser");
	}

}