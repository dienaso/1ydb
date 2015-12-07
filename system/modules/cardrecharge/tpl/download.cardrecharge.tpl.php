<?php 
defined('G_IN_ADMIN')or exit('No permission resources.'); 
class download_cardrecharge{
	/**	$operationtype：固定卡/随机卡，$money：金额，$km：卡密类型，$isrepeat：是否一次性，$rechargetime：过期时间，
	$codepwd：密码，$maxrepeatcount：（固定卡）最多可重复性次数，$zhang	：总张数，
	**/
	public function  download_cardrecharge ($operationtype,$money,$km,$isrepeat,$rechargetime,$codepwd,$maxrepeatcount,$zhang){
		//PHPExcel.php文件的物理路径
		$path = str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']).'system/modules/phpexcel/';
        $path = $path."PHPExcel.php";
		require_once $path;		
	   //卡密充值导出Excel		
	    $objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A1:G1')
					->setCellValue('A1', '此次生成卡信息')
					->setCellValue('A2', '序号')//表头开始
					->setCellValue('B2', '卡号')
					->setCellValue('C2', '密码')
					->setCellValue('D2', '卡密类型')
					->setCellValue('E2', '金额')
					->setCellValue('F2', '过期时间')
					->setCellValue('G2', '最多可重复次数');//表头结束
		$i=3;$k=0;
		while($k<$zhang){		     
			$objPHPExcel->getActiveSheet()->setCellValue('A'.($k+$i), $k+1);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.($k+$i), $km[$k]);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.($k+$i),$codepwd[$k],PHPExcel_Cell_DataType::TYPE_STRING);
			if($isrepeat=='Y')$isrepeat="一次性充值卡";
			if($isrepeat=='N')$isrepeat="可重复性性充值";
			$objPHPExcel->getActiveSheet()->setCellValue('D'.($k+$i), $isrepeat);
			if(is_array($money)){
				#数组
				$objPHPExcel->getActiveSheet()->setCellValue('E'.($k+$i), $money[$k]);
			}else{
				#字符串
				$objPHPExcel->getActiveSheet()->setCellValue('E'.($k+$i), $money);
			}
			$objPHPExcel->getActiveSheet()->setCellValue('F'.($k+$i),date("Y-m-d",$rechargetime));
			$objPHPExcel->getActiveSheet()->setCellValue('G'.($k+$i), $maxrepeatcount);
			$k++;							
		}
		
		$objPHPExcel->getActiveSheet()->freezePane('A4');
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('123');
		//Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
		$sharedStyle1 = new PHPExcel_Style();
		$sharedStyle2 = new PHPExcel_Style();
		$sharedStyle3 = new PHPExcel_Style();
		
		$sharedStyle1->applyFromArray(
			array('fill' 	=> array(
										'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
										'color'		=> array('argb' => 'C0C0C0')
									),
			
				'alignment' => array(
										'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
									),
				'borders' => array(
										'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
										'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
										'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
										'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
									)

				 ));
		$sharedStyle2->applyFromArray(
			array('fill' 	=> array(
										'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
										'color'		=> array('argb' => 'FFFF00')//第三行表头颜色
									),
				'alignment' => array(
										'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
									),
				'borders' => array(
										'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
										'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
										'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
										'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
									),
				'font' 	=> array(
										'size'		=> 12
									)
				 ));	
		$sharedStyle3->applyFromArray(
			array(
					'alignment' => array(
										'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
									),
					'font' 	=> array(
										'size'		=> 18,
										'color'		=> array('argb' => '1E90FF')//第一行表头文字颜色
									)
				 ));
				 
		$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A2:G".($k+2));
		$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, "A2:G2"); 
		$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle3, "A1:G1");
	
		// Redirect output to a client's web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		
		header('Content-Disposition: attachment;filename="此次生成卡信息.xlsx"');//表格导出的文件名
		header('Cache-Control: max-age=0');
	
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		$objWriter->save('php://output');
		exit;

	}
	
}