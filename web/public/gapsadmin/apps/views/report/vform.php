
<div class="row">
  <div id="breadcrumb" class="col-md-12">
    <ol class="breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#"><?=$page_title?></a></li>
    </ol>
  </div>
</div>  
<div class="row">
  <div class="col-xs-12 col-sm-10">
      <div class="box-header">
        <div class="box-name">
          <i class="fa fa-list"></i>
          <span><?=$page_title?></span>
        </div>
        <div class="box-icons">
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

        <form id="defaultForm" method="post" action="" class="form-horizontal">
          <fieldset>
            <legend>Generate Report</legend>
            <div class="form-group">
              <label class="control-label col-md-2">Start Date</label>
              <div class="col-md-4">
               <input type="text" id="date_start" class="form-control" name="date_start" placeholder="start Date">
              </div>
              <label class="control-label col-md-2">End Date</label>
              <div class="col-md-4">
               <input type="text" id="date_end" class="form-control" name="date_end" placeholder="End Date">
              </div>

            </div> 

          <div class="form-group">
            <label class="control-label col-md-2">Status </label>
            <div class="col-md-3">
              <select id="el2" name="status" class="select2-container select2able select2-container-active">
                <option value="" >Semua</option>
                <option value="1" >Sukses</option>
                <option value="0" >Pending</option>                
                <option value="2" >Gagal</option>                                
              </select>
            </div>
          </div>
        

          </fieldset>

            <div class="form-group">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary btn-label-left">
              <span><i class="fa fa-check"></i></span>
                Export
              </button>
            </div>
            </div>          
          </form>
      </div>
    </div>
  </div>

  <script src="<?php echo template_uri();?>plugins/select2/select2.min.js"></script>
  <script src="<?php echo template_uri();?>plugins/bootstrapvalidator/bootstrapValidator.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#el2").select2();
$('#date_start').datepicker({setDate: new Date(), dateFormat: 'yy-mm-dd',});    
$('#date_end').datepicker({setDate: new Date(), dateFormat: 'yy-mm-dd',});    
  });

  </script>  
  </body>
</html>