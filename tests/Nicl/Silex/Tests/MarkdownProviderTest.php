<?php

namespace Nicl\Silex\Tests;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Twig_Loader_String;
use Nicl\Silex\MarkdownServiceProvider;

class MarkdownServiceProviderTest extends \PHPUnit_Framework_Testcase
{
    public function setUp()
    {
        $this->app = new Application();
        $this->app->register(new TwigServiceProvider());
        $this->app->register(new MarkdownServiceProvider());
    }

    public function testMarkdownTwigFilter()
    {
        $twig = $this->app['twig'];
        $twig->setLoader(new Twig_Loader_String());
        $output = $twig->loadTemplate("{{ '#Hello World'|markdown }}")->render(array());

        $this->assertEquals("<h1>Hello World</h1>\n", $output);
    }
}