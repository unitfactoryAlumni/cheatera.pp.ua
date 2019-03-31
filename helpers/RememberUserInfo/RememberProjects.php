<?php

namespace app\helpers\RememberUserInfo;

use app\models\ProjectsAll;

class RememberProjects extends RememberHelper
{

    protected function init()
    {
        $this->responseSubSet =& $this->response['projects_users'];
    }

    protected function norminate()
    {
        foreach ($this->responseSubSet as &$project) {
            $this->setLogin($project['xlogin']);
            if (is_array($project['cursus_ids'])) {
                $project['cursus_ids'] = $project['cursus_ids'][0] ?? 1;
            }
            unset($project['marked']);
            unset($project['marked_at']);
            self::swapKeysInArr($project, [ 'id' => 'puid', 'validated?' => 'validated' ]);
            self::setTrueFalse($project['validated']);
            self::mergeChildArrByKey($project, 'project');
            self::swapKeysInArr($project, [ 'id' => 'project_id' ]);
            self::setNULLtoZero($project);
        }
    }

    protected function remember()
    {
        foreach ($this->responseSubSet as &$project) {
            $model = new ProjectsAll();
            self::saveChangesToDB($model, $project, $model->find()
                ->Where([ 'puid' => $project['puid'] ])
                ->andWhere([ 'xlogin' => $project['xlogin'] ])
            ->all());
        }
    }

}
