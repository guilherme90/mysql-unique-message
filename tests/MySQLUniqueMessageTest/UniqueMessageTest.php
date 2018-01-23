<?php

namespace MySQLUniqueMessageTest;

use MySQLUniqueMessage\UniqueMessage;
use PHPUnit\Framework\TestCase;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira@univicosa.com.br>
 */
class UniqueMessageTest extends TestCase
{
    /**
     * @test
     */
    public function displayingErrorMessage()
    {
        $entry = UniqueMessage::format(
            'SQLSTATE[23000]: Integrity constraint violation: ' .
            '1062 Duplicate entry \'guilhermenogueira90@gmail.com\' for key \'email\''
        );

        static::assertSame(
            sprintf('The %s \'%s\' is already registered.', 'email', 'guilhermenogueira90@gmail.com'),
            $entry
        );
    }

    /**
     * @test
     * @expectedExceptionMessage Invalid message format
     * @expectedException \MySQLUniqueMessage\Exception\UniqueMessageException
     */
    public function dispatchException()
    {
        UniqueMessage::format('Invalid message format');
    }

    /**
     * @test
     */
    public function emptyMessage()
    {
        static::assertSame(UniqueMessage::format(), '');
    }
}
