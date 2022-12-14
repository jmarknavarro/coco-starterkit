<?php
// header('Content-type: application/pdf');

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
(SELECT `name` FROM `tbl_accounts` AS A WHERE T.`appBy`= A.`id`) as registrar,
(SELECT `name` FROM `tbl_accounts` AS A WHERE T.`verBy`= A.`id`) as sra,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`user_id`= A.`id`) as signProf,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`appBy`= A.`id`) as signReg,
(SELECT `signature` FROM `tbl_accounts` AS A WHERE T.`verBy`= A.`id`) as signSRA
FROM `tbl_transaction`AS T LEFT JOIN `tbl_grades`AS G ON G.`transId` = T.`transId` 
WHERE T.type LIKE '%COG%' AND T.transId = :transId LIMIT 0,10";
$data= $con->prepare($sql);
$data->bindParam("transId", $transId, PDO::PARAM_STR); 
$data->execute();
$result = $data->fetchAll(PDO::FETCH_ASSOC);
if ($data->rowCount() > 0) {
    $filename = "ROF078.pdf";
    $pdf = new FPDI('L','mm','A4');
    $pdf->AddPage();
    $pdf->setSourceFile($filename);
    $template = $pdf->importPage(1);
    $pdf->useTemplate($template);
    $pdf->SetTextColor(0,0,0);
    $pdf->setFont('Helvetica');
    foreach($result as $data) {
        if($data['term'] == 'Prelim'){
           $pdf->SetXY(79.5,45.5);
           $pdf->SetFontSize(15);
           $pdf->Write(0,'X');
       }else if($data['term'] == 'Midterm'){
           $pdf->SetXY(129,45.5);
           $pdf->SetFontSize(15);
           $pdf->Write(0,'X');
       }else if($data['term'] == 'Finals'){
           $pdf->SetXY(183.5,45.5);
           $pdf->SetFontSize(15);
           $pdf->Write(0,'X');
       }  
   }


    $pdf->SetFontSize(5.5);
    $width_cell=array(15,49,40,37,9,8.75,5);
    $pdf->setY(86.5);
    foreach($result as $data) {
   
    $sem = str_replace('Semester','', $data['sem']);
    $newsy = preg_replace('/\b\d{2}/','$1', $data['sy']);
    $pdf->Cell(4);

    $pdf->Cell($width_cell[0],5,$data['transId'],0,0,'C');
    $pdf->Cell($width_cell[1],5,$data['stdName'],0,0,'C');
    $pdf->Cell($width_cell[2],5,$data['clCode'],0,0,'C');
    $pdf->Cell($width_cell[3],5,$data['subj'],0,0,'C');
    $pdf->Cell($width_cell[4],5,$sem,0,0,'C');
    $pdf->Cell($width_cell[4],5,$newsy,0,0,'C');
    $pdf->Cell($width_cell[5],5,$data['clPartLec'],0,0,'C');
    $pdf->Cell($width_cell[5],5,$data['perExLec'],0,0,'C');
    $pdf->Cell($width_cell[5],5,$data['perGrLec'],0,0,'C');
    $pdf->Cell($width_cell[5],5,$data['clPartLab'],0,0,'C');
    $pdf->Cell($width_cell[5],5,$data['perExLab'],0,0,'C');
    $pdf->Cell($width_cell[5],5,$data['perGrLab'],0,0,'C');
    $pdf->Cell($width_cell[5],5,$data['weiGr'],0,0,'C');
    $pdf->Cell($width_cell[5],5,$data['onePerGr'],0,0,'C');
    $pdf->Cell($width_cell[5],5,$data['twoPerGr'],0,0,'C');
    $pdf->Cell($width_cell[5],5,$data['threePerGr'],0,0,'C');
    $pdf->Cell($width_cell[5],5.8,$data['finRate'],0,1,'C');

}

//signature Instructor
$pdf->Image("../../../../upload/signature/$data[signProf]","20","146","50","14");
$pdf->SetFontSize(6);
$pdf->SetXY(70,159);
$pdf->Write(0,$data['date_applied'],0,0);
$pdf->SetXY(30,159);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['submittedBy'],0,0);

//signature SRA
$pdf->Image("../../../../upload/signature/$data[signSRA]","90","145","40","14");
$pdf->SetXY(127,155);
$pdf->SetFontSize(6);
$pdf->Write(0,$data['verDate'],0,0);
$pdf->SetXY(96,154);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['sra'],0,0);

//signature Registrar
$pdf->Image("../../../../upload/signature/$data[signReg]","150","145","40","14");
$pdf->SetXY(186,155);
$pdf->SetFontSize(6);
$pdf->Write(0,$data['appDate'],0,0);
$pdf->SetXY(154,154);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['registrar'],0,0);

//signature SRA2
$pdf->Image("../../../../upload/signature/$data[signSRA]","210","145","40","14");
$pdf->SetXY(248,155);
$pdf->SetFontSize(6);
$pdf->Write(0,$data['attDate'],0,0);
$pdf->SetXY(212,154);
$pdf->SetFontSize(12);
$pdf->Write(0,$data['sra'],0,0);


$pdf->Output('D', "ROF 078 | $transId.pdf");
//$pdf->Output();
}
?>