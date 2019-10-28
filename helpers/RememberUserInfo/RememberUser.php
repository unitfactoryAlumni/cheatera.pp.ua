<?php

namespace app\helpers\RememberUserInfo;

use Yii;
use app\helpers\LogTimeHelper;
use app\controllers\LocationsSearch;

class RememberUser extends RememberHelper
{

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        $this->responseSubset = $this->response;
        $this->model = 'app\models\Show';
        $this->idcol = 'xid';

        $this->ARcollection = $this->model::find()
            ->where(['login' => $this->responseSubset['login']])
            ->all();
    }

    /**
     * {@inheritdoc}
     */
    protected function remember()
    {
        $user = $this->ARcollection[$this->findARbyId($this->xid)];

        $this->responseSubset['lastloc'] = date('Y-m-d H:i:s');
        $this->responseSubset['howach'] = count($this->responseSubset['achievements']);

        $this->responseSubset['campus'] = $this->responseSubset['campus'][0]['name'];
        $this->responseSubset['visible'] = ($this->responseSubset['campus'] === 'Kyiv');

        $searchModelTime = new LocationsSearch($this->xlogin);
        $dataProviderTime = $searchModelTime->search(Yii::$app->request->queryParams);
        $lastloc = $dataProviderTime->models[0];
        [$amount, $labels, $data] = LogTimeHelper::getChartJSInfo($dataProviderTime->models);
        $this->responseSubset['hours'] = $amount;

        $this->responseSubset['needupd'] = $user->needupd ?? 0;
        $this->responseSubset['lasthours'] = $user->lasthours ?? 0;
        $this->responseSubset['kick'] = $user->kick ?? 0;
        // $this->responseSubset['lastloc'] = $lastloc->begin_at;
        $this->responseSubset['location'] = $user->location ?? $lastloc->host;

        self::swapKeysInArr($this->responseSubset, ['id' => 'xid', 'staff?' => 'staff']);
        self::setTrueFalse($this->responseSubset['staff']);

        $this->saveChangesToDB($this->responseSubset);
    }

}
