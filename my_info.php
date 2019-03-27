<?php

$a = array (
  'id' => 27991,
  'email' => 'vbrazas@student.unit.ua',
  'login' => 'vbrazas',
  'first_name' => 'Vitas',
  'last_name' => 'Brazas',
  'url' => 'https://api.intra.42.fr/v2/users/vbrazas',
  'phone' => '+380996507282',
  'displayname' => 'Vitas Brazas',
  'image_url' => 'https://cdn.intra.42.fr/users/vbrazas.jpg',
  'staff?' => false,
  'correction_point' => 7,
  'pool_month' => 'july',
  'pool_year' => '2017',
  'location' => 'e2r11p3',
  'wallet' => 85,
  'groups' => 
  array (
  ),
  'cursus_users' => 
  array (
    0 => 
    array (
      'grade' => 'Ensign',
      'level' => 12.3,
      'skills' => 
      array (
        0 => 
        array (
          'id' => 1,
          'name' => 'Algorithms & AI',
          'level' => 10.55,
        ),
      ),
      'id' => 30854,
      'begin_at' => '2017-10-23T05:42:00.000Z',
      'end_at' => NULL,
      'cursus_id' => 1,
      'has_coalition' => true,
      'user' => 
      array (
        'id' => 27991,
        'login' => 'vbrazas',
        'url' => 'https://api.intra.42.fr/v2/users/vbrazas',
      ),
      'cursus' => 
      array (
        'id' => 1,
        'created_at' => '2014-11-02T16:43:38.480Z',
        'name' => '42',
        'slug' => '42',
      ),
    ),
    1 => 
    array (
      'grade' => NULL,
      'level' => 2.59,
      'skills' => 
      array (
        0 => 
        array (
          'id' => 1,
          'name' => 'Algorithms & AI',
          'level' => 3.2,
        ),
      ),
      'id' => 23298,
      'begin_at' => '2017-07-24T05:42:00.000Z',
      'end_at' => '2017-08-19T17:31:23.110Z',
      'cursus_id' => 4,
      'has_coalition' => true,
      'user' => 
      array (
        'id' => 27991,
        'login' => 'vbrazas',
        'url' => 'https://api.intra.42.fr/v2/users/vbrazas',
      ),
      'cursus' => 
      array (
        'id' => 4,
        'created_at' => '2015-05-01T17:46:08.433Z',
        'name' => 'Piscine C',
        'slug' => 'piscine-c',
      ),
    ),
  ),
  'projects_users' => 
  array (
    101 => 
    array (
      'id' => 875374,
      'occurrence' => 0,
      'final_mark' => 0,
      'status' => 'finished',
      'validated?' => false,
      'current_team_id' => 2000355,
      'project' => 
      array (
        'id' => 69,
        'name' => 'Rush00',
        'slug' => 'piscine-cpp-rush00',
        'parent_id' => 62,
      ),
      'cursus_ids' => 
      array (
        0 => 1,
      ),
      'marked_at' => '2018-06-25T17:01:40.231Z',
      'marked' => true,
    ),
  ),
  'languages_users' => 
  array (
    3 => 
    array (
      'id' => 103861,
      'language_id' => 5,
      'user_id' => 27991,
      'position' => 4,
      'created_at' => '2018-07-18T17:04:44.701Z',
    ),
  ),
  'achievements' => 
  array (
    0 => 
    array (
      'id' => 40,
      'name' => '404 - Sleep not found',
      'description' => 'Etre logué 24h de suite. (à bosser, ofc !)',
      'tier' => 'easy',
      'kind' => 'scolarity',
      'visible' => true,
      'image' => '/uploads/achievement/image/40/SCO001.svg',
      'nbr_of_success' => NULL,
      'users_url' => 'https://api.intra.42.fr/v2/achievements/40/users',
    ),
  ),
  'titles' => 
  array (
    0 => 
    array (
      'id' => 12,
      'name' => 'Altruist %login',
    ),
  ),
  'titles_users' => 
  array (
    0 => 
    array (
      'id' => 3176,
      'user_id' => 27991,
      'title_id' => 12,
      'selected' => true,
    ),
  ),
  'partnerships' => 
  array (
  ),
  'patroned' => 
  array (
  ),
  'patroning' => 
  array (
    0 => 
    array (
      'id' => 959,
      'user_id' => 30647,
      'godfather_id' => 27991,
      'ongoing' => true,
      'created_at' => '2018-06-07T09:21:48.253Z',
      'updated_at' => '2018-10-21T19:40:32.231Z',
    ),
  ),
  'campus' => 
  array (
    0 => 
    array (
      'id' => 8,
      'name' => 'Kyiv',
      'time_zone' => 'Europe/Kiev',
      'language' => 
      array (
        'id' => 5,
        'name' => 'Ukrainian',
        'identifier' => 'uk',
        'created_at' => '2016-08-21T11:42:57.272Z',
        'updated_at' => '2019-01-25T16:39:53.418Z',
      ),
      'users_count' => 2622,
      'vogsphere_id' => 3,
      'country' => 'Ukraine',
      'address' => 'Dorohozhytska St, 3',
      'zip' => '04119',
      'city' => 'Kyiv',
      'website' => 'https://unit.ua/',
      'facebook' => 'https://www.facebook.com/unit.factory/',
      'twitter' => '',
    ),
  ),
  'campus_users' => 
  array (
    0 => 
    array (
      'id' => 18018,
      'user_id' => 27991,
      'campus_id' => 8,
      'is_primary' => true,
    ),
  ),
);

foreach ($a as $k => $v) {
    echo $k . PHP_EOL;
}
