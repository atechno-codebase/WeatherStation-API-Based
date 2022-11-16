<title>Product List </title>

<?php $this->load->view('common/header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>Product List 
			<span>
				<a href="<?php echo base_url('index.php/admin/product');?>" class="btn btn-info" style="float:; margin-left:3%">Add New Product</a>&nbsp;&nbsp;&nbsp;&nbsp;
			</span>
		</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <?php
            if(isset($_SESSION['error_message'])){
          ?>
            <div class="alert alert-danger" role="alert">
              <?php
                echo $_SESSION['error_message'];
                unset($_SESSION['error_message']);
              ?>
            </div>
          <?php   
            }
          ?>

          <?php
            if(isset($_SESSION['success_message'])){
          ?>
            <div class="alert alert-success" role="alert">
              <?php
                echo $_SESSION['success_message'];
                unset($_SESSION['success_message']);
              ?>
            </div>
          <?php   
            }
          ?>


          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive">
				<table id="example1" class="table table-bordered table-striped table-hover">
					<thead  style="background-color:#367fa9; color:#fff">
						<tr>
							<th>#</th> 
							<th>Title</th> 													 
							<th>Actual Price</th> 
							<th>Offer Price</th> 	
							<th>Rank</th> 
							<th>Photo</th> 
							<th>Edit</th>	
							<th>Delete</th>									
						</tr> 
					</thead>
					<tbody style="font-size:14px"> 
						<?php
							$i = 0;
							foreach($record as $value)
							{
								$i++;	
						?>
						<tr>
							<td scope="row"><?php echo $i;?></td> 
							<td><?php echo $value['title']?></td>
							<td><?php echo $value['actual_price']?></td>
							<td><?php echo $value['price']?></td>
							<td><?php echo $value['rank']?></td>
							<td><center><img src="<?php echo base_url();?>/uploads/<?php echo $value['file'];?>" class="img-responsive" style="width:100px; height:130px" alt=""/></center></td>	
							<td><a href="<?php echo base_url("index.php/admin/edit_product/$value[id]");?>" class="btn btn-sm btn-info" >Edit</a></td> 									
							<td><a href="<?php echo base_url("index.php/admin/delete_product/$value[id]");?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this product?');">Delete</a></td>							
						</tr> 
						<?php
							}
						?>								
					</tbody>                
				</table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

 
	<script>
		function isNumber(evt) 
		{
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}
	</script>
<?php $this->load->view('common/footer'); ?>
<script>
  $(function () {
    $('#example1').DataTable( {
		
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
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>