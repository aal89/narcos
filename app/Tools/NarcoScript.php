<?php
// app/Tools/SomeExampleClass.php
namespace App\Tools;
  
class NarcoScript
{
    // hey future Alex, you might be wondering why I created tagsets and singles. In a tagset the pairs are constraint
    // a lot more than with singles, so a single :b: (without a :/b:) will never parse. Singles, however, will always
    // parse if they are found. The trade-off? Singles are more flexibel (see for example the :link: tags), but require
    // the user to be more precise or f it all up. The constraint pair are more user friendly but also more restrictive.
    // With the current implementation you cant reference a link in a tagset, but you can in a singles. The rule
    // becomes 1st) :link: 2) :-link: 3) :/link:. Do it any other way and the link wont show up in your profile.
    private $tagSets = array(
        array(
            ':b:' => '<b>',
            ':\/b:' => '</b>'
        ),
        array(
            ':img:' => '<img src="',
            ':\/img:' => '" style="max-width: 100%;" />'
        ),
        array(
            ':img-center:' => '<img class="mx-auto d-block" src="',
            ':\/img-center:' => '" style="max-width: 100%;" />'
        ),
        array(
            ':center:' => '<p class="text-center mb-0">',
            ':\/center:' => '</p>'
        )
    );
    private $singles = array(
        ':br:' => '<br>',
        ':link:' => '<a href="',
        ':-link:' => '">',
        ':/link:' => '</a>'

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