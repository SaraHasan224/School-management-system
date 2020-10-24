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
        <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Subject";}?>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#InsertSubject"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Subject";}?></button>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="box-body">
            <p class="<?php if($this->session->flashdata('CheckStatus') == 'True'){ echo "text-success"; }else{ echo "text-danger"; } ?>"><?php if($this->session->flashdata('InsertSubject')){ 
              echo $this->session->flashdata('InsertSubject'); }
              ?></p>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Subject Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Subject Name";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "InsertDate"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "InsertDate";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php $i =1; if(!empty($SubjectList)){ foreach ($SubjectList as $SUBJLIS) { ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo ucwords($SUBJLIS->SubjectName); ?></td>
                  <td><?php echo $SUBJLIS->ClassName; ?></td>
                  <td><?php echo $SUBJLIS->InsertDate; ?></td>
                  <td>
                    <button type="button" class="btn btn-default" onclick = "DeleteSubject(<?php echo $SUBJLIS->SubjectId; ?>)"><i class="fa fa-trash text-danger"></i></button>
                  </td>
                </tr>
                <?php $i++; } } ?>

                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Subject Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Subject Name";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "InsertDate"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "InsertDate";}?></th>
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
  <div class="modal fade" id="InsertSubject">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Subject";}?></h4>
                    </div>
                    <div class="modal-body">
                        <form>
                          <!-- -->
                            <div class="form-group row">
                                <label for="staticSubjectName" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Subject Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Subject Name";}?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="SubjectName" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Subject Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Subject Name";}?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticClass" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Class";}?></label>
                                <div class="col-sm-9">
                                <select class="form-control select2" id="Class" multiple="multiple" data-placeholder="Select a State"
                                    style="width: 100%;">
                                <option value = "">Select Class</option>
                                <?php if(!empty($ClassList)){ foreach($ClassList as $CLSLI){ ?> 
                                  <option value="<?php echo $CLSLI->ClassId; ?>"><?php echo $CLSLI->ClassName; ?></option>
                                <?php }} ?>
                                </select>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="modal-footer">
                      <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>
                      <button type="button" class="btn btn-primary" onclick="InsertSubject()" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?></button>
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
      'autoWidth'   : false,
      'pageLength' : 100
    })
  })

  /**************** Insert Insurance Details Field Using Ajax *************/
  function InsertSubject() {
        Itemarr = [];
        var SubjectName = document.getElementById('SubjectName').value;
        var ClassLength = document.getElementsByClassName("select2-selection__choice").length;
        for (var ip = 0; ip < ClassLength; ip++) {
            Itemarr.push("{"+'"Class":'+'"'+document.getElementsByClassName("select2-selection__choice")[ip].title+'"'+"}");
        }
            if (SubjectName != "" && ClassLength > 0) {/******** Check If Fields exits Is Same *********/
                var form_data = new FormData();
                form_data.append("SubjectName", document.getElementById('SubjectName').value);
                form_data.append("Class", "["+Itemarr+"]");
                $.ajax({
                url:"<?php echo base_url('Admin/InsertSubject/Insert'); ?>",
                method:"POST",
                dataType: 'JSON',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(InsertSchool)
                {
                    if (InsertSchool.status == true) {
                      Snackbar.show({pos: 'top-right',text:InsertSchool.message});
                      location.reload();
                    }else{
                      Snackbar.show({pos: 'top-right',text:InsertSchool.message});
                      location.reload();
                    }
                }
                });
            }else{
              Snackbar.show({pos: 'top-right',text:'All Fields Are Mandatory!!!'});
            }

  } 


      /**************** Insert Department Field Using Ajax *************/
  function DeleteSubject(Id) {
        var form_data = new FormData();
        form_data.append("SubjectId", Id);

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
                        url:"<?php echo base_url('Admin/InsertSubject/Delete'); ?>",
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
              
</script>
</body>
</html>
