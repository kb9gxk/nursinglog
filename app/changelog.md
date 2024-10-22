# RELEASE NOTES

---

## V2024.08.20.r0849

### CHANGES

- Removed ambiguous character | from password generation to prevent typos.
  
---

## V2024.07.12.r0906

### CHANGES

- Moved Password generation to the common code to remove reduce duplicating in multiple locations.
- Removed ambiguous letters i, I, and O from password generation to prevent typos.

---

## V2024.07.05.r1335

### CHANGES

- NON-CODE: Cleaned up some lingering formatting on the Release Notes

---

## V2024.06.24.r1507

### CHANGES

* Removed hard to read special characters from password generation.

---

## V2024.06.21.r1515

### CHANGES

* Password generation is now 7 random alpha-numeric characters followed by a special character.

### FIXES

* Fixed not showing the users full name when doing a password reset.

---

## V2024.05.16.r0854

### CHANGES

* NON-CODE: Cleaned up Release Notes

---

## V2024.04.19.r0906

### CHANGES

* Changed login history to only show the last 50 logins.

### FIXES

* Fixed inability to load user login history.

---

## V2023.12.22.r1940

### FIXES

* Fixed PHP max_execution_time to 5 minutes
* Fixed an "Undefined Constant" error when editing comments.

---

## V2023.12.21.r1442

### ADDED

* Added a Maintenace Mode (init.php).

---

## V2023.11.13.r1319

### FIXES

* Fixed submission buttons to not allow saving an entry multiple time.
* Fixed the look of the password reminder button on the login page.

---

## V2023.08.07.r1333

### CHANGES

* Changed Default log view to 7 days instead of 24 hours.
* Changed wording on admin closure of comments.

---

## V2023.05.31.r0957

### ADDITIONS

* Added Request-OTR header for the additional privacy that the Brave browser introduced.

---

## V2022.09.22.r1058

### CHANGES

