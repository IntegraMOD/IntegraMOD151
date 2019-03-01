<div class="gen">{L_BLOCKS_TITLE}</div>
<br />
<div class="genmed">{L_BLOCKS_TEXT}</div>
<br />
{L_B_LAYOUT}: [ <b>{LAYOUT_NAME}</b> ]
&nbsp;&nbsp;
{L_B_PAGE}: [ <b>{PAGE}</b> ]
&nbsp;&nbsp;
{L_IMPORTAL_PAGE_TEMPLATE}: [ <b>{TEMPLATE_FILE}</b> ]
<br />
<br />

<!-- IF BLOCKS_PREVIEW -->
<h1>{L_IMPORTAL_BLOCKS_PREVIEW}</h1>
{BLOCKS_PREVIEW}

<br />
<br />
<!-- ENDIF -->


<h1>{L_IMPORTAL_BLOCKS_LIST}</h1>
<div class="container-fluid forumline">
<form method="post" action="{S_BLOCKS_ACTION}">
  <div class="row th genmed">
	<div class="col-2 pt-1 ctr">{L_ACTION}</div>
	<div class="col-3 pt-1 ctr">{L_B_TITLE}</div>
	<div class="col-1 pt-1 ctr">{L_B_POSITION}</div>
	<div class="col-1 pt-1 ctr">{L_B_ACTIVE}</div>
	<div class="col-1 pt-1 ctr">{L_B_DISPLAY}</div>
	<div class="col-1 pt-1 ctr">{L_B_TYPE}</div>
	<div class="col-1 pt-1 ctr">{L_B_VIEW_BY}</div>
	<div class="col-1 pt-1 ctr">{L_B_GROUPS}</div>
	<div class="col-1 pt-1 ctr resp">{L_B_CACHE}</div>
  </div>

  <!-- BEGIN blocks -->
  <div class="row genmed">
	<div class="col-2 {blocks.ROW_CLASS} ctr nowrap">
	<a href="{blocks.U_MOVE_UP}" title="{L_MOVE_UP}"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
	<a href="{blocks.U_MOVE_DOWN}" title="{L_MOVE_DOWN}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
	<a href="{blocks.U_EDIT}" title="{L_EDIT}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
	<a href="{blocks.U_DELETE}" title="{L_DELETE}"><i class="fa fa-times" aria-hidden="true"></i></a>
    </div>
	<div class="col-3 {blocks.ROW_CLASS} ctr">{blocks.TITLE}</div>
	<div class="col-1 {blocks.ROW_CLASS} ctr">{blocks.POSITION}</div>
	<div class="col-1 {blocks.ROW_CLASS} ctr">{blocks.ACTIVE}</div>
	<div class="col-1 {blocks.ROW_CLASS} ctr">{blocks.CONTENT}</div>
	<div class="col-1 {blocks.ROW_CLASS} ctr">{blocks.TYPE}</div>
	<div class="col-1 {blocks.ROW_CLASS} ctr">{blocks.VIEW}</div>
	<div class="col-1 {blocks.ROW_CLASS} ctr">{blocks.GROUPS}</div>
	<div class="col-1 {blocks.ROW_CLASS} ctr resp">{blocks.CACHE}</div>
  </div>
  <!-- END blocks -->
  <div class="row">
 	<div class="col catBottom genmed pt-1 ctr">{S_HIDDEN_FIELDS}<input type="submit" name="add" value="{L_BLOCKS_ADD}" class="mainoption" /></div>
  </div>


</form> 
</div>