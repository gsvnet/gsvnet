<?php namespace GSVnet\Senates;

use BasePresenter, Carbon\Carbon;

class SenatePresenter extends BasePresenter
{
    public function __construct(Senate $senate)
    {
        $this->resource = $senate;
    }

    public function nameWithYear()
    {
        $string = $this->resource->name;
        $string .= ' (';
    	$string .= Carbon::createFromFormat('Y-m-d', $this->resource->start_date)->format('Y');
        $string .= ')';

        return $string;
    }

    public function body()
    {
        $body = $this->resource->body;
        //$body = $this->removeDoubleSpaces($body);
        $body = $this->convertMarkdown($body);
        // $body = $this->convertNewlines($body);
        // $body = $this->formatGists($body);
        // $body = $this->linkify($body);
        return $body;
    }

    private function convertMarkdown($content)
    {
        return \App::make('GSVnet\Markdown\HtmlMarkdownConvertor')->convertMarkdownToHtml($content);
    }
}