var fblogin = null;
var fbopen = null;
var fbtime = 0;
var fbhtml = '';

function checkPopup() 
{
	if (fblogin != null)
	{
		if (fblogin.closed == false)
		{
			if (fbtime >= 10)
			{
				fblogin.close();
				$('button#btn-fblogin').html(fbhtml);
				return;
			}
		
			fbtime++;
			setTimeout(checkPopup, 1000);
		}
	}
}

function facebookPopup(url)
{
	if (fblogin != null)
	{
		if(fblogin.closed == false)
		{
			fblogin.focus();
			return;
		}
	}

	fblogin = window.open(url, "facebook_popup", "width=600,height=350,status=no,scrollbars=no,resizable=no");
	fblogin.focus();
	fbhtml = $('button#btn-fblogin').html();
	$('button#btn-fblogin').html('<span class="fa fa-clock-o jump-5"></span> Aguardando Facebook...');
	
	fbopen = new Date();
	fbtime = 0;
	setTimeout(checkPopup, 1000);
};
