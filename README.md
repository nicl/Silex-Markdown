Silex-Markdown
==============

A lightweight markdown service provider for Silex. Recommended installation is
[through composer](http://getcomposer.org). Just add the following to your
`composer.json` file:

    {
        "minimum-stability": "dev",
        "require": {
            "room271/silex-markdown": "1.0.*"
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

