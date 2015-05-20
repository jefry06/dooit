    <style type="text/css" media="print">
    @media print
    {
    	.main-menu { display: none; }
    	#tombol1{display: none;}
    	#tombol2{display: none;}

    	
    }
    </style>
<div class="row">
  <div id="breadcrumb" class="col-md-12">
    <ol class="breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#"><?=$page_title?></a></li>
    </ol>
  </div>
</div> 

<div class="row">
<!-- 	<div class="col-xs-12 text-center page-404">
		<?php print_r($DETAIL);?>
	</div> -->
<?php

$fields = array('order_id','order_code','delivery_tracking_no','user_id','order_total','order_date' ,'order_status','create_at','detail','delivery_id','delivery_nama','delivery_email','delivery_tlp','delivery_tipe','delivery_alamat','delivery_kodepos','delivery_rt','delivery_rw','delivery_by','delivery_ket','history');
foreach($fields as $field){
  $DETAIL->{$field} = isset($DETAIL->{$field}) ? $DETAIL->{$field} : '';
}
?>
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-table"></i>
					<span>Order ID : <b><?php echo $DETAIL->order_code;?></b></span>
				</div>
				<div class="box-icons">
					<a class="print-link" onclick="printpage();">
						<i class="fa fa-print"></i>
					</a>

					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">

<div class="container-fluid">
	<div class="row show-grid">
		<div class="col-xs-6 col-md-2">User ID :</div>
		<div class="col-xs-6 col-md-4"><?php echo $DETAIL->user_id;?></div>
		<div class="col-xs-6 col-md-2">Tanggal Transaksi :</div>
		<div class="col-xs-6 col-md-4"><?php echo $DETAIL->order_date;?></div>
		<div class="col-xs-6 col-md-2">Dikirim ke :</div>
		<div class="col-xs-6 col-md-4"><?php echo $DETAIL->delivery_nama;?></div>
		<div class="col-xs-6 col-md-2">Email :</div>
		<div class="col-xs-6 col-md-4"><?php echo $DETAIL->delivery_email;?></div>
		<div class="col-xs-6 col-md-2">Telepon :</div>
		<div class="col-xs-6 col-md-4"><?php echo $DETAIL->delivery_tlp;?></div>
		<div class="col-xs-6 col-md-2">Jasa Pengiriman :</div>
		<div class="col-xs-6 col-md-4"><?php echo $DETAIL->delivery_by;?></div>	
		<div class="col-xs-6 col-md-2">Keterangan :</div>
		<div class="col-xs-6 col-md-4"><?php echo $DETAIL->delivery_ket;?></div>	
		<div class="col-xs-6 col-md-2">Tracking No:</div>
		<div class="col-xs-6 col-md-4"><?php echo $DETAIL->delivery_tracking_no;?></div>				
		<div class="col-xs-6 col-md-2">Alamat Pengiriman :</div>
		<div class="col-xs-6 col-md-4"><?php echo $DETAIL->delivery_alamat.' RT '.$DETAIL->delivery_rt.' RW '.$DETAIL->delivery_rw.'. Kode Pos '.$DETAIL->delivery_kodepos;?></div>
	</div>
</div>
<legend>Detail Items</legend>

				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Item (ID) Name</th>
							<th>Price</th>
							<th>Description</th>
							<th>Unit</th>
							<th>Discount</th>
							<th>Subtotal</th>
						</tr>
					</thead>
					<tbody>
<?php $x=0;
$total=0;
foreach ($DETAIL->detail as $key ) 
{ $x++; ?>
<tr>
							<td><?php echo $x;?></td>
							<td><?php echo '('.$key['item_id'].') '. $key['item_name'];?></td>
							<td><?php echo $key['item_price'];?></td>
							<td><?php echo 'Size :'.$key['item_size'].'. color :'.$key['item_color'];?></td>
							<td><?php echo $key['item_qty'];?></td>
							<td><?php echo $key['item_disc'];?></td>
							<td><?php echo $key['item_subtotal'];?></td>														
</tr>	
<?php 
$total=$total+$key['item_subtotal'];
} ?>						<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><b>TOTAL</b></td>
							<td><b><?php echo $total;?></b></td>

					</tbody>
				</table>
<legend>History : </legend> 

				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>History Date</th>
							<th>Status</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
<?php 
$x=0;
foreach ($DETAIL->history as $key ) 
{ $x++; ?>
<tr>
							<td><?php echo $x;?></td>
							<td><?php echo $key['history_date'];?></td>
							<td><?php echo $key['history_status'];?></td>
							<td><?php echo $key['history_desc'];?></td>														
</tr>	
<?php } ?>

					</tbody>
				</table>

              <a id="tombol1" href="<?php echo site_url('tracking/index');?>" class="btn btn-default btn-label-left">
              <span><i class="fa fa-times txt-danger"></i></span>
                back
              </a>

            											
			</div>

		</div>
	</div>


</div>
<script type="text/javascript">
$(document).ready(function() {
	$('html').animate({scrollTop: 0},'slow');

});
</script>
<script>
function printpage() {
    window.print();
}
</script>

  <script type="text/javascript">
  
  /*
  # ===============================================================================
  # Delete Confirmation
  # ===============================================================================
  */
    function konfirmasi(id)
    {
       var c= confirm("Anda yakin ?");
       if(c==true)
       {          
          window.location.replace("../kirim/"+id);          
       }
       return false;
    };

  </script>  