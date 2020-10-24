<?php include(APPPATH.'views/admin/meta_tags.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php include(APPPATH.'views/admin/head.php'); ?>
</head>

<body>
<div class="wrapper">

  <!-- Navbar -->
  <?php include(APPPATH.'views/admin/header.php'); ?>
  <!-- /.navbar -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?>
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Invoice"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Invoice";}?></small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> <?php if(!empty($CompanyList->CompanyName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyName;} }else{ echo "JemsTech"; } ?>
          <small class="pull-right"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date";}?> : <?php echo date('y-m-d'); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-6 invoice-col">
      <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "From"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "From";}?>
        <address>
          <strong><?php if(!empty($CompanyList->CompanyName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyName;} }else{ echo "JemsTech"; } ?></strong><br>
          <?php if(!empty($CompanyList->CompanyAddress)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyAddress.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyAddress;} }else{ echo $CompanyList->CompanyAddress; } ?><br>
          <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?>: <?php if(!empty($CompanyList->CompanyPhone)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyPhone.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyPhone;} }else{ echo $CompanyList->CompanyPhone; } ?><br>
          <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Email"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Email";}?> : <?php if(!empty($CompanyList->CompanyEmail)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyEmail.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyEmail;} }else{ echo $CompanyList->CompanyEmail; } ?>
        </address>
        
      </div>
      <!-- /.col -->

      <!-- /.col -->
      <div class="col-sm-6 invoice-col">
        <div class="row pull-right">
        <input type="text" class="form-control" value="" id="InvoiceName" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Invoice Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Invoice Name";}?>">
        <br>
        <!-- <input type="text" class="form-control" value="" id="datepicker" placeholder="<?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Due Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Due Date";}?>" value=""> -->

        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Item"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Item";}?></th>
            <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Price"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Price";}?></th>
            <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Quantity"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Quantity";}?></th>
            <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "SubTotal"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "SubTotal";}?></th>
            <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
          </tr>
          </thead>
          <tbody id="TableBody">
          <tr>
            <td>1</td>
            <td><input type="text" id="Item1" name="Item" class="form-control"></td>
            <td><input type="number" id="Price1" name="Price" onkeyup="SubTotal(1)" class="form-control"></td>
            <td><input type="number" id="Quantity1" name="Quantity" class="form-control" onkeyup="SubTotal(1)"></td>
            <td><input type="text" id="SubTotal1" name="SubTotal" class="form-control" value="" disabled="true"></td>
            <td>
            <button type="button" class="btn btn-default" onclick = "AddRow()"><i class="fa fa-plus text-default"></i></button>
            <button type="button" class="btn btn-default" disabled="true"><i class="fa fa-trash text-default"></i></button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Payment Methods"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Payment Methods";}?></p>
        <img src="<?php echo base_url('AdminLTE/dist/img/credit/visa.png'); ?>" alt="Visa">
        <img src="<?php echo base_url('AdminLTE/dist/img/credit/mastercard.png'); ?>" alt="Mastercard">
        <img src="<?php echo base_url('AdminLTE/dist/img/credit/american-express.png'); ?>" alt="American Express">
        <img src="<?php echo base_url('AdminLTE/dist/img/credit/paypal2.png'); ?>" alt="Paypal">

      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <!-- <p class="lead">Amount Due 2/22/2014</p> -->

        <div class="table-responsive">
          <table class="table">
            <tr>
              <td></td>
            </tr>
            <tr>
              <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Total"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Total";}?></th>
              <td><input type="text" id="FinalTotal" value="0" disabled="true" class="form-control"></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
     <!-- /.box-body -->
     <div class="box-footer">
                <button type="button" id="doctorsubmit" onclick="InsertInvoice()" class="btn btn-info pull-right"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Invoice"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Invoice";}?></button>
     </div>
              <!-- /.box-footer -->
  </section>
        </div>

      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
    </div>
</div>

<?php include(APPPATH.'views/admin/footer.php'); ?>
<!-- Page specific script for calndar-->
<!-- Page script -->

<script type="text/javascript">
    function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      startDate: '1d'
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<script type="text/javascript">

