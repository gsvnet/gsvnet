<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>

@if ($paginator->getLastPage() > 1)
    <ul class="pagination">
        {{ $presenter->getPrevious('« Later'); }}

        {{ $presenter->getPageRange(1, $paginator->getLastPage()); }}

        {{ $presenter->getNext('Eerder »'); }}
    </ul>
@endif