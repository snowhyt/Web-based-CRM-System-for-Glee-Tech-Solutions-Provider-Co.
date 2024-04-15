<?php 
    include 'session.php'; 
    include 'header.php';
    include 'functions.php';

    $id = $_GET['id'];
    $id = explode('-',$id);
    $invoice_id = $id[0];
    $request_id =$id[1];

    $sql = "SELECT requests.paid, CONCAT(admin.firstname,' ',admin.lastname) 'customer_name', invoice.customer_street, CONCAT(invoice.customer_barangay,', ',invoice.customer_city) 'customer_barangay_city', CONCAT(invoice.customer_province, ', ',invoice.customer_region) 'customer_province_region', invoice.customer_postal, invoice.invoice_id, invoice.issued_date, services.service_name, invoice.service_amount, invoice.service_discount, invoice.tax_rate, invoice.tax_amount, invoice.total, invoice.service_details FROM invoice LEFT JOIN admin ON invoice.customer_id=admin.id LEFT JOIN requests ON invoice.request_id LEFT JOIN services ON requests.service_id=services.service_id WHERE invoice.invoice_id='$invoice_id' AND requests.request_id='$request_id'";
    $query = $conn->query($sql);
    $invoice_data = $query->fetch_assoc();
?>
<style>
* {
  box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column1 {
  float: left;
  width: 15%;
  padding: 10px;
}

.column2 {
   float: left;
   width: auto;
   padding: 10px;
}

.column3 {
   float: right;
   width: 15%;
   padding: 10px;
}

.company-address {
    float: left;
    padding:0px 0px 0px 15px;
}

.company-contact {
    float: right;
    padding:0px 80px 0px 0px;
}

.company-name {
    padding:5px 5px 5px 15px;
    font-weight: bold;
}

.company-logo{
    padding:0px 0px 0px 10px;
}

.customer{
    float: left;
    padding: 20px 0px 0px 15px;
}

.title-header{
   font-weight: bold;
}

.invoice-details{
    float: right;
    padding:20px 250px 0px 0px;
}

.invoice-headers{
    font-weight: bold;
    color: gray;
}

.service-details{
    float:left;
    padding: 20px 0px 0px 15px;
}

.service-description-title{
    font-weight: bold;
    padding: 0px 0px 0px 8px;
}


.service-description{
    padding: 0px 0px 0px 8px;
    width:700px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

@media print {
  #printInvoice {
    display: none;
  }

  @page {
    margin-top: 0;
    margin-bottom: 0;
  }
  body  {
    padding-top: 2rem;
    padding-bottom: 2rem;
    padding-left:2rem;
    padding-right:2rem;
  }
}
</style>

<body>
    <div class="column1"></div>
        <div class="column2">
           <!--company details-->
            <div class="row">
                <!--company logo-->
                <image class="company-logo" src="../payroll/images/icon.png"></image>
                <!--company name-->
                <h4 class="company-name">GLEE Tech Solutions Provider Co.</h4>
                <!--company address-->
                <div class="company-address">              
                    <p>56 Luis Palad cor. C.M Recto Street</p>
                    <p>Tayabas City</p>
                    <p>Quezon, Philippines</p>
                    <p>4327</p>
                </div>
                <!--company contact-->
                <div class="company-contact">
                    <p>contact-us@gleetechsolutionsproviderco.com</p>
                    <p>+639338154244</p>
                    <p>https://gleetechsolutionsproviderco.com</p>
                </div>
                
                 <!--paid stamp-->
                 <?php
                    if($invoice_data['paid']){
                        echo "<image src='../service_management/images/paid.png' style='width:200px;position:absolute;'></image>";
                    }
                 ?>
            </div>
            
            <!--customer details-->
            <div class="row">
                <!--customer details-->
                <div class="customer">
                    <p class="title-header">BILLED TO</p>
                    <p><?php echo $invoice_data['customer_name'];?></p>
                    <p><?php echo $invoice_data['customer_street'];?></p>
                    <p><?php echo $invoice_data['customer_barangay_city'];?></p>
                    <p><?php echo $invoice_data['customer_province_region'];?></p>
                    <p><?php echo $invoice_data['customer_postal'];?></p>
                </div>

                <!--invoice details-->
                <div class="invoice-details">
                    <p class="title-header">INVOICE</p>
                    <p class="invoice-headers">Invoice Number</p>
                    <p><?php echo $invoice_data['invoice_id'];?></p>
                    <br>
                    <p class="invoice-headers">Issued Date</p>
                    <p><?php echo $invoice_data['issued_date'];?></p>
                </div>               
            </div>

            <!--service details-->
            <div class="row">
                <div class="service-details">
                    <p class="title-header">SERVICE DETAILS</p>
                    <table class="table" data-toggle="table" data-mobile-responsive="true"> 
                        <thead>
                            <tr>
                                <th>Service Type</th>
                                <th>Service Amount</th>
                                <th>Discount</th>
                                <th>Tax Rate</th>
                                <th>Tax</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $invoice_data['service_name'];?></td>
                                <td><?php echo bcadd($invoice_data['service_amount'],'0',2);?></td>
                                <td><?php echo bcadd($invoice_data['service_discount'],'0',2);?></td>
                                <td><?php echo $invoice_data['tax_rate'];?>%</td>
                                <td><?php echo bcadd($invoice_data['tax_amount'],'0',2);?></td>
                                <td><?php echo bcadd($invoice_data['total'],'0',2);?></td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="service-description-title">Description</p>
                    <p class="service-description"><?php echo $invoice_data['service_details'];?></p>
                </div>
            </div>
        </div>
    <div class="column3">
        <button class="btn btn-default" id="printInvoice" onclick="window.print();">Print Invoice</button>
    </div>
<?php include 'scripts.php'; ?>
</body>
</html>


