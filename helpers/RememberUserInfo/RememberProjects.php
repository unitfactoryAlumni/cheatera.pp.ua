<?php

namespace app\helpers\RememberUserInfo;

class RememberProjects extends RememberHelper
{

    protected function init()
    {
        $this->responseSubSet =& $this->response['projects_users'];
        $this->model = 'app\models\ProjectsAll';
        $this->idcol = 'puid';
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
        $this->ARcollection = $this->model::find()
            ->where(['xlogin' => $this->xlogin])
        ->all();

        foreach ($this->responseSubSet as $project) {
            $this->saveChangesToDB($project);
        }
    }

}
