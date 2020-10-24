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
  <div class="content-wrapper">
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "OutStanding Summary"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "OutStanding Summary";}?>
      </h1>
      <!-- <h5 style="margin-top:5%;"><b>Total OutStanding : </b> <span class="text-danger"><?php //if($TotalOutstandings){ echo $TotalOutstandings; }else{ echo "0"; } ?></span></h5>
      <h5><b>Amount Paid : </b> <span class="text-success"><?php //if($AmountPaid){ echo $AmountPaid; }else{ echo "0"; } ?></span></h5> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="box-body">
              <div class="row">
              <form method="post" action="<?php echo base_url('OutStandingSummary/ClassSearch'); ?>">
                <div class="col-md-12">
                  <h3>Class Search</h3>
                </div>
                <div class="col-md-3">
                <select class="form-control select2" id="ClassId" name="ClassId">
                    <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Class";}?></option>
                  <?php if(!empty($ClassList)){ foreach($ClassList as $CLAS){ ?> 
                    <option value="<?php echo $CLAS->ClassId; ?>" <?php if(!empty($Class)){ if($Class == $CLAS->ClassId){ ?> selected <?php }} ?>><?php echo $CLAS->ClassName; ?></option>
                  <?php }} ?>
                </select>
                </div>
                <div class="col-md-3">
                <select class="form-control select2" id="Month" name="Month">
                <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Month"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Month";}?></option>
                                  <option value="January" <?php if(!empty($MonthClass)){ if($MonthClass == 'January'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "January"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "January";}?></option>
                                  <option value="February" <?php if(!empty($MonthClass)){ if($MonthClass == 'February'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "February"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "February";}?></option>
                                  <option value="March" <?php if(!empty($MonthClass)){ if($MonthClass == 'March'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "March"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "March";}?></option>
                                  <option value="April" <?php if(!empty($MonthClass)){ if($MonthClass == 'April'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "April"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "April";}?></option>
                                  <option value="May" <?php if(!empty($MonthClass)){ if($MonthClass == 'May'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "May"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "May";}?></option>
                                  <option value="June" <?php if(!empty($MonthClass)){ if($MonthClass == 'June'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "June"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "June";}?></option>
                                  <option value="July" <?php if(!empty($MonthClass)){ if($MonthClass == 'July'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "July"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "July";}?></option>
                                  <option value="August" <?php if(!empty($MonthClass)){ if($MonthClass == 'August'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "August"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "August";}?></option>
                                  <option value="September" <?php if(!empty($MonthClass)){ if($MonthClass == 'September'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "September"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "September";}?></option>
                                  <option value="October" <?php if(!empty($MonthClass)){ if($MonthClass == 'October'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "October"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "October";}?></option>
                                  <option value="November" <?php if(!empty($MonthClass)){ if($MonthClass == 'November'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "November"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "November";}?></option>
                                  <option value="December" <?php if(!empty($MonthClass)){ if($MonthClass == 'December'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "December"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "December";}?></option>
                                  <option value="Annual" <?php if(!empty($MonthClass)){ if($MonthClass == 'Annual'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Annual"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Annual";}?></option>
              </select>
                </div>
                <div class="col-md-3">
                  <select class="form-control select2" id="Year" name="Year">
                  <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Year"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Year";}?></option>
                                  <option value="2018" <?php if(!empty($YearClass)){ if($YearClass == '2018'){ ?> selected <?php }} ?>>2018</option>
                                  <option value="2019" <?php if(!empty($YearClass)){ if($YearClass == '2019'){ ?> selected <?php }} ?>>2019</option>
                                  <option value="2020" <?php if(!empty($YearClass)){ if($YearClass == '2020'){ ?> selected <?php }} ?>>2020</option>
                                  <option value="2021" <?php if(!empty($YearClass)){ if($YearClass == '2021'){ ?> selected <?php }} ?>>2021</option>
                                  <option value="2022" <?php if(!empty($YearClass)){ if($YearClass == '2022'){ ?> selected <?php }} ?>>2022</option>
                                  <option value="2023" <?php if(!empty($YearClass)){ if($YearClass == '2023'){ ?> selected <?php }} ?>>2023</option>
                                  <option value="2024" <?php if(!empty($YearClass)){ if($YearClass == '2024'){ ?> selected <?php }} ?>>2024</option>
                                  <option value="2025" <?php if(!empty($YearClass)){ if($YearClass == '2025'){ ?> selected <?php }} ?>>2025</option>
                                  <option value="2026" <?php if(!empty($YearClass)){ if($YearClass == '2026'){ ?> selected <?php }} ?>>2026</option>
                                  <option value="2027" <?php if(!empty($YearClass)){ if($YearClass == '2027'){ ?> selected <?php }} ?>>2027</option>
                                  <option value="2028" <?php if(!empty($YearClass)){ if($YearClass == '2028'){ ?> selected <?php }} ?>>2028</option>
                      </select>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
                </form>
              </div>

              <div class="row" style="margin-top:20px;">
                <form method="post" action="<?php echo base_url('OutStandingSummary/MonthlySearch'); ?>">
                    <div class="col-md-12">
                      <h3>Monthly Search</h3>
                    </div>
                    <div class="col-md-3">
                      <select class="form-control select2" id="Month" name="Month">
                      <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Month"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Month";}?></option>
                                  <option value="January" <?php if(!empty($Month)){ if($Month == 'January'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "January"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "January";}?></option>
                                  <option value="February" <?php if(!empty($Month)){ if($Month == 'February'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "February"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "February";}?></option>
                                  <option value="March" <?php if(!empty($Month)){ if($Month == 'March'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "March"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "March";}?></option>
                                  <option value="April" <?php if(!empty($Month)){ if($Month == 'April'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "April"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "April";}?></option>
                                  <option value="May" <?php if(!empty($Month)){ if($Month == 'May'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "May"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "May";}?></option>
                                  <option value="June" <?php if(!empty($Month)){ if($Month == 'June'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "June"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "June";}?></option>
                                  <option value="July" <?php if(!empty($Month)){ if($Month == 'July'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "July"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "July";}?></option>
                                  <option value="August" <?php if(!empty($Month)){ if($Month == 'August'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "August"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "August";}?></option>
                                  <option value="September" <?php if(!empty($Month)){ if($Month == 'September'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "September"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "September";}?></option>
                                  <option value="October" <?php if(!empty($Month)){ if($Month == 'October'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "October"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "October";}?></option>
                                  <option value="November" <?php if(!empty($Month)){ if($Month == 'November'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "November"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "November";}?></option>
                                  <option value="December" <?php if(!empty($Month)){ if($Month == 'December'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "December"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "December";}?></option>
                                  <option value="Annual" <?php if(!empty($Month)){ if($Month == 'Annual'){ ?> selected <?php }} ?>><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Annual"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Annual";}?></option>
                    </select>
                      </div>
                      <div class="col-md-3">
                        <select class="form-control select2" id="Year" name="Year">
                                  <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Year"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Year";}?></option>
                                  <option value="2018" <?php if(!empty($Year)){ if($Year == '2018'){ ?> selected <?php }} ?>>2018</option>
                                  <option value="2019" <?php if(!empty($Year)){ if($Year == '2019'){ ?> selected <?php }} ?>>2019</option>
                                  <option value="2020" <?php if(!empty($Year)){ if($Year == '2020'){ ?> selected <?php }} ?>>2020</option>
                                  <option value="2021" <?php if(!empty($Year)){ if($Year == '2021'){ ?> selected <?php }} ?>>2021</option>
                                  <option value="2022" <?php if(!empty($Year)){ if($Year == '2022'){ ?> selected <?php }} ?>>2022</option>
                                  <option value="2023" <?php if(!empty($Year)){ if($Year == '2023'){ ?> selected <?php }} ?>>2023</option>
                                  <option value="2024" <?php if(!empty($Year)){ if($Year == '2024'){ ?> selected <?php }} ?>>2024</option>
                                  <option value="2025" <?php if(!empty($Year)){ if($Year == '2025'){ ?> selected <?php }} ?>>2025</option>
                                  <option value="2026" <?php if(!empty($Year)){ if($Year == '2026'){ ?> selected <?php }} ?>>2026</option>
                                  <option value="2027" <?php if(!empty($Year)){ if($Year == '2027'){ ?> selected <?php }} ?>>2027</option>
                                  <option value="2028" <?php if(!empty($Year)){ if($Year == '2028'){ ?> selected <?php }} ?>>2028</option>
                            </select>
                      </div>
                    <div class="col-md-3">
                      <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
              </div>
              

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Gr No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Gr No";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Name";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Dues"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Dues";}?></th>
                  
                </tr>
                </thead>
                <tbody id="feedetails">
                  <?php $TotalDuesCalculated=0;$i = 1; if(!empty($StudentList)){ foreach ($StudentList as $STULIS) {
                    $Dues = $this->Admindb->SumRecord(['StudentId'=>$STULIS->StudentId,'FeeMonth <='=>$FilteredDate,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
                    ?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td>
                  <td class="text-center"><?php echo $STULIS->StudentName; ?></td>
                  <td class="text-center"><?php echo $STULIS->GRNumber; ?></td>
                  <td class="text-center"><?php echo $STULIS->FatherName; ?></td>
                  <td class="text-center"><?php echo $Dues; ?></td>
                </tr>
                
                <?php
                      $TotalDuesCalculated +=$Dues;
                // $TotalDues += $STULIS->Dues;
                // $TotalAmount += $STULIS->AmountPaid;
                $i++; } } ?>
                </tbody>
                
                <!-- <tfoot>
                <tr>
                <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "ID"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "ID";}?></th>
                  <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></th>
                  <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Gr No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Gr No";}?></th>
                  <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Name";}?></th>
                  <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></th>
                  <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Description"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Description";}?></th>
                  <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Dues"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Dues";}?></th>
                  <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Amountpaid"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Amountpaid";}?></th>
                  <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Status";}?></th>
                  <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "PaidDate"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "PaidDate";}?></th>
                  <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "BankRef"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "BankRef";}?></th>
                  <th class="text-center"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </tfoot> -->
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total Dues</b></td>
                  <td id="TotalDuesId"><?php if(!empty($TotalDuesCalculated)){ echo $TotalDuesCalculated; }else{ echo 0; } ?></td>
<!--                  <td id="TotalDuesId">--><?php //if(!empty($TotalDues)){ echo $TotalDues; }else{ echo 0; } ?><!--</td>-->
                    <!-- <td><b>Total Paid</b></td>
                    <td id="TotalAmountId"><?php if(!empty($PaidAmount)){ echo $PaidAmount; }else{ echo 0; } ?></td> -->
                </tr>
              </table>
              <p class="<?php if($this->session->flashdata('CheckStatus') == 'True'){ echo "text-success"; }else{ echo "text-danger"; } ?>"><?php if($this->session->flashdata('Payment')){ 
              echo $this->session->flashdata('Payment'); }
              ?></p>
              <!-- <button type="submit" class="btn btn-primary" style="float:right;">Insert Bulk Payment</button> -->
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

              <div class="modal fade" id="ViewStudent">
                  
              </div>
              <!-- /.modal -->
    </section>
    <!-- /.content -->
<!-- Page script -->

</div>
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
                  //Date picker
                  <?php if($i >= 0){ for($p=0; $p <= $i; $p++){?> 
                    $(function () {
                    $('#datepicker<?php echo $p; ?>').datepicker({
                      autoclose: true,
                      // startDate: '1d'
                    })
                  });
                  <?php }} ?>
                  
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
      'pageLength' : 100000
    })
  })




/**************Edit Insurance*********** */
function ViewStudent(Id) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#ViewStudent").empty();
                    var edit_data = new FormData();
                      edit_data.append("StudentId", Id);
                      $.ajax({
                        url:"<?php echo base_url('Admin/StudentsList/View'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: edit_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(editdetails)
                        {
                          if (editdetails.status == true) {
                            /**************
                             * find age
                             */
                            var d = new Date();
                            year = d.getFullYear();
                            var birthDate = editdetails.data['BirthDate'].substring(0, 4);;
                            age = eval(year) - eval(birthDate);
                            /*******************
                             * end of age finder
                             */
                            var Image = "<?php echo base_url('assets/dist/images/School.jpg'); ?>";
                            if(editdetails.data['StudentImage'] != ""){ StudentImage = "<?php echo base_url('uploads/Students/'); ?>"+editdetails.data['StudentId']+'/'+editdetails.data['StudentImage']; }else{ StudentImage = "<?php echo base_url('assets/dist/images/School.jpg'); ?>" }
                            // if(editdetails.data['StudentImage']){ var Condition = editdetails.data['StudentImage']; }else{ var Condition = Image; }
                            document.getElementById("ViewStudent").innerHTML+= "<div class='modal-dialog' style='width:95%;'>"+
                  "<div class='modal-content'>"+
                    "<div class='modal-header'>"+
                      "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
                        "<span aria-hidden='true'>&times;</span></button>"+
                      "<h4 class='modal-title'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "View Student"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "View Student";}?></h4>"+
                    "</div>"+
                      "<div class='container mt-3' style='width:88%;'>"+
                      "<div class='row align-items-center pb-3'>"+
                      " <div class='col-md-3 mb-3'>"+
                      "   <img width='150' src='<?php if(!empty($CompanyList->CompanyLogo)){ echo base_url('assets/dist/images/'.$CompanyList->CompanyLogo); }else{ echo base_url('assets/dist/images/School.jpg'); }  ?>' alt='RZB School' class='img-fluid'>"+
                      " </div>"+
                      " <div class='col-md-6'>"+
                      "   <div class='row align-items-end'>"+
                      "     <div class='col border-bottom'>"+
                      "       <h1 class='text-center fw700'><?php if(!empty($CompanyList->CompanyName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyName;} }else{ echo "RZB SMS"; } ?></h1>"+
                      "     </div>"+
                      "   </div>"+
                         
                      "  </div>"+
                      " <div class='col-md-3' style='margin-top:2%;'>"+
                      "   <p>Doc. No: ACA W100<br> Issue No: 01<br>GR No # : "+editdetails.data['StudentGR']+"</p>"+
                      " </div>"+
                      "</div>"+

                      "<div class='row' style='margin-top:2%;'>"+
                      " <div class='col-12'>"+
                      "   <h4 class='text-center fw700'>Admission Form</h4>"+
                      " </div>        "+
                      "</div>"+

                      "<div class='row'>"+
                      " <div class='col-12'>"+
                      "   <h5 class='fw700'>Applicant Information</h5>"+
                      " </div>      "+  
                      "</div>"+
                      "<table class='table table-bordered table-sm mb-5'>"+
                      " <tr>"+
                      "   <td class='bg-light' colspan='3'>Student Name</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='py-3'>"+editdetails.data['StudentName']+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light'>DOB (Day, Month, Year)</td>"+
                      "   <td class='bg-light'>Age at Entry</td>"+
                      "   <td class='bg-light'>Gender</td>   "+ 
                      " </tr>"+
                      " <tr>"+
                      "   <td class='py-3'>"+editdetails.data['BirthDate']+"</td>"+
                      "   <td class='py-3'>"+age+"</td>"+
                      "   <td class='py-3'>"+editdetails.data['Gender']+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light' colspan='2'>Appling for Grade</td>"+
                      "   <td class='bg-light'>Academic Session</td>   "+ 
                      " </tr>"+
                      " <tr>"+
                      " <td class='py-3' colspan='2'>"+editdetails.data['ClassName']+"</td>"+
                      "   <td class='py-3'>"+year+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light' colspan='2'>Religion</td>"+
                      "   <td class='bg-light' colspan='2'>Nationality</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='py-3' colspan='2'>"+editdetails.data['Religion']+"</td>"+
                      "   <td class='py-3' colspan='2'>"+editdetails.data['Nationality']+"</td>"+
                      " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light' colspan='3'>Name and address of Current School</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='py-3' colspan='3'>&nbsp</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light' colspan='3'>Has your child ever been suspended or expeded from school? If so, explain below:</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='py-3' colspan='3'>&nbsp</td>"+
                      // " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light' colspan='3'>Does your child have any medical or psychological conditions? Please provide details / relevant documentation.</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='py-3' colspan='3'>"+editdetails.data['childMedical']+"</td>"+
                      " </tr>"+
                        
                      "</table>"+
                      
                      "<div class='row'>"+
                      " <div class='col-12'>"+
                      "   <h5 class='fw700'>Family Information</h5>"+
                      " </div>      "+ 
                      "</div>"+
                      "<table class='table table-bordered table-sm mb-3'>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle' style='width:33%;'>&nbsp</td>"+
                      "   <td class='bg-light align-middle' style='width:33%;'>Father/Guardian</td> "+
                      "   <td class='bg-light align-middle' style='width:33%;'>Mother/Guardian</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle'>MR / Mrs / Ms / Dr</td>"+
                      "   <td>"+editdetails.data['FatherName']+"</td>"+
                      "   <td>"+editdetails.data['MotherName']+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle'>CNIC #</td>"+
                      "   <td>"+editdetails.data['FatherCNIC']+"</td>"+
                      "   <td>"+editdetails.data['MotherCNIC']+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle'>Home Address</td>"+
                      "   <td class='py-3' colspan='2'>"+editdetails.data['Address']+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle'>Home Phone</td>"+
                      "   <td>"+editdetails.data['FatherPhone']+"</td>"+
                      "   <td>"+editdetails.data['MotherPhone']+"</td>"+
                      " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light align-middle'>Cell Phone</td>"+
                      // "   <td>&nbsp</td>"+
                      // "   <td>&nbsp</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light align-middle'>Email</td>"+
                      // "   <td>&nbsp</td>"+
                      // "   <td>&nbsp</td>"+
                      // " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle'>Occupation</td>"+
                      "   <td>"+editdetails.data['FatherOccupation']+"</td>"+
                      "   <td>"+editdetails.data['MotherOccupation']+"</td>"+
                      " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light align-middle'>Enployer/Self Employed</td>"+
                      // "   <td>&nbsp</td>"+
                      // "   <td>&nbsp</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light align-middle'>Employer's Address</td>"+
                      // "   <td>&nbsp</td>"+
                      // "   <td>&nbsp</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light align-middle'>Business Phone</td>"+
                      // "   <td>&nbsp</td>"+
                      // "   <td>&nbsp</td>"+
                      // " </tr>"+
                      "</table>"+

                      "<p class='text-center px-5'>This is CONTROLLED & CONFIDENTAIL document of 'The Smart Schools'. Its unauthorized disclosure or production shall be ilable to prosecution under the Copyright Act and any other law.</p>"+


                      "</div>"+

                    "<div class='modal-footer'>"+
                      "<button type='button' class='btn btn-default pull-left' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>"+
                      "<Button class='btn btn-default' onclick='javascript:printDiv()' style='margin-top:5px;'><i class='fa fa-print'></i> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Print"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Print";}?></Button>"+
                    "</div>"+
                  "</div>"+
                "</div>";
                            
                            $("#ViewStudent").modal('show');

                          }else{
                            Snackbar.show({pos: 'top-right',text:editdetails.message});
                          }
                        }
                      });
                  }

                  function printDiv() {
                    //Get the HTML of div
                    var divElements = document.getElementById('ViewStudent').innerHTML;
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
                  

                  // /**************Edit Insurance*********** */
                  // function EditFee(Id) {
                  //   /**************** View Insurance Detail Using Ajax *************/
                  //   $("#EditFee").empty();
                  //   var edit_data = new FormData();
                  //     edit_data.append("FeeId", Id);
                  //     $.ajax({
                  //       url:"<?php //echo base_url('Admin/StudentLedger/View'); ?>",
                  //       method:"POST",
                  //       dataType: 'JSON',
                  //       data: edit_data,
                  //       contentType: false,
                  //       cache: false,
                  //       processData: false,
                  //       success:function(editdetails)
                  //       {
                  //         if (editdetails.status == true) {
                            
                  //           document.getElementById("EditFee").innerHTML+= "<div class='modal-dialog'>"+
                  //             "<div class='modal-content'>"+
                  //               "<div class='modal-header'>"+
                  //                 "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
                  //                   "<span aria-hidden='true'>&times;</span></button>"+
                  //                 "<h4 class='modal-title'><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Add Payment"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Add Payment";}?></h4>"+
                  //               "</div>"+
                  //                 "<div class='col-md-12'>"+
                  //                 "<form class='form-horizontal' style='margin-top:4%;'>"+
                  //                   "<input type='hidden' id='FeeId' value='"+Id+"'>"+

                  //                           " <div class='form-group'>"+
                  //                           " <label for='inputName' class='col-sm-4 control-label'><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Fee';}?></label>"+

                  //                           " <div class='col-sm-4'>"+
                  //                           " <input type='number' class='form-control' id='Fee' placeholder='<?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Total Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Total Fee';}?>' value='"+editdetails.data['Fee']+"'>"+
                  //                           " </div>"+
                  //                           "</div>"+
                                      
                  //                           "<div class='form-group'>"+
                  //                           " <label for='inputName' class='col-sm-4 control-label'><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Amount Paid"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Amount Paid';}?></label>"+

                  //                           " <div class='col-sm-4'>"+
                  //                           " <input type='number' class='form-control' id='AmountPaid' placeholder='<?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Amount Paid"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Amount Paid';}?>' value='"+editdetails.data['AmountPaid']+"'>"+
                  //                           " </div>"+
                  //                           " </div>"+

                  //                     " <div class='text-center' style='margin-top:3%;margin-bottom:2%'> <h4>PAYMENT INFORMATION</h4></div>"+
                  //                     "<div class='form-group'>"+
                  //                     " <label for='inputName' class='col-sm-4 control-label'><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Status';}?></label>"+

                  //                     " <div class='col-sm-4'>"+
                  //                     " <select class='form-control select2' id='Status' style='width:100%;' onchange='statuschange()'>"+
                  //                     " <option value=''><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Select Status';}?></option>"+
                  //                     "  <option value='1'>Paid</option>"+
                  //                     "   <option value='0'>UnPaid</option>"+
                  //                     " </select>"+
                  //                     " </div>"+
                  //                     " </div>"+

                  //                     " <div class='form-group' id='PaidDate1' style='display:none'>"+
                  //                     " <label for='inputName' class='col-sm-4 control-label'><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Paid Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Paid Date';}?></label>"+

                  //                     " <div class='col-sm-4'>"+
                  //                     " <input type='text' id='datepicker5' class='form-control' placeholder='<?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Paid Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Paid Date';}?>'>"+
                  //                     "  </div>"+
                  //                     " </div>"+

                  //                     "  <div class='form-group'>"+
                  //                     "   <label for='inputName' class='col-sm-4 control-label'><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Method"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Method';}?></label>"+

                  //                     " <div class='col-sm-4'>"+
                  //                     " <select class='form-control select2' id='Method' style='width:100%;'>"+
                  //                     "   <option value=''><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Method"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Select Method';}?></option>"+
                  //                     "  <option value='Cash'>Cash</option>"+
                  //                     "  <option value='Bank'>Bank</option>"+
                  //                     "</select>"+
                  //                     "</div>"+
                  //                     "</div>"+
                                  
                  //                     " </form>"+
                  //                 "</div>"+
                  //               "<div class='modal-footer'>"+
                  //                 "<button type='button' class='btn btn-primary pull-left' data-dismiss='modal'><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>"+
                  //                 "<button type='button' class='btn btn-success' onclick='UpdateFee()' data-dismiss='modal'><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Update"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Update";}?></button>"+
                  //               "</div>"+
                  //             "</div>"+
                  //           "</div>";
                            
                  //           $("#EditFee").modal('show');

                  //           $('.select2').select2()
                  //                //Date picker
                  //           $('#datepicker5').datepicker({
                  //             autoclose: true,
                  //             startDate: '1d'
                  //           })
                  //         }else{
                  //           Snackbar.show({pos: 'top-right',text:editdetails.message});
                  //         }
                  //       }
                  //     });
                  // }
                  // function statuschange(){
 
                  //     var status = document.getElementById('Status').value;
                  //     if(status == '1'){
                  //       $("#PaidDate1").css('display','block'); 
                  //     }else if(status == '0'){
                  //       $("#PaidDate1").css('display','none');
                  //     }

                  // }


          // /**************** Insert Department Field Using Ajax *************/
          //     function UpdateFee() {

          //       var Fee = document.getElementById('Fee').value;
          //       var AmountPaid = document.getElementById('AmountPaid').value;
          //       var Status = document.getElementById('Status').value;
          //       var PaidDate = document.getElementById('datepicker5').value;
          //       var Method = document.getElementById('Method').value;
                
          //       if(Fee == ""){
          //         Snackbar.show({pos: 'top-right',text: "Fee Required"});
          //       }else if(AmountPaid == ""){
          //         Snackbar.show({pos: 'top-right',text: "AmountPaid Required"});
          //       }else if(Status == ""){
          //         Snackbar.show({pos: 'top-right',text: "Status Required"});
          //       }else if(Method == ""){
          //         Snackbar.show({pos: 'top-right',text: "Method Required"});
          //       }else{
          //         var form_data = new FormData();
          //             form_data.append("FeeId", document.getElementById('FeeId').value);
          //             form_data.append("Fee", Fee);
          //             form_data.append("AmountPaid", AmountPaid);
          //             form_data.append("Status", Status);
          //             form_data.append("PaidDate", PaidDate);
          //             form_data.append("Method", Method);
          //                 $.ajax({
          //               url:"<?php //echo base_url('Admin/StudentLedger/Edit'); ?>",
          //               method:"POST",
          //               dataType: 'JSON',
          //               data: form_data,
          //               contentType: false,
          //               cache: false,
          //               processData: false,
          //               success:function(UpdateEmployee)
          //               {
          //                 if (UpdateEmployee.status == true) {
          //                   Snackbar.show({pos: 'top-right',text:UpdateEmployee.message});
          //                   setTimeout(function(){
          //                         location.reload();
          //                   }, 3000);
          //                 }else{
          //                   Snackbar.show({pos: 'top-right',text:UpdateEmployee.message});
          //                 }
          //               }
          //             });
          //       }  

          //     } 

              function filterdata(){
                var ClassId = document.getElementById('ClassId').value;
                var Month = document.getElementById('Month').value;
                var Year = document.getElementById('Year').value;

                var form_data = new FormData();
                      form_data.append("ClassId", ClassId);
                      form_data.append("Month", Month);
                      form_data.append("Year", Year);
                          $.ajax({
                        url:"<?php echo base_url('Admin/OutStandingSummary/Filter'); ?>",
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
                            $("#TotalDuesId").html("");
                            $("#TotalAmountId").html("");
                            // if(data.Length > 0){
                              var i = 1;
                              var TotalDuesId = 0;
                              var TotalAmountId = 0;
                            data.data.forEach(function(word){
                              
                              if(word.Status == true){ Amount = "Paid"; }else{ Amount = '<input type="text" class="form-control" name="Amount[]" placeholder="Enter Amount"> <input type="hidden" name="FeeId[]" value="'+word.FeeId+'"><input type="hidden" name="Fee[]" value="'+word.Fee+'">'; }

                              if(word.Status == true){ PaidDate = word.PaidDate; }else{ PaidDate = '<input type="text" class="form-control" name="PaidDate[]" id="datepicker'+i+'" placeholder="Paid Date">'; }

                              if(word.Status == true){ BankRef = word.BankRef; }else{ BankRef = '<input type="text" class="form-control" name="BankRef[]" placeholder="Bank Ref">'; }

                              if(word.Status == true){ Staff = word.StaffName; }else{ Staff = "Pending"; }

                            $("#feedetails").append('<tr>'+
                              '<td class="text-center">'+i+'</td>'+
                              '<td class="text-center">'+word.StudentName+'</td>'+
                              '<td class="text-center">'+word.GRNumber+'</td>'+
                              '<td class="text-center">'+word.FatherName+'</td>'+
                              '<td class="text-center">'+word.Dues+'</td>'+
                              '<td class="text-center">'+word.AmountPaid+'</td>'+
                              '<td class="text-center">'+Amount+'</td>'+
                              '<td class="text-center">'+PaidDate+'</td>'+
                              '<td class="text-center">'+BankRef+'</td>'+
                              '<td class="text-center">'+Staff+'</td>'+
                            '</tr>');

                              //Date picker
                              $(function () {
                              $('#datepicker'+i).datepicker({
                                autoclose: true,
                                // startDate: '1d'
                              })
                            });
                            TotalDuesId += eval(word.Dues);
                            TotalAmountId += eval(word.AmountPaid);
                            i++;
                           });
                           $("#TotalDuesId").append(TotalDuesId);
                           $("#TotalAmountId").append(TotalAmountId);
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
              
</script>
</body>
</html>
