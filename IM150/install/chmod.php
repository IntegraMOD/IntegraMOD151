<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables

// Version 2.02_beta by Evolver
// Version 0.13_beta
// Orignal script author: Fubie
// Big thanks to Ednique for setting up the multi lang support!
// This script will CHMOD all files for Integramod 1.4.0 according to the knowledge base
// article for a fresh install of Integramod located here
// http://www.integramod.com/home/kb.php?mode=article&k=21
// Use of this script is at your own risk.  I take no responsibility as to how this script is used.
// If you have questions about this script please ask them at http://geek.fubie.net

// ================================================================================================================================
// ================================================================================================================================
// Completely worked out by Evolver
// Not every server allows CHMOD by PHP command
// When your server is one of those, you would get a warning like chmod():
// Operation not permitted in /home/folder/public_html/forum/album_mod/upload on line 10

// There is a solution for this
// PHP can also do FTP tasks, and by using this routine, CHMOD will most likely not be a problem
// Ofcourse, then it will also need your personal FTP configuration and login information
// So it will be asking for these in a form if the FTP-method is used

// Not every server allows CHMOD by PHP command
// But believe it or not, there are also servers that don't allow CHMOD by FTP
// So for the highest chance of success, we'll keep using the original CHMOD routine by default if it works...
// And it's also nice not having to fill in the FTP settings if the normal routine works on your server
// ================================================================================================================================
// ================================================================================================================================

function page_header()
{

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $lang['ENCODING']; ?>">
<meta http-equiv="Content-Style-Type" content="text/css">
<title><?php echo $lang['Welcome_install'];?></title>
<link rel="stylesheet" href="../templates/fisubice/css/fisubice.css" type="text/css">
<!--[if IE]>
<link rel="stylesheet" href="../templates/fisubice/formIE.css" type="text/css">
<![endif]-->

</head>
<body bgcolor="#E5E5E5" text="#000000" link="#006699" vlink="#5584AA">

<table  width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td class="topbkg"  width="100%">
      <table cellpadding="0" cellspacing="0" align="center" class="bodyline">
        <tr>
          <td><a href="http://www.integramod.com" target="_blank"><img src="../images/spacer.gif" width="1" height="110" border="0"><img src="../images/logo/phpbb2_logo.png" width="504" height="110" border="0"></a></td>
        </tr>
      </table>
    </td>
  </tr>
</table>


<table  width="100%" border="0" cellspacing="0" cellpadding="10" align="center">
        <tr>
        <td class="bodyline" width="100%">

<?php

}





function page_footer()
{

?>
                </td>
    </tr>
</table>
<div align="center">
<br />
<font class="copyright"><strong><U>IntegraMOD 150 CHMOD script</U> Version 2.1.0</strong><br><br><em>Original script started by <strong>Fubie</strong>
<br />Multi language CHMOD-list support by <strong>Ednique</strong>
<br />Alternative FTP CHMOD-procedure, procedure visualisation, layout an additional features by <strong>Evolver</strong></em><br><br></font>
<a href="http://www.integramod.com" target="_blank"><img src="../images/banners/phpbbintegraMOD.jpg" width="470" height="62" border="0"></a><br>
</div>

</body>
</html>
<?php

}





function autodetect_install()  // Pre-install or after install?  Install directory detection
{
     $detection = "";
     $install = '/';
     $prillinstall = '../prill_install/';
     if (file_exists($install) !== false) {
        $preinstall = 1;
     }
     if (file_exists($prillinstall) !== false) {
        $preinstall = 1;
     }
     return $preinstall;
}

function chmodsettingsbox()  // Pre-install or after install?  Install directory detection
{
     $permissionstate = chmodlister("permissionstatus");
     $detection = "";
     $install = 'install/';
     $prillinstall = 'prill_install/';
     $configfile = "config.php";
     if (file_exists($install) !== false) {
        $preinstall = 1;
        $detection .= "<div align='center'><font  class='jadmincolor'><strong>install</strong></font><strong> detected</strong></div>";
     }
     if (file_exists($prillinstall) !== false) {
        $preinstall = 1;
        $detection .= "<div align='center'><font class='jadmincolor'><strong>prill_install</strong></font><strong> detected</strong></div>";
     }
     if ($preinstall) {
       $detection .= "<hr><div align='center' class='postdetails'>Selecting <strong>Pre-install</strong> Chmod settings for this process</div><hr>";
     }
     else{
       $detection .= "<div align='center'><strong>No</strong> <font class='jadmincolor'>install</font><strong> directories detected</strong></div><hr>";
       $detection .= "<div align='center' class='postdetails'>Selecting <strong>After-install</strong> Chmod settings for this process></div><hr>";
     }
  if ( $permissionstate == 1 ) {
    $detection .= "<div align='center' class='postdetails'>Files and Directories have already been set conform to <strong>Pre-install</strong> settings</div>";
  }
  if ( $permissionstate == 2 ) {
    $detection .= "<div align='center' class='postdetails'>Files and Directories have already been set conform to <strong>After-install</strong> settings</div>";
  }
     if (file_exists($configfile) !== false) {
        $configfilesize = size($configfile, 2, 'kb');
      //$configfilesize .= size($configfile, 3, 'mb');
      //$configfilesize .= size($configfile, 6, 'gb');
        $detection .= "<hr><div align='center'><font class='jadmincolor'><strong>$configfile</strong></font></div><div align='center' class='postdetails'>Size: ".$configfilesize." kb</div>";
        if ($configfilesize == 0) {
          $detection .= "<div align='center'><strong>NOT installed</strong></div>";
        }
        else {
          $detection .= "<div align='center'><strong>Installed</strong></div>";
        }
     }
     else {
       $detection .= "<hr><div align='center'><strong>Error:</strong></div><div align='center'>No <font class='foundercolor'><strong>config.sys</strong></font><strong> found</strong></div>";
     }

     box('Chmod settings', $detection);
}




function chmodtest($chmodmethod)
{
  global $testfile, $testmod, $normalchmod, $ftpchmod;
  if ($chmodmethod > 0) {
     return $chmodmethod;
  }
  else {

    // First things first...
    // Reading current permission of the file we are going to run tests on...
    // So it can be brought back to its original state after positive tests...
    $modbeforetest = substr(sprintf("%o",fileperms($testfile)),-3);
    //echo $modbeforetest;
    clearstatcache($testfile);

       // We are going to use the normal method as default
       // Selecting normal method for the chmod_routine function
       $chmodmethod = $normalchmod;
// But if the normal method fails, we'll use the FTP-method instead
// --------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------
// ---------CHMOD() TEST-----------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------


       // During this test, if it fails, a PHP WARNING would be displayed on the top of the page
       // Don't want that...the next command will switch it off to run the test without that annoying warning report
       ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );

       // 0 added for this chmod()-test with octdec()
       if ( chmod($testfile, octdec($testmod)) == false ) {

          // --------------------------------------------------------------------------------------------------------------------------------
          // ---------CHMOD() TEST Failed----------------------------------------------------------------------------------------------------
          // --------------------------------------------------------------------------------------------------------------------------------
          // Selecting FTP-method for the chmod_routine function
          $chmodmethod = $ftpchmod;
          // Switching error reporting back to default after CHMOD() test...
          ini_set ( 'error_reporting', E_ALL ^ E_NOTICE );

          $testcontents = "<div class='foundercolor' align='center'><strong>PHP CHMOD <br><u>not</u><br> permitted by server</strong></div><hr>";
          $testcontents .= "<div class='postdetails' align='center' ><strong><u>The alternative FTP procedure will be used</u></strong><br></div>";
                                                    


       }
       else { // PHP Chmod test was succesfull
// --------------------------------------------------------------------------------------------------------------------------------
// ---------CHMOD() TEST Successfull-----------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------

         // Switching error reporting back to default after CHMOD() test...
         ini_set ( 'error_reporting', E_ALL ^ E_NOTICE );
           chmod($testfile, octdec($modbeforetest));
           $testcontents = "<div class='jadmincolor' align='center'><strong>PHP CHMOD permitted by server</strong></div><hr>";
           $testcontents .= "<div class='postdetails' align='center'><strong>The normal CHMOD procedure will be used</strong><br><em>(no need for an FTP connection)<em></div>";

       }
// --------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------
// ---------END  -  CHMOD() TEST---------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------
 box('Chmodmethod', $testcontents);
 return $chmodmethod;
  }
}





