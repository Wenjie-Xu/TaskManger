@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <div class="row justify-content-start">
            <h2>{{ $task->name }}</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-4 mr-4">
                <div class="card mb-5">
                    <div class="card-header">进行中</div>
                    <div class="card-body">
                        {{-- 在html中可以使用两个花括号，但是在laravel中已经被blade占用 --}}
                        <ul class="list-group">
                            {{-- 实现迭代数组里的对象，输出其属性 --}}
                            <li class="list-group-item" v-for="(step, index) in inProcessed">
                                @{{ step.name }} 
                                <div class="float-right">
                                    <i class="fas fa-check" v-on:click="toggle(step)"></i>
                                    <i class="far fa-trash-alt pl-4" v-on:click="remove(step)"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="form-group">
                            <label>请输入待完成的步骤：</label>
                            {{-- 表单与数据进行响应式双向绑定，互相影响 --}}     
                            <input type="text" class="form-control" v-model="newStep" v-on:keyup.enter="addStep">
                        </div>
                    </div>
                </div>
            </div>  {{-- .col-4 --}}

            <div class="col-4">
                <div class="card">
                    <div class="card-header">已完成</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="(step, index) in Processed">
                                @{{ step.name }}
                                <div class="float-right">
                                    <i class="fas fa-angle-left"  v-on:click="toggle(step)"></i>
                                    <i class="far fa-trash-alt pl-4" v-on:click="remove(step)"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> {{-- .col-4 --}}
        </div>
    </div>
@endsection
@section('customJS')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    // 生成一个vueJS的实例
    new Vue({
        //具体哪个元素进行操作，元素对象
        el: '#app',
        //数据对象，格式类似python的dict
        //数据渲染的方式
        data: {
            newStep: '',
            //steps是一个数组对象，里面有两个对象
            steps:[
                {name: 'wenjie', completion: false},
                {name: 'mengna', completion: false}
            ]
        },
        //事件的方法
        methods: {
                addStep(){
                    this.steps.push({name: this.newStep, completion: false})
                    this.newStep = ''
                },
                toggle(step){
                    step.completion = ! step.completion
                },
                remove(step){
                    let i = this.steps.indexOf(step)
                    this.steps.splice(i, 1)
                }
            },
        //计算属性
        computed:{
            inProcessed(){
                return this.steps.filter(function(step){
                    return ! step.completion
                })
            },
            Processed(){
                return this.steps.filter((step)=>{
                    return step.completion
                })
            }
        }
    })
</script>
@endsection
