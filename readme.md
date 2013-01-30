Rtablada\Markdown
=============

A lightweight Laravel style markdown creator in PHP for composer. The code structure follows the syntax listed at <http://daringfireball.net/projects/markdown/syntax>

##Instalation

####Using Composer:
	{
		"require": {
			"Rtablada/Markdown": "0.1.*"
	}
	
##Use

All of the methods are static calls on the Rtablada\Markdown class.

###Headings:

Simple calls will return h1 elements:
`Rtablada\Markdown::heading('Text')` returns `# Text`

A heading level can also be called as the first argument:
`Rtablada\Markdown::heading( 2, 'Text')` returns `## Text`

If multiple lines are passed to the heading method, only the first line is made a heading and all other text is left as is.
`Rtablada\Markdown::heading("Text\nNew Line)` returns ```# Text\nNew Line```

###Blockquotes

Block quotes support multiple lines where:
`Rtablada\Markdown::bockquote("Text\nNew Line)` returns ```> Text\n> New Line```

###Unordered Lists

Unorderd lists can be made using an array of strings or a multiline string. It also accepts an optional marker option which allows the user to specify either an astrik or underscore (astriks are used by default).

`Rtablada\Markdown::ul(['first', 'second'], '_')` and `Rtablada\Markdown::ul("first\nsecond"], '_')` both produce:
```1. first\n2. second```

###Ordered List

Ordered Lists work similar to unordered lists. The optional second argument accepts the start point for the ordered list.

`Rtablada\Markdown::ol(['first', 'second'])` and `Rtablada\Markdown::ol("first\nsecond"], '1')` both produce:
```1. first\n2. second```

###Code Blocks

Code blocks create a tabbed in area which is translated as a multiline code block:

`Rtablada\Markdown::codeblock("first\nsecond")`
produces:
`\tfirst\n\tsecond'`

###Links

Links can be created as quick links:

`Rtablada\Markdown::link('http:://google.com')` : `<http:://google.com>`

Or fully functioning markup links:

`Rtablada\Markdown::link('http:://google.com', 'Text', 'Title')` : `[Text](http:://google.com Title)>`

###Emphasis

em can be created with the em method:

`Rtablada\Markdown::em('text')` : `*text*`

so can strong blocks:

`Rtablada\Markdown::em('text', '**')` : `**text**`
`Rtablada\Markdown::em('text', '_')` : `_text_`

###In Line Code

In line code can be created:

`Rtablada\Markdown::code('{{ Form::open() }}', '**')` :  `` `{{ Form::open()` ``

###Images

Images items will be made using:
`Rtablada\Markdown::image('http://placehold.it/350x150', 'alt')` : `![alt](http://placehold.it/350x150)`