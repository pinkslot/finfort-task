<?php

namespace App\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\ExclusionPolicy("All")
 */
class Release
{
    public const DESERIALIZE_GROUP = "release_deserialize_group";
    public const SERIALIZE_GROUP = "release_serialize_group";

    /**
     * @var string
     *
     * @JMS\Expose()
     * @JMS\Groups(App\Model\Release::DESERIALIZE_GROUP)
     * @JMS\XmlAttribute
     * @JMS\Type("string")
     */
    private $tag;

    /**
     * @var \DateTime
     *
     * @JMS\Expose()
     * @JMS\Groups(App\Model\Release::DESERIALIZE_GROUP)
     * @JMS\XmlAttribute
     * @JMS\Type("DateTime<'d.m.Y', '', 'Y-m-d'>")
     */
    private $date;

    /**
     * @var string[]
     *
     * @JMS\Expose()
     * @JMS\Groups(App\Model\Release::DESERIALIZE_GROUP)
     * @JMS\Type("array<string>")
     * @JMS\XmlList(inline=true, entry="update")
     */
    private $changes;

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @JMS\VirtualProperty("unformatedDate")
     * @JMS\Groups(App\Model\Release::SERIALIZE_GROUP)
     * @JMS\SerializedName("date")
     *
     * @return string
     */
    public function getUnformatedDate()
    {
        return $this->date->format('Y-m-d');
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\Groups(App\Model\Release::SERIALIZE_GROUP)
     *
     * @return string
     */
    public function getTitle()
    {
        return implode(';', $this->changes);
    }

    /**
     * @JMS\VirtualProperty("id")
     * @JMS\Groups(App\Model\Release::SERIALIZE_GROUP)
     *
     * @throws \Exception
     *
     * @return string
     */
    public function getId()
    {
        return rand(0, 9);
    }
}
