<?php

class Markdown
{
	public static function heading($level = '', $text = '')
	{
		$markdown = '';

		if ( gettype($level) == "string" )
		{
			$text = $level;
			$level = 1;
		}

		while( $level > 0 )
		{
			$level--;
			$markdown .= '#';
		}

		$markdown .= ' ';

		return $markdown . $text;
	}

	public static function blockquote( $text = '' )
	{
		$markdown = '> ';

		$text = str_replace("\n", "\n" . $markdown , $text);

		return $markdown . $text;
	}

	public static function ul( $text = '', $markdown = '*' )
	{
		if( ! ($markdown == '*' or $markdown == '+' or $markdown == '-' ) )
			$markdown = '*';

		$markdown .= ' ';

		if( gettype($text) == "array" )
		{
			$array = $text;
			$text = array_shift( $array );

			foreach ($array as $li) {
				$text .= "\n" . $li;
			}
		}

		$text = str_replace("\n", "\n" . $markdown , $text);

		return $markdown . $text;
	}

	public static function ol( $list = '', $start = 1 )
	{
		$markdown = $start . '. ';

		if( gettype($list) == "string" )
		{
			$list = explode("\n", $list );
		}

		$this_line = $markdown . array_shift( $list );

		if ( count($list) == 0 )
		{
			return $this_line;
		}

		else
		{
			return $this_line . "\n" . static::ol( $list , $start + 1 );
		}
	}

	public static function codeblock( $text = '' )
	{
		$markdown = "\t";

		$text = str_replace("\n", "\n" . $markdown , $text);

		return $markdown . $text;
	}

	public static function link( $link, $text = null, $title = null )
	{
		if (!$text)
		{
			return "<$link>";
		}

		if( $title )
		{
			$title = ' ' . $title;
		}

		return "[$text]({$link}$title)";
	}

	public static function em( $text, $markdown = '*')
	{
		if ( $markdown != '*' and $markdown != '_')
		{
			$markdown = '*';
		}
		return $markdown . $text . $markdown;
	}

	public static function code( $text)
	{
		$markdown = "`";
		return $markdown . $text . $markdown;
	}

	public static function image( $url, $alt = '' )
	{
		return "![$alt]($url)";
	}
}