<?php

namespace App\Helpers;

use stdClass;

class iCalEvent
{
    /**
     * @var string
     */
    public $uid;

    /**
     * @var string
     */
    public $summary;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $dateStart;

    /**
     * @var string
     */
    public $dateEnd;

    /**
     * @var string
     */
    public $recurrenceId;

    /**
     * @var array
     */
    public $exdate = array();

    /**
     * @var stdClass
     */
    public $recurrence;

    /**
     * @var string
     */
    public $location;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $created;

    /**
     * @var string
     */
    public $updated;

    /**
     * @var integer
     */
    protected $_timeStart;

    /**
     * @var integer
     */
    protected $_timeEnd;

    /**
     * @var integer
     */
    protected $_recurrenceId;

    /**
     * @var array
     */
    protected $_occurrences;


    public function __construct($content = null)
    {
        if ($content) {
            $this->parse($content);
        }
    }


    public function summary()
    {
        return $this->summary;
    }

    public function title()
    {
        return $this->summary;
    }

    public function description()
    {
        return $this->description;
    }

    public function occurrences()
    {
        if (empty($this->_occurrences)) {
            $this->_occurrences = $this->_calculateOccurrences();
        }
        return $this->_occurrences;
    }

    public function duration()
    {
        // if ($this->_timeEnd) {
        return $this->_timeEnd - $this->_timeStart;
        // }
    }

    public function parse($content)
    {
        $content = str_replace("\r\n ", '', $content);

        // UID
        if (preg_match('`^UID:(.*)$`m', $content, $m))
            $this->uid = trim($m[1]);

        // Summary
        if (preg_match('`^SUMMARY:(.*)$`m', $content, $m))
            $this->summary = trim($m[1]);

        // Description
        if (preg_match('`^DESCRIPTION:(.*)$`m', $content, $m))
            $this->description = trim($m[1]);

        // Date start
        if (preg_match('`^DTSTART(?:;.+)?:([0-9]+(T[0-9]+Z?)?)`m', $content, $m)) {
            $this->_timeStart = strtotime($m[1]);
            $this->dateStart = date('Y-m-d H:i:s', $this->_timeStart);
        }

        // Date end
        if (preg_match('`^DTEND(?:;.+)?:([0-9]+(T[0-9]+Z?)?)`m', $content, $m)) {
            $this->_timeEnd = strtotime($m[1]);
            $this->dateEnd = date('Y-m-d H:i:s', $this->_timeEnd);
        }

        // Recurrence-Id
        if (preg_match('`^RECURRENCE-ID(?:;.+)?:([0-9]+(T[0-9]+Z?)?)`m', $content, $m)) {
            $this->_recurrenceId = strtotime($m[1]);
            $this->recurrenceId = date('Y-m-d H:i:s', $this->_recurrenceId);
        }

        // Exdate
        if (preg_match_all('`^EXDATE(;.+)?:([0-9]+(T[0-9]+Z?)?)`m', $content, $m)) {
            foreach ($m[2] as $dates) {
                $dates = explode(',', $dates);
                foreach ($dates as $d) {
                    $this->exdate[] = date('Y-m-d', strtotime($d));
                }
            }
        }

        // Recurrence
        if (preg_match('`^RRULE:(.*)`m', $content, $m)) {
            $rules = (object) array();
            $rule = trim($m[1]);

            $rule = explode(';', $rule);
            foreach ($rule as $r) {
                list($key, $value) = explode('=', $r);
                $rules->{ strtolower($key) } = $value;
            }

            if (isset($rules->until)) {
                $rules->until = date('Y-m-d H:i:s', strtotime($rules->until));
            }
            if (isset($rules->count)) {
                $rules->count = intval($rules->count);
            }
            if (isset($rules->interval)) {
                $rules->interval = intval($rules->interval);
            }
            if (isset($rules->byday)) {
                $rules->byday = explode(',', $rules->byday);
            }

            // Avoid infinite recurrences
            if (! isset($rules->until) && ! isset($rules->count)) {
                $rules->count = 500;
            }

            $this->recurrence = $rules;
        }


        // Location
        if (preg_match('`^LOCATION:(.*)$`m', $content, $m))
            $this->location = trim($m[1]);

        // Status
        if (preg_match('`^STATUS:(.*)$`m', $content, $m))
            $this->status = trim($m[1]);


        // Created
        if (preg_match('`^CREATED:(.*)`m', $content, $m))
            $this->created = date('Y-m-d H:i:s', strtotime(trim($m[1])));

        // Updated
        if (preg_match('`^LAST-MODIFIED:(.*)`m', $content, $m))
            $this->updated = date('Y-m-d H:i:s', strtotime(trim($m[1])));

        return $this;
    }

