<?php
/*
This script is made by Zeth (Tanel Võsumaa) (Zeth@linux.se) and it may be freely
modified or put on fire as long as the header stays intact. If you do any
changes that make it better in any way, I would be most glad if you email me
them.
This script goes through all subdirectories starting from where it is installed
and outputs all files with links to them, showing CHMOD information in numerical
and unix style. If one of your directories doesn't have the right permissions
for the script to scan it, it will output the troublemaking directory in the end
of the files table with an '[Error]' marking next to it. If you still want to
scan that specific directory you will have to chmod it to allow 'other' read and
execute.
To change some settings, skim downward in the page till you find the settings
part. There you are able to choose what you want to see on the page eg unix
style permissions, numerical permissions, errors.
That is all, I hope you enjoy it and thanks for using it.
*/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if (!empty($setmodules))
{
	$file = basename(__FILE__);

	$module['Tools']['File Status']    = append_sid("admin_file_status.$phpEx?");		

	return;
}
?>

<html>
<head>
 <title>Zeth's - File Listing Script</title>
<style type="text/css">
<!--
body{ 
	background-color: #ECF0F6;
}
h1	{
	font-family: Verdana, Arial, Geneva, sans-serif;
	font-size: 14pt;
	color: #CC0000;
	background-color: #FFFFFF;
}
h2	{
	font-family: Verdana, Arial, Geneva, sans-serif;
	font-size: 12pt;
	font-style: italic;
	color: #CC0000;
	background-color: #FFFFFF;
}
h3	{
	font-family: Verdana, Arial, Geneva, sans-serif;
	font-weight: Bold;
	font-style: italic;
	font-size: 10pt;
	color: #000066;
	background-color: #FFFFFF;
}
p	{
	font-family: Verdana, Arial, Geneva, sans-serif;
	font-size: 10pt;
	color: #000000;
 	background-color: #C1D0E2;
}
input	{
	font-family: Verdana, Arial, Geneva, sans-serif;
	font-size: 10pt;
	color: #000000;
	background-color: #FFFFFF;
}
td	{
	font-family: Verdana, Arial, Geneva, sans-serif;
	font-size: 10pt;	background-color: #C1D0E2;
}
span	{
	background-color: #C1D0E2;
	font-family: Verdana, Arial, Geneva, sans-serif;
	font-size: 10pt;
	color: #000000;
}
ul	{
	font-family: Verdana, Arial, Geneva, sans-serif;
	color: #000000;
}
a	{
	font-family: Verdana, Arial, Geneva, sans-serif;
	font-weight: normal;
	text-decoration: underline;
	color: #000000;
	background-color: transparent;
}
a:link { background-color: transparent; text-decoration: none; font-weight: bold; color: #FF9900; }
a:visited { background-color: transparent; text-decoration: none; font-weight: bold; color: #FF9900; }
a:active { background-color: transparent; text-decoration: none; font-weight: bold; color: #FF9900; }
a:hover { background-color: transparent; text-decoration: none; font-weight: bold; color: #000000; }
.normal	{
	font-family: Verdana, Arial, Geneva, sans-serif;
	font-size: 10pt;
	color: #000000;
}
.row1{
	background-color: #FFFFFF;
}
.row2{
	background-color: #C1D0E2;
}
.row3{
	background-color: #56ABDE;
}
-->
</style>

</head>

<body>
<?php
function DirectoryListing ($directoryName) {
global $FileArray;
global $DirArray;
global $BaseFileArray;

#############################################
## SETTINGS (Should someone want to config ##
## a bit)                                  ##
#############################################

$showunixstyle = 1; // Show unix style permissions (rw- r-- r--)
$shownumeric = 1; // Show permissions in number format (644)
$showtroublemakers = 1; // Show error markings next to troublemaking directories

#############################################

$dir = @dir($directoryName);

while($fileName = $dir->read()) {
$dirfilename = $directoryName."/".$fileName;
$fileperm = fileperms($dirfilename);

$mode = sprintf("%o",$fileperm);

if(is_dir($dirfilename)){
$mode = substr($mode,2);
} else {
$mode = substr($mode,3);
}

$p_bin = substr(decbin($fileperm), -9) ;
$p_arr = explode(".", substr(chunk_split($p_bin, 1, "."), 0, 17)) ;
$unixstyle = ""; $i = 0;

foreach ($p_arr as $CH_this) {
        $p_char = ( $i%3==0 ? "r" : ( $i%3==1 ? "w" : "x" ) );
        $unixstyle .= ( $CH_this=="1" ? $p_char : "-" ) . ( $i%3==2 ? " " : "" );
        $i++;
}
      if ($fileName != "." && $fileName != "..") {
            if (is_dir($dirfilename)) {
                if($p_arr[6] == 1 && $p_arr[8] == 1){
                     DirectoryListing($dirfilename);
                } else {
                       $temp = "<tr><td onMouseOver=\"this.className='row1'\" onMouseOut=\"this.className='row2'\"><a href=\"".$dirfilename."\">".$dirfilename."</A></td>";
                       if($showunixstyle == 1){
                       $temp .= "<td width=\"120\" onMouseOver=\"this.className='row1'\" onMouseOut=\"this.className='row2'\">".$unixstyle."</td>";
                       } if($shownumeric == 1){
                       $temp .= "<td width=\"80\" onMouseOver=\"this.className='row1'\" onMouseOut=\"this.className='row2'\">(".$mode.")</td>";
                       } if($showtroublemakers == 1){
                       $temp .= "<td width=\"80\"><b>[Error]</b></td>";
                       }
                       $temp .= "</tr>\n";
                       $DirArray[] = $temp;                                                                                                                                     ;
                }
            } else {

                if($directoryName == "."){
                       $temp = "<tr><td onMouseOver=\"this.className='row1'\" onMouseOut=\"this.className='row2'\"><a href=\"".$dirfilename."\">".$dirfilename."</A></td>";
                       if($showunixstyle == 1){
                       $temp .= "<td width=\"120\" onMouseOver=\"this.className='row1'\" onMouseOut=\"this.className='row2'\">".$unixstyle."</td>";
                       } if($shownumeric == 1){
                       $temp .= "<td width=\"80\" onMouseOver=\"this.className='row1'\" onMouseOut=\"this.className='row2'\">(".$mode.")</td>";
                       } if($showtroublemakers == 1){
                       $temp .= "<td width=\"80\">&nbsp;</td>";
                       }
                       $temp .= "</tr>\n";
                     $BaseFileArray[] = $temp;
               } else {
                       $temp = "<tr><td onMouseOver=\"this.className='row1'\" onMouseOut=\"this.className='row2'\"><a href=\"".$dirfilename."\">".$dirfilename."</A></td>";
                       if($showunixstyle == 1){
                       $temp .= "<td width=\"120\" onMouseOver=\"this.className='row1'\" onMouseOut=\"this.className='row2'\">".$unixstyle."</td>";
                       } if($shownumeric == 1){
                       $temp .= "<td width=\"80\" onMouseOver=\"this.className='row1'\" onMouseOut=\"this.className='row2'\">(".$mode.")</td>";
                       } if($showtroublemakers == 1){
                       $temp .= "<td width=\"80\">&nbsp;</td>";
                       }
                       $temp .= "</tr>\n";
                     $FileArray[] = $temp;
                }                                                                                                                                           ;
            }
      }
}

$dir->close();
}
DirectoryListing("../../");

@sort($FileArray);
@reset($FileArray);

@sort($BaseFileArray);
@reset($BaseFileArray);
?>

<table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
<tr>
	<td class="row3">Files</td>
	<td class="row3">File Permissions</b></td>
	<td class="row3">CHMOD</td>
	<td class="row3">Error</td>
</tr>
<tr>
	<td>
<?php
while (list ($key, $val) = @each ($BaseFileArray)) {
    echo $val."\n";
}

while (list ($key, $val) = @each ($FileArray)) {
    echo $val."\n";
}
while (list ($key, $val) = @each ($DirArray)) {
    echo $val."\n";
}
?>
	</td>
</tr>
</table>
</body>
</html>
