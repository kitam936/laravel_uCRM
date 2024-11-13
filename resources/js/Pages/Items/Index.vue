<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head ,Link} from '@inertiajs/vue3';

defineProps({
    items:Array,
})
</script>

<template>
    <Head title="商品Index" />

    <AuthenticatedLayout>
        <template #header>
            <div v-if="$page.props.flash.message && $page.props.flash.status == 'alert'" class="bg-red-400">
                {{ $page.props.flash.message }}
            </div>
            <div v-if="$page.props.flash.message && $page.props.flash.status == 'info'" class="bg-blue-400">
                {{ $page.props.flash.message }}
            </div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="ml-24 mb-8">
                            <Link as="button" :href="route('items.create')" class="w-32 h-8 bg-indigo-500 text-sm text-white ml-0 hover:bg-indigo-600 rounded">商品登録</Link>

                        </div>
                        <div class=" mx-auto w-2/3 sm:px-4 lg:px-4 border ">

                        <table class="bg-white table-auto w-full text-center whitespace-no-wrap">
                            <thead>
                                <tr>
                                    <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">id</th>
                                    <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">name</th>
                                    <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">price</th>
                                    <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">status</th>

                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="item in items" :key="item.id">
                                    <td class="border-b-2 boder-gray-200">{{ item.id }} </td>
                                    <td class="border-b-2 boder-gray-200">{{ item.name }} </td>
                                    <td class="border-b-2 boder-gray-200">{{ item.price }} </td>
                                    <td class="border-b-2 boder-gray-200">
                                        <span v-if="item.is_selling === 1 ">販売中</span>
                                        <span v-if="item.is_selling === 0 ">停止中</span>
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