function ftp_errortemplate($ftp_details, $ftpcheck, $servererror, $rooterror, $usererror, $passworderror, $othercause)
{
if (!isset($_POST['OK'])) { // if page is not submitted to itself echo the form
?>
<br><br>
<table width="510" align="center" cellpadding="3" cellspacing="0" bgcolor="#006699">
  <tr>
    <td><table width="100%" cellpadding="3" cellspacing="0" bgcolor="#FF0000">
        <tr>
          <td align="center"><strong><font color="#FFFF00" size="5" face="Arial, Helvetica, sans-serif">Wrong FTP settings</font></strong></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFCC"><table width="100%" cellspacing="0" cellpadding="3">
              <tr>
                <td align="right"><img src="../images/spacer.gif" width="100" height="1" border="0"></td>
                <td align="left"><img src="../images/spacer.gif" width="100" height="1" border="0"></td>
                <td align="right"><img src="../images/spacer.gif" width="130" height="1" border="0"></td>
                <td align="left"><img src="../images/spacer.gif" width="100" height="1" border="0"></td>
              </tr>

              <tr>
                <td align="right"><strong><font face="Geneva, Arial, Helvetica, sans-serif">Server Name:</font></strong></td>
<?php
              if ( $servererror ) { // marking error in colour
              echo "<td align='left' bgcolor='#FFE6E1'><font color='#000000' size='2' face='Geneva, Arial, Helvetica, sans-serif'>";
              }
              else { // No marking
              echo "<td align='left'><font color='#000000' size='2' face='Geneva, Arial, Helvetica, sans-serif'>";
              }
              echo $ftp_details['ftp_server'];
?>
                </font></td>
                <td align="right"> <p><strong><font face="Geneva, Arial, Helvetica, sans-serif">User Name:</font></strong></p></td>
<?php
              if ( $usererror ) { // marking error in colour
              echo "<td align='left' bgcolor='#FFE6E1'><font color='#000000' size='2' face='Geneva, Arial, Helvetica, sans-serif'>";
              }
              else { // No marking
              echo "<td align='left'><font color='#000000' size='2' face='Geneva, Arial, Helvetica, sans-serif'>";
              }
              echo $ftp_details['ftp_user_name'];
?>
                </font></td>
              </tr>
              <tr>
                <td align="right"><strong><font face="Geneva, Arial, Helvetica, sans-serif">Forum Root:</font></strong></td>
<?php
              if ( $rooterror ) { // marking error in colour
              echo "<td align='left' bgcolor='#FFE6E1'><font color='#000000' size='2' face='Geneva, Arial, Helvetica, sans-serif'>";
              }
              else { // No marking
              echo "<td align='left'><font color='#000000' size='2' face='Geneva, Arial, Helvetica, sans-serif'>";
              }
              echo $ftp_details['ftp_root'];
?>
                </font></td>
                <td align="right"><strong><font face="Geneva, Arial, Helvetica, sans-serif">User Password:</font></strong></td>
<?php
              if ( $passworderror ) { // marking error in colour
              echo "<td align='left' bgcolor='#FFE6E1'><font color='#000000' size='2' face='Geneva, Arial, Helvetica, sans-serif'>";
              }
              else { // No marking
              echo "<td align='left'><font color='#000000' size='2' face='Geneva, Arial, Helvetica, sans-serif'>";
              }
              echo $ftp_details['ftp_user_pass'];
?>
                </font></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td bgcolor="#FFCC66"><table align="center" cellpadding="5">
              <tr>
                <td><font face="Courier New, Courier, mono">
<?php

              echo $servererror;
              echo $rooterror;
              echo $usererror;
              echo $passworderror;
              echo $othercause;

?>
                </font></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table align="center" width="140" border="3" cellpadding="3" cellspacing="0" bgcolor="#CCCCCC">
<form method="post" action="<?php echo $PHP_SELF;?>">
<tr>
<td align="center" style="cursor: pointer; cursor: hand;">
<input type="submit" value="OK" name="OK">
</td>
</tr>
</form>
</table>
<?php
page_footer();
exit;
// Stops further procedure untill form has been submitted
}
  else {
       ftp_form($ftp_details, $ftpcheck);
  }
}





function ftp_form($ftp_details, $ftpcheck)
{
  global $ftp_details, $ftpcheck;
  if ($ftpcheck == 1 ) {
     return $ftp_details;
  }
  else {

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - FTP FORM  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

   // formvariables
   $ftp_details['ftp_server'] = $_POST["ftp_server"];
   $ftp_details['ftp_root'] = $_POST["ftp_root"];
   $ftp_details['ftp_user_name'] = $_POST["ftp_user_name"];
   $ftp_details['ftp_user_pass'] = $_POST["ftp_user_pass"];
   
       if (!isset($_POST['submit'])) { // if page is not submitted to itself echo the form

               // Attempting to forecast the FORUM ROOT to make things a little easier
               $pathslice = explode('/', getcwd());
               $numpathslice = count($pathslice);
               $rootforecast = ('/'.$pathslice[$numpathslice-2].'/'.$pathslice[$numpathslice-1].'/');
               
               // Attemting to forecast SERVER NAME
               $rootserverdomain = $_SERVER['HTTP_HOST'];
               $servernameforecast = str_replace("www.","",$rootserverdomain);
               


               // FTP settings form in HTML
               ?>
               <br><div align='center'><font face="Geneva, Arial, Helvetica, sans-serif">In order to use the FTP-procedure, your FTP settings are necessary to connect to the server<br>
               You can enter these settings here:</font><br><br>

               </div>

               <table align="center" cellpadding="3" cellspacing="0" bgcolor="#3399CC">
                 <tr>
                   <td><table cellpadding="4" cellspacing="0" bgcolor="#00CCFF">
                       <form method="post" action="<?php echo $PHP_SELF;?>">
                       <tr>
                         <td colspan="2" bgcolor="#3399CC"><font face="Geneva, Arial, Helvetica, sans-serif" color="#CBEBFE" size="5"><strong>FTP SETTINGS</strong></font></td>
                         <td width="1" rowspan="3" bgcolor="#3399CC"></td>
                         <td colspan="2" bgcolor="#3399CC"><font face="Geneva, Arial, Helvetica, sans-serif" color="#CBEBFE" size="5"><strong>FTP LOGIN</strong></font></td>
                         <td width="20%" rowspan="4" align="center" bgcolor="#00BDEC"> <input type="submit" value="submit" name="submit"></td>
                       </tr>
                       <tr> 
                         <td  align="right"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">Server Name:</font></td>
                         <td  align="left"> <input type="text" size="30" maxlength="35" name="ftp_server"
               <?php
                              echo "value='$servernameforecast'";
               ?>
               ></td>
                         <td  align="right"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">User Name:</font></td>
                         <td  align="left"> <input type="text" size="20" maxlength="35" name="ftp_user_name"></td>
                       </tr>
                       <tr> 
                         <td align="right"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">Forum Root:</font></td>
                         <td align="left"> <input type="text" size="30" maxlength="50" name="ftp_root" 
               <?php
                             echo "value='$rootforecast'";
               ?>
               ></td>
                         <td align="right"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">User Password:</font></td>
                         <td align="left"> <input type="password" size="20" maxlength="35" name="ftp_user_pass"></td>
                       </tr>
                       <tr>
                         <td colspan="5" bgcolor="#00BDEC"></td>
                       </tr>
                       </form>
                     </table></td>
                 </tr>
               </table>

               <br><div align='center'><font face="Geneva, Arial, Helvetica, sans-serif">This alternative CHMOD procedure can only start after submitting the correct data...
               <br>...and it will only work on the same server as where this script is running from</div></font><br>
               <?php


               page_footer();
               exit;
               // Stops further procedure untill form has been submitted
       }
       else {
       ftp_form_validation($ftp_details, $ftpcheck);
       }
  }
}





