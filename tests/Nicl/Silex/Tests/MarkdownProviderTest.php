<?php

namespace Nicl\Silex\Tests;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Twig_Loader_String;
use Nicl\Silex\MarkdownServiceProvider;

/**
 * Tests for markdown service provider
 */
class MarkdownServiceProviderTest extends \PHPUnit_Framework_Testcase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->app = new Application();
        $this->app->register(new TwigServiceProvider());
        $this->app->register(new MarkdownServiceProvider());
    }

    /**
     * Basic test case of service provider
     */
    public function testMarkdownTwigFilter()
    {
        $twig = $this->app['twig'];
        $twig->setLoader(new Twig_Loader_String());
        $output = $twig->loadTemplate("{{ '#Hello World'|markdown }}")->render(array());

        $this->assertEquals("<h1>Hello World</h1>\n", $output);
    }

    /**
     * Test custom markdown factory works
     *
     * @param string $expectedClass   If successful, which class name should our object be an instance of?
     * @param bool   $expectException Should an exception be expected?
     * @param string $name            Name passed as the parser name
     *
     * @dataProvider testBuiltInMarkdownParsersProvider
     */
    public function testBuiltInMarkdownParsers($expectedClass = null, $expectException = null, $name = null)
    {
        if (null !== $name) {
            $this->app['markdown.parser'] = $name;
        }

        try {
            $markdown = $this->app['markdown'];

            if ($expectException) {
                $this->fail('Expected an exception to be thrown');
            }

            $this->assertInstanceOf($expectedClass, $markdown);
        } catch (\RuntimeException $e) {
            if ($expectException) {
                $this->assertContains("Unknown Markdown parser '$name' specified", $e->getMessage());
            } else {
                $this->fail('Expected a different exception');
            }
        }
    }

    /**
     * Provide data for testBuiltInMarkdownParsers
     *
     * @return array
     */
    public function testBuiltInMarkdownParsersProvider()
    {
        return array(
            array('dflydev\markdown\MarkdownParser', false),
            array('dflydev\markdown\MarkdownParser', false, 'markdown'),
            array('dflydev\markdown\MarkdownExtraParser', false, 'extra'),
            array(null, true, 'INVALID'),
        );
    }

    /**
     * Test custom markdown factory works
     */
    public function testCustomMarkdownFactory()
    {
        $app = $this->app;

        $markdownParser = $this->getMock('dflydev\markdown\IMarkdownParser');

        $app['test.markdown.factory'] = $app->share(function($app) use ($markdownParser) {
            return $markdownParser;
        });

        $app['markdown.factory'] = 'test.markdown.factory';

        $this->assertEquals($markdownParser, $app['markdown']);
    }

    /**
     * Test boot, 100% code coverage.
     */
    public function testBoot()
    {
        $this->app->boot();
    }
}
