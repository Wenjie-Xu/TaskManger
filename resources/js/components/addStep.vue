<template>
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
</template>
<script>
import {Hub} from '../vue-bus'

export default {
    // 接受传递进来的参数
    props:[
        'route'
    ],
    data(){
        return {
            newStep: '',
            }
    },
    // 使用生命周期函数监听事件
    created(){
        Hub.$on('edit',(step)=>{
        this.newStep=step.name//放入输入框
        this.$refs.addStep.focus()//DOM元素聚焦
        // $('input').focus()
        })
    },
    methods:{
            addStep(){
                // 提交一个对象
                axios.post(this.route,{name: this.newStep}).then((response)=>{
                    // 注册事件，并且发送数据
                    this.$emit('addStep',response.data.step)
                    // 清空输入框
                    this.newStep=''
                })
            },
    }
}
</script>
<style>

</style>