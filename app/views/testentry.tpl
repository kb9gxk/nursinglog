    <h1 class="cover-heading">New Event Entry</h1>

    <p class="lead">Please enter the details of the event.</p>

    <form class="form-signin" action="AddEntry.do" method="post">

        Please select the event Date &amp; Time:<br>
        <input type="text" name="entDate" id="entDate" value="[::date::]"><br/>
        <br/>
        Please select the classification of the event:<br/>
        <select name="entType" class="form-control center" style="width:255px;">
            [::type::]
          </select><br/>
        Please give a complete description of the event:<br>
           <textarea id="entDesc" name="entDesc" cols="40" rows="5" class="form-control editor" placeholder="Complete description of the event" style="width:300px;display:inline-block;overflow:hidden;" required="" spellcheck="true">[::description::]</textarea><br>

        Please re-enter your password to save the entry:<br>
        <input type="password" name="entBy" class="form-control center" placeholder="Your Password" style="width:255px;" required=""><br>
        <div><button class="btn btn-lg btn-primary btn-block center" type="submit" id="send" style="width:255px;"><i class="submit-entry"></i>Continue</button>
        <script>function spinner(){var x=$(".submit-entry"),s ='<span class="cspinner_container" style="position: absolute; width: 18px; height: 14px; display: inline-block;"><span class="cspinner" style="margin-top: 2px; margin-left: -22px;"><span class="cspinner-icon white small"></span></span></span>';x.addClass("invisible").after(s);x.parent(".btn").addClass("disabled")}</script></div>

    </form>
