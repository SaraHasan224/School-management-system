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
      <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "List";}?>
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Recruitment"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Recruitment";}?></small>
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
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#InsertRecruitment"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Candidate"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Candidate";}?></button>
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
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "CandidateName"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "CandidateName";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EmailAddress"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EmailAddress";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "PhoneNumber"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "PhoneNumber";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "CV"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "CV";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "IsShorlisted"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "IsShorlisted";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php $i=1; if(!empty($RecruitmentList)){ foreach ($RecruitmentList as $RECLI) { ?>
                <tr>
                  <td><?php echo $RECLI->Id; ?></td>
                  <td><?php echo $RECLI->CandidateName; ?></td>
                  <?php //$EmployeeName = $this->db->query('SELECT StaffName FROM staff WHERE StaffId = '.$RECLI->EmployeeId.'')->row()->StaffName; ?>
                  <td><?php echo $RECLI->EmailAddress; ?></td>
                  <td><?php echo $RECLI->PhoneNumber; ?></td>
                  <td onclick="DownloadCv(<?php echo $RECLI->RecruitmentId; ?>)" style="cursor:pointer;"><i class="fa fa-download"></i></td>
                  <td><?php echo $RECLI->Date; ?></td>
                  <?php if ($RECLI->IsShortlisted == true) {?>
                    <td><span class="text-success"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Yes"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Yes";}?></span></td>
                  <?php }else{ ?>
                  <td><span class="text-danger"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "No";}?></span></td>
                  <?php } ?>
                  <td>
                    <button type="button" class="btn btn-default" title="Delete" onclick = "DeleteCandidate(<?php echo $RECLI->RecruitmentId; ?>)"><i class="fa fa-trash text-danger"></i></button>
                    <button type="button" class="btn btn-default" title="Edit" data-toggle="modal" onclick = "EditCandidate(<?php echo $RECLI->RecruitmentId; ?>)"><i class="fa fa-edit text-success"></i></button>
                  </td>
                </tr>
                <?php $i++; } }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "CandidateName"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "CandidateName";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EmailAddress"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EmailAddress";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "PhoneNumber"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "PhoneNumber";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "CV"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "CV";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "IsShorlisted"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "IsShorlisted";}?></th>
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
  <div class="modal fade" id="InsertRecruitment">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Candidate"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Candidate";}?></h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Candidate Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Candidate Name";}?></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="CandidateName" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Candidate Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Candidate Name";}?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EmailAddress"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EmailAddress";}?></label>
                                <div class="col-sm-9">
                                <input type="email" class="form-control" id="EmailAddress" onkeyup="validateEmail()" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EmailAddress"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EmailAddress";}?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="PhoneNumber" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "CV"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "CV";}?></label>
                                <div class="col-sm-9">
                                    <input type="file" name="Cv" id="Cv" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Address";}?></label>
                                <div class="col-sm-9">
                                <textarea class="form-control" rows="3" name="Address" id="Address" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Address";}?>"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>
                      <button type="button" class="btn btn-primary" id="InsertCandidate" disabled="true" onclick="InsertCandidate()" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?></button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->


              
                  <!-- Modal For Delete -->
              <div class="modal fade" id="modal-edit">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Edit Candidate"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Edit Candidate";}?></h4>
                      <input type="hidden" id="Edit_RecruitmentId" value="">
                    </div>
                      <div class="col-md-12">
                      <div class="col-md-12">
                      <div class="form-group">
                        <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Candidate Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Candidate Name";}?> <span class="required_star"> *</span></label>
                        <input type="text" name="CandidateName" id="Edit_CandidateName" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Candidate Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Candidate Name";}?>" class="form-control" required="">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?> <span class="required_star"> *</span></label>
                        <input type="text" name="PhoneNumber" id="Edit_PhoneNumber" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?>" class="form-control" required="">
                      </div>
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                    <div class="col-md-12">
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "ShortList"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "ShortList";}?> <span class="required_star"> *</span></label>
                      <select id="Edit_IsShortlisted" class="form-control">
                        <option value="1"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Yes"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Yes";}?></option>
                        <option value="0"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "No";}?></option>
                      </select>
                    </div>
                    <!-- /.form-group -->
              <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>
                      <button type="button" class="btn btn-success" onclick="UpdateCandidate()" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Update"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Update";}?></button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->


              <!-- Modal For Delete -->
              <div class="modal fade" id="ViewModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Award Details"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Award Details";}?></h4>
                    </div>
                    <div class="modal-body">
                      <h5 id="View_Detail"></h5>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>
                      </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
    </section>
    <!-- /.content -->
    </div>
</div>

<?php include(APPPATH.'views/admin/footer.php'); ?>

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

