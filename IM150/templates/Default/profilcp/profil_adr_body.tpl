<form method="post" name="charform" action="{S_CHARACTER_ACTION}" >
<!-- BEGIN adr_profile_none -->
<br />
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="100%">
	<tr>
		<th align="center" colspan="2">{L_NO_CHARACTER}</th>
	</tr>
</table>
<br clear="all" />
<!-- END adr_profile_none -->
<!-- BEGIN adr_profile -->
<br />
<table cellspacing="2" cellpadding="0" border="0" align="center" class="forumline" width="100%">
	<tr>
		<th align="center" width="100%" colspan="2" >{L_CHARACTER_OF}</th>
	</tr>
	<tr valign="top">
		<td class="row1" align="center">

			<table cellspacing="2" cellpadding="0" border="1" align="center" width="100%">
				<tr>
					<th align="center" width="60%" colspan="2"><b>{NAME}</b></th>
				</tr>
					<td class="row1" align="center" width="60%" colspan="2"><span class="gen"><b>{L_LEVEL}: {LEVEL}</b>
					<br /><span class="gen"><b>{CHAR_YEAR}</b></span></td>
				</tr>
				<tr>
					<td class="row2" align="center" height="130" colspan="2">{AVATAR_IMG}</td>
				</tr>
				<tr>
					<td class="row1" align="center"><span class="gen">{L_CLASS}</td>
					<td class="row2" align="center"><span class="gensmall"><img src="adr/images/classes/{CLASS_IMG}" alt="{CLASS}"><br />{CLASS}</span></td>
				</tr>
				<tr>
					<td class="row1" align="center"><span class="gen">{L_RACE}</td>
					<td class="row2" align="center"><span class="gensmall"><img src="adr/images/races/{RACE_IMG}" alt="{RACE}"><br />{RACE}</span></td>
				</tr>
				<tr>
					<td class="row1" align="center"><span class="gen">{L_ELEMENT}</td>
					<td class="row2" align="center"><span class="gensmall"><img src="adr/images/elements/{ELEMENT_IMG}" alt="{ELEMENT}"><br />{ELEMENT}</span></td>
				</tr>
				<tr>
					<td class="row1" align="center"><span class="gen">{L_ALIGNMENT}</td>
					<td class="row2" align="center"><span class="gensmall"><img src="adr/images/alignments/{ALIGNMENT_IMG}" alt="{ALIGNMENT}"><br />{ALIGNMENT}</span></td>
				</tr>
			</table>

		</span></td>

		<td class="row1" align="center">
			<table cellspacing="2" cellpadding="0" border="1" align="center" width="100%">
				<tr>
					<td align="center" colspan="6" class="row2">
						<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
						<tr>
							<td align="center" height="19"><span class="gensmall">HP: {HP} / {HP_MAX}</td>
						</tr>
						<tr>
							<td align="center">&nbsp;<img src="adr/images/misc/bar_red_begin.gif" width="6" height="13" /><img src="adr/images/misc/bar_red_middle.gif" width="{HP_PERCENT_WIDTH}" height="13" border="0" /><img src="adr/images/misc/bar_emp.gif" width="{HP_PERCENT_EMPTY}" height="13" border="0" /><img src="adr/images/misc/bar_red_end.gif" width="6" height="13" /></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="6" class="row2">
						<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
						<tr>
							<td align="center" height="19"><span class="gensmall">MP: {MP} / {MP_MAX}</td>
						</tr>
						<tr>
							<td align="center">&nbsp;<img src="adr/images/misc/bar_blue_begin.gif" width="6" height="13" /><img src="adr/images/misc/bar_blue_middle.gif" width="{MP_PERCENT_WIDTH}" height="13" border="0" /><img src="adr/images/misc/bar_emp.gif" width="{MP_PERCENT_EMPTY}" height="13" border="0" /><img src="adr/images/misc/bar_blue_end.gif" width="6" height="13" /></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="6" class="row2">
						<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
						<tr>
							<td align="center" height="19"><span class="gensmall">{L_WEIGHT}: {WEIGHT} / {WEIGHT_MAX}</td>
						</tr>
						<tr>
							<td align="center">&nbsp;<img src="adr/images/misc/bar_orange_begin.gif" width="6" height="13" /><img src="adr/images/misc/bar_orange_middle.gif" width="{WEIGHT_PERCENT_WIDTH}" height="13" border="0" /><img src="adr/images/misc/bar_emp.gif" width="{WEIGHT_PERCENT_EMPTY}" height="13" border="0" /><img src="adr/images/misc/bar_orange_end.gif" width="6" height="13" /></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="6" class="row2">
						<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
						<tr>
							<td align="center" height="19"><span class="gensmall">{L_EXPERIENCE} {EXP} / {EXP_MAX}</td>
						</tr>
						<tr>
							<td align="center">&nbsp;<img src="adr/images/misc/bar_green_begin.gif" width="6" height="13" /><img src="adr/images/misc/bar_green_middle.gif" width="{EXP_PERCENT_WIDTH}" height="13" border="0" /><img src="adr/images/misc/bar_emp.gif" width="{EXP_PERCENT_EMPTY}" height="13" border="0" /><img src="adr/images/misc/bar_green_end.gif" width="6" height="13" /></td>
						</tr>
						</table>
					</td>
				</tr>
                <tr>
                    <td colspan="6" class="row1"><img src="images/spacer.gif" alt="" width="0" height="{V_SPACER_HEIGHT}" /></td>
                </tr>
                <tr>
                    <td align="center" class="row2" width="5%"><img src="adr/images/misc/au.gif" alt="{L_POINTS}" height="{AU_HT}"></td>
                    <td align="center" class="row2" width="30%"><span class="gensmall">{L_POINTS}</span></td>
                    <td align="center" class="row2" width="15%"><span class="gen">{POINTS}</span></td>
                    <td align="center" class="row2" width="5%">&nbsp;</td>
                    <td align="center" class="row2" width="30%">&nbsp;</td>
                    <td align="center" class="row2" width="15%">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" class="row2" width="5%"><img src="adr/images/misc/sp.gif" alt="{L_SP}" height="{SP_HT}"></td>
                    <td align="center" class="row2" width="30%"><span class="gensmall">{L_SP}</span></td>
                    <td align="center" class="row2" width="15%"><span class="gen">{SP}</span></td>
                    <td align="center" class="row2" width="5%"><img src="adr/images/misc/int.gif" alt="{L_INT}" height="{INT_HT}"></td>
                    <td align="center" class="row2" width="30%"><span class="gensmall">{L_INT}</span></td>
                    <td align="center" class="row2" width="15%"><span class="gen">{INT}</span></td>
                </tr>
                <tr>
                    <td align="center" class="row2" width="5%"><img src="adr/images/misc/ac.gif" alt="{L_AC}" height="{AC_HT}"></td>
                    <td align="center" class="row2" width="30%"><span class="gensmall">{L_AC}</span></td>
                    <td align="center" class="row2" width="15%"><span class="gen">{AC}</span></td>
                    <td align="center" class="row2" width="5%"><img src="adr/images/misc/look.gif" alt="{L_WIS}" height="{WIS_HT}"></td>
                    <td align="center" class="row2" width="30%"><span class="gensmall">{L_WIS}</span></td>
                    <td align="center" class="row2" width="15%"><span class="gen">{WIS}</span></td>
                </tr>
                <tr>
                    <td align="center" class="row2" width="5%"><img src="adr/images/misc/str.gif" alt="{L_POWER}" height="{POWER_HT}"></td>
                    <td align="center" class="row2" width="30%"><span class="gensmall">{L_POWER}</span></td>
                    <td align="center" class="row2" width="15%"><span class="gen">{POWER}</span></td>
                    <td align="center" class="row2" width="5%"><img src="adr/images/misc/cha.gif" alt="{L_CHA}" height="{CHA_HT}"></td>
                    <td align="center" class="row2" width="30%"><span class="gensmall">{L_CHA}</span></td>
                    <td align="center" class="row2" width="15%"><span class="gen">{CHA}</span></td>
                </tr>
                <tr>
                    <td align="center" class="row2" width="5%"><img src="adr/images/misc/dex.gif" alt="{L_AGILITY}" height="{AGILITY_HT}"></td>
                    <td align="center" class="row2" width="30%"><span class="gensmall">{L_AGILITY}</span></td>
                    <td align="center" class="row2" width="15%"><span class="gen">{AGILITY}</span></td>
                    <td align="center" class="row2" width="5%"><img src="adr/images/misc/witch.gif" alt="{L_MA}" height="{MA_HT}"></td>
                    <td align="center" class="row2" width="30%"><span class="gensmall">{L_MA}</span></td>
                    <td align="center" class="row2" width="15%"><span class="gen">{MA}</span></td>
                </tr>
                <tr>
                    <td align="center" class="row2" width="5%"><img src="adr/images/misc/const.gif" alt="{L_CONSTIT}" height="{CONSTIT_HT}"></td>
                    <td align="center" class="row2" width="30%"><span class="gensmall">{L_CONSTIT}</span></td>
                    <td align="center" class="row2" width="15%"><span class="gen">{CONSTIT}</span></td>
                    <td align="center" class="row2" width="5%"><img src="adr/images/misc/wis.gif" alt="{L_MD}" height="{MD_HT}"></td>
                    <td align="center" class="row2" width="30%"><span class="gensmall">{L_MD}</span></td>
                    <td align="center" class="row2" width="15%"><span class="gen">{MD}</span></td>
                </tr>
			</table>
		</span></td>
	</tr>
