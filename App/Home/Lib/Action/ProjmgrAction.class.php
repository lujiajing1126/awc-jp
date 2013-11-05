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
		//获取社团列表
		$ClubsInfo = D('Club');
		$res3 = $ClubsInfo->select();
		$this->assign('list3',$res3);
		//获取项目列表
		$ProjsInfo2 = D('Project');
		$res = $ProjsInfo2->select();
		$this->assign('list2',$res);
		//获取项目计划表并做关联查询
		$ProjsInfo = D('Schedule');
		$res2 = $ProjsInfo->relation(true)->Select();
		$this->assign('list',$res2);
		$this->display("Proj/editsch");
	}
	public function edituser(){
		$UsersInfo = D('User');
		$res = $UsersInfo->select();
		$this->assign('list',$res);
		$this->display("Proj/edituser");
	}

}