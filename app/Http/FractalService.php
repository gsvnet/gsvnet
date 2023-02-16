<?php

namespace App\Http;

use Illuminate\Http\Response;
use League\Fractal\Manager;
use League\Fractal\Pagination\CursorInterface as FractalCursorInterface;
use League\Fractal\Pagination\PaginatorInterface as FractalPaginatorInterface;
use League\Fractal\Resource\Collection as FractalCollection;
use League\Fractal\Resource\Item as FractalItem;
use League\Fractal\Resource\ResourceInterface as FractalResourceInterface;

class FractalService
{
    /**
     * FractalService constructor.
     *
     * @param  Manager  $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * Create a new collection resource with the given transformer.
     *
     * @param  array|object  $collection
     * @param  object  $transformer
     * @param  \League\Fractal\Pagination\CursorInterface  $cursor
     * @param  string  $key
     * @return \Illuminate\Http\Response
     */
    public function collection($collection, object $transformer, FractalCursorInterface $cursor = null, string $key = null): Response
    {
        $resource = new FractalCollection($collection, $transformer, $key);

        if (! is_null($cursor)) {
            $resource->setCursor($cursor);
        }

        return $this->build($resource);
    }

    /**
     * Create a new item resource with the given transformer.
     *
     * @param  array|object  $item
     * @param  object  $transformer
     * @param  string  $key
     * @return \Illuminate\Http\Response
     */
    public function item($item, object $transformer, string $key = null): Response
    {
        $resource = new FractalItem($item, $transformer, $key);

        return $this->build($resource);
    }

    /**
     * Create a new collection resource from a paginator with the given transformer.
     *
     * @param  \League\Fractal\Pagination\PaginatorInterface  $paginator
     * @param  object  $transformer
     * @param  string  $key
     * @return \Illuminate\Http\Response
     */
    public function paginator(FractalPaginatorInterface $paginator, object $transformer, string $key = null): Response
    {
        $resource = new FractalCollection($paginator->getCollection(), $transformer, $key);

        $resource->setPaginator($paginator);

        return $this->build($resource);
    }

    /**
     * Build the response.
     *
     * @param  array|\League\Fractal\Resource\ResourceInterface  $data
     * @return \Illuminate\Http\Response
     */
    public function build($data): Response
    {
        if ($data instanceof FractalResourceInterface) {
            $data = $this->fractal->createData($data)->toArray();
        }

        return $data;
    }
}
