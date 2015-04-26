<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GSVnet;

/**
 * Some diffForHumans formatter implementations.
 *
 * Each format function takes 4 parameters:
 *   $isNow     boolean  indicates if the current instance is being  compared to now
 *                       or another Carbon instance
 *   $isFuture  boolean  indicates if the comparison result is in the future or the past
 *   $delta     integer  the result diff value
 *   $unit      string   the result diff type, one of
 *                       'year', 'month', 'day', 'hour', 'minute', 'second'
 *
 * Each function can use these parameters to produce the localized format string.
 *
 */
class CarbonDiffFormatters
{
   /*
    * English - the default
    *
    * @return Closure The formatter to use
    */
   public static function en()
   {
      return function ($isNow, $isFuture, $delta, $unit) {
         $txt = $delta . ' ' . $unit;
         $txt .= $delta == 1 ? '' : 's';

         if ($isNow) {
            $txt .= ($isFuture) ? ' from now' : ' ago';
            return $txt;
         }

         $txt .= ($isFuture) ? ' after' : ' before';
         return $txt;
      };
   }

   public static function nl()
   {
      return function ($isNow, $isFuture, $delta, $unit) {
         switch($unit) {
            case 'second':
               $unit = $delta == 1 ? 'seconde' : 'seconden';
               break;
            case 'minute':
               $unit = $delta == 1 ? 'minuut' : 'minuten';
               break;
            case 'hour':
               $unit = 'uur';
               break;
            case 'day':
               $unit = $delta == 1 ? 'dag' : 'dagen';
               break;
            case 'week':
               $unit = $delta == 1 ? 'week' : 'weken';
               break;
            case 'month':
               $unit = $delta == 1 ? 'maand' : 'maanden';
               break;
            case 'year':
               $unit = 'jaar';
               break;
         }

         $txt = $delta . ' ' . $unit;

         if ($isNow) {
            $txt = ($isFuture) ? 'over ' . $txt : $txt . ' geleden';
            return $txt;
         }

         $txt .= ($isFuture) ? ' erna' : ' ervoor';

         return $txt;
      };
   }
}
