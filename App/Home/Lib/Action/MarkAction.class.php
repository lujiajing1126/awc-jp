<?php
class MarkAction extends CommonAction {
	public function index(){
		$ClubsInfo = D('Club');
		$res = $ClubsInfo->select();
		$this->assign('list',$res);
		$this->display();
	}
}