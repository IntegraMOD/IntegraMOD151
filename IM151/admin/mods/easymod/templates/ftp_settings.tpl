
		<tr>
			<th colspan="2">{{EM_ftp_title}}</th>
		</tr>
		<tr>
			<td class="row2" align="center" colspan="2"><span class="gen">{{EM_ftp_desc}}</span></td>
		</tr>
		<tr>
			<td class="row1" align="right"><span class="gen">{{EM_ftp_dir}}</span></td>
			<td class="row2"><input type="text" name="ftp_dir" /> <span class="gen">({{DIR_EX}}) (<a href="{{U_FORM}}?mode=help#ftp_dir" onclick="return helpwin(this)">{{EM_more_info}}</a>)</span></td>
		</tr>
		<tr>
			<td class="row1" align="right"><span class="gen">{{EM_ftp_user}}</span></td>
			<td class="row2"><input type="text" name="ftp_user" /></td>
		</tr>
		<tr>
			<td class="row1" align="right"><span class="gen">{{EM_ftp_pass}}</span></td>
			<td class="row2"><input type="password" name="ftp_pass" /></td>
		</tr>
		<tr>
			<td class="row1" align="right"><span class="gen">{{EM_ftp_host}}</span></td>
			<td class="row2"><input type="text" name="ftp_host" value="localhost" /> <span class="gen">{{EM_ftp_host_info}} (<a href="{{U_FORM}}?mode=help#ftp_host" onclick="return helpwin(this)">{{EM_more_info}}</a>)</span></td>
		</tr>
		<tr>
			<td class="row1" align="right"><span class="gen">{{EM_ftp_port}}</span></td>
			<td class="row2"><input type="text" size="5" maxlength="5" name="ftp_port" value="21" /> <span class="gen">{{EM_ftp_port_info}} (<a href="{{U_FORM}}?mode=help#ftp_port" onclick="return helpwin(this)">{{EM_more_info}}</a>)</span></td>
		</tr>
		<tr>
			<th colspan="2">{{EM_ftp_advance_settings}}</th>
		</tr>
		<tr>
			<td class="row1" align="right"><span class="gen">{{EM_ftp_debug}}</span></td>
			<td class="row2">
				<input type="radio" name="ftp_debug" value="1" /><span class="gen">{{EM_yes}}</span>&nbsp;&nbsp;
				<input type="radio" name="ftp_debug" value="0" checked="checked" /><span class="gen">{{EM_no}}</span>&nbsp;&nbsp;<span class="gen">{{EM_ftp_debug_not}} (<a href="{{U_FORM}}?mode=help#ftp_debug" onclick="return helpwin(this)">{{EM_more_info}}</a>)</span>
			</td>
		</tr>
		<tr>
			<td class="row1" align="right"><span class="gen">{{EM_ftp_use_ext}}</span></td>
			<td class="row2">{{FTP_EXT_MSG}}
				<input type="radio" name="ftp_type" value="ext" {{EXT_YES}} /><span class="gen">{{EM_yes}}</span>&nbsp;&nbsp;
				<input type="radio" name="ftp_type" value="fsock" {{EXT_NO}} /><span class="gen">{{EM_no}}</span>&nbsp;&nbsp;<span class="gen">{{EM_ftp_ext_not}} (<a href="{{U_FORM}}?mode=help#ftp_php_ext" onclick="return helpwin(this)">{{EM_more_info}}</a>)</span>
			{{FTP_EXT_CLOSE}}
			</td>
		</tr>
		<tr>
			<td class="row1" align="right"><span class="gen">{{EM_ftp_use_cache}}</span></td>
			<td class="row2">{{FTP_CACHE_MSG}}
				<input type="radio" name="ftp_cache" value="1" {{CACHE_YES}} /><span class="gen">{{EM_yes}}</span>&nbsp;&nbsp;
				<input type="radio" name="ftp_cache" value="0" {{CACHE_NO}} /><span class="gen">{{EM_no}}</span>&nbsp;&nbsp;<span class="gen">{{EM_ftp_ext_not}} (<a href="{{U_FORM}}?mode=help#ftp_cache" onclick="return helpwin(this)">{{EM_more_info}}</a>)</span>
			{{FTP_CACHE_CLOSE}}
			</td>
		</tr>
