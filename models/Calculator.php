<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Calculator is the model behind the Calculator controller.
 *
 * @property array $_expr_per_lvl - read-only array with coeficents to each level point earnings
 * @property array $_expr_per_tier - read-only array with coeficents to each level of complexity
 * @property float $result - final result of the calculation, if 0 it does not exists
 * @property float $lvlstart - initial student's
 * @property float $tier - complexity level of the project
 * @property float $finalmark - project's final mark achived by the student
 */

class Calculator extends Model
{
    static private $_expr_per_lvl = [
        0,
        1000,
        2136.3636363636365,
        3427.6859504132235,
        4895.097670924118,
        6562.610989686497,
        8457.51248828011,
        10610.809645772853,
        13057.738233832788,
        15838.338902082713,
        18998.112388730355,
        22588.764078102675,
        26669.05008875304,
        31305.738737219363,
        36574.70311047655,
        42562.16262554153,
        49366.09389266083,
        57097.83396893276,
        65883.9022374236,
        75868.07072434499,
        87213.71673221022,
        100106.49628660252,
        114757.3821438665,
        131406.11607257556,
        150325.13190065406,
        171824.01352347052,
        196254.56082212558,
        224016.54638877907,
        255564.2572599762,
        291413.9287045184,
        332152.19170968,
       -1
    ];
    static private $_expr_per_tier = [
        2.2,
        8.8330,
        20.02,
        33.88,
        56.10,
        79.2,
        93.50,
        132
    ];
    private $lvl_max;

    public $result;
    public $lvlstart;
    public $tier;
    public $finalmark;


    function __construct()
    {
        $this->result = 0;
        $this->lvl_max = count(self::$_expr_per_lvl) - 2;

        $this->resetToDefault();
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['lvlstart', 'finalmark'], 'required'],
            ['lvlstart', 'number', 'min' => 0, 'max' => $this->lvl_max],
            ['finalmark', 'number', 'min' => 50, 'max' => 125]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lvlstart' => '',
            'finalmark' => '',
        ];
    }

    public function getTier()
	{
		return ['25XP(T0)', '100XP(T1)', '225XP(T2)', '375XP(T3)', '600Xp(T4)', '800XP(T5)', '1000XP(T6)', '1500XP(T7)'];
    }

    public function resetToDefault()
    {
        $this->finalmark = 125;

        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }

        $this->lvlstart = (!$session->has('level') ? 0 : $session->get('level'));

        return $this->lvlstart;
    }



    /**
    * Do all magic ie counts the particular lvl up value from parameters.
    *
    * @return float lvl up value for given args
    */
    public function getMark()
    {
        // $tier_exps = array("0" => 2.2);
        // $tier_exps["1"] = $tier_exps["0"] * 4.015;
        // $tier_exps["2"] = $tier_exps["0"] * 9.1;
        // $tier_exps["3"] = $tier_exps["0"] * 15.4;
        // $tier_exps["4"] = $tier_exps["0"] * 25.5;
        // $tier_exps["5"] = $tier_exps["0"] * 36;
        // $tier_exps["6"] = $tier_exps["0"] * 42.5;
        // $tier_exps["7"] = $tier_exps["0"] * 60;

        $lvlstart_int = intval($this->lvlstart);
        $fract_part = $this->lvlstart - $lvlstart_int;
        $eplvl = self::$_expr_per_lvl;

        $expr_raising = self::$_expr_per_tier[$this->tier] * $this->finalmark
        + $eplvl[$lvlstart_int]
        + ($eplvl[$lvlstart_int + 1] - $eplvl[$lvlstart_int]) * $fract_part;

        for($i = 0; $i < $this->lvl_max; $i++)
        {
            if ($eplvl[$i] > $expr_raising) {
                $i--;
                break ;
            }
        }

        $res = ($eplvl[$i + 1] - $eplvl[$i]) / 100;
        $res = (($expr_raising - $eplvl[$i]) / $res) / 100;
        $res += $i;

        if ($this->lvlstart >= $res) {
            return $this->result = 30;
        }

        $this->result = round($res, 2);
        return $this->result;
    }
}
