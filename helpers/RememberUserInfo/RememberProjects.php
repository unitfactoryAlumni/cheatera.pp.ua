<?php

namespace app\helpers\RememberUserInfo;

use app\models\ProjectsAll;

class RememberProjects extends RememberHelper
{

    protected function norminateTheResponse()
    {
        foreach ($this->response['projects_users'] as &$project) {
            $project['xlogin'] = $this->response['login'];
            $project['cursus_ids'] = $project['cursus_ids'][0]; // ??? WTF
            $project['validated?'] = $project['validated?'] ? 'True' : 'False';
            // $project['marked'] = $project['marked'] ? 'True' : 'False';
            // self::dateToSqlFormat($project['marked_at']); // ??? WTF
            self::swapKeysInArr($project, [ 'id' => 'puid', 'validated?' => 'validated' ]);
            // ??? WTF 'validated?' ? True ? False ? true ? false ?
            self::mergeChildArrByKey($project, 'project');
            self::swapKeysInArr($project, [ 'id' => 'project_id' ]);
        }
    }

    public function rememberToDB()
    {
        $pusers = new ProjectsAll();

        foreach ($this->response['projects_users'] as &$project) {
            self::saveChangesToDB($pusers, $project, $pusers->find()
                ->Where([ 'puid' => $project['puid'] ])
                ->andWhere([ 'xlogin' => $project['xlogin'] ])
            ->all());
        }
    }

}
