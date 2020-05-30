@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <h1>{{ $task->name }}</h1>

        {{-- 在html中可以使用两个花括号，但是在laravel中已经被blade占用 --}}
        @{{ message }}

        {{-- 表单与数据进行响应式双向绑定，互相影响 --}}
        <input type="text" v-model="message">
    </div>
@endsection
@section('customJS')
<script src="https://cdn.bootcdn.net/ajax/libs/vue/2.6.11/vue.js"></script>
<script>
    // 生成一个vueJS的实例
    new Vue({
        //具体哪个元素进行操作，元素对象
        el: '#app',
        //数据对象，格式类似python的dict
        //数据渲染的方式
        data: {
            message: 'Hello Vue'
        }
    })
</script>
@endsection
