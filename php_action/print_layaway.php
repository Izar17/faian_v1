<html>
<head>
    <link rel="stylesheet" type="text/css" href="./custom/css/print.css"/>
</head>
<body>
<?php    

require_once 'core.php';

$orderId = $_POST['orderId'];



$sql = "SELECT order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_place, gstn, cash, gcash, bank, date_today, credit_card, order_type, due_date FROM layaway_orders WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();


$user = $_SESSION['userId'];
$sql2 = "SELECT username FROM users WHERE user_id = $user";
$userResult = $connect->query($sql2);
$userData = $userResult->fetch_array();
$cashier = $userData[0];


$orderDate = $orderData[0];
$clientId = $orderData[1];
$clientContact = $orderData[2]; 
$subTotal = $orderData[3];
$vat = $orderData[4];
$totalAmount = $orderData[5]; 
$discount = $orderData[6];
$grandTotal = $orderData[7];
$paid = $orderData[8];
$due = $orderData[9];
$payment_place = $orderData[10];
$gstn = $orderData[11];
$cash = $orderData[12];
$gcash = $orderData[13];
$bank = $orderData[14];
$dateToday = $orderData[15];
$credit = $orderData[16];
$orderType = $orderData[17];
$dueDate = $orderData[18];

if($orderType == 1) {
    $oType = "Layaway";
    $dType = "Due Date";
} else if($orderType == 2) {
    $oType = "Reservation";
    $dType = "For Pick-Up Date";
}else if($orderType == 3) {
    $oType = "For Pick-Up";
    $dType = "For Pick-Up Date";
} else {
    $oType = "For Delivery";
    $dType = "For Delivery Date";
}


$clientSql = "SELECT name, address FROM customer WHERE id = '$clientId'";
$clientResult = $connect->query($clientSql);
$clientData = $clientResult->fetch_array();
$clientName = $clientData[0];

$orderItemSql = "SELECT loi.product_id, loi.rate, loi.quantity, loi.total,
product.product_name, brands.brand_type FROM layaway_order_item loi
   INNER JOIN product ON loi.product_id = product.product_id 
   INNER JOIN brands ON product.brand_id = brands.brand_id
 WHERE loi.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);
?>



<div id="invoice-POS"> 
    <center id="top">
      <div class="logo">
        <img src="./custom/css/logo2.jpg" style="width:120px;height:50px;"/>
      </div>
      <div class="info"> 
        <h2>FAIAN GOLD</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <p><strong>Contact Info</strong><br>
            Address : G/F WNAS 19 WalterMart Mall, Lumbangan Nasugbu, Batangas</br>
        </p>
        <p><strong>Date :</strong> <?php echo $dateToday; ?></p>
        <p><strong>Cashier :</strong> <?php echo $cashier; ?></p>
        <p><strong>Customer</strong>
        <br>Name : <?php echo $clientName; ?>
        <br>Contact # : <?php echo $clientContact; ?>
        <br>Order ID : <?php echo $orderId; ?>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">
    <p><strong>Orders</strong></p>
            <div id="table1">
            <?php 
            
            $table1='<table>';
            if($cash != ""){
            $table1 .='<tr class="service">
                    <td class="tableitem"><p class="itemtext">Cash:</p></td><td class="tableitem"><p class="itemprice">P'.number_format($cash,2).'</p></td>
                </tr>';
            }
            if($gcash != ""){
            $table1 .='<tr class="service">
                    <td class="tableitem"><p class="itemtext">E-Wallet:</p></td><td class="tableitem"><p class="itemprice">P'.number_format($gcash,2).'</p></td>
                </tr>';
            }
            if($bank != ""){
            $table1 .='<tr class="service">
                    <td class="tableitem"><p class="itemtext">Bank:</p></td><td class="tableitem"><p class="itemprice">P'.number_format($bank,2).'</p></td>
                </tr>';
            }
            if($credit != ""){
            $table1 .='<tr class="service">
                    <td class="tableitem"><p class="itemtext">Credit Card:</p></td><td class="tableitem"><p class="itemprice">P'.number_format($credit,2).'</p></td>
                </tr>';
            }
            $table1 .='
            <tr><td colspan="3">______________________</td></tr>
            <tr class="service">
                <td class="tableitem"><p class="itemtext">Total Paid:</p></td><td class="tableitem"><p class="itemprice">P'.number_format($paid,2).'</p></td>
            </tr>
            <tr class="service">
                <td class="tableitem"><p class="tabletitle"><strong>Due:</strong></p></td>
                <td class="tableitem"><p class="itemprice"><strong>P'.number_format($due,2).'</strong></p></td>
            </tr>
            <tr class="service">
                <td class="tableitem"><p class="tabletitle"><strong>'.$dType.'</strong></p></td>
                <td class="tableitem"><p class="itemprice"><strong>'.$dueDate.'</strong></p></td>
            </tr>
            <tr class="service">
                <td class="tableitem"><p class="tabletitle"><strong>Order Type:</strong></p></td>
                <td class="tableitem"><p class="itemprice"><strong>'.$oType.'</strong></p></td>
            </tr>
            
            </table>';
            ?>
        </div>
        <div id="table">
        <?php $table='
            <table>
                <tr class="tabletitle">
                    <td class="item"><h2>Item</h2></td>
                    <td class="Hours"><h2>Qty</h2></td>
                    <td class="Rate"><h2>Sub Total</h2></td>
                </tr>';

                $x = 1;
                $cgst = 0;
                $igst = 0;
                //Set Vat Multiplier
                if($payment_place == 2)
                {
                   $igst = $subTotal*0/100;
                }
                else
                {
                   $cgst = $subTotal*0/100;
                }
                $total = $subTotal+2*$cgst+$igst;
                $n=0;
                $qtyTotal=0;
                while($row = $orderItemResult->fetch_array()) {    
                    if($row[5] != 1){
                        $qty = $row[2];
                    } else {
                        $qty = "1";
                    }
                    $qtyTotal+=$qty;
                    $table .= '<tr class="service">
                    <td class="tableitem"><p class="itemtext">'.$row[4].'</p></td>
                    <td class="tableitem"><p class="itemtext">'.$qty.'</p></td>
                    <td class="tableitem"><p class="itemprice">P'.number_format($row[3],2).'</p></td>
                    </tr>';
                    $n++;
                }
            $table .='
                <tr><td colspan="3">______________________</td></tr>
                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Total</p></td>
                    <td><p class="itemtext">'.$qtyTotal.'</p></td>
                    <td class="tableitem"><p class="itemprice">P'.number_format($total,2).'</p></td>
                </tr>
            </table>';
            $connect->close();
            echo $table;
            echo"<p><strong>Payment Type</strong></p>";
            echo $table1;
            ?>
        </div>
        <!--End Table-->
        <div id="legalcopy">
            <p class="legal">Please check the item before you leave, Strictly No Return! No Exchange!</p>
            <p><strong>Thank you!</strong></p>
        </div>
    </div><!--End InvoiceBot-->
  </div><!--End Invoice-->
</body>
</html>