<?php

<<<<<<< HEAD
namespace aidar555\hangman\Model;
=======
namespace Aidar555\hangman\Model;
>>>>>>> 671cd885c9c1e45054488e651978bbc09c65ffaf

class Dictionary
{
    private array $words = [
        'planet',
        'silver',
        'castle',
        'button',
        'garden',
        'friend',
        'bridge',
        'school',
        'mother',
    ];

    public function getRandomWord(): string
    {
        return $this->words[array_rand($this->words)];
    }
}