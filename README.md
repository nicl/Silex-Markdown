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

Tests
-----

If you wish to run the tests you need to have
[PHPUnit](https://github.com/sebastianbergmann/phpunit/) installed. Then, from
the silex-markdown root directory run:

    phpunit --bootstrap tests/bootstrap.php tests/Nicl/Silex/Tests/MarkdownProviderTest.php

(You may need to adapt the phpunit command and paths depending on your
configuration.)