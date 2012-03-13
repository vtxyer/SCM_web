<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?

function resizeImage($files){
$filename="photo/".$files;
$sfilename ="./photo/".$files;
// Get new sizes
list($width, $height) = GetImageSize($filename);
$percent= 150/$height;
$newwidth = $width * $percent;
$newheight = 150;

// Load
$thumb = imageCreatetruecolor($newwidth, $newheight);
$source = ImageCreateFromJPEG($filename);

// Resize
imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// Output
ImageJPEG($thumb,$sfilename);
}

resizeImage("H123899209.JPEG");
?>
<img src="photo/H123899209.JPEG">
