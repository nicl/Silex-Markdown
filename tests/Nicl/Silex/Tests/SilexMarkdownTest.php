<?php

namespace Nicl\Silex\Tests;

use Silex\Application;
use Nicl\Silex\MarkdownProvider;

class SilexMarkdownTest extends \PHPUnit_Framework_Testcase
{
    public function setUp()
    {
        $this->app = new Application();
        $this->app->register(new MarkdownProvider());
    }

    public function testMarkdown() {}

    public function testMarkdownTwigFilter() {}
}