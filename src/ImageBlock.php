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
final class ImageBlock extends Block
{
    /**
     * @var string
     */
    private $imageUrl;

    /**
     * @var string
     */
    private $altText;

    public function __construct()
    {
        parent::__construct('image');
    }

    /**
     * @return string
     */
    public function getAltText(): string
    {
        return $this->altText;
    }

    /**
     * @param string $altText
     */
    public function setAltText(string $altText): self
    {
        $this->altText = $altText;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

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
            'image_url' => $this->imageUrl,
            'alt_text' => $this->altText
        ];

        return array_merge(parent::toArray(), $this->removeNulls($data));
    }
}