</table>
<br clear="all" />
<table cellspacing="1" cellpadding="1" border="1" align="center" class="forumline" width="90%">
	<tr>
		<th align="center" colspan="2">{L_BATTLE_STATISTICS}</th>
	</tr>
	<tr>
		<td align="center" class="row1" width="60%"><span class="gen">{L_BATTLE_VICTORIES}</span></td>
		<td align="center" class="row2"><span class="gen">{BATTLE_VICTORIES}</span></td>
	</tr>
	<tr>
		<td align="center" class="row1" width="60%"><span class="gen">{L_BATTLE_DEFEATS}</span></td>
		<td align="center" class="row2"><span class="gen">{BATTLE_DEFEATS}</span></td>
	</tr>
	<tr>
		<td align="center" class="row1" width="60%"><span class="gen">{L_BATTLE_FLEES}</span></td>
		<td align="center" class="row2"><span class="gen">{BATTLE_FLEES}</span></td>
	</tr>
   	<tr>
      	<td align="center" class="row1" width="60%"><span class="gen">{L_BATTLE_DOUBLE_KO}</span></td>
      	<td align="center" class="row2"><span class="gen">{BATTLE_DOUBLE_KO}</span></td>
   	</tr>
	<tr>
		<td align="center" class="catBottom" colspan="2">
			<input type="submit" name="battle_monsters" value="{L_BATTLE_SEE_MONSTERS}" class="liteoption" />
			&nbsp;&nbsp;
			<input type="submit" name="battle_players" value="{L_BATTLE_SEE_PLAYERS}" class="liteoption" />
		</td>
	</tr>
