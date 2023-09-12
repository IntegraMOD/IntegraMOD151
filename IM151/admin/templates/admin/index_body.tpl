<style> 
   .row .st:nth-child(even) {
        background-color:#D6DDF0;
    }
</style>

<div class="container-fluid">

<div class="maintitle">{L_WELCOME_IM}</div>
<br />
<div class="genmed">{L_ADMIN_INTRO}</div>
<br />
<div class="subtitle">{L_FORUM_STATS}</div>


<div class="container-fluid forumline">
	<div class="row th pt-2 text-start">
		<div class="col col-sm-6 col-md-3">{L_STATISTIC}</div>
		<div class="col col-sm-6 col-md-3">{L_VALUE}</div>
		<div class="col col-sm-6 col-md-3">{L_STATISTIC}</div>
		<div class="col col-sm-6 col-md-3">{L_VALUE}</div>
	</div>
	<div class="row">
		<div class="col col-sm-6 col-md-3 row2 py-1">{L_NUMBER_POSTS}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1">{NUMBER_OF_POSTS}</div>
		<div class="col col-sm-6 col-md-3 row2 py-1">{L_POSTS_PER_DAY}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1">{POSTS_PER_DAY}</div>
	</div>
	<div class="row">
		<div class="col col-sm-6 col-md-3 row2 py-1 hr">{L_NUMBER_TOPICS}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1 hr">{NUMBER_OF_TOPICS}</div>
		<div class="col col-sm-6 col-md-3 row2 py-1 hr">{L_TOPICS_PER_DAY}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1 hr">{TOPICS_PER_DAY}</div>
	</div>
	<div class="row">
		<div class="col col-sm-6 col-md-3 row2 py-1 hr">{L_NUMBER_USERS}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1 hr">{NUMBER_OF_USERS}</div>
		<div class="col col-sm-6 col-md-3 row2 py-1 hr">{L_USERS_PER_DAY}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1 hr">{USERS_PER_DAY}</div>
	</div>
	<div class="row">
		<div class="col col-sm-6 col-md-3 row2 py-1 hr">{L_BOARD_STARTED}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1 hr"><span class="genmed">{START_DATE}</span></div>
		<div class="col col-sm-6 col-md-3 row2 py-1 hr">{L_AVATAR_DIR_SIZE}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1 hr">{AVATAR_DIR_SIZE}</div>
	</div>
	<div class="row">
		<div class="col col-sm-6 col-md-3 row2 py-1 hr">{L_DB_SIZE}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1 hr">{DB_SIZE}</div>
		<div class="col col-sm-6 col-md-3 row2 py-1 hr">{L_GZIP_COMPRESSION}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1 hr">{GZIP_COMPRESSION}</div>
	</div>
	<div class="row">
		<div class="col col-sm-6 col-md-3 row2 py-1 hr">{L_PHP_VERSION}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1 hr">{PHP_VERSION}</div>
		<div class="col col-sm-6 col-md-3 row2 py-1 hr">{L_MYSQL_VERSION}:</div>
		<div class="col col-sm-6 col-md-3 row1 py-1 hr">{MYSQL_VERSION}</div>
	</div>	
</div>


<br />

<div class="container-fluid forumline">
	<div class="row">
		<div class="col col-sm-12 col-md-6 order-sm-1 order-md-1 th pt-2">{L_INTEGRA_TITLE}</div>
		<div class="col col-sm-12 col-md-6 order-3 order-xs-3 order-sm-3 order-md-2 order-lg-2 order-xl-3 th pt-2">{L_VERSION_INFORMATION}</div>
		<div class="col col-sm-12 col-md-6 order-2 order-xs-2 order-sm-2 order-md-3 order-lg-3 order-xl-3 p-2 row1">{INTEGRA_NEWS}</div>
		<div class="col col-sm-12 col-md-6 order-sm-4 order-md-4 p-2  row2">{VERSION_INFO}</div>	
	</div>
</div>


<br />

<div class="subtitle">{L_WHO_IS_ONLINE}</div>

<div class="container-fluid forumline row2">
  <div class="row text-start th"> 
	<div class="col pt-2">&nbsp;{L_USERNAME}&nbsp;</div>
	<div class="col pt-2">&nbsp;{L_STARTED}&nbsp;</div>
	<div class="col pt-2">&nbsp;{L_LAST_UPDATE}&nbsp;</div>
	<div class="col pt-2">&nbsp;{L_FORUM_LOCATION}&nbsp;</div>
	<div class="col pt-2">&nbsp;{L_IP_ADDRESS}&nbsp;</div>
  </div>
  
<!-- BEGIN reg_user_row -->
  <div class="row text-start row1 st"> 
	<div class="col py-2">&nbsp;<a href="{reg_user_row.U_USER_PROFILE}" class="name">{reg_user_row.USERNAME}</a>&nbsp;</div>
	<div class="col py-2">&nbsp;<span class="genmed">{reg_user_row.STARTED}</span>&nbsp;</div>
	<div class="col py-2">&nbsp;<span class="genmed">{reg_user_row.LASTUPDATE}</span>&nbsp;</div>
	<div class="col py-2">&nbsp;<a href="{reg_user_row.U_FORUM_LOCATION}">{reg_user_row.FORUM_LOCATION}</a>&nbsp;</div>
	<div class="col py-2">&nbsp;<a href="{reg_user_row.U_WHOIS_IP}" target="_phpbbwhois">{reg_user_row.IP_ADDRESS}</a>&nbsp;</div>
  </div>
<!-- END reg_user_row -->
  <div class="row"><div class="col py-2">&nbsp;</div>
<!-- BEGIN guest_user_row -->
  <div class="row text-start row1 st"> 
	<div class="col py-2">&nbsp;<span class="genmed">{guest_user_row.USERNAME}</span>&nbsp;</div>
	<div class="col py-2">&nbsp;<span class="genmed">{guest_user_row.STARTED}</span>&nbsp;</div>
	<div class="col py-2">&nbsp;<span class="genmed">{guest_user_row.LASTUPDATE}</span>&nbsp;</div>
	<div class="col py-2">&nbsp;<a href="{guest_user_row.U_FORUM_LOCATION}">{guest_user_row.FORUM_LOCATION}</a>&nbsp;</div>
	<div class="col py-2">&nbsp;<a href="{guest_user_row.U_WHOIS_IP}" target="_phpbbwhois">{guest_user_row.IP_ADDRESS}</a>&nbsp;</div>
  </div>
<!-- END guest_user_row -->
</div>


{JR_ADMIN_INFO_TABLE}
<br />
</div>