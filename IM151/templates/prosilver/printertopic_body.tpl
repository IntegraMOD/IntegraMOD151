<div align="center">
<h1>{SITENAME} :: {SITE_DESCRIPTION}</h1>
</div>

<form action="{U_VIEW_TOPIC}" method="get">
    <table border="0" width="100%">
        <tr>
            <td align="left">
                <span class="nav"><a href="{U_INDEX}">{SITENAME}</a>{NAV_SEPARATOR}<a href="{U_VIEW_FORUM}">{FORUM_NAME}</a>{NAV_SEPARATOR}<b>{TOPIC_TITLE}</b></span>
            </td>
            <td align="right">
                <span class="gensmall"><b>{PAGINATION}</b></span>
                <span class="gensmall">
                    <input class="get" type="text" maxlength="5" size="5" name="start_rel" value="{START_REL}">
                    <input class="get" type="text" maxlength="5" size="5" name="finish_rel" value="{FINISH_REL}">
                    <input type="hidden" name="t" value="{TOPIC_ID}">
                    <input type="hidden" name="printertopic" value="1">
                    <input type="submit" name="submit" value="{L_SHOW}" class="mainoption">
                </span>
            </td>
        </tr>
    </table>

    {POLL_DISPLAY}

    <!-- BEGIN postrow -->
    <br>
    <table width="100%" border="1" cellspacing="2" cellpadding="2">
        <tr>
            <td>
                <span class="name"><a name="{postrow.U_POST_ID}"></a></span>
                <span class="postdetails">#{postrow.POST_NUMBER}:&nbsp;<b>{postrow.POST_SUBJECT}</b> {L_AUTHOR}:&nbsp;<b>{postrow.POSTER_NAME}</b>,&nbsp;</span>
                <span class="postdetails">{postrow.POSTER_FROM}</span>
                <a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /></a>
                <span class="postdetails">{L_POSTED}: {postrow.POST_DATE}</span>
                <br>
                <br>
                <span class="postbody">{postrow.MESSAGE}</span>
                {postrow.ATTACHMENTS}
                <span class="gensmall">{postrow.EDITED_MESSAGE}</span>
            </td>
        </tr>
    </table>
    <!-- END postrow -->
    <table border="0" width="100%">
        <tr>
            <td align="left">
                <span class="nav"><a href="{U_INDEX}">{SITENAME}</a>{NAV_SEPARATOR}<a href="{U_VIEW_FORUM}">{FORUM_NAME}</a>{NAV_SEPARATOR}<b>{TOPIC_TITLE}</b></span>
            </td>
            <td align="right">
                <span class="gensmall"><b>{PAGINATION}</b></span>
            </td>
        </tr>
    </table>

    <p align="center">
        <br>
        <span class="copyright">Generated using <a href="http://phpbb.com/phpBB/viewtopic.php?t=70751" target=_phpbb class="copyright">printer-friendly</a></span>.
        <br>
        <span class="gensmall">{S_TIMEZONE}</span>
        <br>
        <span class="nav">{PAGE_NUMBER}</span>
    </p>
</form>