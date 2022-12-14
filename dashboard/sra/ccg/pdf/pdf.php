<?php
header('Content-type: application/pdf');

use setasign\Fpdi\Fpdi;
use setasign\Fdpi\PdfReader;

require_once $_SERVER['DOCUMENT_ROOT'].'/coco-starterkit/init/class/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/coco-starterkit/vendor/pdfprototype/fpdf.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/coco-starterkit/vendor/pdfprototype/fpdi/src/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/coco-starterkit/init/class/crypto.php';

$transId = crypto::decrypt($_GET['d'],"_johnmarknavarro");
$config = new config;
$con = $config->con();
$sql = "SELECT *,
(SELECT `name` FROM `tbl_accounts` AS A WHERE T.`user_id`= A.`id`) as submittedBy,
(SELECT `name` FROM `tbl_accounts` AS A WHERE T.`recBy`= A.`id`) as dean,
(SELECT `name` FROM `tbl_accounts` AS A WHERE T.`appBy`= A.`id`) as vp,
(SELECT `name` FROM `tbl_accounts` AS A WHERE T.`appencBy`= A.`id`) as registrar,
(SELECT `name` FROM `tbl_accounts` AS A WHERE T.`verBy`= A.`id`) as sra,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`user_id`= A.`id`) as signProf,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`recBy`= A.`id`) as signDean,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`appBy`= A.`id`) as signVP,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`appencBy`= A.`id`) as signReg,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`verBy`= A.`id`) as signSRA,
(SELECT `collegedept` FROM `tbl_college` AS A WHERE T.`collegedept`= A.`id`) as collegedept 
FROM `tbl_transaction`AS T LEFT JOIN `tbl_grades`AS G ON G.`transId` = T.`transId` 
WHERE T.type LIKE '%CCG%' AND T.transId = :transId LIMIT 0,10";

$data= $con->prepare($sql);
$data->bindParam("transId", $transId, PDO::PARAM_STR);  
$data->execute();
$result = $data->fetchAll(PDO::FETCH_ASSOC);
if ($data->rowCount() > 0) {
    $filename = "ROF023.pdf";
    $pdf = new FPDI('L','mm','A4');
    $pdf->AddPage();
    $pdf->setSourceFile($filename);
    $template = $pdf->importPage(1);
    $pdf->useTemplate($template);
    $pdf->SetTextColor(0,0,0);
    $pdf->setFont('Helvetica');

    $pdf->SetFontSize(4.5);
    // $width_cell=array(42,49,40,37,9,8.75,5);
    $pdf->setY(64);
    foreach($result as $data) {
   
    $sem = str_replace('Semester','', $data['sem']);
    $pdf->Cell(4);

    $pdf->SetFontSize(4);
    $pdf->Cell(41,1,$data['transId'],0,0,'C');
    $pdf->SetFontSize(4.5);
    $pdf->Cell(10,1,$data['stdName'],0,0,'C');
    $pdf->Cell(60,1,$data['clCode'],0,0,'C');
    $pdf->Cell(-15,1,$sem.' & '.$data['sy'],0,0,'C');
    $pdf->Cell(38,1,$data['clPartLec'],0,0,'C');
    $pdf->Cell(-20,1,$data['perExLec'],0,0,'C');
    $pdf->Cell(40,1,$data['perGrLec'],0,0,'C');
    $pdf->Cell(-21,1,$data['clPartLab'],0,0,'C');
    $pdf->Cell(40,1,$data['perExLab'],0,0,'C');
    $pdf->Cell(-20,1,$data['perGrLab'],0,0,'C');
    $pdf->Cell(40,1,$data['weiGr'],0,0,'C');
    $pdf->Cell(-22,1,$data['clPartCor'],0,0,'C');
    $pdf->Cell(42,1,$data['perExCor'],0,0,'C');
    $pdf->Cell(-22,1,$data['perGrCor'],0,0,'C');
    $pdf->Cell(42,1,$data['weiGrCor'],0,0,'C');
    $pdf->Cell(-23,1,$data['onePerGr'],0,0,'C');
    $pdf->Cell(38,1,$data['twoPerGr'],0,0,'C');
    $pdf->Cell(-21,1,$data['threePerGr'],0,0,'C');
    $pdf->Cell(40,1,$data['finRate'],0,1,'C');

    }

//\\===========================================================//\\

// Instructor name with signature
$pdf->Image("../../../../upload/signature/$data[signProf]","80","32","40","12");
$pdf->SetXY(52,41);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['submittedBy'],0,0);

// Instructor College
$pdf->SetFontSize(6);
$pdf->SetXY(147,40);
$pdf->Write(0,$data['collegedept'],0,0);

// Date submitted
$pdf->SetFontSize(6);
$pdf->SetXY(205,40);
$pdf->Write(0,$data['date_applied'],0,0);

//\\===========================================================//\\

//signature Dean + date signed
$pdf->Image("../../../../upload/signature/$data[signDean]","40","128","50","15");
$pdf->SetXY(30,145);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['dean'],0,0);
$pdf->SetXY(80,146);
$pdf->SetFontSize(6);
$pdf->Write(0,$data['recDate'],0,0);

//signature VP + date signed
$pdf->Image("../../../../upload/signature/$data[signVP]","103","128","50","15");
$pdf->SetXY(103,145);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['vp'],0,0);
$pdf->SetXY(132,146);
$pdf->SetFontSize(6);
$pdf->Write(0,$data['appDate'],0,0);

//signature Registrar + date signed
$pdf->Image("../../../../upload/signature/$data[signReg]","162","128","50","15");
$pdf->SetXY(155,145);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['registrar'],0,0);
$pdf->SetXY(187,146);
$pdf->SetFontSize(6);
$pdf->Write(0,$data['appencDate'],0,0);

//signature SRA + date signed
$pdf->Image("../../../../upload/signature/$data[signSRA]","212","128","30","12");
$pdf->SetXY(212,142);
$pdf->SetFontSize(9);
$pdf->Write(0,$data['sra'],0,0);
$pdf->SetXY(212,146);
$pdf->SetFontSize(6);
$pdf->Write(0,$data['verDate'],0,0);

//Instructor signature part 2
$pdf->Image("../../../../upload/signature/$data[signProf]","245","132","20","8");
$pdf->SetXY(244,143);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['submittedBy'],0,0);

//signature SRA2 + date signed
$pdf->Image("../../../../upload/signature/$data[signSRA]","245","150","15","6");
$pdf->SetXY(242,153);
$pdf->SetFontSize(6);
$pdf->Write(0,$data['verDate'],0,0);

//\\===========================================================//\\

$pdf->Output('D', "ROF 023 | $transId.pdf");
//$pdf->Output();
}
?>