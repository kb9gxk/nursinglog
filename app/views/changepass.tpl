<div class="inner cover embeded-responsive">
    <h1 class="cover-heading">[::myaction::]</h1>
    <form class="form-signin" id="usermanage" role="form" action="[::action::].do" method="post">
        [::content::]
        <button class="btn btn-lg btn-primary btn-block" id="send" type="submit">Change Password</button>
    </form>
</div>
<script type="text/javascript">
    // polyfill for RegExp.escape
    if (!RegExp.escape) {
        RegExp.escape = function(s) {
            return String(s).replace(/[\\^$*+?.()|[\]{}]/g, '\\$&');
        };
    }
</script>