</table>
<!-- BEGIN owner  -->
<br clear="all" />
<table cellspacing="1" cellpadding="1" border="1" align="center" class="forumline" width="90%">
	<tr>
		<th align="center" colspan="2">{L_BATTLE_SKILLS}</th>
	</tr>
	<tr>
		<td align="center" class="row1" width="60%"><span class="gen">{L_BATTLE_LIMIT}</span></td>
		<td align="center" class="row2"><span class="gen">{BATTLE_LIMIT}</span></td>
	</tr>
	<tr>
		<td align="center" class="row1" width="60%"><span class="gen">{L_SKILL_LIMIT}</span></td>
		<td align="center" class="row2"><span class="gen">{SKILL_LIMIT}</span></td>
	</tr>
	<tr>
		<td align="center" class="row1" width="60%"><span class="gen">{L_TRADING_LIMIT}</span></td>
		<td align="center" class="row2"><span class="gen">{TRADING_LIMIT}</span></td>
	</tr>
	<tr>
		<td align="center" class="row1" width="60%"><span class="gen">{L_THIEF_LIMIT}</span></td>
		<td align="center" class="row2"><span class="gen">{THIEF_LIMIT}</span></td>
	</tr>
	<tr>
		<td align="center" class="catBottom" colspan="2">&nbsp;</td>
	</tr>
