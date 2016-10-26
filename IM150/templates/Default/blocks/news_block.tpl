<table width="100%" cellspacing="1" cellpadding="0" border="0">
  <tr>
    <td>
<!-- BEGIN pagination -->
    <div class="nav" style="float: right;text-align: right; padding: 0px; margin: 10px 0 10px 20px; clear: both;">
      {pagination.PAGINATION}
    </div>
<!-- END pagination -->
    <div class="nav" style=" padding: 0; margin: 10px 0;">
    <a href="{INDEX_FILE}" alt="Index">{L_INDEX}</a> |
    <a href="{INDEX_FILE}?news=categories" alt="Index">{L_CATEGORIES}</a> |
    <a href="{INDEX_FILE}?news=archives" alt="Index">{L_ARCHIVES}</a>
    </div>

<!-- BEGIN categories -->
    <div style="border: #ddd solid 1px; float: left; padding: 10px; margin: 10px;">
    <a href="{INDEX_FILE}?cat_id={categories.ID}"><img style="border: 0" src="{categories.IMAGE}" alt="{articles.TITLE}" /></a>
    </div>
<!-- END categories -->
<!-- BEGIN arch -->
    <ul style=" padding: 0 1.3em; margin: 10px 0;">
    <!-- BEGIN year -->
      <li class="gen"><a href="{INDEX_FILE}?news=archives&amp;year={arch.year.YEAR}">{arch.year.YEAR}</a></li>
      <!-- BEGIN month -->
      <li class="gen" style="margin-left: 1em;"> <a href="{INDEX_FILE}?news=archives&amp;year={arch.year.YEAR}&amp;month={arch.year.month.MONTH}">{arch.year.month.L_MONTH} {arch.year.month.POST_COUNT} </a></li>
      <!-- BEGIN day -->
      <li class="gen" style="margin-left: 2em;"> <a href="{INDEX_FILE}?news=archives&amp;year={arch.year.YEAR}&amp;month={arch.year.month.MONTH}&amp;day={arch.year.month.day.DAY}">{arch.year.month.day.L_DAY} {arch.year.month.day.POST_COUNT}</a></li>
      <!-- END day -->
      <!-- END month -->
    <!-- END year -->
    </ul>
<!-- END arch -->
<!-- BEGIN articles -->
  <div style="border: #aaaaaa solid 1px; padding: 10px; margin-bottom: 10px; clear: both;">
    <div style="float: right; padding: 5px; margin: 5px;">
    <a href="{INDEX_FILE}?cat_id={articles.CAT_ID}"><img src="{articles.CAT_IMG}" alt="{articles.CATEGORY}" style="border: 0" /></a>
    </div>
    <div class="topictitle"><a href="{INDEX_FILE}?topic_id={articles.ID}">{articles.L_TITLE}</a></div>
    <div class="postdetails">{articles.POST_DATE} {L_BY} <a class="postdetails" href="profile.php?mode=viewprofile&u={articles.POSTER_ID}">{articles.L_POSTER}</a> | <a href="{articles.U_COMMENTS}">{articles.L_COMMENTS}</a></div>
    <hr />
    <div class="postbody">
    {articles.BODY}</div><br /><div class="gensmall" align="right" valign="top">{articles.READ_MORE_LINK}&nbsp;<a href="tellafriend.php?topic={articles.L_TITLE2}&link={INDEX_FILE}?topic_id={articles.ID}"><img src="{NEWS_EMAIL_IMAGE}" border="0" alt="{L_TELL_FRIEND}" title="{L_TELL_FRIEND}" /></a>&nbsp;<a href="{articles.U_PRINTER_TOPIC}"><img src="{NEWS_PRINT_IMAGE}" border="0" alt="{L_PRINTER_TOPIC}" title="{L_PRINTER_TOPIC}" /></a>
    </div>
  </div>
<!-- END articles -->
<!-- BEGIN comments -->
  <hr />
  <div style="border: #ddd solid 1px; padding: 10px; margin: 10px 0 10px 20px; clear: both;">
    <div class="topictitle">{comments.L_TITLE}</div>
    <div class="postdetails">{comments.POST_DATE} {L_BY} {comments.L_POSTER}</div>
    <hr />
    <div class="postbody">
    {comments.BODY}
    </div>
  </div>
<!-- END comments -->
<!-- BEGIN pagination -->
  <hr />
  <div class="nav" style="text-align: right; padding: 0px; margin: 10px 0 10px 20px; clear: both;">
    {pagination.PAGINATION}
  </div>
<!-- END pagination -->
    </td>
  </tr>
</table>    <div class="postbody">
    {articles.BODY}</div><br /><div class="gensmall" align="right" valign="top">{articles.READ_MORE_LINK}&nbsp;<a href="tellafriend.php?topic={articles.L_TITLE2}&link={TELL_LINK}"><img src="{NEWS_EMAIL_IMAGE}" border="0" alt="{L_TELL_FRIEND}" title="{L_TELL_FRIEND}" /></a>&nbsp;<a href="{articles.U_PRINTER_TOPIC}"><img src="{NEWS_PRINT_IMAGE}" border="0" alt="{L_PRINTER_TOPIC}" title="{L_PRINTER_TOPIC}" /></a>
    </div>
  </div>
<!-- END articles -->
<!-- BEGIN comments -->
  <hr />
  <div style="border: #ddd solid 1px; padding: 10px; margin: 10px 0 10px 20px; clear: both;">
    <div class="topictitle">{comments.L_TITLE}</div>
    <div class="postdetails">{comments.POST_DATE} {L_BY} {comments.L_POSTER}</div>
    <hr />
    <div class="postbody">
    {comments.BODY}
    </div>
  </div>
<!-- END comments -->
<!-- BEGIN pagination -->
  <hr />
  <div class="nav" style="text-align: right; padding: 0px; margin: 10px 0 10px 20px; clear: both;">
    {pagination.PAGINATION}
  </div>
<!-- END pagination -->
    </td>
  </tr>
</table>