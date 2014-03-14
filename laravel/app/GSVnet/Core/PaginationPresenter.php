<?php namespace GSVnet\Core;
use Illuminate\Pagination\BootstrapPresenter;

class PaginationPresenter extends BootstrapPresenter {


    /**
     * Render the Pagination contents.
     *
     * @return string
     */
    public function render()
    {
        // The hard-coded thirteen represents the minimum number of pages we need to
        // be able to create a sliding page window. If we have less than that, we
        // will just render a simple range of page links insteadof the sliding.
        if ($this->lastPage < 9)
        {
            $content = $this->getPageRange(1, $this->lastPage);
        }
        else
        {
            $content = $this->getPageSlider();
        }

        return $this->getPrevious().$content.$this->getNext();
    }

    /**
     * Create a pagination slider link window.
     *
     * @return string
     */
    protected function getPageSlider()
    {
        $window = 3;

        // If the current page is very close to the beginning of the page range, we will
        // just render the beginning of the page range, followed by the last 2 of the
        // links in this list, since we will not have room to create a full slider.
        if ($this->currentPage <= $window)
        {
            $ending = $this->getFinish();

            return $this->getPageRange(1, $window + 1).$ending;
        }

        // If the current page is close to the ending of the page range we will just get
        // this first couple pages, followed by a larger window of these ending pages
        // since we're too close to the end of the list to create a full on slider.
        elseif ($this->currentPage >= $this->lastPage - $window)
        {
            $start = $this->lastPage - 4;

            $content = $this->getPageRange($start, $this->lastPage);

            return $this->getStart().$content;
        }

        // If we have enough room on both sides of the current page to build a slider we
        // will surround it with both the beginning and ending caps, with this window
        // of pages in the middle providing a Google style sliding paginator setup.
        else
        {
            $content = $this->getAdjacentRange();

            return $this->getStart().$content.$this->getFinish();
        }
    }


    /**
     * Get the page range for the current page window.
     *
     * @return string
     */
    public function getAdjacentRange()
    {
        return $this->getPageRange($this->currentPage - 2, $this->currentPage + 2);
    }

    /**
     * Create the beginning leader of a pagination slider.
     *
     * @return string
     */
    public function getStart()
    {
        return $this->getPageRange(1, 1).$this->getDots();
    }

    /**
     * Create the ending cap of a pagination slider.
     *
     * @return string
     */
    public function getFinish()
    {
        $content = $this->getPageRange($this->lastPage, $this->lastPage);

        return $this->getDots().$content;
    }

}
