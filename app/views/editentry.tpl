    <h1 class="cover-heading">Edit Event Entry</h1>

    <p class="lead">Please enter the details of the event.</p>
    <form class="form-signin" action="EditEntry.do" method="post">
        <input type="hidden" name="eid" id="eid" value="[::id::]">
      Please select the event Date &amp; Time:<br/>
		<input type="text" name="entDate" id="entDate" value="[::date::]"/><br/><br/>
      Please select the classification of the event:<br/>
      <select name="entType" class="form-control center" style="width:255px;">
      [::type::]
       </select><br/>
      Please give a complete description of the event:<br/>
      <textarea name="entDesc" cols="40" rows="5" class="form-controlcenter editor" placeholder="Complete description of the event" style="width:300px;display:inline-block;overflow:hidden;" required="" spellcheck="true">[::description::]</textarea><br>
      Please re-enter your password to save the entry:<br/>
      <input type="password" name="entBy" class="form-control center" placeholder="Your Password" style="width:255px;" required="" spellcheck="false"><br/>
         <div><button class="btn btn-lg btn-primary btn-block center" type="submit" id="send" style="width:255px;" onclick="disableButton()">Continue</button>
        <script>
        const disableButton = () => {
            // Get the button element by id
            var button = document.getElementById("send");

            // Add the disabled class using classList.add()
            button.classList.add("disabled");
             }
        </script></div>

