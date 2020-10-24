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
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Create"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Create";}?>
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee Vouchers"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Fee Vouchers";}?></small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#createvoucher" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Create Single Voucher"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Create Single Voucher";}?></a></li>
              <li><a href="#massvoucher" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Create Mass Voucher"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Create Mass Voucher";}?></a></li>
            </ul>
            <div class="tab-content">
 
              <div class="active tab-pane" id="createvoucher">
              <form class="form-horizontal" style="margin-top:4%;">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="ClassId" onchange="GetStudents()" style="width:100%;">
                        <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Class";}?></option>
                        <?php if(!empty($ClassList)){ foreach($ClassList as $CLSL){ ?> 
                            <option value="<?php echo $CLSL->ClassId; ?>"><?php echo $CLSL->ClassName; ?></option>
                        <?php } }?>
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Section"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Section";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="SectionId" onchange="GetStudents()" style="width:100%;">
                        <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Section"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Section";}?></option>
                        <?php if(!empty($SectionList)){ foreach($SectionList as $SECLIS){ ?> 
                            <option value="<?php echo $SECLIS->SectionId; ?>"><?php echo $SECLIS->SectionName; ?></option>
                        <?php } }?>
                      </select>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Student"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Student";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="StudentId" style="width:100%;" onchange="GetStudentFee()">
                        
                      </select>
                    </div>
                  </div>
                          <input type="hidden" id="DueAmount" value="<?php if(!empty($CompanyList)){ echo $CompanyList->AfterDateDue; }else{ echo 0; } ?>">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Fee";}?></label>

                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="Fee" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Total Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Total Fee";}?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Out Standings"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Out Standings";}?></label>

                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="OutStanding" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "OutStanding Amount"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "OutStanding Amount";}?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Month"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Month";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="Month" style="width:100%;" onchange="setDescription(1)">
                        <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Month"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Month";}?></option>
                            <option value="January"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "January"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "January";}?></option>
                            <option value="February"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "February"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "February";}?></option>
                            <option value="March"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "March"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "March";}?></option>
                            <option value="April"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "April"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "April";}?></option>
                            <option value="May"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "May"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "May";}?></option>
                            <option value="June"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "June"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "June";}?></option>
                            <option value="July"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "July"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "July";}?></option>
                            <option value="August"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "August"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "August";}?></option>
                            <option value="September"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "September"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "September";}?></option>
                            <option value="October"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "October"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "October";}?></option>
                            <option value="November"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "November"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "November";}?></option>
                            <option value="December"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "December"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "December";}?></option>
                            <option value="Annual"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Annual"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Annual";}?></option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Year"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Year";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="Year" style="width:100%;">
                            <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Year"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Year";}?></option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Description"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Description";}?></label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="Description" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Description"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Description";}?>">
                    </div>
                  </div>



                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date";}?></label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="datepicker" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Creation Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Creation Date";}?>">
                    </div>
                  </div>

                  

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Due Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Due Date";}?></label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="datepicker2" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Due Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Due Date";}?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Amount After Due Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Amount After Due Date";}?></label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="AfterDueDate" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Amount After Due Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Amount After Due Date";}?>">
                    </div>
                  </div>


                    <div class="text-center" style="margin-top:3%;margin-bottom:2%"> <h4>PAYMENT INFORMATION</h4></div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Status";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="Status" style="width:100%;" onchange="statuschange(1)">
                            <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Status";}?></option>
                            <option value="1">Paid</option>
                            <option value="0">UnPaid</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group" id="PaidDate1" style='display:none'>
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Paid Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Paid Date";}?></label>

                    <div class="col-sm-4">
                      <input type="text" id="datepicker5" class="form-control" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Paid Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Paid Date";}?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Method"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Method";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="Method" style="width:100%;">
                            <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Method"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Method";}?></option>
                            <option value="Cash">Cash</option>
                            <option value="Bank">Bank</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-10">
                      <button type="button" class="btn btn-danger" onclick="InsertFee()"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Create"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Create";}?></button>
                    </div>
                  </div>
                </form>
                
              </div>
              <div class="tab-pane" id="massvoucher">
              <div class="row">
              <div class="col-md-8">
              <form class="form-horizontal" style="margin-top:4%;">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="ClassId2" style="width:100%;" onchange="GetStudentsList()">
                        <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Class";}?></option>
                        <?php if(!empty($ClassList)){ foreach($ClassList as $CLSL){ ?> 
                            <option value="<?php echo $CLSL->ClassId; ?>"><?php echo $CLSL->ClassName; ?></option>
                        <?php } }?>
                      </select>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Section"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Section";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="SectionId2" onchange="GetStudentsList()" style="width:100%;">
                        <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Section"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Section";}?></option>
                        <?php if(!empty($SectionList)){ foreach($SectionList as $SECLIS){ ?> 
                            <option value="<?php echo $SECLIS->SectionId; ?>"><?php echo $SECLIS->SectionName; ?></option>
                        <?php } }?>
                      </select>
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Fee";}?></label>

                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="Fee2" placeholder="<?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Fee";}?>" onkeyup="afterduedate('<?php //if(!empty($CompanyList->AfterDateDue)){ echo $CompanyList->AfterDateDue; }else{ echo 0; } ?>','2')">
                    </div>
                  </div> -->


                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Month"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Month";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="Month2" style="width:100%;" onchange="setDescription(2)">
                        <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Month"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Month";}?></option>
                            <option value="January"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "January"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "January";}?></option>
                            <option value="February"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "February"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "February";}?></option>
                            <option value="March"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "March"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "March";}?></option>
                            <option value="April"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "April"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "April";}?></option>
                            <option value="May"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "May"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "May";}?></option>
                            <option value="June"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "June"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "June";}?></option>
                            <option value="July"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "July"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "July";}?></option>
                            <option value="August"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "August"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "August";}?></option>
                            <option value="September"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "September"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "September";}?></option>
                            <option value="October"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "October"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "October";}?></option>
                            <option value="November"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "November"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "November";}?></option>
                            <option value="December"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "December"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "December";}?></option>
                            <option value="Annual"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Annual"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Annual";}?></option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Year"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Year";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="Year2" style="width:100%;">
                            <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Year"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Year";}?></option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Description"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Description";}?></label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="Description2" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Description"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Description";}?>">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date";}?></label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="datepicker3" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Creation Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Creation Date";}?>">
                    </div>
                  </div>

                  

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Due Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Due Date";}?></label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="datepicker4" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Due Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Due Date";}?>">
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Amount After Due Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Amount After Due Date";}?></label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="AfterDueDate2" placeholder="<?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Amount After Due Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Amount After Due Date";}?>" >
                    </div>
                  </div> -->


                    <div class="text-center" style="margin-top:3%;margin-bottom:2%"> <h4>PAYMENT INFORMATION</h4></div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Status";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="Status2" style="width:100%;" onchange="statuschange(2)">
                            <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Status"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Status";}?></option>
                            <option value="1">Paid</option>
                            <option value="0">UnPaid</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group" id="PaidDate2" style='display:none'>
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Paid Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Paid Date";}?></label>

                    <div class="col-sm-4">
                      <input type="text" id="datepicker6" class="form-control" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Paid Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Paid Date";}?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Method"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Method";}?></label>

                    <div class="col-sm-4">
                      <select class="form-control select2" id="Method2" style="width:100%;">
                            <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Method"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Method";}?></option>
                            <option value="Cash">Cash</option>
                            <option value="Bank">Bank</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-10">
                      <button type="button" class="btn btn-danger" onclick="InsertFee2()"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Create"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Create";}?></button>
                    </div>
                  </div>
                </form>
                </div>
                <div class="col-md-4" id= "StudentListCheck">
                                      
                  </div>
                  </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
