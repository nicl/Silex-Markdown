<?php

namespace Nicl\Silex;

use dflydev\markdown\MarkdownExtraParser;
use dflydev\markdown\MarkdownParser;
use Nicl\Twig\Extension\MarkdownTwigExtension;
use Silex\Application;
use Silex\ServiceProviderInterface;

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
        $app['markdown'] = $app->share(function() use($app) {
            if (!empty($app['markdown.factory'])) {
                return $app[$app['markdown.factory']];
            }

            $parser = !(empty($app['markdown.parser'])) ? $app['markdown.parser'] : 'markdown';

            switch ($parser) {
                case 'markdown':
                    return new MarkdownParser;
                    break;
                case 'extra':
                    return new MarkdownExtraParser;
                    break;
                default:
                    throw new \RuntimeException("Unknown Markdown parser '$parser' specified");
            }
        });

        $app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
            $twig->addExtension(new MarkdownTwigExtension($app['markdown']));

            return $twig;
        }));
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
    }
}
