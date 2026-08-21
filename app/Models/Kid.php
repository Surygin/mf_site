<?php

declare(strict_types=1);

namespace App\Models;

class Kid
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?string $lastName,
        public ?string $history,
        public ?int $sum1,
        public ?int $sum2,
        public ?string $avatar,
        public bool $isActive,
    ) {
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function isFinished(): bool
    {
        return !$this->isActive;
    }

    public function getFullName(): string
    {
        return trim(($this->name ?? '') . ' ' . ($this->lastName ?? ''));
    }

    public function getFormattedSum1(): string
    {
        return number_format($this->sum1 ?? 0, 0, '.', ' ');
    }

    public function getFormattedSum2(): string
    {
        return number_format($this->sum2 ?? 0, 0, '.', ' ');
    }

}