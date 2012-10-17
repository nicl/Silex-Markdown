<?php

namespace Nicl\Twig\Extension;

use dflydev\markdown\IMarkdownParser;

/**
 * Twig Markdown extension
 */
class MarkdownTwigExtension extends \Twig_Extension
{
    protected $parser;

    /**
     * Public constructor
     *
     * @param IMarkdownParser $parser
     *
     * @return MarkdownTwigExtension
     */
    public function __construct(IMarkdownParser $parser)
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
