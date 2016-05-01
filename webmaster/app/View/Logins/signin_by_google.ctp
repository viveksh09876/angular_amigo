<script src="<?php echo $this->webroot;?>vendor/jquery/jquery.min.js"></script><script>
        var OAUTHURL    =   'https://accounts.google.com/o/oauth2/auth?';
        var VALIDURL    =   'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=';
        var SCOPE       =   'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email';
        var CLIENTID    =   '<?php echo CLIENTID;?>';
        var REDIRECT    =   '<?php echo REDIRECT;?>';
        var LOGOUT      =   'http://accounts.google.com/Logout';
        var TYPE        =   'token';
        var _url        =   OAUTHURL + 'scope=' + SCOPE + '&client_id=' + CLIENTID + '&redirect_uri=' + REDIRECT + '&response_type=' + TYPE;
        var acToken;
        var tokenType;
        var expiresIn;
        var user;
        var loggedIn    =   false;

        function login() {
            var win  =   window.open(_url, "windowname1", 'width=600, height=500'); 
         
             /*var pollTimer   =   window.setInterval(function() { 
             
                if (win.document.URL.indexOf(REDIRECT) != -1 ) {
                   
                    window.clearInterval(pollTimer);
                    var url =   win.document.URL;
                    acToken =   gup(url, 'access_token');
                    tokenType = gup(url, 'token_type');
                    expiresIn = gup(url, 'expires_in'); 			
                      		
                }
            }, 500);*/
		

        }     
        
        function login_redirect(){
			//alert("in redirect");
			//document.location.href = window.location;
			var pollTimer   =   window.setInterval(function() { 
				 
			if (window.document.URL.indexOf(REDIRECT) != -1 ) {
						//alert("in close");
						window.clearInterval(pollTimer);
						var url =   window.document.URL;
						acToken =   gup(url, 'access_token');
						tokenType = gup(url, 'token_type');
						expiresIn = gup(url, 'expires_in');    						           
						window.close();
						var rUrl="<?php echo Router::url('/logins/verify_google_login',true);?>?token="+acToken;
						window.opener.location.href=rUrl;
													
				}
			  }, 500);
       		
        
			
        }
        
        function urlencode (str) {
  // http://kevin.vanzonneveld.net
  // +   original by: Philip Peterson
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: AJ
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: travc
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Lars Fischer
  // +      input by: Ratheous
  // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Joris
  // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
  // %          note 1: This reflects PHP 5.3/6.0+ behavior
  // %        note 2: Please be aware that this function expects to encode into UTF-8 encoded strings, as found on
  // %        note 2: pages served as UTF-8
  // *     example 1: urlencode('Kevin van Zonneveld!');
  // *     returns 1: 'Kevin+van+Zonneveld%21'
  // *     example 2: urlencode('http://kevin.vanzonneveld.net/');
  // *     returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
  // *     example 3: urlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
  // *     returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'
  str = (str + '').toString();

  // Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
  // PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
  return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').
  replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
}

        

        //credits: http://www.netlobo.com/url_query_string_javascript.html
        function gup(url, name) {
            name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
            var regexS = "[\\#&]"+name+"=([^&#]*)";
            var regex = new RegExp( regexS );
            var results = regex.exec( url );
            if( results == null )
                return "";
            else
                return results[1];
        }

        function startLogoutPolling() {
           	myIFrame.location='https://www.google.com/accounts/Logout';
		loggedIn = false;
          	return false;
        }

</script>
<a href="#" style="display:none" id="logoutText" target='myIFrame' onclick="myIFrame.location='https://www.google.com/accounts/Logout'; startLogoutPolling();return false;"> Click here to logout </a>
<iframe name='myIFrame' id="myIFrame" style='display:none'></iframe>
<div id='uName'></div>
<!-- <img src='' id='imgHolder'/> -->

 <script type="text/javascript">
 $(function(){
     login_redirect();
 });
       
</script>