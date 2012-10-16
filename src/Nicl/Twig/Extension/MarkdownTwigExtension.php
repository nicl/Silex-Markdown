<?php

namespace Nicl\Twig\Extension;

use dflydev\markdown\MarkdownParser;

/**
 * Twig Markdown extension
 */
class MarkdownTwigExtension extends \Twig_Extension
{
    protected $parser;

    /**
     * Public constructor
     *
     * @param MarkdownParser $parser
     *
     * @return MarkdownTwigExtension
     */
    function __construct(MarkdownParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            'markdown' => new \Twig_Filter_Method($this, 'markdown',
                array('is_safe' => array('html'))),
        );
    }

    /**
     * Transform markdown text to html
     *
     * @param string $txt
     *
     * @return string
     */
    public function markdown($txt)
    {
        return $this->parser->transformMarkdown($txt);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'markdown';
    }
}