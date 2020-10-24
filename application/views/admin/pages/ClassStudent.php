<?php include(APPPATH.'views/admin/meta_tags.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php include(APPPATH.'views/admin/head.php'); ?>
</head>

<body>

  <!-- Navbar -->
  <?php include(APPPATH.'views/admin/header.php'); ?>
  <!-- /.navbar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Class List
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Class List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row" style="margin-top:4%;">
      <?php if(!empty($ClassList)){ foreach($ClassList as $CLALI){ ?>
      
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="<?php echo base_url('ClassStudentsList/'.$CLALI->ClassId) ?>">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php if(!empty($CLALI->ClassName)){ echo $CLALI->ClassName; }else{ echo "0";} ?></h3>
            
              <p><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></p>
            </div>
            <div class="icon">
              <i class="ion ion-paper"></i>
            </div>
          </div>
          </a>
        </div>
      
      <?php }} ?>
        

      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <?php include(APPPATH.'views/admin/footer.php'); ?>