<?php
   header("Content-type: image/jpeg");
   $pic = stripslashes($_GET['pic']);
   $im    = imagecreatefromjpeg($pic);
   $width = $_GET['width'];

   if ($width < 600)
   {
      // thumbnails
      $quality = 60;
   }
   else
   {
      // normal images
      if (isset($_GET['q']))
      {
         $quality = $_GET['q'];
      }
      else
      {
         // default quality is 80 for larger pictures
         $quality = 80;
      }
   }

   $old_x=imageSX($im);
   $old_y=imageSY($im);

   $new_w=(int)($width);
   if (($new_w<=0) or ($new_w>$old_x)) {
      $new_w=$old_x;
   }

   $new_h=($old_x*($new_w/$old_x));

   if ($old_x > $old_y) {
      $thumb_w=$new_w;
      $thumb_h=$old_y*($new_h/$old_x);
   }
   if ($old_x < $old_y) {
      $thumb_w=$old_x*($new_w/$old_y);
      $thumb_h=$new_h;
   }
   if ($old_x == $old_y) {
      $thumb_w=$new_w;
      $thumb_h=$new_h;
   }
   $thumb=ImageCreateTrueColor($thumb_w,$thumb_h-1);

//   if ($width < 600)
//   {
//      imagecopyresized($thumb,$im,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
//   }
//   else
//   {
      imagecopyresampled($thumb,$im,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
//   }
   

   imagejpeg($thumb,"",$quality);
   imagedestroy($thumb);
?>

