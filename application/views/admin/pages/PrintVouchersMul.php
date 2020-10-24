<?php include(APPPATH.'views/admin/meta_tags.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php include(APPPATH.'views/admin/head.php'); ?>
</head>

<body>

  <!-- Navbar -->
  <?php include(APPPATH.'views/admin/header.php'); ?>
  <!-- /.navbar -->
  <div class="content-wrapper">
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="row">
    <div class="col-md-6">
      <h3>
        <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Print Vouchers"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Print Vouchers";}?>
      </h3>
      </div>
    </div>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body" id="outstandingtable">
          <div class="row">
            <div class="box-body">

                <div class="row">
                    
                    <form method="post" action="<?php echo base_url('PrintVouchersMul/SingleVoucher'); ?>">
                        <div class="col-md-12">
                            <h2>GR Search<h2>
                        </div>
                        <div class="col-md-3">
                        <input type="text" class="form-control" name="GRNumber" placeholder="Enter GR Number" required="">
                        </div>
                        <div class="col-md-3">
                        <select class="form-control select2" name="Month" style="width:100%;" required="">
                        <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Month"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Month";}?></option>
                            <option value="January"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "January"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "January";}?></option>
                            <option value="February"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "February"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "February";}?></option>
                            <option value="March"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "March"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "March";}?></option>
                            <option value="April"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "April"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "April";}?></option>
                            <option value="May"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "May"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "May";}?></option>
                            <option value="June"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "June"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "June";}?></option>
                            <option value="July"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "July"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "July";}?></option>
                            <option value="August"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "August"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "August";}?></option>
                            <option value="September"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "September"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "September";}?></option>
                            <option value="October"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "October"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "October";}?></option>
                            <option value="November"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "November"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "November";}?></option>
                            <option value="December"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "December"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "December";}?></option>
                            <option value="Annual"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Annual"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Annual";}?></option>
                      </select>
                        </div>

                        <div class="col-sm-3">
                      <select class="form-control select2" name="Year" style="width:100%;" required="">
                            <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Year"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Year";}?></option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                      </select>
                    </div>
                        <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Print Voucher</button>
                        </div>
                    </form>
                </div>


                <div class="row" style="margin-top:50px;">
              <form method="post" action="<?php echo base_url('PrintVouchersMul/MultipleVoucher'); ?>">
                        <div class="col-md-12">
                            <h2>Monthly Search<h2>
                        </div>
                <div class="col-md-3">
                <select class="form-control select2" id="ClassId" name="ClassId">
                    <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Class";}?></option>
                  <?php if(!empty($ClassList)){ foreach($ClassList as $CLAS){ ?> 
                    <option value="<?php echo $CLAS->ClassId; ?>"><?php echo $CLAS->ClassName; ?></option>
                  <?php }} ?>
                </select>
                </div>
                <div class="col-md-3">
                <select class="form-control select2" id="Month" name="Month">
                <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Month"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Month";}?></option>
                            <option value="January"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "January"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "January";}?></option>
                            <option value="February"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "February"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "February";}?></option>
                            <option value="March"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "March"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "March";}?></option>
                            <option value="April"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "April"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "April";}?></option>
                            <option value="May"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "May"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "May";}?></option>
                            <option value="June"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "June"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "June";}?></option>
                            <option value="July"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "July"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "July";}?></option>
                            <option value="August"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "August"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "August";}?></option>
                            <option value="September"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "September"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "September";}?></option>
                            <option value="October"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "October"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "October";}?></option>
                            <option value="November"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "November"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "November";}?></option>
                            <option value="December"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "December"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "December";}?></option>
                            <option value="Annual"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Annual"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Annual";}?></option>
              </select>
                </div>
                <div class="col-md-3">
                  <select class="form-control select2" id="Year" name="Year">
                            <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Year"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Year";}?></option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                      </select>
                </div>
                <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Print Voucher</button>  
                </div>
                
                </form>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.box -->
  <!-- Models -->
              
                  <!-- Modal For Delete -->
              <div class="modal fade" id="EditFee">
                
              </div>
              <!-- /.modal -->

              <!-- Modal For Delete -->

              <div class="modal fade" id="PrintVoucher">
                  
              </div>
              <!-- /.modal -->

              <!--assssssssssssssssssssssssssssssssssssssssssss -->

        
    </section>
    <!-- /.content -->
