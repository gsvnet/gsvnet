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
     */
    protected function reset(): void
    {
        $this->statusCode = 200;
        $this->headers = [];
    }

    /**
     * Add a header to the response
     */
    public function addHeader(string $name, string $value): static
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Add an array of headers.
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
     */
    public function withItem($item, object $transformer, string $key = null): Response
    {
        $fractalService = $this->getFractalService();

        $data = $fractalService->item($item, $transformer, $key);

        return $this->withArray($data);
    }

    /**
     * Create a new collection resource from a paginator with the given transformer.
     */
    public function withPaginator(FractalPaginatorInterface $paginator, object $transformer, string $key = null): Response
    {
        $fractalService = $this->getFractalService();

        $data = $fractalService->paginator($paginator, $transformer, $key);

        return $this->withArray($data);
    }

    /**
     * Return an array response.
     */
    public function withArray(array $array = []): Response
    {
        return $this->build($array);
    }

    /**
     * Return an error response.
     *
     * @param  string|array  $error
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
     */
    public function setStatusCode($statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function itemWasCreated(): static
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED);
    }

    public function itemWasUpdated(): static
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_OK);
    }

    public function itemWasRemoved(): static
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NO_CONTENT);
    }

    /**
     * Return a 404 not found error.
     */
    public function errorNotFound(string $message = 'Not Found'): static
    {
        return $this->withError($message, IlluminateResponse::HTTP_NOT_FOUND);
    }

    /**
     * Return a 400 bad request error.
     */
    public function errorBadRequest(string $message = 'Bad Request'): static
    {
        return $this->withError($message, IlluminateResponse::HTTP_BAD_REQUEST);
    }

    /**
     * Return a 403 forbidden error.
     *
     * @param  string|array  $message
     */
    public function errorForbidden($message = 'Forbidden'): static
    {
        return $this->withError($message, IlluminateResponse::HTTP_FORBIDDEN);
    }

    /**
     * Return a 500 internal server error.
     *
     * @param  string|array  $message
     */
    public function errorInternal($message = 'Internal Error'): static
    {
        return $this->withError($message, IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Return a 401 unauthorized error.
     *
     * @param  string|array  $message
     */
    public function errorUnauthorized($message = 'Unauthorized'): Response
    {
        return $this->withError($message, IlluminateResponse::HTTP_UNAUTHORIZED);
    }

    public function getFractal(): Manager
    {
        return App::make(Manager::class);
    }

    /**
     * Set the fractalService instance.
     *
     *
     * @internal param $FractalService
     */
    public function setFractalService(FractalService $fractalService)
    {
        $this->fractal = $fractalService;
    }

    /**
     * Get the fractalService.
     */
    public function getFractalService(): FractalService
    {
        return $this->fractal ?: App::make(FractalService::class);
    }
}
