<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

//调用虚假数据的模板，调用几次创建多少个假数据
class StepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 清空数据表
        DB::table('steps')->truncate();
        // 调用模板，创建多条数据
        factory(App\Step::Class, 10)->create();
    }
}
