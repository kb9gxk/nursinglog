            <h1 class="cover-heading">[::myaction::]</h1>
            <form class="form-signin" id="riskmanage" method="post">
                [::content::]
                <button class="btn btn-lg btn-primary btn-block" id="send" type="submit" formaction="/[::action::].do">Submit</button>
        <script>
        const disableButton = () => {
            // Get the button element by id
            var button = document.getElementById("send");

            // Add the disabled class using classList.add()
            button.classList.add("disabled");
             }
        </script></div>

            </form>