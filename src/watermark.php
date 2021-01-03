<?php
/**
 * (c) MerabChik <merabchik83@gmail.com>
 * 
 * This source file is subject to GNU General Public License v3.0 license
 */
namespace gecorp\phpwatermark;

use Exception;

class watermark {
    
    private $options;

    function __construct(Options $pOptions): watermark {
        $this->options = $pOptions->getOptions();
        return $this;
    }

    public function setOptions(Options $pOptions): void {
        $this->options = $pOptions->getOptions();
    }

    public function getOptions(): Array {
        return $this->options;
    }

    /**
     * This function make watermark final proccess
     *
     * @param String $target Path to the JPEG image
     * @param String $wtrmrk_file Path to the PNG image
     * @param String $newcopy
     * @return void
     */
    public function makeImage(String $pOriginalFilename, String $pWatermarkFileName, String $pNewFileName): bool {
        try{
            $watermark = imagecreatefrompng($pWatermarkFileName);
            imagealphablending($watermark, false);
            imagesavealpha($watermark, true);
            $img = imagecreatefromjpeg($pOriginalFilename);
            $img_w = imagesx($img);
            $img_h = imagesy($img);
            $wtrmrk_w = imagesx($watermark);
            $wtrmrk_h = imagesy($watermark);
            $position = (int) $this->options["position"];
            $quality = (int) $this->options["quality"];
            $destination = $this->calculateWatermarkDest($position, $img_w, $img_h, $wtrmrk_w, $wtrmrk_h);
            imagecopy($img, $watermark, $destination["x"], $destination["y"], 0, 0, $wtrmrk_w, $wtrmrk_h);
            imagejpeg($img, $pNewFileName, $quality);
            imagedestroy($img);
            imagedestroy($watermark);
            return true;
        }catch(Exception $e){
            if ($_SERVER['APP_DEBUG']) {
                return $e->getMessage();
            }
            return false;
        }
    }

    /**
     * Calculate watermark image position in original image map
     *
     * @param integer $pPosition Position of watermark image from configuration options 
     * @param integer $pImgWidth Original image width
     * @param integer $pImgHeight Original image height
     * @param integer $pWImgWidth Watermark image width
     * @param integer $pWImgHeight Watermark image height
     * @return Array destination positions X,Y of watermark image
     */
    private function calculateWatermarkDest(int $pPosition = 5, int $pImgWidth, int $pImgHeight, int $pWImgWidth, int $pWImgHeight): Array {
        $destination = [];
        $vOptions = $this->options;
        switch($pPosition){
            case 0: // LEFT_TOP
                if(array_key_exists("margin", $vOptions)){
                    if(array_key_exists("top", $vOptions["margin"])){
                        $destination["y"] = $vOptions["margin"]["top"];
                    }
                    if(array_key_exists("left", $vOptions["margin"])){
                        $destination["x"] = $vOptions["margin"]["left"];
                    }
                    if(array_key_exists("right", $vOptions["margin"])){
                        $destination["x"] = $pImgWidth - $pWImgWidth;
                        $destination["x"] = $destination["x"] - $vOptions["margin"]["right"];
                    }
                    if(array_key_exists("bottom", $vOptions["margin"])){
                        $destination["y"] = $pImgHeight - $pWImgHeight;
                        $destination["y"] = $destination["x"] + $vOptions["margin"]["bottom"];
                    }
                    if(array_key_exists("all", $vOptions["margin"])){
                        $destination["x"] = $vOptions["margin"]["all"];
                        $destination["y"] = $vOptions["margin"]["all"];
                    }
                }else{
                    $destination["x"] = 0;
                    $destination["y"] = 0;
                }
                break;
            case 1:
                # code...
                break;
            case 2:
                # code...
                break;
            case 3:
                # code...
                break;
            case 4:
                # code...
                break;
            case 5:
                # code...
                break;
            case 6:
                # code...
                break;
            case 7:
                # code...
                break;
            case 8:
                # code...
                break;
            case 9: // CENTER_CENTER
                if(array_key_exists("margin", $vOptions)){
                    if(array_key_exists("top", $vOptions["margin"])){
                        $destination["y"] = ($pImgHeight / 2) - ($pWImgHeight / 2);
                        $destination["y"] = $destination["y"] + $vOptions["margin"]["top"];
                    }
                    if(array_key_exists("left", $vOptions["margin"])){
                        $destination["x"] = ($pImgWidth / 2) - ($pWImgWidth / 2);
                        $destination["x"] = $destination["x"] + $vOptions["margin"]["left"];
                    }
                    if(array_key_exists("right", $vOptions["margin"])){
                        $destination["x"] = ($pImgWidth / 2) - ($pWImgWidth / 2);
                        $destination["x"] = $destination["x"] - $vOptions["margin"]["right"];
                    }
                    if(array_key_exists("bottom", $vOptions["margin"])){
                        $destination["y"] = ($pImgHeight / 2) - ($pWImgHeight / 2);
                        $destination["y"] = $destination["x"] + $vOptions["margin"]["bottom"];
                    }
                    if(array_key_exists("all", $vOptions["margin"])){
                        $destination["x"] = ($pImgWidth / 2) - ($pWImgHeight / 2);
                        $destination["x"] = $destination["x"] + $vOptions["margin"]["all"];
                        $destination["y"] = ($pImgWidth / 2) - ($pWImgHeight / 2);
                        $destination["y"] = $destination["y"] + $vOptions["margin"]["all"];
                    }
                }else{
                    $destination["x"] = ($pImgWidth / 2) - ($pWImgHeight / 2);
                    $destination["y"] = ($pImgWidth / 2) - ($pWImgHeight / 2);
                }
                break;
        }
        return $destination;
    }
}
// watermark_image('image_name.jpg','watermark.png', 'new_image_name.jpg');
