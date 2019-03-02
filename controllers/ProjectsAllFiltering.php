<?php

namespace app\controllers;

use app\models\ProjectsAll;

/**
 * ProjectsAllFiltering represents the model behind the search form of `app\models\ProjectsAll`.
 */
class ProjectsAllFiltering extends ProjectsAll
{
    public $withParentId = null;
    public $forPools = null;

    public function __construct(array $config = [])
    {
        if (count($config) > 0) {
            if (key_exists('withParentId', $config)) {
                $this->withParentId = $config['withParentId'];
            }
            if (key_exists('forPools', $config)) {
                $this->forPools = $config['forPools'];
            }
        }
        parent::__construct($config);
    }

    /**
     * For pools data
     *
     * SELECT pu.*
    34 FROM
    35         projects_users as pu,
    36     (
    37         SELECT * FROM xlogins
    38                 WHERE xlogins.pool_year = \"" . $data_array['year'] .
     * "\" and xlogins.pool_month=\"" . $data_array['month'] . "\" ORDER BY xlogins    .login ASC
    39     ) as xl
    40 WHERE pu.xlogin = xl.login and pu.cursus_ids=\"4\"
    41 ORDER BY pu.name ASC, pu.xlogin ASC
    42   ;";
    */

    public function getDataForPools()
    {
        /**
         * @TODO Implementation function for get data
         */
    }

    public function getDataForParentProject()
    {
        /**
         * @TODO Implementation function for get data
         */
    }

    public function counting()
    {
        /**
         * @TODO Implementation function for counting data
         */
    }
}
