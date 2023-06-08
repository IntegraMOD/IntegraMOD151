read = new Array();
newmessage = null;
prill_log = null;
im_prefs = null;
prillian = self;

// Used to open a new Read Message window
function launch_spawn(url, leftsize, topsize, w, h)
{
	read[read.length] = window.open(url, '_blank', "width=" + w + ", innerWidth=" + w + ", height=" + h + ", innerHeight=" + h + ", left=" + leftsize + ", screenX=" + leftsize + ", top=" + topsize + ", screenY=" + topsize + ", resizable, scrollbars");
}

// Used to open a Send Message window
function new_message(url, w, h) 
{ 
	newmessage = window.open(url, 'newmessage', "width=" + w + ", innerWidth=" + w + ", height=" + h + ", innerHeight=" + h + ", resizable, scrollbars");
	newmessage.resizeTo(w,h);
}

// Used to open a Preferences window
function open_prefs(url, w, h)
{
	im_prefs = window.open(url, 'im_prefs', "width=" + w + ", innerWidth=" + w + ", height=" + h + ", innerHeight=" + h + ", resizable, scrollbars");
}

// Used to open a Message Log window
function open_log(url)
{
	prill_log = window.open(url, 'prill_log', "width=500, innerWidth=500, height=200, innerHeight=200, resizable, scrollbars");
}

function mode_switch(url, h, w)
{
	prillian.resizeTo(w, h);
	prillian.location.href = w;

}

// Used to check or uncheck a list of check boxes
function select_switch(status)
{
	for (i = 0; i < document.newmsg_list.length; i++)
	{
		document.newmsg_list.elements[i].checked = status;
	}
}

// Used to close windows
function close_window(value)
{
	if (value && value.open && !value.closed)
	{
		value.close();
	}
}

// Used to close all child windows
function kill_spawn()
{
	close_window(newmessage);
	close_window(prill_log);
	close_window(im_prefs);
	for(i=0; i<read.length; i++)
	{
		close_window(read[i]);
	}
	read = new Array();
}

// Used to close the client completely
function shut_down(url)
{
	endthem = kill_spawn();

	if (window.opener && !window.opener.closed)
	{
		window.opener.location.href = url;
	}
	else
	{
		logout = window.open(url,'_blank');
	}

	byebye = window.close();
}