<?php
class MarkAction extends CommonAction {
	public function index(){
		$ProjListInfo = D('Project');
		$res2 = $ProjListInfo->select();
		$this->assign("projlist",$res2);
		$pid = $_GET["_URL_"][2]?$_GET["_URL_"][2]:"1";
		$ClubsInfo = D('Schedule');
		$res = $ClubsInfo->where('pid='.$pid)->relation(true)->Select();
		$this->assign('list',$res);
		$this->assign('pid',$pid);
		$this->display();
	}
	public function getScore(){
		$aid = $_GET["_URL_"][3];
		$pid = $_GET["_URL_"][2];
		$uid = $_SESSION["awc_uid"];
		$record = D('Record');
		$data  = array(
			'aid'	=>$aid,
			'pid'	=>$pid,
			'uid'	=>$uid,
		);
		$res = $record->where($data)->select();
		$this->ajaxReturn($res);
	}
	public function addScore(){
		//post string example:
		//cwgl=1&zzgj=1&zdlscy=1&stqlpg=1&xxhjs=1&yzzqhd=1&hdyxl=1&hdwczl=1&hdcg=1&xnjl=1&xwjl=1

	}
}