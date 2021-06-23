<?php

namespace Symfony\Component\Notifier\Bridge\MicrosoftTeams\Tests\Action\Input;

use Symfony\Component\Notifier\Bridge\MicrosoftTeams\Action\Input\AbstractInput;
use Symfony\Component\Notifier\Bridge\MicrosoftTeams\Action\Input\TextInput;
use Symfony\Component\Notifier\Bridge\MicrosoftTeams\Test\Action\Input\AbstractInputTestCase;

final class TextInputTest extends AbstractInputTestCase
{
    /**
     * @return TextInput
     */
    public function createInput(): AbstractInput
    {
        return new TextInput();
    }

    public function testIsMultilineWithTrue()
    {
        $input = $this->createInput()
            ->isMultiline(true);

        $this->assertTrue($input->toArray()['isMultiline']);
    }

    public function testIsMultilineWithFalse()
    {
        $input = $this->createInput()
            ->isMultiline(false);

        $this->assertFalse($input->toArray()['isMultiline']);
    }

    public function testMaxLength()
    {
        $input = $this->createInput()
            ->maxLength($value = 10);

        $this->assertSame($value, $input->toArray()['maxLength']);
    }

    public function testToArray()
    {
        $this->assertSame(
            [
                '@type' => 'TextInput',
            ],
            $this->createInput()->toArray()
        );
    }
}
