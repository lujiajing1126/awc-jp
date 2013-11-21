<?php
class MarkAction extends CommonAction {
	public function index(){
		$ProjListInfo = D('Project');
		$res2 = $ProjListInfo->select();
		$this->assign("projlist",$res2);
		$pid = $_GET["_URL_"][2]?$_GET["_URL_"][2]:"1";
		$ClubsInfo = D('Schedule');
		$res = $ClubsInfo->where('pid='.$pid)->relation(true)->order('paid')->Select();
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
		$InserRec = D("Record");
		if (!$InserRec->create()){
			// 如果创建失败 表示自动验证没有通过 输出错误提示信息
			$this->ajaxReturn($InserRec->getError(),'JSON');
		}else{
			// 验证通过 进行Insert操作，并返回成功信息
			$InserRec->add();
			$result = array("res"=>"success");
			$this->ajaxReturn($result,'JSON');
		}
	}
}