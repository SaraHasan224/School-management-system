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
        <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Users List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Users List";}?>
      </h1>
    </section>
    <!-- Main content -->

    <!-- Main content -->
    <div class="content">
      <div class="mb-3">
        <a href="#collapseAddRole" data-toggle="collapse" class="btn btn-warning cxm-btn-1 rounded-pill px-3 mb-3">Add Role</a>
        <div class="collapse" id="collapseAddRole">
          <div class="card">
            <div id="showrole-vald"></div>
            <div class="card-body">
              <form action="#" method="post" id="insertboxes" style="margin-top:5%;">
              <label for="rl-ttl">Role Title</label>
              <select class="form-control mb-3 select2" id="selectuser" style="width:100%;">
                <option value="">Select User</option>
                <?php foreach($UsersList as $USERSDET){ ?>
                  <option value="<?php echo $USERSDET->StaffId; ?>"><?php echo $USERSDET->StaffName; ?></option>
                <?php } ?>
                
              </select>
              <div class="card border-warning fc3">
                <h5 class="card-header border-warning fc2">Access</h5>
                <div class="card-body">
                  <?php $accessRights = array(
                    'ManageSchool' => ['InsertClass', 'InsertSubject', 'InsertSyllabus'],
                    'ManageStudent' => ['InsertStudent', 'StudentList'],
                    'TeachersList' => 'TeachersList',
                    'AssignedCourses' => 'AssignedCourses',
                    'ManageAccounts' => ['AddPayment', 'StudentLedger', 'BulkStudentPayment','InsertInvoice','InvoiceList'],
                    'ManageSchedule' => ['YearlyCalendar', 'ExamsSchedule'],
                    'EmployeeList' => 'EmployeeList',
                    'JobResponsibility' => 'JobResponsibility',
                    'Recruitment' => ['CandidatesInformation', 'ShortlistedCandidates','SelectedCandidates'],
                    'Users' => ['AllUsers', 'AddUsers','UsersRole'],
                    'Setting' => ['Profile', 'SoftwareSetting'],
                  ); ?>
                  <div class="icheck-warning">
                    <input type="checkbox" id="cxmAll">
                    <label for="cxmAll">Select All</label>
                  </div>
                  <hr />
                  <div class="row">
                    <?php foreach($accessRights as $page => $access){ ?>
                      <div class="col-sm-4">
                      <div class="icheck-warning my-2 fc2" style="margin-top:3%;">
                        <input type="checkbox" id="axus-<?php echo $page; ?>" value="<?php echo $page; ?>" class="cxmCbx mainClass">
                        <label for="axus-<?php echo $page; ?>"><?php echo $page; ?></label>
                      </div>
                      <?php if(is_array ($access)){ ?>
                        <div class="pl-3 border-bottom cxm-children <?php echo $page; ?>-child">
                        <?php foreach($access as $indx => $axus){ ?>
                          <div class="icheck-warning my-2 fs14">
                            <input type="checkbox" value="<?php echo $axus; ?>" id="<?php echo $page; ?>-<?php echo $indx; ?>" class="cxmCbx mainClass">
                            <label for="<?php echo $page; ?>-<?php echo $indx; ?>"><?php echo $axus; ?></label>
                          </div>
                        <?php } ?>
                        </div>
                      <?php } ?>
                      </div>
                    <?php } ?>                    
                  </div>
                </div>
              </div>
              <div class="" id="SubmitMessage"></div> <!-- When Message Got From DataBase -->
              <button type="submit" class="btn btn-warning cxm-btn-1 fs13 float-right">Save </button>
              </form>
            </div>
          </div>
        </div>                            
      </div>

    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Image";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody id="user-table">
                <?php $i = 1;
              if(!empty($UserRole)){ foreach($UserRole as $USRO){ ?>  
              <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center "><img width="50" alt="Image" class="img-fluid img-thumbnail rounded-circle" src="<?php if(!empty($USRO->StaffImage)){ echo base_url('uploads/staff/'.$USRO->StaffId.'/'.$USRO->StaffImage); }else{ echo base_url('assets/dist/images/StaffIcon.png'); } ?>"></td>
                <td class="text-center"><?php if(!empty($USRO->StaffName)){ echo $USRO->StaffName; }else{ echo "Admin"; } ?></td>
                <td class="text-center ">
                  <div class="btn-group btn-group-sm" role="group">
                  <a href="#collapseRecored<?php echo $i; ?>" data-toggle="collapse" href="#collapseRecored<?php echo $i; ?>" class="btn btn-warning cxm-btn-1 fs13" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><span class="fas fa-eye"></span></a>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="4" id="collapseRecored<?php echo $i; ?>" class="collapse">
                  <div class="card border-warning fc3">
                    <h5 class="card-header border-warning fc2">Access</h5>
                    <div class="card-body">
                      <?php $accessRights = array(
                              'ManageSchool' => ['InsertClass', 'InsertSubject', 'InsertSyllabus'],
                              'ManageStudent' => ['InsertStudent', 'StudentList'],
                              'TeachersList' => 'TeachersList',
                              'AssignedCourses' => 'AssignedCourses',
                              'ManageAccounts' => ['AddPayment', 'StudentLedger', 'BulkStudentPayment','InsertInvoice','InvoiceList'],
                              'ManageSchedule' => ['YearlyCalendar', 'ExamsSchedule'],
                              'EmployeeList' => 'EmployeeList',
                              'JobResponsibility' => 'JobResponsibility',
                              'Recruitment' => ['CandidatesInformation', 'ShortlistedCandidates','SelectedCandidates'],
                              'Users' => ['AllUsers', 'AddUsers','UsersRole'],
                              'Setting' => ['Profile', 'SoftwareSetting'],
                            ); ?>
                      <hr />
                      <div class="row">
                        <?php foreach($accessRights as $page => $access){ ?>
                          <div class="col-sm-4">
                          <div class="icheck-warning my-2 fc2">
                            <?php if($USRO->$page == true){ ?>
                            <input type="checkbox" id="" checked>
                            <label for=""><?php echo $page; ?></label>
                            <?php }else{ ?>
                              <input type="checkbox" id="" >
                            <label for=""><?php echo $page; ?></label>
                            <?php } ?>
                          </div>
                          <?php if(is_array ($access)){ ?>
                            <div class="pl-3 border-bottom cxm-children <?php echo $page; ?>-child">
                            <?php foreach($access as $indx => $axus){ ?>
                              <div class="icheck-warning my-2 fs14">
                              <?php if($USRO->$page == true){ ?>
                                <input type="checkbox" id="" checked>
                                <label for=""><?php echo $axus; ?></label>
                              <?php }else{ ?>
                                <input type="checkbox" id="" >
                                <label for=""><?php echo $axus; ?></label>
                              <?php } ?>
                              </div>
                            <?php } ?>
                            </div>
                          <?php } ?>
                          </div>
                        <?php } ?>                    
                      </div>
                    </div>
                  </div>
                </td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
              </tr>
              <?php $i++; } } ?>                   
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Image";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
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

    //Select All CheckBoxes
    $("#cxmAll").change(function(){
          $(".cxmCbx").prop('checked', $(this).prop("checked"));
        });
        $('.cxmCbx').change(function(){
          if(false == $(this).prop("checked")){
            $("#cxmAll").prop('checked', false);
          }          
          if ($('.cxmCbx:checked').length == $('.cxmCbx').length){
            $("#cxmAll").prop('checked', true);
          }
        });
        // cxm-children
        $('.cxmCbx').change(function(){
          let cxmId = $(this).attr('id').split('-');
          if(cxmId[0] === 'axus'){
            $('.' + cxmId[1] + '-child .cxmCbx').prop('checked', $(this).prop("checked"));
          }
          if($('.' + cxmId[0] + '-child .cxmCbx:checked').length === 0){
            $("#axus-" + cxmId[0]).prop('checked', false);
          }else{
            $("#axus-" + cxmId[0]).prop('checked', true);
          }
        });
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

 /****************** Registration jquery submit button ******************* */
 $('#insertboxes').submit(function (e) { /******** Call A Function When Contact Form Submitted ********* */
        e.preventDefault(); /***********Prevent Page to not load *********** */
        var checkboxes = $('.mainClass:checked').map(function() {return this.value;}).get().join(',');
        var UserId = $("#selectuser").val();
        if(checkboxes == ""){
          Snackbar.show({pos: 'top-right',text:"No Check Box Selected"});
        }else if(UserId == ""){
          Snackbar.show({pos: 'top-right',text:"Please Select User"});
        }else{
          var form_data = new FormData(); /*********** Initialize form data ************ */
              form_data.append("StaffId", UserId); /********Add FirstName to form ******* */
              form_data.append("Roles", checkboxes); /********Add FirstName to form ******* */
              $.ajax({ /********start of an ajax ******** */
                url:"<?php echo base_url('Admin/UserRoles/AssignRoles'); ?>", /*******url to send ******* */
                method:"POST", /********method post******** */
                dataType: 'JSON', /********data type json******* */
                data: form_data, /*********send form here ******** */
                contentType: false, /*******content type false******** */
                cache: false, /*********cache false ********* */
                processData: false, /******* Process data false******* */
                success:function(data) /*******start of success function******** */
                { /********start of success function********* */
                  if (data.status == true) { /********if status is true********* */
                    Snackbar.show({pos: 'top-right',text:data.message});
                    setTimeout(function(){
                      window.location.reload();
                    }, 1000);
                  }else{ /*******else result is false******** */
                    Snackbar.show({pos: 'top-right',text:data.message});
                  } /********enf of result check status******** */
                } /*******end of success function******* */
              });/*******end of ajax ********/
        }
    });
              
</script>
</body>
</html>