function ftp_form_validation($ftp_details, $ftpcheck)
{
global $testfile, $testmod, $modbeforetest;
//  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - FTP FORM VALIDATION - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
global $ftp_details, $ftpcheck;

          $servererror = '';
          $rooterror = '';
          $usererror = '';
          $passworderror = '';

          $connfailed = '';
          $fileismissing = '';
          $othercause = '';

// Testing if all fields have been completed in FTP settings form
          if ($ftp_details['ftp_server'] == "") {
            $servererror = 'You didn\'t enter a Server Name.<br>';
          }

          if ($ftp_details['ftp_root'] == "") {
            $rooterror = 'You didn\'t enter a Forum Root.<br>';
          }

          if ($ftp_details['ftp_user_name'] == "") {
            $usererror = 'You didn\'t enter a User Name.<br>';
          }

          if ($ftp_details['ftp_user_pass'] == "") {
            $passworderror = 'You didn\'t enter a Password.<br>';
          }

          $first_errormessage = $servererror.$rooterror.$usererror.$passworderror;

          if ( $first_errormessage ) {
// Errormessage 1: There's at least one field still empty ---------------------------------------
// Errortemplate
             $ftpcheck = 2;
             ftp_errortemplate($ftp_details, $ftpcheck, $servererror, $rooterror, $usererror, $passworderror, $othercause);
             exit;
// STOP after Errormessage 1 : There's at least one field still empty - - - - - - - - - - - - - - - - - - - - - - - -
          }



// Testing connection
            extract ($ftp_details);

            // During this test, if it fails, a PHP WARNING would be displayed on the top of the page
            // Don't want that...the next command will switch it off to run the test without that annoying warning report
            ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );

            // set up basic connection + detect errors
            $conn = ftp_connect($ftp_server) or $servererror = 'Could not connect to server...<br><strong>Wrong Server Name</strong>';

            // login with username and password + detect errors
            ftp_login($conn, $ftp_user_name, $ftp_user_pass) or $usererror = 'Connected to server ...<br>Login failed...<br><strong>Wrong User Name or Password</strong><br><br>Closing connection...<br>Connection closed.';

            if ( $usererror ) { // only this case, there was a connection AND a failure, the connection should be closed here
              $connfailed = 1;
              ftp_close($conn);
            }
            if ( $servererror ) { // in this case there's no connection anyway
              $connfailed = 1;
              $usererror = '';
              // Without connection, there will be a userlogin error as well, but then that would be because of a wrong servername
              // So the other reason (usererror) would have nothing to do with it
            }

            // Switching error reporting back to default after CHMOD() test...
            ini_set ( 'error_reporting', E_ALL ^ E_NOTICE );

            if ( $connfailed ) {
// Errormessage 2: Wrong entry, no connection to server  or wrong login-------------------------------
// Errortemplate for error 3
               $ftpcheck = 3;
               ftp_errortemplate($ftp_details, $ftpcheck, $servererror, $rooterror, $usererror, $passworderror, $othercause);
               exit;
// STOP after Errormessage 2: Wrong entry, no connection to server  or wrong login - - - - - - - - - - - - - - - - -
            }

// Testing Forum Root
              // CONNECTION ---------------------------------------
              // This test will only run after it passed Errorscan2 without problems
              // In that case, the FTP connection made for Errorscan2 hasn't been closed yet...
              // That's just wonderfull, because this connection will be used immediately for this 3rd Errorscan
              // CONNECTION----------------------------------------

              $isconnected = 'Connected to server ...<br>Logged in...<br>';


// Before this CHMODtest, I would've liked to add an existing files-check for ALL FILES to Chmod...
// ...in order to determine if we are in the right Forum ROOT
// But that's still possible in this version...
// We would need a complete file-array to do so...
// So, I've just marked this space with this message where I can add this option in a future version of this script...
// For now, I have chosen a testfile that you won't find on every directory with a script...
// All we can do, is an existing file check on that testfile only

              $missingfile = 'FILE found...<br>';
              // checking if file exist with a command to retrieve last file-modificationdate
              // If it fails (could be missing on some servers), try the filesize command instead
              // echo ftp_size($conn, $ftp_root.$testfile);
              if ( (ftp_mdtm($conn, $ftp_root.$testfile) == -1) ) {
                $missingfile = '<strong>FILE NOT FOUND</strong><br>';
                $fileismissing = '1';
              }

// I could've used config.php for the test
// But there's a lot of change that there's also a CONFIG.PHP on another directory where some other script resides
// And changing permissions there, could result in that other script malfunctioning...
// This could really happen when choosing a wrong ForumROOT where another script resides...
// Et's also very nice to have the ForumROOT predicted, so the chance for making that mistake becomes very small...


              // During this test, if it fails, a PHP WARNING would be displayed on the top of the page
              // Don't want that...the next command will switch it off to run the test without that annoying warning report
              ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );

              // try to FTP chmod $path directory -----------------
              // The FTP-method uses the 3-number mode (no '0' added here)
              // if (ftp_site($conn, 'CHMOD '.$testmod.' '.$ftp_root.$testfile) == false) {
              if (ftp_site($conn, 'CHMOD '.$testmod.' '.$ftp_root.$testfile) == false) {
              // -----------------------------------------------------------------------------------Errormessage 4: chmodtest----
              $chmodtesterror = $isconnected;
              $chmodtesterror.= '<br>This CHMOD procedure seems to be failing...<br><br>Most probable cause: <br>';
              $chmoderrorcause = '<br><strong>This procedure may not be working on your server</strong>';
              if ( $fileismissing ) {
                $chmoderrorcause = '<br><strong>Wrong Forum Root</strong> or missing file(s)';
              }

              // Switching error reporting back to default after negative FTP CHMOD test...
              ini_set ( 'error_reporting', E_ALL ^ E_NOTICE );
              // closing connection
              ftp_close($conn);

              $othercause.= $missingfile;
              $rooterror = $chmodtesterror;
              $othercause.= $chmoderrorcause;
              $othercause.= '<br><br>Closing connection...<br>Connection closed.';
// Errortemplate for error 3
              $ftpcheck = 4;
              ftp_errortemplate($ftp_details, $ftpcheck, $servererror, $rooterror, $usererror, $passworderror, $othercause);
              exit;
// STOP after Errormessage 3: Wrong Forum Root entered - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
              }



// Everything checked and OK now
              // Switching error reporting back to default after completely positive FTP CHMOD test...
              ini_set ( 'error_reporting', E_ALL ^ E_NOTICE );
                 // Putting testfile back to it's original state (so we can still see how it changes during the full process) and closing connection
                ftp_site($conn, 'CHMOD '.$modbeforetest.' '.$ftp_root.$testfile);
                ftp_close($conn);
                 $ftpcheck = 1;
                 clearstatcache($testfile);

// NOW...READY TO RUN THE FTP-CHMOD PROCESS






// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - END  -  FTP FORM VALIDATION - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
}


function fileicon($path)
{
$relpath = './';
// dir or fileicon begin
$dirimage = "<i class=\"fa fa-folder-open-o\"></i>";
$fileimage = "<i class=\"fa fa-file-text-o\"></i>";
// dir or fileicon end

// dir or fileicon begin
    if ( count(explode('.', $path)) !== 1 ){
    $fileicon = $fileimage;
    }
    else {
    $fileicon = $dirimage;
    }
// dir or fileicon end
return $fileicon;
}

function chmodmeaning($mod)
{
           $meaning = '';
           if ($mod == 600) $meaning = "Only the owner has read and write permissions";
           if ($mod == 644) $meaning = "Only the owner has read and write permissions; the group and others can read only";
           if ($mod == 664) $meaning = "The owner and the group have read and write permissions; others can read only";
           if ($mod == 700) $meaning = "Only the owner has read, write and execute permissions";
           if ($mod == 755) $meaning = "The owner has read, write and execute permissions; the group and others can only read and execute";
           if ($mod == 711) $meaning = "The owner has read, write and execute permissions; the group and others can only execute";
           if ($mod == 666) $meaning = "Everyone can read and write to the file";
           if ($mod == 777) $meaning = "Everyone can read, write and execute";
           if ($mod == 700) $meaning = "Only the user can read, write in this directory";
           if ($mod == 755) $meaning = "Everyone can read the directory, but its contents can only be changed by the user";
           return $meaning;
}

