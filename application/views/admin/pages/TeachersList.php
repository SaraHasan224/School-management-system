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
      <div class='row'>
      <div class="col-md-6">
        <h3>
          <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Teachers List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Teachers List";}?>
        </h3>
      </div>
      
        <div class="col-md-6">
            <button type="button" style="float:right;" class="btn btn-primary" onclick="PrintList()">Print</button>
        </div>
      </div>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body" id="teacherslisttable">
          <div class="row">
            <div class="box-body">
              <table id="teacher-list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "ID"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "ID";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Image";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EmailAddress"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EmailAddress";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "NationalIdentity"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "NationalIdentity";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Gender"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Gender";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php if(!empty($EmployeeList)){ foreach ($EmployeeList as $EMPLIS) { ?>
                <tr>
                  <td><?php echo $EMPLIS->Id; ?></td>
                  <td><?php if($EMPLIS->EmployeeImage){?> <img class="img-responsive" src="<?php echo $EMPLIS->EmployeeImage;?>" height="70" width="70" /> <?php }else{ ?> <img class="img-responsive" src="<?php echo base_url('assets/dist/images/School.jpg');?>" height="70" width="70" /> <?php } ?></td>
                  <td><?php echo $EMPLIS->EmployeeName; ?></td>
                  <td><?php echo $EMPLIS->EmailAddress; ?></td>
                  <td><?php echo $EMPLIS->PhoneNumber; ?></td>
                  <td><?php echo $EMPLIS->NationalIdentity; ?></td>
                  <td><?php echo $EMPLIS->Gender; ?></td>
                  <td>
                    <button type="button" title="AssignCourse" class="btn btn-default" data-toggle="modal" data-target="#AssignCourse" onclick="SendId(<?php echo $EMPLIS->EmployeeId; ?>)"><i class="fa fa-share text-success"></i></button>
                    <button type="button" title="ViewPassword" onclick="ViewPassword(<?php echo $this->encryption->decrypt($EMPLIS->Password); ?>)" class="btn btn-default"><i class="fa fa-eye text-success"></i></button>
                  </td>
                </tr>
                <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "ID"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "ID";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Image";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EmailAddress"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EmailAddress";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "NationalIdentity"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "NationalIdentity";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Gender"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Gender";}?></th>
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
    

              <script>
                function SendId(Id){
                    document.getElementById("EmployeeId").value = "";
                    document.getElementById("EmployeeId").value = Id;
                }
              </script>
                 <!-- Modal For Delete -->
  <div class="modal fade" id="AssignCourse">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Assign Course"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Assign Course";}?></h4>
                    </div>
                    <div class="modal-body">
                        <form>
                          <!-- -->
                          <input type="hidden" id="EmployeeId">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></label>
                                <div class="col-sm-9">
                                  <select class="form-control select2" id="ClassId" onchange="EnableSubjects()" style="width:100%;">
                                    <option value="">Select Class</option>
                                    <?php if(!empty($ClassList)){ foreach($ClassList as $CLIS){ ?>
                                      <option value="<?php echo $CLIS->ClassId; ?>"><?php echo $CLIS->ClassName; ?></option>
                                    <?php }} ?>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Subject" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Subject";}?></label>
                                <div class="col-sm-9">
                                  <select class="form-control select2" id="SubjectId" disabled="true" style="width:100%;">
                                    
                                  </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Day"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Day";}?></label>
                                <div class="col-sm-9">
                                  <select class="form-control select2" id="Day" style="width:100%;">
                                    <option value="">Select Day</option>
                                      <option value="Monday"> Monday </option>
                                      <option value="Tuesday"> Tuesday </option>
                                      <option value="Wednesday"> Wednesday </option>
                                      <option value="Thursday"> Thursday </option>
                                      <option value="Friday"> Friday </option>
                                      <option value="Saturday"> Saturday </option>
                                      <option value="Sunday"> Sunday </option>
                                  </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class Time From"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class Time From";}?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control timepicker" id="ClassTimeFrom" name="classtime" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class Time From"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class Time";}?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class Time To"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class Time To";}?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control timepicker" id="ClassTimeTo" name="classtime" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class Time To"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class Time To";}?>">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>
                      <button type="button" class="btn btn-primary" onclick="AssignCourse()" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?></button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->

    </section>
    <!-- /.content -->
