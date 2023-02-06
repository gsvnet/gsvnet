<?php namespace GSV\Helpers\Markdown;

class HtmlMarkdownConverter
{
    protected $markdownParser;

    public function __construct()
    {

        $this->markdownParser = \Parsedown::instance()
            ->setBreaksEnabled(true);
    }

    public function convertMarkdownToHtml($markdown)
    {
        return $this->markdownParser->text($markdown);
    }
}