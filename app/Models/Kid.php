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
        public ?int $collected_amount,
        public ?int $target_amount,
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

    public function getFormattedCollectedAmount(): string
    {
        return number_format($this->collected_amount ?? 0, 0, '.', ' ');
    }

    public function getFormattedTargetAmount(): string
    {
        return number_format($this->target_amount ?? 0, 0, '.', ' ');
    }

}