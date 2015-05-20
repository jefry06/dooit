
<div class="row">
  <div id="breadcrumb" class="col-md-12">
    <ol class="breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#"><?=$page_title?></a></li>
    </ol>
  </div>
</div>  
<?php
$fields = array('uid','group_id','username','nama','email','telpon','aktif');
foreach($fields as $field){
  $EDIT->{$field} = isset($EDIT->{$field}) ? $EDIT->{$field} : '';
}
?>
<div class="row">
  <div class="col-xs-12 col-sm-12">
      <div class="box-header">
        <div class="box-name">
          <i class="fa fa-user"></i>
          <span>User Profile</span>
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

            <legend>Acess for username : <b><?php echo set_value('uid', $EDIT->username); ?></b></legend>
            <input name="uid" type="hidden" value="<?php echo set_value('uid', $EDIT->uid); ?>">
              <div class="form-group">
                    <div class="col-md-12">
                       <div class="checkbox">
                        <label >
                              <input  type="checkbox" onchange="checkAll(this)" name="chk[]" />
                                 Select All <i class="fa fa-square-o"></i>
                        </label>
                      </div>
                    </div>
                </div>

            <div class="row form-group">
            <?php foreach ($ugroup as $v) { ?>              
                <label class="control-label col-md-1"><?=$v['group_name']?></label>
                <div class="col-md-12">
                  <?php foreach ($controller as $val) { ?>
                    <?php if($v['id']==$val->group_id) { ?>                             
                    <div class="col-sm-4">
                      <div class="checkbox">
                      <label>                    
                        <input type="checkbox" name="access[]" value="<?=$val->id?>" <?php if($USER_CONTROL AND is_array($USER_CONTROL)){ foreach ($USER_CONTROL as $ctrl) { if($ctrl->controller_id==$val->id) { echo 'checked'; }}} ?>>
                        <?=$val->title?>
                          <i class="fa fa-square-o"></i>
                        </label>                    
                      </div>
                    </div>
                    <?php } ?>
                  <?php } ?>
                </div>
                      
              <?php } ?> 
              </div>




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

  <script type="text/javascript">
  function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }  
  </script>  
<script type="text/javascript">
$(document).ready(function() {
  WinMove();
});
</script>