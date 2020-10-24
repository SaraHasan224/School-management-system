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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "List";}?>
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
          <h3 class="box-title"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Invoice List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Invoice List";}?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Invoice Id"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Invoice Id";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Invoice Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Invoice Name";}?></th>
                  <!-- <th><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Due Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Due Date";}?></th> -->
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "IsPaid"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "IsPaid";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; if(!empty($InvoiceList)){ foreach ($InvoiceList as $INL) { ?>
                <tr>
                  <td><?php echo $INL->Id; ?></td>
                  <td><?php echo $INL->InvoiceId; ?></td>
                  <td><?php echo $INL->InvoiceName; ?></td>
                  <!-- <td><?php //echo $INL->DueDate; ?></td> -->
                  <?php if ($INL->IsPaid == true) {?>
                    <td><span class="text-success"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Paid"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Paid";}?></span></td>
                  <?php }else{ ?>
                  <td><span class="text-danger"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "UnPaid"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "UnPaid";}?></span></td>
                  <?php } ?>
                  <td>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" onclick = "DeleteInvoice(<?php echo $INL->InvoiceId; ?>)"><i class="fa fa-trash text-danger"></i></button>
                    <button type="button" class="btn btn-default" data-toggle="modal" onclick = "EditInvoice(<?php echo $INL->InvoiceId; ?>)"><i class="fa fa-edit text-success"></i></button>
                    <button type="button" class="btn btn-default" data-toggle="modal" onclick = "ViewInvoice(<?php echo $INL->InvoiceId; ?>)"><i class="fa fa-list text-default"></i></button>
                  </td>
                </tr>
                <?php $i++; } }?>

                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Invoice Id"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Invoice Id";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Invoice Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Invoice Name";}?></th>
                  <!-- <th><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Due Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Due Date";}?></th> -->
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "IsPaid"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "IsPaid";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.box -->
  <!-- Models -->
              <!-- Modal For Delete -->
              <div class="modal fade" id="modal-edit">
                
              </div>
              <!-- /.modal -->
          <!-- View modal start -->
      <div class="modal fade" id="modal-View">

     </div>
              <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <iframe id="CV_Download" style="display:none;"></iframe>

</div>

<?php include(APPPATH.'views/admin/footer.php'); ?>
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
      autoclose: true
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

<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'pageLength' : 100
    })
  })

