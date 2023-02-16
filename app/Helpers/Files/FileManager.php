<?php

namespace App\Helpers\Files;

class FileManager
{
    protected $createValidator;

    protected $updateValidator;

    protected $fileHandler;

    protected $files;

    public function __construct(
        FileCreatorValidator $createValidator,
        FileUpdatorValidator $updateValidator,
        FileHandler $fileHandler,
        FilesRepository $files
    ) {
        $this->fileHandler = $fileHandler;
        $this->createValidator = $createValidator;
        $this->updateValidator = $updateValidator;
        $this->files = $files;
    }

    /**
     * Validate input, create file model and store file file
     *
     * @param  array  $input
     * @return File
     */
    public function create(array $input): File
    {
        $this->createValidator->validate($input);
        // Store the file file and get its new path
        $this->uploadFile($input);
        // If the file was not given a name, use the file's name
        $this->nameFile($input);
        // Save the file to the database
        return $this->files->create($input);
    }

    /**
     * Validate input, update file model and optionally update file file
     *
     * @param  array  $input
     * @return File
     */
    public function update($id, array $input): File
    {
        $this->updateValidator->validate($input);
        // Optionally update the file's file
        if (isset($input['file'])) {
            // Delete the old file file and store the new one
            $file = $this->files->byId($id);
            $this->fileHandler->destroy($file->file_path);
            // Store the file file and get its new path
            $this->uploadFile($input);
            // If the file was not given a name, use the file's name
            $this->nameFile($input);
        }
        // Save the file to the database
        return $this->files->update($id, $input);
    }

    public function destroy($id)
    {
        $file = $this->files->delete($id);
        // Delete file files
        $this->fileHandler->destroy($file->file_path);

        return $file;
    }

    // Uploads a photo and adjust the input's src_path accordingly
    private function uploadFile(&$input)
    {
        if (! $input['file_path'] = $this->fileHandler->make($input['file'],
                '/uploads/files/')) {
            throw new FileStorageException;
        }
    }

    // Set photo's name if name was not provided
    private function nameFile(&$input)
    {
        // If the file was not given a name, use the file's name
        if (! (isset($input['name'])) || $input['name'] == '') {
            $input['name'] = $input['file']->getClientOriginalName();
        }
    }
}