</table>
<!-- END owner -->

<br clear="all" />
<table cellspacing="1" cellpadding="1" border="1" align="center" class="forumline" width="90%">
	<tr>
		<td class="row1" align="center" colspan="3">
			<table cellspacing="1" cellpadding="1" border="1" align="center" width="100%" >
				<tr>
					<th align="center" colspan="6">{L_SKILLS}</th>
				</tr>
				<tr height="20">
					<td class="row2" align="center"><span class="gen"><b>{L_IMG}</b></span></td>
					<td class="row2" align="center"><span class="gen"><b>{L_LEVEL}</b></span></td>
					<td class="row2" align="center"><span class="gen"><b>{L_DESC}</b></span></td>
					<td class="row2" align="center"><span class="gen"><b>{L_PROGRESS}</b></span></td>
				</tr>
				<tr>
					<td class="row1" align="center"><img src="adr/images/skills/{MINING_IMG}" alt="{L_MINING}"></td>
					<td class="row1" align="center"><span class="gen">{MINING}</span></td>
					<td class="row1" align="center"><span class="gensmall">{L_MINING_DESC}</span></td>
					<td class="row1" align="center">
						<table align="center" width="100%" height="100%">
							<tr>
								<td align="center"><span class="gensmall">{L_MINING} : {MINING_MIN} / {MINING_MAX}</td>
							</tr>
							<tr>
								<td align="center"><img src="adr/images/misc/bar_orange_begin.gif" width="6" height="13" /><img src="adr/images/misc/bar_orange_middle.gif" width="{MINING_BAR}" height="13" border="0" /><img src="adr/images/misc/bar_emp.gif" width="{MINING_BAR_EMPTY}" height="13" border="0" /><img src="adr/images/misc/bar_orange_end.gif" width="6" height="13" /></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="row2" align="center"><img src="adr/images/skills/{STONE_IMG}" alt="{L_STONE}"></td>
					<td class="row2" align="center"><span class="gen">{STONE}</span></td>
					<td class="row2" align="center"><span class="gensmall">{L_STONE_DESC}</span></td>
					<td class="row2" align="center">
						<table align="center" width="100%" height="100%">
							<tr>
								<td align="center"><span class="gensmall">{L_STONE} : {STONE_MIN} / {STONE_MAX}</td>
							</tr>
							<tr>
								<td align="center"><img src="adr/images/misc/bar_orange_begin.gif" width="6" height="13" /><img src="adr/images/misc/bar_orange_middle.gif" width="{STONE_BAR}" height="13" border="0" /><img src="adr/images/misc/bar_emp.gif" width="{STONE_BAR_EMPTY}" height="13" border="0" /><img src="adr/images/misc/bar_orange_end.gif" width="6" height="13" /></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="row1" align="center"><img src="adr/images/skills/{FORGE_IMG}" alt="{L_FORGE}"></td>
					<td class="row1" align="center"><span class="gen">{FORGE}</span></td>
					<td class="row1" align="center"><span class="gensmall">{L_FORGE_DESC}</span></td>
					<td class="row1" align="center">
						<table align="center" width="100%" height="100%">
							<tr>
								<td align="center"><span class="gensmall">{L_FORGE} : {FORGE_MIN} / {FORGE_MAX}</td>
							</tr>
							<tr>
								<td align="center"><img src="adr/images/misc/bar_orange_begin.gif" width="6" height="13" /><img src="adr/images/misc/bar_orange_middle.gif" width="{FORGE_BAR}" height="13" border="0" /><img src="adr/images/misc/bar_emp.gif" width="{FORGE_BAR_EMPTY}" height="13" border="0" /><img src="adr/images/misc/bar_orange_end.gif" width="6" height="13" /></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="row2" align="center"><img src="adr/images/skills/{ENCHANTMENT_IMG}" alt="{L_ENCHANTMENT}"></td>
					<td class="row2" align="center"><span class="gen">{ENCHANTMENT}</span></td>
					<td class="row2" align="center"><span class="gensmall">{L_ENCHANTMENT_DESC}</span></td>
					<td class="row2" align="center">
						<table align="center" width="100%" height="100%">
							<tr>
								<td align="center"><span class="gensmall">{L_ENCHANTMENT} : {ENCHANTMENT_MIN} / {ENCHANTMENT_MAX}</td>
							</tr>
							<tr>
								<td align="center"><img src="adr/images/misc/bar_orange_begin.gif" width="6" height="13" /><img src="adr/images/misc/bar_orange_middle.gif" width="{ENCHANTMENT_BAR}" height="13" border="0" /><img src="adr/images/misc/bar_emp.gif" width="{ENCHANTMENT_BAR_EMPTY}" height="13" border="0" /><img src="adr/images/misc/bar_orange_end.gif" width="6" height="13" /></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="row1" align="center"><img src="adr/images/skills/{THIEF_IMG}" alt="{L_THIEF}"></td>
					<td class="row1" align="center"><span class="gen">{THIEF}</span></td>
					<td class="row1" align="center"><span class="gensmall">{L_THIEF_DESC}</span></td>
					<td class="row1" align="center">
						<table align="center" width="100%" height="100%">
							<tr>
								<td align="center"><span class="gensmall">{L_THIEF} : {THIEF_MIN} / {THIEF_MAX}</td>
							</tr>
							<tr>
								<td align="center"><img src="adr/images/misc/bar_orange_begin.gif" width="6" height="13" /><img src="adr/images/misc/bar_orange_middle.gif" width="{THIEF_BAR}" height="13" border="0" /><img src="adr/images/misc/bar_emp.gif" width="{THIEF_BAR_EMPTY}" height="13" border="0" /><img src="adr/images/misc/bar_orange_end.gif" width="6" height="13" /></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
