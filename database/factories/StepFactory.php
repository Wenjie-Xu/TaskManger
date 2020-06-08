<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Step;
use App\Task;
use Faker\Generator as Faker;

//虚假数据的模板
//已经关联上了Step-Model  $faker代表虚假数据对象
$factory->define(Step::class, function (Faker $faker) {
    return [
        //定义每一栏测试的数据
        'name'=>$faker->sentence(),//生成随机的句子
        'completion'=>$faker->boolean(),//生成布尔数据
        'task_id'=> Task::all()->random()->id//在所有的task中随机取一个,并获取id
    ];
});
