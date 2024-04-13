<?php

namespace Cable8mm\Xeed\Support;

use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;

/**
 * The wrapper of `League\Flysystem\Filesystem`.
 */
final class File
{
    /**
     * Singleton Filesystem Instance.
     */
    private static ?Filesystem $filesystem = null;

    /**
     * Read a file.
     *
     * @return string The method returns the string representation.
     *
     * @throws \League\Flysystem\UnableToWriteFile
     * @throws \League\Flysystem\FilesystemException
     */
    public function read(string $location): string
    {
        return self::$filesystem->read($location);
    }

    /**
     * Read a sql file without comments.
     *
     * @return string The method returns the string representation without comments.
     *
     * @throws \League\Flysystem\UnableToWriteFile
     * @throws \League\Flysystem\FilesystemException
     */
    public function readSql(string $location): string
    {
        $body = self::$filesystem->read($location);

        $body = preg_replace('/^--.*?$/m', '', $body);

        return preg_replace('/^\s*?$\n/m', '', $body);
    }

    /**
     * Write a content to a file.
     *
     * @param  bool  $force  Whether to force writing of the file or not (default false)
     *
     * @throws \RuntimeException
     * @throws \League\Flysystem\UnableToWriteFile
     * @throws \League\Flysystem\FilesystemException
     */
    public function write(string $location, string $content, bool $force = false): void
    {
        if ($force === false && self::$filesystem->has($location) === true) {
            throw new \RuntimeException($location.' file already exists');
        }

        self::$filesystem->write($location, $content);
    }

    /**
     * Write a empty content to a file.
     *
     * @param  bool  $force  Whether to force writing of the file or not (default false)
     *
     * @throws \RuntimeException
     * @throws \League\Flysystem\UnableToWriteFile
     * @throws \League\Flysystem\FilesystemException
     */
    public function touch(string $location, bool $force = false): void
    {
        $this->write($location, '');
    }

    /**
     * Delete a file.
     *
     * @throws \League\Flysystem\UnableToWriteFile
     * @throws \League\Flysystem\FilesystemException
     */
    public function delete(string $location): void
    {
        self::$filesystem->delete($location);
    }

    /**
     * Delete all files in a directory.
     *
     * @param  string|null  $ext  The extension of the files to be deleted.
     */
    public function deleteDictionary(string $path, ?string $ext = null): void
    {
        if ($ext === null) {
            self::$filesystem->deleteDirectory($path);

            return;
        }

        array_map(function ($location) {
            $this->delete($location);
        }, array_filter((array) glob($path.DIRECTORY_SEPARATOR.'*.'.$ext)));
    }

    /**
     * Create a instance of the class.
     *
     * @return static The method returns the current instance that enables method chaining.
     */
    public static function system(): static
    {
        if (self::$filesystem === null) {
            $adapter = new LocalFilesystemAdapter('/');

            self::$filesystem = new Filesystem($adapter);
        }

        return new self();
    }
}