<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,
      'pageLength' : 100
    })
  })

  /**************** Insert Candidate Details Field Using Ajax *************/
  function InsertCandidate() {
    
    var CandidateName = document.getElementById('CandidateName').value;
    var EmailAddress = document.getElementById('EmailAddress').value;
    var PhoneNumber = document.getElementById('PhoneNumber').value;
    var Address = document.getElementById('Address').value;
    if (CandidateName != "" && EmailAddress != "" && PhoneNumber != "" && Address != "") {/******** Check If Fields exits Is Same */
      var form_data = new FormData();
        form_data.append("Cv", document.getElementById('Cv').files[0]);
        form_data.append("CandidateName", CandidateName);
        form_data.append("EmailAddress", EmailAddress);
        form_data.append("PhoneNumber", PhoneNumber);
        form_data.append("Address", Address);
        $.ajax({
        url:"<?php echo base_url('Admin/Recruitment/InsertCandidate'); ?>",
        method:"POST",
        dataType: 'JSON',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success:function(AddCandidate)
        {
            if (AddCandidate.status == true) {
              Snackbar.show({pos: 'top-right',text:AddCandidate.message});
              setTimeout(function(){
                  location.reload(true);
                }, 3000);
            }else{
              Snackbar.show({pos: 'top-right',text:AddCandidate.message});
              setTimeout(function(){
                    location.reload(true);
                  }, 3000);
            }
        }
        });
    }else{
      Snackbar.show({pos: 'top-right',text:'Fill All Fields First!!!'});
    }

  } 

    /**************** Insert Department Field Using Ajax *************/
    function DeleteCandidate(Id) {
        var form_data = new FormData();
        form_data.append("RecruitmentId", Id);

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
                        url:"<?php echo base_url('Admin/recruitment/Delete'); ?>",
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

/*****************Edit Candidate Data ************************* */
    function EditCandidate(Id) {
    /**************** View award Detail Using Ajax *************/
      var edit_data = new FormData();
          edit_data.append("RecruitmentId", Id);
          $.ajax({
            url:"<?php echo base_url('Admin/recruitment/View'); ?>",
            method:"POST",
            dataType: 'JSON',
            data: edit_data,
            contentType: false,
            cache: false,
            processData: false,
            success:function(editdetails)
            {
              if (editdetails.status == true) {
                document.getElementById('Edit_RecruitmentId').value = editdetails.data['RecruitmentId'];
                document.getElementById('Edit_CandidateName').value = editdetails.data['CandidateName'];
                document.getElementById('Edit_PhoneNumber').value = editdetails.data['PhoneNumber'];
                document.getElementById('Edit_IsShortlisted').value = editdetails.data['IsShortlisted'];
                $("#modal-edit").modal('show');
              }else{
                Snackbar.show({pos: 'top-right',text:editdetails.message});
              }
            }
          });
    }

    /**************** Insert Department Field Using Ajax *************/
    function UpdateCandidate() {
      var form_data = new FormData();
          form_data.append("RecruitmentId", document.getElementById('Edit_RecruitmentId').value);
          form_data.append("CandidateName", document.getElementById('Edit_CandidateName').value);
          form_data.append("PhoneNumber", document.getElementById('Edit_PhoneNumber').value);
          form_data.append("IsShortlisted", document.getElementById('Edit_IsShortlisted').value);
          $.ajax({
            url:"<?php echo base_url('Admin/recruitment/Edit'); ?>",
            method:"POST",
            dataType: 'JSON',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success:function(UpdateCandidate)
            {
              if (UpdateCandidate.status == true) {
                  Snackbar.show({pos: 'top-right',text:UpdateCandidate.message});
                  setTimeout(function(){
                  location.reload(true);
                }, 3000);
                }else{
                      Snackbar.show({pos: 'top-right',text:UpdateCandidate.message});
                      setTimeout(function(){
                        location.reload(true);
                      }, 3000);
                }
                  }
                });
              } 

    /***********Validate Email ********* */
    function validateEmail() {
                email = document.getElementById('EmailAddress').value;
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var check = re.test(email);
                  if (!email) {
                      document.getElementById('EmailAddress').style.borderColor = "";
                      document.getElementById('InsertCandidate').disabled = true;
                    }else{
                      if (check) {
                        document.getElementById('EmailAddress').style.borderColor = "green";
                        getemail();
                      }else{
                        document.getElementById('EmailAddress').style.borderColor = "red";
                        document.getElementById('InsertCandidate').disabled = true;
                      }
                  }
    }

    /*************** Check Email already exist *************** */
    function getemail() {
          var Verify_email_form = new FormData();
          Verify_email_form.append("EmailAddress", document.getElementById('EmailAddress').value);
          $.ajax({
            url:"<?= base_url('Admin/VerifyData/Candidate'); ?>",
            method:"POST",
            dataType: 'JSON',
            data: Verify_email_form,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {
              if (data.status == true) {
                document.getElementById('EmailAddress').style.borderColor = "green";
                document.getElementById('InsertCandidate').disabled = false;
              }else{
                document.getElementById('EmailAddress').style.borderColor = "red";
                document.getElementById('InsertCandidate').disabled = true;
                Snackbar.show({pos: 'top-right',text:"This Candidate Already in List"});
              }
            }
          });
        }

        /**************Download Cv**************** */
        function DownloadCv(RecruitmentId) {
          var form_data = new FormData();
          form_data.append("DocumentId", RecruitmentId);
          form_data.append("User", "CandidateCv");
          $.ajax({
          url:"<?php echo base_url('Admin/VerifyData/CVDownload'); ?>",
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
                  x.onload=function(e){download(x.response, FilesData.data['Cv'] , "text/plain" ); }
                  x.send();
              }else{
                Snackbar.show({pos: 'top-right',text:FilesData.message});
              }
          }
        });
}
</script>
</body>
</html>
