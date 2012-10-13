======================================================================================================================
INTRODUCTION
======================================================================================================================
Use this application to manage files and directories on your webserver or any FTP server. You can create, rename
and delete directories, upload, download, edit, rename, delete and search files, and change file and directory
permissions*. It's also possible to play audio/video files and view preview thumbnails of images.

FileManager works fine with FTP connections. Please note that if you don't set up an FTP connection in the
configuration, FileManager will use the local file system instead. In this case it can only access directories and
files for which PHP has at least read permission; if you want to upload, edit, rename or delete files, or change
file permissions*, PHP must also have write permission for these files or directories.

FileManager can be used as a stand-alone application, but it's also easy to integrate it into your own website; just
have a look at the USAGE section below and the source code of filemanager.php to see how you can do this.

This software should work with PHP 4.1.0 or higher.

* On Windows systems changing of file permissions doesn't work properly. This is not a restriction of this software.

======================================================================================================================
FILE SEARCH
======================================================================================================================
You can use FileManager to search files and directories. It will search all directories recursively, starting in
the directory that is currently viewed. At the moment, it is only possible to search for file or directory names.
Wildcards like "*" are not supported; FileManager will find all files and directories containing the search string
in their name. For instance, if you search for "file", the files "filemanager.php", "file.gif", etc. will match
your search.

While FileManager views a search result, file upload is disabled, and you cannot create new directories. If you want
to do so, please return to your current directory listing first. Please note that this is not possible if you disabled
the search function, but told FileManager to start with a search - in this case, the current search result will be
"locked" and file upload and directory creation won't be possible.

======================================================================================================================
LICENSE
======================================================================================================================
This software is freeware for non-commercial use. If you like it, please feel free to make a donation!
However, if you intend to use the software in a commercial project, please donate at least EUR 20.
You can make a donation on my website: http://www.gerd-tentler.de/tools/filemanager/.

======================================================================================================================
USAGE
======================================================================================================================
Extract the files to your webserver and adapt the configuration (config.inc.php) to your needs. You can change
FTP settings and the start directory there and enable or disable file upload/download, renaming, editing, etc.
It's possible to let FileManager automatically replace spaces in filenames with underscores or convert filenames to
lowercase or call a specific URL when uploading or downloading files.

Please make sure that PHP has write permission for FileManager's tmp directory and its sub-folders.

If you want to use FileManager as a stand-alone software, just open filemanager.php with your favorite browser -
that's all, have fun. ;-)

However, if you want to integrate FileManager into your website like I did in the introduction section of
http://www.gerd-tentler.de/tools/filemanager/, please read this little tutorial. It implies however that you have
basic knowledge of PHP programming.

You will need the FileManager class. It should be included at the very beginning of your PHP file, because it will
start a session if there's no session started already. Replace [pathToFileManager] with the directory path where you
installed FileManager:

  <?php
    include_once('[pathToFileManager]/class/FileManager.php');
  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
  <html>
  <head>
  ...

Now create an instance and call the create() method anywhere within your PHP file:

  $FileManager = new FileManager();
  print $FileManager->create();

That's it. But wait, there's more. You can also set a start directory - this overrides the settings in
config.inc.php:

  $FileManager = new FileManager('/home/users/gerry/htdocs');
  print $FileManager->create();

By the way, you can create as many instances of the FileManager class as you want, assign different start
directories and change other settings like this:

  $FileManager1 = new FileManager('/home/users/gerry/music');
  $FileManager1->fmView = 'details';
  print $FileManager1->create();

  $FileManager2 = new FileManager('/home/users/gerry/photos');
  $FileManager2->fmView = 'icons';
  print $FileManager2->create();

Please have a look at the config.inc.php file if you want to know which variables are available. All of them can
be modified either in the config file or dynamically at runtime. Please note that while boolean variables in the
config file are set to "yes" or "no", they must be set to "true" or "false" when modified at runtime. Example:

  $FileManager->enableUpload = false;
  $FileManager->hideSystemType = true;

Comma-separated lists can also be defined as array when modified at runtime:

  $FileManager->hideColumns = array('owner', 'group', 'permissions');

Of course all settings must be done *before* the create() function is called!

If you're still not quite sure how to integrate FileManager into your website, just have a look at the source code
of filemanager.php.

======================================================================================================================
USER MANAGEMENT
======================================================================================================================
FileManager does not have a user management, because it is very easy to integrate it into your website and your own
existing user management. But it is possible to set passwords and start directories for several users, if this is all
that you need. Just set the loginPassword variable either in the config file or at runtime like in this example:

  $FileManager = new FileManager();
  $FileManager->loginPassword = array(
    'myPwd1::/home/users/peter/htdocs',
    'myPwd2::/home/users/paul/htdocs',
    'myPwd3::/home/users/mary/htdocs'
  );
  print $FileManager->create();

