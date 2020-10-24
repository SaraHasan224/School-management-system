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
        <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Student List";}?>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <form method="post" action="<?php echo base_url('SearchStudent'); ?>" style="margin-bottom : 2%; margin-top : 1%;">
        <div class="row">
          <div class="col-md-3">
            <select class="form-control select2" name="ClassId">
              <option value="">Select Class</option>
              <?php if(!empty($ClassList)){ foreach($ClassList as $SECLIS){ ?>
                <option value="<?php if(!empty($SECLIS->ClassId)){ echo $SECLIS->ClassId; } ?>"> <?php if(!empty($SECLIS->ClassName)){ echo $SECLIS->ClassName; } ?></option>
              <?php }} ?>
            </select>
          </div>

          <div class="col-md-3">
            <select class="form-control select2" name="SectionId">
              <option value="">Select Section</option>
              <?php if(!empty($SectionList)){ foreach($SectionList as $SECLIS){ ?>
                <option value="<?php if(!empty($SECLIS->SectionId)){ echo $SECLIS->SectionId; } ?>"> <?php if(!empty($SECLIS->SectionName)){ echo $SECLIS->SectionName; } ?></option>
              <?php }} ?>
            </select>
          </div>

          <div class="col-md-3">
            <select class="form-control select2" name="ActiveInActive">
              <option value="1">Active</option>
              <option value="0">InActive</option>
                
            </select>
          </div>

          <div class="col-md-1">
            <button type="submit" class="btn btn-warning">Search</button>
          </div>

          <div class="col-md-2">
            <button type="button" style="float:right;" class="btn btn-primary" onclick="PrintList()">Print</button>
          </div>
        </div>
      </form>
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body" id="studentslisttable">
          <div class="row">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Image";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "GR No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "GR No";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "FatherName"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "FatherName";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Section"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Section";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Fee";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "IsActive"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "IsActive";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; if(!empty($StudentList)){ foreach ($StudentList as $STULIS) { 
                    $SectionName = $this->Admindb->SingleRowField(['SectionId'=>$STULIS->SectionId,'IsActive'=>true,'IsDeleted'=>false],'sections','SectionName');  
                  ?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td>
                  <td class="text-center"><?php if($STULIS->StudentImage){?> <img class="img-responsive" src="<?php echo base_url('uploads/Students/'.$STULIS->StudentId.'/'.$STULIS->StudentImage);?>" height="70" width="70" /> <?php }else{ ?> <img class="img-responsive" src="<?php echo base_url('assets/dist/images/School.jpg');?>" height="70" width="70" /> <?php } ?></td>
                  <td class="text-center"><?php echo $STULIS->StudentName; ?></td>
                  <td class="text-center"><?php echo $STULIS->GRNumber; ?></td>
                  <td class="text-center"><?php echo $STULIS->FatherName; ?></td>
                  <td class="text-center"><?php echo $STULIS->ClassName; ?></td>
                  <td class="text-center"><?php if(!empty($SectionName)){ echo $SectionName; } ?></td>
                  <td class="text-center"><?php if(!empty($STULIS->FatherPhone)){ echo $STULIS->FatherPhone; } ?></td>
                  <td class="text-center"><?php if(!empty($STULIS->Fee)){ echo $STULIS->Fee; } ?></td>
                  <!-- <?php //if($STULIS->Phone != ""){ ?> <td class="text-center" onclick="DownloadDoc('<?php //echo $STULIS->StudentId; ?>')" style="cursor:pointer;"><i class="fa fa-download"></i></td> <?php //}else{ ?> <td class="text-danger text-center" style="cursor:pointer;" title="No File"><i class="fa fa-exclamation"></i></td> <?php //} ?> -->
                  
                  <?php if($STULIS->IsActive == true){?><td class="text-success text-center">Active</td> <?php }else{ ?> <td class="text-danger text-center">In-Active</td> <?php } ?>
                  <td>
                  <button type="button" title="Active/InActive" class="btn btn-default" data-toggle="modal" onclick = "DeActiveStudent('<?php echo $STULIS->StudentId; ?>')">
                      <?php if ($STULIS->IsActive == true) {?>
                        <i class="fa fa-lock text-danger"></i>
                      <?php }else{ ?>
                        <i class="fa fa-lock-open text-success"></i>
                      <?php } ?>
                    </button>
                    <button type="button" title="Edit" class="btn btn-default" onclick = "EditStudent('<?php echo $STULIS->StudentId; ?>')"><i class="fa fa-edit text-success"></i></button>
                    <button type="button" title="Print" class="btn btn-default" onclick = "ViewStudent('<?php echo $STULIS->StudentId; ?>')"><i class="fa fa-print text-success"></i></button>
                    <button type="button" title="ViewPassword" onclick="ViewPassword(<?php echo $this->encryption->decrypt($STULIS->Password); ?>)" class="btn btn-default"><i class="fa fa-eye text-success"></i></button>
                    <button type="button" title="Delete" onclick="DeleteStudent('<?php echo $STULIS->StudentId; ?>')" class="btn btn-default"><i class="fa fa-trash text-danger"></i></button>
                  </td>
                </tr>
                <?php $i++; } } ?>
                </tbody>
                <tfoot>
                <tr>
                <th class="text-center">#</th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Image";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "StudentId"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "StudentId";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "FatherName"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "FatherName";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Section"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Section";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Fee";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "IsActive"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "IsActive";}?></th>
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
              
                  <!-- Modal For Delete -->
              <div class="modal fade" id="EditStudent">
                
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

  /**************** Insert Insurance Details Field Using Ajax *************/
  function EmployeeList() {
        var SchoolName = document.getElementById('SchoolName').value;
        var SchoolAddress = document.getElementById('SchoolAddress').value;
        var SchoolType = document.getElementById('SchoolType').value;
        var SchoolLogo = document.getElementById('imgInp').files[0];
            if (SchoolName != "" && SchoolAddress != "" && SchoolType != "" && SchoolLogo != "") {/******** Check If Fields exits Is Same *********/
                var form_data = new FormData();
                form_data.append("SchoolName", document.getElementById('SchoolName').value);
                form_data.append("SchoolAddress", document.getElementById('SchoolAddress').value);
                form_data.append("SchoolType", document.getElementById('SchoolType').value);
                form_data.append("SchoolLogo", document.getElementById('imgInp').files[0]);
                $.ajax({
                url:"<?php echo base_url('Admin/EmployeeList/Insert'); ?>",
                method:"POST",
                dataType: 'JSON',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(EmployeeList)
                {
                    if (EmployeeList.status == true) {
                        Snackbar.show({pos: 'top-right',text:EmployeeList.message});
                          $.ajax({
                            url:"<?php echo base_url('Admin/EmployeeList'); ?>",
                            beforeSend: function(){
                              $("#page-loader").show();
                            },
                            complete: function(){
                              $("#page-loader").hide();
                            },
                            success:function(data)
                            {
                              $('#ContentResult').empty();
                              $('#ContentResult').html(data);
                            }
                          });
                    }else{
                    Snackbar.show({pos: 'top-right',text:EmployeeList.message});
                    }
                }
                });
            }else{
              Snackbar.show({pos: 'top-right',text:'All Fields Are Mandatory!!!'});
            }
  } 


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
                  

                  /**************** Insert Department Field Using Ajax *************/
