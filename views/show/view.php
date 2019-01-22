<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Show */

$this->params['breadcrumbs'][] = ['label' => $breadcrumbs['name'], 'url' => [$breadcrumbs['url']]];
$this->params['breadcrumbs'][] = strtok($this->title, " ");
\yii\web\YiiAsset::register($this);
?>

<div class="container xlogin">
    <div class="row"> <div class="col-lg-12 mx-auto">
            <div class="progress my-shadow" style="margin: 0.75rem auto ;">
<!--                @TODO Add width relations level -->
<!--                @TODO Add color relations level -->
                <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 67%"><?= $model['level'] ?></div>
            </div>
        </div>
        <div class="col-lg-3 mx-auto">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="<?= $model['image_url']?>" alt="">
                <div class="card-body">
                    <h5 class="card-title"><?= $model['displayname']?></h5>
                    <p class="card-text"><b>Login:</b> <?= $model['login']?></p>
                    <p class="card-text"><b>Level:</b> <?= $model['level']?></p>
                    <p class="card-text"><b>Phone:</b> <a style="color:#000;" href="tel:<?= $model['phone']?>"><?= $model['phone']?></a></p>
                    <p class="card-text"><b>Email:</b> <?= $model['email']?></p>
                    <p class="card-text"><b>Pool year:</b> <?= $model['pool_year']?></p>
                    <p class="card-text"><b>Pool month:</b> <?= $model['pool_month']?></p>
                    <p class="card-text"><b>Wallet:</b> <?= $model['wallet']?></p>
                    <p class="card-text"><b>Grade:</b> <?= $model['grade']?></p>
                    <p class="card-text"><b>Correction Point:</b> <?= $model['correction_point']?></p>
                    <p class="card-text"><b>Achivements:</b> <?= $model['howach']?></p>
                    <p class="card-text"><b>Host:</b> <?= $model['location']?></p>
                    <p class="card-text"><b>Last login:</b> <?= $model['lastloc']?></p>
                    <p class="card-text"><b>Hours at cluster:</b> <?= $model['hours']?></p>
                    <a href="//profile.intra.42.fr/users/<?= $model['login']?>" target="_blank" class="btn btn-warning">Intra</a>
