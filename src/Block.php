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
class Block
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    private $blockId;

    public function __construct(?string $type)
    {
        $this->setType($type);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

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
            'type' => $this->type,
            'block_id' => $this->blockId
        ];

        return $this->removeNulls($data);
    }

    /**
     * @param string $blockId
     */
    public function setBlockId(string $blockId): self
    {
        $this->blockId = $blockId;

        return $this;
    }

    /**
     * @return string
     */
    public function getBlockId(): string
    {
        return $this->blockId;
    }

    protected function removeNulls(array $data): array
    {
        foreach($data as $k => $v) {
            if ($v === null || (is_array($v) && count($v) === 0)) {
                unset($data[$k]);
            }
        }
        return $data;
    }
}
