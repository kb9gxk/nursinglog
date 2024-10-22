<?php
    include ( "iNotes.php" );
    $id = $_POST['ccid'];


    $q = notes::POCdone($id);
    if ( $q === null ) {
        core_error::setError( "Error marking Comments Completed." );
    } else {
        core_message::setMessage( "Comment Marked Closed from default View" );
    }
header ( "Location:" . base_url . "log/" );
exit;
?>