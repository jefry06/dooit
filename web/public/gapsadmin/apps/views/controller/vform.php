
<div class="row">
  <div id="breadcrumb" class="col-md-12">
    <ol class="breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#"><?=$page_title?></a></li>
    </ol>
  </div>
</div>  
<?php
$fields = array('id','controller','title','is_menu','group_id','order','cssicon');
foreach($fields as $field){
  $EDIT->{$field} = isset($EDIT->{$field}) ? $EDIT->{$field} : '';
}
?>
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
            <legend><?=$page_title?></legend>
            <input name="id" type="hidden" value="<?php echo set_value('id', $EDIT->id); ?>">

            <div class="form-group">
              <label class="control-label col-md-2">Controller</label>
              <div class="col-md-7">
                <input class="form-control" name="control" placeholder="controller/method" type="text" value="<?php echo set_value('control', $EDIT->controller); ?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Title</label>
              <div class="col-md-7">
                <input class="form-control" name="title" placeholder="Title" type="text" value="<?php echo set_value('title', $EDIT->title); ?>">
              </div>
            </div> 

          <div class="form-group">
            <label class="control-label col-md-2">Group</label>
            <div class="col-md-3">
              <select id="el2" name="group" class="select2-container select2able select2-container-active">
                <option value="" >-- Pilih --</option>
              <?php foreach ($ugroup as $value) { ?>
                <option value="<?=$value['id']?>" <?php if ($value['id']==$EDIT->group_id) { echo 'selected="selected"'; } ?> ><?=$value['group_name']?></option>
              <?php } ?>                  
              </select>
            </div>
          </div>
        
        <div class="row form-group">
          <label class="control-label col-md-2">Show in Menu</label>
          <div class="col-sm-2">
            <div class="toggle-switch toggle-switch-primary">
              <label>
                <input  name="aktif" <?php if ($EDIT->is_menu==1) { echo 'checked'; } ?> type="checkbox">
                <div class="toggle-switch-inner"></div>
                <div class="toggle-switch-switch"><i class="fa fa-check"></i></div>
              </label>
            </div>
          </div>
        </div>

            <div class="form-group">
              <label class="control-label col-md-2">Sort order</label>
              <div class="col-md-2">
                <input class="form-control" name="order" placeholder="0" type="text" value="<?php echo set_value('order', $EDIT->order); ?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">font awesome icon</label>
              <div class="col-md-2">
                <input class="form-control" name="cssicon" placeholder="fa fa-gear" type="text" value="<?php echo set_value('cssicon', $EDIT->cssicon); ?>">
              </div>
            </div> 


          </fieldset>

            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-2">
              <a href="../index" class="btn btn-default btn-label-left">
              <span><i class="fa fa-times txt-danger"></i></span>
                Cancel
              </a>
            </div>
            <div class="col-sm-2">
              <button type="submit" class="btn btn-primary btn-label-left">
              <span><i class="fa fa-check"></i></span>
                Save
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
  });

  </script>  
  </body>
</html>