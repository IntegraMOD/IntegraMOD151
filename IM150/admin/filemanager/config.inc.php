;<?php/* do not delete this line!

[FTP]

; FTP access; leave empty to use local file system instead
ftpHost = ""			; FTP server name, example: www.yourdomain.com
ftpUser = ""			; FTP user name
ftpPassword = ""		; FTP password
ftpPort = 21			; FTP port number (default is 21)
ftpPassiveMode = yes	; use passive mode
ftpSSL = no				; use FTPS - requires PHP 4.3.0 or higher with OpenSSL support

[HTTP]

; HTTP authentication; leave empty if your server doesn't require authentication
; NOTE: this is only for FileManager itself, not for FileManager users!
authUser = ""			; user name
authPassword = ""		; password

[i18n]

; see folder languages for available languages
language = "en"

; server locale setting, example: en_US - leave empty to use your server's default setting
locale = ""

; server character set, example: ISO-8859-1; set to UTF-8 for systems like Ubuntu
encoding = "ISO-8859-1"

[onStart]

; start directory (file path, example: /home/users/gerry/htdocs/tools)
; NOTE: if not in FTP mode, PHP must have at least read permission for this directory!
startDir = "../../"

; only view these directories; example: "www,uploads" - leave empty to view all directories
; NOTE: this will only work within the start directory
startSubDirs = ""

; view files/directories containing this string when starting FileManager
startSearch = ""

; FileManager password protection; leave empty if you don't need it
; separate multiple passwords by a comma: "myPwd1,myPwd2,myPwd3"
; add start directories like this: "myPwd1::/home/users/peter/htdocs, myPwd2::/home/users/mary/htdocs"
; NOTE: password-bound start directories will override variable startDir!
loginPassword = ""

[general]

; FileManager WEB path (example: [http://domain]/tools/filemanager)
; NOTE: only set this if FileManager doesn't view properly!
fmWebPath = ""

; FileManager width (pixels)
fmWidth = 800

; FileManager height (pixels)
fmHeight = 600

; FileManager margin (pixels)
fmMargin = 0

; FileManager default view (details or icons)
fmView = "icons"

; prefix for containers, session and cookie variables
fmPrefix = "fm"

; hide disabled icons
hideDisabledIcons = no

; hide specific list columns; possible values: size, changed, permissions, owner, group
hideColumns = "group"

; mark new and modified files and folders
; NOTE: only files/folders that have been added or modified today will be marked!
markNew = yes

; view context menu when clicking right mouse button - does not work with Opera browsers, though
; NOTE: if enabled, left mouse button will view documents, play media files and open directories
useRightClickMenu = yes

; path to temporary directory; leave empty to use FileManager's own directory
tmpFilePath = ""

; path to log directory; leave empty to use FileManager's own directory
logFilePath = ""

; prefix for log files
logFilePrefix = ""

; only for development: view debug info messages
debugInfo = no

[explorer]

; directory tree width (pixels; 0 = don't view directory tree)
explorerWidth = 170

; expand all folders in directory tree
explorerExpandAll = no

[log]

; log window height (pixels; 0 = don't view log window)
logHeight = 100

; save log messages
; NOTE: if enabled, all log messages will be saved in FileManager's log directory
logSave = no

[imageViewer]

; enable thumbnail creation
; NOTE: if used in FTP mode, it will take some time to copy image files from FTP server
enableImagePreview = yes

; enable image rotation
enableImageRotation = yes

; max. width of preview images (pixels)
thumbMaxWidth = 600

; max. height of preview images (pixels)
thumbMaxHeight = 400

; sharpen preview thumbnails and resized images
; NOTE: this may take some time, so turn it off if thumbnail creation is too slow
thumbSharpen = no

[mediaPlayer]

; enable media player
enableMediaPlayer = yes

; media player width (pixels)
mediaPlayerWidth = 420

; media player height (pixels)
mediaPlayerHeight = 300

[docViewer]

; enable document viewer
enableDocViewer = yes

; document viewer width (pixels)
docViewerWidth = 700

; document viewer height (pixels)
docViewerHeight = 500

; URL for public file access, example: http://www.yourdomain.com/path/to/files
; NOTE: required for Google document viewer (MS Word files, PDF files, etc.)
publicUrl = ""

[fileSystem]

; read ID3 tags from MP3 files
; NOTE: if used in FTP mode, it will take some time to copy MP3 files from FTP server
enableId3Tags = no

; default permissions for uploaded files (octal number without leading zero, example: 755)
; NOTE: does not work correctly on Windows systems
defaultFilePermissions = ""

; default permissions for new directories (octal number without leading zero, example: 755)
; NOTE: does not work correctly on Windows systems
defaultDirPermissions = ""

; allow files with certain extensions, example: "mp3,txt,jpg"; leave empty to allow all types
; NOTE: only use lowercase extensions; they will also work with uppercase files!
allowFileTypes = ""

; hide files with certain extensions, example: "mp3,txt,jpg"; leave empty to view all types
; NOTE: only use lowercase extensions; they will also work with uppercase files!
hideFileTypes = ""

; hide directories with certain names, example: "secure,cgi-bin"; leave empty to view all directories
; NOTE: all corresponding directories will be hidden, regardless of their position within the directory tree!
hideDirNames = ""

; hide system files with leading dot, example: .htaccess
hideSystemFiles = no

; hide system type
hideSystemType = no

; hide file path in file details
hideFilePath = yes

; hide symbolic link target
hideLinkTarget = no

[upload]

; which upload engine should be used; possible values: Java, Perl, PHP
uploadEngine = "Java"

; replace spaces in filenames with underscores
replSpacesUpload = no

; convert filenames to lowercase
lowerCaseUpload = no

; resize JPG/PNG/GIF images (max. width in pixels; 0 = don't resize)
maxImageWidth = 0

; resize JPG/PNG/GIF images (max. height in pixels; 0 = don't resize)
maxImageHeight = 0

; backup files, i.e. don't overwrite
createBackups = yes

; send an e-mail to this address after each file upload, example: "john.doe@isp.com"
mailOnUpload = ""

; URL to script that should be executed AFTER file upload
uploadHook = ""

[download]

; replace spaces in filenames with underscores
replSpacesDownload = no

; convert filenames to lowercase
lowerCaseDownload = no

; send an e-mail to this address after each download, example: "john.doe@isp.com"
mailOnDownload = ""

; URL to script that should be executed BEFORE file download
downloadHook = ""

[permissions]

; enable file upload
enableUpload = yes

; enable download of single files
enableDownload = yes

; enable bulk download of files/directories as ZIP archive
; NOTE: your PHP installation must support ZLib or this won't work!
enableBulkDownload = no

; enable file editing
enableEdit = yes

; enable file / directory deleting
enableDelete = yes

; enable file restoring
enableRestore = no

; enable file / directory renaming
enableRename = yes

; enable file / directory permissions changing
enablePermissions = yes

; enable file / directory moving
enableMove = yes

; enable file duplication
enableCopy = yes

; enable directory creation
enableNewDir = yes

; enable file / directory search
enableSearch = yes

; do not delete this line! */?>