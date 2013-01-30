<?php

// require 'src/rtablada/markdown/markdown.php';

use Rtablada\Libraries\Markdown;

class MarkdownTest extends PHPUnit_Framework_Testcase
{
	protected $string;
	protected $multiline;
	protected $list;
	protected $link;

	public function setUp()
	{
		$this->string = 'Hello!';
		$this->multiline = "Hello!\nThere";
		$this->list = ['First', 'Second', 'Third'];
		$this->link = 'http://www.google.com';
	}

	/**
	 * Tests that single argument creates an H1
	 */
	public function test_can_create_headers_with_single_argument()
	{
		$this->assertSame( '# '. $this->string, Markdown::heading( $this->string ) );
	}

	/**
	 * Tests heading method with two arguments
	 */
	public function test_can_create_headings_with_multiple_arguments()
	{
		$this->assertSame( '# ' . $this->string , Markdown::heading( 1, $this->string ) );
		$this->assertSame( '## ' . $this->string , Markdown::heading( 2, $this->string ) );
	}

	/**
	 * When heading is called with multiple lines, it will create a heading of the first line
	 * and then puts the other lines in paragraph form
	 */
	public function test_heading_call_with_multiple_lines_works()
	{
		$this->assertSame( '# ' . $this->multiline , Markdown::heading( 1, $this->multiline ) );
	}

	/**
	 * Tests that calls to block_quote works
	 */
	public function test_can_create_block_quote()
	{
		$this->assertSame( '> ' . $this->string , Markdown::blockquote( $this->string ) );
		$this->assertSame( "> Hello!\n> There" , Markdown::blockquote( $this->multiline ) );
	}

	/**
	 * description
	 */
	public function test_can_create_list_from_multiline()
	{
		$this->assertSame( "* Hello!\n* There", Markdown::ul( $this->multiline ) );
	}


	public function test_can_create_ul_from_array()
	{
		$this->assertSame("* First\n* Second\n* Third", Markdown::ul( $this->list ) );
	}

	/**
	 * Tests that user can pass prefered ul marker style
	 * Tests that if illegal marker is set, the default * is used
	 */
	public function test_can_create_list_with_other_marker()
	{
		$this->assertSame("* First\n* Second\n* Third", Markdown::ul( $this->list, '*' ) );
		$this->assertSame("- First\n- Second\n- Third", Markdown::ul( $this->list, '-' ) );
		$this->assertSame("+ First\n+ Second\n+ Third", Markdown::ul( $this->list, '+' ) );
		$this->assertSame("* First\n* Second\n* Third", Markdown::ul( $this->list, ';' ) );
	}

	/**
	 * description
	 */
	public function test_can_create_ordered_list()
	{
		$this->assertSame("1. First\n2. Second\n3. Third", Markdown::ol( $this->list) );
		$this->assertSame( "1. Hello!\n2. There", Markdown::ol( $this->multiline ) );
	}

	/**
	 * description
	 */
	public function test_can_create_code_block()
	{
		$this->assertSame("\tHello!\n\tThere", Markdown::codeblock( $this->multiline ) );
	}

	/**
	 * description
	 */
	public function test_can_create_link()
	{
		$this->assertSame("[$this->string]($this->link)", Markdown::link( $this->link, $this->string) );
	}

	public function test_can_create_em()
	{
		$this->assertSame("*$this->string*", Markdown::em( $this->string ) );
		$this->assertSame("_{$this->string}_", Markdown::em( $this->string, '_' ) );
		$this->assertSame("*$this->string*", Markdown::em( $this->string, 'l' ) );
	}

	public function test_can_create_code_span()
	{
		$this->assertSame("`$this->string`", Markdown::code( $this->string ) );
	}

	public function test_can_create_image()
	{
		$this->assertSame("![$this->string]($this->link)", Markdown::image($this->link, $this->string) );
	}
}