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
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "User"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "User";}?></small>
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
        <form method="post" enctype="multipart/form-data" id="InsertUsers">
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
            
            <!-- /.col -->
            <div class="col-md-6" style="margin-top:1%;">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?> <span class="required_star"> *</span></label>
                <input type="text" name="StaffName" id="StaffName" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?>" class="form-control">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Designation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Designation";}?> <span class="required_star"> *</span></label>
                <input type="text" name="Designation" id="Designation" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Designation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Designation";}?>" class="form-control">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-md-6" style="margin-top:1%;">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Email"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Email";}?> <span class="required_star"> *</span></label>
                <input type="text" name="StaffEmail" id="StaffEmail" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Email"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Email";}?>" class="form-control">
              </div>


              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?> <span class="required_star"> *</span></label>
                <input type="text" name="Phone" id="Phone" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?>" class="form-control">
              </div>

            </div>
            <div class="col-md-6">
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Password";}?> <span class="required_star"> *</span></label>
                <input type="password" name="Password" id="Password" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Password";}?>" class="form-control">
              </div>
              <!-- /.form-group -->

              
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Confirm Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Confirm Password";}?> <span class="required_star"> *</span></label>
                <input type="text" name="ConfirmPassword" id="ConfirmPassword" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Confirm Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Confirm Password";}?>" class="form-control">
              </div>
            </div>

    
            <!-- /.col -->
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" id="EmployeeSubmit" style="margin-top:8%;" onclick="InsertUser()" class="btn btn-info pull-right"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?></button>
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

// $(function(){
//   $('#PhoneNumber').usPhoneFormat({
//     format:'xxxx-xxxxxxx'
//   });
// });


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
    });
    
  });
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
function InsertUser() {
    
    var StaffName = document.getElementById('StaffName').value;
    var Designation = document.getElementById('Designation').value;
    var StaffEmail = document.getElementById('StaffEmail').value;
    var Phone = document.getElementById('Phone').value;
    var Password = document.getElementById('Password').value;
    var ConfirmPassword = document.getElementById('ConfirmPassword').value;
    
    if(StaffName == ""){
      Snackbar.show({pos: 'top-right',text: "Name Required"});
    }else if(Designation == ""){
      Snackbar.show({pos: 'top-right',text: "Designation Required"});
    }else if(StaffEmail == ""){
      Snackbar.show({pos: 'top-right',text: "Email Required"});
    }else if(Phone == ""){
      Snackbar.show({pos: 'top-right',text: "Phone Required"});
    }else if(Password == ""){
      Snackbar.show({pos: 'top-right',text: "Password Required"});
    }else if(ConfirmPassword == ""){
      Snackbar.show({pos: 'top-right',text: "ConfirmPassword Required"});
    }else if(ConfirmPassword != Password){
      Snackbar.show({pos: 'top-right',text: "Password & ConfirmPassword should be same"});
    }else{
      var form_data = new FormData();
          form_data.append("StaffImage", document.getElementById('imgInp').files[0]);
          form_data.append("StaffName", StaffName);
          form_data.append("Designation", Designation);
          form_data.append("StaffEmail", StaffEmail);
          form_data.append("Phone", Phone);
          form_data.append("Password", Password);

          $.ajax({
            url:"<?php echo base_url('Admin/AddUser/InsertData'); ?>",
            method:"POST",
            dataType: 'JSON',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success:function(AddUser)
            {
              if (AddUser.status == true) {
                Snackbar.show({pos: 'top-right',text:AddUser.message});
                setTimeout(function(){
                  location.reload();
                }, 3000);
                
              }else{
                Snackbar.show({pos: 'top-right',text:AddUser.message});
              }
            }
          });
    }

  } 
</script>
</body>
</html>