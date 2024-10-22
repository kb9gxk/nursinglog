    <h1 class="cover-heading">Edit Event Category</h1>

    <p class="lead">Please enter the details of the event.</p>
    <form class="form-signin" action="EditCat.do" method="post">
        <input type="hidden" name="eid" id="eid" value="[::id::]">
      Please select the event Date &amp; Time: (View Only)<br/>
        <input disabled type="text" name="entDate" id="entDate" value="[::date::]"/><br/><br/>
      Please select the classification of the event:<br/>
      <select name="entType" class="form-control center" style="width:255px;">
      [::type::]
       </select><br/>
      Please give a complete description of the event:<br/>
      <textarea disabled name="entDesc" cols="40" rows="5" class="form-controlcenter" placeholder="Complete description of the event" style="width:255px;" required="" spellcheck="true">[::description::]</textarea><br>
      <!--Please re-enter your password to save the entry:<br/>
      <input type="password" name="entBy" class="form-control center" placeholder="Your Password" style="width:255px;" required=""><br/>-->
      <button class="btn btn-lg btn-primary btn-block center" type="submit" id="send" style="width:255px;" >Continue</button>
    </form>
