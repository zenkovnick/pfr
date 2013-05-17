<?php
function getThumbnail($image,$width=null,$height=null, $scale = true, $inflate = true, $quality = 75/*, $default = 'images/no_avatar_big.png'*/)
{
    //$default_path = sfConfig::get('sf_upload_dir').'/../'.$default;
    if(file_exists(sfConfig::get('sf_upload_dir').'/'.$image)){
        $image_dir=dirname($image);
        $image_file=basename($image);
        $thumbnail_dir='';
        if ($width>0) $thumbnail_dir.=$width;
        if ($height>0) $thumbnail_dir.='x'.$height;
        if ($width>0 || $height>0) $thumbnail_dir.='/';
        if (!file_exists(sfConfig::get('sf_upload_dir').'/'.$image_dir.'/'.$thumbnail_dir.$image_file) && ($width!=null || $height!=null))
        {
            if (!is_dir(sfConfig::get('sf_upload_dir').'/'.$image_dir.'/'.$thumbnail_dir))
            {
                mkdir (sfConfig::get('sf_upload_dir').'/'.$image_dir.'/'.$thumbnail_dir,0777);
            }

            $thumbnail = new sfThumbnail($width, $height,$scale,$inflate,$quality);
            $thumbnail->loadFile(sfConfig::get('sf_upload_dir').'/'.$image_dir.'/'.$image_file);
            $thumbnail->save(sfConfig::get('sf_upload_dir').'/'.$image_dir.'/'.$thumbnail_dir.$image_file);
        }
        return '/uploads'.'/'.$image_dir.'/'.$thumbnail_dir.$image_file;
    }
    /*else if(file_exists($default_path))
    {
        getThumbnail($default, $width,$height, $scale, $inflate, $quality);
    }*/
    else {
        return null;
    }

}
?>