<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Reports2Fixture
 */
class Reports2Fixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'reports2';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'xml' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'user_id' => '755a87f8-502e-434f-a259-6cbacf0f2853',
                'created' => '2025-05-03 20:38:07',
                'modified' => '2025-05-03 20:38:07',
            ],
        ];
        parent::init();
    }
}