    public function isRecurrent()
    {
        return ! empty($this->recurrence);
    }

    public function fixOccurringDate($timestamp)
    {
        if($timestamp != $this->_timeStart) {
            // calculate correct start & end date if not a repeating event
            $duration = $this->duration();

            // get date from occurrences
            $timestampCalc = new DateTime();
            $timestampCalc->setTimestamp($timestamp);

            // make new startdate and start timestamp
            $startCalc = new DateTime();
            $startCalc->setTimestamp($this->_timeStart);
            $startCalc->setDate($timestampCalc->format('Y'), $timestampCalc->format('m'), $timestampCalc->format('d'));
            $this->_timeStart = $startCalc->getTimestamp();
            $this->dateStart = date('Y-m-d H:i:s', $this->_timeStart);

            // calculate end date and time with duration of original event.
            $this->_timeEnd += - $this->_timeStart + $duration;
            $this->dateEnd = date('Y-m-d H:i:s', $this->_timeEnd);
        }
    }

    protected function _isExdate($date)
    {
        if ((string) (int) $date != $date) {
            $date = strtotime($date);
        }
        $date = date('Y-m-d', $date);

        return in_array($date, $this->exdate);
    }

    protected function _calculateOccurrences()
    {
        $occurrences = array($this->_timeStart);

        if ($this->isRecurrent())
        {
            $freq = $this->recurrence->freq;
            $count = isset($this->recurrence->count) ? $this->recurrence->count : null;
            $until = isset($this->recurrence->until) ? strtotime($this->recurrence->until) : null;

            $callbacks = array(
                'YEARLY' => '_nextYearlyOccurrence',
                'MONTHLY' => '_nextMonthlyOccurrence',
                'WEEKLY' => '_nextWeeklyOccurrence',
                'DAILY' => '_nextDailyOccurrence'
            );
            $callback = $callbacks[$freq];

            $offset = $this->_timeStart;
            $continue = $until ? ($offset < $until) : ($count > 1);
            while ($continue) {
                if(isset($occurrence)) {
                    if (! $this->_isExdate($occurrence)) {
                        $occurrences[] = $occurrence;
                        $count--;
                    }

                }
                $occurrence = $this->{$callback}($offset);

                $offset = $occurrence;

                $continue = $until ? ($offset < $until) : ($count > 1);
            }
        }

        if ($this->_isExdate($occurrences[0])) {
            unset($occurrences[0]);
            $occurrences = array_values($occurrences);
        }

        return $occurrences;
    }

    protected function _nextYearlyOccurrence($offset)
    {
        $interval = isset($this->recurrence->interval)
            ? $this->recurrence->interval
            : 1;

        return strtotime("+{$interval} year", $offset);
    }

