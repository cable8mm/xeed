<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\ForeignKey;
use Cable8mm\Xeed\Generators\ModelGenerator;
use Cable8mm\Xeed\Generators\RelationGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class RelationGeneratorTest extends TestCase
{
    public Table $table;

    public Table $related;

    protected function setUp(): void
    {
        $this->table = new Table('samples', [
            Column::make('id', 'bigInteger'),
            Column::make('related_id', 'bigInteger'),
        ], [
            ForeignKey::make('samples_related_fk', 'Sample', 'related_id', 'Related', 'id'),
        ]);

        $this->related = new Table('related', [
            Column::make('id', 'bigInteger'),
        ]);

        ModelGenerator::make(
            $this->table,
            destination: Path::testgen()
        )->run();

        ModelGenerator::make(
            $this->related,
            destination: Path::testgen()
        )->run();

        RelationGenerator::make(
            $this->table,
            destination: Path::testgen()
        )->run();

        RelationGenerator::make(
            $this->related,
            destination: Path::testgen()
        )->run();
    }

    protected function tearDown(): void
    {
        File::system()->deleteDictionary(Path::testgen(), 'php');
    }

    public function test_it_can_generate_relations(): void
    {
        $this->assertFileMatchesFormat(
            '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    public function related()
    {
        return $this->belongsTo(Related::class, \'related_id\');
    }


}',
            Path::testgen().DIRECTORY_SEPARATOR.'Sample.php'
        );
        $this->assertFileMatchesFormat(
            '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Related extends Model
{
    use HasFactory;


    public function samples()
    {
        return $this->hasMany(Sample::class, \'related_id\');
    }

}',
            Path::testgen().DIRECTORY_SEPARATOR.'Related.php'
        );
    }
}
