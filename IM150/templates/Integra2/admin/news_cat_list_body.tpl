
<h1>{L_NEWS_TITLE}</h1>

<P>{L_NEWS_TEXT}</p>

<form method="post" action="{S_NEWS_ACTION}">
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">

  <tr>
    <th class="thCornerL">{L_ICON}</th>
    <th class="thTop">{L_CATEGORY}</th>
    <th class="thTop">{L_TOPICS}</th>
    <th colspan="2" class="thCornerR">{L_ACTION}</th>
  </tr>
  <tr>
    <td class="row1" colspan="6" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="add" value="{L_NEWS_ADD}" class="mainoption" /></td>
  </tr>
  <!-- BEGIN news_cats -->
  <tr>
    <td class="{news_cats.ROW_CLASS}"><img src="{news_cats.CATEGORY_IMG}" alt="{news_cats.L_CATEGORY}" /></td>
    <td class="{news_cats.ROW_CLASS}">{news_cats.L_CATEGORY}</td>
    <td class="{news_cats.ROW_CLASS}" align="center">{news_cats.TOPIC_COUNT}</td>
    <td class="{news_cats.ROW_CLASS}"><a href="{news_cats.U_NEWS_EDIT}">{L_EDIT}</a></td>
    <td class="{news_cats.ROW_CLASS}"><a href="{news_cats.U_NEWS_DELETE}">{L_DELETE}</a></td>
  </tr>
  <!-- END news_cats -->
  <tr>
    <td class="cat" colspan="6" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="add" value="{L_NEWS_ADD}" class="mainoption" /></td>
  </tr>
</table></form>
