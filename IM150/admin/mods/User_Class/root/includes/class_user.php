<?php

/* User Class defined by kooky */

class user
{
	private:
		var $user_id;
		var $username;
		var $user_password;
		var $user_email;
		var $user_level;
		var $user_gender;
		var $user_birthday;

	public:
		// Constructor
		function user()
		{
			$this->user_id = $user_id;
			$this->username = $username;
			$this->user_level = $user_level;
		}

		// Defined user level and his color
		function user_color($user_id, $user_level)
		{
				switch ( $user_level )
				{
					case ADMIN:
						$username = '<strong>' . $username . '</strong>';
						$style_color = ($user_id == 2) ? ' style="color: #' . $theme['color_founder'] . '"' : ' style="color: #' . $theme['color_admin'] . '"';
						break;
					case MAIN_MOD:
						$username = '<strong>' . $username . '</strong>';
						$style_color = ' style="color: #' . $theme['color_main_mod'] . '"';
						break;
					case MOD:
						$username = '<strong>' . $username . '</strong>';
						$style_color = ' style="color: #' . $theme['color_mod'] . '"';
						break;
					case SUPPORT:
						$username = '<strong>' . $username . '</strong>';
						$style_color = ' style="color: #' . $theme['color_support'] . '"';
						break;
					case VIP:
						$username = '<strong>' . $username . '</strong>';
						$style_color = ' style="color: #' . $theme['color_vip'] . '"';
						break;
					case BOT:
						$username = '<strong>' . $username . '</strong>';
						$style_color = ' style="color: #' . $theme['color_bot'] . '"';
						break;
					case USER:
						$username = '<strong>' . $username . '</strong>';
						$style_color = ' style="color: #' . $theme['color_user'] . '"';
						break;
					default:
						$username = $username;
						$style_color = '';
						break;
				}
				$username = '<span' . $style_color . '>' . $username . '</span>';
		}

		function user_gender($user_gender)
		{
			switch ($user_gender)
			{
				case male:
					$user_gender = $lang['Male'];
					break;
				case female:
					$user_gender = $lang['Female'];
					break;
				default:
					$user_gender = '';
					break;
			}
		}

		function user_birthday()
		{
		}

		function create_level()
		{
		}

		function create_user()
		{
		}

		function whoisonline($user_level)
		{
		}
} // End of class_user

?>