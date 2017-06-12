<?php
/**
 * Created by PhpStorm.
 * User: jpd
 * Date: 12/06/17
 * Time: 21:57
 */

namespace test5;

/**
 * Class application
 * @package test5
 */
class application
{
    /** @var array */
    protected $wordList = [];
    /** @var \pspell_new */
    protected $dictionary;

    /**
     * application constructor.
     * @param string $language
     */
    public function __construct(string $language = 'en')
    {
        // @todo Move to a factory class to remove the concrete class dependancy.
        $this->dictionary = pspell_new($language);
    }

    /**
     * Take provided line and add any words to the count.
     * @param string $line
     * @return $this
     */
    public function countWords(string $line)
    {
        $words = [];
        preg_match_all('/[a-zA-Z\'\-]+/', $line, $words);
        foreach ($words[0] as $word) {
            // @todo Move to an abstracted function so check can be altered.
            if (pspell_check($this->dictionary, $word)) {
                if (isset($this->wordList[$word])) {
                    $this->wordList[$word]++;
                } else {
                    // @todo Change to be an object so data type is defined and can easily be expanded.
                    $this->wordList[$word] = 1;
                }
            }
        }
        $this->sortWordList();
        return $this;
    }

    /**
     * Get the top results of word count as specified.
     * @param int $count
     * @return array
     */
    public function getTopWords(int $count = 100)
    {
        return array_slice($this->wordList, 0, $count);
    }

    /**
     * Sort the word list in descending order.
     * @return $this
     */
    public function sortWordList()
    {
        arsort($this->wordList, SORT_NUMERIC);
        return $this;
    }
}
