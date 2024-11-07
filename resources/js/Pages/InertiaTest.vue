<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const newTitle = ref('')
const newContent = ref('')
</script>

<template>
Inertiaテストです<br><br>
<a href="/">a-tag</a><br><br>
<Link href="/">Link</Link><br><br>
<Link :href="route('inertia.index')">name_route</Link><br><br>
<Link :href="route('inertia.show',{id:50})">ルートパラメータテスト</Link>

<div class="mb-8"></div>



<input type="text" name="newTitle" v-model="newTitle">{{ newTitle }}<br>
<input type="text" name="newContent" v-model="newContent">{{ newContent }}
<br>
<Link class="bg-green-400" as="button" method="post" :href="route('inertia.store')" :data="{ title:
newTitle, content: newContent}">保存テスト</Link>
</template>
