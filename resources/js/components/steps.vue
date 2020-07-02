<template>
    <div class="row justify-content-center" id="app">
        <div class="col-4 mr-4">
            <div class="card mb-5">
                <div class="card-header">
                    进行中 ({{ inProcessed.length }})
                    <button class="btn btn-success btn-sm float-right" v-on:click="allProcessed()">全部完成</button>
                </div>
                <div class="card-body">
                    <!-- 在html中可以使用两个花括号，但是在laravel中已经被blade占用 -->
                    <ul class="list-group">
                        <!-- 实现迭代数组里的对象，输出其属性 -->
                        <li class="list-group-item" v-for="(step, index) in inProcessed">
                            <span v-on:dblclick="edit(step)">{{ step.name }}</span>
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
                        <!-- 表单与数据进行响应式双向绑定，互相影响 -->
                        <input type="text" class="form-control" ref="addStep" v-model="newStep" v-on:keyup.enter="addStep">
                        <button v-if="newStep" class="btn btn-success btn-sm float-right mt-3" v-on:click="addStep">添加步骤</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card" v-show="Processed.length">
                <div class="card-header">
                    已完成 ({{ Processed.length }})
                    <button class="btn btn-danger btn-sm float-right" v-on:click="allRemove()">全部清除</button>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="(step, index) in Processed">
                            <span v-on:dblclick="edit(step)">{{ step.name }}</span>
                            <div class="float-right">
                                <i class="fas fa-angle-left"  v-on:click="toggle(step)"></i>
                                <i class="far fa-trash-alt pl-4" v-on:click="remove(step)"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//默认写法
    export default{
        //数据对象，格式类似python的dict
        //数据渲染的方式
        //在vue组件中写成方法，方便多个实例调用
        props:[
            //接收从blade中传递过来的参数
            'route'
        ],
        data(){
            return {
                newStep: '',
                //steps是一个数组对象，里面有两个对象
                steps:[
                    //保留一组空数据，展现数据结构
                    // {name:'', completion:false}
                ]
            }
        },
        created(){
            this.fetchSteps()
        },
        //事件的方法
        methods: {
                fetchSteps(){
                    axios.get(this.route).then((response)=>{
                        // 这里的data就是controller返回的值
                        this.steps = response.data.steps
                        }).catch((error_response)=>{
                            //异常处理的脚本
                        })
                },
                addStep(){
                    // 提交一个对象
                    axios.post(this.route,{name: this.newStep}).then((response)=>{
                        // 接受一个对象，将对象放入steps
                        this.steps.push(response.data.step)
                        this.newStep = ''
                    })
                },
                toggle(step){
                    axios.patch(`${this.route}/${step.id}`,{completion: !step.completion})
                        .then((response)=>{
                            step.completion = ! step.completion
                        })      
                },
                remove(step){
                    axios.delete(`${this.route}/${step.id}`).then((response)=>{
                        let i = this.steps.indexOf(step)//获取下标
                        this.steps.splice(i, 1)//移除
                    })
                },
                edit(step){
                    this.remove(step)//移除
                    this.newStep=step.name//放入输入框
                    this.$refs.addStep.focus()//DOM元素聚焦
                    // $('input').focus()
                },
                allProcessed(){
                    axios.patch(`${this.route}/complete`,{completion:1})
                        .then((response)=>{
                            this.inProcessed.forEach((step)=>{
                                step.completion=true
                            })
                    })
                },
                allRemove(){
                    axios.delete(`${this.route}/clear`).then((response)=>{
                        this.steps = this.inProcessed //让原始属性等于未完成计算属性，相当于清空了已完成
                    })          
                }
            },
        //计算属性，本质是属性
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
    
    }
</script>

<style>
</style>