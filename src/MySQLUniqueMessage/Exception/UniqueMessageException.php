<?php

namespace MySQLUniqueMessage\Exception;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira@univicosa.com.br>
 */
class UniqueMessageException extends \RuntimeException
{
    /**
     * @return UniqueMessageException
     */
    public static function invalidMessageFormat() : self
    {
        return new self('Invalid message format');
    }

    /**
     * @return UniqueMessageException
     */
    public static function emptyMessage() : self
    {
        return new self('No messages found');
    }
}
