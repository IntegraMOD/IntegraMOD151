
<!-- BEGIN switch_mini_cal_add_events -->
	<form name="mini_cal" id="mini_cal" action="{U_MINI_CAL_ADD_EVENT}" method="post">
	<!-- END switch_mini_cal_add_events -->
	<div class="forabg">
        <div class="inner"><span class="corners-top"><span></span></span>
	        <ul class="topiclist">
	            <li class="header">
	                <dl class="row-item">
						<dt>
							<!-- BEGIN switch_mini_cal_events -->
								<a href="{U_MINI_CAL_CALENDAR}">
							<!-- END switch_mini_cal_events -->
							{L_MINI_CAL_CALENDAR}
							<!-- BEGIN switch_mini_cal_events -->
								</a>
							<!-- END switch_mini_cal_events -->
						</dt>
	                </dl>
	            </li>
	        </ul>
	        <ul class="topiclist forums">
	            <li class="row">
					<div class="mini-cal-body">
						<div class="mini-cal-navigation bg1">
							<div>{U_PREV_MONTH}</div>
							<div><span class="genmed">{L_MINI_CAL_MONTH}</span></div>
							<div>{U_NEXT_MONTH}</div>
						</div>
						<div class="mini-cal-weekdays">
							<div class="mini-cal-weekday">{L_MINI_CAL_SUN}</div>
							<div class="mini-cal-weekday">{L_MINI_CAL_MON}</div>
							<div class="mini-cal-weekday">{L_MINI_CAL_TUE}</div>
							<div class="mini-cal-weekday">{L_MINI_CAL_WED}</div>
							<div class="mini-cal-weekday">{L_MINI_CAL_THU}</div>
							<div class="mini-cal-weekday">{L_MINI_CAL_FRI}</div>
							<div class="mini-cal-weekday">{L_MINI_CAL_SAT}</div>
						</div>
						<div class="mini-cal-days">
							<!-- BEGIN mini_cal_row -->
								<!-- BEGIN mini_cal_days -->
								<div class="mini-cal-day"><span class="gensmall">{mini_cal_row.mini_cal_days.MINI_CAL_DAY}</span></div>
								<!-- END mini_cal_days -->
							<!-- END mini_cal_row -->
						</div>
					</div>
		
	            </li>
	        </ul>
	        <ul class="topiclist forums">
	            <li class="row" style="padding:0px 6px 10px;">
					<!-- BEGIN switch_mini_cal_birthdays -->
					<div class="mini-cal-birthdays">
						<div class="gensmall">{L_WHOSBIRTHDAY_TODAY}</div>
						<div class="gensmall">{L_WHOSBIRTHDAY_WEEK}</div>
					</div>
					<!-- END switch_mini_cal_birthdays -->
					<!-- BEGIN switch_mini_cal_events -->
					<div class="mini-cal-events">
						<div class="mini-cal-header">{L_MINI_CAL_EVENTS}</div>
						<!-- BEGIN mini_cal_events -->
						<div class="mini-cal-event">
							<span class="gensmall">{mini_cal_events.MINI_CAL_EVENT_DATE} - <a href="{mini_cal_events.U_MINI_CAL_EVENT}" class="gensmall">{mini_cal_events.S_MINI_CAL_EVENT}</a></span>
						</div>
						<!-- END mini_cal_events -->
						<!-- BEGIN mini_cal_no_events -->
						<div class="mini-cal-event">
							<span class="genMed">{L_MINI_CAL_NO_EVENTS}</span>
						</div>
						<!-- END mini_cal_no_events -->
					</div>
					<!-- END switch_mini_cal_events -->
					<!-- BEGIN switch_mini_cal_add_events -->
					<div class="mini-cal-add-event">
						<span class="genmed">
							{S_MINI_CAL_EVENTS_FORUMS_LIST}
							<input type="submit" value="{L_MINI_CAL_ADD_EVENT}" class="button2" />
							<input type="hidden" name="mode" id="mode" value="newtopic" />
						</span>
					</div>
					<!-- END switch_mini_cal_add_events -->
	            </li>
	        </ul>
        <span class="corners-bottom"><span></span></span></div>
	</div>
	<!-- BEGIN switch_mini_cal_add_events -->
	</form>
	<!-- END switch_mini_cal_add_events -->
	<br />