function DeleteStudent(Id) {
        var form_data = new FormData();
        form_data.append("StudentId", Id);

        swal({
          title: "Are you sure?",
          text: "Are you sure you want to delete this student!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
                        url:"<?php echo base_url('Admin/StudentsList/DeleteStudent'); ?>",
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
                  function EditStudent(Id) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#EditStudent").empty();
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
                            var Image = "<?php echo base_url('assets/dist/images/School.jpg'); ?>";
                            if(editdetails.data['StudentImage'] != ""){ StudentImage = "<?php echo base_url('uploads/Students/'); ?>"+editdetails.data['StudentId']+'/'+editdetails.data['StudentImage']; }else{ StudentImage = "<?php echo base_url('assets/dist/images/School.jpg'); ?>" }
                            // if(editdetails.data['StudentImage']){ var Condition = editdetails.data['StudentImage']; }else{ var Condition = Image; }
                            document.getElementById("EditStudent").innerHTML+= "<div class='modal-dialog'>"+
                              "<div class='modal-content'>"+
                                "<div class='modal-header'>"+
                                  "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
                                    "<span aria-hidden='true'>&times;</span></button>"+
                                  "<h4 class='modal-title'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Edit Student"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Edit Student";}?></h4>"+
                                "</div>"+
                                  "<div class='col-md-12'>"+
                                  "<form method='post' enctype='multipart/form-data' id='InsertStudents'>"+
                                      "<div class='col-md-6'>"+
                                      "</div>"+
                                      "<input id='StudentId' value='"+editdetails.data['StudentId']+"' type='hidden'>"+
                                      "<div class='col-md-6'>"+
                                        "<div class='img-top'>"+
                                      "<img class='img-responsive' id='blah' alt='' src='"+StudentImage+"' height='150' width='150' />"+
                                              "<div class=''>"+
                                                  "<label class='upimage'> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Upload Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Upload Image';}?>
                                                  <input type='file' name='StudentImage' id='imgInp2'  class='form-control custom-input-form-control'>"+
                                                  "</label>"+
                                              "</div> "+
                                        "</div>"+
                                      "</div>"+
                                      "<div class='col-md-12'>"+
                                        "<div class='col-md-6'></div>"+
                                        "<div class='col-md-6'>"+
                                          "<p id='EmailPara'></p>"+
                                        "</div>"+
                                      "</div>"+
                                      "<div class='col-md-6'>"+
                                        "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Name';}?> <span class='required_star'> *</span></label>"+
                                          "<input type='text' name='StudentName' id='StudentName' value='"+editdetails.data['StudentName']+"' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Name';}?>' class='form-control'>"+
                                        "</div>"+
                                        "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Religion"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Religion';}?> <span class='required_star'> *</span></label>"+
                                          "<select id='Religion' class='form-control select2' style='width:100%'>"+
                                            "<option value=''>Select Religion</option>"+
                                              "<option value='Islam'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Islam"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Islam';}?></option>"+
                                              "<option value='Hindu'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Hindu"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Hindu';}?></option>"+
                                              "<option value='Hindu'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Christian"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Christian';}?></option>"+
                                          "</select>"+
                                        "</div>"+
                                      "</div>"+
                                      
                                      "<div class='col-md-6'>"+
                                        "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student GR No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Student GR No';}?> <span class='required_star'> *</span></label>"+
                                          "<input type='text' name='StudentGR' id='StudentGR' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student GR No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Student GR No';}?>' class='form-control' value='"+editdetails.data['StudentGR']+"'>"+
                                        "</div>"+
                                        
                                        "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Class';}?> <span class='required_star'> *</span></label>"+
                                          "<select id='ClassId' class='form-control select2' style='width:100%'>"+
                                            "<option value=''>Select Class</option>"+
                                            <?php if(!empty($ClassList)){ foreach($ClassList as $CLSLI){ ?>
                                              "<option value='<?php echo $CLSLI->ClassId ?>'><?php echo $CLSLI->ClassName ?></option>"+
                                            <?php }} ?>
                                          "</select>"+
                                        "</div>"+
                                      "</div>"+

                                      "<div class='col-md-6'>"+
                                        "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Section"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Section';}?> <span class='required_star'> *</span></label>"+
                                          "<select id='SectionId' name='Section' class='form-control select2' style='width:100%'>"+
                                                "<option value=''>Select Section</option>"+
                                              "<?php if(!empty($SectionList)){ foreach($SectionList as $SELIS){?>"+
                                              
                                                "<option value='<?php if(!empty($SELIS->SectionId)){ echo $SELIS->SectionId; } ?>'><?php if(!empty($SELIS->SectionName)){ echo $SELIS->SectionName; } ?></option>"+

                                              "<?php }} ?>"+
                                              
                                            "</select>"+
                                        "</div>"+
                                      "</div>"+

                                      

                                      "<div class='col-md-6'>"+
                                      " <div class='form-group'>"+
                                      "   <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Phone Number';}?> </label>"+
                                      "<input type='text' name='PhoneNumber' id='PhoneNumber' data-mask='0000-0000000' value='<?php if(!empty($EmployeeData)){ echo $EmployeeData['PhoneNumber']; } ?>'  placeholder='0300-0000000' class='form-control' value='"+editdetails.data['PhoneNumber']+"'>"+
                                      " </div>"+
                                      "</div>"+

                                      "<div class='col-md-6'>"+
                                        
                                        "<div class='form-group'>"+
                                        "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date Of Birth"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Date Of Birth';}?><span class='required_star'> *</span></label>"+
                                            "<div class='input-group date'>"+
                                              "<div class='input-group-addon'>"+
                                                "<i class='fa fa-calendar'></i>"+
                                              "</div>"+
                                              "<input type='text' name='StudentBirth' value='"+editdetails.data['BirthDate']+"' class='form-control' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date Of Birth"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Date Of Birth';}?>' id='datepicker'>"+
                                            "</div>"+
                                          "</select>"+
                                        "</div>"+
                                      "</div>"+
                                      "<div class='col-md-6'>"+
                                        "<div class='form-group'>"+
                                        "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Address';}?> <span class='required_star'> *</span></label>"+
                                        " <input type='text' name='Address' id='Address' value='"+editdetails.data['Address']+"' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Address';}?>' class='form-control'>"+ 
                                        "</div>"+
                                      "</div>"+
                                      "<div class='col-md-6'>"+
                                        "<div class='form-group'>"+
                                        "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Fee';}?> <span class='required_star'> *</span></label>"+
                                        " <input type='text' name='Fee' id='Fee' value='"+editdetails.data['Fee']+"' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Fee';}?>' class='form-control'>"+ 
                                        "</div>"+
                                      "</div>"+

                                      "<div class='col-md-6'>"+
                                        "<div class='form-group'>"+
                                        "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Nationality"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Nationality';}?> <span class='required_star'> *</span></label>"+
                                        "<select id='nationality' name='nationality' class='form-control select2' style='width:100%'>"+
                                        "<option value='Afganistan'>Afghanistan</option>"+
                                        "     <option value='Albania'>Albania</option>"+
                                        "     <option value='Algeria'>Algeria</option>"+
                                        "     <option value='American Samoa'>American Samoa</option>"+
                                        "     <option value='Andorra'>Andorra</option>"+
                                        "     <option value='Angola'>Angola</option>"+
                                        "     <option value='Anguilla'>Anguilla</option>"+
                                        "     <option value='Antigua & Barbuda'>Antigua & Barbuda</option>"+
                                        "     <option value='Argentina'>Argentina</option>"+
                                        "     <option value='Armenia'>Armenia</option>"+
                                        "     <option value='Aruba'>Aruba</option>"+
                                        "     <option value='Australia'>Australia</option>"+
                                        "     <option value='Austria'>Austria</option>"+
                                        "     <option value='Azerbaijan'>Azerbaijan</option>"+
                                        "     <option value='Bahamas'>Bahamas</option>"+
                                        "     <option value='Bahrain'>Bahrain</option>"+
                                        "     <option value='Bangladesh'>Bangladesh</option>"+
                                        "     <option value='Barbados'>Barbados</option>"+
                                        "     <option value='Belarus'>Belarus</option>"+
                                        "     <option value='Belgium'>Belgium</option>"+
                                        "     <option value='Belize'>Belize</option>"+
                                        "     <option value='Benin'>Benin</option>"+
                                        "     <option value='Bermuda'>Bermuda</option>"+
                                        "     <option value='Bhutan'>Bhutan</option>"+
                                        "     <option value='Bolivia'>Bolivia</option>"+
                                        "     <option value='Bonaire'>Bonaire</option>"+
                                        "     <option value='Bosnia & Herzegovina'>Bosnia & Herzegovina</option>"+
                                        "     <option value='Botswana'>Botswana</option>"+
                                        "     <option value='Brazil'>Brazil</option>"+
                                        "     <option value='British Indian Ocean Ter'>British Indian Ocean Ter</option>"+
                                        "     <option value='Brunei'>Brunei</option>"+
                                        "     <option value='Bulgaria'>Bulgaria</option>"+
                                        "     <option value='Burkina Faso'>Burkina Faso</option>"+
                                        "     <option value='Burundi'>Burundi</option>"+
                                        "     <option value='Cambodia'>Cambodia</option>"+
                                        "     <option value='Cameroon'>Cameroon</option>"+
                                        "      <option value='Canada'>Canada</option>"+
                                        "     <option value='Canary Islands'>Canary Islands</option>"+
                                        "     <option value='Cape Verde'>Cape Verde</option>"+
                                        "     <option value='Cayman Islands'>Cayman Islands</option>"+
                                        "     <option value='Central African Republic'>Central African Republic</option>"+
                                        "     <option value='Chad'>Chad</option>"+
                                        "     <option value='Channel Islands'>Channel Islands</option>"+
                                        "     <option value='Chile'>Chile</option>"+
                                        "     <option value='China'>China</option>"+
                                        "     <option value='Christmas Island'>Christmas Island</option>"+
                                        "     <option value='Cocos Island'>Cocos Island</option>"+
                                        "     <option value='Colombia'>Colombia</option>"+
                                        "     <option value='Comoros'>Comoros</option>"+
                                        "     <option value='Congo'>Congo</option>"+
                                        "     <option value='Cook Islands'>Cook Islands</option>"+
                                        "     <option value='Costa Rica'>Costa Rica</option>"+
                                        "     <option value='Cote DIvoire'>Cote DIvoire</option>"+
                                        "     <option value='Croatia'>Croatia</option>"+
                                        "     <option value='Cuba'>Cuba</option>"+
                                        "     <option value='Curaco'>Curacao</option>"+
                                        "     <option value='Cyprus'>Cyprus</option>"+
                                        "     <option value='Czech Republic'>Czech Republic</option>"+
                                        "     <option value='Denmark'>Denmark</option>"+
                                        "     <option value='Djibouti'>Djibouti</option>"+
                                        "     <option value='Dominica'>Dominica</option>"+
                                        "     <option value='Dominican Republic'>Dominican Republic</option>"+
                                        "     <option value='East Timor'>East Timor</option>"+
                                        "     <option value='Ecuador'>Ecuador</option>"+
                                        "     <option value='Egypt'>Egypt</option>"+
                                        "     <option value='El Salvador'>El Salvador</option>"+
                                        "     <option value='Equatorial Guinea'>Equatorial Guinea</option>"+
                                        "     <option value='Eritrea'>Eritrea</option>"+
                                        "     <option value='Estonia'>Estonia</option>"+
                                        "     <option value='Ethiopia'>Ethiopia</option>"+
                                        "     <option value='Falkland Islands'>Falkland Islands</option>"+
                                        "     <option value='Faroe Islands'>Faroe Islands</option>"+
                                        "     <option value='Fiji'>Fiji</option>"+
                                        "     <option value='Finland'>Finland</option>"+
                                        "     <option value='France'>France</option>"+
                                        "     <option value='French Guiana'>French Guiana</option>"+
                                        "     <option value='French Polynesia'>French Polynesia</option>"+
                                        "     <option value='French Southern Ter'>French Southern Ter</option>"+
                                        "     <option value='Gabon'>Gabon</option>"+
                                        "     <option value='Gambia'>Gambia</option>"+
                                        "     <option value='Georgia'>Georgia</option>"+
                                        "     <option value='Germany'>Germany</option>"+
                                        "     <option value='Ghana'>Ghana</option>"+
                                        "     <option value='Gibraltar'>Gibraltar</option>"+
                                        "     <option value='Great Britain'>Great Britain</option>"+
                                        "     <option value='Greece'>Greece</option>"+
                                        "     <option value='Greenland'>Greenland</option>"+
                                        "     <option value='Grenada'>Grenada</option>"+
                                        "     <option value='Guadeloupe'>Guadeloupe</option>"+
                                        "     <option value='Guam'>Guam</option>"+
                                        "     <option value='Guatemala'>Guatemala</option>"+
                                        "     <option value='Guinea'>Guinea</option>"+
                                        "     <option value='Guyana'>Guyana</option>"+
                                        "     <option value='Haiti'>Haiti</option>"+
                                        "     <option value='Hawaii'>Hawaii</option>"+
                                        "     <option value='Honduras'>Honduras</option>"+
                                        "     <option value='Hong Kong'>Hong Kong</option>"+
                                        "     <option value='Hungary'>Hungary</option>"+
                                        "     <option value='Iceland'>Iceland</option>"+
                                        "     <option value='Indonesia'>Indonesia</option>"+
                                        "     <option value='India'>India</option>"+
                                        "     <option value='Iran'>Iran</option>"+
                                        "     <option value='Iraq'>Iraq</option>"+
                                        "     <option value='Ireland'>Ireland</option>"+
                                        "     <option value='Isle of Man'>Isle of Man</option>"+
                                        "     <option value='Israel'>Israel</option>"+
                                        "     <option value='Italy'>Italy</option>"+
                                        "     <option value='Jamaica'>Jamaica</option>"+
                                        "     <option value='Japan'>Japan</option>"+
                                        "     <option value='Jordan'>Jordan</option>"+
                                        "     <option value='Kazakhstan'>Kazakhstan</option>"+
                                        "     <option value='Kenya'>Kenya</option>"+
                                        "     <option value='Kiribati'>Kiribati</option>"+
                                        "     <option value='Korea North'>Korea North</option>"+
                                        "     <option value='Korea Sout'>Korea South</option>"+
                                        "     <option value='Kuwait'>Kuwait</option>"+
                                        "     <option value='Kyrgyzstan'>Kyrgyzstan</option>"+
                                        "     <option value='Laos'>Laos</option>"+
                                        "     <option value='Latvia'>Latvia</option>"+
                                        "     <option value='Lebanon'>Lebanon</option>"+
                                        "     <option value='Lesotho'>Lesotho</option>"+
                                        "     <option value='Liberia'>Liberia</option>"+
                                        "     <option value='Libya'>Libya</option>"+
                                        "     <option value='Liechtenstein'>Liechtenstein</option>"+
                                        "     <option value='Lithuania'>Lithuania</option>"+
                                        "     <option value='Luxembourg'>Luxembourg</option>"+
                                        "     <option value='Macau'>Macau</option>"+
                                        "     <option value='Macedonia'>Macedonia</option>"+
                                        "     <option value='Madagascar'>Madagascar</option>"+
                                        "     <option value='Malaysia'>Malaysia</option>"+
                                        "     <option value='Malawi'>Malawi</option>"+
                                        "     <option value='Maldives'>Maldives</option>"+
                                         "     <option value='Mali'>Mali</option>"+
                                         "    <option value='Malta'>Malta</option>"+
                                         "    <option value='Marshall Islands'>Marshall Islands</option>"+
                                         "    <option value='Martinique'>Martinique</option>"+
                                         "    <option value='Mauritania'>Mauritania</option>"+
                                         "    <option value='Mauritius'>Mauritius</option>"+
                                         "    <option value='Mayotte'>Mayotte</option>"+
                                         "    <option value='Mexico'>Mexico</option>"+
                                         "    <option value='Midway Islands'>Midway Islands</option>"+
                                         "    <option value='Moldova'>Moldova</option>"+
                                         "    <option value='Monaco'>Monaco</option>"+
                                         "    <option value='Mongolia'>Mongolia</option>"+
                                         "    <option value='Montserrat'>Montserrat</option>"+
                                         "    <option value='Morocco'>Morocco</option>"+
                                         "    <option value='Mozambique'>Mozambique</option>"+
                                         "    <option value='Myanmar'>Myanmar</option>"+
                                         "    <option value='Nambia'>Nambia</option>"+
                                         "    <option value='Nauru'>Nauru</option>"+
                                         "    <option value='Nepal'>Nepal</option>"+
                                         "    <option value='Netherland Antilles'>Netherland Antilles</option>"+
                                         "    <option value='Netherlands'>Netherlands (Holland, Europe)</option>"+
                                         "    <option value='Nevis'>Nevis</option>"+
                                         "    <option value='New Caledonia'>New Caledonia</option>"+
                                         "    <option value='New Zealand'>New Zealand</option>"+
                                         "    <option value='Nicaragua'>Nicaragua</option>"+
                                         "    <option value='Niger'>Niger</option>"+
                                         "    <option value='Nigeria'>Nigeria</option>"+
                                         "    <option value='Niue'>Niue</option>"+
                                         "    <option value='Norfolk Island'>Norfolk Island</option>"+
                                         "    <option value='Norway'>Norway</option>"+
                                         "    <option value='Oman'>Oman</option>"+
                                         "    <option value='Pakistan'>Pakistan</option>"+
                                         "    <option value='Palau Island'>Palau Island</option>"+
                                         "    <option value='Palestine'>Palestine</option>"+
                                         "    <option value='Panama'>Panama</option>"+
                                         "    <option value='Papua New Guinea'>Papua New Guinea</option>"+
                                         "    <option value='Paraguay'>Paraguay</option>"+
                                         "    <option value='Peru'>Peru</option>"+
                                         "    <option value='Phillipines'>Philippines</option>"+
                                         "    <option value='Pitcairn Island'>Pitcairn Island</option>"+
                                         "    <option value='Poland'>Poland</option>"+
                                         "    <option value='Portugal'>Portugal</option>"+
                                         "    <option value='Puerto Rico'>Puerto Rico</option>"+
                                         "    <option value='Qatar'>Qatar</option>"+
                                         "    <option value='Republic of Montenegro'>Republic of Montenegro</option>"+
                                         "    <option value='Republic of Serbia'>Republic of Serbia</option>"+
                                         "    <option value='Reunion'>Reunion</option>"+
                                         "    <option value='Romania'>Romania</option>"+
                                         "    <option value='Russia'>Russia</option>"+
                                         "    <option value='Rwanda'>Rwanda</option>"+
                                         "    <option value='St Barthelemy'>St Barthelemy</option>"+
                                         "    <option value='St Eustatius'>St Eustatius</option>"+
                                         "    <option value='St Helena'>St Helena</option>"+
                                         "    <option value='St Kitts-Nevis'>St Kitts-Nevis</option>"+
                                         "    <option value='St Lucia'>St Lucia</option>"+
                                         "    <option value='St Maarten'>St Maarten</option>"+
                                         "    <option value='St Pierre & Miquelon'>St Pierre & Miquelon</option>"+
                                         "    <option value='St Vincent & Grenadines'>St Vincent & Grenadines</option>"+
                                         "    <option value='Saipan'>Saipan</option>"+
                                         "    <option value='Samoa'>Samoa</option>"+
                                         "    <option value='Samoa American'>Samoa American</option>"+
                                         "    <option value='San Marino'>San Marino</option>"+
                                         "    <option value='Sao Tome & Principe'>Sao Tome & Principe</option>"+
                                         "    <option value='Saudi Arabia'>Saudi Arabia</option>"+
                                         "    <option value='Senegal'>Senegal</option>"+
                                         "    <option value='Seychelles'>Seychelles</option>"+
                                         "    <option value='Sierra Leone'>Sierra Leone</option>"+
                                         "    <option value='Singapore'>Singapore</option>"+
                                         "    <option value='Slovakia'>Slovakia</option>"+
                                         "    <option value='Slovenia'>Slovenia</option>"+
                                         "    <option value='Solomon Islands'>Solomon Islands</option>"+
                                         "    <option value='Somalia'>Somalia</option>"+
                                         "    <option value='South Africa'>South Africa</option>"+
                                         "    <option value='Spain'>Spain</option>"+
                                         "    <option value='Sri Lanka'>Sri Lanka</option>"+
                                         "    <option value='Sudan'>Sudan</option>"+
                                         "    <option value='Suriname'>Suriname</option>"+
                                         "    <option value='Swaziland'>Swaziland</option>"+
                                         "    <option value='Sweden'>Sweden</option>"+
                                         "    <option value='Switzerland'>Switzerland</option>"+
                                         "    <option value='Syria'>Syria</option>"+
                                         "    <option value='Tahiti'>Tahiti</option>"+
                                         "    <option value='Taiwan'>Taiwan</option>"+
                                         "    <option value='Tajikistan'>Tajikistan</option>"+
                                         "    <option value='Tanzania'>Tanzania</option>"+
                                         "    <option value='Thailand'>Thailand</option>"+
                                         "    <option value='Togo'>Togo</option>"+
                                         "    <option value='Tokelau'>Tokelau</option>"+
                                         "    <option value='Tonga'>Tonga</option>"+
                                         "    <option value='Trinidad & Tobago'>Trinidad & Tobago</option>"+
                                         "    <option value='Tunisia'>Tunisia</option>"+
                                         "    <option value='Turkey'>Turkey</option>"+
                                         "    <option value='Turkmenistan'>Turkmenistan</option>"+
                                         "    <option value='Turks & Caicos Is'>Turks & Caicos Is</option>"+
                                         "    <option value='Tuvalu'>Tuvalu</option>"+
                                         "    <option value='Uganda'>Uganda</option>"+
                                         "    <option value='United Kingdom'>United Kingdom</option>"+
                                         "    <option value='Ukraine'>Ukraine</option>"+
                                         "    <option value='United Arab Erimates'>United Arab Emirates</option>"+
                                         "    <option value='United States of America'>United States of America</option>"+
                                         "    <option value='Uraguay'>Uruguay</option>"+
                                         "    <option value='Uzbekistan'>Uzbekistan</option>"+
                                         "    <option value='Vanuatu'>Vanuatu</option>"+
                                         "    <option value='Vatican City State'>Vatican City State</option>"+
                                         "    <option value='Venezuela'>Venezuela</option>"+
                                         "    <option value='Vietnam'>Vietnam</option>"+
                                         "    <option value='Virgin Islands (Brit)'>Virgin Islands (Brit)</option>"+
                                         "    <option value='Virgin Islands (USA)'>Virgin Islands (USA)</option>"+
                                         "    <option value='Wake Island'>Wake Island</option>"+
                                         "    <option value='Wallis & Futana Is'>Wallis & Futana Is</option>"+
                                         "    <option value='Yemen'>Yemen</option>"+
                                         "    <option value='Zaire'>Zaire</option>"+
                                         "    <option value='Zambia'>Zambia</option>"+
                                          "    <option value='Zimbabwe'>Zimbabwe</option>"+
                                          " </select>"+
                                          "</div>"+
                                        
                                      "</div>"+

                                      "<div class='col-md-6'>"+
                                      "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Document"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Document';}?></label>"+
                                          "<input type='file' name='Document' id='Document' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Document"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Document';}?>' class='form-control'>"+
                                        "</div>"+
                                      "</div>"+

                                      "<div class='col-md-6'>"+
                                        "<div class='form-group' style='margin-top:1%;'>"+
                                        "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Gender"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Gender';}?> <span class='required_star'> *</span></label><br>"+
                                          "<label class='gender'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Male"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Male';}?>
                                            <input type='radio' name='Gender' id='Gender' value='Male' class='flat-red' checked>"+
                                          "</label>"+
                                          "<label class='gender'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Female"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Female';}?>
                                            <input type='radio' name='Gender' id='Gender1' value='Female' class='flat-red'>"+
                                          "</label>"+
                                        "</div>"+
                                      "</div>"+
                                      
                                      "<div class='col-md-12'>"+
                                        "<div class='form-group'>"+
                                        "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Does child have any medical or psychological conditions?"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Does child have any medical or psychological conditions?';}?> <span class='required_star'> *</span></label><br>"+
                                          "<textarea class='form-control' id='childMedical' rows='4' cols='50' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Does child have any medical or psychological conditions?"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Does child have any medical or psychological conditions?';}?>'>"+editdetails.data['childMedical']+"</textarea>"+
                                          "</div>"+
                                          "</div>"+
                                          "<div class='col-md-12' style='margin-top:2%;'>"+
                                          "<h4><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Family Information"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Family Information';}?></h4>"+
                                          "</div>"+
                                          "<div class='col-md-6' style='margin-top:1%;'>"+
                                          "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Father Name';}?> <span class='required_star'> *</span></label>"+
                                          "<input type='text' name='FatherName' id='FatherName' value='"+editdetails.data['FatherName']+"'  placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Father Name';}?>' class='form-control'>"+
                                          "</div>"+
                                          "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "CNIC"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'CNIC';}?> <span class='required_star'> *</span></label>"+
                                          "<input type='text' name='FatherCNIC' value='"+editdetails.data['FatherCNIC']+"' id='FatherCNIC' data-mask='00000-0000000-0' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "FatherCNIC"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'FatherCNIC';}?>' class='form-control'>"+
                                          "</div>"+
                                          "</div>"+
                                          "<div class='col-md-6' style='margin-top:1%;'>"+
                                          "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Mother Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Mother Name';}?> <span class='required_star'> *</span></label>"+
                                          "<input type='text' name='MotherName' id='MotherName' value='"+editdetails.data['MotherName']+"'  placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Mother Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Mother Name';}?>' class='form-control'>"+
                                          "</div>"+
                                          "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "CNIC"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'CNIC';}?> <span class='required_star'> *</span></label>"+
                                          "<input type='text' name='MotherCNIC' value='"+editdetails.data['MotherCNIC']+"' id='MotherCNIC' data-mask='00000-0000000-0' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "MotherCNIC"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'MotherCNIC';}?>' class='form-control'>"+
                                          "</div>"+
                                          "</div>"+
                                          "<div class='col-md-6'>"+
                                          "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Phone Number';}?> <span class='required_star'> *</span></label>"+
                                          "<input type='text' name='FatherPhone' value='"+editdetails.data['FatherPhone']+"' id='FatherPhone' data-mask='0000-0000000' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Phone Number';}?>' class='form-control'>"+
                                          "</div>"+

                                          "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Occupation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Father Occupation';}?> <span class='required_star'> *</span></label>"+
                                          "<input type='text' name='FatherOccupation' value='"+editdetails.data['FatherOccupation']+"' id='FatherOccupation' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Occupation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Father Occupation';}?>' class='form-control'>"+
                                          "</div>"+
                                          "</div>"+

                                          "<div class='col-md-6'>"+
                                          "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Phone Number';}?> <span class='required_star'> *</span></label>"+
                                          "<input type='text' name='MotherPhone' value='"+editdetails.data['MotherPhone']+"' id='MotherPhone' data-mask='0000-0000000' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Phone Number';}?>' class='form-control'>"+
                                          " </div>"+

                                          "<div class='form-group'>"+
                                          "<label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Mother Occupation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Mother Occupation';}?> <span class='required_star'> *</span></label>"+
                                          "<input type='text' name='MotherOccupation' value='"+editdetails.data['MotherOccupation']+"' id='MotherOccupation' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Mother Occupation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo 'Mother Occupation';}?>' class='form-control'>"+
                                          "</div>"+
                                          "</div>"+
                                    "</form>"+
                                  "</div>"+
                                "<div class='modal-footer'>"+
                                  "<button type='button' class='btn btn-primary pull-left' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>"+
                                  "<button type='button' class='btn btn-success' onclick='UpdateStudent()' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Update"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Update";}?></button>"+
                                "</div>"+
                              "</div>"+
                            "</div>";
                            
                            $("#EditStudent").modal('show');
                            $("#Religion").val('Islam');
                            $("#ClassId").val(editdetails.data['ClassId']);
                            $("#SectionId").val(editdetails.data['SectionId']);
                            $("#nationality").val(editdetails.data['Nationality']);

                            function readURL2(input) {

                                if (input.files && input.files[0]) {
                                  var reader = new FileReader();

                                  reader.onload = function(e) {
                                    $('#blah2').attr('src', e.target.result);
                                  }

                                  reader.readAsDataURL(input.files[0]);
                                }
                                }

                                $("#imgInp2").change(function() {
                                readURL2(this);
                                });

                                $('.select2').select2()
                                //Date picker
                                $('#datepicker').datepicker({
                                autoclose: true
                                })
                          }else{
                            Snackbar.show({pos: 'top-right',text:editdetails.message});
                          }
                        }
                      });
                  }



          /**************** Insert Department Field Using Ajax *************/
              function UpdateStudent() {

                var StudentName = document.getElementById('StudentName').value;
                var Religion = document.getElementById('Religion').value;
                var StudentGR = document.getElementById('StudentGR').value;
                var ClassId = document.getElementById('ClassId').value;
                var SectionId = document.getElementById('SectionId').value;
                var nationality = document.getElementById('nationality').value;
                var PhoneNumber = document.getElementById('PhoneNumber').value;
                var BirthDate = document.getElementById('datepicker').value;
                var Address = document.getElementById('Address').value;
                var Fee = document.getElementById('Fee').value;
                var childMedical = document.getElementById('childMedical').value;
                var FatherName = document.getElementById('FatherName').value;
                var FatherCNIC = document.getElementById('FatherCNIC').value;
                var MotherName = document.getElementById('MotherName').value;
                var MotherCNIC = document.getElementById('MotherCNIC').value;
                var FatherPhone = document.getElementById('FatherPhone').value;
                var FatherOccupation = document.getElementById('FatherOccupation').value;
                var MotherPhone = document.getElementById('MotherPhone').value;
                var MotherOccupation = document.getElementById('MotherOccupation').value;
                
                if(StudentName == ""){
                  Snackbar.show({pos: 'top-right',text: "Student Name Required"});
                }else if(Religion == ""){
                  Snackbar.show({pos: 'top-right',text: "Religion Required"});
                }else if(StudentGR == ""){
                  Snackbar.show({pos: 'top-right',text: "StudentGR Required"});
                }else if(ClassId == ""){
                  Snackbar.show({pos: 'top-right',text: "Class Required"});
                }else if(SectionId == ""){
                  Snackbar.show({pos: 'top-right',text: "Class Required"});
                }else if(nationality == ""){
                  Snackbar.show({pos: 'top-right',text: "Nationality Required"});
                }else if(BirthDate == ""){
                  Snackbar.show({pos: 'top-right',text: "BirthDate Required"});
                }else if(Address == ""){
                  Snackbar.show({pos: 'top-right',text: "Address Required"});
                }else if(Fee == ""){
                  Snackbar.show({pos: 'top-right',text: "Fee Required"});
                }else if(childMedical == ""){
                  Snackbar.show({pos: 'top-right',text: "childMedical Required"});
                }else if(FatherName == ""){
                  Snackbar.show({pos: 'top-right',text: "FatherName Required"});
                }else if(FatherCNIC == ""){
                  Snackbar.show({pos: 'top-right',text: "FatherCNIC Required"});
                }else if(MotherName == ""){
                  Snackbar.show({pos: 'top-right',text: "MotherName Required"});
                }else if(MotherCNIC == ""){
                  Snackbar.show({pos: 'top-right',text: "MotherCNIC Required"});
                }else if(FatherPhone == ""){
                  Snackbar.show({pos: 'top-right',text: "FatherPhone Required"});
                }else if(FatherOccupation == ""){
                  Snackbar.show({pos: 'top-right',text: "FatherOccupation Required"});
                }else if(MotherPhone == ""){
                  Snackbar.show({pos: 'top-right',text: "MotherPhone Required"});
                }else if(MotherOccupation == ""){
                  Snackbar.show({pos: 'top-right',text: "MotherOccupation Required"});
                }else{
                  var form_data = new FormData();
                      form_data.append("StudentId", document.getElementById('StudentId').value);
                      form_data.append("StudentName", StudentName);
                      form_data.append("Religion", Religion);
                      form_data.append("StudentGR", StudentGR);
                      form_data.append("ClassId", ClassId);
                      form_data.append("SectionId", SectionId);
                      form_data.append("nationality", nationality);
                      form_data.append("PhoneNumber", PhoneNumber);
                      form_data.append("BirthDate", BirthDate);
                      form_data.append("Address", Address);
                      form_data.append("Fee", Fee);
                      form_data.append("childMedical", childMedical);
                      form_data.append("FatherName", FatherName);
                      form_data.append("FatherCNIC", FatherCNIC);
                      form_data.append("MotherName", MotherName);
                      form_data.append("MotherCNIC", MotherCNIC);
                      form_data.append("FatherPhone", FatherPhone);
                      form_data.append("FatherOccupation", FatherOccupation);
                      form_data.append("MotherPhone", MotherPhone);
                      form_data.append("MotherOccupation", MotherOccupation);
                      form_data.append("Document", document.getElementById('Document').files[0]);
                      form_data.append("StudentImage", document.getElementById('imgInp2').files[0]);
                          $.ajax({
                        url:"<?php echo base_url('Admin/StudentsList/Edit'); ?>",
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


              /**************Download Cv**************** */
        function DownloadDoc(StudentId) {
          var form_data = new FormData();
          form_data.append("StudentId", StudentId);
          $.ajax({
          url:"<?php echo base_url('Admin/StudentsList/Download'); ?>",
          method:"POST",
          dataType: 'JSON',
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success:function(FilesData)
            {
            if (FilesData.status == true) {
                  var x=new XMLHttpRequest();
                  x.open("GET", "http:<?php echo base_url('uploads/Students/') ?>"+StudentId+"/"+FilesData.data['FileUrl'], true);
                  x.responseType = 'blob';
                  x.onload=function(e){download(x.response, FilesData.data['StudentName'] , "text/plain" ); }
                  x.send();
              }else{
                Snackbar.show({pos: 'top-right',text:FilesData.message});
              }
            }
          });
        }
              

        function ViewPassword(pass){
    swal("PassWord : "+pass);
  }


  function PrintList() {
      //Get the HTML of div
      var divElements = document.getElementById('studentslisttable').innerHTML;
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
</script>
</body>
</html>