function chmod_routine($path, $mod, $chmodmethod, $ftp_details)   // Just to make the procedure visible
{

// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// -  --   CHMOD FUNCTION routine for both methods    --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
  $relpath = './';
  $fileicon = fileicon($path);
  $errorimage = "<i class=\"fa fa-exclamation-triangle fa-2x\" style=\"color:#FFEE00;margin-left:1em;\"></i>";
 

  $filename = "<font color='#6666CC' size='5'>$path</font>";
// This function holds the routine for both methods

  $modmeaning = chmodmeaning($mod);

if (file_exists($path) !== false) {

           $before = substr(sprintf("%o",fileperms($path)),-3);
           //clearstatcache($path);
           $beforemeaning = chmodmeaning($before);

           if ($mod == $before) {

           $result = "<p class='postdetails'><font><strong>OK</strong></font><br>Permission checked,<br>already been set to $mod</p>";
           $success=TRUE;

           }
           else {


// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// --  --   CHMOD FUNCTION routine for the original CHMOD() method    --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
    // The normal CHMOD method
    if ($chmodmethod == 1)
    {
      // 0 added for this routine with ecodec()
      if (chmod("$path", octdec($mod)) !== false) {
      //clearstatcache($path);

           // clear the cached fileinformation
           // otherwise, if the same file is being checked multiple times within a single script
           // checkresults will remain the same
           $result = "<p class='postdetails'><font color='#009900'><strong>Chmoded</strong></font><br>Permission changed to $mod</p>";
           $success=TRUE;
       }
       else {
           $result = "<p class='postdetails'><font color='#FF0000'><strong>FAILED!!!</strong></font><br>The normal Chmod() method doesn't seem to work on your system<br>Try the FTP method instead</p>";
           $success=FALSE;
       }
    }
    else
    {
// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// -  --   CHMOD FUNCTION routine for the FTP CHMOD method    --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
       // The FTP CHMOD method

       // extract ftp details (array keys as variable names)
       extract ($ftp_details);

       // set up basic connection
       $conn_id = ftp_connect($ftp_server);

       // login with username and password
       $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

       // try to chmod $path directory
       // The FTP-method uses the 3-number mode (no '0' added here)
       if (ftp_site($conn_id, 'CHMOD '.$mod.' '.$ftp_root.$path) !== false) {

           // clear the cached fileinformation
           // otherwise, if the same file is being checked multiple times within a single script
           // checkresults will remain the same
           clearstatcache($path);
           $result = "<p class='postdetails'><font color='#009900'><strong>Chmoded</strong></font><br>Permission changed to $mod</p>";
           $success=TRUE;

       }
       else {

           $result = "<p class='postdetails'><font color='#FF0000'><strong>FAILED!!!</strong></font><br>The ftp_site() chmodmethod doesn't seem to work on your system</p>";
           $success=FALSE;

       }

       // close the connection
       ftp_close($conn_id);

    }
  }

  $now = "<p title='$beforemeaning'><font color='#FF0000'><strong><strike>$before</strike></strong></font></p>";
  if ( $before == $mod ) $now = "<p title='$beforemeaning'><font color='#009900'>$before</font></p>";

  $after = "<p title='$modmeaning' class='maintitle'>$mod</p>";
  tableboxlist2($fileicon, $filename, $now, $after, $result);
       $mod = '';
       return $success;
 }

// file does not exist
  $filename .= $errorimage;
  $after = "<p title='$modmeaning' class='maintitle'>$mod</p>";
  $result = "<p class='postdetails'><font color='#FF0000'><strong>File doesn't seem to exist</strong></font><br>Files are missing,<br>or Chmodlist isn't up-to-date</p>";
  tableboxlist2($fileicon, $filename, "N/A", $after, $result);
       $mod = '';


// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// -  --  -END    CHMOD FUNCTION routine for both methods --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
// -  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  --  -
}





function chmoder ()   // Just to make the procedure visible
{
global $afterinstall_list, $preinstall_list, $preinstall, $chmodmethod, $ftp_details;

$title = "File / Directory";
$title2 = "Before";
$title3 = "Should be";
$title4 = "Results";


  $explain = "test";
  tableboxtitle2($title, $title2, $title3, $title4, $explain);


//---------------------------------------------------------------
if ( $preinstall ) {
  $checkmod = 666;
  foreach($preinstall_list as $path => $mod)
  {
    chmod_routine($path, $mod , $chmodmethod, $ftp_details);
  }
}
else {
  $checkmod = 664;
  foreach($afterinstall_list as $path => $mod)
  {
    chmod_routine($path, $mod , $chmodmethod, $ftp_details);
  }
}
//---------------------------------------------------------------
$checkfile = 'config.php';
// $checkmod set for preinstall & else
//clearstatcache($checkfile);



tableboxend2();
}


function chmodlister($list) {
global $preinstall_list, $afterinstall_list;

if ($list !== "permissionstatus") {
  echo "<font class='maintitle' color='#663399' >Chmod check</font><br>";
  echo "<br>";
}

$filenumber = count($preinstall_list);
$premodcheck = $filenumber;
$aftermodcheck = $filenumber;
$nofilechmod = "---";
$prereport = "";
$afterreport = "";
$predifference = [];
$afterdifference = [];

  foreach($preinstall_list as $path => $mod)
  {
      $prepath[] = $path;
      $premod[] = $mod;
      $premodmeaning[] = chmodmeaning($mod);
      $fileicon[] = fileicon($path);

    if (file_exists($path) !== false) {
  	  $relpath = './';
      // controleren van de werkelijke permissies
      $now = substr(sprintf("%o",fileperms($relpath.$path)),-3);
      //clearstatcache($relpath.$path);
      $modnow[] = $now;
      $nowmodmeaning[] = chmodmeaning($now);
    }
    else {
      $modnow[] = $nofilechmod;
      $nowmodmeaning[] = "";
    }
}

  foreach($afterinstall_list as $path => $mod)
  {
        $afterpath[] = $path;
        $aftermod[] = $mod;
        $aftermodmeaning[] = chmodmeaning($mod);
  }


if ($prepath == $afterpath) {

     // chmod status check
   $chmodcheck = "";
   for($e = 0; $e < $filenumber; $e++){
     if ( $modnow[$e] == $premod[$e] ) {
       $premodcheck--;
     }
     else $predifference[] = $e;
     if ( $modnow[$e] == $aftermod[$e] ) {
       $aftermodcheck--;
     }
     else $afterdifference[] = $e;
   }

  if ($predifference) {
    $prereport .= "<div align='center' class='maintitle'>Not ready for installation !</div>";
    $prereport .= "<strong><u>These file-permissions are different:</u></strong><br>";
  foreach($predifference as $number)
    {
      if ( $modnow[$number] !== $nofilechmod ) {
        $prereport .= "$fileicon[$number]<font color='#6666CC'>$prepath[$number]</font> -- has permission <font color='#FF0000'><strong>$modnow[$number]</strong></font> while it should be <font color='#009900'><strong>$premod[$number]</strong></font><br>";
      }
      else {
        $prereport .= "$fileicon[$number]<font color='#6666CC'>$prepath[$number]</font> -- <font color='#FF0000'><strong>not found on server</strong></font><br>";
      }
      unset($number);
    }
  }
  else {
    $ready = 1;
    $prereport .= "<div align='center' class='maintitle'>Ready for installation</div>";
    $prereport .= "<div align='center' class='postdetails'><strong>Pre-install settings confirmed</strong></div>";
  }

  if ($afterdifference) {
    $afterreport .= "<div align='center' class='maintitle'>Not ready for use !</div>";
    $afterreport .= "<strong><u>These file-permissions are different:</u></strong><br>";
  foreach($afterdifference as $number)
    {
      if ( $modnow[$number] !== $nofilechmod ) {
        $afterreport .= "$fileicon[$number]<font color='#6666CC'>$afterpath[$number]</font> -- has permission <font color='#FF0000'><strong>$modnow[$number]</strong></font> while it should be <font color='#009900'><strong>$aftermod[$number]</strong></font><br>";
      }
      else {
        $afterreport .= "$fileicon[$number]<font color='#6666CC'>$prepath[$number]</font> -- <font color='#FF0000'><strong>not found on server</strong></font><br>";
      }
      unset($number);
    }
  }
  else {
    $ready = 2;
    $afterreport .= "<div align='center' class='maintitle'>Ready for use</div>";
    $afterreport .= "<div align='center' class='postdetails'><strong>After-install settings confirmed</strong></div>";
  }

$title1 = "Ready for Installation?";
$title2 = "Ready for use?";
$report1 = $prereport;
$report2 = $afterreport;
  // chmod status check end




     $errorimage = "<i class=\"fa fa-exclamation-triangle fa-2x\" style=\"color:#FFEE00;margin-left:1em;\"></i>";


if ($list !== "permissionstatus") tableboxtitle3("Now", "File / Directory", "Pre", "After");
   for($i = 0; $i < $filenumber; $i++){
     $contents1 = "<p title='$nowmodmeaning[$i]' class='maintitle'>$modnow[$i]</p>";
     $contents2 = $fileicon[$i];
     if ( $modnow[$i] == $nofilechmod ) $contents3 = "<font color='#FF0000'>$prepath[$i] $errorimage</font>";
     else $contents3 = "<font color='#6666CC'>$prepath[$i]</font>";
     $contents4 = "<p title='$premodmeaning[$i]' class='maintitle'>$premod[$i]</p>";
     $contents5 = "<p title='$aftermodmeaning[$i]' class='maintitle'>$aftermod[$i]</p>";
     $row1 = "forumline";
     $row2 = "forumline";
     if ($modnow[$i] == $premod[$i]) $row1 = "errorline";
     if ($modnow[$i] == $aftermod[$i]) $row2 = "errorline";

     if ($list !== "permissionstatus") tableboxlist3($contents1, $contents2, $contents3, $contents4, $contents5, $row1, $row2);
   }
if ($list !== "permissionstatus") tableboxend3();


if ($list == "pre" or $list == "") box($title1, $report1);
if ($list == "after" or $list == "") box($title2, $report2);
if ($list == "permissionstatus") return $ready;

}
else {
$ERROR_MESSAGE = "Pre-chmodlist can not be compared with after-chmodlist";
errormessage($ERROR_MESSAGE);
}
}


