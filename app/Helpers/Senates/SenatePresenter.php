<?php

namespace App\Helpers\Senates;

use App\Helpers\Markdown\HtmlMarkdownConverter;
use Carbon\Carbon;
use Config;
use Laracasts\Presenter\Presenter;

class SenatePresenter extends Presenter
{
    private $canPresent = true;

    public function __construct($entity)
    {
        parent::__construct($entity);

        $end_date = Carbon::createFromFormat('Y-m-d', $this->end_date);
        $border_date = Carbon::now()->subYears(5);
        if (\Gate::denies('senates.show') and $end_date < $border_date) {
            $this->canPresent = false;
        }
    }

    public function canPresent()
    {
        return $this->canPresent;
    }

    public function senateFunction()
    {
        $functions = Config::get('gsvnet.senateFunctions');

        return $functions[$this->pivot->function];
    }

    public function nameWithYear()
    {
        $string = $this->name;
        $string .= ' (';
        $string .= Carbon::createFromFormat('Y-m-d', $this->start_date)->format('Y');
        $string .= ')';

        return $string;
    }

    public function year()
    {
        return Carbon::createFromFormat('Y-m-d', $this->start_date)->format('Y');
    }

    public function bodyFormatted()
    {
        if (! $this->canPresent) {
            return 'De daden van deze Senaat zijn verhuld door de tijd...';
        }

        return $this->convertMarkdown($this->body);
    }

    private function convertMarkdown($content)
    {
        return app(HtmlMarkdownConverter::class)->convertMarkdownToHtml($content);
    }
}
