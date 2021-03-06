<?php

namespace Alura\Calisthenics\Domain\Student;

use Alura\Calisthenics\Domain\Video\Video;
use DateTimeInterface;
use Ds\Map;

class Student
{
    private string $email;
    private DateTimeInterface $birth;
    private Map $watchedVideos;
    private string $fName;
    private string $lName;
    public string $street;
    public string $number;
    public string $province;
    public string $city;
    public string $state;
    public string $country;

    public function __construct(string $email, DateTimeInterface $birth, string $fName, string $lName, string $street, string $number, string $province, string $city, string $state, string $country)
    {
        $this->watchedVideos = new Map();
        $this->setEmail($email);
        $this->birth = $birth;
        $this->fName = $fName;
        $this->lName = $lName;
        $this->street = $street;
        $this->number = $number;
        $this->province = $province;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
    }

    public function getFullName(): string
    {
        return "{$this->fName} {$this->lName}";
    }

    private function setEmail(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
            throw new \InvalidArgumentException('Invalid e-mail address');

        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBd(): DateTimeInterface
    {
        return $this->bd;
    }

    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->put($video, $date);
    }

    public function hasAccess(): bool
    {
        if ($this->watchedVideos->count() === 0)
            return true;

        $this->watchedVideos->sort(fn (DateTimeInterface $dateA, DateTimeInterface $dateB) => $dateA <=> $dateB);
        $firstDate = $this->watchedVideos->first()->value;
        $today = new \DateTimeImmutable();

        return $firstDate->diff($today)->days < 90;
    }
}
