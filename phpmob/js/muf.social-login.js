var fb_login = null;
var fb_open = null;
var fb_time = 0;
var fb_html = '';
var fb_panelurl = '';

function checkPopup() 
{
	if (fb_login != null)
	{
		if (fb_login.closed == true)
		{
			location.href = fb_panelurl;
		}
		else
		{
			/*
			if (fb_time >= 10)
			{
				fb_login.close();
				$('button#btn-fb_login').html(fb_html);
				return;
			}
			*/
		
			fb_time++;
			setTimeout(checkPopup, 1000);
		}
	}
}

function facebookPopup(url, redirect)
{
	if (fb_login != null)
	{
		if(fb_login.closed == false)
		{
			fb_login.focus();
			return;
		}
	}

	fb_login = window.open(url, "facebook_popup", "width=600,height=350,status=no,scrollbars=no,resizable=no");
	fb_login.focus();
	fb_html = $('button#btn-fb_login').html();
	$('button#btn-fb_login').html('<span class="fa fa-clock-o jump-5"></span> Aguardando Facebook...');
	
	fb_open = new Date();
	fb_time = 0;
	fb_panelurl = redirect;
	setTimeout(checkPopup, 1000);
};
