<?php

include "iNotes.php";

if ( empty( $_POST['rid'] ) ) {
    $id = core_session::getSession( 'initEntry' );
} else {
    $id = $_POST['rid'];
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

if ( $p->getHasRisk() === 1 ) {
    $action = "edit";
} else {
    $action = "add";
}

switch ( $action ) {
    case "edit":
        if ( !empty( core_session::getSession( 'initEntry' ) ) ) {
            $q = risk::loadx( core_session::getSession( 'initEntry' ) );
        } else {
            $q = risk::loadx( $id );
        }

        if ( !empty( core_session::getSession( 'entBy' ) ) ) {
            $theEntBy = core_session::getSession( 'entBy' );
        } else {
            $theEntBy = $q->getentBy();
        }

        {
// Risk Assesment
            if ( !empty( core_session::getSession( 'RA1' ) ) ) {
                $theRA1 = core_session::getSession( 'RA1' );
            } else {
                $theRA1 = $q->getRA1();
            }

            if ( $theRA1 == 'on' ) {$RA1 = 'checked';} else { $RA1 = '';}

            if ( !empty( core_session::getSession( 'RA2' ) ) ) {
                $theRA2 = core_session::getSession( 'RA2' );
            } else {
                $theRA2 = $q->getRA2();
            }

            if ( $theRA2 == 'on' ) {$RA2 = 'checked';} else { $RA2 = '';}

            if ( !empty( core_session::getSession( 'RA3' ) ) ) {
                $theRA3 = core_session::getSession( 'RA3' );
            } else {
                $theRA3 = $q->getRA3();
            }

            if ( $theRA3 == 'on' ) {$RA3 = 'checked';} else { $RA3 = '';}

            if ( !empty( core_session::getSession( 'RA4' ) ) ) {
                $theRA4 = core_session::getSession( 'RA4' );
            } else {
                $theRA4 = $q->getRA4();
            }

            if ( $theRA4 == 'on' ) {$RA4 = 'checked';} else { $RA4 = '';}

            if ( !empty( core_session::getSession( 'RA5' ) ) ) {
                $theRA5 = core_session::getSession( 'RA5' );
            } else {
                $theRA5 = $q->getRA5();
            }

            if ( $theRA5 == 'on' ) {$RA5 = 'checked';} else { $RA5 = '';}
        }

        {
// Risk Levels
            if ( !empty( core_session::getSession( 'RL1' ) ) ) {
                $theRL1 = core_session::getSession( 'RL1' );
            } else {
                $theRL1 = $q->getRL1();
            }

            if ( $theRL1 == 'on' ) {$RL1 = 'checked';} else { $RL1 = '';}

            if ( !empty( core_session::getSession( 'RL2' ) ) ) {
                $theRL2 = core_session::getSession( 'RL2' );
            } else {
                $theRL2 = $q->getRL2();
            }

            if ( $theRL2 == 'on' ) {$RL2 = 'checked';} else { $RL2 = '';}

            if ( !empty( core_session::getSession( 'RL3' ) ) ) {
                $theRL3 = core_session::getSession( 'RL3' );
            } else {
                $theRL3 = $q->getRL3();
            }

            if ( $theRL3 == 'on' ) {$RL3 = 'checked';} else { $RL3 = '';}

            if ( !empty( core_session::getSession( 'RL4' ) ) ) {
                $theRL4 = core_session::getSession( 'RL4' );
            } else {
                $theRL4 = $q->getRL4();
            }

            if ( $theRL4 == 'on' ) {$RL4 = 'checked';} else { $RL4 = '';}

            if ( !empty( core_session::getSession( 'RL5' ) ) ) {
                $theRL5 = core_session::getSession( 'RL5' );
            } else {
                $theRL5 = $q->getRL5();
            }

            if ( $theRL5 == 'on' ) {$RL5 = 'checked';} else { $RL5 = '';}

            if ( !empty( core_session::getSession( 'RL5Desc' ) ) ) {
                $theRL5Desc = core_session::getSession( 'RL5Desc' );
            } else {
                $theRL5Desc = $q->getRL5Desc();
            }
        }

        {
//Observation Levels
            if ( !empty( core_session::getSession( 'OL1' ) ) ) {
                $theOL1 = core_session::getSession( 'OL1' );
            } else {
                $theOL1 = $q->getOL1();
            }

            if ( $theOL1 == 'on' ) {$OL1 = 'checked';} else { $OL1 = '';}

            if ( !empty( core_session::getSession( 'OL2' ) ) ) {
                $theOL2 = core_session::getSession( 'OL2' );
            } else {
                $theOL2 = $q->getOL2();
            }

            if ( $theOL2 == 'on' ) {$OL2 = 'checked';} else { $OL2 = '';}

            if ( !empty( core_session::getSession( 'OL3' ) ) ) {
                $theOL3 = core_session::getSession( 'OL3' );
            } else {
                $theOL3 = $q->getOL3();
            }

            if ( $theOL3 == 'on' ) {$OL3 = 'checked';} else { $OL3 = '';}

            if ( !empty( core_session::getSession( 'OL4' ) ) ) {
                $theOL4 = core_session::getSession( 'OL4' );
            } else {
                $theOL4 = $q->getOL4();
            }

            if ( $theOL4 == 'on' ) {$OL4 = 'checked';} else { $OL4 = '';}

            if ( !empty( core_session::getSession( 'OL5' ) ) ) {
                $theOL5 = core_session::getSession( 'OL5' );
            } else {
                $theOL5 = $q->getOL5();
            }

            if ( $theOL5 == 'on' ) {$OL5 = 'checked';} else { $OL5 = '';}

            if ( !empty( core_session::getSession( 'OL6' ) ) ) {
                $theOL6 = core_session::getSession( 'OL6' );
            } else {
                $theOL6 = $q->getOL6();
            }

            if ( $theOL6 == 'on' ) {$OL6 = 'checked';} else { $OL6 = '';}

            if ( !empty( core_session::getSession( 'OL6Desc' ) ) ) {
                $theOL6Desc = core_session::getSession( 'OL6Desc' );
            } else {
                $theOL6Desc = $q->getOL6Desc();
            }
        }

        if ( !empty( core_session::getSession( 'RiskDesc' ) ) ) {
            $theRiskDesc = core_session::getSession( 'RiskDesc' );
        } else {
            $theRiskDesc = $q->getRiskDesc();
        }

        if ( !empty( core_session::getSession( 'RiskPlan' ) ) ) {
            $theRiskPlan = core_session::getSession( 'RiskPlan' );
        } else {
            $theRiskPlan = $q->getRiskPlan();
        }

        if ( !empty( core_session::getSession( 'Triggers' ) ) ) {
            $theTrigers = core_session::getSession( 'Triggers' );
        } else {
            $theTriggers = $q->getTriggers();
        }

        if ( !empty( core_session::getSession( 'Assigned' ) ) ) {
            $theAssigned = core_session::getSession( 'Assigned' );
        } else {
            $theAssigned = $q->getAssigned();
        }

        if ( !empty( core_session::getSession( 'Date' ) ) ) {
            $theDate = core_session::getSession( 'Date' );
        } else {
            $theDate = $q->getDate();
        }

        if ( !empty( core_session::getSession( 'Reassess' ) ) ) {
            $theReassess = core_session::getSession( 'Reassess' );
        } else {
            $theReassess = $q->getReassess();
        }

        if ( !empty( core_session::getSession( 'Completed' ) ) ) {
            $theCompleted = core_session::getSession( 'Completed' );
        } else {
            $theCompleted = $q->getCompleted();
        }

        if ( $theCompleted == 'on' ) {$Completed = 'checked';} else { $Completed = '';}

        if ( !empty( core_session::getSession( 'CompletedOn' ) ) ) {
            $theCompletedOn = core_session::getSession( 'CompletedOn' );
        } else {
            $theCompletedOn = $q->getCompletedOn();
        }

        if ( !empty( core_session::getSession( 'Resident' ) ) ) {
            $theResident = core_session::getSession( 'Resident' );
        } else {
            $theResident = $q->getResident();
        }

        //$content =" <h3>Sorry, Editing not available at this time...";
        $logDesc = $p->getentDesc();
        $content =
            "    <label>Initial Log Entry:</label><br><textarea id=\"initEntryText\" name=\"initEntryText\" rows=\"6\" cols=\"75\" style=\"background-color: silver\" readonly>$logDesc</textarea><br>\n";
        $content .=
            "    <label>Resident Name: $theResident<input id=\"Resident\" name=\"Resident\" value=\"$theResident\" type=\"hidden\"></label><br>\n";
        $content .=
            "    <label>Assessment Date: $theDate<input type=\"hidden\" id =\"Date\" name=\"Date\" value=\"$theDate\"></label><br>\n";
        $content .= "    <br>\n";
        $content .= "    <label>Risk Assessment:</label><br>\n";
        $content .=
            "    <input id=\"RA1\" name=\"RA1\" type=\"checkbox\" $RA1>Risk to Self <sub>(suicidal ideation / plan / means\n";
        $content .= "    / etc.)</sub><br>\n";
        $content .=
            "    <input id=\"RA2\" name=\"RA2\" type=\"checkbox\" $RA2>Risk to Others <sub>(aggression / threats / means /\n";
        $content .= "    drug-alcohol / etc.)</sub><br>\n";
        $content .=
            "    <input id=\"RA3\" name=\"RA3\" type=\"checkbox\" $RA3>Risk Assoc with Clinical Sx <sub>(command hulluc /\n";
        $content .= "    delusions / agitation / etc.)</sub><br>\n";
        $content .=
            "    <input id=\"RA4\" name=\"RA4\" type=\"checkbox\" $RA4>Risk Assoc with Behavior <sub>(impulsiveness /\n";
        $content .= "    agitation / threats / etc.)</sub><br>\n";
        $content .=
            "    <input id=\"RA5\" name=\"RA5\" type=\"checkbox\" $RA5>Vulnerability <sub>(isolation / exploitation /\n";
        $content .=
            "    self-care deficits/ special needs / physical problems)</sub><br>\n";
        $content .= "    <br>\n";
        $content .= "    <label>Level of Risk:</label><br>\n";
        $content .=
            "    <input id=\"RL1\" name=\"RL1\" type=\"checkbox\" $RL1>Level 1 <sub>(Per remote history, upon\n";
        $content .= "    admission)</sub><br>\n";
        $content .=
            "    <input id=\"RL2\" name=\"RL2\" type=\"checkbox\" $RL2>Level 2 <sub>(Per recent history, less than 1 year\n";
        $content .= "    or current mild risk)</sub><br>\n";
        $content .=
            "    <input id=\"RL3\" name=\"RL3\" type=\"checkbox\" $RL3>Level3 <sub>(Current indicators suggest moderate\n";
        $content .= "    risk)</sub><br>\n";
        $content .=
            "    <input id=\"RL4\" name=\"RL4\" type=\"checkbox\" $RL4>Level 4 <sub>(Current indicators suggest serious\n";
        $content .= "    risk)</sub><br>\n";
        $content .=
            "    <input id=\"RL5\" name=\"RL5\" type=\"checkbox\" $RL5>Other: <input id=\"RL5Desc\" name=\"RL5Desc\" size=\"50\"\n";
        $content .=
            "    maxlength=\"50\" value=\"$theRL5Desc\" style=\"background-color: silver\" readonly><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>Description of Risk:<sub>(Read Only)</sub><br><textarea id=\"RiskDesc\" name=\"RiskDesc\" rows=\"6\" cols=\"75\" style=\"background-color: silver\" readonly>$theRiskDesc</textarea></label><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>Risk Management Plan:<br><textarea id=\"RiskPlan\" name=\"RiskPlan\" rows=\"6\" cols=\"75\">$theRiskPlan</textarea></label><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>Mention any know triggers / stressors:</label><br>\n";
        $content .=
            "    <textarea id=\"Triggers\" name=\"Triggers\" rows=\"3\" cols=\"75\">$theTriggers</textarea><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>Level of Observations required:</label><br>\n";
        $content .=
            "    <input id=\"OL1\" name=\"OL1\" type=\"checkbox\" $OL1>Level 1 <sub>(No Special Observation\n";
        $content .= "    Required)</sub><br>\n";
        $content .=
            "    <input id=\"OL2\" name=\"OL2\" type=\"checkbox\" $OL2>Level 2 <sub>(Every 30 minute checks)</sub><br>\n";
        $content .=
            "    <input id=\"OL3\" name=\"OL3\" type=\"checkbox\" $OL3>Level3 <sub>(Every 15 minutes)</sub><br>\n";
        $content .=
            "    <input id=\"OL4\" name=\"OL4\" type=\"checkbox\" $OL4>Level 4 <sub>(Must be able to see the person at all\n";
        $content .= "    times)</sub><br>\n";
        $content .=
            "    <input id=\"OL5\" name=\"OL5\" type=\"checkbox\" $OL5>Level 5 <sub>(Must be with the person - within arms\n";
        $content .= "    length)</sub><br>\n";
        $content .=
            "    <input id=\"OL6\" name=\"OL6\" type=\"checkbox\" $OL6>Other: <input id=\"OL6Desc\" name=\"OL6Desc\" size=\"50\"\n";
        $content .= "    maxlength=\"50\" value=\"$OL6Desc\"><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>STAFF or DEPARTMENT ASSIGNED:<br><input id=\"Assigned\" name=\"Assigned\" size=\"50\" maxlength=\"50\" value=\"$theAssigned\"></label><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>Recommended review date:<input id=\"Reassess\" name=\"Reassess\" size=\"25\" maxlength=\"25\" value=\"$theReassess\"></label><br><br>\n";
        $content .=
            "    <input id=\"Completed\" name=\"Completed\" type=\"checkbox\" $Completed>Completed <sub>(Checked = Yes)</sub>: <input id=\"CompletedOn\" name=\"CompletedOn\" size=\"50\"\n";
        $content .=
            "    maxlength=\"50\" value=\"$theCompletedOn\"><br>\n";
        $content .= "    <input type=\"hidden\" name=\"Date2\" value=\"" .
        date( "y-m-d" ) . "\"  />";
        $content .= "    <input type=\"hidden\" name=\"Time\" value=\"" .
        date( "H:i:s" ) . "\"  />";
        $content .=
            "    <input type=\"hidden\" name=\"entBy\" value=\"$theEntBy\"  />";
        $content .=
            "    <input type=\"hidden\" name=\"initEntry\" value=\"" . $id . "\"  />";
        $content .= "    <input type=\"hidden\" name=\"nid\" value=\"" .
        $q->getId() . "\" />\n";
        return ( [ 'content' => $content, 'action' => 'UpdateRisk',
            'myaction' => 'Update Risk Assesment & Plan' ] );

    case "add":
        $logDesc = $p->getentDesc();
        $content =
            "    <label>Initial Log Entry:</label><br><textarea id=\"initEntryText\" name=\"initEntryText\" rows=\"6\" cols=\"75\" style=\"background-color: silver\" readonly>$logDesc</textarea><br>\n";
        $content .=
            "    <label>Resident First Name:<br><input id=\"Fname\" name=\"Fname\" size=\"25\" maxlength=\"25\"></label><br>\n";
        $content .=
            "    <label>Resident Last Name:<br><input id=\"Lname\" name=\"Lname\" size=\"25\" maxlength=\"25\"></label><br>\n";
        $content .= "    <br>\n";
        $content .= "    <label>Risk Assessment:</label><br>\n";
        $content .=
            "    <input id=\"RA1\" name=\"RA1\" type=\"checkbox\">Risk to Self <sub>(suicidal ideation / plan / means\n";
        $content .= "    / etc.)</sub><br>\n";
        $content .=
            "    <input id=\"RA2\" name=\"RA2\" type=\"checkbox\">Risk to Others <sub>(aggression / threats / means /\n";
        $content .= "    drug-alcohol / etc.)</sub><br>\n";
        $content .=
            "    <input id=\"RA3\" name=\"RA3\" type=\"checkbox\">Risk Assoc with Clinical Sx <sub>(command hulluc /\n";
        $content .= "    delusions / agitation / etc.)</sub><br>\n";
        $content .=
            "    <input id=\"RA4\" name=\"RA4\" type=\"checkbox\">Risk Assoc with Behavior <sub>(impulsiveness /\n";
        $content .= "    agitation / threats / etc.)</sub><br>\n";
        $content .=
            "    <input id=\"RA5\" name=\"RA5\" type=\"checkbox\">Vulnerability <sub>(isolation / exploitation /\n";
        $content .=
            "    self-care deficits/ special needs / physical problems)</sub><br>\n";
        $content .= "    <br>\n";
        $content .= "    <label>Level of Risk:</label><br>\n";
        $content .=
            "    <input id=\"RL1\" name=\"RL1\" type=\"checkbox\">Level 1 <sub>(Per remote history, upon\n";
        $content .= "    admission)</sub><br>\n";
        $content .=
            "    <input id=\"RL2\" name=\"RL2\" type=\"checkbox\">Level 2 <sub>(Per recent history, less than 1 year\n";
        $content .= "    or current mild risk)</sub><br>\n";
        $content .=
            "    <input id=\"RL3\" name=\"RL3\" type=\"checkbox\">Level3 <sub>(Current indicators suggest moderate\n";
        $content .= "    risk)</sub><br>\n";
        $content .=
            "    <input id=\"RL4\" name=\"RL4\" type=\"checkbox\">Level 4 <sub>(Current indicators suggest serious\n";
        $content .= "    risk)</sub><br>\n";
        $content .=
            "    <input id=\"RL5\" name=\"RL5\" type=\"checkbox\">Other: <input id=\"RL5Desc\" name=\"RL5Desc\" size=\"50\"\n";
        $content .= "    maxlength=\"50\"><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>Description of Risk:<br><textarea id=\"RiskDesc\" name=\"RiskDesc\" rows=\"6\" cols=\"75\"></textarea></label><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>Risk Management Plan:<br><textarea id=\"RiskPlan\" name=\"RiskPlan\" rows=\"6\" cols=\"75\"></textarea></label><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>Mention any know triggers / stressors:</label><br>\n";
        $content .=
            "    <textarea id=\"Triggers\" name=\"Triggers\" rows=\"3\" cols=\"75\">\n";
        $content .= "</textarea><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>Level of Observations required:</label><br>\n";
        $content .=
            "    <input id=\"OL1\" name=\"OL1\" type=\"checkbox\">Level 1 <sub>(No Special Observation\n";
        $content .= "    Required)</sub><br>\n";
        $content .=
            "    <input id=\"OL2\" name=\"OL2\" type=\"checkbox\">Level 2 <sub>(Every 30 minute checks)</sub><br>\n";
        $content .=
            "    <input id=\"OL3\" name=\"OL3\" type=\"checkbox\">Level3 <sub>(Every 15 minutes)</sub><br>\n";
        $content .=
            "    <input id=\"OL4\" name=\"OL4\" type=\"checkbox\">Level 4 <sub>(Must be able to see the person at all\n";
        $content .= "    times)</sub><br>\n";
        $content .=
            "    <input id=\"OL5\" name=\"OL5\" type=\"checkbox\">Level 5 <sub>(Must be with the person - within arms\n";
        $content .= "    length)</sub><br>\n";
        $content .=
            "    <input id=\"OL6\" name=\"OL6\" type=\"checkbox\">Other: <input id=\"OL6Desc\" name=\"OL6Desc\" size=\"50\"\n";
        $content .= "    maxlength=\"50\"><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>STAFF or DEPARTMENT ASSIGNED:<br><input id=\"Assigned\" name=\"Assigned\" size=\"50\" maxlength=\"50\"></label><br>\n";
        $content .= "    <br>\n";
        $content .=
            "    <label>Recommended review date:<input id=\"Reassess\" name=\"Reassess\" size=\"25\" maxlength=\"25\"></label><br><br>\n";
        $content .= "    <input type=\"hidden\" name=\"Date\" value=\"" .
        date( "m/d/y" ) . "\"  />";
        $content .= "    <input type=\"hidden\" name=\"Date2\" value=\"" .
        date( "y-m-d" ) . "\"  />";
        $content .= "    <input type=\"hidden\" name=\"Time\" value=\"" .
        date( "H:i:s" ) . "\"  />";
        $content .= "    <input type=\"hidden\" name=\"entBy\" value=\"" .
            $cfname . "\"  />";
        $content .=
            "    <input type=\"hidden\" name=\"initEntry\" value=\"" . $id . "\"  />";
        return ( [ 'content' => $content, 'action' => 'AddRisk',
            'myaction' => 'Create Risk Assessment & Plan', ] );

    default:
        header( "Location:" . base_url . '/log/' );
        exit;
}
