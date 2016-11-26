<?php
include 'resize.image.class.php';
require_once('ImageManipulator.php');

if ( !empty( $_FILES ) ) {



    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];

    move_uploaded_file( $tempPath, $uploadPath );


    $FileName = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);



    list($width, $height) = getimagesize($_FILES['file']['name']);

    $image = new Resize_Image;
    if($width>$height)
    {
        $perw=$width/300;
        $perh=$height/300;

        if($height/$perw<300)
        {
            $width = $width/ $perh;
            $height = $height/ $perh;
        }

    }

    $image->new_width = $width;
    $image->new_height = $height;

    $image->image_to_resize = $_FILES[ 'file' ][ 'name' ]; // Full Path to the file

    $image->ratio = true; // Keep Aspect Ratio?

    // Name of the new image (optional) - If it's not set a new will be added automatically

    $image->new_image_name = $FileName;

    /* Path where the new image should be saved. If it's not set the script will output the image without saving it */

    $image->save_folder = 'uploads/';

    $process = $image->resize();

    if($process['result'] && $image->save_folder)
    {

        $newNamePrefix = time() . '_';
        $manipulator = new ImageManipulator("uploads/".$_FILES['file']['name']);
        $width  = $manipulator->getWidth();
        $height = $manipulator->getHeight();
        $centreX = round($width / 2);
        $centreY = round($height / 2);
        // our dimensions will be 200x130
        $x1 = $centreX - 150; // 200 / 2
        $y1 = $centreY - 150; // 130 / 2

        $x2 = $centreX + 150; // 200 / 2
        $y2 = $centreY + 150; // 130 / 2

        // center cropping to 200x130
        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
        // saving file to uploads folder
        $manipulator->save('thumbs/'.$_FILES['file']['name']);
        echo 'Done ...';

        $answer = array( 'answer' => 'File transfer completed' );
        $json = json_encode( $answer );
    }


      //  echo $json;

    } else {

        echo 'No files';

    }
    ?>