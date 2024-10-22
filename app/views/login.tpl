          <div class="inner cover">
            <div class="cover-heading h1">Log In</div>
				[::errors::][::messages::][::notice::][::sysmsg::]
			<form class="form-signin" method="post" autocomplete="off">
        <div class=" h3 form-signin-heading">Please Sign In</div>
        <div class="input-group margin-bottom-sm">
            <span class="input-group-addon"><i class="fas fa-user fa-fw"></i></span>
            <input type="text" id="username" name="username" class="form-control" placeholder="username" autofocus>
        </div>
        <div>Password is Case Sensitive</div>
        <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-key fa-fw"></i></span>
            <input class="form-control" id="password" name="password" type="password" placeholder="Password" spellcheck="false">
        </div>
        <input type="hidden" id="lat" name="lat" value="" />
        <input type="hidden" id="lon" name="lon" value="" />
        <br/>
        <div class="form-group">
            <button class="btn btn-primary pull-left" type="submit" id="Login" style="margin-top: 0 !important; width: 50%" formaction="/Login.do"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Sign in</button>
            <button class="btn btn-default pull-right" type="submit" style="width: 50%" formaction="/Remind.do"><i class="fas fa-question fa-fw"></i>&nbsp;&nbsp;Password hint</button>
        <script nonce='52cJV8rCl9MKvNPV'>function spinner(){var x=$(".fa-sign-in-alt"),s ='<span class="cspinner_container" style="position: absolute; width: 18px; height: 14px; display: inline-block;"><span class="cspinner" style="margin-top: 2px; margin-left: -22px;"><span class="cspinner-icon white small"></span></span></span>';x.addClass("invisible").after(s);x.parent(".btn").addClass("disabled")}</script></div></form>
        <script type="text/javascript" nonce='jQrNw92TqE1tOTaS'>
            localStorage.clear();
        </script>
        </div>
        <div class="text-muted credit">The communication log makes use of cookies stored on your device for the duration of your logged in session.<br>
        There is no personally identifiable information stored, tracked or shared.<br>It is only used to validate you are logged in and is removed upon logoff.</div>