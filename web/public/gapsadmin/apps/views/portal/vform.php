
<div class="row">
  <div id="breadcrumb" class="col-md-12">
    <ol class="breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#"><?=$page_title?></a></li>
    </ol>
  </div>
</div>  
<?php
$fields = array(
"com_id","com_code","com_domain","com_name","com_description", "com_ico","com_logo","com_img_header","com_img_footer","com_address","com_tlp","com_fax","com_email","com_url_wallet","com_url_commerce","com_tpl_path","com_asset_path","com_asset_url","com_url_success","com_url_failed","create_at","modified_at");
foreach($fields as $field){
  $EDIT->{$field} = isset($EDIT->{$field}) ? $EDIT->{$field} : '';
}

$host_= $EDIT->com_asset_url;
?>
<div class="row">
  <div class="col-xs-12 col-sm-12">
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

        <form id="defaultForm" method="post" action="" class="form-horizontal"  enctype="multipart/form-data">
          <fieldset>
            
            <input name="com_id" type="hidden" value="<?php echo set_value('com_id', $EDIT->com_id); ?>">
        <div id="tabs">
          <ul>
            <li><a href="#tabs-1"><b>Basic Configuration </b><i class="fa fa-chevron-circle-right"></i></a></li>
            <li><a href="#tabs-2"><b>Custom Configuration</b><i class="fa fa-chevron-circle-right"></i></a></li>
          </ul>
          <div id="tabs-1">
            
            <div class="form-group">
              <label class="control-label col-md-2">Company Code</label>
              <div class="col-md-7">
                <input class="form-control" name="com_code" placeholder="000000" type="text" value="<?php echo set_value('com_code', $EDIT->com_code); ?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Company Name</label>
              <div class="col-md-7">
                <input class="form-control" name="com_name" placeholder="some name" type="text" value="<?php echo set_value('com_name', $EDIT->com_name); ?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Company Description</label>
              <div class="col-md-7">
                <textarea class="form-control"  name="com_description"><?php echo set_value('com_description', $EDIT->com_description); ?></textarea>
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Company Domain</label>
              <div class="col-md-7">
                <input class="form-control" name="com_domain" placeholder="sub.domain.com" type="text" value="<?php echo set_value('com_domain', $EDIT->com_domain); ?>">
              </div>
            </div> 


            <div class="form-group">
                <label class="col-md-2 control-label">Company Ico</label>
                <div class="col-md-7">
                    
                    <input type="file" id="com_ico" class="form-control" name="com_ico" />
                    <img src="<?php echo $host_.'/img/'.set_value('com_ico', $EDIT->com_ico); ?>" width="60" id="imgPrev">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Company Logo</label>
                <div class="col-md-7">
                    
                    <input type="file" id="com_logo" class="form-control" name="com_logo" />
                    <img src="<?php echo $host_.'/img/'.set_value('com_logo', $EDIT->com_logo); ?>" width="60" id="imgPrev2">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Image Header</label>
                <div class="col-md-7">
                    
                    <input type="file" id="com_img_header" class="form-control" name="com_img_header" />
                    <img src="<?php echo $host_.'/img/'.set_value('com_img_header', $EDIT->com_img_header); ?>" width="60" id="imgPrev3">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Image footer</label>
                <div class="col-md-7">
                    
                    <input type="file" id="com_img_footer" class="form-control" name="com_img_footer" />
                    <img src="<?php echo $host_.'/img/'.set_value('com_img_footer', $EDIT->com_img_footer); ?>" width="60" id="imgPrev4">
                </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Template Path </label>
              <div class="col-md-7">
                <input class="form-control" name="com_tpl_path" placeholder="/www/template/" type="text" value="<?php echo set_value('com_tpl_path', $EDIT->com_tpl_path); ?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Asset Path (css,img,plugin)</label>
              <div class="col-md-7">
                <input class="form-control" name="com_asset_path" placeholder="/www/asset" type="text" value="<?php echo set_value('com_asset_path', $EDIT->com_asset_path); ?>">
              </div>
            </div> 
            
            <div class="form-group">
              <label class="control-label col-md-2">Url Asset (css,img,plugin)</label>
              <div class="col-md-7">
                <input class="form-control" name="com_asset_url" placeholder="http://www.ssss.com/asset" type="text" value="<?php echo set_value('com_asset_url', $EDIT->com_asset_url); ?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Url API Wallet</label>
              <div class="col-md-7">
                <input class="form-control" name="com_url_wallet" placeholder="http://www.wallet.com/api" type="text" value="<?php echo set_value('com_url_wallet', $EDIT->com_url_wallet); ?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Url API Ecommerce </label>
              <div class="col-md-7">
                <input class="form-control" name="com_url_commerce" placeholder="http://www.commerce.com/api" type="text" value="<?php echo set_value('com_url_commerce', $EDIT->com_url_commerce); ?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-md-2">Url Success Confirm </label>
              <div class="col-md-7">
                <input class="form-control" name="com_url_success" placeholder="http://www.url.com/oke" type="text" value="<?php echo set_value('com_url_success', $EDIT->com_url_success); ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Url Failed Confirm </label>
              <div class="col-md-7">
                <input class="form-control" name="com_url_failed" placeholder="http://www.url.com/fail" type="text" value="<?php echo set_value('com_url_failed', $EDIT->com_url_failed); ?>">
              </div>
            </div>
          </div>

          <div id="tabs-2">

            <div class="form-group">
              <label class="control-label col-sm-5">LoginBox background(.loginBox)</label>
              <div class="col-md-5">
              <input type='text' name="loginbox" id="colorpick" value="<?php echo @$PARAM->loginbox;?>"/>

              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-5">Right loginBox background(.bg222) </label>
              <div class="col-md-5">
              <input type='text' name="loginbox2" id="colorpick2" value="<?php echo @$PARAM->bg222;?>"/>

              </div>
            </div>  

            <div class="form-group">
              <label class="control-label col-sm-5">Menu background(.x-navigation) </label>
              <div class="col-md-5">
              <input type='text' name="navigationbg" id="colorpick3" value="<?php echo @$PARAM->navigation;?>"/>
              </div>
            </div>                        

            <div class="form-group">
              <label class="control-label col-sm-5">Sub menu background(.profile) </label>
              <div class="col-md-5">
              <input type='text' name="navigationbg1" id="colorpick4" value="<?php echo @$PARAM->headernav;?>"/>
              </div>
            </div>  

            <div class="form-group">
              <label class="control-label col-sm-5">Menu background(x-navigation-horizontal) </label>
              <div class="col-md-5">
              <input type='text' name="navigationbg2" id="colorpick5" value="<?php echo @$PARAM->profile;?>"/>
              </div>
            </div> 

            <div class="form-group">
                <label class="col-md-2 control-label">Image Slide 1</label>
                <div class="col-md-7">
                    
                    <input type="file" id="img_slide1" class="form-control" name="img_slide1" />
                    <img src="<?php echo $host_.'/img/'.@$PARAM->slide1; ?>" width="60" id="imgPrev5">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Image Slide 2</label>
                <div class="col-md-7">
                    
                    <input type="file" id="img_slide2" class="form-control" name="img_slide2" />
                    <img src="<?php echo $host_.'/img/'.@$PARAM->slide2; ?>" width="60" id="imgPrev6">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Image Slide 3</label>
                <div class="col-md-7">
                    
                    <input type="file" id="img_slide3" class="form-control" name="img_slide3" />
                    <img src="<?php echo $host_.'/img/'.@$PARAM->slide2; ?>" width="60" id="imgPrev7">
                </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Company Address </label>
              <div class="col-md-7">
                <textarea class="form-control" name="com_address" ><?php echo set_value('com_address', $EDIT->com_address); ?></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Company Telp </label>
              <div class="col-md-7">
                <input class="form-control" name="com_tlp" placeholder="..." type="text" value="<?php echo set_value('com_tlp', $EDIT->com_tlp); ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Company Fax </label>
              <div class="col-md-7">
                <input class="form-control" name="com_fax" placeholder="..." type="text" value="<?php echo set_value('com_fax', $EDIT->com_fax); ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Company Email </label>
              <div class="col-md-7">
                <input class="form-control" name="com_email" placeholder="..." type="text" value="<?php echo set_value('com_email', $EDIT->com_email); ?>">
              </div>
            </div>


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
  // Create jQuery-UI tabs
  $("#tabs").tabs();
  $("#colorpick").spectrum({
    preferredFormat: "hex",
    showInput: true,
    showPalette: true,
    palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]    
  });

  $("#colorpick2").spectrum({
    preferredFormat: "hex",
    showInput: true,
    showPalette: true,
    palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]    
  });
  $("#colorpick3").spectrum({
    preferredFormat: "hex",
    showInput: true,
    showPalette: true,
    palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]    
  });
  $("#colorpick4").spectrum({
    preferredFormat: "hex",
    showInput: true,
    showPalette: true,
    palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]    
  });  
  $("#colorpick5").spectrum({
    preferredFormat: "hex",
    showInput: true,
    showPalette: true,
    palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]]    
  });
  $('#defaultForm').bootstrapValidator({
    message: 'This value is not valid',
    fields: {
      com_code: {
        message: 'The company code is not valid',
        validators: {
          notEmpty: {
            message: 'The company code is required and can\'t be empty'
          },
          stringLength: {
            min: 4,
            max: 10,
            message: 'The company code must be more than 4  and number'
          },
          regexp: {
            regexp: /^[0-9]/,
            message: 'The company code can only number'
          }
        }
      },
      com_ico: {
          validators: {
              file: {
                  extension: 'jpg,jpeg,png,ico',
                  type: 'image/jpeg,image/png,image/ico',
                  maxSize: 1*10*1024,   // 5 MB
                  message: 'The selected file is not valid, it should be (jpg,jpeg,png) and 500kb at maximum.'
            },

          }
      },

      img_slide1: {
          validators: {
              file: {
                  extension: 'jpg,jpeg,png,gif',
                  type: 'image/jpeg,image/png,image/gif',
                  maxSize: 2*1024*1024,   // 2 MB
                  message: 'The selected file is not valid, it should be (jpg,jpeg,png,gif) and 2Mb at maximum.'
            },

          }
      },   
      img_slide2: {
          validators: {
              file: {
                  extension: 'jpg,jpeg,png,gif',
                  type: 'image/jpeg,image/png,image/gif',
                  maxSize: 2*1024*1024,   // 2 MB
                  message: 'The selected file is not valid, it should be (jpg,jpeg,png,gif) and 2Mb at maximum.'
            },

          }
      }, 
      img_slide3: {
          validators: {
              file: {
                  extension: 'jpg,jpeg,png,gif',
                  type: 'image/jpeg,image/png,image/gif',
                  maxSize: 2*1024*1024,   // 2 MB
                  message: 'The selected file is not valid, it should be (jpg,jpeg,png,gif) and 2Mb at maximum.'
            },

          }
      },                    
      com_asset_path: {
        message: 'Asset path is not valid',
        validators: {
          notEmpty: {
            message: 'Asset path is required and can\'t be empty'
          }
        }
      },
      com_tpl_path: {
        message: 'Template Path is not valid',
        validators: {
          notEmpty: {
            message: 'Template Path is required and can\'t be empty'
          }
        }
      },
      com_asset_url: {
        message: 'Asset url is not valid',
        validators: {
          notEmpty: {
            message: 'Asset url is required and can\'t be empty'
          }
        }
      }             
      
    }
  });

    $('#com_ico').change(function(e){
      if( this.disabled ){
            alert('Your browser does not support File upload.');
        }else{
          var choose = this.files[0];
          var fr = new FileReader;
      
          fr.onload = function() {
              var img = new Image;
              
              img.onload = function() {
                  var w = img.width;
                  var h = img.height;
                  var s = Math.round(choose.size/1024); 

                  if (s>80) { // max.80Kb
                    alert('File size foto terlalu besar, maksimal file size 80 Kb!. Silahkan ulangi lagi.');
                    $('#com_ico').val("");
                  } else if (w>60) {
                    alert('Dimensi foto terlalu besar, maksimal width 600 pixel!. Gunakan ketentuan yang berlaku.');              
                  } else if (h>60) {
                    alert('Dimensi foto terlalu besar, maksimal height 400 pixel!. Gunakan ketentuan yang berlaku.');
                  } else {
                    $('#imgPrev').attr('src',fr.result);  
                  }
              };
              
              img.src = fr.result;
          };
          
          fr.readAsDataURL(this.files[0]);
        }
    });

  $('#com_logo').change(function(e){
      if( this.disabled ){
            alert('Your browser does not support File upload.');
        }else{
          var choose = this.files[0];
          var fr = new FileReader;
      
          fr.onload = function() {
              var img = new Image;
              
              img.onload = function() {
                  var w = img.width;
                  var h = img.height;
                  var s = Math.round(choose.size/1024); 
                  
                  if (s>600) { // max.80Kb
                    alert('File size foto terlalu besar, maksimal file size 2000 Kb!. Silahkan ulangi lagi.');
                    $('#com_img_footer').val("");
                  } else if (w>600) {
                    alert('Dimensi foto terlalu besar, maksimal width 600 pixel!. Gunakan ketentuan yang berlaku.');              
                  } else if (h>400) {
                    alert('Dimensi foto terlalu besar, maksimal height 400 pixel!. Gunakan ketentuan yang berlaku.');
                  } else {
                    $('#imgPrev2').attr('src',fr.result);  
                  }
              };
              
              img.src = fr.result;
          };
          
          fr.readAsDataURL(this.files[0]);
        }
    });

  $('#com_img_header').change(function(e){
      if( this.disabled ){
            alert('Your browser does not support File upload.');
        }else{
          var choose = this.files[0];
          var fr = new FileReader;
      
          fr.onload = function() {
              var img = new Image;
              
              img.onload = function() {
                  var w = img.width;
                  var h = img.height;
                  var s = Math.round(choose.size/1024); 
                  
                  if (s>2000) { // max.80Kb
                    alert('File size foto terlalu besar, maksimal file size 2000 Kb!. Silahkan ulangi lagi.');
                    $('#com_img_footer').val("");
                  } else if (w>1200) {
                    alert('Dimensi foto terlalu besar, maksimal width 1200 pixel!. Gunakan ketentuan yang berlaku.');              
                  } else if (h>800) {
                    alert('Dimensi foto terlalu besar, maksimal height 800 pixel!. Gunakan ketentuan yang berlaku.');
                  } else {
                    $('#imgPrev3').attr('src',fr.result);  
                  }
              };
              
              img.src = fr.result;
          };
          
          fr.readAsDataURL(this.files[0]);
        }
    });

  $('#com_img_footer').change(function(e){
      if( this.disabled ){
            alert('Your browser does not support File upload.');
        }else{
          var choose = this.files[0];
          var fr = new FileReader;
      
          fr.onload = function() {
              var img = new Image;
              
              img.onload = function() {
                  var w = img.width;
                  var h = img.height;
                  var s = Math.round(choose.size/1024); 
                  
                  if (s>2000) { // max.80Kb
                    alert('File size foto terlalu besar, maksimal file size 2000 Kb!. Silahkan ulangi lagi.');
                    $('#com_img_footer').val("");
                  } else if (w>1200) {
                    alert('Dimensi foto terlalu besar, maksimal width 1200 pixel!. Gunakan ketentuan yang berlaku.');              
                  } else if (h>800) {
                    alert('Dimensi foto terlalu besar, maksimal height 800 pixel!. Gunakan ketentuan yang berlaku.');
                  } else {
                    $('#imgPrev4').attr('src',fr.result);  
                  }
              };
              
              img.src = fr.result;
          };
          
          fr.readAsDataURL(this.files[0]);
        }
    });
