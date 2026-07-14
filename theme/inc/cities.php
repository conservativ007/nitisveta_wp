<?php

function nitisveta_search_russia_cities(array $cities, string $search, int $limit = 50): array
{
    $search = trim($search);

    if ($search === '') {
        $cities = array_filter($cities, static function ($city) {
            return !empty($city['population']);
        });
        usort($cities, static function ($a, $b) {
            return ($b['population'] ?? 0) <=> ($a['population'] ?? 0);
        });
    } else {
        // ponytail: linear JSON scan; move cities to an indexed table if search latency becomes measurable.
        $cities = array_filter($cities, static function ($city) use ($search) {
            $name = (string) ($city['name'] ?? '');
            return function_exists('mb_stripos')
                ? mb_stripos($name, $search, 0, 'UTF-8') !== false
                : stripos($name, $search) !== false;
        });
    }

    return array_map(static function ($city) {
        $name = (string) $city['name'];
        $text = $name;

        if (!empty($city['isDualName']) && !empty($city['region']['name'])) {
            $text .= ' ' . $city['region']['name'] . ' ' . ($city['region']['typeShort'] ?? '');
        }

        return ['id' => $name, 'text' => trim($text)];
    }, array_slice(array_values($cities), 0, $limit));
}
