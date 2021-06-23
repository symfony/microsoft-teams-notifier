<?php

namespace Symfony\Component\Notifier\Bridge\MicrosoftTeams\Tests\Action\Input;

use Symfony\Component\Notifier\Bridge\MicrosoftTeams\Action\Input\AbstractInput;
use Symfony\Component\Notifier\Bridge\MicrosoftTeams\Action\Input\MultiChoiceInput;
use Symfony\Component\Notifier\Bridge\MicrosoftTeams\Test\Action\Input\AbstractInputTestCase;
use Symfony\Component\Notifier\Exception\InvalidArgumentException;

final class MultiChoiceInputTest extends AbstractInputTestCase
{
    /**
     * @return MultiChoiceInput
     */
    public function createInput(): AbstractInput
    {
        return new MultiChoiceInput();
    }

    public function testTarget()
    {
        $input = $this->createInput()
            ->choice($display = 'DISPLAY', $value = 'VALUE');

        $this->assertSame(
            [
                ['display' => $display, 'value' => $value],
            ],
            $input->toArray()['choices']
        );
    }

    public function testIsMultiSelectWithTrue()
    {
        $input = $this->createInput()
            ->isMultiSelect(true);

        $this->assertTrue($input->toArray()['isMultiSelect']);
    }

    public function testIsMultiSelectWithFalse()
    {
        $input = $this->createInput()
            ->isMultiSelect(false);

        $this->assertFalse($input->toArray()['isMultiSelect']);
    }

    /**
     * @dataProvider styles
     */
    public function testStyle(string $value)
    {
        $input = $this->createInput()
            ->style($value);

        $this->assertSame($value, $input->toArray()['style']);
    }

    /**
     * @return \Generator<string, array{0: string}>
     */
    public function styles(): \Generator
    {
        yield 'style-expanded' => ['expanded'];
        yield 'style-normal' => ['normal'];
    }

    /**
     * @dataProvider styles
     */
    public function testStyleThrowsWithUnknownStyle()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->createInput()->style('red');
    }

    public function testToArray()
    {
        $this->assertSame(
            [
                '@type' => 'MultichoiceInput',
            ],
            $this->createInput()->toArray()
        );
    }
}