<!--                @TODO Added switch profile buttons -->
                    <a href="/pools/<?= $model['login'] ?>" class="btn btn-success">Pool Profile</a>
                </div>
            </div>
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Навыки</h5>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="11.57" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:55.095238095238%">Algorithms &amp; AI</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="8.52" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:40.571428571429%">Web</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="6.87" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:32.714285714286%">Group &amp; interpersonal</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="6.71" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:31.952380952381%">Rigor</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="6.57" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:31.285714285714%">Unix</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="5.55" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:26.428571428571%">Adaptation &amp; creativity</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="5.21" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:24.809523809524%">DB &amp; Data</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="4.72" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:22.47619047619%">Imperative programming</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="4.56" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:21.714285714286%">Network &amp; system administration</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="3.8" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:18.095238095238%">Security</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="3.13" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:14.904761904762%">Object-oriented programming</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="2.42" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:11.52380952381%">Technology integration</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="1.28" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:6.0952380952381%">Graphics</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="1.19" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:5.6666666666667%">Organization</div>
                    </div>
                    <div class="progress" style="background-color: #717070;margin: 8px 0px ;"  data-placement="left"   data-toggle="tooltip" title="0.53" >
                        <div class="progress-bar progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width:2.5238095238095%">Company experience</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 mx-auto">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Projects (validated)</h5>
                    <div style="max-width: 100%; overflow: auto;">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th scope="col">name</th>
                                <th scope="col">final mark</th>
                                <th scope="col">Retry</th>
                                <th scope="col">status</th>
                            </tr>
                            </thead>
                            <tbody id="alldata">
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/ft_ssl_des/">ft_ssl_des</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>2</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/ft_ssl_md5/">ft_ssl_md5</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>2</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/kift/">KIFT</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/curriculum-vitae/">Curriculum Vitae</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>2</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/docker-1/">docker-1</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>2</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/42-formation-pole-emploi-42-commandements/">42 Commandements</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/piscine-reloaded/">Piscine Reloaded</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>8</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/cloud-1/">cloud-1</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/init/">init</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/fillit/">Fillit</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/camagru/">Camagru</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:64.8%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/piscine-php/">Piscine PHP</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>81</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/lem_in/">Lem_in</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:97.6%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/filler/">Filler</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>122</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/corewar/">Corewar</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:63.2%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/c-exam-alone-in-the-dark-beginner/">C Exam Alone In The Dark - Beginner</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>79</td>
                                <td>7</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:75.2%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/ft_printf/">ft_printf</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>94</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/fdf/">FdF</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/get_next_line/">Get_Next_Line</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/libft/">Libft</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>4</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:66.4%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/piscine-cpp/">Piscine CPP</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>83</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/matcha/">Matcha</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:97.6%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/hypertube/">Hypertube</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>122</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr><td colspan="5"><h5 class="card-title">Projects (failed)</h5></td></tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/first-internship/">First Internship</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>

                            <tr><td colspan="5"><h5 class="card-title">Piscine CPP</h5></td></tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Exam01</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Day 08</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:40%">
                                            <span style="color:black; text-align:left;">Day 07</span>
                                        </div>
                                    </div>
                                </td>
                                <td>50</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:48%">
                                            <span style="color:black; text-align:left;">Day 05</span>
                                        </div>
                                    </div>
                                </td>
                                <td>60</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Exam00</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Day 04</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="color:black; text-align:left;">Day 03</span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:56%">
                                            <span style="color:black; text-align:left;">Day 02</span>
                                        </div>
                                    </div>
                                </td>
                                <td>70</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:56%">
                                            <span style="color:black; text-align:left;">Day 01</span>
                                        </div>
                                    </div>
                                </td>
                                <td>70</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:58.4%">
                                            <span style="color:black; text-align:left;">Day 00</span>
                                        </div>
                                    </div>
                                </td>
                                <td>73</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:96.8%">
                                            <span style="color:black; text-align:left;">Rush00</span>
                                        </div>
                                    </div>
                                </td>
                                <td>121</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Rush01</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:52.8%">
                                            <span style="color:black; text-align:left;">Day 06</span>
                                        </div>
                                    </div>
                                </td>
                                <td>66</td>
                                <td>1</td>
                                <td>finished</td>
                            </tr>

                            <tr><td colspan="5"><h5 class="card-title">Piscine PHP</h5></td></tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Rush01</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:95.2%">
                                            <span style="color:black; text-align:left;">Rush00</span>
                                        </div>
                                    </div>
                                </td>
                                <td>119</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="color:black; text-align:left;">Day 09</span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Day 08</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="color:black; text-align:left;">Day 07</span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Day 06</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:88%">
                                            <span style="color:black; text-align:left;">Day 05</span>
                                        </div>
                                    </div>
                                </td>
                                <td>110</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="color:black; text-align:left;">Day 04</span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="color:black; text-align:left;">Day 03</span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:48%">
                                            <span style="color:black; text-align:left;">Day 02</span>
                                        </div>
                                    </div>
                                </td>
                                <td>60</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:69.6%">
                                            <span style="color:black; text-align:left;">Day 01</span>
                                        </div>
                                    </div>
                                </td>
                                <td>87</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:72%">
                                            <span style="color:black; text-align:left;">Day 00</span>
                                        </div>
                                    </div>
                                </td>
                                <td>90</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>

                            <tr><td colspan="5"><h5 class="card-title">Rushes</h5></td></tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Frozen</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Carnifex (LISP)</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:96.8%">
                                            <span style="color:black; text-align:left;">Mexican Standoff</span>
                                        </div>
                                    </div>
                                </td>
                                <td>121</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Hotrace</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="color:black; text-align:left;">wong_kar_wai</span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="color:black; text-align:left;">LLDB</span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:100%">
                                            <span style="color:black; text-align:left;">AlCu</span>
                                        </div>
                                    </div>
                                </td>
                                <td>125</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:84%">
                                            <span style="color:black; text-align:left;">Rage Against The aPi</span>
                                        </div>
                                    </div>
                                </td>
                                <td>105</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>

                            <tr><td colspan="5"><h5 class="card-title">First Internship</h5></td></tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:80%">
                                            <span style="color:black; text-align:left;">Contract Upload</span>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:60%">
                                            <span style="color:black; text-align:left;">Duration</span>
                                        </div>
                                    </div>
                                </td>
                                <td>75</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Company mid evaluation</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Company final evaluation</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="color:black; text-align:left;">Peer Video</span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>finished</td>
                            </tr>
                            <tr><td colspan="5"><h5 class="card-title">Projects (in progress)</h5></td></tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/ft_sommelier/">ft_sommelier</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>in_progress</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/ft_ssl_rsa/">ft_ssl_rsa</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>in_progress</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/avaj-launcher/">avaj-launcher</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>in_progress</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/roger-skyline-2/">roger-skyline-2</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>in_progress</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/ft_hangouts/">ft_hangouts</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>in_progress</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/swifty-companion/">Swifty Companion</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>in_progress</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/first-internship/">First Internship</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>in_progress</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/push_swap/">Push_swap</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>in_progress</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/fract-ol/">Fract'ol</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>in_progress</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/ft_ls/">ft_ls</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>in_progress</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/abstract-vm/">Abstract VM</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>in_progress</td>
                            </tr>
                            <tr><td colspan="5"><h5 class="card-title">Projects (searching a group)</h5></td></tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/ccmn/">CCMN</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>searching_a_group</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/reverse-game-of-life/">Reverse Game of Life</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>searching_a_group</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="progress my-shadow">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:0%">
                                            <span style="text-align:left;"><a style="color:black; " href="/students/projects/mod1/">mod1</a></span>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td>0</td>
                                <td>searching_a_group</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Time at cluster</h5>
                    <canvas id="timer" width="770" height="385" style="display: block; width: 770px; height: 385px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mx-auto">
        </div>
    </div>
</div>