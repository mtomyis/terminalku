<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('fpdf.php');
class Mypdf extends FPDF
{
	const DPI = 300;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 297;
    const A4_WIDTH = 210;
	function WordWrap(&$text, $maxwidth){
		$text = trim($text);
		if ($text==='')
			return 0;
		$space = $this->GetStringWidth(' ');
		$lines = explode("\n", $text);
		$text = '';
		$count = 0;
		foreach ($lines as $line)
		{
			$words = preg_split('/ +/', $line);
			$width = 0;
			foreach ($words as $word)
			{
				$wordwidth = $this->GetStringWidth($word);
				if ($wordwidth > $maxwidth)
				{
					// Word is too long, we cut it
					for($i=0; $i<strlen($word); $i++)
					{
						$wordwidth = $this->GetStringWidth(substr($word, $i, 1));
						if($width + $wordwidth <= $maxwidth)
						{
							$width += $wordwidth;
							$text .= substr($word, $i, 1);
						}
						else
						{
							$width = $wordwidth;
							$text = rtrim($text)."\n".substr($word, $i, 1);
							$count++;
						}
					}
				}
				elseif($width + $wordwidth <= $maxwidth)
				{
					$width += $wordwidth + $space;
					$text .= $word.' ';
				}
				else
				{
					$width = $wordwidth + $space;
					$text = rtrim($text)."\n".$word.' ';
					$count++;
				}
			}
			$text = rtrim($text)."\n";
			$count++;
		}
		$text = rtrim($text);
		return $count;
	}
    public function imageUniformToFill(string $imgPath, float $x = 0, float $y = 0, float $containerWidth = 210, float $containerHeight = 297, string $alignment = 'C')
    {
        list($width, $height) = $this->resizeToFit($imgPath, $containerWidth, $containerHeight);
        if ($alignment === 'R')
        {
            $this->Image($imgPath, $x+$containerWidth-$width, $y+($containerHeight-$height)/2, $width, $height);
        }
        else if ($alignment === 'B')
        {
            $this->Image($imgPath, $x, $y+$containerHeight-$height, $width, $height);
        }
        else if ($alignment === 'C')
        {
            $this->Image($imgPath, $x+($containerWidth-$width)/2, $y+($containerHeight-$height)/2, $width, $height);
        }
        else
        {
            $this->Image($imgPath, $x, $y, $width, $height);
        }
    }
    protected function pixelsToMm(float $val) : float
    {
        return (float)(round($val * $this::MM_IN_INCH / $this::DPI));
    }
    protected function mmToPixels(float $val) : float
    {
        return (float)(round($this::DPI * $val / $this::MM_IN_INCH));
    }
    protected function resizeToFit(string $imgPath, float $maxWidth = 210, float $maxHeight = 297) : array
    {
        list($width, $height) = getimagesize($imgPath);
        $widthScale = $this->mmtopixels($maxWidth) / $width;
        $heightScale = $this->mmToPixels($maxHeight) / $height;
        $scale = min($widthScale, $heightScale);
        return array(
            $this->pixelsToMM($scale * $width),
            $this->pixelsToMM($scale * $height)
        );
    }
}
?>