<?php

declare(strict_types=1);

/*
 * This file is part of the Nexylan packages.
 *
 * (c) Nexylan SAS <contact@nexylan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nexy\Slack;

/**
 * @author Sullivan Senechal <soullivaneuh@gmail.com>
 * @author Mikey McLellan <mikey@mclellan.org.nz>
 */
class SectionBlock extends Block
{
    /**
     * @var TextBlock
     */
    private $text;

    /**
     * @var Block
     */
    private $accessory;

    /**
     * @var TextBlock[]
     */
    private $fields = [];

    public function __construct($type = 'section')
    {
        parent::__construct($type);
    }

    /**
     * @param string $text
     */
    public function setText(TextBlock $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getText(): TextBlock
    {
        return $this->text;
    }

    public function setPlainText(string $string): self
    {
        return $this->setText((new TextBlock())
            ->setType(TextBlock::PLAIN_TEXT)
            ->setText($string));
    }

    public function setMarkdown(string $string): self
    {
        return $this->setText((new TextBlock())
            ->setType(TextBlock::MARKDOWN)
            ->setText($string));
    }

    /**
     * @return array
     */
    public function getAccessory(): Block
    {
        return $this->accessory;
    }

    /**
     * @param array $accessory
     */
    public function setAccessory(Block $accessory): self
    {
        $this->accessory = $accessory;

        return $this;
    }

    /**
     * Convert this block to its array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'text' => $this->text->toArray(),
            'fields' => $this->getFieldsAsArrays()
        ];

        if ($this->accessory) {
            $data['accessory'] = $this->accessory->toArray();
        }

        return array_merge(parent::toArray(), $this->removeNulls($data));
    }

    /**
     * Add an field to the message.
     *
     * @param TextBlock $field
     *
     * @return $this
     */
    public function addField(TextBlock $field): self
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * @return TextBlock[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Set the fields for the message.
     *
     * @param TextBlock[] $fields
     *
     * @return $this
     */
    public function setFields(array $fields): self
    {
        $this->clearFields();

        foreach ($fields as $field) {
            $this->addField($field);
        }

        return $this;
    }

    /**
     * Remove all fields for the message.
     *
     * @return $this
     */
    public function clearFields(): self
    {
        $this->fields = [];

        return $this;
    }

    /**
     * Iterates over all fields in this attachment and returns
     * them in their array form.
     *
     * @return array
     */
    private function getFieldsAsArrays(): array
    {
        $fields = [];

        foreach ($this->fields as $field) {
            $fields[] = $field->toArray();
        }

        return $fields;
    }
}
