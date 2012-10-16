<?php

namespace Nicl\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;
use dflydev\markdown\MarkdownParser;
use Nicl\Twig\Extension\MarkdownTwigExtension;

/**
 * Simple markdown service provider
 */
class MarkdownServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        $app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
            $twig->addExtension(new MarkdownTwigExtension(new MarkdownParser()));
            return $twig;
        }));
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app) {}
}