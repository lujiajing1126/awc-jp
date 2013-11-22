<?php
Vendor('PHPExcel.PHPExcel');
class ApiAction extends CommonAction {
	public function __construct() {
		parent::__construct ();
		parent::authAdmin ();
	}
	public function export()  {
		$pid = (int)$_GET['pid'];
		$Model = new Model();
		$sql = "SELECT paid,pa.pid,projects.pname,pa.aid,club.`name`,adminrec.total AS `awc_rec`,AVG(record.total) AS `voter_rec` FROM pa
LEFT JOIN club ON pa.aid = club.aid
LEFT JOIN adminrec ON pa.aid = adminrec.aid
LEFT JOIN record ON pa.pid = record.pid AND pa.aid = record.aid
LEFT JOIN projects ON pa.pid = projects.pid
WHERE pa.pid = ".$pid."
GROUP BY paid";
		$res = $Model->query($sql);
		//$this->ajaxReturn($res);
	}
	public function exportfile()  {
		$pid = (int)$_GET['pid'];
		$Model = new Model();
		$sql = "SELECT paid,pa.pid,projects.pname,pa.aid,club.`name`,adminrec.total AS `awc_rec`,AVG(record.total) AS `voter_rec` FROM pa
LEFT JOIN club ON pa.aid = club.aid
LEFT JOIN adminrec ON pa.aid = adminrec.aid
LEFT JOIN record ON pa.pid = record.pid AND pa.aid = record.aid
LEFT JOIN projects ON pa.pid = projects.pid
WHERE pa.pid = ".$pid."
GROUP BY paid";
		$res = $Model->query($sql);
		$title = array("计划表编号","场次编号","场次名称","社团编号","社团名称","评委均分","社团部评分","总分");
		$this->outputExcel($title,$res,'b');
	}
	protected function outputExcel($title,$data,$mod="d",$output="export_result.xlsx")  {
		$pointer = 1;
		$objExcel = new PHPExcel();
		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$objProps = $objExcel->getProperties();
		$objProps->setCreator("Megrez Lu");
		$objProps->setLastModifiedBy("Megrez Lu");
		$objProps->setTitle("社团评精答辩会打分结果");
		$objProps->setSubject("社团评精答辩会");
		$objProps->setDescription("社团评精答辩会的分场次的结果导出文件, generated by PHPExcel.");
		$objProps->setKeywords("FDU SU Megrez Assn Awc-jp");
		$objProps->setCategory("File Generated Automatically");
		$objExcel->setActiveSheetIndex(0);
		$objActSheet = $objExcel->getActiveSheet();
		if(gettype($title) == "array" ){
			for($i=0;$i<count($title);$i++){
				$column = chr(65+$i).$pointer;//ASCII to Char
				if($mod == 'd')  {
					echo $column.": ".$title[$i]."<BR>";
				}
				$objActSheet->setCellValue($column, $title[$i]);
			}
			$pointer++;
		}
		if(gettype($data)== "array" && $data != null){
			for($j=0;$j<count($data);$j++){
				$i = 0;
				foreach ($data[$j] as $val)  {
					$column = chr(65+$i).$pointer;
					if($mod == 'd')
						echo $column."<BR>";
					$objActSheet->setCellValue($column, $val);
					$i++;
				}
				$objActSheet->setCellValue("H".$pointer, "=SUM(F".$pointer.":G".$pointer.")");
				$pointer++;
			}
		}
		//output to broswer
		if($mod=="b")  {
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");
			header('Content-Disposition:inline;filename="'.$output.'"');
			header("Content-Transfer-Encoding: binary");
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Pragma: no-cache");
			$objWriter->save('php://output');
		}
	}
}