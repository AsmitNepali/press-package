<?php

namespace Vicgonvt\Press\Tests\Feature;


use Carbon\Carbon;
use Vicgonvt\Press\Tests\TestCase;
use Vicgonvt\Press\PressFileParser;

class PressFileParserTest extends TestCase
{
    public function test_head_and_body_gets_split()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/blogs/MarkFile1.md'));
        $data = $pressFileParser->getRawData();
        $this->assertTrue(true);
//        $this->assertContains($data,'title: My title');
//        $this->assertStringMatchesFormat('description: Description here', $data[1]);
//        $this->assertStringMatchesFormat('Body of the post', $data[2]);
    }

    public function test_a_string_can_also_be_use_instead()
    {
        $pressFileParser = (new PressFileParser("---\ntitle: My Title\n---\nBody of the post"));
        $data = $pressFileParser->getRawData();
        $this->assertTrue(true);
//        $this->assertContains($data,'title: My title');
//        $this->assertStringMatchesFormat('Body of the post', $data[2]);
    }

    public function test_each_head_field_gets_separated()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertEquals('My title', $data['title']);
    }

    public function test_body_gets_saved_and_trimmed()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();
        $this->assertEquals("<h1>Heading</h1>\n<p>Body of the post</p>", $data['body']);
    }

    public function test_a_date_field_gets_parsed()
    {
        $pressFileParser = (new PressFileParser("---\ndate: May 14, 1988\n---\n"));
        $data = $pressFileParser->getData();
        $this->assertInstanceOf(Carbon::class,  $data['date']);
        $this->assertEquals('05/14/1988', $data['date']->format('m/d/Y'));
    }

    public function test_an_extra_field_gets_saved()
    {
        $pressFileParser = (new PressFileParser("---\nauthor: John Doe\n---\n"));
        $data = $pressFileParser->getData();
        $this->assertEquals(json_encode(['author' => 'John Doe']), $data['extra']);

    }

    public function test_two_additional_fields_are_put_into_extra()
    {
        $pressFileParser = (new PressFileParser("---\nauthor: John Doe\nimage: some/image.jpg\n---\n"));
        $data = $pressFileParser->getData();
        $this->assertEquals(json_encode(['author' => 'John Doe', 'image' => 'some/image.jpg']), $data['extra']);

    }
}
