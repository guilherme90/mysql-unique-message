<?php

namespace MySQLUniqueMessageTest;

use MySQLUniqueMessage\UniqueMessage;
use PHPUnit\Framework\TestCase;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira@univicosa.com.br>
 */
class UniqueMessageTest extends TestCase
{
	protected $output = [];

	public function setUp()
	{
		parent::setUp();

		$this->output = UniqueMessage::format($this->mysqlErrorMessage());
	}

	/**
	 * @return string
	 */
	protected function mysqlErrorMessage() : string
	{
		return 'SQLSTATE[23000]: Integrity constraint violation: ' .
			'1062 Duplicate entry \'user@provider.com\' for key \'email\'';
	}

	/**
	 * @test
	 */
	public function checkArrayKeys()
	{
		static::assertArrayHasKey('fieldName', $this->output);
		static::assertArrayHasKey('value', $this->output);
		static::assertArrayHasKey('message', $this->output);
	}

	/**
	 * @test
	 */
	public function checkFieldName()
	{
		static::assertSame('email', $this->output['fieldName']);
	}

	/**
	 * @test
	 */
	public function checkValue()
	{
		static::assertSame('user@provider.com', $this->output['value']);
	}

    /**
     * @test
     */
    public function checkMessageFormat()
    {
        static::assertSame(
            sprintf('The %s \'%s\' is already registered.', 'email', 'user@provider.com'),
	        $this->output['message']
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
    public function emptyReturn()
    {
    	$output = count(UniqueMessage::format('')) === 0;

        static::assertTrue($output);
    }
}
