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
          <?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Result List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Result List";}?>
          <?php echo "Class ".$this->Admindb->SingleRowField(['ClassId'=>$ClassId,'IsActive'=>true,'IsDeleted'=>false],'class','ClassName')." List"; ?>
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
       
        <div class="box-body" id="classlisttable">
          <div class="row">

            <div class="box-body">
            <h3><?php echo " Class ".$this->Admindb->SingleRowField(['ClassId'=>$ClassId,'IsActive'=>true,'IsDeleted'=>false],'class','ClassName').""; ?></h3>
            <div class="row">
                <a href="<?php echo base_url('ClassStudentCSV/'.$ClassId); ?>" class="btn btn-primary" style="float:right; margin : 2%;" >Export</a>

              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{ echo "Image"; }?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{ echo "Student Name"; }?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Name";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "GR NO"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "GR NO";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Section"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Section";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Birth Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Birth Date";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Fee";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Religion"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Religion";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Options"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Options";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; if(!empty($StudentsList)){ foreach ($StudentsList as $STULIS) { ?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td>
                  <td class="text-center"><?php if($STULIS->StudentImage){?> <img class="img-responsive" src="<?php echo base_url('uploads/Students/'.$STULIS->StudentId.'/'.$STULIS->StudentImage);?>" height="70" width="70" /> <?php }else{ ?> <img class="img-responsive" src="<?php echo base_url('assets/dist/images/School.jpg');?>" height="70" width="70" /> <?php } ?></td>
                  <td class="text-center"><?php echo $STULIS->StudentName; ?></td>
                  <td class="text-center"><?php echo $STULIS->FatherName; ?></td>
                  <td class="text-center"><?php echo $STULIS->StudentGR; ?></td>
                  <td class="text-center"><?php if(!empty($STULIS->SectionId)){ echo $this->Admindb->SingleRowField(['SectionId'=>$STULIS->SectionId],'sections','SectionName');  } ?></td>
                  <td class="text-center"><?php echo $STULIS->FatherPhone; ?></td>
                  <td class="text-center"><?php echo $STULIS->BirthDate; ?></td>
                  <td class="text-center"><?php echo $STULIS->Fee; ?></td>
                  <td class="text-center"><?php echo $STULIS->Religion; ?></td>
                  <td class="text-center">
                    <button type="button" title="Print" class="btn btn-default" onclick = "ViewStudent('<?php echo $STULIS->StudentId; ?>')"><i class="fa fa-print text-success"></i></button>
                  </td>
                </tr>
                <?php $i++; } } ?>
                </tbody>
                <tfoot>
                <tr>
                <th class="text-center">#</th>
                  <th class=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{ echo "Image"; }?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{ echo "Student Name"; }?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Name";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "GR NO"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "GR NO";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Birth Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Birth Date";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Fee";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Religion"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Religion";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Options"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Options";}?></th>
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

     


     /**************Edit Insurance*********** */
