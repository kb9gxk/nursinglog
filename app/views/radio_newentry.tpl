    <h1 class="cover-heading">New Radio Entry</h1>

    <p class="lead">Please enter the details of the radio.</p>

    <form class="form-signin" action="AddRadioEntry.do" method="post">
      <center>
        Please select the which radio:<br>
        <select name="entRadio" id="entRadio" class="form-control" style="width:255px;">
            [::radio::]
          </select><br>
        Please select the entry type:<br>
        <select name="entType" id="entRadio" class="form-control" style="width:255px;">
            [::type::]
          </select><br>
        What is the current condition of the radio:<br>
           <textarea id="entDesc" name="entDesc" cols="40" rows="4" class="form-control" placeholder="Enter condition of the radio" style="width:300px;" required="" spellcheck="true">[::description::]</textarea>           
           <br>

        <button class="btn btn-lg btn-primary btn-block" type="submit" id="send" style="width:255px;">Continue</button>
      </center>
    </form>

