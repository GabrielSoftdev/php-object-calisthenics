<?php

namespace Alura\Calisthenics\Tests\Unit\Domain\Video;

use Alura\Calisthenics\Domain\Video\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    /**
     * @testFunction testVideoTestTestChangeVisibilityMustWork
     */
    public function testChangeVisibilityMustWork()
    {
        $video = new Video();
        $video->checkIfVisibilityIsValidAndUpdateIt(Video::PUBLIC);

        self::assertEquals(Video::PUBLIC, $video->getVisibility());
    }
}
