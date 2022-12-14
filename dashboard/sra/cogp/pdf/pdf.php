<?php
header('Content-type: application/pdf');

use setasign\Fpdi\Fpdi;
use setasign\Fdpi\PdfReader;


require_once $_SERVER['DOCUMENT_ROOT'].'/coco/init/class/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/coco/vendor/pdfprototype/fpdf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/coco/vendor/pdfprototype/fpdi/src/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/coco/init/class/crypto.php';

$transId = crypto::decrypt($_GET['d'],"_johnmarknavarro");
$config = new config;
$con = $config->con();
$sql = "SELECT *,
(SELECT `name` FROM `tbl_accounts` AS A WHERE T.`user_id`= A.`id`) as submittedBy,
(SELECT `name` FROM `tbl_accounts` AS A WHERE T.`recBy`= A.`id`) as dean,
(SELECT `name` FROM `tbl_accounts` AS A WHERE T.`appencBy`= A.`id`) as registrar,
(SELECT `name` FROM `tbl_accounts` AS A WHERE T.`verBy`= A.`id`) as sra,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`user_id`= A.`id`) as signProf,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`recBy`= A.`id`) as signDean,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`appencBy`= A.`id`) as signReg,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`verBy`= A.`id`) as signSRA
FROM `tbl_transaction`AS T LEFT JOIN `tbl_grades`AS G ON G.`transId` = T.`transId` 
WHERE T.type LIKE '%COGP%' AND T.transId = :transId LIMIT 0,10";
$data= $con->prepare($sql);
$data->bindParam("transId", $transId, PDO::PARAM_STR); 
$data->execute();
$result = $data->fetchAll(PDO::FETCH_ASSOC);
if ($data->rowCount() > 0) {
    $filename = "ROF022.pdf";
    $pdf = new FPDI('L','mm','A4');
    $pdf->AddPage();
    $pdf->setSourceFile($filename);
    $template = $pdf->importPage(1);
    $pdf->useTemplate($template);
    $pdf->SetTextColor(0,0,0);
    $pdf->setFont('Helvetica');

    $pdf->SetFontSize(4.5);
    $pdf->setY(85.5);
    foreach($result as $data) {
   
    $sem = str_replace('Semester','', $data['sem']);
    $pdf->Cell(4);

    $pdf->Cell(9,5.7,$data['transId'],0,0,'C');
    $pdf->Cell(55,5.7,$data['stdName'],0,0,'C');
    $pdf->Cell(30,5.7,$data['clCode'],0,0,'C');
    $pdf->Cell(27,5.7,$data['subj'],0,0,'C');
    $pdf->Cell(9,5.7,$sem,0,0,'C');
    $pdf->Cell(9,5.7,$data['sy'],0,0,'C');
    $pdf->Cell(12,5.7,$data['clPartLec'],0,0,'C');
    $pdf->Cell(9,5.7,$data['perExLec'],0,0,'C');
    $pdf->Cell(13,5.7,$data['perGrLec'],0,0,'C');
    $pdf->Cell(10,5.7,$data['clPartLab'],0,0,'C');
    $pdf->Cell(11,5.7,$data['perExLab'],0,0,'C');
    $pdf->Cell(10,5.7,$data['perGrLab'],0,0,'C');
    $pdf->Cell(11,5.7,$data['weiGr'],0,0,'C');
    $pdf->Cell(12,5.7,$data['onePerGr'],0,0,'C');
    $pdf->Cell(9,5.7,$data['twoPerGr'],0,0,'C');
    $pdf->Cell(11,5.7,$data['threePerGr'],0,0,'C');
    $pdf->Cell(12,5.7,$data['finRate'],0,1,'C');

}

//signature Instructor
$pdf->Image("../../../../upload/signature/$data[signProf]","20","146","50","14");
$pdf->SetXY(78,158);
$pdf->SetFontSize(7);
$pdf->Write(0,$data['date_applied'],0,0);
$pdf->SetXY(25,157);
$pdf->SetFontSize(18);
$pdf->Write(0,$data['submittedBy'],0,0);

//signature Dean
$pdf->Image("../../../../upload/signature/$data[signDean]","110","146","40","10");
$pdf->SetXY(143,153);
$pdf->SetFontSize(5);
$pdf->Write(0,$data['recDate'],0,0);
$pdf->SetXY(110,153);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['dean'],0,0);

//signature SRA
$pdf->Image("../../../../upload/signature/$data[signSRA]","165","147","20","8");
$pdf->SetXY(176,154);
$pdf->SetFontSize(5);
$pdf->Write(0,$data['verDate'],0,0);
$pdf->SetXY(165,153);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['sra'],0,0);

//signature Registrar
$pdf->Image("../../../../upload/signature/$data[signReg]","200","146","20","10");
$pdf->SetXY(219,154);
$pdf->SetFontSize(5);
$pdf->Write(0,$data['appDate'],0,0);
$pdf->SetXY(200,153);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['registrar'],0,0);

//signature SRA2
$pdf->Image("../../../../upload/signature/$data[signSRA]","242","146","20","10");
$pdf->SetXY(261,154);
$pdf->SetFontSize(3);
$pdf->Write(0,$data['attDate'],0,0);
$pdf->SetXY(245,153);
$pdf->SetFontSize(10);
$pdf->Write(0,$data['sra'],0,0);


$pdf->Output('D', "ROF 022 | $transId.pdf");
//$pdf->Output();
}
?>