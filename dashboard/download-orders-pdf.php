<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Correct path for autoload
include __DIR__ . '/../inc/inc.db.php'; // Correct path for db include

$database = new Connection();
$connect = $database->open();

// Create new PDF document
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Admin');
$pdf->SetTitle('All Orders');
$pdf->SetHeaderData('', 0, 'All Orders', 'Generated on '.date('Y-m-d'));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(10, 20, 10);
$pdf->SetAutoPageBreak(TRUE, 20);
$pdf->SetFont('dejavusans', '', 10);
$pdf->AddPage();

$html = '<h2>All Orders</h2>';
$html .= '<table border="1" cellpadding="4">
<tr style="background-color:#f2f2f2;">
<th>Order #</th><th>Product(s)</th><th>Customer</th><th>Date</th><th>Status</th><th>Total</th>
</tr>';

$select_allorders = "SELECT * FROM sales ORDER BY dateadded DESC";
$prepare_allorders = $connect->prepare($select_allorders);
$prepare_allorders->execute();
$iu = 1;
while ($fetch_allorders = $prepare_allorders->fetch(PDO::FETCH_ASSOC)) {
    $select_preorder = "SELECT * FROM cart_product WHERE salesId='".$fetch_allorders['salesId']."'";
    $prepare_preorder = $connect->prepare($select_preorder);
    $prepare_preorder->execute();
    $newtotal = 0;
    $name = '';
    $i = 1;
    while ($fetch_preorder = $prepare_preorder->fetch(PDO::FETCH_ASSOC)) {
        $newtotal += $fetch_preorder['price'] * $fetch_preorder['quantity'];
        $selectproder = "SELECT * FROM products WHERE productId='".$fetch_preorder['productId']."'";
        $prepareproder = $connect->prepare($selectproder);
        $prepareproder->execute();
        while ($fetchproder = $prepareproder->fetch(PDO::FETCH_ASSOC)) {
            $name .= $i.'. '.$fetchproder['product_name'].'<br>';
            $i++;
        }
    }
    $select_user = "SELECT * FROM users WHERE userId='".$fetch_allorders['userId']."'";
    $prepare_user = $connect->prepare($select_user);
    $prepare_user->execute();
    $fetch_user = $prepare_user->fetch(PDO::FETCH_ASSOC);
    $customer = $fetch_user ? $fetch_user['first_name'].' '.$fetch_user['last_name'] : 'Unknown';
    $date = date('d M Y', strtotime($fetch_allorders['dateadded']));
    $status = ucfirst($fetch_allorders['status']);
    $html .= '<tr>';
    $html .= '<td>'.$iu.'</td>';
    $html .= '<td>'.$name.'</td>';
    $html .= '<td>'.$customer.'</td>';
    $html .= '<td>'.$date.'</td>';
    $html .= '<td>'.$status.'</td>';
    $html .= '<td>'.$newtotal.'</td>';
    $html .= '</tr>';
    $iu++;
}
$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('all_orders.pdf', 'D');
exit;
