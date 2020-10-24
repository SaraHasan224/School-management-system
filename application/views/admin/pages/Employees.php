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
        <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Employee List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Employee List";}?>
      </h1>
    </section>
    <!-- Main content -->
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
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Image";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EmailAddress"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EmailAddress";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Designation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Designation";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "NationalIdentity"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "NationalIdentity";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Cv"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Cv";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Gender"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Gender";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; if(!empty($EmployeeList)){ foreach ($EmployeeList as $EMPLIS) { ?>
                <tr>
                  <td><?php echo $EMPLIS->Id; ?></td>
                  <td><?php if($EMPLIS->EmployeeImage){?> <img class="img-responsive" src="<?php echo $EMPLIS->EmployeeImage;?>" height="70" width="70" /> <?php }else{ ?> <img class="img-responsive" src="<?php echo base_url('assets/dist/images/School.jpg');?>" height="70" width="70" /> <?php } ?></td>
                  <td><?php echo $EMPLIS->EmployeeName; ?></td>
                  <td><?php echo $EMPLIS->EmailAddress; ?></td>
                  <td><?php echo $EMPLIS->Designation; ?></td>
                  <td><?php echo $EMPLIS->PhoneNumber; ?></td>
                  <td><?php echo $EMPLIS->NationalIdentity; ?></td>
                  <td onclick="DownloadCv(<?php echo $EMPLIS->EmployeeId; ?>)" style="cursor:pointer;"><i class="fa fa-download"></i></td>
                  <td><?php echo $EMPLIS->Gender; ?></td>
                  <td>
                    <button type="button" title="Delete" class="btn btn-default" onclick = "DeleteEmployee(<?php echo $EMPLIS->EmployeeId; ?>)"><i class="fa fa-trash text-danger"></i></button>
                    <button type="button" title="Edit" class="btn btn-default" onclick = "EditEmployee(<?php echo $EMPLIS->EmployeeId; ?>)"><i class="fa fa-edit text-success"></i></button>
                    <!-- <button type="button" title="Posting" class="btn btn-default" onclick = "TransferEmployee(<?php echo $EMPLIS->EmployeeId; ?>)"><i class="fa fa-exchange-alt text-success"></i></button> -->
                  </td>
                </tr>
                <?php $i++; } } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Image";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EmailAddress"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EmailAddress";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Designation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Designation";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "NationalIdentity"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "NationalIdentity";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Cv"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Cv";}?></th>
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
    

              
                  <!-- Modal For Delete -->
              <div class="modal fade" id="EditEmployee">
                
              </div>
              <!-- /.modal -->

              <!-- Modal For Delete -->
              <div class="modal fade" id="Posting">
                
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
                        setTimeout(function(){
                            location.reload();
                      }, 3000);
                    }else{
                    Snackbar.show({pos: 'top-right',text:EmployeeList.message});
                    }
                }
                });
            }else{
              Snackbar.show({pos: 'top-right',text:'All Fields Are Mandatory!!!'});
            }
  } 


  /**************** Insert Department Field Using Ajax *************/
