
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
  <div class="col-xs-12 col-sm-10">
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
          <fieldset>
            <legend><?=$page_title?></legend>
            <input name="uid" type="hidden" value="<?php echo set_value('uid', $EDIT->uid); ?>">
            <div class="form-group">
              <label class="control-label col-md-2">Username</label>
              <div class="col-md-7">
                <div class="input-group">
                  <span class="input-group-addon">@</span><input name="username" class="form-control" placeholder="Username" type="text" value="<?php echo set_value('username', $EDIT->username); ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Nama</label>
              <div class="col-md-7">
                <input class="form-control" name="nama" placeholder="Nama" type="text" value="<?php echo set_value('nama', $EDIT->nama); ?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Password</label>
              <div class="col-md-7">
                <input class="form-control" name="password" placeholder="" type="password" >
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Konfirmasi Password</label>
              <div class="col-md-7">
                <input class="form-control" name="passconf" placeholder="" type="password" >
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Email</label>
              <div class="col-md-7">
                <input class="form-control" name="email" placeholder="name@site.com" type="text" value="<?php echo set_value('email', $EDIT->email); ?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Telepon</label>
              <div class="col-md-7">
                <input class="form-control" name="telpon" placeholder="02198XXXXX" type="text" value="<?php echo set_value('telpon', $EDIT->telpon); ?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">User Group</label>
              <div class="col-md-7">
              <select id="s2_with_tag" name="group_id[]" multiple="multiple" class="populate placeholder">                
                <?php foreach ($ugroup as $value) { ?>
                  <option value="<?=$value['id']?>" <?php if($USER_GROUP AND is_array($USER_GROUP)){ foreach ($USER_GROUP as $GROUP) { if ($GROUP->group_id==$value['id']) { echo 'selected="selected"';}}} ?> ><?=$value['group_name']?></option>
                <?php } ?>
                </select>
                <small>*Tekan CTRL / SHIFT untuk memilih lebih dari 1 Group.</small>
              </div>
            </div>

                      <div class="form-group">
                        <label class="control-label col-md-2">Status</label>
                        <div class="col-md-7">
                          <select name="aktif" id="el2" class="select2-container select2able select2-container-active">
                            <option value="1" <?php if ($EDIT->aktif==1) { echo 'selected="selected"'; } ?> >Aktif</option>
                            <option value="1" <?php if ($EDIT->aktif==0) { echo 'selected="selected"'; } ?> >NonAktif</option>
                          </select>
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

  <script type="text/javascript">
  $(document).ready(function(){
    var o = $('.alert');
    o.hide();
    o.fadeIn();
    o.click(function(){ hideError(); });
    setTimeout("hideError()",5000);
  });
  function hideError(){ $(".alert").fadeOut(); }

// function checkAll(ele) {
//      var checkboxes = document.getElementsByTagName('input');
//      if (ele.checked) {
//          for (var i = 0; i < checkboxes.length; i++) {
//              if (checkboxes[i].type == 'checkbox') {
//                  checkboxes[i].checked = true;
//              }
//          }
//      } else {
//          for (var i = 0; i < checkboxes.length; i++) {
//              console.log(i)
//              if (checkboxes[i].type == 'checkbox') {
//                  checkboxes[i].checked = false;
//              }
//          }
//      }
//  }  
  </script>  
  <script src="<?php echo template_uri();?>plugins/select2/select2.min.js"></script>
  <script src="<?php echo template_uri();?>plugins/bootstrapvalidator/bootstrapValidator.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  // Load script of Select2 and run this
  $("#el2").select2();
  $('#s2_with_tag').select2({placeholder: "Select Group"});

  $('#defaultForm').bootstrapValidator({
    message: 'This value is not valid',
    fields: {
      username: {
        message: 'The username is not valid',
        validators: {
          notEmpty: {
            message: 'The username is required and can\'t be empty'
          },
          stringLength: {
            min: 5,
            max: 30,
            message: 'The username must be more than 6 and less than 30 characters long'
          },
          regexp: {
            regexp: /^[a-zA-Z0-9_\.]+$/,
            message: 'The username can only consist of alphabetical, number, dot and underscore'
          }
        }
      },
      email: {
        validators: {
          notEmpty: {
            message: 'The email address is required and can\'t be empty'
          },
          emailAddress: {
            message: 'The input is not a valid email address'
          }
        }
      },

      password: {
        validators: {
          notEmpty: {
            message: 'The password is required and can\'t be empty'
          },
          identical: {
            field: 'confirmPassword',
            message: 'The password and its confirm are not the same'
          }
        }
      },
      passconf: {
        validators: {
          notEmpty: {
            message: 'The confirm password is required and can\'t be empty'
          },
          identical: {
            field: 'password',
            message: 'The password and its confirm are not the same'
          }
        }
      },    
      
    }
  });

  WinMove();
});
</script>