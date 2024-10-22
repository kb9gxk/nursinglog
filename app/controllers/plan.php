<?php

include "iNotes.php";

if ( empty( $_POST['pid'] ) ) {
    $id = core_session::getSession( 'initEntry' );
} else {
    $id = $_POST['pid'];
}

if ( empty( $id ) ) {
    core_error::setError( "You must select a log entry first..." );
    header( "Location: " . base_url . "/log" );
}

$p = notes::load( $id );

if ( !$p ) {
    core_error::setError( "Unable to locate the specified log entry." );
    header( "Location:" . base_url . "/log" );
    exit;
}

if ( $p->getHasPOC() === 1 ) {
    $action = "edit";
} else {
    $action = "add";
}

switch ( $action ) {
    case "edit":
        $rdate = date( 'm-d-y' );

        if ( !empty( core_session::getSession( 'initEntry' ) ) ) {
            $q = plans::loadx( core_session::getSession( 'initEntry' ) );
        } else {
            $q = plans::loadx( $id );
        }

        if ( !empty( core_session::getSession( 'Plan' ) ) ) {
            $thePlan = removeslashes( core_session::getSession( 'Plan' ) );
        } else {
            $thePlan = br2rn( $q->getPlan() );
        }

        if ( !empty( core_session::getSession( 'Responsible' ) ) ) {
            $theResponsible = core_session::getSession( 'Responsible' );
        } else {
            $theResponsible = $q->getResponsible();
        }

        if ( !empty( core_session::getSession( 'Followup' ) ) ) {
            $theFollowup = core_session::getSession( 'Followup' );
        } else {
            $theFollowup = $q->getFollowup();
        }

        if ( !empty( core_session::getSession( 'Resolved' ) ) ) {
            $theResolved = core_session::getSession( 'Resolved' );
        } else {
            $theResolved = $q->getResolved();
        }

        if ( !empty( core_session::getSession( 'ResDate' ) ) ) {
            $theResDate = core_session::getSession( 'ResDate' );
        } else {
            $theResDate = $q->getResDate();
        }

        if ( empty( $theResDate ) ) {
            $theResDate = $rdate;
        }

        $logDesc = $p->getentDesc();

        if ( $theFollowup == 'on' ) {$followup = 'checked';} else { $followup = '';}

        if ( $theResolved == 'on' ) {$resolved = 'checked';} else { $resolved = '';}

        $content =
            "    <label>Initial Log Entry:<br><div id=\"initEntryText\" name=\"initEntryText\"  style=\"background-color: silver; width: 150 margin-left: auto; margin-right: auto\";>$logDesc</div></label><br>\n";
        $content .=
            "    <label>Correction Plan:<br><textarea id=\"Plan\" name=\"Plan\" rows=\"6\" cols=\"75\" class=\"form-control editor\">$thePlan</textarea></label><br>\n";
        $content .=
            "    <label>STAFF or DEPARTMENT Responsible:<br><input id=\"Responsible\" name=\"Responsible\" size=\"50\" maxlength=\"50\" value=\"$theResponsible\"></label><br>\n";
        $content .=
            "    <label>Follow-Up  Required:&nbsp;</label>&nbsp;<input id=\"Followup\" name=\"Followup\" type=\"checkbox\" $followup>&nbsp;Checked = Yes<br>\n";
        $content .=
            "    <label>Resolved:&nbsp;</label>&nbsp;<input id=\"Resolved\" name=\"Resolved\" type=\"checkbox\" $resolved>&nbsp;Checked = Resolved on: $theResDate<br>\n";
        $content .=
            "    <input type=\"hidden\" name=\"ResDate\" value=\"$rdate\" />\n";
        $content .=
            "    <input type=\"hidden\" name=\"initEntry\" value=\"$id\" />\n";
        $content .= "    <input type=\"hidden\" name=\"nid\" value=\"" .
        $q->getId() . "\" />\n";
        return ( [ 'content' => $content, 'action' => 'EditPlan',
            'myaction' => 'Update Comments' ] );

    case "add":
        $thePlan        = core_session::getSession( 'Plan' );
        $theResponsible = core_session::getSession( 'Responsible' );
        $theFollowup    = core_session::getSession( 'Followup' );
        $theResolved    = core_session::getSession( 'Resolved' );
        $theResDate    = core_session::getSession( 'ResDate' );
        $logDesc        = $p->getentDesc();

        if ( $theFollowup == 'on' ) {$followup = 'checked';} else { $followup = '';}

        if ( $theResolved == 'on' ) {$resolved = 'checked';} else { $resolved = '';}

        $content =
            "    <label>Initial Log Entry:<br><textarea id=\"initEntryText\" name=\"initEntryText\" rows=\"6\" cols=\"75\" style=\"background-color: silver\" readonly>$logDesc</textarea></label><br>\n";
        $content .=
            "    <label>Correction Plan:<br><textarea id=\"Plan\" name=\"Plan\" rows=\"6\" cols=\"75\">$thePlan</textarea></label><br>\n";
        $content .=
            "    <label>STAFF or DEPARTMENT Responsible:<br><input id=\"Responsible\" name=\"Responsible\" size=\"50\" maxlength=\"50\" value=\"$theResponsible\"></label><br>\n";
        $content .=
            "    <label>Follow-Up  Required:&nbsp;</label>&nbsp;<input id=\"Followup\" name=\"Followup\" type=\"checkbox\" $followup>&nbsp;Checked = Yes<br>\n";
       $content .=
            "    <label>Resolved:&nbsp;</label>&nbsp;<input id=\"Resolved\" name=\"Resolved\" type=\"checkbox\" $resolved>&nbsp;Checked = Resolved on: $theResDate<br>\n";
        $content .=
            "    <input type=\"hidden\" name=\"ResDate\" value=\"$rdate\" />\n";
        $content .=
            "    <input type=\"hidden\" name=\"initEntry\" value=\"$id\" />\n";
        return ( [ 'content' => $content, 'action' => 'AddPlan',
            'myaction' => 'Create Comments' ] );

    default:
        header( "Location:" . base_url . '/log/' );
        exit;
}
