<?php

namespace DesignPatterns\EventDispatcher;

class BlogPublisher implements SenderInterface
{
    /**
     * @var \DesignPatterns\EventDispatcher\EventManager
     */
    private $eventManager;

    private $title;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->eventManager->dispatch('blog_title_update', $this);

        return $this;
    }
}
