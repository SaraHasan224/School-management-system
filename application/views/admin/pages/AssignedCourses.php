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
      <div class="row">
        <div class="col-md-6">
        <h3>
          <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Assigned Courses"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Assigned Courses";}?>
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
        <div class="box-body" id="assignedlisttable">
          <div class="row">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Subject";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Day"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Day";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "StartTime"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "StartTime";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EndTime"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EndTime";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "TeacherName"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "TeacherName";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php if(!empty($CourseList)){ foreach ($CourseList as $COLIS) { ?>
                <tr>
                  <td><?php echo $COLIS->ClassName; ?></td>
                  <td><?php echo $COLIS->SubjectName; ?></td>
                  <td><?php echo $COLIS->Day; ?></td>
                  <td><?php echo $COLIS->ClassTimeFrom; ?></td>
                  <td><?php echo $COLIS->ClassTimeTo; ?></td>
                  <td><?php echo $COLIS->EmployeeName; ?></td>
                  <td>
                  <button type="button" class="btn btn-default" onclick = "DeleteSlot(<?php echo $COLIS->AssignId; ?>)"><i class="fa fa-trash text-danger"></i></button>
                  </td>
                </tr>
                <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Subject";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Day"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Day";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "StartTime"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "StartTime";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EndTime"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EndTime";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "TeacherName"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "TeacherName";}?></th>
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


  /**************** Insert Department Field Using Ajax *************/
  function DeleteSlot(Id) {
        var form_data = new FormData();
        form_data.append("AssignId", Id);

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
                        url:"<?php echo base_url('Admin/AssignedCourses/Delete'); ?>",
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
      var divElements = document.getElementById('assignedlisttable').innerHTML;
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
