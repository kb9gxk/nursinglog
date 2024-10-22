<?php
//include ( "iNotes.php" );
$content = '    <input type="hidden" name="username" />';
$content .= '    <input type="hidden" name="fullname" />';
$content .= '    Please enter a new password for: ' . $cfname . '<br/>';
$content .= '    <input type="password" required name="old" class="form-control" placeholder="Old Password" required autofocus spellcheck="false"/><div id="status"></div>';
$content .= '    <div>New password must be a minimum of 6 characters, contain at least 1 number, a Upper Case letter, Lower Case letter and Special Character</div>';
// at least one number, one lowercase and one uppercase letter
// at least six characters that are letters, numbers or the underscore
$content .= '    <input type="password" required pattern="^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*\d)(?=\S*([^\w\s]|[_]))\S{6,20}$" name="new1" onchange="form.new2.pattern = RegExp.escape(this.value);" class="form-control" placeholder="New Password" title="Must contain at least one number, uppercase, lowercase letter, special character and at least 6 or more characters" spellcheck="false"/><div id="status"></div>';
$content .= '    <input type="password" required name="new2" class="form-control" placeholder="Verify New Password" required spellcheck="false"/><div id="status"></div>';
$content .= '    <input type="hidden" name="id" value="' . $uid . '" />';
return (array('content' => $content, 'action' => 'NewPass', 'myaction' => 'Change Password'));
?>