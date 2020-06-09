require('./bootstrap');

//将vue绑定到window的对象上，窗口上
window.Vue = require('vue');//从node_modules中找到并绑定

// 生成一个vueJS的实例
const app = new Vue({
        //具体哪个元素进行操作，元素对象
        el: '#app',
        components:{
            //实例调用多个组件
            'steps':require('./components/steps.vue').default
        }
    })