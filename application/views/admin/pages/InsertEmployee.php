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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?>
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Employee Details"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Employee Details";}?></small>
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

        <!-- /.box-header -->
        <div class="box-body">
        <form method="post" enctype="multipart/form-data" id="InsertEmployees">
            <div class="col-md-6">
              <!-- /.form-group -->
            </div>
            
            <div class="col-md-6">
              <div class="img-top">
            <img class="img-responsive" id="blah" alt="" src="<?php echo base_url('assets/dist/images/StaffIcon.png');?>" height="150" width="150" />
                    <div class=''>
                        <label class="upimage"> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Upload Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Upload Image";}?>
                        <input type="file" name="StaffImage" id="imgInp"  class="form-control custom-input-form-control" >
                        </label>
                    </div> <!-- text-right / end -->
              </div>
              
            </div>
            <!-- Start Of Email verify Para -->
            <div class="col-md-12">
              <div class="col-md-6"></div>
              <div class="col-md-6">
                <p id="EmailPara"></p>
              </div>
            </div>
            <!-- End Of Email verify Para -->
            <div class="col-md-6">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?> <span class="required_star"> *</span></label>
                <input type="text" name="EmployeeName" id="EmployeeName" value="<?php if(!empty($EmployeeData)){ echo $EmployeeData['EmployeeName']; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?>" class="form-control" required="">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Name";}?> <span class="required_star"> *</span></label>
                <input type="text" name="FatherName" id="FatherName" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Name";}?>" class="form-control" required="">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            
            <div class="col-md-6">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Email"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Email";}?> <span class="required_star"> *</span></label>
                <input type="email" name="EmailAddress" id="EmailAddress" value="<?php if(!empty($EmployeeData)){ echo $EmployeeData['EmailAddress']; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Email"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Email";}?>" class="form-control" required="" onkeyup="validateEmail()">
              </div>
              
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Designation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Designation";}?> <span class="required_star"> *</span></label>
                <select id="Designation" class="form-control select2">
                  <option value="">Select Designation</option>
                  <option value="Teacher"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Teacher"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Teacher";}?></option>
                  <option value="Accountant"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Accountant"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Accountant";}?></option>
                  <option value="Admin"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Admin"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Admin";}?></option>
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?> <span class="required_star"> *</span></label>
                <input type="number" name="PhoneNumber" id="PhoneNumber" value="<?php if(!empty($EmployeeData)){ echo $EmployeeData['PhoneNumber']; } ?>"  placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?>" class="form-control" required="">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "National Identity"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "National Identity";}?> <span class="required_star"> *</span></label>
                <input type="number" name="NationalIdentity" id="NationalIdentity" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "National Identity"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "National Identity";}?>" class="form-control" required="">
              </div>
              <!-- /.form-group -->
            </div>

            <div class="col-md-6">
              
              <!-- /.form-group -->
              <div class="form-group">
              <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date Of Birth"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date Of Birth";}?><span class="required_star"> *</span></label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="EmployeeBirth" class="form-control" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date Of Birth"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date Of Birth";}?>" id="datepicker" required="">
                  </div>
                  <!-- /.input group -->
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-6">

              <!-- /.form-group -->
              <div class="form-group">
                 <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Address";}?> <span class="required_star"> *</span></label>
                <input type="text" name="Address" id="Address" value="<?php if(!empty($EmployeeData)){ echo $EmployeeData['Address']; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Address";}?>" class="form-control" required=""> 
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-md-6">
              <!-- /.form-group -->
              <!-- radio -->
              <div class="form-group">
              <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Gender"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Gender";}?> </label><br>
                <label class="gender"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Male"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Male";}?>
                  <input type="radio" name="Gender" id="Gender" value="Male" class="flat-red" checked>
                </label>
                <label class="gender"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Female"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Female";}?>
                  <input type="radio" name="Gender" id="Gender1" value="Female" class="flat-red">
                </label>
              </div>
              <!-- /.form-group -->
            </div>
            
            <div class="col-md-12">
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EmployeeDetails"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EmployeeDetails";}?></label>
                  <textarea class="form-control" rows="3" name="EmployeeDetails" id="EmployeeDetails" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EmployeeDetails"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EmployeeDetails";}?>"></textarea>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" id="EmployeeSubmit" onclick="InsertEmployee()" class="btn btn-info pull-right"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Staff"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Staff";}?></button>
              </div>
              <!-- /.box-footer -->
          </form>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

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
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })


/**************** Insert Staff Field Using Ajax *************/
function InsertEmployee() {
    
    var EmployeeName = document.getElementById('EmployeeName').value;
    var FatherName = document.getElementById('FatherName').value;
    var EmailAddress = document.getElementById('EmailAddress').value;
    var Designation = document.getElementById('Designation').value;
    var PhoneNumber = document.getElementById('PhoneNumber').value;
    var NationalIdentity = document.getElementById('NationalIdentity').value;
    var Address = document.getElementById('Address').value;
    var EmployeeDetails = document.getElementById('EmployeeDetails').value;
    if (EmployeeName !="" && FatherName !="" && EmailAddress !="" && Designation !="" && PhoneNumber !="" && NationalIdentity !="" && Address !="" && EmployeeDetails !="") {/******** Check If Password Is Same */
      var form_data = new FormData();
    form_data.append("EmployeeImage", document.getElementById('imgInp').files[0]);
    form_data.append("EmployeeName", document.getElementById('EmployeeName').value);
    form_data.append("RecruitmentId", <?php if(!empty($EmployeeData)){ echo $EmployeeData['RecruitmentId']; } ?>);
    form_data.append("Cv", "<?php if(!empty($EmployeeData)){ echo $EmployeeData['Cv']; } ?>");
    form_data.append("EmailAddress", document.getElementById('EmailAddress').value);
    form_data.append("Designation", document.getElementById('Designation').value);
    form_data.append("PhoneNumber", document.getElementById('PhoneNumber').value);
    form_data.append("NationalIdentity", document.getElementById('NationalIdentity').value);
    form_data.append("Address", document.getElementById('Address').value);
    form_data.append("EmployeeDetails", document.getElementById('EmployeeDetails').value);
    if (document.getElementById('Gender').checked) {
      form_data.append("Gender", document.getElementById('Gender').value);
    }else if(document.getElementById('Gender1').checked){
      form_data.append("Gender", document.getElementById('Gender1').value);
    }
    $.ajax({
      url:"<?php echo base_url('Admin/HireCandidate/InsertData'); ?>",
      method:"POST",
      dataType: 'JSON',
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      success:function(InsertEmployee)
      {
        if (InsertEmployee.status == true) {
          Snackbar.show({pos: 'top-right',text:InsertEmployee.message});
          setTimeout(function(){
            window.location = "<?php echo base_url('Selected'); ?>";
          }, 3000);
          
        }else{
          Snackbar.show({pos: 'top-right',text:InsertEmployee.message});
        }
      }
    });
    }else{
      Snackbar.show({pos: 'top-right',text:'All fields are required'});
    }

  } 
</script>
</body>
</html>