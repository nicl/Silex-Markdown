Silex-Markdown
==============

A lightweight markdown service provider for Silex. Uses the
[Dragonfly](https://github.com/dflydev/dflydev-markdown) markdown parser.

Installation
------------

Recommended installation is [through composer](http://getcomposer.org). Just add
the following to your `composer.json` file:

    {
        "minimum-stability": "dev",
        "require": {
            "nicl/silex-markdown": "1.0.*"
        }
    }

Usage
-----

To use the service provider first register it:

    $app->register(new MarkdownServiceProvider());

You can then use the markdown filter in Twig files. For example:

    {{ '#Hello World'|markdown }}

In addition, you also have access to the Markdown parser itself. Simply
instantiate it and call the `transformMarkdown` method as follows:

    use dflydev\markdown\MarkdownParser;

    $parser = new MarkdownParser();
    $parser->transformMarkdown($txt);

Configuration
-------------

### Parameters

 * **markdown.factory**: Name of the service that will create
   `dflydev\markdown\IMarkdownParser` instances, string.
 * **markdown.parser**: Name of the built-in parser to use, string.
   *Default: markdown*

   Available options:
   * **markdown**:
     Standard Markdown parser
   * **extra**:
     Markdown Extra parser

### Services

 * **markdown**:
   Markdown parser, instance of `dflydev\markdown\IMarkdownParser`.

   If **markdown.factory** is defined, that service will be used to
   create the `IMarkdownParser` instance. Otherwise, **markdown.parser**
   will be examined and an instance of the appropriate class will be
   instantiated.

Tests
-----

If you wish to run the tests you need to have
[PHPUnit](https://github.com/sebastianbergmann/phpunit/) installed. Then, from
the silex-markdown root directory run:

    phpunit

(You may need to adapt the phpunit command and paths depending on your
configuration.)