<!-- Page script -->

</div>

<?php include(APPPATH.'views/admin/footer.php'); ?>
<script>
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




/**************Edit Insurance*********** */
function PrintVoucher(Id) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#PrintVoucher").empty();
                    var edit_data = new FormData();
                      edit_data.append("FeeId", Id);
                      $.ajax({
                        url:"<?php echo base_url('Admin/StudentLedger/View'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: edit_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(editdetails)
                        {
                          if (editdetails.status == true) {
                            
                            //var Image = "<?php //echo base_url('assets/dist/images/School.jpg'); ?>";
                            // if(editdetails.data['StudentImage'] != ""){ StudentImage = "<?php //echo base_url('uploads/Students/'); ?>"+editdetails.data['StudentId']+'/'+editdetails.data['StudentImage']; }else{ StudentImage = "<?php //echo base_url('assets/dist/images/School.jpg'); ?>" }
                            // if(editdetails.data['StudentImage']){ var Condition = editdetails.data['StudentImage']; }else{ var Condition = Image; }
                            document.getElementById("PrintVoucher").innerHTML+= "";
                            
                            $("#PrintVoucher").modal('show');

                          }else{
                            Snackbar.show({pos: 'top-right',text:editdetails.message});
                          }
                        }
                      });
                  }

                  function printDiv() {
                    //Get the HTML of div
                    var divElements = document.getElementById('PrintVoucher').innerHTML;
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

/**************** Insert Department Field Using Ajax *************/
function DeActiveStudent(Id) {
        var form_data = new FormData();
        form_data.append("StudentId", Id);

        swal({
          title: "Are you sure?",
          text: "Are you sure you want to deactivate this student!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
                        url:"<?php echo base_url('Admin/StudentsList/Delete'); ?>",
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

}                   /**************Edit Insurance*********** */
                  

                  /**************Edit Insurance*********** */
                  function EditFee(Id) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#EditFee").empty();
                    var edit_data = new FormData();
                      edit_data.append("FeeId", Id);
                      $.ajax({
                        url:"<?php echo base_url('Admin/StudentLedger/View'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: edit_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(editdetails)
                        {
                          if (editdetails.status == true) {
                            
                            document.getElementById("EditFee").innerHTML+= "<div class='modal-dialog'>"+
                              "<div class='modal-content'>"+
                                "<div class='modal-header'>"+
                                  "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
                                    "<span aria-hidden='true'>&times;</span></button>"+
                                  "<h4 class='modal-title'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Add Payment"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Add Payment";}?></h4>"+
                                "</div>"+
                                  "<div class='col-md-12'>"+
                                  "<form class='form-horizontal' style='margin-top:4%;'>"+
                                    "<input type='hidden' id='FeeId' value='"+Id+"'>"+

                                            " <div class='form-group'>"+
                                            " <label for='inputName' class='col-sm-4 control-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Fee';}?></label>"+

                                            " <div class='col-sm-4'>"+
                                            " <input type='number' class='form-control' id='Fee' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Total Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Total Fee';}?>' value='"+editdetails.data['Fee']+"'>"+
                                            " </div>"+
                                            "</div>"+
                                      
                                            "<div class='form-group'>"+
                                            " <label for='inputName' class='col-sm-4 control-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Amount Paid"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Amount Paid';}?></label>"+

                                            " <div class='col-sm-4'>"+
                                            " <input type='number' class='form-control' id='AmountPaid' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Amount Paid"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Amount Paid';}?>' value='"+editdetails.data['AmountPaid']+"'>"+
                                            " </div>"+
                                            " </div>"+

                                      " <div class='text-center' style='margin-top:3%;margin-bottom:2%'> <h4>PAYMENT INFORMATION</h4></div>"+
                                      "<div class='form-group'>"+
                                      " <label for='inputName' class='col-sm-4 control-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Status';}?></label>"+

                                      " <div class='col-sm-4'>"+
                                      " <select class='form-control select2' id='Status' style='width:100%;' onchange='statuschange()'>"+
                                      " <option value=''><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Select Status';}?></option>"+
                                      "  <option value='1'>Paid</option>"+
                                      "   <option value='0'>UnPaid</option>"+
                                      " </select>"+
                                      " </div>"+
                                      " </div>"+

                                      " <div class='form-group' id='PaidDate1' style='display:none'>"+
                                      " <label for='inputName' class='col-sm-4 control-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Paid Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Paid Date';}?></label>"+

                                      " <div class='col-sm-4'>"+
                                      " <input type='text' id='datepicker5' class='form-control' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Paid Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Paid Date';}?>'>"+
                                      "  </div>"+
                                      " </div>"+

                                      "  <div class='form-group'>"+
                                      "   <label for='inputName' class='col-sm-4 control-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Method"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Method';}?></label>"+

                                      " <div class='col-sm-4'>"+
                                      " <select class='form-control select2' id='Method' style='width:100%;' onchange='methodchange()'>"+
                                      "   <option value=''><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Method"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Select Method';}?></option>"+
                                      "  <option value='Cash'>Cash</option>"+
                                      "  <option value='Bank'>Bank</option>"+
                                      "</select>"+
                                      "</div>"+
                                      "</div>"+

                                      " <div class='form-group' id='BankRefs' style='display:none'>"+
                                      " <label for='inputName' class='col-sm-4 control-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Bank Ref"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Bank Ref';}?></label>"+

                                      " <div class='col-sm-4'>"+
                                      " <input type='text' id='BankRef' class='form-control' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Bank Ref"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Bank Ref';}?>'>"+
                                      "  </div>"+
                                      " </div>"+
                                  
                                      " </form>"+
                                  "</div>"+
                                "<div class='modal-footer'>"+
                                  "<button type='button' class='btn btn-primary pull-left' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>"+
                                  "<button type='button' class='btn btn-success' onclick='UpdateFee()' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Update"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Update";}?></button>"+
                                "</div>"+
                              "</div>"+
                            "</div>";
                            
                            $("#EditFee").modal('show');

                            $('.select2').select2()
                                 //Date picker
                            $('#datepicker5').datepicker({
                              autoclose: true,
                              startDate: '1d'
                            })
                          }else{
                            Snackbar.show({pos: 'top-right',text:editdetails.message});
                          }
                        }
                      });
                  }
                  function statuschange(){
 
                      var status = document.getElementById('Status').value;
                      if(status == '1'){
                        $("#PaidDate1").css('display','block'); 
                      }else if(status == '0'){
                        $("#PaidDate1").css('display','none');
                      }

                  }

                  function methodchange(){
 
                    var Method = document.getElementById('Method').value;
                    if(Method == 'Bank'){
                      $("#BankRefs").css('display','block'); 
                    }else if(Method == 'Cash'){
                      $("#BankRefs").css('display','none');
                    }

                    }


          /**************** Insert Department Field Using Ajax *************/
              function UpdateFee() {

                var Fee = document.getElementById('Fee').value;
                var AmountPaid = document.getElementById('AmountPaid').value;
                var Status = document.getElementById('Status').value;
                var PaidDate = document.getElementById('datepicker5').value;
                var Method = document.getElementById('Method').value;
                var BankRef = document.getElementById('BankRef').value;
                
                if(Fee == ""){
                  Snackbar.show({pos: 'top-right',text: "Fee Required"});
                }else if(AmountPaid == ""){
                  Snackbar.show({pos: 'top-right',text: "AmountPaid Required"});
                }else if(Status == ""){
                  Snackbar.show({pos: 'top-right',text: "Status Required"});
                }else if(Method == ""){
                  Snackbar.show({pos: 'top-right',text: "Method Required"});
                }else{
                  var form_data = new FormData();
                      form_data.append("FeeId", document.getElementById('FeeId').value);
                      form_data.append("Fee", Fee);
                      form_data.append("AmountPaid", AmountPaid);
                      form_data.append("Status", Status);
                      form_data.append("PaidDate", PaidDate);
                      form_data.append("Method", Method);
                      form_data.append("BankRef", BankRef);
                          $.ajax({
                        url:"<?php echo base_url('Admin/StudentLedger/Edit'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(UpdateEmployee)
                        {
                          if (UpdateEmployee.status == true) {
                            Snackbar.show({pos: 'top-right',text:UpdateEmployee.message});
                            setTimeout(function(){
                                  location.reload();
                            }, 3000);
                          }else{
                            Snackbar.show({pos: 'top-right',text:UpdateEmployee.message});
                          }
                        }
                      });
                }  

              } 

              function filterdata(){
                var ClassId = document.getElementById('ClassId').value;
                var Month = document.getElementById('Month').value;
                var Year = document.getElementById('Year').value;

                var form_data = new FormData();
                      form_data.append("ClassId", ClassId);
                      form_data.append("Month", Month);
                      form_data.append("Year", Year);
                          $.ajax({
                        url:"<?php echo base_url('Admin/StudentLedger/Filter'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(data)
                        {
                          if (data.status == true) {
                            $("#feedetails").html("");
                            // if(data.Length > 0){
                            data.data.forEach(function(word){ 
                              if(word.Status == true){ Status = "Paid"; }else{ Status = "UnPaid"; }
                            $("#feedetails").append('<tr>'+
                              '<td class="text-center">'+word.Id+'</td>'+
                              '<td class="text-center">'+word.StudentName+'</td>'+
                              '<td class="text-center">'+word.StudentGR+'</td>'+
                              '<td class="text-center">'+word.FatherName+'</td>'+
                              '<td class="text-center">'+word.ClassName+'</td>'+
                              '<td class="text-center">'+word.Description+'</td>'+
                              '<td class="text-center">'+word.Dues+'</td>'+
                              '<td class="text-center">'+word.AmountPaid+'</td>'+
                              '<td class="text-center">'+Status+'</td>'+
                              
                              '<td>'+
                                '<button type="button" title="Edit" class="btn btn-default" onclick = "EditFee('+word.FeeId+')"><i class="fa fa-edit text-success"></i></button>'+
                                '<a href="<?php echo base_url('StudentLedger/PrintVoucher/'); ?>'+word.FeeId+'" title="Print" class="btn btn-default"><i class="fa fa-print text-success"></i></a>'+
                              '</td>'+
                            '</tr>');
                           });
                          // }else{
                          //   $("#course-table").append('<tr>'+
                          //   '<td colspan="8" class="text-center fc2">No Product Found</td>'+
                          // '</tr>');
                          // }
                          }else{
                            Snackbar.show({pos: 'top-right',text:data.message});
                          }
                        }
                      });

              }
              
        //       /**************Download Cv**************** */
        // function DownloadDoc(StudentId) {
        //   var form_data = new FormData();
        //   form_data.append("StudentId", StudentId);
        //   $.ajax({
        //   url:"<?php //echo base_url('Admin/StudentsList/Download'); ?>",
        //   method:"POST",
        //   dataType: 'JSON',
        //   data: form_data,
        //   contentType: false,
        //   cache: false,
        //   processData: false,
        //   success:function(FilesData)
        //     {
        //     if (FilesData.status == true) {
        //           var x=new XMLHttpRequest();
        //           x.open("GET", "http:<?php //echo base_url('uploads/Students/') ?>"+StudentId+"/"+FilesData.data['FileUrl'], true);
        //           x.responseType = 'blob';
        //           x.onload=function(e){download(x.response, FilesData.data['StudentName'] , "text/plain" ); }
        //           x.send();
        //       }else{
        //         Snackbar.show({pos: 'top-right',text:FilesData.message});
        //       }
        //     }
        //   });
        // }


        function PrintList() {
      //Get the HTML of div
      var divElements = document.getElementById('outstandingtable').innerHTML;
                    //Get the HTML of whole page
                    var oldPage = document.body.innerHTML;

                    //Reset the page's HTML with div's HTML only
                    document.body.innerHTML = 
                      "<html><head><title></title><style>body{background-color:white !important;}@page { size: 84.1cm 59.4cm;margin: 1cm 1cm 1cm 1cm; }</style></head><body>" +
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
</script>
</body>
</html>