This works in local mode and in FTP mode.

======================================================================================================================
UPLOAD ENGINES
======================================================================================================================
File upload with PHP has two drawbacks: usually the file size is limited (default is 2 MB per file and 8 MB per POST
request), and it is not possible to view a progress bar. The size limit can be changed in the php.ini file by the
server administrator, but this will also affect all other PHP applications.

THE JAVA UPLOADER

The open source JUpload applet views a progress bar, supports drag and drop, upload of big files and even whole
directories. It's integrated into FileManager since version 7.8 as default upload engine. Java 1.4 or higher is
required on the client side.

THE PERL UPLOADER

Alternatively FileManager can also upload files via Perl and view a progress bar while uploading. This requires however
that Perl is installed on your server, and that the Perl scripts in FileManager's cgi directory can be executed.

If you want to use the integrated Perl uploader, first make sure that the uploadEngine variable in FileManager's
configuration file is set to "Perl", or set it at runtime (see examples above). If your Apache server reads .htaccess
files and the setting of options is allowed, then no webserver configuration should be necessary. Otherwise, ask your
server administrator to allow script execution in FileManager's cgi directory. Here's an example for Apache servers:

  <Directory "/path/to/filemanager/cgi">
    Options +ExecCGI
  </Directory>

  AddHandler cgi-script .cgi .pl .prl

Also make sure that the Perl scripts in the cgi directory are saved as ASCII files and that they have proper read and
execute permissions.

THE PHP UPLOADER

This is the basic uploader that should only be used if neither the Java nor the Perl uploader works for you. It only
requires PHP on your server, but you will have to live with a file size limit (depending on your PHP configuration)
and without a progress bar (unless your browser has one by default).

======================================================================================================================
AUTHENTICATION
======================================================================================================================
If you want to use the Java or Perl uploader and installed FileManager on a server that requires authentication, you
must set the authUser and authPassword variables in FileManager's configuration file or at runtime.

======================================================================================================================
MEDIA PLAYER
======================================================================================================================
The integrated open source audio player SoundManager 2 can handle MP3 audio files. MP4/AAC, WAV and OGG audio files
are also playable if your browser supports them with HTML5 audio. Please note that Flash 9+ is required on the client
side.

FileManager can view SWF files, too. For the video formats MP4 and FLV, the OOS FlvPlayer is being used. This also
requires Flash 9+ on the client side.

======================================================================================================================
HOOKS
======================================================================================================================
FileManager provides hooks for upload and download, i.e. whenever a file is uploaded or downloaded, a specific URL can
be called by using these hooks. File path, file size and referer IP address (if available) will be sent as parameters
named "file", "size" and "ip". You can use the uploadHook and downloadHook variables in the config file. Your hook
script could look like this:

  <?php
    $file = $_GET['file'];
    $size = $_GET['size'];
    $ip = $_GET['ip'];
    $logFile = '/home/users/gerry/logs/upload_' . date('Ymd') . '.log';

    if($fp = fopen($logFile, 'a')) {
      fwrite($fp, sprintf("%s  %s  %s  %d\n", date('Y-m-d H:i:s'), $ip, $file, $size));
      fclose($fp);
    }
  ?>

Remember, this is just an example. Instead of writing a log file, you could for instance store the information in a
database or send an e-mail etc.

======================================================================================================================
A QUICK NOTE ON ID3 TAGS AND PREVIEW THUMBNAILS
======================================================================================================================
It is only possible to view ID3 tags and preview thumbnails from files of the server's local file system. This is no
problem when FileManager uses the local file system, but in FTP mode these files must first be copied from the FTP
server. This can take quite some time especially when the file size is big and/or there are a lot of files in a
directory. In this case, it is recommended to disable image preview and ID3 tags. This can be done in the
configuration file (variables enableImagePreview and enableId3Tags).

======================================================================================================================
A QUICK NOTE ON FILE DOWNLOAD
======================================================================================================================
When FileManager runs in FTP mode, files must first be transfered to the local system before they can be sent to the
browser. This can take some time especially with big files. To avoid this, FileManager uses the asynchronous FTP mode:
while loading a file from the FTP server, it can start to send it to the browser without having to wait until the
transfer is complete. This works however only on systems with PHP 4.3.0 or higher. If your system runs an older PHP
version, the file must be transfered to the local system completely before download can start.

======================================================================================================================
Source code + example available at http://www.gerd-tentler.de/tools/filemanager/.
======================================================================================================================
