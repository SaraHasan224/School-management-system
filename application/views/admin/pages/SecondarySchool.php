<?php include(APPPATH.'views/admin/meta_tags.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php include(APPPATH.'views/admin/head.php'); ?>
</head>

<body>
<div class="wrapper">

  <!-- Navbar -->
  <?php include(APPPATH.'views/admin/header.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Secondary School"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Secondary School";}?>
      </h1>
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
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "ID"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "ID";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "SchoolLogo"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "SchoolLogo";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "School Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "School Name";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "School Type"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "School Type";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Employees"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Employees";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Address";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "IsActive"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "IsActive";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php if(!empty($SchoolList)){ foreach ($SchoolList as $SCHLIS) { ?>
                <tr>
                  <td><?php echo $SCHLIS->Id; ?></td>
                  <td><?php if($SCHLIS->SchoolLogo){?> <img class="img-responsive" src="<?php echo $SCHLIS->SchoolLogo;?>" height="70" width="70" /> <?php }else{ ?> <img class="img-responsive" src="<?php echo base_url('assets/dist/images/School.jpg');?>" height="70" width="70" /> <?php } ?></td>
                  <td><?php echo $SCHLIS->SchoolName; ?></td>
                  <td><?php echo $SCHLIS->SchoolType; ?></td>
                  <?php $Count = $this->db->query('SELECT COUNT(*) AS Total FROM employee WHERE Posting = '.$SCHLIS->SchoolId.'')->row()->Total;?>
                  <td><?php echo $Count; ?></td>
                  <td><?php echo $SCHLIS->SchoolAddress; ?></td>
                  <?php if ($SCHLIS->IsActive == true) {?>
                    <td><span class="text-success"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Active"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Active";}?></span></td>
                  <?php }else{ ?>
                  <td><span class="text-danger"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "InActive"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "InActive";}?></span></td>
                  <?php } ?>
                  <td>
                    <button type="button" class="btn btn-default" data-toggle="modal" onclick = "BlockSchool(<?php echo $SCHLIS->SchoolId; ?>)">
                      <?php if ($SCHLIS->IsActive == true) {?>
                        <i class="fa fa-lock text-danger"></i>
                      <?php }else{ ?>
                        <i class="fa fa-lock-open text-success"></i>
                      <?php } ?>
                    </button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#DeleteSchool" onclick = "DeleteSchool(<?php echo $SCHLIS->SchoolId; ?>)"><i class="fa fa-trash text-danger"></i></button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#EditSchool" onclick = "EditSchool(<?php echo $SCHLIS->SchoolId; ?>)"><i class="fa fa-edit text-success"></i></button>
                  </td>
                </tr>
                <?php } } ?>

                </tbody>
                <tfoot>
                <tr>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "ID"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "ID";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "SchoolLogo"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "SchoolLogo";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "School Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "School Name";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "School Type"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "School Type";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Employees"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Employees";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Address";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "IsActive"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "IsActive";}?></th>
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
      <script>
                  function DeleteSchool(Id) {
                    document.getElementById('SchoolId').value = Id;
                  }
                </script>
              <!-- Modal For Delete -->
                <div class="modal fade" id="DeleteSchool">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Delete School"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Delete School";}?></h4>
                      <input type="hidden" id="SchoolId" value="">
                    </div>
                    <div class="modal-body">
                      <p><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Do You Really Want to delete this?"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Do You Really Want to delete this?";}?>&hellip;</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>
                      <button type="button" class="btn btn-danger" onclick="DeleteOk()" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Delete"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Delete";}?></button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->

              
                  <!-- Modal For Delete -->
              <div class="modal fade" id="EditSchool">
                
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
      'autoWidth'   : false
    })
  })



  /**************** Insert Department Field Using Ajax *************/
  function DeleteOk() {
                      var form_data = new FormData();
                      form_data.append("SchoolId", document.getElementById('SchoolId').value);
                      $.ajax({
                        url:"<?php echo base_url('Admin/SecondarySchool/Delete'); ?>",
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
                            $.ajax({
                                url:"<?php echo base_url('Admin/SecondarySchool'); ?>",
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
                            Snackbar.show({pos: 'top-right',text:data.message});
                          }
                        }
                      });

                  } 


                  /**************** Block School *************/
  function BlockSchool(Id) {
                      var form_data = new FormData();
                      form_data.append("SchoolId", Id);
                      $.ajax({
                        url:"<?php echo base_url('Admin/SecondarySchool/Block'); ?>",
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
                            $.ajax({
                                url:"<?php echo base_url('Admin/SecondarySchool'); ?>",
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
                            Snackbar.show({pos: 'top-right',text:data.message});
                          }
                        }
                      });

                  } 


                  /**************Edit Insurance*********** */
                  function EditSchool(Id) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#EditSchool").empty();
                    var edit_data = new FormData();
                      edit_data.append("SchoolId", Id);
                      $.ajax({
                        url:"<?php echo base_url('Admin/SecondarySchool/View'); ?>",
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
                            if(editdetails.data['SchoolLogo']){ var Condition = editdetails.data['SchoolLogo']; }else{ var Condition = Image; }
                            document.getElementById("EditSchool").innerHTML+= "<div class='modal-dialog'>"+
                  "<div class='modal-content'>"+
                    "<div class='modal-header'>"+
                      "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
                        "<span aria-hidden='true'>&times;</span></button>"+
                      "<h4 class='modal-title'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Edit Insurance"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Edit Insurance";}?></h4>"+
                      "<input type='hidden' id='Edit_InsuranceId' value=''>"+
                    "</div>"+
                      "<div class='col-md-12'>"+
                      "<form>"+
                          "<div class='col-md-12'>"+
                          "<div class='img-top'>"+
                          "<img class='img-responsive' id='blah2' alt='' src='"+Condition+"' height='150' width='150' />"+
                                  "<div class=''>"+
                                      "<label class='upimage'> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Upload Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Upload Image";}?>"+
                                      "<input type='file' name='SchoolLogo' id='imgInp2'  class='form-control custom-input-form-control'>"+
                                      "</label>"+
                                  "</div>"+
                            "</div>"+
                          "</div>"+
                            "<div class='form-group row'>"+
                                "<label for='staticSchoolName' class='col-sm-3 col-form-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "School Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "School Name";}?></label>"+
                                "<div class='col-sm-9'>"+
                                    "<input type='text' class='form-control' value='"+editdetails.data['SchoolName']+"' id='SchoolName2' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "School Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "School Name";}?>'>"+
                                "</div>"+
                            "</div>"+
                            "<div class='form-group row'>"+
                                "<label for='staticAddress' class='col-sm-3 col-form-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "School Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "School Address";}?></label>"+
                                "<div class='col-sm-9'>"+
                                    "<input type='text' class='form-control' value='"+editdetails.data['SchoolAddress']+"' id='SchoolAddress2' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "School Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "School Address";}?>'>"+
                                "</div>"+
                            "</div>"+
                            "<div class='form-group row'>"+
                                "<label for='staticEmail' class='col-sm-3 col-form-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "School Type"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "School Type";}?></label>"+
                                "<div class='col-sm-9'>"+
                                  "<select class='form-control' id='SchoolType2'>"+
                                    "<option value=''>Select SchoolType</option>"+
                                    "<option value='Primary'>Primary</option>"+
                                    "<option value='Secondary'>Secondary</option>"+
                                  "</select>"+
                                "</div>"+
                            "</div>"+
                        "</form>"+
                      "</div>"+
                    "<div class='modal-footer'>"+
                      "<button type='button' class='btn btn-default pull-left' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>"+
                      "<button type='button' class='btn btn-success' onclick='UpdateSchool("+editdetails.data['SchoolId']+")' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Update"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Update";}?></button>"+
                    "</div>"+
                  "</div>"+
                "</div>";
                            document.getElementById('SchoolType2').value = editdetails.data['SchoolType'];
                            $("#EditSchool").modal('show');

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
                          }else{
                            Snackbar.show({pos: 'top-right',text:editdetails.message});
                          }
                        }
                      });
                  }


          /**************** Insert Department Field Using Ajax *************/
              function UpdateSchool(Id) {
                var SchoolName = document.getElementById('SchoolName2').value;
                var SchoolAddress = document.getElementById('SchoolAddress2').value;
                var SchoolType = document.getElementById('SchoolType2').value;
                var form_data = new FormData();
                form_data.append("SchoolId", Id);
                form_data.append("SchoolName", document.getElementById('SchoolName2').value);
                form_data.append("SchoolAddress", document.getElementById('SchoolAddress2').value);
                form_data.append("SchoolType", document.getElementById('SchoolType2').value);
                form_data.append("SchoolLogo", document.getElementById('imgInp2').files[0]);
                if (SchoolName != "" && SchoolAddress != "" && SchoolType != "") {
                    $.ajax({
                  url:"<?php echo base_url('Admin/SecondarySchool/Edit'); ?>",
                  method:"POST",
                  dataType: 'JSON',
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success:function(UpdateSchool)
                  {
                    if (UpdateSchool.status == true) {
                      Snackbar.show({pos: 'top-right',text:UpdateSchool.message});
                      $.ajax({
                                url:"<?php echo base_url('Admin/SecondarySchool'); ?>",
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
                      Snackbar.show({pos: 'top-right',text:UpdateSchool.message});
                    }
                  }
                });
                  
                }else{
                    Snackbar.show({pos: 'top-right',text:"Insurance Name Required"});
                }
              } 

              
</script>
</body>
</html>