function DeleteEmployee(Id) {
        var form_data = new FormData();
        form_data.append("EmployeeId", Id);

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
                        url:"<?php echo base_url('Admin/Employees/Delete'); ?>",
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



                

                  /**************Edit Insurance*********** */
                  function EditEmployee(Id) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#EditEmployee").empty();
                    var edit_data = new FormData();
                      edit_data.append("EmployeeId", Id);
                      $.ajax({
                        url:"<?php echo base_url('Admin/Employees/View'); ?>",
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
                            if(editdetails.data['EmployeeImage']){ var Condition = editdetails.data['EmployeeImage']; }else{ var Condition = Image; }
                            document.getElementById("EditEmployee").innerHTML+= "<div class='modal-dialog'>"+
                  "<div class='modal-content'>"+
                    "<div class='modal-header'>"+
                      "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
                        "<span aria-hidden='true'>&times;</span></button>"+
                      "<h4 class='modal-title'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Edit Employee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Edit Employee";}?></h4>"+
                    "</div>"+
                      "<div class='col-md-12'>"+
                      "<form>"+
                          "<div class='col-md-12'>"+
                          "<div class='img-top'>"+
                          "<img class='img-responsive' id='blah2' alt='' src='"+Condition+"' height='150' width='150' />"+
                                  "<div class=''>"+
                                      "<label class='upimage'> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Upload Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Upload Image";}?>"+
                                      "<input type='file' name='EmployeeImage' id='imgInp2'  class='form-control custom-input-form-control'>"+
                                      "</label>"+
                                  "</div>"+
                            "</div>"+
                          "</div>"+
                            "<div class='form-group row'>"+
                                "<label for='staticEmployeeName' class='col-sm-3 col-form-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Employee Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Employee Name";}?></label>"+
                                "<div class='col-sm-9'>"+
                                    "<input type='text' class='form-control' value='"+editdetails.data['EmployeeName']+"' id='EmployeeName' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Employee Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Employee Name";}?>'>"+
                                "</div>"+
                            "</div>"+
                            "<div class='form-group row'>"+
                                "<label for='staticAddress' class='col-sm-3 col-form-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Designation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Designation";}?></label>"+
                                "<div class='col-sm-9'>"+
                                    "<input type='text' class='form-control' readonly='' value='"+editdetails.data['Designation']+"' id='Designation' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Designation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Designation";}?>'>"+
                                "</div>"+
                            "</div>"+
                            "<div class='form-group row'>"+
                                "<label for='staticPhone' class='col-sm-3 col-form-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?></label>"+
                                "<div class='col-sm-9'>"+
                                    "<input type='text' class='form-control' value='"+editdetails.data['PhoneNumber']+"' id='PhoneNumber' placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?>'>"+
                                "</div>"+
                            "</div>"+
                            "<div class='form-group row'>"+
                                "<label for='staticAddress' class='col-sm-3 col-form-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Address";}?></label>"+
                                "<div class='col-sm-9'>"+
                                    "<textarea class='form-control' Id='Address' placeholder='Employee Address'>"+editdetails.data['Address']+"</textarea>"+
                                "</div>"+
                            "</div>"+
                        "</form>"+
                      "</div>"+
                    "<div class='modal-footer'>"+
                      "<button type='button' class='btn btn-default pull-left' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>"+
                      "<button type='button' class='btn btn-success' onclick='UpdateEmployee("+editdetails.data['EmployeeId']+")' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Update"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Update";}?></button>"+
                    "</div>"+
                  "</div>"+
                "</div>";
                            
                            $("#EditEmployee").modal('show');

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


                  /**************** Employee Transfer or posting *************/
              // function Posting(Id) {
              //   var SchoolId = document.getElementById('SchoolId').value;
                
              //   if (SchoolId != "") {
              //       var form_data = new FormData();
              //       form_data.append("EmployeeId", Id);
              //       form_data.append("SchoolId", SchoolId);
              //       $.ajax({
              //     url:"<?php //echo base_url('Admin/Employees/Posting'); ?>",
              //     method:"POST",
              //     dataType: 'JSON',
              //     data: form_data,
              //     contentType: false,
              //     cache: false,
              //     processData: false,
              //     success:function(Posting)
              //     {
              //       if (Posting.status == true) {
              //         Snackbar.show({pos: 'top-right',text:Posting.message});
              //         $.ajax({
              //                   url:"<?php //echo base_url('Admin/Employees'); ?>",
              //                   beforeSend: function(){
              //                   $("#page-loader").show();
              //                   },
              //                   complete: function(){
              //                   $("#page-loader").hide();
              //                   },
              //                   success:function(data)
              //                   {
                                
              //                   $('#ContentResult').empty();
              //                   $('#ContentResult').html(data);
              //                   }
              //               });
              //       }else{
              //         Snackbar.show({pos: 'top-right',text:Posting.message});
              //       }
              //     }
              //   });
                  
              //   }else{
              //       Snackbar.show({pos: 'top-right',text:"All Fields Are Mandatory"});
              //   }
              // } 

          /**************** Insert Department Field Using Ajax *************/
              function UpdateEmployee(Id) {
                var EmployeeName = document.getElementById('EmployeeName').value;
                var Designation = document.getElementById('Designation').value;
                var PhoneNumber = document.getElementById('PhoneNumber').value;
                var Address = document.getElementById('Address').value;
                
                if (EmployeeName != "" && Designation != "" && PhoneNumber != "" && Address != "") {
                    var form_data = new FormData();
                form_data.append("EmployeeId", Id);
                form_data.append("EmployeeName", EmployeeName);
                form_data.append("Designation", Designation);
                form_data.append("PhoneNumber", PhoneNumber);
                form_data.append("Address", Address);
                form_data.append("EmployeeImage", document.getElementById('imgInp2').files[0]);
                    $.ajax({
                  url:"<?php echo base_url('Admin/Employees/Edit'); ?>",
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
              
</script>
</body>
</html>
