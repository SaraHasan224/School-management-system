<!DOCTYPE html>
<html lang="en">
  <?php include('include/head.php'); ?>
  </head>

  <body>
    <?php include('include/header.php'); ?>

    <div class="cxm-landing-pg bgc2 bgp-1 py-5">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="text-center mb-5">
              <img src="<?php echo base_url('assets/front/media/logo.png'); ?>" width="25%" alt="RZB School" class="img-fluid wow zoomIn" data-wow-duration="1s" data-wow-delay="0.2s">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6 div col-sm-3 mb-5">
            <div class="cxm-card-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
              <div class="cxm-card-img text-center mb-2">
                <img src="<?php echo base_url('assets/front/media/cxm-admin-portal.png'); ?>" alt="Admin Portal" class="img-fluid">
              </div>
              <div class="text-center"><a href="<?php echo base_url('AdminLogin'); ?>" class="cxm-card-link stretched-link">Admin Portal</a></div>
            </div>
          </div>
          <div class="col-6 div col-sm-3 mb-5">
            <div class="cxm-card-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
              <div class="cxm-card-img text-center mb-2">
                <img src="<?php echo base_url('assets/front/media/cxm-teacher-portal.png'); ?>" alt="Teacher Portal" class="img-fluid">
              </div>
              <div class="text-center"><a href="<?php echo base_url('TeacherLogin'); ?>" class="cxm-card-link stretched-link">Teacher Portal</a></div>
            </div>
          </div>
          <div class="col-6 div col-sm-3 mb-5">
            <div class="cxm-card-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.7s">
              <div class="cxm-card-img text-center mb-2">
                <img src="<?php echo base_url('assets/front/media/cxm-student-portal.png'); ?>" alt="Student Portal" class="img-fluid">
              </div>
              <div class="text-center"><a href="<?php echo base_url('StudentLogin'); ?>" class="cxm-card-link stretched-link">Student Portal</a></div>
            </div>
          </div>
          <div class="col-6 div col-sm-3 mb-5">
            <div class="cxm-card-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.9s">
              <div class="cxm-card-img text-center mb-2">
                <img src="<?php echo base_url('assets/front/media/cxm-parent-portal.png'); ?>" alt="Parent Portal" class="img-fluid">
              </div>
              <div class="text-center"><a href="<?php echo base_url('ParentLogin'); ?>" class="cxm-card-link stretched-link">Parent Portal</a></div>
            </div>
          </div>
        </div>
        
      </div> 
    </div>

    <?php include('include/footer.php'); ?>
    <?php include('include/footer-scripts.php'); ?>  
    <script>
      $(function(){});
    </script>  
  </body>
</html>