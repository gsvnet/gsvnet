<?php

namespace App\Http;

use App;
use Illuminate\Http\Response as IlluminateResponse;
use League\Fractal\Manager;
use League\Fractal\Pagination\CursorInterface as FractalCursorInterface;
use League\Fractal\Pagination\PaginatorInterface as FractalPaginatorInterface;

trait ResponderTrait
{
    /**
     * The FractalServer instance.
     */
    protected $fractal;

    /**
     * The HTTP response status code.
     *
     * @var int
     */
    protected $statusCode = 200;

    /**
     * The HTTP response headers.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * Reset this response builder instance.
     *
     * @return void
     */
    protected function reset(): void
    {
        $this->statusCode = 200;
        $this->headers = [];
    }

    /**
     * Add a header to the response
     *
     * @param  string  $name
     * @param  string  $value
     * @return $this
     */
    public function addHeader(string $name, string $value): static
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Add an array of headers.
     *
     * @param  array  $headers
     * @return $this
     */
    public function addHeaders(array $headers): static
    {
        $this->headers = array_merge($this->headers, $headers);

        return $this;
    }

    /**
     * Create a new collection resource with the given tranformer.
     *
     * @param  array|object  $collection
     * @param  object  $transformer
     * @param  \League\Fractal\Pagination\CursorInterface  $cursor
     * @param  string  $key
     * @return \Illuminate\Http\Response
     */
    public function withCollection($collection, object $transformer, FractalCursorInterface $cursor = null, string $key = null): Response
    {
        $fractalService = $this->getFractalService();

        $data = $fractalService->collection($collection, $transformer, $cursor, $key);

        return $this->withArray($data);
    }

    /**
     * Create a new item resource with the given transformer.
     *
     * @param  array|object  $item
     * @param  object  $transformer
     * @param  string  $key
     * @return \Illuminate\Http\Response
     */
    public function withItem($item, object $transformer, string $key = null): Response
    {
        $fractalService = $this->getFractalService();

        $data = $fractalService->item($item, $transformer, $key);

        return $this->withArray($data);
    }

    /**
     * Create a new collection resource from a paginator with the given transformer.
     *
     * @param  \League\Fractal\Pagination\PaginatorInterface  $paginator
     * @param  object  $transformer
     * @param  string  $key
     * @return \Illuminate\Http\Response
     */
    public function withPaginator(FractalPaginatorInterface $paginator, object $transformer, string $key = null): Response
    {
        $fractalService = $this->getFractalService();

        $data = $fractalService->paginator($paginator, $transformer, $key);

        return $this->withArray($data);
    }

    /**
     * Return an array response.
     *
     * @param  array  $array
     * @return \Illuminate\Http\Response
     */
    public function withArray(array $array = []): Response
    {
        return $this->build($array);
    }

    /**
     * Return an error response.
     *
     * @param  string|array  $error
     * @param  int  $statusCode
     * @return $this
     */
    public function withError($error, int $statusCode): static
    {
        if (! is_array($error)) {
            $error = ['error' => $error];
        }

        $error = array_merge(['status_code' => $statusCode], $error);

        return $this->setStatusCode($statusCode)->withArray($error);
    }

    /**
     * Build the response.
     *
     * @param  array|\League\Fractal\Resource\ResourceInterface  $data
     * @return \Illuminate\Http\Response
     */
    protected function build($data): Response
    {
        $response = new IlluminateResponse($data, $this->statusCode, $this->headers);

        return $response;
    }

    /**
     * Set the responses status code.
     *
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return $this
     */
    public function itemWasCreated(): static
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED);
    }

    /**
     * @return $this
     */
    public function itemWasUpdated(): static
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_OK);
    }

    /**
     * @return $this
     */
    public function itemWasRemoved(): static
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NO_CONTENT);
    }

    /**
     * Return a 404 not found error.
     *
     * @param  string  $message
     * @return $this
     */
    public function errorNotFound(string $message = 'Not Found'): static
    {
        return $this->withError($message, IlluminateResponse::HTTP_NOT_FOUND);
    }

    /**
     * Return a 400 bad request error.
     *
     * @param  string  $message
     * @return $this
     */
    public function errorBadRequest(string $message = 'Bad Request'): static
    {
        return $this->withError($message, IlluminateResponse::HTTP_BAD_REQUEST);
    }

    /**
     * Return a 403 forbidden error.
     *
     * @param  string|array  $message
     * @return $this
     */
    public function errorForbidden($message = 'Forbidden'): static
    {
        return $this->withError($message, IlluminateResponse::HTTP_FORBIDDEN);
    }

    /**
     * Return a 500 internal server error.
     *
     * @param  string|array  $message
     * @return $this
     */
    public function errorInternal($message = 'Internal Error'): static
    {
        return $this->withError($message, IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Return a 401 unauthorized error.
     *
     * @param  string|array  $message
     * @return \Illuminate\Http\Response
     */
    public function errorUnauthorized($message = 'Unauthorized'): Response
    {
        return $this->withError($message, IlluminateResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * @return Manager
     */
    public function getFractal(): Manager
    {
        return App::make(Manager::class);
    }

    /**
     * Set the fractalService instance.
     *
     * @param  FractalService  $fractalService
     *
     * @internal param $FractalService
     */
    public function setFractalService(FractalService $fractalService)
    {
        $this->fractal = $fractalService;
    }

    /**
     * Get the fractalService.
     *
     * @return FractalService
     */
    public function getFractalService(): FractalService
    {
        return $this->fractal ?: App::make(FractalService::class);
    }
}
