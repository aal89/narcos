<?php
// app/Tools/SomeExampleClass.php
namespace App\Tools;
  
class NarcoScript
{
    private $tagSets = array(
        array(
            ':b:' => '<b>',
            ':\/b:' => '</b>'
        ),
        array(
            ':img:' => '<img src="',
            ':\/img:' => '" style="max-width: 100%;"></img>'
        )
    );
    private $singles = array(
        ':br:' => '<br>'
    );

    /**
     * Replaces all occurences of the narco script into equivalent html entities defined by
     * the tagSets class variable.
     *
     * @param string $str
     * @return string
     */
    public function parse($str)
    {
        $replaced_str = $str;
        // replace all tagsets
        foreach ($this->tagSets as $tagset) {
            $parsedResult = $this->overlapTagSet($tagset, $str);
            for ($x = 0; $x < count($parsedResult[0]); $x++) {
                $replaced_str = str_replace($parsedResult[0][$x], $parsedResult[1][$x], $replaced_str);
            }
        }
        // replace all single sets (singles)
        foreach ($this->singles as $key => $value) {
            $replaced_str = str_replace($key, $value, $replaced_str);      
        }
         return $replaced_str;
    }

    /**
     * Overlaps a tagset over the given text. Returns a results array for which
     * alterations on the text can be performed. This function does not alter the
     * text given.
     * 
     * Example input: tagset = :b: -> <b>
     * Example input: text = 'hello :b:world:/b:'
     * Example output: ((':b:world:/b:', '...'), ('<b>world</b>', '...'))
     * Example output array(2d): as you can see the array given back consists of 2 parts
     * 1st: all the valid matches in the text.
     * 2nd: all the valid matches in the text replaced with their counterparts as given in
     * the tagset.
     */
    private function overlapTagSet(array $tagset, $text)
    {   
        // create an results array
        $result = array();
        // get the keynames and their values of given tagset
        $fkey = key($tagset);
        $fvalue = $tagset[$fkey];
        next($tagset);
        $skey = key($tagset);
        $svalue = $tagset[$skey];
        // match stuff over 
        preg_match_all('/(?='.$fkey.').*?(?<='.$skey.')/', $text, $result);
        // create inner array; only the innertext of the matched narcostags are listed here
        $inner = array();
        preg_match_all('/(?<='.$fkey.').*?(?='.$skey.')/', $text, $inner);
        // create additional array in the resultset
        $result[1] = array();
        foreach($inner[0] as $match) {
            // 'replace' all narco tags with their respective values given in the narco
            // tagset
            array_push($result[1], $fvalue.$match.$svalue);
        }
        // return the resultset
        return $result;
    }
}