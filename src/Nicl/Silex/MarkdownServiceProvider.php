<?php

namespace Nicl\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;
use dflydev\markdown\MarkdownParser;
use Nicl\Twig\Extension\MarkdownTwigExtension;

class MarkdownServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
            $twig->addExtension(new MarkdownTwigExtension(new MarkdownParser()));
            return $twig;
        }));
    }

    public function boot(Application $app) {}
}