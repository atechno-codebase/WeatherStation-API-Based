<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?></strong> All rights
    reserved.
  </footer>

  
  
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="assets/admin/bower_components/datatables.net/js/jquery.dataTables.js"></script>
<script src="assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.js"></script>
<!-- FastClick -->
<script src="assets/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/admin/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="assets/admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="assets/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<!-- <script src="assets/admin/bower_components/chart.js/Chart.js"></script> -->
<!-- ChartJS -->
<script src="assets/admin/plugins/chartjs/Chart.min.js"></script>
<!-- Select2 -->
<script src="assets/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="assets/admin/plugins/input-mask/jquery.inputmask.js"></script>
<script src="assets/admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="assets/admin/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="assets/admin/bower_components/moment/min/moment.min.js"></script>
<script src="assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="assets/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="assets/admin/plugins/iCheck/icheck.min.js"></script>
<!-- Jquery Form Validator http://www.formvalidator.net -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>


	<script>
  $(function () {
	 
    $('#example3').DataTable( {
		
		"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                'Rs. '+total
            );
        }
		
    } );
  
  })

</script>
<script>
  $(function () {
	$("#example3").dataTable().fnDestroy()
    $('#example3').DataTable( {
		
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ],
		'paging'      : true,
			'lengthChange': true,
			'searching'   : true,
			'ordering'    : true,
			'info'        : false,
			'autoWidth'   : false,
			"pageLength": 25
    } );
  
  })

</script>

<link rel="stylesheet" href="assets/admin/manual/css/buttons.dataTables.min.css">
<script src="assets/admin/manual/js/dataTables.buttons.min.js"></script>
<script src="assets/admin/manual/js/jszip.min.js"></script>
<script src="assets/admin/manual/js/pdfmake.min.js"></script>
<script src="assets/admin/manual/js/vfs_fonts.js"></script>
<script src="assets/admin/manual/js/buttons.html5.min.js"></script>
	

</body>
</html>