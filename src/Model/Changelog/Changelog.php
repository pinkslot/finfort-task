<?php

namespace App\Model\Changelog;

use App\Model\Release;
use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

/**
 * @JMS\ExclusionPolicy("all")
 */
class Changelog implements ChangelogInterface
{
    /**
     * @var string|null
     */
    private $currentTag;

    /**
     * @var Release[]
     *
     * @JMS\Expose()
     * @JMS\Type("array<App\Model\Release>")
     * @JMS\XmlList(inline=true, entry="release")
     */
    private $items;

    /**
     * @return array
     */
    public function getChangelog(): array
    {
        $serializer = SerializerBuilder::create()->build();

        $context = new SerializationContext();
        $context->setGroups(["Default", 'items' => [Release::DESERIALIZE_GROUP]]);
        return $serializer->toArray($this, $context);
    }

    /**
     * @return string
     */
    public function getCurrentTag(): array
    {
        if ($this->currentTag) {
            return $this->currentTag;
        }

        $tags = array_map(function(Release $release) {
            return $release->getTag();
        }, $this->items);

        $this->currentTag = max($tags);

        return $this->currentTag;
    }
}
