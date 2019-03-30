<?php

namespace app\helpers\RememberUserInfo;

use app\models\ProjectsAll;

class RememberProjects extends RememberHelper
{

    protected function init()
    {
        $this->responseSubSet =& $this->response['projects_users'];
        $this->model = new ProjectsAll();
    }

    protected function norminate()
    {

        foreach ($this->responseSubSet as &$project) {
            $this->setXlogin($project);
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

    protected function remember()
    {
        foreach ($this->responseSubSet as &$project) {
            self::saveChangesToDB($this->model, $project, $this->model->find()
                ->Where([ 'puid' => $project['puid'] ])
                ->andWhere([ 'xlogin' => $project['xlogin'] ])
            ->all());
        }
    }

}
