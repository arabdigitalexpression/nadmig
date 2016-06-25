<?php

if (!function_exists('limit_to_numwords')) {
    /**
     * Limit content with number of words
     *
     * @param $string
     * @param $numwords
     * @return array|string
     */
    function limit_to_numwords($string, $numwords)
    {
        $excerpt = explode(' ', $string, $numwords + 1);
        if (count($excerpt) >= $numwords) {
            array_pop($excerpt);
        }
        $excerpt = implode(' ', $excerpt) . ' ...';
        return $excerpt;
    }
}

if (!function_exists('renderMenuNode')) {
    /**
     * Render nodes for nested sets
     *
     * @param $node
     * @return string
     */
    function renderMenuNode($node)
    {
        $list = 'class="dropdown-menu"';
        $class = 'class="dropdown"';
        $caret = '<i class="fa fa-caret-down"></i>';
        $link = route('page', ['page_slug' => $node->slug]);
        $drop_down = '<a class="dropdown-toggle" data-toggle="dropdown" href="'.$link.'"
                        role="button" aria-expanded="false">' . $node->title . ' ' . $caret . '</a>';
        $single  = '<a href="'. $link .'">' . $node->title . '</a>';
        if ($node->isLeaf()) {
            return '<li>' . $single . '</li>';
        } else {
            $html = '<li '.$class.'>' . $drop_down;
            $html .= '<ul '.$list.'>';
            foreach ($node->children as $child) {
                $html .= renderMenuNode($child);
            }
            $html .= '</ul>';
            $html .= '</li>';
        }
        return $html;
    }
}

if (!function_exists('getTitle')) {
    /**
     * Render nodes for nested sets
     *
     * @param $object
     * @return string
     */
    function getTitle($object = null)
    {
        return isset($object) ?
            $object . ' | ' .  Session::get('current_lang')->site_title :
            Session::get('current_lang')->site_title;
    }
}

if (!function_exists('getDescription')) {
    /**
     * Render nodes for nested sets
     *
     * @param $object
     * @return string
     */
    function getDescription($object = null)
    {
        return isset($object) && isset($object->description) ?
            $object->description :
            Session::get('current_lang')->site_description;
    }
}

if (!function_exists('getNotWorkingWeekdays')) {
    /**
     * getWeekdays
     *
     * @param $object
     * @return string
     */
    function getNotWorkingWeekdays($days = null)
    {
        $weekdays = array(
            "sun" => 1,
            "mon" => 2,
            "tue" => 3,
            "wed" => 4,      
            "thu" => 5,
            "fri" => 6,
            "sat" => 7
            );
        foreach (json_decode($days) as $day) {
            unset($weekdays[$day]);
        };
        return array_values($weekdays);
    }
}

if (!function_exists('ArabicDate')) {
    /**
     * getWeekdays
     *
     * @param $object
     * @return string
     */
    function ArabicDate($date) {
        $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
        $your_date = date($date); // The Current Date
        $en_month = date("M", strtotime($your_date));
        foreach ($months as $en => $ar) {
            if ($en == $en_month) { $ar_month = $ar; }
        }
        $find = array ("Sat", "Sun", "Mon", "Tue", "Wed" , "Thu", "Fri");
        $replace = array ("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        $ar_day_format = date('D', strtotime($your_date)); // The Current Day

        $ar_day = str_replace($find, $replace, $ar_day_format);

        header('Content-Type: text/html; charset=utf-8');
        $standard = array("0","1","2","3","4","5","6","7","8","9");
        $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
        $current_date = $ar_day.' '.date('d', strtotime($your_date)).' '.$ar_month.' '.date('Y', strtotime($your_date));
        $arabic_date = str_replace($standard , $eastern_arabic_symbols , $current_date);

        return $arabic_date;
    }
}
if (!function_exists('ArabicTime')) {
    /**
     * getWeekdays
     *
     * @param $object
     * @return string
     */
    function ArabicTime($time) {
        $type = array("PM", "AM");
        $type_ar = array("م", "ص");
        $time = str_replace($type , $type_ar , $time);
        $standard = array("0","1","2","3","4","5","6","7","8","9");
        $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
        $arabic_time = str_replace($standard , $eastern_arabic_symbols , $time);
        return $arabic_time;
    }
}

if (!function_exists('getGroupAge')) {
    /**
     * getGroupAge
     *
     * @param $object
     * @return string
     */
    function getGroupAge($key) {

        $group_age = array(
            null => 'غير معيّن',
            '3_11' => 'من ٣ إلى ١١',
            '12_17' => 'من ١٢ إلى ١٧',
            '18_up' => 'من ١٨ فيما فوق'
            );

        return $group_age[$key];
    }
}
if (!function_exists('getEventtype')) {
    function getEventtype($key){
        $type = array(
            'private' => 'خاص',
            'public' => 'عام'
            );
        return $type[$key];
    }
}
if (!function_exists('ArabicPeriod')) {
    function ArabicPeriod($period){
        $type = array(
            'mins' => 'دقيقة',
            'hours' => 'ساعات'
            );
        if (intval($period->period) == 1 && $period->type == 'hours') {
            return $period->period . " ساعة";    
        }
        return $period->period . " " . $type[$period->type];
    }
}
if (!function_exists('ArabicCancelFees')) {
    function ArabicCancelFees($cancel){
        $change_fees_type = array("null" => "لا يوجد","percentage" => "نسبة من قيمة الحجز الكلى للمساحات","value" => "قيمة");
        if ($cancel->type == 'percentage') {
            return $change_fees_type[$cancel->type] . " " . $cancel->amount . "%";
        }
        return $change_fees_type[$cancel->type] . " " . $cancel->amount;
    }
}