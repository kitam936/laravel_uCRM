<script setup>
import {Link} from '@inertiajs/inertia-vue3'
defineProps({ blogs : Array})
</script>

<template>
<div v-if="$page.props.flash.message && $page.props.flash.status == 'alert'" class="bg-red-400">
    {{ $page.props.flash.message }}
</div>
<div v-if="$page.props.flash.message && $page.props.flash.status == 'info'" class="bg-blue-400">
    {{ $page.props.flash.message }}
</div>

<ul>
    <li v-for="blog in blogs" :key="blog.id">
        件名:<Link :href="route('inertia.show',{id:blog.id})" class="text-blue-500 ">{{ blog.title }}</Link> // 本文:{{ blog.content }}
    </li>
</ul>
Index
</template>