<!-- Page script -->

</div>
</div>

<?php include(APPPATH.'views/admin/footer.php'); ?>
<script>

  $(document).ready(function() {
    $('#teacher-list').DataTable({
      "fnRowCallback" : function(nRow, aData, iDisplayIndex){
        $("td:first", nRow).html(iDisplayIndex +1);
        return nRow;
      },
      "lengthMenu": [[50, 100, 250, -1], [50, 100, 250, "All"]]
    });
  });

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
        timeFormat: 'HH:mm:ss',
        showInputs: false,
        showMeridian: false  
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


  function ViewPassword(pass){
    swal("PassWord : "+pass);
  }

  function EnableSubjects(){
    var SchoolClass = document.getElementById('ClassId').value;
    if(SchoolClass !=""){
      var form_data = new FormData();
          form_data.append("Class", SchoolClass);
          $.ajax({
              url:"<?php echo base_url('Admin/VerifyData/SubjectCheck'); ?>",
              method:"POST",
              dataType: 'JSON',
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              success:function(ManageSyllabus)
              {
                $('#SubjectId').empty();
                if (ManageSyllabus.status == true) {
                  const EditRow = []; 
                  for(var inv = 0; inv < ManageSyllabus.data.length; inv++){
                    EditRow.push("<option value='"+ManageSyllabus.data[inv]['SubjectId']+"'>"+ManageSyllabus.data[inv]['SubjectName']+"</option>");
                  }
                  document.getElementById('SubjectId').innerHTML +="<option value=''>Select Subject</option>"+EditRow;
                  document.getElementById('SubjectId').disabled = false;
                }else{
                  Snackbar.show({pos: 'top-right',text:ManageSyllabus.message});
                  document.getElementById('SubjectId').disabled = true;
                }
              }
          });
    }else{
      document.getElementById('SubjectId').disabled = true;
    }
  }

          /**************** AssignCourse Field Using Ajax *************/
              function AssignCourse() {
                var EmployeeId = document.getElementById('EmployeeId').value;
                var ClassId = document.getElementById('ClassId').value;
                var SubjectId = document.getElementById('SubjectId').value;
                var Day = document.getElementById('Day').value;
                var ClassTimeFrom = document.getElementById('ClassTimeFrom').value;
                var ClassTimeTo = document.getElementById('ClassTimeTo').value;
                
                if (EmployeeId != "" && ClassId != "" && SubjectId != "" && Day != "" && ClassTimeFrom != "" && ClassTimeTo != "") {
                    var form_data = new FormData();
                    form_data.append("EmployeeId", EmployeeId);
                    form_data.append("ClassId", ClassId);
                    form_data.append("SubjectId", SubjectId);
                    form_data.append("Day", Day);
                    form_data.append("ClassTimeFrom", ClassTimeFrom);
                    form_data.append("ClassTimeTo", ClassTimeTo);
                    $.ajax({
                        url:"<?php echo base_url('Admin/TeachersList/AssignCourse'); ?>",
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
                }else{
                    Snackbar.show({pos: 'top-right',text:"All Fields Are Mandatory"});
                }
              } 


              /**************Download Cv**************** */
        function DownloadCv(EmployeeId) {
          var form_data = new FormData();
          form_data.append("EmployeeId", EmployeeId);
          $.ajax({
          url:"<?php echo base_url('Admin/VerifyData/EmployeeCv'); ?>",
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
                  x.open("GET", "http:"+FilesData.data['FileUrl'], true);
                  x.responseType = 'blob';
                  x.onload=function(e){download(x.response, FilesData.data['EmployeeName'] , "text/plain" ); }
                  x.send();
              }else{
                Snackbar.show({pos: 'top-right',text:FilesData.message});
              }
            }
          });
        }
              

        function PrintList() {
      //Get the HTML of div
      var divElements = document.getElementById('teacherslisttable').innerHTML;
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
