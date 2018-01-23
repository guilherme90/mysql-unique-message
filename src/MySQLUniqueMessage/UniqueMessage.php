<?php

namespace MySQLUniqueMessage;

use MySQLUniqueMessage\Exception\UniqueMessageException;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira@univicosa.com.br>
 */
class UniqueMessage
{
    /**
     * @inheritDoc
     */
    public static function format(string $messageDuplicateEntry = '') : string
    {
        $entry = trim($messageDuplicateEntry);

        if (! empty($entry)) {
            preg_match("/1062 Duplicate entry '(.*)' for.*key ((')(.*)(')|.*)/", $entry, $matches);

            if (! isset($matches[4]) || ! isset($matches[1])) {
                throw UniqueMessageException::invalidMessageFormat();
            }

            return sprintf('The %s \'%s\' is already registered.', $matches[4], $matches[1]);
        }

        return '';
    }
}