function ViewStudent(Id) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#ViewStudent").empty();
                    var edit_data = new FormData();
                      edit_data.append("StudentId", Id);
                      $.ajax({
                        url:"<?php echo base_url('Admin/StudentsList/View'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: edit_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(editdetails)
                        {
                          if (editdetails.status == true) {
                            /**************
                             * find age
                             */
                            var d = new Date();
                            year = d.getFullYear();
                            var birthDate = editdetails.data['BirthDate'].substring(0, 4);;
                            age = eval(year) - eval(birthDate);
                            /*******************
                             * end of age finder
                             */
                            var Image = "<?php echo base_url('assets/dist/images/School.jpg'); ?>";
                            if(editdetails.data['StudentImage'] != ""){ StudentImage = "<?php echo base_url('uploads/Students/'); ?>"+editdetails.data['StudentId']+'/'+editdetails.data['StudentImage']; }else{ StudentImage = "<?php echo base_url('assets/dist/images/School.jpg'); ?>" }
                            // if(editdetails.data['StudentImage']){ var Condition = editdetails.data['StudentImage']; }else{ var Condition = Image; }
                            document.getElementById("ViewStudent").innerHTML+= "<div class='modal-dialog' style='width:95%;'>"+
                  "<div class='modal-content'>"+
                    "<div class='modal-header'>"+
                      "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
                        "<span aria-hidden='true'>&times;</span></button>"+
                      "<h4 class='modal-title'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "View Student"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "View Student";}?></h4>"+
                    "</div>"+
                      "<div class='container mt-3' style='width:88%;'>"+
                      "<div class='row align-items-center pb-3'>"+
                      " <div class='col-md-3 mb-3'>"+
                      "   <img width='150' src='<?php if(!empty($CompanyList->CompanyLogo)){ echo base_url('assets/dist/images/'.$CompanyList->CompanyLogo); }else{ echo base_url('assets/dist/images/School.jpg'); }  ?>' alt='RZB School' class='img-fluid'>"+
                      " </div>"+
                      " <div class='col-md-6'>"+
                      "   <div class='row align-items-end'>"+
                      "     <div class='col border-bottom'>"+
                      "       <h1 class='text-center fw700'><?php if(!empty($CompanyList->CompanyName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyName;} }else{ echo "RZB SMS"; } ?></h1>"+
                      "     </div>"+
                      "   </div>"+
                         
                      "  </div>"+
                      " <div class='col-md-3' style='margin-top:2%;'>"+
                      "   <p>Doc. No: ACA W100<br> Issue No: 01<br>GR No # : "+editdetails.data['StudentGR']+"</p>"+
                      " </div>"+
                      "</div>"+

                      "<div class='row' style='margin-top:2%;'>"+
                      " <div class='col-12'>"+
                      "   <h4 class='text-center fw700'>Admission Form</h4>"+
                      " </div>        "+
                      "</div>"+

                      "<div class='row'>"+
                      " <div class='col-12'>"+
                      "   <h5 class='fw700'>Applicant Information</h5>"+
                      " </div>      "+  
                      "</div>"+
                      "<table class='table table-bordered table-sm mb-5'>"+
                      " <tr>"+
                      "   <td class='bg-light' colspan='3'>Student Name</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='py-3'>"+editdetails.data['StudentName']+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light'>DOB (Day, Month, Year)</td>"+
                      "   <td class='bg-light'>Age at Entry</td>"+
                      "   <td class='bg-light'>Gender</td>   "+ 
                      " </tr>"+
                      " <tr>"+
                      "   <td class='py-3'>"+editdetails.data['BirthDate']+"</td>"+
                      "   <td class='py-3'>"+age+"</td>"+
                      "   <td class='py-3'>"+editdetails.data['Gender']+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light' colspan='2'>Appling for Grade</td>"+
                      "   <td class='bg-light'>Academic Session</td>   "+ 
                      " </tr>"+
                      " <tr>"+
                      " <td class='py-3' colspan='2'>"+editdetails.data['ClassName']+"</td>"+
                      "   <td class='py-3'>"+year+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light' colspan='2'>Religion</td>"+
                      "   <td class='bg-light' colspan='2'>Nationality</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='py-3' colspan='2'>"+editdetails.data['Religion']+"</td>"+
                      "   <td class='py-3' colspan='2'>"+editdetails.data['Nationality']+"</td>"+
                      " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light' colspan='3'>Name and address of Current School</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='py-3' colspan='3'>&nbsp</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light' colspan='3'>Has your child ever been suspended or expeded from school? If so, explain below:</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='py-3' colspan='3'>&nbsp</td>"+
                      // " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light' colspan='3'>Does your child have any medical or psychological conditions? Please provide details / relevant documentation.</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='py-3' colspan='3'>"+editdetails.data['childMedical']+"</td>"+
                      " </tr>"+
                        
                      "</table>"+
                      
                      "<div class='row'>"+
                      " <div class='col-12'>"+
                      "   <h5 class='fw700'>Family Information</h5>"+
                      " </div>      "+ 
                      "</div>"+
                      "<table class='table table-bordered table-sm mb-3'>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle' style='width:33%;'>&nbsp</td>"+
                      "   <td class='bg-light align-middle' style='width:33%;'>Father/Guardian</td> "+
                      "   <td class='bg-light align-middle' style='width:33%;'>Mother/Guardian</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle'>MR / Mrs / Ms / Dr</td>"+
                      "   <td>"+editdetails.data['FatherName']+"</td>"+
                      "   <td>"+editdetails.data['MotherName']+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle'>CNIC #</td>"+
                      "   <td>"+editdetails.data['FatherCNIC']+"</td>"+
                      "   <td>"+editdetails.data['MotherCNIC']+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle'>Home Address</td>"+
                      "   <td class='py-3' colspan='2'>"+editdetails.data['Address']+"</td>"+
                      " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle'>Home Phone</td>"+
                      "   <td>"+editdetails.data['FatherPhone']+"</td>"+
                      "   <td>"+editdetails.data['MotherPhone']+"</td>"+
                      " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light align-middle'>Cell Phone</td>"+
                      // "   <td>&nbsp</td>"+
                      // "   <td>&nbsp</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light align-middle'>Email</td>"+
                      // "   <td>&nbsp</td>"+
                      // "   <td>&nbsp</td>"+
                      // " </tr>"+
                      " <tr>"+
                      "   <td class='bg-light align-middle'>Occupation</td>"+
                      "   <td>"+editdetails.data['FatherOccupation']+"</td>"+
                      "   <td>"+editdetails.data['MotherOccupation']+"</td>"+
                      " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light align-middle'>Enployer/Self Employed</td>"+
                      // "   <td>&nbsp</td>"+
                      // "   <td>&nbsp</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light align-middle'>Employer's Address</td>"+
                      // "   <td>&nbsp</td>"+
                      // "   <td>&nbsp</td>"+
                      // " </tr>"+
                      // " <tr>"+
                      // "   <td class='bg-light align-middle'>Business Phone</td>"+
                      // "   <td>&nbsp</td>"+
                      // "   <td>&nbsp</td>"+
                      // " </tr>"+
                      "</table>"+

                      "<p class='text-center px-5'>This is CONTROLLED & CONFIDENTAIL document of 'The Smart Schools'. Its unauthorized disclosure or production shall be ilable to prosecution under the Copyright Act and any other law.</p>"+


                      "</div>"+

                    "<div class='modal-footer'>"+
                      "<button type='button' class='btn btn-default pull-left' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>"+
                      "<Button class='btn btn-default' onclick='javascript:printDiv()' style='margin-top:5px;'><i class='fa fa-print'></i> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Print"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Print";}?></Button>"+
                    "</div>"+
                  "</div>"+
                "</div>";
                            
                            $("#ViewStudent").modal('show');

                          }else{
                            Snackbar.show({pos: 'top-right',text:editdetails.message});
                          }
                        }
                      });
                  }

                  function printDiv() {
                    //Get the HTML of div
                    var divElements = document.getElementById('ViewStudent').innerHTML;
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

                function PrintList() {
      //Get the HTML of div
      var divElements = document.getElementById('classlisttable').innerHTML;
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
