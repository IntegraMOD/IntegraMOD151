<?php

//$sourcefile = Filename of the picture into that $insertfile will be inserted.
//$insertfile = Filename of the picture that is to be inserted into $sourcefile.
//$targetfile = Filename of the modified picture.
//$transition = Intensity of the transition (in percent).
//$pos        = Position where $insertfile will be inserted in $sourcefile.
//          1 = top left
//          2 = top middle
//          3 = top right
//          4 = middle left
//          5 = middle
//          6 = middle right
//          7 = bottom left
//          8 = bottom middle
//          9 = bottom right
//

function mergePics($sourcefile, $insertfile, $pos = 0, $transition = 50, $filetype)
{

	global $album_config;

	$insertfile_id = imageCreateFromPNG($insertfile);

	switch( $filetype )
	{
		case '.jpg':
			$sourcefile_id = imageCreateFromJPEG($sourcefile);
			break;
		case '.png':
			$sourcefile_id = imageCreateFromPNG($sourcefile);
			break;
		default:
			break;
	}

	// Get the size of both pics
	$sourcefile_width = imageSX($sourcefile_id);
	$sourcefile_height = imageSY($sourcefile_id);
	$insertfile_width = imageSX($insertfile_id);
	$insertfile_height = imageSY($insertfile_id);

	switch( $pos )
	{
		case 1: // top left
			$dest_x = 0;
			$dest_y = 0;
			break;

		case 2: // top middle
			$dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
			$dest_y = 0;
			break;

		case 3: // top right
			$dest_x = $sourcefile_width - $insertfile_width;
			$dest_y = 0;
			break;

		case 4: // middle left
			$dest_x = 0;
			$dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
			break;

		case 5: // middle
			$dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 );
			$dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
			break;

		case 6: // middle right
			$dest_x = $sourcefile_width - $insertfile_width;
			$dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
			break;

		case 7: // bottom left
			$dest_x = 0;
			$dest_y = $sourcefile_height - $insertfile_height;
			break;

		case 8: // bottom middle
			$dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
			$dest_y = $sourcefile_height - $insertfile_height;
			break;

		case 9: // bottom right
			$dest_x = $sourcefile_width - $insertfile_width;
			$dest_y = $sourcefile_height - $insertfile_height;
			break;

		default:
			break;
	}

	// Merge the two pix
	imageCopyMerge($sourcefile_id, $insertfile_id, $dest_x, $dest_y, 0, 0, $insertfile_width, $insertfile_height, $transition);

	// Create the final image
	switch( $filetype )
	{
		case '.jpg':
			imagejpeg($sourcefile_id, '', $album_config['thumbnail_quality']);
			break;
		case '.png':
			imagepng($sourcefile_id);
			break;
		default:
			break;
	}

	imageDestroy($sourcefile_id);
}

function mergeResizePics($sourcefile, $insertfile, $thumbnail_width, $thumbnail_height, $pos = 0, $transition = 50, $filetype)
{

	global $album_config;

	switch( $filetype )
	{
		case '.jpg':
			$sourcefile_id = imageCreateFromJPEG($sourcefile);
			break;
		case '.png':
			$sourcefile_id = imageCreateFromPNG($sourcefile);
			break;
		default:
			break;
	}

	$insertfile_id = imageCreateFromPNG($insertfile);

	// Get the size of both pics
	$sourcefile_width = imageSX($sourcefile_id);
	$sourcefile_height = imageSY($sourcefile_id);
	$insertfile_width = imageSX($insertfile_id);
	$insertfile_height = imageSY($insertfile_id);

	if ($album_config['gd_version'] == 1)
	{
		$thumbnail = @imageCreate($thumbnail_width, $thumbnail_height);
		@imageCopyResized($thumbnail, $sourcefile_id, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $sourcefile_width, $sourcefile_height);
	}
	else
	{
		$thumbnail = @imageCreateTrueColor($thumbnail_width, $thumbnail_height);
		@imageCopyResampled($thumbnail, $sourcefile_id, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $sourcefile_width, $sourcefile_height);
	}

	// Reset the size
	$sourcefile_width = $thumbnail_width;
	$sourcefile_height = $thumbnail_height;

	switch( $pos )
	{
		case 1: // top left
			$dest_x = 0;
			$dest_y = 0;
			break;

		case 2: // top middle
			$dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
			$dest_y = 0;
			break;

		case 3: // top right
			$dest_x = $sourcefile_width - $insertfile_width;
			$dest_y = 0;
			break;

		case 4: // middle left
			$dest_x = 0;
			$dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
			break;

		case 5: // middle
			$dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 );
			$dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
			break;

		case 6: // middle right
			$dest_x = $sourcefile_width - $insertfile_width;
			$dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
			break;

		case 7: // bottom left
			$dest_x = 0;
			$dest_y = $sourcefile_height - $insertfile_height;
			break;

		case 8: // bottom middle
			$dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
			$dest_y = $sourcefile_height - $insertfile_height;
			break;

		case 9: // bottom right
			$dest_x = $sourcefile_width - $insertfile_width;
			$dest_y = $sourcefile_height - $insertfile_height;
			break;

		default:
			break;
	}

	// Merge the two pix
	imageCopyMerge($thumbnail, $insertfile_id, $dest_x, $dest_y, 0, 0, $insertfile_width, $insertfile_height, $transition);
	imageDestroy($sourcefile_id);
	imageDestroy($insertfile_id);

	return $thumbnail;
}


?>