<?php

namespace Cable8mm\Xeed\Tests\Unit\Support;

use Cable8mm\Xeed\Commands\ImportXeedCommand;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class FileTest extends TestCase
{
    public function test_read_sql_can_read_file_without_comments(): void
    {
        $xeed = Xeed::getInstance();

        $filename = Path::database().DIRECTORY_SEPARATOR.ImportXeedCommand::TABLE_NAME.'.'.$xeed->driver.'.sql';

        $body = File::system()->readSql($filename);

        $this->assertStringNotContainsString('--', $body);
    }
}
