<?php
core_session::addSession('id',null);
return ( ["notice" => core_notice::outputNotices(), "sysmsg" =>
    core_sysmsg::outputSysmsg(), "errors" => core_error::outputErrors(),
    "messages" => core_message::outputMessages(), "foot" => $foot, 'revised' =>
    version()] );
