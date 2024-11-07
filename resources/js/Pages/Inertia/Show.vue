<script setup>
import { Inertia } from '@inertiajs/inertia';

defineProps({
    id : String,
    blog : Object,
})

const deleteComfirm = id => {
    Inertia.delete(`/inertia/${id}`, {
        onBefore: () => confirm('本当に削除しますか？')
    })
}
</script>

<template>

{{ blog.id }}<br>
{{ blog.title }}<br>
<button @click="deleteComfirm(blog.id)" class="bg-pink-400">Delete</button>
</template>
