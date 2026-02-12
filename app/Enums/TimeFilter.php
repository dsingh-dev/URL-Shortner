<?php

namespace App\Enums;

enum TimeFilter: string {

    case THIS_MONTH = 'this-month';
    case LAST_WEEK = 'last-week';
    case TODAY = 'today';

    /**
     * Get the values of the enum.
     *
     * @return array<string, string>
     */
    public static function toArray(): array {
        return [
            self::THIS_MONTH->value => self::THIS_MONTH->label(),
            self::LAST_WEEK->value => self::LAST_WEEK->label(),
            self::TODAY->value => self::TODAY->label(),
        ];
    }

    public function label(): string {
        return match ($this) {
            self::THIS_MONTH => 'This month',
            self::LAST_WEEK => 'Last week',
            self::TODAY => 'Today',
        };
    }
}
