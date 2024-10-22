<?php
    include "iAccess.php";
    include "iType.php";
    $db  = getDB();
    $cid = core_session::getSession( 'id' );
    $cu  = users::load( $cid );

    if ( $cu ) {
        $cname   = $cu->getUsername();
        $cfname  = $cu->getFullName();
        $cdept   = $iAccess[$cu->getDept()];
        $caccess = $cu->getAdmin();
        $cdelete = $cu->getStrikeOut();
        $cadmin  = $cu->getSadmin();
        $cprint  = $cu->getPrint();
        $cidt    = $cu->getIDT();
        $cpoct   = $cu->getPOCT();
        $canon   = $cu->getANON();

        if ( $cadmin === 1 ) {
            $caccess = 1;
            $cdelete = 1;
            $cprint  = 1;
            $cidt    = 1;
            $cpoct   = 1;
        }

        $tinymce = <<<EOF
<script nonce='yLssuboMTYYx5Nx9'>
        tinymce.init({
            selector: '.editor',
            content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
            height: 300,
            width: 500,
            resize: false,
            plugins: [
                'autolink lists link anchor emoticons',
                'searchreplace visualblocks charmap',
                'insertdatetime'
            ],
            paste_as_text: true,
            convert_urls: false,
            paste_data_images: true,
            branding: false,
            menubar: false,
            mode: 'exact',
            browser_spellcheck: true,
            gecko_spellcheck: true,
            default_link_target: '_blank',
            toolbar: 'undo redo | bold italic underline strikethrough sub sup | bullist numlist outdent indent | charmap link emoticons',
            body_class:  'center',
            forced_root_block : false,
            setup: function(ed) {
                ed.on('change', function(e) {
                    // This will print out all your content in the tinyMce box
                    //console.log('the content '+ed.getContent());
                    // Your text from the tinyMce box will now be passed to your text area …
                    $('.editor').text(ed.getContent());
                });
                ed.on('paste', function(e) {
                    // Prevent default paste behavior
                    e.preventDefault();
                    // Check for clipboard data in various places for cross-browser compatibility.
                    // Get that data as text.
                    var content = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    // Let TinyMCE do the heavy lifting for inserting that content into the editor.
                    ed.execCommand('mceInsertContent', false, content);
                });
            }
        });
    </script>
EOF;
    } else {
        core_error::setError( 'You must be logged in first to continue' );
        header( 'Location: ' . base_url );
        exit;
    }

    $now     = time();
    $discard = core_cookie::retrieve( 'discard_after' );

    if (  ( isset( $discard ) && $now > $discard ) or !isset( $discard ) ) {
    // this session has worn out its welcome; kill it and start a brand new one

    //header('Location: ' . base_url . 'Timeout.do');
        //exit();
    }

    // DB Based Categories - Active Only
    $category = [];
    $ps       = categories::loadCategories();

    if ( $ps ) {
        $i = 0;
        foreach ( $ps as $p ) {
            if ( $p->getActive() == 1 ) {
                $key            = $p->getId();
                $category[$key] = $p->getDescription();;
                $aCats[$i][$p->getFirst()][$p->getSecond()][$p->getThird()] = $key;
                $i += 1;
               }
        }

        asort( $category );
        tksort( $aCats );
    }

    // DB Based Categories - All
    $categorys = [];
    $ps        = categories::loadCategories();

    if ( $ps ) {
        foreach ( $ps as $p ) {
            $key             = $p->getId();
            $categorys[$key] = $p->getDescription();
        }

        asort( $categorys );
    }

    // either new or old, it should live at most for another hour
core_cookie::create( 'discard_after', $now + 500, $now + 500 );
