<?php
function datum_auf_deutsch($datum = null, $format = \IntlDateFormatter::LONG) {
    if (!$datum) {
        $datum = new \DateTime();
    } elseif (!$datum instanceof \DateTime) {
        $datum = new \DateTime($datum);
    }

    $formatter = new \IntlDateFormatter(
        'de_DE',
        $format,
        \IntlDateFormatter::NONE
    );

    return $formatter->format($datum);
}
