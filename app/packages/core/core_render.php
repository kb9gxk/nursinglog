<?php

class core_render
{

    protected $my_template, $my_content, $my_tags, $my_tagFormat;

    private $my_tagRE = '([_\w][-_\w\d]+)((?:\|\w+=[\'"]?.*?[\'"]?)*)';

    public function __construct( $template, $content, $tags = null,
        $quotedTagFormat = null ) {

        if ( !( is_array( $content ) && $content[0] ) ) {
            $content = [
                0 => $content
            ];
        }

        $this->my_template  = $template;
        $this->my_content   = $content;
        $this->my_tags      = $tags;
        $this->my_tagFormat = (  ( $quotedTagFormat != null ) ? $quotedTagFormat :
            [ "[::", "::]" ] );
    }

    public function __destruct()
    {
    }

    private function __cacheTags( $template, $quotedTagFormat )
    {
        $retVal = [];

        preg_match_all( "/$quotedTagFormat[0]{$this
->my_tagRE}$quotedTagFormat[1]/", $template, $matches );

        foreach ( $matches[0] as $idx => $key ) {
            preg_match_all( '/(?<=\|)(\w+)=([\'"])?(.*?)([\'"])?(?=\||$)/',
                $matches[2][$idx], $attrMatches );
            $retVal[$key] = [
                'name' => $matches[1][$idx],
                'attributes' => ( $attrMatches[0]
                    ? array_combine(
                        array_values( $attrMatches[1] ),
                        array_values( $attrMatches[3] )
                    )
                    : []
                )
            ];
        }

        return $retVal;
    }

    private function __processTag( $template, $data, $tag, $tagData )
    {
        $replacementText = '';

        $inflight = (  ( $text = ( $this->my_tags[$tagData['name']]
            ? ( is_callable( $this->my_tags[$tagData['name']] )
                ? $this->my_tags[$tagData['name']]( $data, $tagData['name'] )
                : $data[$this->my_tags[$tagData['name']]]
            )
            : $data[$tagData['name']] ) )
            ? $text
            : $text = $tagData['attributes']['default']
        );

        $replacementText .= $inflight;

        return str_replace( $tag, $replacementText, $template );
    }

    public function __render( $stripTags = true )
    {
        $retVal = '';

        $quotedTagFormat = [
            0 => preg_quote( $this->my_tagFormat[0] ),
            1 => preg_quote( $this->my_tagFormat[1] )
        ];

        $tagCache = $this->__cacheTags( $this->my_template, $quotedTagFormat );

        if ( !$tagCache ) {
            return ( $this->my_template ? $this->my_template : $this
                    ->my_content[0] );
            }

            foreach ( $this->my_content as $row => $data ) {
            $render = $this->my_template;

            while ( preg_match( "/$quotedTagFormat[0]{$this->my_tagRE}$quotedTagFormat[1]/",
                $render ) ) {
                foreach ( $tagCache as $tag => $tagData ) {
                    $render = $this->__processTag( $render, $data, $tag,
                        $tagData );
                }

                $newTagCache = $this->__cacheTags( $render, $quotedTagFormat );

                if ( !$newTagCache ) {
                    break;
                }

                $tagCache += $newTagCache;
            }

            $retVal .= $render;
        }

        return $retVal;
    }

    public static function render( $template, $content, $tags = null,
        $quotedTagFormat = null, $stripTags = true ) {
        $RE_Temp = new core_render( $template, $content, $tags,
            $quotedTagFormat );
        return $RE_Temp->__render( $stripTags );
    }

    public function getTemplate()
    {
        return $this->my_template;
    }

    public function getContent()
    {
        return $this->my_content;
    }

    public function getTags()
    {
        return $this->my_tags;
    }

    public function getTagFormat()
    {
        return $this->my_tagFormat;
    }

    public function setTemplate( $template )
    {
        return ( $this->my_template = $template );
    }

    public function setContent( $content )
    {
        return ( $this->my_content = $content );
    }

    public function setTags( $tags )
    {
        return ( $this->my_tags = $tags );
    }

    public function setTagFormat( $quotedTagFormat = null )
    {
        return ( $this->my_tagFormat = (  ( $quotedTagFormat != null ) ?
            $quotedTagFormat : [ "[::", "::]" ] ) );
    }
}
