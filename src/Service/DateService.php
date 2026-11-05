<?php

namespace App\Service;

final class DateService
{
   public static function calculateNbrJoursRestant(\DateTime $dateRetribution): int
    {
        $now = new \DateTime();
        $interval = $now->diff($dateRetribution);
        return (int) $interval->format('%r%a');
    }

    public static function formatDate(\DateTime $date): string
    {
        return $date->format('d/m/Y');
    }
}