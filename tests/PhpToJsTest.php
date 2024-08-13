<?php

namespace Fet\PhpToJs\Tests;

use Fet\PhpToJs\PhpToJs;
use Fet\PhpToJs\PhpToJsFacade;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Test;

class PhpToJsTest extends TestCase
{
    #[Test]
    public function it_can_add_variables()
    {
        $phpToJs = new PhpToJs();

        $this->assertEmpty($phpToJs->all());
        $this->assertEmpty($phpToJs->variables());

        $phpToJs->add([
            'aaa',
            'bbb' => 'ccc',
        ]);

        $phpToJs->add([
            'ddd' => [
                'eee',
                'fff' => 'ggg'
            ]
        ]);

        $expected = [
            'aaa',
            'bbb' => 'ccc',
            'ddd' => [
                'eee',
                'fff' => 'ggg'
            ]
        ];

        $this->assertEquals(['phpToJs' => $expected], $phpToJs->all());

        $this->assertEquals($expected, $phpToJs->variables());
    }

    #[Test]
    public function it_can_change_the_namespace()
    {
        $phpToJs = new PhpToJs();

        $phpToJs->add(['foo' => 'bar']);
        $phpToJs->setNamespace('test');
        $phpToJs->add(['bat' => 'baz']);

        $this->assertEquals([
            'phpToJs' => ['foo' => 'bar'],
            'test' => ['bat' => 'baz']
        ], $phpToJs->all());
    }

    #[Test]
    public function it_can_change_the_namespace_via_config()
    {
        $this->app->config->set('phptojs.namespace', 'test');

        $phpToJs = app(PhpToJs::class);

        $this->assertEquals('test', $phpToJs->getNamespace());
    }

    #[Test]
    public function it_injects_variables_into_the_view()
    {
        $this->app['view']->addLocation(__DIR__ . '/stubs');

        Route::get('/test', function () {
            return view('test');
        });

        PhpToJsFacade::add(['foo' => 'bar']);

        PhpToJsFacade::setNamespace('test');
        PhpToJsFacade::add(['bat' => 'baz']);

        $response = $this->get('/test');

        $response->assertSee("window.phpToJs = JSON.parse('{\u0022foo\u0022:\u0022bar\u0022}');", false);
        $response->assertSee("window.test = JSON.parse('{\u0022bat\u0022:\u0022baz\u0022}');", false);
    }

    #[Test]
    public function it_injects_variables_only_into_html()
    {
        Route::get('/test', function () {
            return response('let foo = "</body>";', 200)->header('Content-Type', 'text/javascript');
        });

        PhpToJsFacade::add(['foo' => 'bar']);

        $response = $this->get('/test');

        $this->assertEquals('let foo = "</body>";', $response->getContent());
    }
}