function RecurseDir($directory) {
    $thisdir = array("name", "struct");
    $thisdir['name'] = $directory;
    if ($dir = @opendir($directory)) {
      $i = 0;
      while ($file = readdir($dir)) {
        if (($file != ".")&&($file != "..")) {
          $tempDir = $directory."/".$file;
          if (is_dir($tempDir)) {
            $thisdir['struct'][] = RecurseDir($tempDir,$file);
          } else {
            $thisdir['struct'][] = $file;
          }
          $i++;
        } 
      } 
      if ($i == 0) {
        // empty directory
        $thisdir['struct'] = -2;
      }
    } else {
      // directory could not be accessed
      $thisdir['struct'] = -1;
    }
    return $thisdir;
}


function dircontents($directory) {
global $dirscan;

    $thisdir = array("name", "struct");
    $thisdir['name'] = $directory;
        $dirscan[dirs][] = $directory;
    if ($dir = @opendir($directory)) {
      $i = 0;
      while ($file = readdir($dir)) {
        if (($file != ".")&&($file != "..")) {
          $tempDir = $directory."/".$file;
          if (is_dir($tempDir)) {
            $thisdir['struct'][] = dircontents($tempDir,$file);
          } else {
            $thisdir['struct'][] = $file;
            $dirscan[files][] =  $directory."/".$file;
          }
          $i++;
        } 
      } 
      if ($i == 0) {
        // empty directory
        $thisdir['struct'] = -2;
      }
    } else {
      // directory could not be accessed
      $thisdir['struct'] = -1;
    }
}





function remove_dir($dir) {
  $handle = opendir($dir);
  while (false!==($item = readdir($handle))) {  
    if($item != '.' && $item != '..') {
      if(is_dir($dir.'/'.$item)) {
               remove_dir($dir.'/'.$item);
           } else {
        unlink($dir.'/'.$item);
           }
       }
  }
  closedir($handle);
  if(rmdir($dir)) {
       $success = true;
  }
  return $success;
}


function size($sFile, $sDecimal, $sFormat="kb")
{
  switch($sFormat)
  {
    case "kb":
      $iDelen = 1024;
    break;
    case "mb":
      $iDelen = 1048576;
    break;
    case "gb":
      $iDelen = 1073741824;
    break;
  }
  $iBytes = filesize($sFile);
  $sRet = $iBytes/$iDelen;
  $sRet = round($sRet, $sDecimal);
  return $sRet;
}

//echo 'Grootte: '.size("films/jump1.wmv", 2, 'kb').' kb<br>';
//echo 'Grootte: '.size("films/jump1.wmv", 3, 'mb').' Mb<br>';
//echo 'Grootte: '.size("films/jump1.wmv", 6, 'gb').' Gb';


function chmodcalculator()
{
?>
<script type="text/javascript">
<!--


/* chmod helper, Version 1.0
 * by Dan Kaplan <design@abledesign.com>
 * Last Modified: May 24, 2001
 * --------------------------------------------------------------------
 * Inspired by 'Chmod Calculator' by Peter Crouch:
 * http://wsabstract.com/script/script2/chmodcal.shtml
 *
 * USE THIS LIBRARY AT YOUR OWN RISK; no warranties are expressed or
 * implied. You may modify the file however you see fit, so long as
 * you retain this header information and any credits to other sources
 * throughout the file.  If you make any modifications or improvements,
 * please send them via email to Dan Kaplan design.at.abledesign.com.
 * --------------------------------------------------------------------
*/

function do_chmod(user) {
	var field4 = user + "4";
	var field2 = user + "2";
	var field1 = user + "1";
	var total = "t_" + user;
	var symbolic = "sym_" + user;
	var number = 0;
	var sym_string = "";

	if (document.chmod[field4].checked == true) { number += 4; }
	if (document.chmod[field2].checked == true) { number += 2; }
	if (document.chmod[field1].checked == true) { number += 1; }

	if (document.chmod[field4].checked == true) {
		sym_string += "r";
	} else {
		sym_string += "-";
	}
	if (document.chmod[field2].checked == true) {
		sym_string += "w";
	} else {
		sym_string += "-";
	}
	if (document.chmod[field1].checked == true) {
		sym_string += "x";
	} else {
		sym_string += "-";
	}

	if (number == 0) { number = ""; }
	document.chmod[total].value = number;
	document.chmod[symbolic].value = sym_string;

	document.chmod.t_total.value = document.chmod.t_owner.value + document.chmod.t_group.value + document.chmod.t_other.value;
	document.chmod.sym_total.value = "-" + document.chmod.sym_owner.value + document.chmod.sym_group.value + document.chmod.sym_other.value;
}
//-->
</script>

<form name="chmod">
<table align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#03075D"><tr><td width="100%" valign="top"><table width="100%" cellpadding="5" cellspacing="2" border="0"><tr><td width="100%" bgcolor="#52847B" align="center" colspan="5"><font color="#ffffff" size="3"><b>chmod (File Permissions) helper</b></font></td></tr>
	<tr bgcolor="#bcbcbc">
		<td align="left"><b>Permission</b></td>
		<td align="center"><b>Owner</b></td>
		<td align="center"><b>Group</b></td>
		<td align="center"><b>Other</b></td>
		<td bgcolor="#dddddd" rowspan="4"> </td>
	</tr><tr bgcolor="#dddddd">
		<td align="left" nowrap><b>Read</b> (r = 4)</td>
		<td align="center" bgcolor="#ffffff"><input type="checkbox" name="owner4" value="4" onclick="do_chmod('owner')"></td>
		<td align="center" bgcolor="#ffffff"><input type="checkbox" name="group4" value="4" onclick="do_chmod('group')"></td>
		<td align="center" bgcolor="#ffffff"><input type="checkbox" name="other4" value="4" onclick="do_chmod('other')"></td>
	</tr><tr bgcolor="#dddddd">
		<td align="left" nowrap><b>Write</b> (w=2)</td>
		<td align="center" bgcolor="#ffffff"><input type="checkbox" name="owner2" value="2" onclick="do_chmod('owner')"></td>
		<td align="center" bgcolor="#ffffff"><input type="checkbox" name="group2" value="2" onclick="do_chmod('group')"></td>
		<td align="center" bgcolor="#ffffff"><input type="checkbox" name="other2" value="2" onclick="do_chmod('other')"></td>
	</tr><tr bgcolor="#dddddd">
		<td align="left" nowrap><b>Execute</b> (x=1)</td>
		<td align="center" bgcolor="#ffffff"><input type="checkbox" name="owner1" value="1" onclick="do_chmod('owner')"></td>
		<td align="center" bgcolor="#ffffff"><input type="checkbox" name="group1" value="1" onclick="do_chmod('group')"></td>
		<td align="center" bgcolor="#ffffff"><input type="checkbox" name="other1" value="1" onclick="do_chmod('other')"></td>
	</tr><tr bgcolor="#dddddd">
		<td align="right" nowrap>Octal:</td>
		<td align="center"><input type="text" name="t_owner" value="" size="1"></td>
		<td align="center"><input type="text" name="t_group" value="" size="1"></td>
		<td align="center"><input type="text" name="t_other" value="" size="1"></td>
		<td align="left"><b>=</b> <input type="text" name="t_total" value="" size="3"></td>
	</tr><tr bgcolor="#dddddd">
		<td align="right" nowrap>Symbolic:</td>
		<td align="center"><input type="text" name="sym_owner" value="" size="3"></td>
		<td align="center"><input type="text" name="sym_group" value="" size="3"></td>
		<td align="center"><input type="text" name="sym_other" value="" size="3"></td>
		<td align="left"><b>=</b> <input type="text" name="sym_total" value="" size="10"></td>
	</tr><tr bgcolor="#dddddd"><td colspan="5" align="center">
		<font face="Arial" size="1">Provided free by <a href="http://abledesign.com/programs/" target="_blank">AbleDesign</a>, inspired by <a href="http://wsabstract.com/script/script2/chmodcal.shtml" target="_blank">Chmod Calculator</a></font>
	</td></tr>
</table></td></tr></table>
</form><br>
<?php
}



