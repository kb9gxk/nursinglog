<?php

    include "iNotes.php";

    if ( !empty( $_REQUEST['days'] ) ) {
        $days = $_REQUEST['days'];
        core_session::addSession( 'days', $days );
    } elseif ( isset( $_SESSION['days'] ) ) {
        $days = core_session::getSession( 'days' );
    }
    // Grab The Notes
    $ps = notes::loadx( $days );
    if ( $ps ) {
        $notes_table .= "<table class=\"table table-striped page-break\">\n";
        $notes_table .= "<thead>\n";
        $notes_table .= "<tr>\n";

    //$notes_table .= "<th style=\"text-align:center; width:20px;\">Date</th>\n";

    //$notes_table .= "<th style=\"text-align:center; width:20px;\">Time</th>\n";

    //$notes_table .= "<th style=\"text-align:center; width:20px;\">Type</th>\n";

    //$notes_table .= "<th style=\"text-align:center; width:300px;\">Description</th>\n";
        //$notes_table .= "<th style=\"text-align:center; width:150px;\">By</th>\n";

        $notes_table .= "<th style=\"text-align:center;\">Date</th>\n";
        $notes_table .= "<th style=\"text-align:center;\">Time</th>\n";
        $notes_table .= "<th style=\"text-align:center;\">Type</th>\n";
        $notes_table .= "<th style=\"text-align:center;\">Description</th>\n";
        $notes_table .= "<th style=\"text-align:center;\">By</th>\n";
        $notes_table .= "</tr>\n";
        $notes_table .= "</thead>\n";
        $notes_table .= "<tbody>\n";
        foreach ( $ps as $p ) {
            $logDesc = str_replace( '\r\n', '<br>', $p->getentDesc() );
            $logDesc = str_replace( '\n\r', '<br>', $logDesc );
            $logDesc = str_replace( '\n', '<br>', $logDesc );
            $logDesc = nl2br( $logDesc, false );
            //$logDesc = htmlwrap($logDesc, 40, '<br>');
            $mdate   = date( 'm/d/Y \<\b\r\> l', $p->getentWhen() );
            $mtime   = date( 'g:i a', $p->getentWhen() );
            $cdate   = date( 'm/d/Y \<\b\r\> l', $p->getentMade() );
            $ctime   = date( 'g:i a', $p->getentMade() );
            $canedit = '';
            $edited  = '';
            $hasrisk = '';
            $haspoc  = '';
            $isAbuse = '';

            if ( mb_strlen( $ctime)  == 7 ) { $ctime .= '<br><br>'; };

            if ( is_numeric( $p->getentType() ) ) {
                $entType = $category[$p->getentType()];
            } else {
                $entType = $p->getentType();
            }

            if (substr($entType,0,5) == "Abuse") { $isAbuse = true; }

            $notes_table .= "<tr class=\"page-break\">\n";

    // $notes_table .= "<td style=\"color:#1f1f1f;\">" . $p->getId() . "</td>\n";
            //$canedit = "<br><i class=\"fa fa-list-alt\"></i>";
            $canedit = "<br>";

            if ( $p->getentBy() == $cfname || $caccess == 1 ) {
                if ( $p->getentMade() >= strtotime( date( 'Y-m-d H:m:s', strtotime( 'last day'
                ) ) )
                    || $caccess == 1 ) {
                    $canedit .= "<a onclick=\"editlog(" . $p->getId() .

                        ")\" class=\"btn btn-link dontprint\"><i class=\"fas fa-edit\"></i></a>";

                    if ( $cdelete == 1 || $cadmin == 1 ) {
                        $canedit .= " <a onclick=\"dellog(" . $p->getId() .

                            ")\" class=\"btn btn-link dontprint\"><i class=\"far fa-trash-alt\"></i></a>";
                    }
                }
            }

            if (  ( $cidt == 1 ) && ( $p->getRiskDone() != 1 ) ) {
                $canedit .= "<a onclick=\"risk(" . $p->getId() .

                    ")\" class=\"btn btn-link dontprint\"><i class=\"far fa-list-alt\"></i></a>";
            }

            if (  ( $cpoct == 1 ) && ( $p->getPOCdone() != 1 ) ) {
                if ( $p->getHasPOC() ) {
                    $canedit .= "<a onclick=\"comment(" . $p->getId() .

                        ")\" class=\"btn btn-link dontprint\"><i class=\"far fa-comment-dots\"></i></a>";
                } else {
                    $canedit .= "<a onclick=\"comment(" . $p->getId() .

                        ")\" class=\"btn btn-link dontprint\"><i class=\"far fa-comment\"></i></a>";
                }
            }

            if ( $p->getentEdited() ) {
                $edited =

                    '<div style="text-align:right;"><sup style="color:red;">modified</sup></div>';
            }

            if ( $p->getHasRisk() ) {
                $q       = risk::loadx( $p->getId() );
                $hasrisk = '<a href="/RiskMit/' . PREFIX . '/' . $q
                    ->getPDFName() .

                    '" target="_blank"><div style="text-align:center"; class="blinkR";><sub>(RISK)</sup></div></a>';
            }

            if ( $p->getHasPOC() ) {
                $q      = plans::loadx( $p->getId() );
                $thePOC = stripslashes( str_replace( '\n', '<br>', $q
                        ->getPlan() ) );
                $theResponsible = $q->getResponsible();
                $haspoc         =

                    "<hr>$thePOC<br><div><div style=\"width:33%; float:left;\"><sup style=\"color:mediumblue;\">$theResponsible</sup></div>";

                if ( $q->getFollowup() == 'on' && $q->getResolved() != 'on' ) {$haspoc .=

                        "<div style=\"width:33%; float:right;\"><sup style=\"color:green;\">Followup</sup></div>";}

                if ( $q->getResolved() == 'on' ) {$haspoc .=

                    "<div style=\"width:50%; float:right;\"><sup style=\"color:DarkGreen;\">RESOLVED: " . $q->getResDate() . "</sup></div>";}

                $haspoc .= "</div>";
            }

            if ( $caccess == 1 ) {
                $catedit = "<br/><a onclick=\"editcat(" . $p->getId() .

                    ")\" class=\"btn btn-link dontprint\"><i class=\"fas fa-layer-group\"></i></a>";
                if ( ( $p->getPOCdone() != 1 ) ) {
                    if ( $p->getHasPOC() ) {
                        $pocdone = "<br/><a onclick=\"commentdone(" . $p->getId() . ")\" class=\"btn btn-link dontprint\"><i class=\"fas fa-clipboard-check\"></i></i></a>";
                    } else {
                        $pocdone="";
                    }
                }

            }

            if ( $isAbuse ) {
                $entwho = "ANONYMOUS";
                if ($canon == 1) { $entwho  = $p->getentBy(); }
                if ($canon == 1 && $caccess == 1) { $entwho = "<a href = \"admin/history/" . $p->getentById() . "\">" . $p->getentBy() . "</a>"; }
            } else {
                if ($caccess == 1) {
                    $entwho = "<a href = \"admin/history/" . $p->getentById() . "\">" . $p->getentBy() . "</a>";
                } else {
                    $entwho  = $p->getentBy();
                }
            }

            $notes_table .= "<td style=\"color:#1f1f1f;\"><div>Entered: " . $cdate . "</div><br><div>Event: " . $mdate .
                "</div></td>\n";
            $notes_table .= "<td style=\"color:#1f1f1f;\"><div>Entered: " . $ctime . "</div><br><div>Event: " . $mtime .
                "</div></td>\n";
            $notes_table .= "<td style=\"color:#1f1f1f;\">" . $entType .
                $hasrisk . $catedit . $pocdone . "</td>\n";
            $notes_table .= "<td style=\"color:#1f1f1f; text-align:left;\" id=\"desc\">" .
                $logDesc . $edited . $haspoc . "</td>\n";
            $notes_table .= "<td style=\"color:#1f1f1f;\" id=\"who\">" . $entwho .
                $canedit . "</td>\n";
            //$notes_table .= "<td style=\"color:#1f1f1f;\"><a class=\"btn btn-primary btn-xs\" href=\"/" . app_dir . "user/reset/" . $p->getId() . "\">reset</a></td>\n";
            $notes_table .= "</tr>\n";
            $catedit = '';
        }
        $notes_table .= "</tbody>\n";
        $notes_table .= "</table>\n";
    }

    echo $notes_table;
    $forms = <<<EOF
                <form method="post" action="DelEntry.do" id="delid" name="delid"><input type="hidden" id="did" name="did" value=""></form>
                <form method="post" action="editentry/" id="editid" name="editid"><input type="hidden" id="myeid" name="myeid" value="0"></form>
                <form method="post" action="editcategory/" id="editcid" name="editcid"><input type="hidden" id="myceid" name="myceid" value="0"></form>
                <form method="post" action="riskmit/" id="riskid" name="riskid"><input type="hidden" id="rid" name="rid" value="0"></form>
                <form method="post" action="comment/" id="planid" name="planid"><input type="hidden" id="pid" name="pid" value="0"></form>
                <form method="post" action="CommentClose.do" id="completedid" name="completedid"><input type="hidden" id="ccid" name="ccid" value="0"></form>

EOF;
    echo $forms;
    exit;