    protected function _nextMonthlyOccurrence($offset)
    {
        $dayname = array(
            'MO' => 'monday',
            'TU' => 'tuesday',
            'WE' => 'wednesday',
            'TH' => 'thursday',
            'FR' => 'friday',
            'SA' => 'saturday',
            'SU' => 'sunday'
        );

        $interval = isset($this->recurrence->interval)
            ? $this->recurrence->interval
            : 1;

        // INTERVAL IS BY (COUNT)DAYNAME
        if(isset($this->recurrence->byday)){
            $dates = array();
            foreach ($this->recurrence->byday as $pattern) {
                $offsetDateTime = new DateTime();
                $offsetDateTime->setTimestamp((int) $offset);

                preg_match('`([-]?\d+)?(MO|TU|WE|TH|FR|SA|SU)`m', $pattern, $m);
                $recurrenceOffset = (isset($m[1])) ? (int) $m[1] : 1;
                $recurrenceDay = strtr($m[2], $dayname);

                $forDateTime = clone $offsetDateTime;

                for (
                    $month = (int) $offsetDateTime->format('Ym');
                    $month <= date('Ym', strtotime('+' . $interval*12 . ' months'));
                    $month = (int) $forDateTime->modify('+'.$interval.' months')->format('Ym')
                ) {
                    $yearMonth = $forDateTime->format('Y-m');
                    $firstDay = new DateTime('first '. $recurrenceDay . ' of ' . $yearMonth);
                    $lastDay = new DateTime('last '. $recurrenceDay . ' of ' . $yearMonth);

                    $newDate = $firstDay;

                    $daysInMonth = array();
                    while ($newDate->getTimestamp() <= $lastDay->getTimestamp()) {
                        $daysInMonth[] = $newDate->getTimestamp();
                        $newDate->modify('next '. $recurrenceDay);
                    }

                    if($recurrenceOffset < 0) {
                        $dates[] = $daysInMonth[count($daysInMonth) + $recurrenceOffset];
                    } else {
                        $dates[] = $daysInMonth[$recurrenceOffset - 1];
                    }
                }
            }
            sort($dates);

            foreach ($dates as $date) {
                if ($date > $offset) {
                    return $date;
                }
            }
        }

        // INTERVAL IS BY DAYNUMBER OF MONTH
        $bymonthday = isset($this->recurrence->bymonthday)
            ? explode(',', $this->recurrence->bymonthday)
            : array(date('d', $offset));

        $start = strtotime(date('Y-m-01 H:i:s', $offset));

        $dates = array();
        foreach ($bymonthday as $day) {
            // this month
            $dates[] = strtotime(($day-1) . ' day', $start);

            // next 'interval' month
            $tmp = strtotime("+{$interval} month", $start);
            $time = strtotime(($day-1) . ' day', $tmp);
            if ((string) (int) date('d', $time) == (int) $day) {
                $dates[] = $time;
            }

            // 2x 'interval' month
            $interval *= 2;
            $tmp = strtotime("+{$interval} month", $start);
            $time = strtotime(($day-1) . ' day', $tmp);
            if ((string) (int) date('d', $time) === (int) $day) {
                $dates[] = $time;
            }
        }
        sort($dates);

        foreach ($dates as $date) {
            if ($date > $offset) {
                return $date;
            }
        }
    }

    protected function _nextWeeklyOccurrence($offset)
    {
        $interval = isset($this->recurrence->interval)
            ? $this->recurrence->interval
            : 1;

        $byday = isset($this->recurrence->byday)
            ? $this->recurrence->byday
            : array( substr(strtoupper(date('D', $offset)), 0, 2) );

        $start = date('l', $offset) !== 'Monday'
            ? strtotime('last monday', $offset)
            : $offset;

        $daysname = array(
            'MO' => 'monday',
            'TU' => 'tuesday',
            'WE' => 'wednesday',
            'TH' => 'thursday',
            'FR' => 'friday',
            'SA' => 'saturday',
            'SU' => 'sunday',
        );

        $dates = array();
        foreach ($byday as $day) {
            $dayname = $daysname[$day];

            // this week
            $dates[] = strtotime($dayname, $start);

            // next 'interval' week
            $tmp = strtotime("+{$interval} week", $start);
            $time = strtotime($dayname, $tmp);
            $dates[] = $time;
        }
        sort($dates);

        foreach ($dates as $date) {
            if ($date > $offset) {
                return $date;
            }
        }
    }

    protected function _nextDailyOccurrence($offset)
    {
        $interval = $this->recurrence->interval ?? 1;

        return strtotime("+{$interval} day", $offset);
    }
}
