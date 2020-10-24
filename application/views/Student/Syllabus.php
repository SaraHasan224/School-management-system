<?php include('include/meta_tags.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('include/head.php'); ?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include('include/header.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('include/left-bar.php'); ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Syllabus</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Syllabus</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <div class="content">
    <div class="mb-3">
</div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Syllabus List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table id="dataTable1" class="table table-striped">
            <thead>
              <tr>
                <th style="width:10%; text-center">#</th>
                <th class="text-center">Subject</th>
                <th class="text-center">Class</th>
                <th class="text-center">Syllabus</th>
                <th class="text-center">InsertDate /Time</th>
              </tr>
            </thead>
            <tbody id="subject-table">
              <?php $i = 1; if(!empty($Syllabus)){foreach($Syllabus as $SUBJ){ ?>
              <tr>
                <td class="text-center"><?php if(!empty($i)){ echo $i; } ?></td>
                <td class="text-center"><?php if(!empty($SUBJ->SubjectName)){ echo $SUBJ->SubjectName; } ?></td>
                <td class="text-center"><?php if(!empty($SUBJ->ClassName)){ echo $SUBJ->ClassName; } ?></td>
                <td class="text-center" style="cursor:pointer;"><a href="<?php if(!empty($SUBJ->Syllabus)){ echo $SUBJ->Syllabus; } ?>" target="_blank" title="Download Syllabus"><i class="fa fa-download text-success"></i></a></td>
                <td class="text-center"><?php if(!empty($SUBJ->InsertDate)){ echo $SUBJ->InsertDate; } ?></td>
              </tr>
              <!-- <tr id="collapseRecored<?php //echo $i; ?>" class="p-0 collapse">
                  <td class="align-middle"><span class="fas fa-pencil-alt"></td>
                  <td class="align-middle"><input type="text" class="form-control" id="subjectname<?php //if(!empty($i)){ echo $i; } ?>" value="<?php //if(!empty($SUBJ->Subject)){ echo $SUBJ->Subject; } ?>"> <div id="msg-<?php //if(!empty($i)){ echo $i; } ?>"></div></td>
                  <td class="text-right align-middle">
                    <div class="btn-group btn-group-sm" role="group">
                      <button class="btn btn-success fs13" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update" onclick="UpdateSubject('<?php //if(!empty($i)){ echo $i; } ?>','<?php //if(!empty($SUBJ->SubjectId)){ echo $SUBJ->SubjectId; } ?>')">UPDATE</button>
                    </div>
                  </td>
              </tr> -->
              <?php $i++; }} ?>           
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

    <?php include('include/footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <?php include('include/footer-scripts.php'); ?>
    <script>

    /************** Read and place url ************** */
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
          console.log(e);
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
    /*********** end of image url ************ */


      $(function() {
        $('.select2').select2()
        //Date picker
        $('#datepicker').datepicker({
        autoclose: true
        })

        $('[data-toggle="tooltip"]').tooltip();
        $("#dataTable1").DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false
      });
      });


      /**************** Insert Department Field Using Ajax *************/
function DeleteSyllabus(Id) {
        var form_data = new FormData();
        form_data.append("SyllabusId", Id);

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
                        url:"<?php echo base_url('Teacher/EnableSubject/Delete'); ?>",
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
  


      function EnableSubjects(){
            var SchoolClass = document.getElementById('ClassId').value;
            if(SchoolClass !=""){
            var form_data = new FormData();
                form_data.append("ClassId", SchoolClass);
                $.ajax({
                    url:"<?php echo base_url('Teacher/EnableSubject/Enable'); ?>",
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



      /****************** Registration jquery submit button ******************* */
    $('#cxm-syllabus-form').submit(function (e) { /******** Call A Function When Contact Form Submitted ********* */
        e.preventDefault(); /***********Prevent Page to not load *********** */
        var ClassId = $("#ClassId").val(); /*********** Get NameValue Value *********** */
        var SubjectId = $("#SubjectId").val(); /*********** Get NameValue Value *********** */
        if(ClassId == ""){ /******** if name is empty ********* */
          $("#cls-vald").empty(); /*******make name validation div empty ****** */
          $("#cls-vald").addClass("cxm-err animated fadeInDown"); /**********add class to name validation div*********** */
          $("#cls-vald").append("Class Required"); /*********Add Text to name validation********* */
        }else if(SubjectId == ""){
            $("#sub-vald").empty(); /*******make name validation div empty ****** */
          $("#sub-vald").addClass("cxm-err animated fadeInDown"); /**********add class to name validation div*********** */
          $("#sub-vald").append("Subject Required"); /*********Add Text to name validation********* */
        }else{
          var form_data = new FormData(); /*********** Initialize form data ************ */
              form_data.append("ClassId", ClassId); /********Add NameValue to form ******* */
              form_data.append("SubjectId", SubjectId);  /*******add Email to form******* */
              form_data.append("Syllabus", document.getElementById('imageUpload').files[0]);  /*******add Email to form******* */
              $.ajax({ /********start of an ajax ******** */
                url:"<?php echo base_url('Teacher/EnableSubject/Insert'); ?>", /*******url to send ******* */
                method:"POST", /********method post******** */
                dataType: 'JSON', /********data type json******* */
                data: form_data, /*********send form here ******** */
                contentType: false, /*******content type false******** */
                cache: false, /*********cache false ********* */
                processData: false, /******* Process data false******* */
                beforeSend: function() { /********before send function start******** */
                  $("#SpinnerBorder").addClass("spinner-border fc2"); /********add class to spinner border********* */
                  $("#SpinnerBorder").append("<span class='sr-only'>Loading...</span>"); /*******append span to div******* */
                },/********end of before send function********* */
                success:function(data) /*******start of success function******** */
                { /********start of success function********* */
                  if (data.status == true) { /********if status is true********* */
                    $("#SpinnerBorder").empty(); /*****empty spinner board******** */
                    $("#SpinnerBorder").removeClass("spinner-border fc2"); /*******remove class from border******** */
                    $("#SubmitMessage").empty(); /*******empty the message****** */
                    $("#SubmitMessage").removeClass("alert alert-danger mb-4"); /********set class in message******* */
                    $("#SubmitMessage").addClass("alert alert-success mb-4"); /********set class in message******* */
                    $("#SubmitMessage").append(data.message); /*******add text to message******** */
                    
                    setTimeout(function(){
                        location.reload(true);
                      }, 3000);
                  
                  }else{ /*******else result is false******** */
                    $("#SpinnerBorder").empty(); /********spinnre border empty****** */
                    $("#SpinnerBorder").removeClass("spinner-border fc2"); /******remove spinner clas******* */
                    $("#SubmitMessage").empty(); /*******empty message div******* */
                    $("#SubmitMessage").removeClass("alert alert-success mb-4"); /*******add class to alert messages******** */
                    $("#SubmitMessage").addClass("alert alert-danger mb-4"); /*******add class to alert messages******** */
                    $("#SubmitMessage").append(data.message); /********add text in alert message******** */
                  } /********enf of result check status******** */
                } /*******end of success function******* */
              });/*******end of ajax ******* */
        }
    }); /*********end of submit form********* */

    </script>
    </body>
</html>