* Disabled browsers spellcheck on all password fields. [Enhanced Spellcheck Features Expose PII Even Your Passwords](https://www.otto-js.com/news/article/chrome-and-edge-enhanced-spellcheck-features-expose-pii-even-your-passwords)

---

## V2022.04.14.r1054

### CHANGES

* Added users name to error handling emails on the backend if a user is logged in. (This will help if additional information is needed to diagnose an error)

---

## V2022.04.07.r1139

### FIXES

* Fixed the Date/Time of the Event so they are parallel to each other.

---

## V2022.04.07.r1034

### ADDITIONS

* Added the Entered Date/Time to log entries, along with Event Date/Time.

---

## V2022.02.09.r1549

### CHANGES

* Default new users to allow commenting/notes.

### ADDITIONS

* Added hidden code to mass mark comments/notes as resolved in the 24hr view.
* Opt out of Google's Topics API.

---

## V2021.08.05.r1358

### CHANGES

* Adjusted code to allow for change to new domain TLD. (Replaced '.click' with SUFFIX)

---

## V2021.06.21.r0922

### CHANGES

* Abuse types now require the Deanonymizing role to view the original author, and only a Super Admin can assign that role

---

## V2021.06.18.r0838

### ADDITIONS

* If an entry type starts with "Abuse", the By field will show "ANONYMOUS" for all users except admins. (This is to allow an Anonymous Whistle Blower feature to the log.)

---

## V2021.04.14.r0807

### ADDITIONS

* Opt out of Chrome's Federated Learning of Cohorts (aka "FLoC") tracking.
* Add ability of Super-Admins to quickly "Resolve" open comments.

---

## V2020.12.24.r0951

### FIXES

* Fixed CSS display issues.

---

## V2020.12.24.r0848

### FIXES

* Fixed default content width to better show the author of the log entry.

---

## V2020.10.06.r0825

### FIXES

* Fixed color of input on Comments for Staff/Department Responsible from White to Black so it can be seen.

---

## V2020.09.24.r1435

### FIXES

* Fixed IP Matching to allow for allowing CIDR addressing (ex: 192.168.0.1/24 would match 192.168.0.15)

---

## V2020.09.24.r1340

### FIXES

* Fixed issue with the Clear Comments >24hr option being shown when there are No Comments, or the Comment has been marked resolved.

---

## V2020.09.22.r1205

### ADDITIONS

* Added the ability for an Admin to mark an entry with comments as Completed without having to Resolve. This can help remove entries from always showing on the 24hr view. (Clipboard with Check)

---

## V2020.09.08.r1208

### FIXES

* Fixed issue where IP Lockdown did not work for logging in.

---

## V2020.03.20.r1553

### ADDITIONS

* Added the ability to use EMOJI in the notes and comments.

---

## V2020.03.11.r0924

### FIXES

* Fixed issue of creating a new comment you could not see what you were typing.

---

## V2020.03.10.r1027

### FIXES

* Fixed issue of "Admin Items"/"Add/Edit Categories" switching to Bayside log.

---

## V2020.03.10r1020

### ADDITIONS

* Added ability for a new "Note" to be marked as resolved upon creation.

---

## V2020.02.06r0934

### FIXES

* Corrected issue where new passwords were not requiring special characters.

---

## V2020.02.05r1043

### FIXES

* Fixed an issue that a new user never got the "Change Password" screen and were looped back to the login again.
* Fixed an issue where the "Menu" would show for new users that had to change their initial password.
* Again, fixed an issue where the "Menu" appears to a user that is not logged in.

---

## V2020.01.13r1202

### FIXES

* Again, fixed an issue where the "Menu" appears to a user that is not logged in.

---

## V2020.01.13r1152

### CHANGES

* Errors are automatically reported to the developer for being fixed.

---

## V2020.01.08r2346

### CHANGES

* Updated encryption engine to latest version.
  
  ### FIXES

* Corrected speed issues (`apt install php7.x-gmp`)

---

## V2019.12.16r1437

### CHANGES

* Updated menu items to better match an upcoming PC application.

---

## V2019.12.05r0923

### FIXES

* Fixed an issue where end user IP may not be gathered correctly if backend is behind a reverse

---

## V2019.11.18r0846

### FIXES

* Fixed an issue where and entry was able to be made for a future date.

---

## V2019.08.14r0845

### FIXES

* Fixed an issue where when editing a user, you could not change their department.

---

## V2019.08.13r0941

### ADDITIONS

* Added ability to reset a user's password. This will generate a new password that they will have to change.

---

## V2019.08.12r0926

### FIXES

* Fixed the size of the editor while creating entries. You should be able to read what you are typing....

---

## V2019.08.09r1713

### FIXES

* Fixed issue where a user's department was cleared when editing a user.
* Fixed an issue where a standard admin automatically had the ability to delete entries (This should only be Super Admin or specifically allowed)

---

## V2019.07.24r1257

### CHANGES

* Made VISUAL Editor the default for all users
* Removed the Editor context menu and using the browser default to allow for Copy/Paste. Other options were already listed in the toolbar menu anyway

---

## V2019.05.20r0940

### FIXES

* Fixed issue with being unable to log in after timing out on login. (May have to force clear cookies)

---

## V2019.05.16r0953

### CHANGES

* Updated the "Icon" for the web browser and added it as a logo on-screen.

### FIXES

* Changed the way COOKIES are stored. They are now marked so only the log has access and no other reference points.

---

## V2019.04.11r0837

### FIXES

* Fixed the default name when making the Communication Log a "webapp", will use "Communication Log" instead of "App".

---

## V2019.02.19r1520

### FIXES

* Fixed category search issued caused by adding the ability to change categories.

### KNOWN ISSUES

* Visual editor will continue requiring keyboard-based Copy/Paste due to limitations in web browser.

---

## V2019.02.19r1200

### ADDITIONS

* Ability for Admin to change an event to proper category without adding "modified" tag.

### CHANGES

* Corrected footer to reflect Abbott House, LLC

---

## V2019.02.07r0834

### ADDITIONS

* Ability to edit Event Categories from the ADMIN Menu.

### CHANGES

* Event Categories are now in a First/Second/Third Format for multiple dropdown menus.
* Screen Width was increased to allow for more information to be displayed.

---

## V2019.02.06r1134

### ADDITIONS

* Ability to search log by category.

---

## V2019.02.04r1131

### ADDITIONS

* Spellcheck for Visual editor

### KNOWS ISSUES

* Visual editor will continue requiring keyboard-based Copy/Paste due to limitations in web browser.

---

## V2019.01.18r1545

### NEW

* Visual editor for ADMIN users.

### KNOWN ISSUES

* Visual editor requires Keyboard Copy/Paste.

---

## V2018.12.19r0942

### FIXES

* Fixed an issue where a user can bypass changing their password.

---

## V2018.12.15r1805

#### CHANGES

* Password Minimums Enforcement (1 Upper, 1 Lower, 1 Number, 1 Special Character)

---

## V2018.11.12r1324

### FIXES

* Fixed editing a user who did not have an assigned department.

---

## V2018.11.12r1203

### ADDITIONS

* Login History option under the Admin menu

### CHANGES

* Updated Department Types

---

## V2018.10.30r1330

### CHANGES

* Changed Plan of Correction to Comments
* Changed the Graph icon to a Comment Icon

---

## V2018.10.29r1440

### FIXES

* Fixed issue with displaying notes having extra "\" shown.

---

## V2018.02.22r1332

### CHANGES

* Updated SSL Certificate to an auto-renewing Lets Encrypt one.
* Added more options to the Category Dropdown for new log entries.

---

## V2017.11.16r1334

### FIXES

* Corrected updating of Risk Mitigation files.

---

## V2017.11.16r0612

### ADDIONS

* Added Plan of Correction module
* Added Risk Management module

### KNOW ISSUES

* Risk Management module currently is not working for editing existing RISK

---

## V2017.10.04r1154

### CHANGES

* Forced site to be SSL (HTTPS) if not, reload as secure.

---

## V2017.10.02r1529

### CHANGES

* Moved BST & ABH Back to original server which is capable of handling the high encryption load.

---

## V2017.09.12r1741

### CHANGES

* Moved to new server (BST & ABH Clients Only)

---

## V2017.04.09r2045

### CHANGES

* Changed code to fix issues with different hosting provider. All code rendering now done internally (php, html and do)

---

## V2017.03.25r0002

### CHANGES

* Fixed the Security SSL certificate expiration error. We have moved to Comodo for the new certificate.
* Force IE to use latest rendering engine, do not allow compatibility mode. This is being done as we will be phasing out older web browser support.

---

## V2017.01.17r0025

### FIXES

* Corrected issue where users were given remote access even when their account was not set to allow it.

---

## V2016.12.29r0519

* Initial Public Release of the NursingLog.Click System
* All Previous entries were done for Test Client to ready system.
* All New entries will be for initial Test Client and new clients.

---

## V2016.12.26r2353

### CHANGES

* NON-CODE Related - Adjusted Changelog to reflect Version and Revision v(YYYY.MM.DD)r(HHMM)

---

## V2016.12.26r2328

### ADDITIONS

* Created common code for user information and session timeouts.

### REMOVAL

* Removed redundant code for session timeouts
* Removed redundant code for loading iAccess and iTypes

---

## V2016.12.26r2244

### ADDITIONS

* Added User Department as part of Logged in Username

### CHANGES

* Sorting Departments alphabetically
* Sorting Not Types alphabetically
* Ensured HTML5 Standards across the board
* Fixed Login submit buttons to be HTML5 standards (removed JavaScript)

---

## V2016.12.25r0041

### ADDITIONS

* Added Departments to User Accounts
* Enabled ability to create Admin Accounts
* Enabled ability to allow Remote Access
* Enabled ability to allow a user to remove log entries (Use with caution)
* Enabled ability to remove a users access
* Enabled ability to view Update Log by clicking the version number.

### CHANGED

* Admin menu now shows disabled accounts with strikeout text
* Removed Reset Password and made Edit User

---

## V2016.12.11r1730

### ADDITIONS

* Enabled users for Remote Access

---

## V2016.11.26r1925

### ADDITIONS

* Added new CARF options to Entry Dropdown Menu

### CHANGES

* Moved Event Dropdown list options to iType.php for easier editing
* Log view now chooses based off the "Key" value of $iType[] array for new entries.

---

## V2016.10.26r1302

### ADDITIONS

* Added QAPI Suggestions to the New Entry Dropdown Menu

### KNOWN ISSUES

* Remove QAPI Suggestions from standard log and make as its own Log filter

---

## V2016.6.21r2158

### REMOVAL

* Removed Radio Log

---

## V2016.1.17r1840

### ADDITIONS

* Admin view by default only shows "Current" accounts.

### TO-DO

* Add ability for displaying ALL Users and ability to change status.

---

## V2015.12.20r1709

### ADDITIONS

* Added a 16 hour view for the communication log.

---

## V2015.11.9r0846

### CORRECTIONS

* Fixed adding radio entries. Forgot to change entDate to entRadio

---

## V2015.11.8r2032

### CHANGES

* Radio Log only viewable from Admin accounts, standard users can only create entries
* Admin users can create a Radio entry for multiple radios, must be done in description after selecting Multiple Radios option.

---

## V2015.11.8r1719

### CORRECTIONS

* Fixed an issue with the Radio Log not specifying that it was the RADIO log.

---

## V2015.11.8r1657

### ADDITIONS

* Added a new section for logging Radio check-in/check-out and conditions

---

## V2016.9.16r1100

### CHANGES

* Added the ability to press ENTER while on in the password field for entries & logins to Submit the form

### FIXES

* When submitting a form, the submit button is disabled once "clicked" to prevent duplicate entries

---

## V2015.9.4r0657

### CORRECTIONS

* If an entry starts to get edited, but then is canceled, that content will no go to new entries

### CHANGES

* Menu system was separated from the individual pages and is now pulled in as its own template. Why were we duplicating the menu on every page again?

---

## V2015.8.25r1601

### CORRECTIONS

* Allows for array of allowed IP addresses to allow for access. Opened to public Wi-Fi and AT&T Backup connection.

---

## V2015.8.23r1628

### ADDITIONS

* Now shows Day of Week for log entries in the Log View

---

## V2015.8.22r0457

### ADDITIONS

* Added loading indicator while decrypting the note entries.

---

### V2015.8.22r0417

### CHANGES

* Text of note descriptions are now encrypted
* No longer "escaping" descriptions as they are added to the database since they are encrypted first.
* Word-wrap for log no longer counts `<br>` (New Lines) as additional characters.
* Using Javascript and POST to get to get to edit notes and no longer showing the entry ID.
* moved LOG, NEW and EDIT to their own url and no longer using NOTES_.
* Added the ability to go into maintenance mode.
* Entered By is now saved as the User ID # instead of their full name.

### ADDITIONS

* Log View now has Last 24 Hours
* SuperAdmin can now delete a note entry

---

## V2015.8.20r0623

### ADDITIONS

* Now give a 1 minute warning before logging you off and give the option to remain connected.

### CHANGES

* Started moving Logs out of "Notes" section and now using AJAX to update the log view.
* Password retrieval by ADMIN users, now shows a messagebox instead of a whole new page.

### FIXES

* No longer applying Word-Wrap when editing a note
* Corrected issues with \' and \" when editing a note

---

## V2015.8.14r1627

### CHANGES

* Changed menu system to make log view a drop-down

---

## V2015.7.27r0704

### FIXES

* Corrected logging in with mobile device while at Test Client

---

## V2015.7.24r0057

### FIXES

* Corrected an issue with displaying \' and \" in the log view. Removed the displaying of the \ mark.

---

## V2015.7.23r1836

### FIXES

* Again corrected an issue with "\r\n", now parsing during log view also.

---

## V2015.7.23r0944

### FIXES

* Corrected a new issue where "ENTER" keys became "\r\n"

---

## V2015.7.23r0917

### ADDITIONS

* Ability for a user to edit their entry within 24 hours of creating
* Signify entries that have been modified
* Created log views of 3, 7 and 30 days
* Super-Admins can edit any entry
* Added a "Go Back" to the user password view screen for admins
* Added easier printing for Admin users (Does not print current user or menus)

### FIXES:

* New Note Entry now automatically enters the current time (rounded down to nearest 5 mins)

### CHANGES

* Code now uses the supported mySQLi formatting for database access