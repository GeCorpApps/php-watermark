# php-watermark
Package for overlay watermark image to another image file
<br />Example: 
```PHP
use gecorp\phpwatermark\Options;
use gecorp\phpwatermark\watermark;

$option = [
    "margin" => [ // "margin" => ["left", "right", "top","bottom", "all"]
        "left" => 10, 
        "top" => 10
    ], "position" => Options::RIGHT_BOTTOM, 
    "quality" => 100
];
$watermark = new watermark(new Options($options));
$pOriginalFilename = "originalimage.jpg"; // filename with directory path of original image
$pWatermarkFileName = "watermarkimage.png"; // filename with directory of watermark image
$pNewFileName = "newfilename.jpg"; // new filename with directory path
$result = $watermark->makeImage($pOriginalFilename, $pWatermarkFileName, $pNewFileName);
if($result){
    echo "Done";
}else{
    echo $result; // Exception message
}
```