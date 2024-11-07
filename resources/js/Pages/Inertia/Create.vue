<script setup>

import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    errors : Object
})

const form = reactive({
    title:null,
    content:null,
})

const submitFunction = () => {
    Inertia.post('/inertia',form)
}

</script>

<template>
    <form @submit.prevent="submitFunction">
        <input type="text" name="title" v-model="form.title">{{ form.title }}<br>
        <div v-if="errors.title">{{ errors.title }}</div>
        <input type="text" name="content" v-model="form.content">{{ form.content }}<br>
        <div v-if="errors.content">{{ errors.content }}</div>
        <button class="bg-indigo-400 border w-20 rounded">送信</button>
    </form>

</template>