<!-- ./wrapper -->
<!-- Page script -->
</div>

<?php include(APPPATH.'views/admin/footer.php'); ?>
<!-- Page specific script for calndar-->


<script type="text/javascript">
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

</script>
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
    })

    //Date picker
    $('#datepicker2').datepicker({
      autoclose: true,
    })

    //Date picker
    $('#datepicker3').datepicker({
      autoclose: true,
    })

    //Date picker
    $('#datepicker4').datepicker({
      autoclose: true,
    })

    //Date picker
    $('#datepicker5').datepicker({
      autoclose: true,
    })

    //Date picker
    $('#datepicker6').datepicker({
      autoclose: true,
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
<script type="text/javascript">

function statuschange(val){
  if(val == '1'){

    var status = document.getElementById('Status').value;
    if(status == '1'){
      $("#PaidDate1").css('display','block'); 
    }else if(status == '0'){
      $("#PaidDate1").css('display','none');
    }

  }else if(val == '2'){

    var status = document.getElementById('Status2').value;
    if(status == '1'){
      $("#PaidDate2").css('display','block'); 
    }else if(status == '0'){
      $("#PaidDate2").css('display','none');
    }

  }
}

// function afterduedate(dueamount,val){
//     if(val=='1'){
//         var deutotal = eval(document.getElementById('Fee').value) + eval(dueamount);  
//             document.getElementById('AfterDueDate').value = deutotal;  
//     }else if(val == '2'){
//         var deutotal = eval(document.getElementById('Fee2').value) + eval(dueamount);  
//             document.getElementById('AfterDueDate2').value = deutotal;
//     }
// }

function setDescription(val){
    if(val=='1'){

        document.getElementById('Description').value="Tuition Fee for month of "+document.getElementById('Month').value;
    }else if(val == '2'){
        document.getElementById('Description2').value="Tuition Fee for month of "+document.getElementById('Month2').value;;
    }
}

function GetStudents(){
    var ClassId = document.getElementById('ClassId').value;
    var SectionId = document.getElementById('SectionId').value;
    if(ClassId !="" && SectionId !=""){
      var form_data = new FormData();
          form_data.append("ClassId", ClassId);
          form_data.append("SectionId", SectionId);
          $.ajax({
              url:"<?php echo base_url('Admin/AddPayment/GetStudent'); ?>",
              method:"POST",
              dataType: 'JSON',
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              success:function(Studentfield)
              {
                $('#StudentId').empty();
                $('#StudentListCheck').empty();
                if (Studentfield.status == true) {
                  const EditRow = []; 
                  for(var inv = 0; inv < Studentfield.data.length; inv++){
                    EditRow.push("<option value='"+Studentfield.data[inv]['StudentId']+"'>"+Studentfield.data[inv]['StudentName']+" ("+Studentfield.data[inv]['StudentGR']+") </option>");

                  }
                  document.getElementById('StudentId').innerHTML +="<option value=''>Select Student</option>"+EditRow;
                  document.getElementById('StudentId').disabled = false;

                  
                }else{
                  Snackbar.show({pos: 'top-right',text:Studentfield.message});
                  document.getElementById('StudentId').disabled = true;
                }
              }
          });
    }else{
    //   document.getElementById('Subject').disabled = true;
    }
  }


  function GetStudentsList(){
    var ClassId = document.getElementById('ClassId2').value;
    var SectionId = document.getElementById('SectionId2').value;
    if(ClassId !="" && SectionId !=""){
      var form_data = new FormData();
          form_data.append("ClassId", ClassId);
          form_data.append("SectionId", SectionId);
          $.ajax({
              url:"<?php echo base_url('Admin/AddPayment/GetStudent'); ?>",
              method:"POST",
              dataType: 'JSON',
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              success:function(Studentfield)
              {
                $('#StudentListCheck').empty();
                document.getElementById('StudentListCheck').innerHTML += "<div class='icheck-warning my-2 fc2'>"+
                    "<input type='checkbox' id='cxmAll' class='cxmCbx' checked>"+
                    "<label for='cxmAll'>  Select All</label>"+
                  "</div>";
                
                if (Studentfield.status == true) {
                  // const EditRow = []; 
                  for(var inv = 0; inv < Studentfield.data.length; inv++){

                    document.getElementById('StudentListCheck').innerHTML += "<div class='icheck-warning my-2 fc2' style='margin-top:3%;'>"+
                        "<input type='checkbox' id='axus-"+Studentfield.data[inv]['StudentId']+"' value='"+Studentfield.data[inv]['StudentId']+"' class='cxmCbx mainClass' checked>"+
                        " <label for='axus-"+Studentfield.data[inv]['StudentName']+"'> "+" "+Studentfield.data[inv]['StudentName']+" ("+ Studentfield.data[inv]['StudentGR']+")</label>"+
                      "</div>";

                  }

                  $("#cxmAll").change(function(){
                      $(".cxmCbx").prop('checked', $(this).prop("checked"));
                    });

                    $('.cxmCbx').change(function(){
                      if(false == $(this).prop("checked")){
                        $("#cxmAll").prop('checked', false);
                      }          
                      if ($('.cxmCbx:checked').length == $('.cxmCbx').length){
                        $("#cxmAll").prop('checked', true);
                      }
                    });

                  
                }else{
                  Snackbar.show({pos: 'top-right',text:Studentfield.message});
                }
              }
          });
    }else{
    //   document.getElementById('Subject').disabled = true;
    }
  }

  function GetStudentFee(){
    var StudentId = document.getElementById('StudentId').value;
    if(StudentId !=""){
      var form_data = new FormData();
          form_data.append("StudentId", StudentId);
          $.ajax({
              url:"<?php echo base_url('Admin/AddPayment/GetStudentFee'); ?>",
              method:"POST",
              dataType: 'JSON',
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              success:function(Studentfield)
              {
                if (Studentfield.status == true) {
                  document.getElementById('Fee').value=Studentfield.data['Fee'];
                  document.getElementById('AfterDueDate').value = eval(document.getElementById('DueAmount').value) + eval(Studentfield.data['Fee']);
                  document.getElementById('OutStanding').value=Studentfield.Dues;

                }else{
                  Snackbar.show({pos: 'top-right',text:Studentfield.message});
                  document.getElementById('StudentId').disabled = true;
                }
              }
          });
    }else{
    //   document.getElementById('Subject').disabled = true;
    }
  }
  

/**************** Insert fee Field Using Ajax *************/
  function InsertFee() {
        var ClassId = document.getElementById('ClassId').value;
        var SectionId = document.getElementById('SectionId').value;
        var StudentId = document.getElementById('StudentId').value;
        var Fee = document.getElementById('Fee').value;
        var OutStanding = document.getElementById('OutStanding').value;
        var Month = document.getElementById('Month').value;
        var Year = document.getElementById('Year').value;
        var Status = document.getElementById('Status').value;
        var Method = document.getElementById('Method').value;
        var AfterDueDate = document.getElementById('AfterDueDate').value;
        var Description = document.getElementById('Description').value;
        var CreationDate = document.getElementById('datepicker').value;
        var DueDate = document.getElementById('datepicker2').value;
        var PaidDate = document.getElementById('datepicker5').value;
      if(ClassId =="" && SectionId =="" && StudentId =="" && Fee =="" && Month =="" && Year =="" && CreationDate =="" && DueDate =="" && Status =="" && Method =="" && AfterDueDate ==""){
        Snackbar.show({pos: 'top-right',text:"All fields are required"});
      }else{
        var form_data = new FormData();
        form_data.append("ClassId", document.getElementById('ClassId').value);
        form_data.append("SectionId", document.getElementById('SectionId').value);
        form_data.append("StudentId", document.getElementById('StudentId').value);
        form_data.append("Fee", document.getElementById('Fee').value);
        form_data.append("OutStanding", document.getElementById('OutStanding').value);
        form_data.append("Month", document.getElementById('Month').value);
        form_data.append("Year", document.getElementById('Year').value);
        form_data.append("Status", document.getElementById('Status').value);
        form_data.append("Method", document.getElementById('Method').value);
        form_data.append("AfterDueDate", document.getElementById('AfterDueDate').value);
        form_data.append("Description", document.getElementById('Description').value);
        form_data.append("CreationDate", document.getElementById('datepicker').value);
        form_data.append("DueDate", document.getElementById('datepicker2').value);
        form_data.append("PaidDate", document.getElementById('datepicker5').value);
            $.ajax({
            url:"<?php echo base_url('Admin/AddPayment/Insert'); ?>",
            method:"POST",
            dataType: 'JSON',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success:function(addevent)
            {
                if (addevent.status == true) {
                Snackbar.show({pos: 'top-right',text:addevent.message});
                setTimeout(function(){
                            location.reload(true);
                }, 3000);
                }else{
                Snackbar.show({pos: 'top-right',text:addevent.message});
                }
            }
            });
      }
      

  } 



  /**************** Insert fee Field Using Ajax *************/
  function InsertFee2() {
        var ClassId = document.getElementById('ClassId2').value;
        var SectionId = document.getElementById('SectionId2').value;
        var checkboxes = $('.mainClass:checked').map(function() {return this.value;}).get().join(',');
        var Month = document.getElementById('Month2').value;
        var Year = document.getElementById('Year2').value;
        var Status = document.getElementById('Status2').value;
        var Method = document.getElementById('Method2').value;
        var Description = document.getElementById('Description2').value;
        var CreationDate = document.getElementById('datepicker3').value;
        var DueDate = document.getElementById('datepicker4').value;
        var PaidDate = document.getElementById('datepicker6').value;
      if(ClassId =="" && SectionId =="" && Month =="" && Year =="" && CreationDate =="" && DueDate =="" && Status =="" && Method =="" && Description =="" && checkboxes ==""){
        Snackbar.show({pos: 'top-right',text:"All fields are required"});
      }else{
        var form_data = new FormData();
        form_data.append("ClassId", document.getElementById('ClassId2').value);
        form_data.append("SectionId", document.getElementById('SectionId2').value);
        form_data.append("Month", document.getElementById('Month2').value);
        form_data.append("Year", document.getElementById('Year2').value);
        form_data.append("Students", checkboxes);
        form_data.append("Status", document.getElementById('Status2').value);
        form_data.append("Method", document.getElementById('Method2').value);
        form_data.append("Description", document.getElementById('Description2').value);
        form_data.append("CreationDate", document.getElementById('datepicker3').value);
        form_data.append("DueDate", document.getElementById('datepicker4').value);
        form_data.append("PaidDate", document.getElementById('datepicker6').value);
            $.ajax({
            url:"<?php echo base_url('Admin/AddPayment/InsertMass'); ?>",
            method:"POST",
            dataType: 'JSON',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success:function(addevent)
            {
                if (addevent.status == true) {
                Snackbar.show({pos: 'top-right',text:addevent.message});
                setTimeout(function(){
                            location.reload(true);
                }, 3000);
                }else{
                Snackbar.show({pos: 'top-right',text:addevent.message});
                }
            }
            });
      }
      

  } 

  /**************** Insert Langauge Field Using Ajax *************/
  function addlanguage() {

    var form_data = new FormData();
    form_data.append("English", document.getElementById('English').value);
    form_data.append("Urdu", document.getElementById('Urdu').value);
    $.ajax({
    url:"<?php echo base_url('Admin/SoftwareSetting/language'); ?>",
    method:"POST",
    dataType: 'JSON',
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    success:function(addlangauge)
    {
        if (addlangauge.status == true) {
        Snackbar.show({pos: 'top-right',text:addlangauge.message});
        document.getElementById("LanguageForm").reset();
        }else{
        Snackbar.show({pos: 'top-right',text:addlangauge.message});
        }
    }
    });

} 


 /**************** Insert Staff Field Using Ajax *************/
 function UpdateCompany() {
                
              var form_data = new FormData();
              form_data.append("CompanyName", document.getElementById('CompanyName').value);
              form_data.append("CompanyShortName", document.getElementById('CompanyShortName').value);
              form_data.append("CompanySlogan", document.getElementById('CompanySlogan').value);
              form_data.append("CompanyAddress", document.getElementById('CompanyAddress').value);
              form_data.append("CompanyPhone", document.getElementById('CompanyPhone').value);
              form_data.append("CompanyEmail", document.getElementById('CompanyEmail').value);
              form_data.append("CompanyLogo", document.getElementById('imgInp').files[0]);
              $.ajax({
                url:"<?php echo base_url('Admin/SoftwareSetting/Edit'); ?>",
                method:"POST",
                dataType: 'JSON',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(updateCompany)
                {
                  if (updateCompany.status == true) {
                    Snackbar.show({pos: 'top-right',text:updateCompany.message});
                    setTimeout(function(){
                        location.reload(true);
                  }, 3000);
                  }else{
                    Snackbar.show({pos: 'top-right',text:updateCompany.message});
                  }
                }
              });
            } 
</script>

</body>
</html>
