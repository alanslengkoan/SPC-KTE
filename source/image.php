<?php
class ImageSampler
{
    private $img;
    private $callback    = NULL;
    private $initialized = FALSE;

    protected $percent = 5;
    protected $steps   = 10;

    public $w, $h;
    public $sample_w = 0;
    public $sample_h = 0;

    public function __construct($imagefile)
    {
        if (!$this->img = $this->read_image_extension($imagefile)) {
            die("Error loading image: {$imagefile}");
        }
        $this->w = imagesx($this->img);
        $this->h = imagesy($this->img);
    }

    function read_image_extension($image)
    {
        $check_extension = pathinfo($image, PATHINFO_EXTENSION);
        if ($check_extension == 'jpg' || $check_extension == 'jpeg') {
            $image = imagecreatefromjpeg($image);
        } elseif ($check_extension == 'png') {
            $image = imagecreatefrompng($image);
        } else {
            $image = imagecreatefromjpeg($image);
        }
        return $image;
    }

    public function set_percent($percent)
    {
        $percent = intval($percent);
        if (($percent < 1) || ($percent > 50)) {
            die("Your \$percent value needs to be between 1 and 50.");
        }
        $this->percent = $percent;
    }

    public function set_steps($steps)
    {
        $steps = intval($steps);
        if (($steps < 1) || ($steps > 50)) {
            die("Your \$steps value needs to be between 1 and 50.");
        }
        $this->steps = $steps;
    }

    private function set_callback($callback)
    {
        try {
            $fn = new \ReflectionFunction($callback);
            if ($fn->getNumberOfParameters() != 4) {
                throw new \ReflectionException("Invalid parameter count in callback function.  Usage: fn(int, int, int, bool) { ... }");
            }
            $this->callback = $callback;
        } catch (\ReflectionException $e) {
            die($e->getMessage());
        }
    }

    public function init()
    {
        $this->sample_w = $this->w / $this->steps;
        $this->sample_h = $this->h / $this->steps;
        $this->initialized = TRUE;
    }

    private function get_pixel_color($x, $y)
    {
        $rgb = imagecolorat($this->img, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        return [$r, $g, $b];
    }

    public function sample($callback = NULL)
    {
        if (!$this->initialized) {
            $this->init();
        }
        if (($this->sample_w < 2) || ($this->sample_h < 2)) {
            die("Your sampling size is too small for this image - reduce the \$steps value.");
        }

        if ($callback) {
            $this->set_callback($callback);
        }

        $sample_size = round($this->sample_w * $this->sample_h * $this->percent / 100);

        $retval = [];
        for ($i = 0, $y = 0; $i < $this->steps; $i++, $y += $this->sample_h) {
            $flag = FALSE;
            $row_retval = [];
            for ($j = 0, $x = 0; $j < $this->steps; $j++, $x += $this->sample_w) {
                $total_r = $total_g = $total_b = 0;
                for ($k = 0; $k < $sample_size; $k++) {
                    $pixel_x = $x + rand(0, $this->sample_w - 1);
                    $pixel_y = $y + rand(0, $this->sample_h - 1);
                    list($r, $g, $b) = $this->get_pixel_color($pixel_x, $pixel_y);
                    $total_r += $r;
                    $total_g += $g;
                    $total_b += $b;
                }
                $avg_r = round($total_r / $sample_size);
                $avg_g = round($total_g / $sample_size);
                $avg_b = round($total_b / $sample_size);
                if ($this->callback) {
                    call_user_func_array($this->callback, [$avg_r, $avg_g, $avg_b, !$flag]);
                }
                $row_retval[] = [$avg_r, $avg_g, $avg_b];
                $flag = TRUE;
            }
            $retval[] = $row_retval;
        }

        return $retval;
    }
}




$result = [];
$handle = opendir(dirname(realpath(__FILE__)) . '/data_latih/');
while ($file = readdir($handle)) {
    if ($file !== '.' && $file !== '..') {
        $sampler = new ImageSampler("data_latih/" . $file);
        $sampler->set_steps(1);
        $sampler->init();
        $matrix = $sampler->sample();
        $result[] = $matrix[0][0];
    }
}

echo "<pre>";
print_r($result);

$test = new ImageSampler('test.jpg');
$test->set_steps(1);
$test->init();
$testing = $test->sample();
$objek = $testing[0][0];

print_r($testing[0][0]);

$geting = [];
foreach ($result as $key => $value) {
    $hitung = sqrt(pow($objek[0] - $value[0], 2) + pow($objek[1] - $value[1], 2) + pow($objek[2] - $value[2], 2));
    $geting[] = $hitung;
}

sort($geting);
print_r($geting);