// -------- FILES TO PROCESS ------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------
// The original script has been modified here
// Arrays are used to enable the use of more than one function on them
// The CHMOD mode has been changed to 3 numbers, because that's the way it works for the FTP method
// For the normal method '0' will be added by the chmod_routine function
// --------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------

//define('IN_PHPBB', true);
include('./chmodlist.php');
chmodlist();
global $chmodmethod, $normalchmod, $ftpchmod, $testfile, $testmod, $ftpcheck, $modbeforetest, $preinstall, $preinstall_list, $afterinstall_list;

// So we have 2 methods
$chmodmethod = 0;
$normalchmod = 1;
$ftpchmod = 2;

// File that will be used for testing
$testfile = '../includes/phpbb_security.php';
$testmod = 666;

$ftpcheck = 0;

// Reading current Chmod-scipt filename
// Will be needed for a link to reopen page after error...
// So renaming the scriptfile remains possible
$fileslice = explode('/', $_SERVER['SCRIPT_FILENAME']);
$numfileslice = count($fileslice);
$scriptfilename = $fileslice[$numfileslice-1];




// Test
//$referer ="$HTTP_REFERER ";
//echo $referer;




page_header();

menuatart();

// This will give us the possibility to call a process from an other script
$process = array(
   'welcome',
   'chmodcheck',
   'preinstall',
   'afterinstall',
   'info',
   'delcache',
   'delinstall',
   'install');

if ( (int)$_GET['page'] < count($process) ) {
  $call = (int)$_GET['page'];
}
else {
  $call = 0;
}
$processcall = $process[$call];
//echo $processcall;

if ($processcall) {
   if ($processcall == 'welcome') {
      $preinstall = autodetect_install();
?>
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
		<tr>
			<th>Thank you for choosing <b>IntegraMOD</b></th>
		</tr>
		<tr>
			<td class="row1"><span class="gen">This step will check your file permissions and <a href="chmod.php?page=4">chmod</a> files and folders as necessary.</span></td>
		</tr>
		<tr>
			<td class="row2"><span class="gen">Please make a choice from the menu on the left or click here:</span></td>
		</tr>
    <tr>
      <td class="row1"><span class="gen">
       <a href="./install.php"><b>Install now</b></a>
      </span></td>
    </tr>
	</table>


<?php
      $permissionstate = chmodlister("permissionstatus");
//    echo $permissionstate ;
   }
   if ($processcall == 'chmodcheck') {
      chmodlister("");
   }
   if ($processcall == 'preinstall') {
      $preinstall = 1;
      echo "<font class='maintitle' color='#663399' >Pre-install Chmod</font><br>";
      echo "<br>";
      $title = "Pre-install Chmod settings selected for this process";
      $contents = "These settings are needed <u><strong>before</strong> installation</u>.<br><br><span class='postdetails'><strong><u>Note:</u></strong><br>The installationprocess needs extra permissions to some files in order to prepare them.<br>After installation, some permissions have to be changed back for security reasons.</span>";
      $contents .= "<br><br>";
      box($title, $contents);

      if ($chmodmethod == 2) ftp_form($ftp_details, $ftpcheck);
      //ftp_form($ftp_details, $ftpcheck);
      chmoder ();

      $title = "Ready to start install?";
      $contents = "Only when all files have the correct permissions, you can start the installation.<br><br><span class='postdetails'>(Hier komt nog een controle, maar daar wordt nog aan gewerkt. Ik zou hier ook een directe link naar de <u>installer</u> aan toe willen voegen, die enkel opdaagt als de controle postief is)</span>";
      box($title, $contents);
      chmodlister("pre");
   }
   if ($processcall == 'afterinstall') {
      echo "<font class='maintitle' color='#663399' >After-install Chmod</font><br>";
      echo "<br>";
//      echo "Selecting after-install Chmod settings for this process<br><br>";

      $title = "After-install Chmod settings selected for this process";
      $contents = "These settings are needed <u><strong>after</strong> installation</u>.<br><br><span class='postdetails'><strong><u>Note:</u></strong><br>The installationprocess needed extra permissions to some files in order to prepare them.<br>After installation, these permissions have to be changed back <strong>for security reasons</strong>.<br>Only a few files are involved, but the after-install chmoder will check the others as well.</span>";
      $contents .= "<br><br>This will also be helpfull for <u>replaced backups and moved sites</u>.";
      box($title, $contents);

      if ($chmodmethod == 2) ftp_form($ftp_details, $ftpcheck);
      //ftp_form($ftp_details, $ftpcheck);
      chmoder ();
      
      $title = "Installation complete and safe?";
      $contents = "Only when all files have the correct permissions, your installation will be secure and functional.<br><br><span class='postdetails'>(Hier komt nog een controle, maar daar wordt nog aan gewerkt. Ik zou hier ook een directe link naar de <u>index</u> aan toe willen voegen, die enkel opdaagt als de controle postief is)</span>";
      box($title, $contents);
      chmodlister("after");
   }
   if ($processcall == 'info') {
      $preinstall = autodetect_install();
      echo "<font class='maintitle' color='#663399' >What is chmod?</font><br>";
      echo "<br>";

      $title = "CHMOD - What is it?";
      $contents = "Chmod stands for Change Mode. Basically it tells the server what the file or folder permissions are, ie. can the script read the info, or can it write information as well.<br>";
      $contents .= "<br>Some files or folders of integraMOD need to be given the right permissions to work properly. Giving permissions to files or folders in Unix world is called chmod. So chmod is a Unix command that lets you tell the system how much or little access it should be permitted to a file.";
      box($title, $contents);

      $title = "CHMOD only works on <b>LINUX</b> systems!";
      $contents = "<div align='center'>Both <font class='jadmincolor'>Linux</font> and <font class='admin'>Windows</font> come in desktop and server editions.<br>";
      $contents .= "<br><font class='admin'>There is no such thing as CHMOD in WINDOWS.</font><br>CHMOD only works with <font class='jadmincolor'>Apache on a Unix, Linux</font> system.<br>";
      $contents .= "<br><font size='24' class='jadmincolor'>I can only recommend using a LINUX-server!</font></div>";

      $contents .= "<br><br><font class='maintitle' color='#663399'>Why not on Windows-servers?</font><br>";
      $contents .= "<br><font class='admin'>Windows can't distinguish between user/group/other </font><font class='jadmincolor'>the way it is done in UNIX-filesystems</font><font class='admin'>. Therefore, they always match the <u>individual</u> permissions.</font>";
      $contents .= "<br>And if you don't have admin rights, you will have to ask the server administrator to change permissions for you, there is no standard way for clients to change permissions remotely. <font class='admin'>Windows does not support FTP CHMOD</font> and setuid solutions are much rarer there.<br>";
      $contents .= "<br>Unless the filesystem is <font class='admin'>NTFS</font> then permissions aren't going to come into play at all. If you're using <font class='admin'>Fat32</font>, then every file on the system is essentially <u>chmod 777</u>.";
      $contents .= "<br>On <font class='admin'>Windows systems</font>, most of the permissions shown are artificial, with <u>no real meaning</u>. The <b>w</b> bit is set according to the ReadOnly attribute, and the <b>rx</b> bits are always set on.<br>";

      $contents .= "<br><br><font class='maintitle' color='#663399'>Why use Linux as server?</font><br>";
      $contents .= "<br>The <font class='jadmincolor'>UNIX/Linux commands</font> that are offered are <u>far more powerful</u> than those offered by <font class='admin'>MS Windows</font>.<br>There are more options in <font class='jadmincolor'>UNIX/Linux</font>.<br>For example,  switches are case sensitive, so you can have even more switches than in <font class='admin'>MS Windows</font>, as <u><font class='admin'>MS Windows</font> is not case sensitive</u>.<br>This is just a minor comparison and contrast between <font class='jadmincolor'>UNIX/Linux</font> and <font class='admin'>MS Windows</font>.<br>";

      $contents .= "<br><br><font class='maintitle' color='#663399'>Why recommend Linux as server?</font><br>";
      $contents .= "<br>There are several cases where a flaw in <b>Apache</b> poses <u>little or no danger on <font class='jadmincolor'>Linux</font></u>, but is <u>a serious vulnerability on <font class='admin'>Windows</font></u>. The reverse is rarely, if ever, the case.<br>";
      $contents .= "Should the overall security ranking of <font class='admin'>Windows</font> suffer because it is more adversely affected than <font class='jadmincolor'>Linux</font> when using software that is most commonly associated with <font class='jadmincolor'>Linux</font>?<br>";
      $contents .= "<br>But even the most critical differentiating factor between the two operating systems, is all about <b>security</b>.";
      $contents .= "<br><u><font class='admin'>Windows</font> encourages you to use the familiar interface</u>, which means administering <font class='admin'>Windows Server 2003</font> at the server itself.";
      $contents .= "<br><u><font class='jadmincolor'>Linux</font> does not rely on or encourage local use of a graphical interface</u>, in part because it is an <b>unnecessary waste of resources</b> to run a graphical desktop at the server, and in part <b>because it increases security risks at the server</b>.";
      $contents .= "<br>For example, any server that encourages you to use the graphical interface at the server machine also invites you to perform similar operations, such as use the browser at the server. This exposes that server to any browser security holes. <u>Any server that encourages you to administer it remotely removes this risk</u>.";
      $contents .= "<br>If you administer a <font class='jadmincolor'>Linux server</font> remotely from a desktop user account, a browser flaw exposes only the remote desktop user account to security holes, not the server. This is why <u>a browser security hole in <font class='admin'>Windows Server 2003</font> is potentially more serious</u> than a browser security hole in Red Hat Enterprise Server AS.<br>";

      $contents .= "<br><br><font class='maintitle' color='#663399'>Advantages of Linux.</font><br>";
      $contents .= "<br><b>Speed, efficiency and reliability</b> are all <u>increased</u> by running a server instance of <font class='jadmincolor'>Linux without a GUI</font>, something that server versions of <u><font class='admin'>Windows</font> can not do</u>.<br>";
      $contents .= "<br>";
      $contents .= "<br>";


      box($title, $contents);

      $title = "What do the Chmod Settings Mean?";
      $contents = "Chmod tells the server the <u>access privileges for a file</u>. For example, common file settings are:<br><br>";
      $contents .= "<table align='center'>";
      $contents .= "<tr><td class='jadmincolor'><b>777</b>: </td><td>all can read / write / execute the file.</td></tr>";
      $contents .= "<tr><td class='jadmincolor'><b>755</b>: </td><td>owner can do all, group / others can read / execute.</td></tr>";
      $contents .= "<tr><td class='jadmincolor'><b>644</b>: </td><td>owner can read / write, group / others can read only.</td></tr>";
      $contents .= "</table>";
      $contents .= "<br><a href='http://www.analysisandsolutions.com/code/chmod.htm' target='_blank'>chmod Tutorial</a><br>";
      $contents .= "<br>Using the numbering scheme, the chmod command has three number places,<br>for example <font class='jadmincolor'>744</font>, representing the three user types.<br>The first number on the left side is for '<font class='jadmincolor'><b>user</b></font>', the middle one is for '<font class='jadmincolor'><b>group</b></font>' and the right hand one for '<font class='jadmincolor'><b>other</b></font>'. Now, here's what each number does:<br>";
      $contents .= "<table align='center'>";
      $contents .= "<tr><td class='jadmincolor'><b>0</b></td><td> --- </td><td>no access</td></tr>";
      $contents .= "<tr><td class='jadmincolor'><b>1</b></td><td> --x </td><td>execute</td></tr>";
      $contents .= "<tr><td class='jadmincolor'><b>2</b></td><td> -w- </td><td>write</td></tr>";
      $contents .= "<tr><td class='jadmincolor'><b>3</b></td><td> -wx </td><td>write and execute</td></tr>";
      $contents .= "<tr><td class='jadmincolor'><b>4</b></td><td> r-- </td><td>read</td></tr>";
      $contents .= "<tr><td class='jadmincolor'><b>5</b></td><td> r-x </td><td>read and execute</td></tr>";
      $contents .= "<tr><td class='jadmincolor'><b>6</b></td><td> rw- </td><td>read and write</td></tr>";
      $contents .= "<tr><td class='jadmincolor'><b>7</b></td><td> rwx </td><td>read write execute (full access)</td></tr>";
      $contents .= "</table>";
      box($title, $contents);

      chmodcalculator();

      $title = "Chmod - How?";
      $contents = "An FTP client is often used for such task. Depending on the FTP client you are using, chmod is usually available through Menus or by simply clicking the right mouse button when hovering over a file/folder and choosing the (chmod/property) item. Then checking properties or entering the corresponding chmod numbers in that dialogue.";
      $contents .= "<br>But when there are many files/directories to chmod, like with integraMOD, it can take some time to do it that way and mistakes can happen.";
      $contents .= "<hr>This chmoder-script will do it automatically for you.";
      $contents .= "<br>2 PHP commands are used:";
      $contents .= "<div align='center'><br><br><font class='admin'><u><b>Chmod()</b></u></font>";
      $contents .= "<br><font class='gensmall'> This will only work if you are <u>authorized</u> as the owner, ";
      $contents .= "but on some servers, only the host is the owner.</font>";
      $contents .= "<br><br><font class='admin'><u><b>ftp_site(connection, CHMOD)</b></u></font>";
      $contents .= "<br><font class='gensmall'>This will work for everybody, but as always with FTP, name and password are required.</font></div><br><br>";
      $contents .= "For maximum comfort, the second method will only be used if the first one fails.";
      $contents .= "<br>Username and password will only be asked for, when needed.";
      box($title, $contents);


   }
   if ($processcall == 'delcache') {
      echo "<font class='maintitle' color='#663399' >Delete cache directories</font><br>";
      echo "<br>";

      cachedelete(testdir);
   }
   if ($processcall == 'delinstall') {
      $preinstall = autodetect_install();
      echo "<font class='maintitle' color='#663399' >Delete install directories</font><br>";
      echo "<br>";
   }
   if ($processcall == 'install') {
      $preinstall = autodetect_install();
      echo "<font class='maintitle' color='#663399' >Installation</font><br>";
      echo "<br>";
      echo "<table width='100%' cellpadding='0' cellspacing='1' border='0' class='forumline'><tr><td>";
      echo "<IFRAME SRC='./install.php' WIDTH='100%' HEIGHT='780' FRAMEBORDER='0'></IFRAME>";
      echo "</td></tr></table><table border='0' cellpadding='2' cellspacing='0' class='tbl'><tr><td class='tbll'></td><td class='tblbot'></td><td class='tblr'></td></tr></table><br />";
   }
}


