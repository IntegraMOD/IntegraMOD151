	<script>
	<!--
	function NewWindow(mypage,myname)
	{
	    settings='width=250,height=300,top=0,left=0,toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes';
	    PopupWin=window.open(mypage,myname,settings);
	    PopupWin.focus();
	}
	// -->
	</script>
	 
	<!-- BEGIN topics_list_box -->
	<!-- BEGIN row -->
	<!-- BEGIN header_table -->
	<!-- BEGIN multi_selection -->
	<script>
	<!--
	// checkbox selection management
	function check_uncheck_main_{topics_list_box.row.header_table.BOX_ID}()
	{
	    var all_checked = true;
	    for (i = 0; (i < document.{topics_list_box.FORMNAME}.elements.length) && all_checked; i++)
	    {
	        if (document.{topics_list_box.FORMNAME}.elements[i].name == '{topics_list_box.FIELDNAME}[]{topics_list_box.row.header_table.BOX_ID}')
	        {
	            all_checked =  document.{topics_list_box.FORMNAME}.elements[i].checked;
	        }
	    }
	    document.{topics_list_box.FORMNAME}.all_mark_{topics_list_box.row.header_table.BOX_ID}.checked = all_checked;
	}
	// check/uncheck all
	function check_uncheck_all_{topics_list_box.row.header_table.BOX_ID}()
	{
	    for (i = 0; i < document.{topics_list_box.FORMNAME}.length; i++)
	    {
	        if (document.{topics_list_box.FORMNAME}.elements[i].name == '{topics_list_box.FIELDNAME}[]{topics_list_box.row.header_table.BOX_ID}')
	        {
	            document.{topics_list_box.FORMNAME}.elements[i].checked = document.{topics_list_box.FORMNAME}.all_mark_{topics_list_box.row.header_table.BOX_ID}.checked;
	        }
	    }
	}
	// -->
	</script>
	<!-- END multi_selection -->
	 
	<div class="forabg">
	    <div class="inner"><span class="corners-top"><span></span></span>
	        <ul class="topiclist">
	            <li class="header">
	                <dl class="row-item">
	                    <dt><div class="list-inner"><strong>{topics_list_box.row.L_TITLE}</strong></div></dt>
	                    <dd class="posts">{topics_list_box.row.L_REPLIES}</dd>
	                    <dd class="views">{topics_list_box.row.L_VIEWS}</dd>
	                    <dd class="lastpost"><span>{topics_list_box.row.L_LASTPOST}</span></dd>
	                    <!-- BEGIN multi_selection -->
	                    <dd class="mark"><input type="checkbox" name="all_mark_{topics_list_box.row.header_table.BOX_ID}" value="0" onClick="check_uncheck_all_{topics_list_box.row.header_table.BOX_ID}();" /></dd>
	                    <!-- END multi_selection -->
	                </dl>
	            </li>
	        </ul>
	<!-- END header_table -->
	        <ul class="topiclist">
			
			
	<!-- BEGIN header_row -->

	            <li class="row bg3">
	                <dl>
	                    <dt><div class="list-inner">
	                        <a href="{catrow.U_VIEWCAT}">{catrow.CAT_DESC}</a>
	                    </div></dt>
	                </dl>
	            </li>

	<!-- END header_row -->
	 
	<!-- BEGIN topic -->
	            <li class="row bg3">
	                <dl class="">
                        <dt>
	                        <div class="list-inner">
								<span class="icon {topics_list_box.row.ROW_CLASS} {topics_list_box.row.TOPIC_FOLDER_IMG}"></span>
								<!-- BEGIN icon -->
								<span class="topic-icon">{topics_list_box.row.ICON}</span>
								<!-- END icon -->
	                            <a href="{topics_list_box.row.U_VIEW_TOPIC}" class="topictitle">{topics_list_box.row.TOPIC_TITLE}</a>
	                            <span class="topic-status">{topics_list_box.row.TOPIC_TYPE}</span>
	                            {topics_list_box.row.RATING}
	                            <span class="push">{topics_list_box.row.TOPIC_AUTHOR} &raquo; {topics_list_box.row.FIRST_POST_TIME}
	                            <!-- BEGIN nav_tree -->
	                            <br />{topics_list_box.row.TOPIC_NAV_TREE}
	                            <!-- END nav_tree -->
								</span>
	                        </div>
	                    </dt>
	                    <dd class="posts">
	                        <a href="{topics_list_box.row.U_POSTINGS_POPUP}" onclick="NewWindow(this.href,'PopupWin');return false" onfocus="this.blur()"; title="{L_POPUP_MESSAGE}">{topics_list_box.row.REPLIES}</a>
	                        <dfn>{topics_list_box.row.L_REPLIES}</dfn>
	                    </dd>
	                    <dd class="views">
	                        {topics_list_box.row.VIEWS}
	                        <dfn>{topics_list_box.row.L_VIEWS}</dfn>
	                    </dd>
	                    <dd class="lastpost">
	                        <span>
	                            <dfn>{topics_list_box.row.L_LASTPOST}</dfn>
	                            {topics_list_box.row.LAST_POST_AUTHOR}
	                            <a href="{topics_list_box.row.U_LAST_POST}">{topics_list_box.row.LAST_POST_IMG}</a>
	                            <br />{topics_list_box.row.LAST_POST_TIME}
	                        </span>
	                    </dd>
	                    <!-- BEGIN multi_selection -->
	                    <dd class="mark">
	                        <input type="checkbox" name="{topics_list_box.FIELDNAME}[]{topics_list_box.row.BOX_ID}" value="{topics_list_box.row.FID}" onClick="javascript:check_uncheck_main_{topics_list_box.row.BOX_ID}();" {topics_list_box.row.L_SELECT} />
	                    </dd>
	                    <!-- END multi_selection -->
	                </dl>
	            </li>
	<!-- END topic -->
	 
	<!-- BEGIN no_topics -->
	            <li class="row">
	                <div class="no_topics">{topics_list_box.row.L_NO_TOPICS}</div>
	            </li>
	<!-- END no_topics -->
	 
	<!-- BEGIN bottom -->
	            <li class="row">
	                <div class="topic_actions ctr bg3">
	                    {topics_list_box.row.FOOTER}
	                </div>
	            </li>
	<!-- END bottom -->
	 
	<!-- BEGIN footer_table -->
	        </ul>
	    <span class="corners-bottom"><span></span></span></div>
	</div>
	<!-- END footer_table -->
	<!-- END row -->
	<!-- END topics_list_box -->
	<br />