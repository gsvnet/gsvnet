<?php namespace GSVnet\Senates;

use Laracasts\Presenter\Presenter, Carbon\Carbon, Config;

class SenatePresenter extends Presenter
{
    public function senateFunction()
    {
        $functions = Config::get('gsvnet.senateFunctions');
        return $functions[$this->pivot->function];
    }

    public function nameWithYear()
    {
        $string =   $this->name;
        $string .= ' (';
        $string .= Carbon::createFromFormat('Y-m-d',   $this->start_date)->format('Y');
        $string .= ')';

        return $string;
    }

    public function year()
    {
        return Carbon::createFromFormat('Y-m-d',   $this->start_date)->format('Y');
    }

    public function bodyFormatted()
    {
        return $this->convertMarkdown($this->body);
    }

    private function convertMarkdown($content)
    {
        return \App::make('GSVnet\Markdown\HtmlMarkdownConvertor')->convertMarkdownToHtml($content);
    }
}