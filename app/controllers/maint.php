<?php
	return (
        array(
            "errors" => core_error::outputErrors(),
            "messages" => core_message::outputMessages(),
            "foot" => $foot,
            'revised' => version()
        )
    );
?>