</table>
<br clear="all" />
<table cellspacing="1" cellpadding="1" border="1" align="center" class="forumline" width="90%">
		<td class="row1" align="center" colspan="3">
			<table cellspacing="1" cellpadding="1" border="1" align="center" width="100%" >
				<tr>
					<th align="center" colspan="3">{L_ITEMS}</th>
				</tr>
				<tr>
					<td class="row2" align="center" colspan="2"><span class="gen">{L_COUNT_ITEMS} : {ITEMS_OWNED}</span></td>
				</tr>
				<tr>
					<td class="row1" align="center" ><span class="gen">{L_COUNT_ITEMS_INVENTORY} : {ITEMS_INVENTORY}</span></td>
					<td class="row1" align="center" ><span class="gen"><a href="{INVENTORY_LINK}">{L_SEE_INVENTORY}</a></span></td>
				</tr>
				<tr>
					<td class="row1" align="center" ><span class="gen">{L_COUNT_ITEMS_SHOPS} : {ITEMS_SHOP}</span></td>
					<td class="row1" align="center" ><span class="gen">
						<!-- BEGIN shop -->
						<a href="{SHOP_LINK}">{L_SEE_SHOP}</a>
						<!-- END shop -->
						<!-- BEGIN no_shop -->
						{L_NO_SHOP}
						<!-- END no_shop -->
					</span></td>
				</tr>
				<tr>
					<td class="row1" align="center" ><span class="gen">{L_EQUIPMENT}</span></td>
					<td class="row1" align="center" ><span class="gen"><a href="{U_EQUIPMENT}">{L_SEE_EQUIPMENT}</a></span></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br clear="all" />
<table cellspacing="0" cellpadding="0" border="0" align="center" class="forumline" width="90%">
	<tr>
		<th align="center">{L_BIO}</th>
	</tr>
	<tr>
		<td class="row1" align="center"><span class="gen">{BIO}</span></td>
	</tr>
</table>
<br clear="all" />
<!-- END adr_profile -->
</form>