var i=1;
        function AddRow() {
          i = eval(i + 1);
          var Item = document.createElement('input');
          Item.setAttribute("type", "text");
          Item.setAttribute("Id", "Item"+i);
          Item.setAttribute("class", "form-control");
          Item.setAttribute("name", "Item");

          var Price = document.createElement('input');
          Price.setAttribute("type", "number");
          Price.setAttribute("Id", "Price"+i);
          Price.setAttribute("class", "form-control");
          Price.setAttribute("name", "Price");
          Price.setAttribute("onkeyup", "SubTotal("+i+")");

          var Quantity = document.createElement('input');
          Quantity.setAttribute("type", "number");
          Quantity.setAttribute("Id", "Quantity"+i);
          Quantity.setAttribute("class", "form-control");
          Quantity.setAttribute("name", "Quantity");
          Quantity.setAttribute("onkeyup", "SubTotal("+i+")");

          var SubTotal = document.createElement('input');
          SubTotal.setAttribute("type", "text");
          SubTotal.setAttribute("Id", "SubTotal"+i);
          SubTotal.setAttribute("class", "form-control");
          SubTotal.setAttribute("name", "SubTotal");
          SubTotal.setAttribute("disabled", "true");

          var table = document.getElementById("TableBody");
          var row = table.insertRow();
          row.setAttribute("id","Row"+i);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          var cell4 = row.insertCell(3);
          var cell5 = row.insertCell(4);
          var cell6 = row.insertCell(5);
          
          cell1.innerHTML = i;
          cell2.appendChild(Item);
          cell3.appendChild(Price);
          cell4.appendChild(Quantity);
          cell5.appendChild(SubTotal);
          cell6.innerHTML = "<button type='submit' class='btn btn-default' id='Remove"+i+"' onclick='RemoveRow("+i+")'><i class='fa fa-trash text-default'></i></button>";
        }
        
        var arr = [0];
        function RemoveRow(i) {
          var FT = 0;
          document.getElementById("Row"+i).remove();
          arr[i] = 0;
          for (var j = 1; j <= arr.length - 1; j++) {
            FT = eval(FT + arr[j]);
          }
          document.getElementById('FinalTotal').value = FT;
        }

        function SubTotal(n) {
         var FT = 0;
         var Price =  document.getElementById('Price'+n).value;
         var Quantity = document.getElementById('Quantity'+n).value;
         var SubTotal = eval(Price * Quantity);
         document.getElementById('SubTotal'+n).value = SubTotal;
         arr[n] = SubTotal;
         for (var j = 1; j <= arr.length - 1; j++) {
            FT = eval(FT + arr[j]);
          }
          document.getElementById('FinalTotal').value = FT;
        }

/**************** Insert Doctor Field Using Ajax *************/
  function InsertInvoice() {
    
      Itemarr = [];
      var Item = document.getElementsByName("Item");
      var Price = document.getElementsByName("Price");
      var Quantity = document.getElementsByName("Quantity");
      var SubTotal = document.getElementsByName("SubTotal");
      for (var i = 0; i < Item.length; i++) {
        Itemarr.push("{"+'"Item":'+'"'+Item[i].value+'"'+","+'"Price":'+'"'+Price[i].value+'"'+","+'"Quantity":'+'"'+Quantity[i].value+'"'+","+'"SubTotal":'+'"'+SubTotal[i].value+'"'+"}");
      }
      
      var form_data = new FormData();
      form_data.append("Item", "["+Itemarr+"]");
      form_data.append("Total", document.getElementById("FinalTotal").value);
      form_data.append("InvoiceName", document.getElementById("InvoiceName").value);
      // form_data.append("DueDate", document.getElementById("datepicker").value);

      $.ajax({
        url:"<?php echo base_url('Admin/insertinvoice/upload'); ?>",
        method:"POST",
        dataType: 'JSON',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success:function(insertinvoice)
        {
          if (insertinvoice.status == true) {
            Snackbar.show({pos: 'top-right',text:insertinvoice.message});
            setTimeout(function(){// wait for 5 secs(2)
                          location.reload(true);
                        }, 2000);
          }else{
            Snackbar.show({pos: 'top-right',text:insertinvoice.message});
          }
        }
      });

  } 


</script>
</body>
</html>
