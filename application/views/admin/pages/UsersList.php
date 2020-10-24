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
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Designation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Designation";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Status";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody id="user-table">
                  <?php $i = 1; if(!empty($UsersList)){foreach($UsersList as $USELIS){ ?> 
                  <tr>
                    <td class="text-center align-middle"><?php if(!empty($i)){ echo $i; } ?></td>
                    <td class="text-center align-middle"><img width="50" alt="Image" class="img-fluid img-thumbnail rounded-circle" src="<?php if(!empty($USELIS->StaffImage)){ echo base_url('uploads/staff/'.$USELIS->StaffId.'/'.$USELIS->StaffImage); }else{ echo base_url('assets/dist/images/StaffIcon.png'); } ?>"></td>
                    <td class="text-center align-middle"><?php if(!empty($USELIS->StaffName)){ echo $USELIS->StaffName; } ?></td>
                    <td class="text-center align-middle"><?php if(!empty($USELIS->Designation)){ echo $USELIS->Designation; }else{ echo "Admin"; } ?></td>
                    <td class="text-center align-middle"><?php if(!empty($USELIS->PhoneNumber)){ echo $USELIS->PhoneNumber; }else{ echo "0"; } ?></td>
                    <td class="text-center align-middle"><?php echo ($USELIS->IsActive == true)? '<span class="fas fa-check text-success">' :'<span class="fas fa-times text-danger">'; ?></span></td>                  
                    <td class="text-center align-middle">
                      <div class="btn-group btn-group-sm" role="group">
                        <!-- <a href="" class="btn btn-warning cxm-btn-1 fs13" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><span class="fas fa-eye"></span></a> -->
                        <button class="btn btn-warning cxm-btn-1 fs13" data-toggle="tooltip" data-placement="top" title="Update Status" data-original-title="Status" onclick="UpdateUser(<?php echo $USELIS->StaffId; ?>)"><span class="fas fa-lock"></span></button>
                        <button class="btn btn-warning cxm-btn-1 fs13" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="DeleteUser(<?php echo $USELIS->StaffId; ?>)"><span class="fas fa-trash-alt"></span></button>
                      </div>
                    </td>
                  </tr>
                  
                  <?php $i++; }} ?>                  
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Image";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Designation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Designation";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Status";}?></th>
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

 /**************** Insert Department Field Using Ajax *************/
function DeleteUser(Id) {
        var form_data = new FormData();
        form_data.append("StaffId", Id);
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
              url:"<?php echo base_url('Admin/UsersList/Delete'); ?>",
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
        }else {
          swal("Your imaginary file is safe!");
        }
      });

      } 



      /**************** Insert Department Field Using Ajax *************/
function UpdateUser(Id) {
        var form_data = new FormData();
        form_data.append("StaffId", Id);
        swal({
          title: "Are you sure?",
          text: "you want to update this!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
              url:"<?php echo base_url('Admin/UsersList/Updated'); ?>",
              method:"POST",
              dataType: 'JSON',
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              success:function(data)
              {
                if (data.status == true) {
                  swal("Poof! Your imaginary file has been updated!", {
                    icon: "success",
                  });
                  location.reload();
                }else{
                  swal("Your imaginary file is safe!");
                    location.reload();
                  }
                }
              });
        }else {
          swal("Your imaginary file is safe!");
        }
      });

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
              
</script>
</body>
</html>
