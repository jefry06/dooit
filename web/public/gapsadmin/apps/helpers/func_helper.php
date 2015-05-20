<?php
function FILES_upload_resize($img_name,$destination,$tmp="")
{
    $res = array();
    $CI  =& get_instance();

    //here you display your success report :) 
    if(!is_dir($destination)) mkdir_r($destination);    

    $allowedExts            = array("gif", "jpeg", "jpg", "png","GIF", "JPEG", "JPG", "PNG");
    $file_name              = $_FILES[$img_name]["name"];
    $temp                   = explode(".", $_FILES[$img_name]["name"]);
    $extension              = end($temp);
    //$tmp                    = NewGuid();
    if($tmp==""){
        $tmp    = str_replace( ".".$extension, "", $file_name);                    
    }
    $tmp_name_img           = $tmp.".".$extension;
    //$tmp_name_img_thumb     = $tmp."_thumb.".$extension;

    if ((($_FILES[$img_name]["type"] == "image/gif")
    || ($_FILES[$img_name]["type"] == "image/jpeg")
    || ($_FILES[$img_name]["type"] == "image/jpg")
    || ($_FILES[$img_name]["type"] == "image/pjpeg")
    || ($_FILES[$img_name]["type"] == "image/x-png")
    || ($_FILES[$img_name]["type"] == "image/png"))
    && in_array($extension, $allowedExts))
      { 
        if ($_FILES[$img_name]["error"] > 0)  
        {
            //ada error
            $res['error'] = $_FILES[$img_name]["error"] . "";
        }
        else
        {
            //if files exists
            if(file_exists($destination.$tmp_name_img)) 
            {
                chmod($destination.$tmp_name_img,0755); //Change the file permissions if allowed
                unlink($destination.$tmp_name_img); //remove the file
            }

            if(move_uploaded_file($_FILES[$img_name]["tmp_name"] , $destination.$tmp_name_img))
            {

                list($width, $height)   = getimagesize($destination.$tmp_name_img);
                // $r['image_library']     = 'gd2';
                // $r['source_image']      = $destination.$tmp_name_img;
                // $r['create_thumb']      = TRUE;
                // $r['maintain_ratio']    = TRUE;

                // if ($width >= $height) 
                // {
                //     $r['width']     = $size['height'];
                //     $r['height']    = $size['width'];
                
                // } else {
                
                //     $r['width']     = $size['width'];
                //     $r['height']    = $size['height'];
                // }

                // $CI->load->library('image_lib', $r);
                // $CI->image_lib->initialize($r);
                
                // if ($CI->image_lib->resize()) 
                // {
                    $res['filename']    = $tmp_name_img;
                    //$res['thumb_name']  = $tmp_name_img_thumb;
                    // $res['width']       = $r['width'];
                    // $res['height']      = $r['height']; 
                    $res['width']       = $width;
                    $res['height']      = $height;                     
                    $res['path']        = $destination;
                    $res['full_path']   = $destination.$tmp_name_img; 
                    $res['error']       = "";                   
                // } else {                     
                //     $res['error'] = $CI->image_lib->display_errors();
                // }

                // $CI->image_lib->clear();
            
            } else {
               $res['error'] = "upload Error";               
            }
        }                       
      } else {
        $res['error'] = 'Wrong Extension';
      }

    return $res;
}

 // Generate Guid
function NewGuid()
{
   $s = strtolower(md5(uniqid(rand(), true)));
   $guidText = substr($s, 0, 8);
   return $guidText;
}
// End Generate Guid

function mkdir_r($dirName, $rights=0755){
    $dirs = explode('/', $dirName);
    $dir='';
    foreach ($dirs as $part) {
        //echo $part;
        $dir.=$part.'/';
        if (!is_dir($dir) && strlen($dir)>0)
            mkdir($dir, $rights);
    }
}
?>