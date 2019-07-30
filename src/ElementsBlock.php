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
class ElementsBlock extends Block
{
    /**
     * @var array
     */
    private $elements;

    public function __construct($type = 'actions')
    {
        parent::__construct($type);
    }

    /**
     * Convert this block to its array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'elements' => $this->getElementsAsArrays()
        ];

        return array_merge(parent::toArray(), $data);
    }

    /**
     * Add an element to the message.
     *
     * @param Block $element
     *
     * @return $this
     */
    public function addElement(Block $element): self
    {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * @return Block[]
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    /**
     * Set the elements for the message.
     *
     * @param array $elements
     *
     * @return $this
     */
    public function setElements(array $elements): self
    {
        $this->clearElements();

        foreach ($elements as $element) {
            $this->addElement($element);
        }

        return $this;
    }

    /**
     * Remove all elements for the message.
     *
     * @return $this
     */
    public function clearElements(): self
    {
        $this->elements = [];

        return $this;
    }


    /**
     * Iterates over all fields in this attachment and returns
     * them in their array form.
     *
     * @return array
     */
    private function getElementsAsArrays(): array
    {
        $elements = [];

        foreach ($this->elements as $element) {
            $elements[] = $element->toArray();
        }

        return $elements;
    }
}