/**************** Insert Department Field Using Ajax *************/
function DeleteInvoice(Id) {
        var form_data = new FormData();
        form_data.append("InvoiceId", Id);

        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
                        url:"<?php echo base_url('Admin/invoicelist/Delete'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(data)
                        {
                          if (data.status == true) {
                            swal("Poof! Your imaginary file has been deleted!", {
                              icon: "success",
                            });
                            location.reload();
                          }else{
                            swal("Your imaginary file is safe!");
                            location.reload();
                          }
                        }
                      });
        } else {
          swal("Your imaginary file is safe!");
        }
      });

      }
  /**************** Insert Invoice Field Using Ajax *************/


                  function ViewInvoice(InvoiceId) {
                     /**************** View Invoice Detail Using Ajax *************/
                     $("#modal-View").empty();
                      var view_data = new FormData();
                      view_data.append("InvoiceId", InvoiceId);
                      $.ajax({
                        url:"<?php echo base_url('Admin/invoicelist/View'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: view_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(details)
                        {
                            
                          if (details.status == true) {
                            const Row = []; 
                            for(var ins = 0; ins < details.Invoice.length; ins++){
                            
                            Row.push("<tr>"+
                                "<td>"+ ins +"</td>"+
                                "<td>"+details.Invoice[ins]['Item']+"</td>"+
                                "<td>"+details.Invoice[ins]['Price']+"</td>"+
                                "<td>"+details.Invoice[ins]['Quantity']+"</td>"+
                                "<td>"+details.Invoice[ins]['SubTotal']+"</td>"+
                                "</tr>");
                             }
                            document.getElementById("modal-View").innerHTML+= "<div class='modal-dialog'>"+
                  "<div class='modal-content'>"+
                    "<div class='modal-header'>"+
                      "<button type'button' class='close' data-dismiss='modal' aria-label='Close'>"+
                        "<span aria-hidden='true'>&times;</span></button>"+
                      "<h4 class='modal-title'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Invoice Details"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Invoice Details";}?></h4>"+
                    "</div>"+
    "<section class='invoice'>"+
    "<div class='row'>"+
    "<div class='col-xs-12'>"+
    "<h2 class='page-header'>"+
        "<i class='fa fa-globe'></i> <?php if(!empty($CompanyList->CompanyName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyName;} }else{ echo "JemsTech"; } ?>"+
          "</h2>"+
    "</div>"+
    "</div>"+
      "<div class='row invoice-info'>"+
      "<div class='col-sm-6 invoice-col'>"+
      "<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "From"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "From";}?>"+
        "<address>"+
        "<strong><?php if(!empty($CompanyList->CompanyName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyName;} }else{ echo "JemsTech"; } ?></strong><br>"+
          "<?php if(!empty($CompanyList->CompanyAddress)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyAddress.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyAddress;} }else{ echo $CompanyList->CompanyAddress; } ?><br>"+
          "<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?>: <?php if(!empty($CompanyList->CompanyPhone)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyPhone.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyPhone;} }else{ echo $CompanyList->CompanyPhone; } ?><br>"+
          " <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Email"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Email";}?> : <?php if(!empty($CompanyList->CompanyEmail)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyEmail.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyEmail;} }else{ echo $CompanyList->CompanyEmail; } ?>"+
          "</address>"+
        "</div>"+
        "<div class='col-sm-6 invoice-col'>"+
        "<div class='row pull-right'>"+
        "<b><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Invoice Id"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Invoice Id";}?> : "+ details.data['InvoiceId']+"</b><br>"+
        "</div>"+
        "</div>"+
        "</div>"+


      "<div class='row'>"+
      "<div class='col-xs-12 table-responsive'>"+
      "<table class='table table-striped'>"+
                "<thead>"+
                    "<tr>"+
                        "<th>#</th>"+
                        "<th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Item"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Item";}?></th>"+
                        "<th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Price"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Price";}?></th>"+
                        "<th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Quantity"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Quantity";}?></th>"+
                        "<th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "SubTotal"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "SubTotal";}?></th>"+
                    "</tr>"+
                "</thead>"+
                "<tbody>"+Row+
                "</tbody>"+
      "</table>"+
      "</div>"+
      "</div>"+

      "<div class='row'>"+
      "<div class='col-xs-6'>"+
      "<p class='lead'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Payment Methods"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Payment Methods";}?></p>"+
      "<img src='<?php echo base_url("AdminLTE/dist/img/credit/visa.png");?>' alt='Visa'>"+
      "<img src='<?php echo base_url("AdminLTE/dist/img/credit/mastercard.png");?>' alt='Mastercard'>"+
      "<img src='<?php echo base_url("AdminLTE/dist/img/credit/american-express.png");?>' alt='American Express'>"+
      "<img src='<?php echo base_url("AdminLTE/dist/img/credit/paypal2.png");?>' alt='Paypal'>"+
      "</div>"+
      "<div class='col-xs-6'>"+

          "<div class='table-responsive'>"+
          "<table class='table'>"+
              "<tr>"+
              "<th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Total"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Total";}?></th>"+
                "<td>"+details.data['Total']+" PKR</td>"+
                "</tr>"+
              "</table>"+
            "</div>"+
          "</div>"+
      "</div>"+

      "<div class='row no-print'>"+
      "<div class='col-xs-12'>"+
      "<Button class='btn btn-default' onclick='javascript:printDiv()' style='margin-top:5px;'><i class='fa fa-print'></i> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Print"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Print";}?></Button>"+
      "<button type='button' class='btn btn-primary pull-right' style='margin-right: 5px;'>"+
      "<i class='fa fa-download'></i> Generate PDF"+
      "</button>"+
      "</div>"+
      "</div>"+
      "</section>"+
                  "</div>"+
                "</div>";
                
                            $("#modal-View").modal('show');
                          }else{
                            Snackbar.show({pos: 'top-right',text:details.message});
                          }
                        }
                      });
                  }

                  function printDiv() {
                    //Get the HTML of div
                    var divElements = document.getElementById('modal-View').innerHTML;
                    //Get the HTML of whole page
                    var oldPage = document.body.innerHTML;

                    //Reset the page's HTML with div's HTML only
                    document.body.innerHTML = 
                      "<html><head><title></title></head><body>" + 
                      divElements + "</body>";

                    //Print Page
                    window.print();
                    //Restore orignal HTML
                    document.body.innerHTML = oldPage;

                    setTimeout(function(){// wait for 5 secs(2)
                        location.reload(true);
                      }, 100);
                    //Restore orignal HTML
                    // document.body.innerHTML = oldPage;

          
                }
                var i = 0;
                var arr = [];
                  function EditInvoice(Id) {
                    $("#modal-edit").empty();
                    /**************** View Invoice Detail Using Ajax *************/
                    var edit_data = new FormData();
                      edit_data.append("InvoiceId", Id);
                      $.ajax({
                        url:"<?php echo base_url('Admin/invoicelist/View'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: edit_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(editdetails)
                        {
                          if (editdetails.status == true) {
                            const EditRow = []; 
                            i = editdetails.Invoice.length - 1;
                            // var arr = [0];
                            for(var inv = 0; inv < editdetails.Invoice.length; inv++){
                            
                            if (inv == 0) {
                              EditRow.push("<tr>"+
                            "<td>"+inv+"</td>"+
                              "<td><input type='text' id='Item"+inv+"' name='Item' class='form-control' value='"+editdetails.Invoice[inv]['Item']+"'></td>"+
                              "<td><input type='number' id='Price"+inv+"' name='Price' value='"+editdetails.Invoice[inv]['Price']+"' onkeyup='SubTotal("+inv+")' class='form-control'></td>"+
                              "<td><input type='number' id='Quantity"+inv+"' name='Quantity' value='"+editdetails.Invoice[inv]['Quantity']+"' class='form-control' onkeyup='SubTotal("+inv+")'></td>"+
                              "<td><input type='text' id='SubTotal"+inv+"' name='SubTotal' value='"+editdetails.Invoice[inv]['SubTotal']+"' class='form-control' disabled='true'></td>"+
                              "<td>"+
                              "<button type='button' class='btn btn-default' onclick = 'AddRow()'><i class='fa fa-plus text-default'></i></button>"+
                              "</td>"+
                              "</tr>");
                               arr[inv] = editdetails.Invoice[inv]['SubTotal'];
                             }else{
                              EditRow.push("<tr>"+
                            "<td>"+inv+"</td>"+
                              "<td><input type='text' id='Item"+inv+"' name='Item' class='form-control' value='"+editdetails.Invoice[inv]['Item']+"'></td>"+
                              "<td><input type='number' id='Price"+inv+"' name='Price' value='"+editdetails.Invoice[inv]['Price']+"' onkeyup='SubTotal("+inv+")' class='form-control'></td>"+
                              "<td><input type='number' id='Quantity"+inv+"' name='Quantity' value='"+editdetails.Invoice[inv]['Quantity']+"' class='form-control' onkeyup='SubTotal("+inv+")'></td>"+
                              "<td><input type='text' id='SubTotal"+inv+"' name='SubTotal' value='"+editdetails.Invoice[inv]['SubTotal']+"' class='form-control' disabled='true'></td>"+
                              "<td>"+
                              "<button type='submit' class='btn btn-default' id='Remove"+inv+"' onclick='RemoveRow("+inv+")'><i class='fa fa-trash text-default'></i></button>"+
                              "</td>"+
                              "</tr>");
                               arr[inv] = editdetails.Invoice[inv]['SubTotal'];
                            }
                          }


                            document.getElementById("modal-edit").innerHTML+= "<div class='modal-dialog'>"+
                        "<div class='modal-content'>"+
                          "<div class='modal-header'>"+
                            "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
                              "<span aria-hidden='true'>&times;</span></button>"+
                            "<h4 class='modal-title'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Edit Invoice"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Edit Invoice";}?></h4>"+
                            "<input type='hidden' id='Edit_InvoiceId'>"+
                          "</div>"+
                            "<div class='col-md-12'>"+
                            "<section class='invoice'>"+
                            "<div class='row'>"+
    "<div class='col-xs-12'>"+
      "<h2 class='page-header'>"+
        "<i class='fa fa-globe'></i> <?php if(!empty($CompanyList->CompanyName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyName;} }else{ echo "JemsTech"; } ?>"+
          "</h2>"+
        "</div>"+
      "</div>"+
    "<div class='row invoice-info'>"+
    "<div class='col-sm-6 invoice-col'>"+
      "<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "From"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "From";}?>"+
        "<address>"+
        "<strong><?php if(!empty($CompanyList->CompanyName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyName;} }else{ echo "JemsTech"; } ?></strong><br>"+
          "<?php if(!empty($CompanyList->CompanyAddress)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyAddress.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyAddress;} }else{ echo $CompanyList->CompanyAddress; } ?><br>"+
          "<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?>: <?php if(!empty($CompanyList->CompanyPhone)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyPhone.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyPhone;} }else{ echo $CompanyList->CompanyPhone; } ?><br>"+
          " <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Email"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Email";}?> : <?php if(!empty($CompanyList->CompanyEmail)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyEmail.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyEmail;} }else{ echo $CompanyList->CompanyEmail; } ?>"+
          "</address>"+
        
        "</div>"+
      "<div class='col-sm-6 invoice-col'>"+
      "<div class='row pull-right'>"+
        "<input type='text' class='form-control' value='"+editdetails.data['InvoiceName']+"' id='InvoiceName' disabled='true' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Invoice Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Invoice Name";}?>'>"+
        "<br>"+
        "<select class='form-control' id='IsPaid'>"+
        "<option><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Status";}?></option>"+
        "<option value='1'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Paid"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Paid";}?></option>"+
        "<option value='0'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "UnPaid"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "UnPaid";}?></option>"+
        "</select>"+
        "</div>"+
        "</div>"+
      "</div>"+
    "<div class='row'>"+
    "<div class='col-xs-12 table-responsive'>"+
      "<table class='table table-striped'>"+
        "<thead>"+
          "<tr>"+
          "<th>#</th>"+
            "<th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Item"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Item";}?></th>"+
            "<th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Price"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Price";}?></th>"+
            "<th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Quantity"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Quantity";}?></th>"+
            "<th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "SubTotal"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "SubTotal";}?></th>"+
            "<th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>"+
            "</tr>"+
          "</thead>"+
          "<tbody id='TableBody'>"+EditRow+
          
          "</tbody>"+
          "</table>"+
        "</div>"+
      "</div>"+

    "<div class='row'>"+
    "<div class='col-xs-6'>"+
      "<p class='lead'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Payment Methods"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Payment Methods";}?></p>"+
        "<img src='<?php echo base_url('AdminLTE/dist/img/credit/visa.png'); ?>' alt='Visa'>"+
        "<img src='<?php echo base_url('AdminLTE/dist/img/credit/mastercard.png'); ?>' alt='Mastercard'>"+
        "<img src='<?php echo base_url('AdminLTE/dist/img/credit/american-express.png'); ?>' alt='American Express'>"+
        "<img src='<?php echo base_url('AdminLTE/dist/img/credit/paypal2.png'); ?>' alt='Paypal'>"+
        "</div>"+
      "<div class='col-xs-6'>"+

        "<div class='table-responsive'>"+
        "<table class='table'>"+
            "<tr>"+
            "<th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Total"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Total";}?></th>"+
              "<td><input type='text' id='FinalTotal' value='"+editdetails.data['Total']+"' disabled='true' class='form-control'></td>"+
              "</tr>"+
            "</table>"+
          "</div>"+
        "</div>"+
      "</div>"+
  "</section>"+

                            "</div>"+
                          "<div class='modal-footer'>"+
                            "<button type='button' class='btn btn-default pull-left' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>"+
                            "<button type='button' class='btn btn-success' onclick='UpdateInvoice("+Id+")' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Update"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Update";}?></button>"+
                          "</div>"+
                        "</div>"+
                "</div>";
                            $("#modal-edit").modal('show');

                          }else{
                            Snackbar.show({pos: 'top-right',text:editdetails.message});
                          }
                        }
                      });
                  }

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
        
        
        function RemoveRow(i) {
          var FT = 0;
          document.getElementById("Row"+i).remove();
          arr[i] = 0;
          for (var j = 0; j < arr.length; j++) {
            FT = eval(FT) + eval(arr[j]);
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
         for (var j = 0; j < arr.length ; j++) {
            FT = eval(FT) + eval(arr[j]);
          }
          document.getElementById('FinalTotal').value = FT;
        }


          /**************** Insert Invoice Field Using Ajax *************/
              function UpdateInvoice(id) {
                

                Itemarr = [];
      var Item = document.getElementsByName("Item");
      var Price = document.getElementsByName("Price");
      var Quantity = document.getElementsByName("Quantity");
      var SubTotal = document.getElementsByName("SubTotal");
      for (var ip = 0; ip < Item.length; ip++) {
        Itemarr.push("{"+'"Item":'+'"'+Item[ip].value+'"'+","+'"Price":'+'"'+Price[ip].value+'"'+","+'"Quantity":'+'"'+Quantity[ip].value+'"'+","+'"SubTotal":'+'"'+SubTotal[ip].value+'"'+"}");
      }
      
      var form_data = new FormData();
      form_data.append("Item", "["+Itemarr+"]");
      form_data.append("Total", document.getElementById("FinalTotal").value);
      form_data.append("InvoiceName", document.getElementById("InvoiceName").value);
      form_data.append("IsPaid", document.getElementById("IsPaid").value);
      form_data.append("InvoiceId", id);

      $.ajax({
        url:"<?php echo base_url('Admin/invoicelist/Edit'); ?>",
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
