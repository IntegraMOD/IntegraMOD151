<!-- DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" -->
<!-- <html xmlns="http://www.w3.org/1999/xhtml"> -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{S_CONTENT_DIRECTION}">
<head>
    <script>
    <!--
        function codeDivStart()
        {
            var randomId = Math.floor(Math.random() * 2000);
            document.write('<div class="codetitle">Code:</div><div class="codediv" id="' + randomId + '">');
        }
    //-->
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}"  />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <style type="text/css">
    <!--

    /* General font families for common tags */
    font,th,td,p{font:12px Verdana,Arial,Helvetica,sans-serif}

    /* General text */
    .gensmall{font-size:10px}
    td.genmed,.genmed{font-size:11px}
    .explaintitle{font-size:11px;font-weight:bold;color:#000000}
    .genstat { font-weight: bold; font-size : 12px; color : #000000; }
    .gensuf { font-style: italic; font-size : 12px; color : #000000; }
    .gendesc { font-weight: bold; font-size : 12px; color : #000000; }

    /* General page style */
    a:link,a:active,a:visited,a.postlink{color:#00000000;}
    a:hover{color:#dd6900}

    /* titles for the topics:could specify viewed link colour too */
    .topictitle{font-size:11px;font-weight:bold}
    a.topictitle:visited{color:#000000}
    a.topictitle:hover{color:#dd6900}

    /* Name of poster in viewmsg.php and viewtopic.php and other places */
    .name{font-size:11px;font-weight: bold}

    hr{border: 0px solid #ffffff;border-top-width:1px;height:0px}

    /* Category gradients*/
    td.cat, td.catrupt, td.catleft, td.catright, td.catmiddle{font-weight:bold;letter-spacing:1px;background:#fafafa;height:27px;text-indent:4px}

    /* Main table cell colours and backgrounds */
    .row1{background-color:#ffffff}
    .row2,.helpline{background:#ffffff}
    .row3{background:#ffffff}
    td.spacerow{background:#ffffff}

    /* Spoiler code */
    .row1 span.spoil { color: #ffffff; }
    .row2 span.spoil { color: #ffffff; }
    .row3 span.spoil { color: #ffffff; }

    /* This is for the table cell above the Topics,Post & Last posts on the index.php */
    td.rowpic{background: #ffffff repeat-y;height:27px}

    /* Table Header cells */
    th{background:#fafafa;color:#000000;font-size:11px;font-weight:bold;height:28px;white-space:nowrap;text-align:center;padding-left:8px;padding-right:8px}

    /* This is the border line & background colour round the entire page */
    .bodyline{background:#ffffff;border:1px solid #000000}

    /* This is the outline round the main forum tables */
    .forumline{background:#ffffff;border:1px solid #000000}

    /* The largest text used in the index page title and toptic title etc. */
    .maintitle,h1{font:bold 20px/120% "Trebuchet MS",Verdana,Arial,Helvetica,sans-serif;text-decoration:none;color:#000000}

    .subtitle,h2{font:bold 18px/180% "Trebuchet MS",Verdana,Arial,Helvetica,sans-serif;text-decoration:none}

    /* Used for the navigation text,(Page 1,2,3 etc) and the navigation bar when in a forum */
    .nav{font-size:11px;font-weight:bold}
    .postbody{font-size:12px;line-height:125%}

    /* Location,number of posts,post date etc */
    .postdetails{font-size:10px;color:#000000}

    /* Quote blocks */
    .quote{background:#ffffff;border:1px solid #000000;font-size:11px;line-height:125%}
    .quotediv{background:#ffffff;border: 1px solid #000000;border-top:0; padding:5px;overflow:auto;width:90%;text-align:left}
    .quotetitle{background:#fafafa;border: 1px solid #000000;border-top:1; padding:5px;overflow:auto;width:90%;text-align:left}
    .quotediv span.spoil { color: #ffffff; } /* Spolier mod */

    /* Code blocks */
    .code{background:#ffffff;border:1px solid #000000;font-size:11px;line-height:125%}
    .codediv{background:#ffffff;border: 1px solid #000000;border-top:0;font:12px Courier,"Courier New",sans-serif;padding:5px;overflow:auto;width:90%;text-align:left}
    .codetitle{background:#fafafa;border: 1px solid #000000;border-top:1;padding:5px;overflow:auto;width:90%;text-align:left}
    .codediv span.spoil { color: #ffffff; } /* Spolier mod */

/* This is for the error messages that pop up */
.errorline{background:#ffffff;border:1px solid #006699}

/* Form elements */
form{display:inline}

input{font:11px Verdana,Arial,Helvetica,sans-serif}

select{background:#ffffff;font:11px Verdana,Arial,Helvetica,sans-serif}

input.post,textarea.post{background:#ffffff;border:1px solid #000000;
font:11px Verdana,Arial,Helvetica,sans-serif;padding-bottom:2px;padding-left:2px}

input.button,input.liteoption,.fakebut{border:1px solid #000000;background:#fafafa;font-size:11px}
input.catbutton{border:1px solid #000000;background:#fafafa;font-size:10px}
input.mainoption{border:1px solid #000000;background:#fafafa;font-size:11px;font-weight:bold}

a.but,a.but:hover,a.but:visited{color:#000000;text-decoration:none}

/* This is the line in the posting page which shows the rollover
help line. Colour value in row2 */
.helpline{border-style:none}
.hideinput{border:1px solid #000000;background:#fafafa;font:10px Verdana,Arial,Helvetica,sans-serif; font-weight:bold}

abbr, acronym {border-bottom: 1px dotted; cursor: help;}

/* This is the gradient background at the top of the page */
.topbkg{background: #fafafa repeat-x;height:110px}
.topnav{font-size:10px;background: #fafafa repeat-x;color:#dd6900;height:16px;white-space:nowrap;border: 0px solid #91a0ae;border-width: 1px 0px 1px 0px}

/* Specify the space around images */
.imgtopic,.imgicon{margin-left:3px}
.imgspace{margin-left:1px;margin-right:2px}
.imgfolder{margin:1px;margin-left:4px;margin-right:4px}

/* Gets rid of the need for border="0" on hyperlinked images */
img{border:0}

    -->
    </style>
    {META}
    <title>{SITENAME} :: {PAGE_TITLE}</title>
</head>

<body bgcolor="white" text="black" link="black" vlink="black">
<span class="gen"><a name="top"></a></span>