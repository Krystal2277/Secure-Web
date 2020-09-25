    <?php
    session_start();
    getRandomString();
    function getRandomString()
    {
        create_image();
?>
       <div>
            <div> 
                <img src="captcha_image.png">
            </div><br>
            <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="submit" value="refresh captcha">
            </form>
            <form action="" method="POST">
                <input type="text" name="input"/>
                <input type="hidden" name="flag" value="1"/>
                <input type="submit" value="submit" name="submit"/>
            </form>
            
        </div>      
 
 
<?php
    }
 
    function  create_image()
    {
        $image = imagecreatetruecolor(200, 50);       
        $background_color = imagecolorallocate($image, 255, 255, 255);  
        imagefilledrectangle($image,0,0,200,50,$background_color); 
 
        $line_color = imagecolorallocate($image, 64,64,64);
        $number_of_lines=rand(3,7);
 
        for($i=0;$i<$number_of_lines;$i++)
        {
            imageline($image,0,rand()%50,250,rand()%50,$line_color);
        }
 
        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }  
 
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $text_color = imagecolorallocate($image, 0,0,0);

        $randomStr = [];
        for ($i=0;$i<6;$i++)
        {
            $idx = rand(0,61);
            $randomStr[] = $allowed_letters[$idx];
            imagestring($image, 5,  5+($i*30), 20, $allowed_letters[$idx], $text_color);
        }
        $res = implode($randomStr);
 
        $_SESSION['code'] = $res;
 
        imagepng($image, "captcha_image.png");
    }
?>
    </body>