<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'subject',
        'message',
        'due_date'
    ];

    public static function isWeekend($date) {
        $weekDay = date('w', strtotime($date));
        return ($weekDay == 0 || $weekDay == 6);
    }

    public static function getDiffMinutes ($startDate, $endDate)
    {
        $startDate = new DateTime($startDate);
        $endDate = new DateTime($endDate);
        $diff = $endDate->diff($startDate);
        $diffMin = (int)$diff->format('%i');
        $diffHour = ((int)$diff->format('%h'));
        $diffTime = ($diffHour * 60) + $diffMin;
        if($diffTime < 1) $diffTime = 0;

        return $diffTime;
    }

    public static function calculateDueDate()
    {
        $now = date('Y-m-d H:i:s');
        $maxReactionTime = 16 * 60; //Percre pontosan kell megadni
        $reactionTime = 0;
        $workStart = ' 09:00:00';
        $workEnd = ' 17:00:00';
        $nowIsWeekend = self::isWeekend($now);
        $dueDate = '';

        /*
         * Ha munkaidőben küldték akkor adjuk hozzá
         * a mai nap hátralévő részét a reactionTime hoz
         * */
        if(!$nowIsWeekend){
            $dayStart = date('Y-m-d',strtotime($now)).$workStart;
            $dayEnd = date('Y-m-d',strtotime($now)).$workEnd;

            if($now >= $dayStart && $now < $dayEnd){
                $diffTime = self::getDiffMinutes($now,$dayEnd);
                $reactionTime += $diffTime;
            }
        }

        //Amíg nincs meg az esedékességi idő addig fusson
        $countDate = date('Y-m-d',strtotime($now));

        while( $maxReactionTime !== $reactionTime ){
            $countDate = date('Y-m-d',strtotime($countDate.' +1 day'));
            if(self::isWeekend($countDate)) continue;

            $startDate = $countDate.$workStart;
            $endDate = $countDate.$workEnd;
            $diffTime = self::getDiffMinutes($startDate,$endDate);

            $currentReactionTime = $reactionTime + $diffTime;

            /*
             * Ha elértük ezekkel az órákkal a visszajelzési időt akkor
             * nézzük meg, hogy pont megvan, vagy pedig maradt-e munkaidő
             * */
            if($currentReactionTime >= $maxReactionTime){
                $diffReactionTime = abs($maxReactionTime - $currentReactionTime);
                $reactionTime = $maxReactionTime;

                if($diffReactionTime > 0){
                    $dueDate = date('Y-m-d H:i:s',strtotime($countDate . $workEnd . ' -'.$diffReactionTime.' minutes'));
                }else{
                    $dueDate = date('Y-m-d H:i:s',strtotime($countDate . $workEnd));
                }

            }else{
                $reactionTime += $diffTime;
            }
        }

        if($dueDate) return $dueDate;
        return false;
    }

}