//test
//cachechmod
//ftp_form($ftp_details, $ftpcheck);
//cachechmod(testdir);


//$ERROR_MESSAGE = "dit is een test";
//errormessage($ERROR_MESSAGE);

//bigtest();


menuend();

function bigtest() {
$testingfile = 'config.php';

$testing = substr(sprintf("%o",fileperms($testingfile)),-3);
echo $testing;
clearstatcache($testingfile);
echo $testing;
}
function menuitem($items, $sel=0, $atts=""){
	$menucode = '<select '.trim($atts).'>';
	foreach ($items as $key => $choice){
		$menucode .= ('<option value="'.$choice.'"');
		if ($key == $sel){
			$menucode .= ' selected';
		}
		$menucode .= ('>'.$choice);
	}
	$menucode .= '</select>';
	return $menucode;
}

function menuatart() {
?>
<table width="100%" cellspacing="0" cellpadding="3">
<tr>
<td width="180" valign="top">
<?php
global $chmodmethod, $normalchmod, $ftpchmod, $testfile, $testmod, $modbeforetest;
       
// Detecteer Windows of Linux  
PHP_OS == 'Linux' ? $nolinux = ''  :  $nolinux = 1;
$system = "<div align='center'><font class='jadmincolor'><strong>Linux</strong></font><strong> detected</strong></div><hr><div align='center' class='postdetails'><strong>permissions need to be set on this system</strong></div>";
if ($nolinux) $system = "<div align='center'><font class='foundercolor'><strong>No linux</strong></font> <strong>detected</strong><hr><div align='center' class='postdetails'><strong>no permissions to set on this system</strong></div>";

box('System', $system);

  $process = array(
   'Welcome', 
   'Check permissions',
   'Pre-install Chmod',
   'After-install Chmod',
   'What is chmod?',
   'Delete cache files',
   'Delete install dirs',
   '<a href="./install.php">Install now</a>');

  $title = "Menu";
  $inside = "";
  $preinstall = autodetect_install();

  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=0\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i>$process[0]</a><br>";

  $inside .= "<hr>";
if ($nolinux) {
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=1\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i><strike>$process[1]</strike><br>";
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=2\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i><strike>$process[2]</strike></a><br>";
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=3\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i><strike>$process[3]</strike></a><br>";
  $inside .= "<div  align='center' class='admin'><strong>(no linux)</strong></div>";
}
else if ($preinstall) {
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=1\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i>$process[1]</a><br>";
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=2\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i><strong>$process[2]</strong></a><br>";
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=3\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i><strike>$process[3]</strike></a><br>";
}
else {
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=1\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i>$process[1]</a><br>";
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=2\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i><strike>$process[2]</strike></a><br>";
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=3\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i><strong>$process[3]</strong></a><br>";
}
  $inside .= "<hr>";
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=4\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i>$process[4]</a><br>";
  $inside .= "<hr>";
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=5\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i>$process[5]</a><br>";
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=6\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i>$process[6]</a><br>";
  $inside .= "<hr>";
  $inside .= "<a href=\"" . basename($_SERVER['PHP_SELF']) . "?page=7\"><i class=\"fa fa-circle-o\" style=\"vertical-align:text-bottom;margin-right:.5em;\"></i>$process[7]</a><br>";


box($title, $inside);



chmodsettingsbox();

$chmodmethod = chmodtest($chmodmethod);
//echo $chmodmethod;
?>
</td>
<td valign="top">
<?php

}

