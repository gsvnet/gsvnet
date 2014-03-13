<?php namespace GSVnet\Core\Exceptions;
// Extend the Model Not Found Exception such that we can use  App::error($e ModelNotFoundException)
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EntityNotFoundException extends ModelNotFoundException {}