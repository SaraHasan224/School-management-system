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
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "ShortListedCandidates"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "ShortListedCandidates";}?></small>
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
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "InterViewTime"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "InterViewTime";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "InterViewCall"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "InterViewCall";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php $i=1; if(!empty($ShortListedList)){ foreach ($ShortListedList as $RECLI) { ?>
                <tr>
                  <td><?php echo $RECLI->Id; ?></td>
                  <td><?php echo $RECLI->CandidateName; ?></td>
                  <td><?php echo $RECLI->EmailAddress; ?></td>
                  <td><?php echo $RECLI->PhoneNumber; ?></td>
                  <td onclick="DownloadCv(<?php echo $RECLI->RecruitmentId; ?>)" style="cursor:pointer;"><i class="fa fa-download"></i></td>
                  <td><?php if($RECLI->InterViewTime != ""){ echo $RECLI->InterViewTime; }else{ echo "No Time Given"; } ?></td>
                  <td><?php echo $RECLI->Date; ?></td>
                  <?php if ($RECLI->IsInterview == true) {?>
                    <td><span class="text-success"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Yes"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Yes";}?></span></td>
                  <?php }else{ ?>
                  <td><span class="text-danger"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "No";}?></span></td>
                  <?php } ?>
                  <td>
                    <button type="button" class="btn btn-default" title="Delete" onclick = "DeleteCandidate(<?php echo $RECLI->RecruitmentId; ?>)"><i class="fa fa-trash text-danger"></i></button>
                    <button type="button" class="btn btn-default" title="Edit" data-toggle="modal" onclick = "EditCandidate(<?php echo $RECLI->RecruitmentId; ?>)"><i class="fa fa-edit text-success"></i></button>
                    <?php if ($RECLI->InterViewTime != "" && $RECLI->IsInterview == false) { ?>
                        <button type="button" class="btn btn-default" data-toggle="modal" disabled="true"><i class="fa fa-check text-success"></i></button>
                    <?php }else{ ?>
                        <button type="button" class="btn btn-default" title="Select" data-toggle="modal" data-target="#modalSelected" onclick = "SelectCandidate(<?php echo $RECLI->RecruitmentId; ?>)"><i class="fa fa-check text-success"></i></button>
                    <?php } ?>
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
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "InterviewTime"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "InterviewTime";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "InterViewCall"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "InterViewCall";}?></th>
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
                  function SelectCandidate(Id) {
                    document.getElementById('RecruitmentIdSelect').value = Id;
                  }
                  </script>
              <!-- Modal For Delete -->
              <div class="modal fade" id="modalSelected">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Candidate"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Candidate";}?></h4>
                      <input type="hidden" id="RecruitmentIdSelect" value="">
                    </div>
                    <div class="modal-body">
                      <p><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Do You Really Want to Select/Hire this Candidate?"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Do You Really Want to Select/Hire this Candidate?";}?>&hellip;</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>
                      <button type="button" class="btn btn-success" onclick="SelectOk()" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Yes"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Yes";}?></button>
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
                        <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "InterView Timing"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "InterView Timing";}?> <span class="required_star"> *</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control timepicker" id="Edit_InterViewTime">

                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                          </div>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-12">
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "InterViewShortList"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "InterViewShortList";}?> <span class="required_star"> *</span></label>
                      <select id="Edit_IsInterview" class="form-control">
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
    </section>
    <!-- /.content -->
<!-- ./wrapper -->
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
      'autoWidth'   : false
    })
  })

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
                        url:"<?php echo base_url('Admin/Shortlisted/Delete'); ?>",
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
    /**************** Select Candidate from Shortlisted table *************/
  function SelectOk() {
    var form_data = new FormData();
        form_data.append("RecruitmentId", document.getElementById('RecruitmentIdSelect').value);
        $.ajax({
          url:"<?php echo base_url('Admin/Shortlisted/Select'); ?>",
          method:"POST",
          dataType: 'JSON',
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success:function(data)
          {
            if (data.status == true) {
                Snackbar.show({pos: 'top-right',text:data.message});
                setTimeout(function(){
                        location.reload(true);
                      }, 3000);
              }else{
                  Snackbar.show({pos: 'top-right',text:data.message});
                  setTimeout(function(){
                        location.reload(true);
                      }, 3000);
              }
          }
        });
    } 

/*****************Edit Candidate Data ************************* */
    function EditCandidate(Id) {
    /**************** View award Detail Using Ajax *************/
      var edit_data = new FormData();
          edit_data.append("RecruitmentId", Id);
          $.ajax({
            url:"<?php echo base_url('Admin/Shortlisted/View'); ?>",
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
                document.getElementById('Edit_InterViewTime').value = editdetails.data['InterViewTime'];
                document.getElementById('Edit_IsInterview').value = editdetails.data['IsInterview'];
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
          form_data.append("InterViewTime", document.getElementById('Edit_InterViewTime').value);
          form_data.append("IsInterview", document.getElementById('Edit_IsInterview').value);
          $.ajax({
            url:"<?php echo base_url('Admin/Shortlisted/Edit'); ?>",
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