function menuend() {
?>
</td>
</tr>
</table>
<?php
}


function cachechmod($directory) {
  global $chmodmethod, $ftp_details, $dirscan;

  dircontents($directory);
  foreach($dirscan[dirs] as $dirs)
  {
    $dirchmod = '777';
    chmod_routine($dirs, $dirchmod , $chmodmethod, $ftp_details);

    echo "$dirs chmoded to $dirchmod";
    echo '<br>';
  }
  foreach($dirscan[files] as $files)
  {
    $filechmod = '666';
    chmod_routine($files, $filechmod , $chmodmethod, $ftp_details);

    echo "$files chmoded to $dirchmod";
    echo '<br>';
  }

}


function errormessage($ERROR_MESSAGE) {
?>
<br><br><br><br><br><br><br>
<table class="forumline" width="100%" cellspacing="1" cellpadding="4" border="0">
<tr>
<td>
<table class="errorline" width="100%" cellspacing="0" cellpadding="1" border="0">
<tr> 
<td align="center">
<br /><strong>
<?php
echo $ERROR_MESSAGE;
?>
</strong><br />&nbsp;</td>
</tr>
</table>
</td>
</tr>
</table>
<br><br><br><br><br><br><br>
<?php
}

function box($title, $inside) {
?>
<table align="center" width="100%" cellpadding="5" cellspacing="1" border="0" class="forumline">
<tr>
<th>
<?php
echo $title;
?>
</th></tr>
<tr>
<td valign="top" class="row1">
<?php
echo $inside;
?>
</td>
</tr>
</table>
<table border="0" cellpadding="2" cellspacing="0" class="tbl"><tr><td class="tbll"></td><td class="tblbot"></td><td class="tblr"></td></tr></table>
<br />
<?php
}


function tableboxtitle3($title, $title2, $title3, $title4) {
?>
<table align="center" width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr>
<th width="40" nowrap="nowrap">
<?php
echo $title;
?>
</th>

<th colspan="2" width="100%" nowrap="nowrap">
<?php
echo $title2;
?>
</th>

<th width="40" nowrap="nowrap">
<?php
echo $title3;
?>
</th>

<th width="40" nowrap="nowrap">
<?php
echo $title4;
?>
</th>

</tr>
</tr>
<?php
}



function tableboxlist3($contents1, $contents2, $contents3, $contents4, $contents5, $row1, $row2) {
?>
<tr>

<td align="center" class="row1">
<?php
echo $contents1;
?>
</td>

<td align="center" class="row2">
<?php
echo $contents2;
?>
</td>

<td width="100%" align="left" class="row1">
<?php
echo $contents3;
?>
</td>
<?php
echo "<td align='center' class='$row1'>";
echo $contents4;
?>
</td>

<?php
echo "<td align='center' class='$row2'>";
echo $contents5;
?>
</td>

</tr>
<?php
}

function tableboxend3() {
?>
<tr>
<td colspan="5" class="spaceRow"></td>
</tr>
</table>
<table border="0" cellpadding="2" cellspacing="0" class="tbl"><tr><td></td><td class="tblbot"></td><td class="tblr"></td></tr></table>
<?php
}


function tableboxtitle2($title, $title2, $title3, $title4) {
?>
<table align="center" width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr>
<th colspan="2" width="100%" nowrap="nowrap">
<?php
echo $title;
?>
</th>

<th width="50" nowrap="nowrap">
<?php
echo $title2;
?>
</th>

<th width="50" nowrap="nowrap">
<?php
echo $title3;
?>
</th>

<th width="200" nowrap="nowrap">
<?php
echo $title4;
?>
</th>

</tr>
</tr>
<?php
}

function tableboxlist2($contents1, $contents2, $contents3, $contents4, $contents5) {
?>
<tr>

<td width="30" align="center" class="row2">
<?php
echo $contents1;
?>
</td>

<td width="100%" align="left" class="row1">
<?php
echo $contents2;
?>
</td>

<td align="center" class="row2">
<?php
echo $contents3;
?>
</td>

<td align="center" class="row3">
<?php
echo $contents4;
?>
</td>

<td align="center" class="row3">
<?php
echo $contents5;
?>
</td>

</tr>
<?php
}

function tableboxend2() {
?>
<tr>
<td colspan="5" class="spaceRow"></td>
</tr>
</table>
<table border="0" cellpadding="2" cellspacing="0" class="tbl"><tr><td></td><td class="tblbot"></td><td class="tblr"></td></tr></table>
<?php
}



function boxtitle($title, $explain) {
?>
<table align="center" width="100%" cellpadding="5" cellspacing="1" border="0" class="forumline">
<tr>
<th>
<?php
echo $title;
?>
</th></tr>
</tr>
<tr>
<td class="row1"><span class="postdetails">
<?php
echo $explain;
?>
</span></td>
</tr>
<?php
}

function boxmiddletitle($middletitle) {
?>
<tr>
<td align="center" class="row2">
<p class="maintitle">
<?php
echo $middletitle;
?>
<br />
</p></td></tr>
<?php
}

function boxcattitle($cattitle) {
?>
<tr>
<td align="center" class="cat">
<span class="cattitle">
<?php
echo $cattitle;
?>
</span>
</td>
</tr>
<?php
}

function boxmiddlecontents($middlecontents) {
?>
<tr>
<td align="center" class="row2">
<p class="maintitle">
<?php
echo $middlecontents;
?>
<br />
</p></td></tr>
<?php
}

function boxend() {
?>
<tr>
<td class="spaceRow"></td>
</tr>
</table>
<table border="0" cellpadding="2" cellspacing="0" class="tbl"><tr><td></td><td class="tblbot"></td><td class="tblr"></td></tr></table>
<?php
}


function cachedelete($directory) {
  global $chmodmethod, $ftp_details, $dirscan;
  dircontents($directory);
  $dirscan[dirs] = array_diff($dirscan[dirs], array($directory));
  $dirscan[dirs] = array_reverse($dirscan[dirs]);
  
  //boxtemplate part1
  $title = "Cache delete   :: $directory ::";
  $explain = "Directories can only be deleted when there are no more files inside...<br />So first all files wil be deleted,<br />then all directories, the deepest first...";
  $diricon = fileicon("dir");
  $fileicon = fileicon("file.php");
  boxtitle($title, $explain);

  boxmiddletitle("Deleting files...");
  
  echo "<tr><td valign='top'><table width='100%'>";

  $row = 'row1';
  if ($dirscan[files]) {
    foreach($dirscan[files] as $files)
    {
      if ($row == 'row1') {
      $row = 'row4';
      }
      else {
        $row = 'row1';
      }
      unlink($files);
      echo "<tr><td class='$row'><span class='gen'>$fileicon $files <strong> --- deleted</strong></span></td></tr>";
      //echo '<br>';
    }
  }
  else {
  echo "<tr><td><center><strong>There aren't any</strong>...</center></td></tr>";
  }

  echo "</table></td></tr>";

boxmiddletitle("Deleting directories...");

  echo "<tr><td valign='top'><table width='100%'>";

  if ($dirscan[dirs]) {
    foreach($dirscan[dirs] as $dirs)
    {
      if ($row == 'row1') {
      $row = 'row4';
      }
      else {
        $row = 'row1';
      }
      rmdir("$dirs");

      echo "<tr><td class='$row'><span class='gen'>$diricon $dirs <strong> --- deleted</strong></span></td></tr>";
    }
  }
  else {
  echo "<tr><td><center><strong>There aren't any</strong>...</center></td></tr>";
  }
  echo "</table></td></tr>";
boxend();
}


// ----------------- PROCESS ------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------
// This is where the actual functions are called to process the filelists
// --------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------


page_footer();
?>