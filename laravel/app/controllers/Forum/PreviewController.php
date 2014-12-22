<?php
use GSVnet\Markdown\HtmlMarkdownConvertor;

class PreviewController extends BaseController {

    private $markdown;

    function __construct(HtmlMarkdownConvertor $markdown)
    {
        $this->markdown = $markdown;
    }

    public function preview()
    {
        $data = Input::get('text');
        return $this->markdown->convertMarkdownToHtml($data);
    }
}