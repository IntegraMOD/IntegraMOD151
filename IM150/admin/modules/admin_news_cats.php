<?php
/***************************************************************************
*                               admin_news_cats.php
*                              -------------------
*     begin                : Sunday, 19th Jan 2003
*
****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/**************************************************************************
*  This file will be used for modifying the smiley settings for a board.
**************************************************************************/

if( !empty($setmodules) )
{
  $filename = basename(__FILE__);
  $module['News Admin']['News_Categories'] = $filename;

  return;
}

?>