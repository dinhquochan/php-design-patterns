<?php

namespace DesignPatterns\ActiveObject;

class UploadCommand
{
    private $size;

    private $chunk;

    private $uploaded;

    /**
     * @var \DesignPatterns\ActiveObject\MultipleFileUploader
     */
    private $multipleFileUploader;

    public function __construct($speed, $size, MultipleFileUploader $multipleFileUploader)
    {
        $this->size = $size;
        $this->chunk = $size / $speed;
        $this->multipleFileUploader = $multipleFileUploader;
    }

    public function execute()
    {
        $this->uploaded += $this->chunk;

        print "\n{$this->uploaded}/{$this->size}";

        if ($this->uploaded < $this->size) {
            $this->multipleFileUploader->addUploader($this);
        }
    }
}
