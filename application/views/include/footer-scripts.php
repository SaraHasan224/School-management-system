<!-- jQuery -->
<script src="<?php echo base_url('adminassets/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('adminassets/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('adminassets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('adminassets/plugins/datatables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('adminassets/plugins/datatables-bs4/js/dataTables.bootstrap4.js'); ?>"></script>    

<!-- Select2 -->
<script src="<?php echo base_url('AdminLTE/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>

<!-- SweetAlert -->
<script src="<?php echo base_url('assets/node_modules/sweetalert/dist/sweetalert.min.js'); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('adminassets/plugins/chart.js/Chart.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('adminassets/plugins/sparklines/sparkline.js'); ?>"></script>
<?php if($curl === 'admin'){ ?>
<!-- JQVMap -->
<script src="<?php echo base_url('adminassets/plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
<script src="<?php echo base_url('adminassets/plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script>
<?php } ?>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('adminassets/plugins/jquery-knob/jquery.knob.min.js'); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('adminassets/plugins/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('adminassets/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('adminassets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('adminassets/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('adminassets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('adminassets/js/adminlte.js'); ?>"></script>
<?php if($curl === 'teacher'){ ?>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('adminassets/js/pages/dashboard.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('adminassets/js/demo.js'); ?>"></script>
<?php } ?>