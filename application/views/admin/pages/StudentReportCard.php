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
        <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Report Card"')->row(); if(!empty($Lan)){ echo $LangList->$Word; }else{echo "Report Card";}?>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    
      <?php if(!empty($StudentId)){ $StudentName =  $this->Admindb->SingleRowField(['StudentId'=>$StudentId,'IsActive'=>true,'IsDeleted'=>false],'students','StudentName'); } ?>
      <?php if(!empty($ClassId)){ $ClassName =  $this->Admindb->SingleRowField(['ClassId'=>$ClassId,'IsActive'=>true,'IsDeleted'=>false],'class','ClassName'); } ?>
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <!-- /.box-header -->
        
        <div class="box-body">
          <div class="row">
            <div class="box-body">
            <div class="col-md-6">
              <h4><b> Student Name : </b> <?php if(!empty($StudentName)){ echo $StudentName; } ?> </h4>
              <h4><b> Class : </b> <?php if(!empty($ClassName)){ echo $ClassName; } ?></h4>
            </div>
            <div class="col-md-4">
            <label> Select Class : </label>
            <input type="hidden" value="<?php if(!empty($StudentId)){ echo $StudentId; } ?>" id="StudentId">
            <select class="form-control select2" id="ClassId">
              <option value="">Select Class</option>
              <?php if(!empty($Class)){ foreach($Class as $CLS){ ?>
                <option value="<?php if(!empty($CLS->ClassId)){ echo $CLS->ClassId; }else{ echo "0"; } ?>"><?php if(!empty($CLS->ClassName)){ echo $CLS->ClassName; }else{ echo "0"; } ?></option>
              <?php }} ?>
            </select>
            </div>
            <div class="col-md-2">
              <button type="button" class="btn btn-warning" style="margin-top:15%;" title="Promote" onclick="PromoteStudent()">Promote</button>
            </div>

            
            <table class="tableclass" style="margin-left : 8%; margin-top:5%;">
                <thead class="theadclass">
                <tr>
                    <td colspan="3" class="tdclass">Course </td>
                    <td rowspan="2" class="tdclass"> First Exam </td>
                    <td rowspan="2" class="tdclass"> Second Exam </td>
                    <td rowspan="2" class="tdclass"> Third Exam </td>
                    <td rowspan="2" class="tdclass"> Extra Activity </td>
                    <td rowspan="2" class="tdclass"> Remarks </td>
                    <td colspan="2" class="tdclass"> Result </td>
                </tr>
                <tr>
                    <td>Code </td>
                    <td colspan="2" class="tdclass"> Name </td>
                    <td class="tdclass"> Grade </td>
                    <td class="tdclass"> Total </td>
                </tr>
                </thead>
                <tbody class="tbodyclass">
                <?php if(!empty($ReportCard)){ foreach($ReportCard as $REPCRD){ 
                  $FirstExam = $this->Admindb->SingleRowField(['SubjectId'=>$REPCRD->SubjectId,'StudentId'=>$StudentId,'ClassId'=>$ClassId],'studentmarks','FirstExam');
                  $SecondExam = $this->Admindb->SingleRowField(['SubjectId'=>$REPCRD->SubjectId,'StudentId'=>$StudentId,'ClassId'=>$ClassId],'studentmarks','SecondExam');
                  $ThirdExam = $this->Admindb->SingleRowField(['SubjectId'=>$REPCRD->SubjectId,'StudentId'=>$StudentId,'ClassId'=>$ClassId],'studentmarks','ThirdExam');
                  $ExtraActivityMarks = $this->Admindb->SingleRowField(['SubjectId'=>$REPCRD->SubjectId,'StudentId'=>$StudentId,'ClassId'=>$ClassId],'studentmarks','ExtraActivityMarks');
                  $Remarks = $this->Admindb->SingleRowField(['SubjectId'=>$REPCRD->SubjectId,'StudentId'=>$StudentId,'ClassId'=>$ClassId],'studentmarks','Remarks');
                  $Grade = $this->Admindb->SingleRowField(['SubjectId'=>$REPCRD->SubjectId,'StudentId'=>$StudentId,'ClassId'=>$ClassId],'studentmarks','Grade');

                  ?> 
      
                <tr>
                    <td class="tdclass"><?php if(!empty($REPCRD->SubjectId)){ echo $REPCRD->SubjectId; } ?> </td>
                    <td colspan="2" class="tdclass"><?php if(!empty($REPCRD->SubjectName)){ echo $REPCRD->SubjectName; } ?> </td>
                    <td class="tdclass"> <?php if(!empty($FirstExam)){ echo $FirstExam; }else{ echo "Not Inserted"; }?></td>
                    <td class="tdclass"> <?php if(!empty($SecondExam)){ echo $SecondExam; }else{ echo "Not Inserted"; }?></td>
                    <td class="tdclass"> <?php if(!empty($ThirdExam)){ echo $ThirdExam; }else{ echo "Not Inserted"; }?></td>
                    <td class="tdclass"> <?php if(!empty($ExtraActivityMarks)){ echo $ExtraActivityMarks; }else{ echo "Not Inserted"; } ?></td>
                    <td class="tdclass"> <?php if(!empty($Remarks)){ echo $Remarks; }else{ echo "Not Inserted"; } ?></td>
                    <td class="tdclass"> <?php if(!empty($Grade)){ echo $Grade; }else{ echo "Not Inserted"; } ?></td>
                    <?php 
                    if(empty($FirstExam)){
                      $FirstExam = 0;
                    }
                    if(empty($SecondExam)){
                      $SecondExam = 0;
                    }
                    if(empty($ThirdExam)){
                      $ThirdExam = 0;
                    }
                    if(empty($ExtraActivityMarks)){
                      $ExtraActivityMarks = 0;
                    }
  
                    $TotalMarks = $FirstExam + $SecondExam + $ThirdExam + $ExtraActivityMarks; ?>
                    <td class="tdclass"> <?php if(!empty($TotalMarks)){ echo $TotalMarks; }else{ echo 0;} ?> </td>
                </tr>
                <?php }} ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td class="tdclass"><b>Total</b></td>
                    <td class="tdclass"> <?php if(!empty($CompleteTotal)){ echo $CompleteTotal; }else{ echo "0"; } ?> </td>
                </tr>
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
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })

  function PromoteStudent(){
    var form_data = new FormData();
        form_data.append("ClassId", document.getElementById('ClassId').value);
        form_data.append("StudentId", document.getElementById('StudentId').value);
    $.ajax({
      url:"<?php echo base_url('Admin/PromoteStudent'); ?>",
      method:"POST",
      dataType: 'JSON',
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      success:function(data)
      {
        if (data.status == true) {
          swal(""+data.message);
          setTimeout(function(){
              location.reload();
            }, 3000);
        }else{
            swal(""+data.message);
        }
      }
    });
  }
     
</script>
</body>
</html>
