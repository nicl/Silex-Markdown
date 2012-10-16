<?php

namespace Nicl\Silex\Tests;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Nicl\Silex\MarkdownServiceProvider;

class SilexMarkdownTest extends \PHPUnit_Framework_Testcase
{
    public function setUp()
    {
        $this->app = new Application();
        $this->app->register(new MarkdownServiceProvider());
        $this->app->register(new TwigServiceProvider());
    }

    public function testMarkdown()
    {
        $ouput = $this->app['markdown']->transformMarkdown('#Hello World');
        $this->assertEquals("<h1>Hello World</h1>\n", $output);
    }

    public function testMarkdownTwigFilter()
    {
        $twig = $this->app['twig'];

        // tokenise, parse, compile
        $raw = "{{ '#Hello World'|markdown }}";
        $stream = $twig->tokenise($raw);
        $ast = $twig->parse($stream);
        $output = $twig->compile($ast);

        $this->assertEquals("<h1>Hello World</h1>\n", $output);
    }
}