$('#img_slide1').change(function(e){
      if( this.disabled ){
            alert('Your browser does not support File upload.');
        }else{
          var choose = this.files[0];
          var fr = new FileReader;
      
          fr.onload = function() {
              var img = new Image;
              
              img.onload = function() {
                  var w = img.width;
                  var h = img.height;
                  var s = Math.round(choose.size/1024); 
                  
                  if (s>5000) { // max.80Kb
                    alert('File size foto terlalu besar, maksimal file size 5000 Kb!. Silahkan ulangi lagi.');
                    $('#com_img_footer').val("");
                  } else if (w>2400) {
                    alert('Dimensi foto terlalu besar, maksimal width 2400 pixel!. Gunakan ketentuan yang berlaku.');              
                  } else if (h>1024) {
                    alert('Dimensi foto terlalu besar, maksimal height 800 pixel!. Gunakan ketentuan yang berlaku.');
                  } else {
                    $('#imgPrev5').attr('src',fr.result);  
                  }
              };
              
              img.src = fr.result;
          };
          
          fr.readAsDataURL(this.files[0]);
        } 
 });
$('#img_slide2').change(function(e){
      if( this.disabled ){
            alert('Your browser does not support File upload.');
        }else{
          var choose = this.files[0];
          var fr = new FileReader;
      
          fr.onload = function() {
              var img = new Image;
              
              img.onload = function() {
                  var w = img.width;
                  var h = img.height;
                  var s = Math.round(choose.size/1024); 
                  
                  if (s>5000) { // max.80Kb
                    alert('File size foto terlalu besar, maksimal file size 5000 Kb!. Silahkan ulangi lagi.');
                    $('#com_img_footer').val("");
                  } else if (w>2400) {
                    alert('Dimensi foto terlalu besar, maksimal width 2400 pixel!. Gunakan ketentuan yang berlaku.');              
                  } else if (h>1024) {
                    alert('Dimensi foto terlalu besar, maksimal height 800 pixel!. Gunakan ketentuan yang berlaku.');
                  } else {
                    $('#imgPrev6').attr('src',fr.result);  
                  }
              };
              
              img.src = fr.result;
          };
          
          fr.readAsDataURL(this.files[0]);
        } 
 });
$('#img_slide3').change(function(e){
      if( this.disabled ){
            alert('Your browser does not support File upload.');
        }else{
          var choose = this.files[0];
          var fr = new FileReader;
      
          fr.onload = function() {
              var img = new Image;
              
              img.onload = function() {
                  var w = img.width;
                  var h = img.height;
                  var s = Math.round(choose.size/1024); 
                  
                  if (s>5000) { // max.80Kb
                    alert('File size foto terlalu besar, maksimal file size 5000 Kb!. Silahkan ulangi lagi.');
                    $('#com_img_footer').val("");
                  } else if (w>2400) {
                    alert('Dimensi foto terlalu besar, maksimal width 2400 pixel!. Gunakan ketentuan yang berlaku.');              
                  } else if (h>1024) {
                    alert('Dimensi foto terlalu besar, maksimal height 800 pixel!. Gunakan ketentuan yang berlaku.');
                  } else {
                    $('#imgPrev7').attr('src',fr.result);  
                  }
              };
              
              img.src = fr.result;
          };
          
          fr.readAsDataURL(this.files[0]);
        } 
 });

  });

  </script>  
  </body>
</html>